<?php



namespace App\Models;

use CodeIgniter\Email\Email;
use CodeIgniter\Model;



class Video_Model extends Model
{

    protected $table_movie = 'mo_movie';
    protected $table_category = 'mo_category';
    protected $an_moviecate = 'mo_moviecate';
    protected $an_slide = 'mo_slide';
    protected $table_vdoads = 'mo_adsvideo';
    protected $pathAdsVideo = 'movie/adsvdo';
    protected $ads = 'ads';
    protected $report_movie = 'mo_report';
    protected $live_stream = 'mo_livestream';
    protected $setting = 'setting';
    protected $content = 'content';
    protected $an_request = 'mo_request';
    protected $seo = 'seo';
    public $backURL = "https://backend.gumovie1.com/public/";
    private $path_filelogo;

    public function __construct()
    {

        parent::__construct();
        $db = \Config\Database::connect();
        $this->path_filelogo = "logo";
    }


    public function get_path_imgads($branch_id)

    {

        $sql = "SELECT * FROM  `$this->ads` WHERE branch_id = '$branch_id'";

        $query = $this->db->query($sql);

        //echo $sql;die;

        return $query->getResultArray();
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
        //echo $sql;die;

        $query = $this->db->query($sql);
        return $query->getResultArray();
    }

    public function get_category($branch_id) // เรียก Category ตาม Branch 
    {

        $sql = "SELECT
             $this->table_category.*,$this->table_movie .movie_active
            FROM
            $this->table_category
            INNER JOIN $this->an_moviecate ON $this->an_moviecate.category_id = $this->table_category.category_id
            INNER JOIN $this->table_movie ON $this->an_moviecate.movie_id = $this->table_movie.movie_id
            WHERE
            `$this->table_category`.branch_id = ? AND $this->table_movie.movie_active = '1'
            GROUP BY $this->table_category.category_id";



        $query = $this->db->query($sql, [$branch_id]);

        
        return $query->getResultArray();
    }

    public function get_slide($branch_id) 
    {

        $sql = "SELECT
            *
            FROM
            $this->an_slide
            INNER JOIN $this->table_movie ON $this->an_slide.movie_id = $this->table_movie.movie_id
            
            WHERE
            `$this->table_movie`.branch_id = ? AND $this->table_movie.movie_active = '1'
           ";




        $query = $this->db->query($sql, [$branch_id]);
        $data =  $query->getResultArray();
        foreach ($data as $key => $val) {
            $data[$key]['cate_data'] = $this->get_category_onanime($val['movie_id']);
            $data[$key]['ep_data'] = $this->normalizeAnimetoArray($val['movie_thmain']);
            $data[$key]['ep_count']= count($data[$key]['ep_data']) ;
        }
       
        return $data;
    }

    public function get_list_video($branchid, $keyword = "", $cate_id = "", $page = 1)
    {
        $sql_where = " ";
        if ($keyword != "") {
            $sql_where = " AND `$this->table_movie`.movie_thname LIKE '%$keyword%' ";
        }

        if ($cate_id != "") {
            $sql = "SELECT
                    *
                FROM
                    $this->table_movie
                    left join $this->an_moviecate ON $this->an_moviecate.movie_id = $this->table_movie.movie_id
                WHERE
                    `$this->table_movie`.branch_id = '$branchid'
                    AND `$this->table_movie`.movie_type IN ('mo','se') 
                    AND $this->table_movie.movie_active = '1' 
                    AND $this->an_moviecate.category_id = '$cate_id' 
                     
                ORDER BY `$this->table_movie`.movie_create DESC";
        } else {

            $sql = "SELECT
                    *
                FROM
                    $this->table_movie
                WHERE
                    `$this->table_movie`.branch_id = '$branchid'
                    AND `$this->table_movie`.movie_type IN ('mo','se') 
                    AND $this->table_movie.movie_active = '1' " .
                $sql_where .
                "ORDER BY `$this->table_movie`.movie_create DESC";
        }

        $query = $this->db->query($sql);
        $total = count($query->getResultArray());
        $perpage = 30;



        // return $query->getResultArray();

        return get_pagination($sql, $page, $perpage, $total);
    }

    public function get_movie_new_recommend($branchid, $keyword = "", $page = 1)
    {

        $sql_where = " ";

        if ($keyword != "") {
            $sql_where = " AND `$this->table_movie`.movie_thname LIKE '%$keyword%' ";
        }

        $sql = "SELECT
                    *
                FROM
                    $this->table_movie
                WHERE
                    `$this->table_movie`.branch_id = '$branchid'  
                    AND `$this->table_movie`.movie_active = '1' " .
            $sql_where;

        $query = $this->db->query($sql);
        $total = count($query->getResultArray());
        $perpage = 10;

        return get_pagination($sql, $page, $perpage, $total);
    }

