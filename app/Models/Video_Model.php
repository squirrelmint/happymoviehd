<?php

namespace App\Models;

use CodeIgniter\Model;

class Video_Model extends Model
{

    protected $table_movie = 'mo_movie';
    protected $table_slide = 'mo_slide';
    protected $table_category = 'mo_category';
    protected $mo_moviecate = 'mo_moviecate';
    protected $table_vdoads = 'mo_adsvideo';
    protected $mo_request = 'mo_request';
    protected $mo_adscontact = 'mo_adscontact';
    protected $pathAdsVideo = 'movie/adsvdo';
    protected $ads = 'ads';
    protected $report_movie = 'movie_report';
    protected $live_stream = 'mo_livestream';
    protected $setting = 'setting';
    protected $content = 'content';
    protected $seo = 'seo';

    private $path_filelogo;

    public function __construct()
    {

        parent::__construct();
        $db = \Config\Database::connect();
        $this->path_filelogo = "logo";
    }

    function get_adsvideolist($backurl)
    {

        $sql = "SELECT 
					$this->table_vdoads.adsvideo_id,
					$this->table_vdoads.adsvideo_name,
					$this->table_vdoads.adsvideo_status,
					$this->table_vdoads.adsvideo_url as url,
					$this->table_vdoads.branch_id,
                    (
                        CASE
                        WHEN $this->table_vdoads.adsvideo_video IS NOT NULL THEN
                            CONCAT(
                                '$backurl',
                                '$this->pathAdsVideo',
                                '/',
                                $this->table_vdoads.adsvideo_video
                            )
                        END
                    ) AS 'file'
				FROM
					$this->table_vdoads
				WHERE $this->table_vdoads.branch_id = '1' AND $this->table_vdoads.adsvideo_status = 1";

        $query = $this->db->query($sql);

        return $query->getResultArray();
    }

    public function get_category($branch_id) // เรียก Category ตาม Branch 
    {
        $sql = "SELECT
            *
            FROM
            mo_category
            inner JOIN mo_moviecate ON mo_category.category_id = mo_moviecate.category_id 
            WHERE
            `mo_category`.branch_id = ?
             GROUP BY mo_category.category_id"
            ;
            


        $query = $this->db->query($sql, [$branch_id]);
        return $query->getResultArray();
    }
    public function get_caterow($cate_id) // เรียก Category ตาม Branch 
    {

        $sql = "SELECT
            *
            FROM
            $this->table_category
            WHERE
            `$this->table_category`.category_id = ?";
        $query = $this->db->query($sql, [$cate_id]);
        return $query->getRowArray();
    }

    public function get_list_video_search($keyword = "", $branchid, $page)
    {
        $sql_where = " ";
        // ECHO '<pre>'.print_r($keyword,true).'</pre>' ;die;
        $year = date("Y");

        if ($keyword != "") {
            $sql_where = " AND `$this->table_movie`.movie_thname LIKE '%$keyword%' and `$this->table_movie`.movie_active = '1'  order by movie_create desc ";
        }

        $sql = "SELECT
            *
            FROM
            $this->table_movie
            WHERE
            `$this->table_movie`.branch_id = " . $branchid . $sql_where;

        $query = $this->db->query($sql);

        $total = count($query->getResultArray());
        $perpage = 35;

        // return $query->getResultArray();
        return get_pagination($sql, $page, $perpage, $total);
    }

    public function get_list_video($branchid, $keyword = "", $page = 1)
    {
        $year = date("Y");

        // die;
        $sql_where = " ";

        if ($keyword != "") {
            $keyword = str_replace("'","\'",$keyword);
            $sql_where = " AND REPLACE(CONCAT_WS('',`$this->table_movie`.movie_thname, `$this->table_movie`.movie_enname, `$this->table_movie`.movie_year ), \"'\", \"\'\") LIKE '%$keyword%' ";
        }

        $sql = "SELECT
                    *
                FROM
                $this->table_movie
                WHERE
                    `$this->table_movie`.branch_id = '$branchid' $sql_where 
                    AND `$this->table_movie`.movie_active = '1' 
                ORDER BY `$this->table_movie`.movie_year DESC, `$this->table_movie`.movie_create DESC ";

        $query = $this->db->query($sql);
        $total = count($query->getResultArray());
        $perpage = 30;

        return get_pagination($sql, $page, $perpage, $total);
    }

    public function get_movie_new_recommend($branchid,  $page = 1)
    {

        $year = date("Y");
        // die;

        $sql_where = " AND `$this->table_movie`.movie_active = '1'  ORDER BY `$this->table_movie`.movie_year desc, `$this->table_movie`.movie_create DESC ";

        $sql = "SELECT
            *
            FROM
            $this->table_movie
            WHERE
            `$this->table_movie`.branch_id = " . $branchid . $sql_where;



        $query = $this->db->query($sql);
        $total = count($query->getResultArray());
        $perpage = 10;
        //   print_r($query->getResultArray());die;
        // return 
        return get_pagination($sql, $page, $perpage, $total);
    }

