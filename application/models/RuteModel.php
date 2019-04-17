<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class RuteModel extends CI_Model {

    function show($id_rute = null, $nama_rute = null)
    {
      $this->db->select('*')->from('master_rute');

      if($id_rute != null){
        $this->db->where('id_rute', $id_rute);
      }

      if($nama_rute != null){
        $this->db->like('nama_rute', $nama_rute);
      }

      $this->db->order_by('id_rute', 'desc');
      return $this->db->get();
    }

    function add($data, $log)
    {
      $this->db->trans_start();
      $this->db->insert('master_rute', $data);
      $this->db->insert('log', $log);
      $this->db->trans_complete();

      if ($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return false;
      } else {
        $this->db->trans_commit();
        return true;
      }
    }

    function edit($param, $data, $log)
    {
      $this->db->trans_start();
      $this->db->where('id_rute', $param)->update('master_rute', $data);
      $this->db->insert('log', $log);
      $this->db->trans_complete();

      if ($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return false;
      } else {
        $this->db->trans_commit();
        return true;
      }
    }

    function delete($param, $log)
    {
      $this->db->trans_start();
      $this->db->where('id_rute', $param)->delete('master_rute');
      $this->db->insert('log', $log);
      $this->db->trans_complete();

      if ($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return false;
      } else {
        $this->db->trans_commit();
        return true;
      }
    }

}

?>
