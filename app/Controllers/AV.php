<?php namespace App\Controllers;
use App\Models\Video_Model;
use App\Models\Av_Model;

class Av extends BaseController
{

	protected $base_backurl;
	public $path_setting = "";
	public $path_ads = "";
	public $branch = 1;
	public $backURL = "https://backend.movielive88.com/public/";
	public $document_root = '';
	public $path_thumbnail = "https://anime.vip-streaming.com/";
	public $path_slide = "";

	public function __construct()
	{
		$this->config = new \Config\App();
		$this->validation =  \Config\Services::validation();
		$this->session = \Config\Services::session();
		$this->VideoModel = new Video_Model();
		$this->AvModel = new Av_Model();
		$this->document_root = $this->config->docURL;
		$this->moviebranch = 1;
		$this->avbranch = 2;

		// Directory
		$this->path_ads = $this->backURL . 'banners/';
		$this->path_setting = $this->backURL . 'setting/';
		$this->path_slide = $this->backURL . 'img_slide/';

		helper(['url', 'pagination', 'dateformat']);
	}

	public function index()
	{
		$setting = $this->VideoModel->get_setting($this->avbranch);
		$setting['setting_img'] = $this->path_setting . $setting['setting_logo'];

		$movie_category = $this->VideoModel->get_category($this->moviebranch);
		$av_category = $this->AvModel->get_category($this->avbranch, 'av');

		$chk_act = [
			'home' => 'active',
			'poppular' => '',
			'newmovie' => '',
			'netflix' => '',
			'category' => '',
			'contract' => ''
		];

		$header_data = [
			'document_root' => $this->document_root,
			'path_setting' => $this->path_setting,
			'movie_category' => $movie_category,
			'av_category' => $av_category,
			'chk_act' => $chk_act,
			'setting' => $setting,
			'urlsearch' => '/av/search/',
		];

		$list = $this->AvModel->get_list_video($this->avbranch);
		$popular = $this->AvModel->get_list_popular($this->avbranch);
		$adstop = $this->AvModel->get_adstop($this->avbranch);
		$adsbottom = $this->AvModel->get_adsbottom($this->avbranch);

		$body_data = [
			'url_loadmore' => base_url('av/moviedata'),
			'path_thumbnail' => $this->path_thumbnail,
			'list' => $list,
			'popular' => $popular,
			'adstop' => $adstop,
			'adsbottom' => $adsbottom,
			'path_ads' => $this->path_ads,
		];


		echo view('templates/header.php', $header_data);
		echo view('av/header.php');
		echo view('av/index.php', $body_data);
		echo view('av/footer.php');
		echo view('templates/footer.php');
	}

	public function video($id, $Name)
	{
		$setting = $this->AvModel->get_setting($this->avbranch);
		$seo = $this->AvModel->get_seo($this->avbranch);
		$videodata = $this->AvModel->get_id_video($id);
		$videinterest = $this->AvModel->get_video_interest($this->avbranch);
		$adstop = $this->AvModel->get_adstop($this->avbranch);
		$adsbottom = $this->AvModel->get_adsbottom($this->avbranch);

		$movie_category = $this->VideoModel->get_category($this->moviebranch);
		$av_category = $this->AvModel->get_category($this->avbranch, 'av');
		$date = get_date($videodata['movie_create']);

		$setting['setting_img'] = $this->path_setting . $setting['setting_logo'];

		if( $seo ){

			if(substr($videodata['movie_picture'], 0, 4) == 'http'){
				$movie_picture = $videodata['movie_picture'];
			}else{
				$movie_picture = $this->path_thumbnail . $videodata['movie_picture'];
			}

			$setting['setting_img'] = $movie_picture; 
			$setting['setting_description'] = str_replace("{movie_description}", $videodata['movie_des'], $seo['seo_description']);
			$setting['setting_title'] = str_replace("{movie_title} - {title_web}", $videodata['movie_thname'] . " - " . $setting['setting_title'], $seo['seo_title']);
		}

		$chk_act = [
			'home' => 'active',
			'poppular' => '',
			'newmovie' => '',
			'netflix' => '',
			'category' => ''
		];

		$header_data = [
			'document_root' => $this->document_root,
			'path_setting' => $this->path_setting,
			'setting' => $setting,
			'movie_category' => $movie_category,
			'av_category' => $av_category,
			'chk_act' => $chk_act,
			'urlsearch' => '/av/search/',
		];

		$body_data = [
			'url_loadmore' => base_url('av/moviedata') ,
			'path_thumbnail' => $this->path_thumbnail,
			'videodata' => $videodata,
			'videinterest' => $videinterest,
			'adstop' => $adstop,
			'adsbottom' => $adsbottom,
			'path_ads' => $this->path_ads,
			'DateEng' => $date['DateEng'],
			'feildplay' => 'movie_thmain',
			'index' => 'a',
		];

		echo view('templates/header.php', $header_data);
		echo view('av/header.php');
		echo view('av/video.php', $body_data);
		echo view('av/footer.php');
		echo view('templates/footer.php');
	}

