<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mement_model extends CI_Model {
    function __construct(){
        parent::__construct();
    }
    
    function insert_data($data){
        $this->db->insert("notice_board",$data);
    }

    function load_data(){
        $query = $this->db->query("SELECT * FROM notice_board");
        return $query->result_array();
    }
}
?>