    public function  get_listyear($branch_id)
    {

        $sql = "SELECT 
                    movie_year 
                FROM `$this->table_movie` 
                WHERE branch_id = '$branch_id' AND `$this->table_movie`.movie_active = '1'
                GROUP BY movie_year
                ORDER BY movie_year DESC ";

        $query = $this->db->query($sql);


        return $query->getResultArray();
    }

    public function get_list_popular($branchid)
    {
        $sql = "SELECT
                    $this->table_movie.*,
                    $this->table_slide.slide_img
                FROM
                $this->table_movie
                INNER JOIN $this->table_slide ON $this->table_slide.movie_id = $this->table_movie.movie_id 
                WHERE
                    `$this->table_movie`.branch_id = '$branchid'
                    AND `$this->table_movie`.movie_active = '1' 
                ORDER BY `$this->table_slide`.slide_id ASC";

        $query = $this->db->query($sql);
        $result = $query->getResultArray();

        if(!empty($result)){
            foreach($result as $key => $val){

                $id = $val['movie_id'];
                $sqlcate = "SELECT
                        *
                    FROM
                        `$this->table_category`
                    INNER JOIN `$this->mo_moviecate` ON `$this->mo_moviecate`.category_id = `$this->table_category`.category_id
                    WHERE
                    `$this->mo_moviecate`.movie_id = '$id'";

                $querycate = $this->db->query($sqlcate);
                $result[$key]['cate_data'] = $querycate->getResultArray();
            }
        }

        return $result;

    }

    public function get_popular($branchid, $page = 1)
    {
        $year = date("Y");
        $sql = "SELECT
                    *
                FROM
                $this->table_movie
                WHERE
                    `$this->table_movie`.branch_id = '$branchid'
                    AND `$this->table_movie`.movie_year = '$year'
                    AND `$this->table_movie`.movie_active = '1' 
                ORDER BY `$this->table_movie`.movie_ratescore  DESC ";

        $query = $this->db->query($sql);
        $total = count($query->getResultArray());
        $perpage = 30;

        return get_pagination($sql, $page, $perpage, $total);
    }

    // Get video_movie
    public function get_id_video($id)
    {
        $sql = "SELECT
                    *
                FROM
                    `$this->table_movie`
                WHERE
                `$this->table_movie`.movie_id = ?";

        $query = $this->db->query($sql, [$id]);
        $result = $query->getRowArray();

        if(!empty($result)){
            $sqlcate = "SELECT
                    *
                FROM
                    `$this->table_category`
                INNER JOIN `$this->mo_moviecate` ON `$this->mo_moviecate`.category_id = `$this->table_category`.category_id
                WHERE
                `$this->mo_moviecate`.movie_id = '$id'";

            $querycate = $this->db->query($sqlcate);
            $result['cate_data'] = $querycate->getResultArray();
        }

        return $result;
    }

    // Get video_series
    public function get_ep_series($id)
    {
        $sql = "SELECT
                    *
                FROM
                    `$this->table_movie`
                WHERE
                `$this->table_movie`.movie_id =" . $id;

        $query = $this->db->query($sql);
        $data = $query->getResultArray();
        $data[0]['epdata'] = $this->normalizeSeriestoArray($data[0]['movie_thmain']);
        $data[0]['name_ep'] = $this->getListNameSeries($data[0]['movie_thmain'])[0];

        return $data[0];
    }

    public function normalizeSeriestoArray($str)
    {
        $pattern = '(\{{[^}}]*\}})';
        $str = preg_replace($pattern, '', $str);
        $delimiter = '!!end!!';
        $seriesList = explode($delimiter, $str);
        if (($key = array_search('', $seriesList)) !== false) {
            unset($seriesList[$key]);
        }
        return $seriesList;
    }

    public function getListNameSeries($str)
    {
        $m = [];
        preg_match_all("/(?<=\{{)[^}}]*(?=\}})/", $str, $m);
        return $m;
    }


    public function get_id_video_bycategory($branch_id, $id, $page = 1)
    {
        $sql = "SELECT
                *
                FROM
                    mo_moviecate
                LEFT JOIN mo_movie ON mo_moviecate.movie_id = mo_movie.movie_id 
                WHERE 
                    mo_moviecate.category_id = '$id' 
                    AND `$this->table_movie`.movie_active = '1' 
                    AND mo_moviecate.branch_id = '$branch_id' 
                ORDER BY mo_movie.movie_year DESC, mo_movie.movie_create DESC
                ";
        $query = $this->db->query($sql, [$id]);

        $total = count($query->getResultArray());
        $perpage = 30;


        return get_pagination($sql, $page, $perpage, $total);
    }


