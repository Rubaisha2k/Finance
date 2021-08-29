<?php

class Closing_model extends CI_Model{
    public function __construct(){
        parent :: __construct();
        $this->load->database();
    }

    public function ClosingBalance($data){
        $result = $this->db->insert('ownerequity', $data);
        print_r($result);
    }
}

?>