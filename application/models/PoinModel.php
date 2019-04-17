<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PoinModel extends CI_Model {

    function show($id_poin = null, $departure = null, $arrival = null)
    {
      $this->db->select('a.*, b.nama_rute as departure_name, c.nama_rute as arrival_name')
               ->from('master_poin a')
               ->join('master_rute b', 'b.id_rute = a.departure')
               ->join('master_rute c', 'c.id_rute = a.arrival');

      if($id_poin != null){
        $this->db->where('a.id_poin', $id_poin);
      }

      if($departure != null){
        $this->db->like('b.departure', $departure);
      }

      if($arrival != null){
        $this->db->like('c.arrival', $arrival);
      }

      $this->db->order_by('a.id_poin', 'desc');
      return $this->db->get();
    }

    function add($data, $log)
    {
      $this->db->trans_start();
      $this->db->insert('master_poin', $data);
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
      $this->db->where('id_poin', $param)->update('master_poin', $data);
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
      $this->db->where('id_poin', $param)->delete('master_poin');
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
