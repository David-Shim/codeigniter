<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class board_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function get_data($page_number){
        $page_number = ($page_number-1)*10;
        $query = $this->db->query("SELECT * FROM notice_board ORDER BY notice_id DESC LIMIT ".$page_number.", 10");
        return $query->result_array();
    }

    function pagination($page_number){
        $start_number = $page_number;
        $begin_number = ($start_number*10)-9;
        $query = $this->db->query("SELECT * FROM notice_board ORDER BY notice_id DESC LIMIT ".$begin_number.", 50");
        $last_number = $query->num_rows();
        $last_number = $last_number/10;
        $last_number = ceil($last_number);
        $last_number = $last_number-1;
        if($last_number>-1){
            $result['start_number'] = $start_number;
            $result['last_number'] = $last_number;
        }else{
            $result['start_number'] = $start_number;
            $result['last_number'] = 0;
        }
        return $result;
    }

    function upload_content($user_id,$user_full_name,$content_title,$content,$db_table){
        $now = date("Y-m-d H:i:s");
        $data = array(
            'user_id'=>$user_id,
            'user_full_name'=>$user_full_name,
            'notice_title'=>$content_title,
            'main_contents'=>$content,
            'reg_date'=>$now
        );
        $this->db->insert($db_table,$data);
    }

    function upload_reply($notice_id, $user_id, $first_name, $reply_content){
        $now = date("Y-m-d H:i:s");
        $data = array(
            'notice_id'=>$notice_id,
            'user_id'=>$user_id,
            'first_name'=>$first_name,
            'reply_content'=>$reply_content,
            'reg_date'=>$now
        );
        $this->db->insert('reply',$data);
    }

    function upload_re_reply($notice_id, $reply_id, $user_id, $first_name, $content,$reg_date){
        $data = array(
            'notice_id'=>$notice_id,
            'reply_id'=>$reply_id,
            'user_id'=>$user_id,
            'first_name'=>$first_name,
            'content'=>$content,
            'reg_date'=>$reg_date
        );
        $this->db->insert('re_reply',$data);
    }

    function get_details($notice_id){
        $get_content = $this->db->query("SELECT * FROM notice_board WHERE notice_id =".$notice_id);
        $all_data['content'] = $get_content->result_array();
        $get_replies = $this->db->query("SELECT * FROM reply WHERE notice_id =".$notice_id);
        $all_data['replies'] = $get_replies->result_array();
        $get_re_replies = $this->db->query("SELECT * FROM re_reply WHERE notice_id =".$notice_id);
        $all_data['re_replies'] = $get_re_replies->result_array();
        return $all_data;
    }

    function get_replies($notice_id){
        $query = $this->db->query("SELECT * FROM reply WHERE notice_id =".$notice_id);
        return $query->result_array();
    }

    function get_re_replies($notice_id){
        $query = $this->db->query("SELECT * FROM re_reply WHERE notice_id =".$notice_id);
        return $query->result_array();
    }
}
?>