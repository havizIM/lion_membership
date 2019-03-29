<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class LogModel extends CI_Model {

    function add($data)
    {
      return $this->db->insert('log', $data);
    }

    function show()
    {
      return $this->db->select('*')->from('log a')->join('user b', 'b.nip = a.user', 'left')->get();
    }

}

?>