    public function get_list_new_movie($branchid, $keyword = "", $page = 1)

    {
        $sql_where = " ";

        if ($keyword != "") {
            $sql_where = "  AND `$this->table_movie`.movie_thname LIKE '%$keyword%' ";
        }

        $sql = "SELECT
                    *
                FROM
                    $this->table_movie
                WHERE
                    `$this->table_movie`.branch_id = '$branchid'
                    AND `$this->table_movie`.movie_type = 'mo' 
                    AND $this->table_movie.movie_active = '1' " .
            $sql_where .
            "ORDER BY `$this->table_movie`.movie_year DESC ";



        // print_r($sql);die;

        $query = $this->db->query($sql);
        $total = count($query->getResultArray());
        $perpage = 35;

        // return $query->getResultArray();
        return get_pagination($sql, $page, $perpage, $total);
    }

    public function get_video_interest($branch)
    {

        $sql = "SELECT
                    *
                FROM
                    $this->table_movie
                WHERE
                    `$this->table_movie`.branch_id = '$branch'
                    AND `$this->table_movie`.movie_type = 'mo' 
                    AND $this->table_movie.movie_active = '1'
                ORDER BY RAND(), `$this->table_movie`.movie_year, `$this->table_movie`.movie_year DESC
                LIMIT 6 ";

        $query = $this->db->query($sql);
        return $query->getResultArray();

    }


    public function get_adstop($branch_id)
    {
        $sql = "SELECT * FROM  `$this->ads` WHERE branch_id = '$branch_id' AND ads_position = '1' ";
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }

    public function get_adsbottom($branch_id)
    {
        $sql = "SELECT * FROM  `$this->ads` WHERE branch_id = '$branch_id' AND ads_position = '2' ";
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }

    //Get database livestream
    public function  get_path_livesteram()
    {
        $sql = "SELECT * FROM `$this->live_stream`";
        $query = $this->db->query($sql);
        // echo $sql;die;
        return $query->getResultArray();
    }

    //Get video livestream
    public function  get_video_livesteram($id)
    {
        $sql = "SELECT * FROM `$this->live_stream`
        WHERE
             `$this->live_stream`.livestream_id = ?";
        $query = $this->db->query($sql, [$id]);
        // echo $sql;die;
        return $query->getRowArray();
    }




    //Get setting show fontend 
    public function  get_setting($branch_id)
    {
        $sql = "SELECT * FROM `$this->setting` WHERE branch_id = '$branch_id' ";
        $query = $this->db->query($sql);
        return $query->getRowArray();
    }

    //Get Content
    public function  get_content($branch_id, $id)
    {
        $sql = "SELECT * FROM `$this->content` WHERE branch_id = '$branch_id' AND content_id  = '$id' ";
        $query = $this->db->query($sql);
        return $query->getRowArray();
    }

    //Get List Content
    public function  get_listcontent($branch_id)
    {
        $sql = "SELECT * FROM `$this->content` WHERE branch_id = '$branch_id'";
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }

    //Get Seo
    public function  get_seo($branch_id)
    {
        $sql = "SELECT * FROM `$this->seo` WHERE branch_id = '$branch_id'";
        $query = $this->db->query($sql);
        return $query->getRowArray();
    }


    //Get Name video
    public function get_namevideo($id)
    {
        $sql = "SELECT movie_thname,movie_des FROM `$this->table_movie` WHERE movie_id = '$id'";
        $query = $this->db->query($sql);
        return $query->getRowArray();
    }


    //Get Name video
    public function get_title($branch)
    {
        $sql = "SELECT setting_title,setting_description FROM `$this->setting` WHERE branch_id = '$branch'";
        $query = $this->db->query($sql);
        return $query->getRowArray();
    }

    //Get Img_og
    public function get_img_og($id)
    {
        $sql = "SELECT movie_picture FROM `$this->table_movie` WHERE movie_id = '$id' ";
        $query = $this->db->query($sql);
        return $query->getRowArray();
    }

    public function movie_view($movie_id,$branch)

