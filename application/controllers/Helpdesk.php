<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Helpdesk extends CI_Controller {


	public function index()
	{
		$this->load->view('helpdesk/main');
	}

	public function dashboard()
	{
		$this->load->view('helpdesk/dashboard');
	}

	public function log()
	{
		$this->load->view('helpdesk/log');
	}

	public function user()
	{
		$this->load->view('helpdesk/user');
	}


}

?>
