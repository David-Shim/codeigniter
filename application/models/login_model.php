<?php
class Login_model extends CI_Model {
 
    function __construct(){
        parent::__construct();
    }

    function find_user_account($user_email){
        $sql = "SELECT email FROM user WHERE email =?";
        $query =$this->db->query($sql,$user_email);
        return $query->num_rows();
    }
    
    function find_all_data_by_email($user_email){
        //입력된 이메일 주소로 유저 비밀번호 가지고 와서 password_verify로 비교 후 일치하면 정보 보여주고 아니면 login페이지로 redirect
        $sql = "SELECT * FROM user WHERE email = ?";
        $query = $this->db->query($sql,$user_email);
        return $query->result_array();
    }
 
}
?>