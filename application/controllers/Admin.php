<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('admin/main');
	}

	public function dashboard()
	{
		$this->load->view('admin/dashboard');
	}

	public function rute()
	{
		$this->load->view('admin/rute');
	}

	public function point()
	{
		$this->load->view('admin/point');
	}

	public function add_point()
	{
		$this->load->view('admin/add_point');
	}

	public function edit_point($id)
	{
		$this->load->view('admin/edit_point');
	}

	// public function application()
	// {
	// 	$this->load->view('admin/aplikasi');
	// }

	public function aplikasi($id = null)
	{
		if($id == null){
			$this->load->view('admin/aplikasi');
		} else {
			$this->load->view('admin/detail_aplikasi');
		}
	}
	
	public function member($id = null)
	{
		if($id == null){
			$this->load->view('admin/member');
		} else {
			$this->load->view('admin/detail_member');
		}
	}

}