    //Get video 
    public function get_movie_page_video($branchid)
    {

        $sql = "SELECT
                    *
                FROM
                    $this->table_movie
                WHERE
                    `$this->table_movie`.branch_id = '$branchid' 
                    AND `$this->table_movie`.movie_active = '1' ";

        $query = $this->db->query($sql);
        return $query->getResultArray();
    }

    // Get video_movie
    public function get_video_data($id)
    {

        $sql = "SELECT
                    *
                FROM
                    `$this->table_movie`
                WHERE

                    `$this->table_movie`.movie_id = ? 
                    AND `$this->table_movie`.movie_active = '1'";



        $query = $this->db->query($sql, [$id]);
        return $query->getRowArray();
    }

    // Get video_series
    public function get_anime_data($id)
    {

        $sql = "SELECT
                    *
                FROM
                    `$this->table_movie`
                    LEFT JOIN `$this->an_moviecate` on `$this->table_movie`.movie_id = `$this->an_moviecate`.movie_id 
                WHERE
                `$this->table_movie`.movie_id =" . $id .
            " AND `$this->table_movie`.movie_active = '1'";

        $query = $this->db->query($sql);
        $data = $query->getResultArray();

        return $data[0];
    }

    public function u_decode($input)
    {
        return preg_replace_callback(
            '/\\\\u([0-9a-zA-Z]{4})/',
            function ($matches) {
                return mb_convert_encoding(pack('H*', $matches[1]), 'UTF-8', 'UTF-16');
            },
            $input
        );
    }

    public function normalizeAnimetoArray($str)
    {
        $str = $this->u_decode($str);
        $Arr = json_decode($str, true);

        $EpList = [];

        foreach ($Arr as $key => $item) {
            $EpData = [
                'NameEp' => $key,
                'EpData' => $item
            ];

            array_push($EpList, $EpData);
        }

        return $EpList;
    }

    public function get_category_onanime($id)
    {

        $sql = "SELECT
                    *
                FROM
                    an_moviecate
                INNER JOIN an_category ON an_moviecate.category_id = an_category.category_id 
                WHERE 
                    an_moviecate.movie_id = '$id' ";

        $query = $this->db->query($sql);
        $total = count($query->getResultArray());
        $data = $query->getResultArray();

        return  $data;
    }



    //แจ้งหนังเสีย
    public function save_reports($branch, $id, $reason)
    {

        $bd =  $this->db->table($this->report_movie);
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


    //ขอหนัง 
    public function save_requests($branch, $movie)
    {

        $bd =  $this->db->table($this->an_request);
        $this->db->transBegin();

        $data =  [
            'branch_id' => $branch,
            'an_request' => $movie
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

    //หนังที่น่สนใจ 2 
    public function get_video_interest($branch)
    {

        $this->db->simpleQuery('SET @@group_concat_max_len = 100000');
        $sql = "SELECT
                    an_category.category_id,
                    an_category.category_name,
                    GROUP_CONCAT(
                        mo.movie_id,
                        '{-}',
                        mo.movie_thname,
                        '{-}',
                        mo.movie_ratescore,
                        '{-}',
                        mo.movie_view,
                        '{-}',
                        mo.movie_type,
                        '{-}',
                        mo.movie_quality,
                        '{-}',
                        mo.movie_picture SEPARATOR '|'
                    ) AS movie
                FROM
                    an_category
                LEFT JOIN (
                    SELECT
                        an_movie.movie_id,
                        an_movie.movie_thname,
                        an_movie.movie_picture,
                        an_movie.movie_type,
                        an_movie.movie_quality,
                        an_movie.movie_ratescore,
                        CASE
                            WHEN an_movie.movie_view IS NULL THEN '0'
                            ELSE an_movie.movie_view
                        END AS movie_view,
                        an_moviecate.category_id
                    FROM
                        an_movie
                    INNER JOIN an_moviecate ON an_moviecate.movie_id = an_movie.movie_id
                    GROUP BY an_movie.movie_id   
                ) mo ON mo.category_id = an_category.category_id
                WHERE an_category.branch_id = '$branch' AND mo.movie_id IS NOT NULL
                GROUP BY an_category.category_id
                ORDER BY count(an_category.category_id) DESC
                LIMIT 4; ";


        $query = $this->db->query($sql);
        return $query->getResultArray();
    }
}
