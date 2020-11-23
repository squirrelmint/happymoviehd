<?php

namespace App\Controllers;

use App\Models\Video_Model;

class Home extends BaseController
{

	protected $base_backurl;
	public $path_setting = "";
	public $path_ads = "";
	public $branch = 1;
	public $backURL = "https://backend.movielive88.com/";
	public $document_root = '';
	public $path_thumbnail = "https://anime.vip-streaming.com/";
	public $path_slide = "";

	public function __construct()
	{
		$this->config = new \Config\App();
		$this->validation =  \Config\Services::validation();
		$this->session = \Config\Services::session();
		$this->VideoModel = new Video_Model();
		$this->document_root = $this->config->docURL;
		$this->branch = 1;

		// Directory
		$this->path_ads = $this->backURL . 'banners/';
		$this->path_setting = $this->backURL . 'setting/';
		$this->path_slide = $this->backURL . 'img_slide/';

		helper(['url', 'pagination', 'dateformat']);
	}

	public function index()
	{
		$setting = $this->VideoModel->get_setting($this->branch);
		$setting['setting_img'] = $this->path_setting . $setting['setting_logo'];

		$list_category = $this->VideoModel->get_category($this->branch);

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
			'list_category' => $list_category,
			'chk_act' => $chk_act,
			'setting' => $setting
		];

		$list = $this->VideoModel->get_list_video($this->branch);
		$adsbottom = $this->VideoModel->get_adsbottom($this->branch);

		$body_data = [
			'url_loadmore' => base_url('moviedata'),
			'path_thumbnail' => $this->path_thumbnail,
			'list' => $list,
			'adsbottom' => $adsbottom,
			'path_ads' => $this->path_ads,
		];


