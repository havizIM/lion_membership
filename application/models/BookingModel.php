<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BookingModel extends CI_Model {

    function show($where)
    {
      $this->db->select('*')
               ->from('booking');

      if(!empty($where)){
        foreach($where as $key => $value){
            if($value != null){
                $this->db->where($key, $value);
            }
        }
      }

      return $this->db->get();
    }
}

?>