    {

        $sql = "SELECT
  
                      `$this->table_movie`.movie_id,`$this->table_movie`.movie_view
  
                  FROM
  
                      $this->table_movie
  
                      WHERE`$this->table_movie`.movie_id = '$movie_id'
  
                
  
                  ";



        $query = $this->db->query($sql);



        $data = $query->getResultArray();

        if ($data[0]['movie_view'] == 0) {

            $movie_view = 1;
        } else {



            $movie_view = $data[0]['movie_view'] + 1;
        }

        $builder = $this->db->table($this->table_movie);



        $builder->where('movie_id', $movie_id);

        $this->db->transBegin();



        $dataadd =  [

            'movie_view' =>  $movie_view,



        ];



        try {

            if ($builder->update($dataadd) == true) {

                $this->db->transCommit();

                // return true;

            }
        } catch (\Exception $e) {

            // throw new Exception("Error Insert user", 1);

            $this->db->transRollback();

            // return $e->getMessage();

        }



        return $movie_view;
    }


    public function get_id_video_random($branch_id)

    {

        $sql = "SELECT
                    *
                FROM
                    `$this->table_movie`
                WHERE
                    `$this->table_movie`.branch_id = '$branch_id'
                    AND `$this->table_movie`.movie_active = '1'
                ORDER BY RAND()  limit 4";







        $query = $this->db->query($sql);



        //   print_r()

        return $query->getResultArray();
    }



    // list หนังแยก cate ใน tap หน้าแรก :: action comedy adventure drama horror
    public function get_video_bycate($branch_id, $page, $id)

    {

        $sql = "SELECT
           *
        FROM
            mo_moviecate
        left JOIN mo_movie ON mo_moviecate.movie_id = mo_movie.movie_id 
        left JOIN mo_category ON mo_moviecate.category_id = mo_category.category_id
        WHERE mo_moviecate.category_id = '$id ' AND mo_moviecate.branch_id = '$branch_id' ";
        $query = $this->db->query($sql);

        $total = count($query->getResultArray());
        $perpage = 35;


        return get_pagination($sql, $page, $perpage, $total);
    }

    //แจ้งหนังเสีย

    public function save_reports($branch, $id, $reason)
    {

        $bd =  $this->db->table($this->report_movie);

        $date =  date("Y-m-d");

        $this->db->transBegin();

        $data =  [

            'movie_id' =>  $id,

            'branch_id' => $branch,

            'reason' => $reason

        ];

        try {

            if ($bd->insert($data) == true) {

                $this->db->transCommit();

                return true;
            }
        } catch (\Exception $e) {

            // throw new Exception("Error Insert user", 1);

            $this->db->transRollback();

            return $e->getMessage();
        }
    }

    public function save_requests($branch, $movie)
    {

        $bd =  $this->db->table($this->mo_request);
        $this->db->transBegin();

        $data =  [
            'branch_id' => $branch,
            'mo_request' => $movie
        ];

        try {

            if ($bd->insert($data) == true) {
                $this->db->transCommit();
                return true;
            }
        } catch (\Exception $e) {

            // throw new Exception("Error Insert user", 1);
            $this->db->transRollback();
            return $e->getMessage();
        }
    }


    public function con_ads($branch, $ads_con_name, $ads_con_email, $ads_con_line, $ads_con_tel)
    {
        // return $ads_con_name;die;

        $bd =  $this->db->table($this->mo_adscontact);
        $this->db->transBegin();

        $data =  [
            'mo_adscontact_branch_id' => $branch,
            'mo_adscontact_namesurname' => $ads_con_name,
            'mo_adscontact_email' => $ads_con_email,
            'mo_adscontact_lineid' => $ads_con_line,
            'mo_adscontact_phone' => $ads_con_tel,

        ];

        try {

            if ($bd->insert($data) == true) {
                $this->db->transCommit();
                return true;
            }
        } catch (\Exception $e) {

            // throw new Exception("Error Insert user", 1);
            $this->db->transRollback();
            return $e->getMessage();
        }
    }

    // นับจำนวนผู้ชม
    public function countView($id)
    {
        $sql = "SELECT
                    `$this->table_movie`.movie_id,
                     `$this->table_movie`.movie_thname,
                    `$this->table_movie`.movie_view
                FROM
                    $this->table_movie
                WHERE `$this->table_movie`.movie_id = '$id' ";

        $query = $this->db->query($sql);
        $data = $query->getResultArray();

        if ($data[0]['movie_view'] == 0 || empty($data[0]['movie_view'])) {

            $movie_view_add = 1;

        } else {

            $movie_view_add = $data[0]['movie_view']+1;

        }

        $builder = $this->db->table($this->table_movie);
        $builder->where('movie_id', $id);
        $this->db->transBegin();

        $dataadd =  [

            'movie_view' =>  $movie_view_add,

        ];


        try {

            if ($builder->update($dataadd) == true) {
                $this->db->transCommit();
                // return true;
            }

        } catch (\Exception $e) {

            // throw new Exception("Error Insert user", 1);
            $this->db->transRollback();
            // return $e->getMessage();

        }

        return $movie_view_add;

    }
    
}
