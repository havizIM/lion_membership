<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends CI_Controller {

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
		$this->load->view('manager/main');
	}

	public function dashboard()
	{
		$this->load->view('manager/dashboard');
	}

	public function point()
	{
		$this->load->view('manager/point');
	}

	public function laporan_member()
	{
		$this->load->view('manager/laporan_member');
	}

	public function laporan_claim()
	{
		$this->load->view('manager/laporan_claim');
	}

	public function laporan_redeem()
	{
		$this->load->view('manager/laporan_redeem');
	}

	public function member($id = null)
	{
		if($id == null){
			$this->load->view('manager/member');
		} else {
			$this->load->view('manager/detail_member');
		}
	}
	
}