		echo view('templates/header.php', $header_data);
		echo view('index.php', $body_data);
		echo view('templates/footer.php');
	}

	public function video($id, $Name)
	{
		$setting = $this->VideoModel->get_setting($this->branch);
		$seo = $this->VideoModel->get_seo($this->branch);
		$videodata = $this->VideoModel->get_id_video($id);
		$videinterest = $this->VideoModel->get_video_interest($this->branch);
		$adstop = $this->VideoModel->get_adstop($this->branch);
		$adsbottom = $this->VideoModel->get_adsbottom($this->branch);

		$list_category = $this->VideoModel->get_category($this->branch);
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
			'list_category' => $list_category,
			'chk_act' => $chk_act,
		];

		$body_data = [
			'url_loadmore' => base_url('moviedata') ,
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
		echo view('video.php', $body_data);
		echo view('templates/footer.php');
	}

	public function series($id, $Name, $index = 0, $epname = '')
	{
		$setting = $this->VideoModel->get_setting($this->branch);
		$seo = $this->VideoModel->get_seo($this->branch);
		$series = $this->VideoModel->get_ep_series($id);
		$videinterest = $this->VideoModel->get_video_interest($this->branch);
		$adstop = $this->VideoModel->get_adstop($this->branch);
		$adsbottom = $this->VideoModel->get_adsbottom($this->branch);

		if($epname==''){
			$lastep = count($series['epdata']);
			$index = $lastep-1;
		}

		$list_category = $this->VideoModel->get_category($this->branch);
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
		echo view('video.php', $body_data);
		echo view('templates/footer.php');
	}

	public function moviedata()
	{
		$list = $this->VideoModel->get_list_video($this->branch, '', $_GET['page']);

		$header_data = [
			'document_root' => $this->document_root,
			'path_thumbnail' => $this->path_thumbnail,
			'list' => $list
		];

		echo view('moviedata.php', $header_data);
	}

	public function moviedata_search()
	{
		$list = $this->VideoModel->get_list_video($this->branch, $_GET['keyword'], $_GET['page']);

		$header_data = [
			'document_root' => $this->document_root,
			'path_thumbnail' => $this->path_thumbnail,
			'list' => $list,

		];
		echo view('moviedata.php', $header_data);
	}

	public function moviedata_category()
	{
		$list = $this->VideoModel->get_id_video_bycategory($this->branch, $_GET['keyword'], $_GET['page']);

		$header_data = [
			'document_root' => $this->document_root,
			'path_thumbnail' => $this->path_thumbnail,
			'list' => $list,
		];

		echo view('moviedata.php', $header_data);
	}

	public function categorylist() //ต้นแบบ หน้า cate / search
	{
		$setting = $this->VideoModel->get_setting($this->branch);
		$setting['setting_img'] = $this->path_setting . $setting['setting_logo'];

		$chk_act = [
			'home' => '',
			'poppular' => '',
			'newmovie' => '',
			'netflix' => '',
			'category' => 'active',
			'contract' => ''
		];

		$header_data = [
			'document_root' => $this->document_root,
			'path_setting' => $this->path_setting,
			'setting' => $setting,
			'path_thumbnail' => $this->path_thumbnail,
			'chk_act' => $chk_act,
		];

		$list_category = $this->VideoModel->get_category($this->branch);

		$body_data = [
			'list_category' => $list_category
		];


		echo view('templates/header.php', $header_data);
		echo view('category.php', $body_data);
		echo view('templates/footer.php');
	}

	public function popular() //ต้นแบบ หน้า cate / search
	{
		$setting = $this->VideoModel->get_setting($this->branch);
		$setting['setting_img'] = $this->path_setting . $setting['setting_logo'];

		$list_category = $this->VideoModel->get_category($this->branch);
		$list = $this->VideoModel->get_list_popular($this->branch);
		$adsbottom = $this->VideoModel->get_adsbottom($this->branch);

		$chk_act = [
			'home' => '',
			'poppular' => 'active',
			'newmovie' => '',
			'netflix' => '',
			'category' => '',
			'contract' => ''
		];

		$header_data = [
			'document_root' => $this->document_root,
			'path_thumbnail' => $this->path_thumbnail,
			'path_slide' => $this->path_slide,
			'path_setting' => $this->path_setting,
			'setting' => $setting,
			'chk_act' => $chk_act,
			'list_category' => $list_category,
			'list' => $list,
			'adsbottom' => $adsbottom,
			'path_ads' => $this->path_ads,
		];

		echo view('templates/header.php', $header_data);
		echo view('popular.php');
		echo view('templates/footer.php');
	}

	public function search($keyword)
	{
		$setting = $this->VideoModel->get_setting($this->branch);
		$setting['setting_img'] = $this->path_setting . $setting['setting_logo'];

		$list = array() ;
		$keyword = urldecode(str_replace("'","\'",$keyword));
		$list = $this->VideoModel->get_list_video($this->branch,  $keyword, '1');
		$adsbottom = $this->VideoModel->get_adsbottom($this->branch);
		$list_category = $this->VideoModel->get_category($this->branch);

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
			'list_category' => $list_category,
			'keyword' => $keyword,
			'chk_act' => $chk_act,
		];

		$body_data = [
			'url_loadmore' => base_url('moviedata_search'),
			'path_thumbnail' => $this->path_thumbnail,
			'list' => $list,
			'adsbottom' => $adsbottom,
			'path_ads' => $this->path_ads,
		];

		echo view('templates/header.php', $header_data);
		echo view('list.php', $body_data);
		echo view('templates/footer.php');
	}

	public function category($cate_id, $cate_name)
	{

		$setting = $this->VideoModel->get_setting($this->branch);
		$setting['setting_img'] = $this->path_setting . $setting['setting_logo'];

		$list = $this->VideoModel->get_id_video_bycategory($this->branch, $cate_id, 1);
		$adsbottom = $this->VideoModel->get_adsbottom($this->branch);
		$list_category = $this->VideoModel->get_category($this->branch);
		
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
			'list_category' => $list_category,
			'chk_act' => $chk_act,
		];

		$body_data = [
			'cate_name' => urldecode($cate_name),
			'keyword' => $cate_id,
			'url_loadmore' => base_url('moviedata_category'),
			'path_thumbnail' => $this->path_thumbnail,
			'list' => $list,
			'adsbottom' => $adsbottom,
			'path_ads' => $this->path_ads,
			'path_ads' => $this->path_ads,

		];

		echo view('templates/header.php', $header_data);
		echo view('list.php', $body_data);
		echo view('templates/footer.php');
	}

	public function contract() //ต้นแบบ หน้า cate / search
	{
		$setting = $this->VideoModel->get_setting($this->branch);
		$setting['setting_img'] = $this->path_setting . $setting['setting_logo'];

		$list_category = $this->VideoModel->get_category($this->branch);
		$adsbottom = $this->VideoModel->get_adsbottom($this->branch);

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
		];

		echo view('templates/header.php', $header_data);
		echo view('contract.php');
		echo view('templates/footer.php');
	}

	public function player($id, $index)
	{
		$video_data = $this->VideoModel->get_id_video($id);
		$series = $this->VideoModel->get_ep_series($id);
		$adsvideo = $this->VideoModel->get_adsvideolist($this->backURL);
		// echo '<pre>' . print_r($anime, true) . '</pre>';
		// 		die;
		$playerUrl =$video_data['movie_thmain'];

		if ($index != "a") {
			$playerUrl =$series['epdata'][$index] ;
		}

		$data = [
			'document_root' => $this->document_root,
			'branch' 		=> $this->branch,
			'backUrl' 		=> $this->backURL,
			'adsvideo'		=> $adsvideo,
			'playerUrl' 	=> $playerUrl
		];

		echo view('player.php', $data);
	}

	public function countView($id)
	{
		$this->VideoModel->countView($id);
	}

	public function save_requests()
	{
		$request_text = $_POST['request_text'];

		$this->VideoModel->save_requests($this->branch, $request_text);
	}

	public function con_ads()
	{
		$ads_con_name = $_POST['ads_con_name'];
		$ads_con_email = $_POST['ads_con_email'];
		$ads_con_line = $_POST['ads_con_line'];
		$ads_con_tel = $_POST['ads_con_tel'];

		// print_r($_POST);
		// die;
		$this->VideoModel->con_ads($this->branch, $ads_con_name, $ads_con_email, $ads_con_line, $ads_con_tel);
	}
	
}
