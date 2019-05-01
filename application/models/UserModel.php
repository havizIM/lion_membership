<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

    function show($id_karyawan = null, $nama_user = null)
    {
      $this->db->select('*')->from('user');

      if($id_karyawan != null){
        $this->db->where('id_karyawan', $id_karyawan);
      }

      if($nama_user != null){
        $this->db->like('nama_user', $nama_user);
      }

      $this->db->where('level !=', 'Helpdesk');
      $this->db->order_by('tgl_registrasi', 'desc');
      return $this->db->get();
    }

    function add($data, $log)
    {
      $this->db->trans_start();
      $this->db->insert('user', $data);
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
      $this->db->where('id_karyawan', $param)->update('user', $data);
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
      $this->db->where('id_karyawan', $param)->delete('user');
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

    function statistic()
    {
      $this->db->select("level, COUNT('id_karyawan') as jml_user");

      $this->db->from("user");
      $this->db->where('level !=', 'Helpdesk');

      $this->db->group_by("level");
      return $this->db->get();
    }
}

?>
