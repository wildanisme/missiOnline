<?php
/*
-- ---------------------------------------------------------------
-- SWARAKALIBATA Ci CMS
-- CREATED BY : ROBBY PRIHANDAYA
-- COPYRIGHT  : Copyright (c) 2018 - 2019, PHPMU.COM. (https://phpmu.com/)
-- LICENSE    : http://opensource.org/licenses/MIT  MIT License
-- CREATED ON : 2019-03-26
-- UPDATED ON : 2019-11-18
-- ---------------------------------------------------------------
*/
defined('BASEPATH') or exit('No direct script access allowed');
class News extends CI_Controller
{
	private $page = null;
	private $params = null;

	public function __construct()
	{
		parent::__construct();
		$this->page = $this->uri->segment(1);
		$this->reroute();
	}

	public function _remap($page, $params = array())
	{
		if (count($params) > 0) {
			if (strlen($params[0]) > 0) {
				$this->params = $params;
			}
		}

		if ($this->params) {
			$method = strtolower(trim($this->params[0]));
			if (method_exists($this, $method)) {
				return call_user_func_array(array($this, $method), $this->params);
			} else {
				$this->index();
			}
		} else {
			$this->index();
		}
	}

	function index($id = null)
	{
		$query = $this->model_utama->view_join_two('tulisan', 'users', 'kategori', 'username', 'id_kategori', array('judul_seo' => $this->uri->segment(1)), 'id_tulisan', 'DESC', 0, 1);
		if ($query->num_rows() <= 0) {
			redirect('main');
		} else {
			$row = $query->row_array();
			$data['title'] = cetak($row['judul']);
			$data['description'] = cetak_meta($row['isi_tulisan'], 0, 500);
			$data['keywords'] = cetak($row['tag']);
			$data['rows'] = $row;

			$dataa = array('dibaca' => $row['dibaca'] + 1);
			$where = array('id_tulisan' => $row['id_tulisan']);
			$this->model_utama->update('tulisan', $dataa, $where);

			$this->load->helper('captcha');
			$vals = array(
				'img_path'	 => './captcha/',
				'img_url'	 => base_url() . 'captcha/',
				'font_size'     => 17,
				'img_width'	 => '150',
				'img_height' => 30,
				'border' => 0,
				'word_length'   => 5,
				'expiration' => 7200
			);

			$cap = create_captcha($vals);
			$data['image'] = $cap['image'];
			$this->session->set_userdata('mycaptcha', $cap['word']);
			$this->template->load(template() . '/template', template() . '/detailtulisan', $data);
		}
	}

	private function reroute()
	{
		/**
		 * if the route starts with this classes name (ie. "page")
		 * then reroute without the class prefix ...
		 **/
		if ($this->page == $this->router->class) {
			if ($this->uri->total_segments() > 1) {
				$this->load->helper('url');
				/** 
				 * parse the uri string and remove the "page/" portion
				 **/
				$uri = substr($this->uri->uri_string, strlen($this->page) + 1);
				redirect($uri);
			} else {
				$this->noroute($this->page);
			}
		}
	}
}