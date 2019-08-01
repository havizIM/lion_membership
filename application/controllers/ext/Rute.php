<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

class Rute extends CI_Controller {

  function __construct(){
    parent::__construct();

    $this->options = array(
      'cluster' => 'ap1',
      'useTLS' => true
    );
    $this->pusher = new Pusher\Pusher(
      '9e635b2377fe901b86c3',
      '5a3cbd48fcd0cc669b54',
      '744014',
      $this->options
    );

    $this->load->model('RuteModel');
  }

  function show($token = null){
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method != 'GET') {
      json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Metode request salah'));
		} else {

      if($token == null){
        json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Request tidak terotorisasi'));
      } else {
        $param  = array('token' => $token);
        $auth   = $this->AuthModel->cekAuthMember($param);

        if($auth->num_rows() != 1){
          json_output(401, array('status' => 401, 'description' => 'Gagal', 'message' => 'Token tidak dikenali'));
        } else {

          $otorisasi  = $auth->row();
          $id_rute    = $this->input->get('id_rute');
          $nama_rute  = $this->input->get('nama_rute');

          $show  = $this->RuteModel->show($id_rute, $nama_rute);
          $rute  = array();

          foreach($show->result() as $key){
            $json = array();

            $json['id_rute']        = $key->id_rute;
            $json['nama_rute']      = $key->nama_rute;

            $rute[] = $json;
          }

          json_output(200, array('status' => 200, 'description' => 'Berhasil', 'data' => $rute));

        }
      }
    }
  }

}

?>
