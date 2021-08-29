<?php

class Entry_model extends CI_Model{
    public function __construct(){
        parent :: __construct();
        $this->load->database();
        $this->load->dbforge();
      }
    public function get_all(){
        $this->db->select('debit_info, credit_info, debit_amount, credit_amount, entry_date, description');
        $this->db->where('month_entry', date('m-Y'));
        $response = $this->db->get('journal_entries');
        $response = $response->result_array();
        return $response;
    }
    public function get_types(){
    $this->db->select('type_id, type_name');
    $response = $this->db->get('type');
    $response = $response->result_array();
    return $response;
}
    public function add_data($data){
        $data['month_entry'] = date('m-Y');
        $this->db->insert('journal_entries', $data);
        $response = $this->db->insert_id();
        return $response;
        }
    public function add_type($type){
        $this->db->insert('type', $type);
    }
    public function create_table_debit($debit_info, $damount){
        if($this->db->table_exists($debit_info)){
            $data['debit'] = $damount;
            $this->db->insert($debit_info , $data);
        }
        else{
        $fields = array(
            'id' => array(
                'type' => "INT",
                'constraint' => 11,
                'auto_increment' => true,
                'unsigned' => true
            ),
            'debit' => array(
                'type' => "INT",
                'constraint' => 100
            ),
            'credit' => array(
                'type' => "INT",
                'constraint' => 100
            ),
            'month_entry' => array(
                'type' => "VARCHAR",
                'constraint' => 20,
                'default' => date('m-Y')
            )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('id' , true);
        $this->dbforge->create_table($debit_info);
        $data['debit'] = $damount;
        $this->db->insert($debit_info , $data);
    }
        return 1;
    }
    public function create_table_credit($credit_info, $camount){
        if($this->db->table_exists($credit_info)){
            $data['credit'] = $camount;
            $this->db->insert($credit_info , $data);
        }
        else{
        $fields = array(
            'id' => array(
                'type' => "INT",
                'constraint' => 11,
                'auto_increment' => true,
                'unsigned' => true
            ),
            'debit' => array(
                'type' => "INT",
                'constraint' => 100
            ),
            'credit' => array(
                'type' => "INT",
                'constraint' => 100
            ),
            'month_entry' => array(
                'type' => "VARCHAR",
                'constraint' => 50,
                'default' => date('m-Y')
            )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('id' , true);
        $this->dbforge->create_table($credit_info);
        $data['credit'] = $camount;
        $this->db->insert($credit_info , $data);
    }
        return 1;
    }
}
?>