	public function series($id, $Name, $index = 0, $epname = '')
	{
		$setting = $this->VideoModel->get_setting($this->moviebranch);
		$seo = $this->VideoModel->get_seo($this->moviebranch);
		$series = $this->VideoModel->get_ep_series($id);
		$videinterest = $this->VideoModel->get_video_interest($this->moviebranch);
		$adstop = $this->VideoModel->get_adstop($this->moviebranch);
		$adsbottom = $this->VideoModel->get_adsbottom($this->moviebranch);

		if($epname==''){
			$lastep = count($series['epdata']);
			$index = $lastep-1;
		}

		$list_category = $this->VideoModel->get_category($this->moviebranch);
		$date = get_date($series['movie_create']);

		$setting['setting_img'] = $this->path_setting . $setting['setting_logo'];

		if( $seo ){

			if(substr($series['movie_picture'], 0, 4) == 'http'){
				$movie_picture = $series['movie_picture'];
			}else{
				$movie_picture = $this->path_thumbnail . $vidserieseodata['movie_picture'];
			}

			$setting['setting_img'] = $movie_picture; 
			$setting['setting_description'] = str_replace("{movie_description}", $series['movie_des'], $seo['seo_description']);
			$setting['setting_title'] = str_replace("{movie_title} - {title_web}", $series['movie_thname'] . " - " . $setting['setting_title'], $seo['seo_title']);
		}

		
		$chk_act = [
			'home' => 'active',
			'poppular' => '',
			'newmovie' => '',
			'netflix' => '',
			'category' => ''
		];

		$header_data = [
			'document_root' => $this->document_root,
			'path_setting' => $this->path_setting,
			'setting' => $setting,
			'list_category' => $list_category,
			'chk_act' => $chk_act,
		];

		$body_data = [
			'url_loadmore' => base_url('moviedata') ,
			'path_thumbnail' => $this->path_thumbnail,
			'videodata' => $series,
			'adstop' => $adstop,
			'adsbottom' => $adsbottom,
			'path_ads' => $this->path_ads,
			'DateEng' => $date['DateEng'],
			'feildplay' => 'movie_thmain',
			'index' => $index,
			'videinterest' => $videinterest
		];

		echo view('templates/header.php', $header_data);
		echo view('av/header.php');
		echo view('av/video.php', $body_data);
		echo view('av/footer.php');
		echo view('templates/footer.php');
	}

	public function moviedata()
	{
		$list = $this->AvModel->get_list_video($this->avbranch, '', $_GET['page']);

		$header_data = [
			'document_root' => $this->document_root,
			'path_thumbnail' => $this->path_thumbnail,
			'list' => $list
		];

		echo view('av/moviedata.php', $header_data);
	}

	public function moviedata_search()
	{
		$list = $this->AvModel->get_list_video($this->avbranch, $_GET['keyword'], $_GET['page']);

		$header_data = [
			'document_root' => $this->document_root,
			'path_thumbnail' => $this->path_thumbnail,
			'list' => $list,

		];
		echo view('av/moviedata.php', $header_data);
	}

	public function moviedata_category()
	{
		$list = $this->AvModel->get_id_video_bycategory($this->avbranch, $_GET['keyword'], $_GET['page']);

		$header_data = [
			'document_root' => $this->document_root,
			'path_thumbnail' => $this->path_thumbnail,
			'list' => $list,
		];

		echo view('av/moviedata.php', $header_data);
	}

	public function search($keyword)
	{
		$setting = $this->AvModel->get_setting($this->avbranch);
		$setting['setting_img'] = $this->path_setting . $setting['setting_logo'];

		$list = array() ;
		$keyword = urldecode(str_replace("'","\'",$keyword));
		$list = $this->AvModel->get_list_video($this->avbranch,  $keyword, '1');
		$adsbottom = $this->AvModel->get_adsbottom($this->avbranch);
		$movie_category = $this->VideoModel->get_category($this->moviebranch);
		$av_category = $this->AvModel->get_category($this->avbranch, 'av');

		$chk_act = [
			'home' => 'active',
			'poppular' => '',
			'newmovie' => '',
			'netflix' => '',
			'category' => '',
			'contract' => ''
		];

		$header_data = [
			'document_root' => $this->document_root,
			'path_setting' => $this->path_setting,
			'setting' => $setting,
			'movie_category' => $movie_category,
			'av_category' => $av_category,
			'keyword' => $keyword,
			'chk_act' => $chk_act,
			'urlsearch' => '/av/search/',
		];

		$body_data = [
			'url_loadmore' => base_url('av/moviedata_search'),
			'path_thumbnail' => $this->path_thumbnail,
			'list' => $list,
			'adsbottom' => $adsbottom,
			'path_ads' => $this->path_ads,
		];

		echo view('templates/header.php', $header_data);
		echo view('av/header.php');
		echo view('av/list.php', $body_data);
		echo view('av/footer.php');
		echo view('templates/footer.php');
	}

