<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class LogPoinModel extends CI_Model {

    function show($where)
    {
      $this->db->select('a.*, b.id_poin, b.departure, c.nama_rute as nama_departure, b.arrival, d.nama_rute as nama_arrival, b.claim_poin, b.redeem_poin')
               ->from('log_poin a')
               ->join('master_poin b', 'b.id_poin = a.id_poin')
               ->join('master_rute c', 'c.id_rute = b.departure')
               ->join('master_rute d', 'd.id_rute = b.arrival');

      if(!empty($where)){
        foreach($where as $key => $value){
            if($value != null){
                $this->db->where($key, $value);
            }
        }
      }

      $this->db->order_by('a.id_user_poin', 'desc');
      return $this->db->get();
    }
}

?>
