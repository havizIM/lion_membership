<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

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
		$this->load->view('customer/main');
	}
    
	public function home()
	{
		$this->load->view('customer/home');
	}

	public function log_poin()
	{
		$this->load->view('customer/log_poin');
	}

	public function riwayat()
	{
		$this->load->view('customer/riwayat');
	}

	public function claim()
	{
		$this->load->view('customer/claim');
	}

	public function redeem()
	{
		$this->load->view('customer/redeem');
	}

	public function profile()
	{
		$this->load->view('customer/profile');
	}
}
