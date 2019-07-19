<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_service extends CI_Controller {

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
		$this->load->view('customer_service/main');
	}

	public function dashboard()
	{
		$this->load->view('customer_service/dashboard');
	}

	public function point()
	{
		$this->load->view('customer_service/point');
	}

	public function claim($id = null)
	{
		if($id == null){
			$this->load->view('customer_service/claim');
		} else {
			$this->load->view('customer_service/detail_claim');
		}
	}
	
	public function member($id = null)
	{
		if($id == null){
			$this->load->view('customer_service/member');
		} else {
			$this->load->view('customer_service/detail_member');
		}
	}
	
	public function aplikasi($id = null)
	{
		if($id == null){
			$this->load->view('customer_service/aplikasi');
		} else {
			$this->load->view('customer_service/detail_aplikasi');
		}
	}

	


}