	public function category($cate_id, $cate_name)
	{

		$setting = $this->AvModel->get_setting($this->avbranch);
		$setting['setting_img'] = $this->path_setting . $setting['setting_logo'];

		$list = $this->AvModel->get_id_video_bycategory($this->avbranch, $cate_id, 1);
		$adsbottom = $this->AvModel->get_adsbottom($this->avbranch);
		$movie_category = $this->VideoModel->get_category($this->moviebranch);
		$av_category = $this->AvModel->get_category($this->avbranch, 'av');
		
		$chk_act = [
			'home' => '',
			'poppular' => '',
			'newmovie' => '',
			'netflix' => '',
			'category' => 'active',
			'contract' => ''
		];

		if($cate_id == '28'){
			$chk_act = [
				'home' => '',
				'poppular' => '',
				'newmovie' => '',
				'netflix' => 'active',
				'category' => '',
				'contract' => ''
			];
		}

		$header_data = [
			'document_root' => $this->document_root,
			'path_setting' => $this->path_setting,
			'setting' => $setting,
			'movie_category' => $movie_category,
			'av_category' => $av_category,
			'chk_act' => $chk_act,
			'urlsearch' => '/av/search/'
		];

		$body_data = [
			'cate_name' => urldecode($cate_name),
			'keyword' => $cate_id,
			'url_loadmore' => base_url('/av/moviedata_category'),
			'path_thumbnail' => $this->path_thumbnail,
			'list' => $list,
			'adsbottom' => $adsbottom,
			'path_ads' => $this->path_ads,
			'path_ads' => $this->path_ads,

		];

		echo view('templates/header.php', $header_data);
		echo view('av/header.php');
		echo view('av/list.php', $body_data);
		echo view('av/footer.php');
		echo view('templates/footer.php');
	}

	public function contract() //ต้นแบบ หน้า cate / search
	{
		$setting = $this->VideoModel->get_setting($this->moviebranch);
		$setting['setting_img'] = $this->path_setting . $setting['setting_logo'];

		$list_category = $this->VideoModel->get_category($this->moviebranch);
		$adsbottom = $this->VideoModel->get_adsbottom($this->moviebranch);

		$chk_act = [
			'home' => '',
			'poppular' => '',
			'newmovie' => '',
			'netflix' => '',
			'category' => '',
			'contract' => 'active'
		];

		$header_data = [
			'document_root' => $this->document_root,
			'path_thumbnail' => $this->path_thumbnail,
			'path_setting' => $this->path_setting,
			'setting' => $setting,
			'chk_act' => $chk_act,
			'list_category' => $list_category,
			'adsbottom' => $adsbottom,
			'path_ads' => $this->path_ads,
			'urlsearch' => '/av/search/'
		];

		echo view('templates/header.php', $header_data);
		echo view('av/header.php');
		echo view('av/contract.php');
		echo view('av/footer.php');
		echo view('templates/footer.php');
	}

	public function player($id, $index)
	{
		$video_data = $this->AvModel->get_id_video($id);
		$adsvideo = $this->AvModel->get_adsvideolist($this->backURL);
		$playerUrl =$video_data['movie_ensub1'];

		$data = [
			'document_root' => $this->document_root,
			'branch' 		=> $this->avbranch,
			'backUrl' 		=> $this->backURL,
			'adsvideo'		=> $adsvideo,
			'playerUrl' 	=> $playerUrl
		];

		echo view('av/player.php', $data);
	}

	public function countView($id)
	{
		$this->VideoModel->countView($id);
	}

	public function save_requests()
	{
		$request_text = $_POST['request_text'];

		$this->VideoModel->save_requests($this->moviebranch, $request_text);
	}

	public function con_ads()
	{
		$ads_con_name = $_POST['ads_con_name'];
		$ads_con_email = $_POST['ads_con_email'];
		$ads_con_line = $_POST['ads_con_line'];
		$ads_con_tel = $_POST['ads_con_tel'];

		// print_r($_POST);
		// die;
		$this->VideoModel->con_ads($this->moviebranch, $ads_con_name, $ads_con_email, $ads_con_line, $ads_con_tel);
	}
	
}
