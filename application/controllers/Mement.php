<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mement extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library(array('form_validation','session'));
        date_default_timezone_set('Asia/Seoul');
    }

    public function index(){
        $this->load->model("mement_model");
        $this->load->view('templates/header');
        $this->load->view('nav_bar_before_login');
        $this->load->view('index');
        $this->load->view('templates/footer');
    }

    public function login(){
        $user_email= trim($this->input->post('user_email'));
        $user_password= trim($this->input->post('user_password'));
        $this->load->model("login_model");
        //등록된 이메일주소가 있는지
        $find_user_account = $this->login_model->find_user_account($user_email);
        if($find_user_account==0){
            redirect('http://localhost/codeigniter/mement/signin');
        }

        //이메일이 있으면 비밀번호가 맞는지
        $user_information = $this->login_model->find_all_data_by_email($user_email);
        $saved_user_password = $user_information[0]['user_password'];
        if(password_verify($user_password,$saved_user_password)){
            //비밀번호 일치 할때
            $user = array(
                'user_id' => $user_information[0]['user_id'],
                'first_name' => $user_information[0]['first_name'],
                'last_name' => $user_information[0]['last_name'],
                'email' => $user_information[0]['email'],
                'user_mobile' => $user_information[0]['user_mobile'],
                'logged_in'=>TRUE
            );
            $this->load->library('session');
            $this->session->set_userdata($user);
            redirect('http://localhost/codeigniter/mement/board/1');
        }else{
            //비밀번호가 일치하지 않을 때
            $this->load->view('templates/header');
            $this->load->view('nav_bar_before_login');
            $this->load->view('login_view');
            $this->load->view('templates/footer');
        }
    }

    public function signin(){
        echo "회원가입";
    }

    public function board($id){
        $this->input->get('page');
        //세션 없으면 메인페이지로 redirect
        $this->load->library('session');
        if(!$this->session->userdata('user_id')){
            redirect('http://localhost/codeigniter/mement');
            exit;
        }
        $this->load->view('templates/header');
        $this->load->view('nav_bar_after_login');
        $this->load->model("board_model");
        
        $this->load->view('vue/board_main');
        
        $this->load->view('templates/footer');
    }
    //board페이지에서 board_data페이지 안거치고 바로 자료 가지고 올 수 있음

    public function board_data($id){
        $this->load->library('session');
        if(!$this->session->userdata('user_id')){
            redirect('http://localhost/codeigniter/mement');
            exit;
        }
        $this->load->model("board_model");
        $data=$this->board_model->get_data($id);
        echo json_encode($data);
    }

    public function details($id){
        //잘못된 접속일 경우에 리다이렉트
        $this->load->library('session');
        if(!$this->session->userdata('user_id')){
            redirect('http://localhost/codeigniter/mement');
            exit;
        }

        //로그인 후 헤더랑 나브바
        $this->load->view('templates/header');
        $this->load->view('nav_bar_after_login');

        //db 데이터 가지고 오는 쿼리값 저장한 모델
        $this->load->model('board_model');

        $this->load->view("vue/details");


        //푸터
        $this->load->view('templates/footer');
    }
    
    public function comment(){
        $this->load->library('session');
        if(!$this->session->userdata('user_id')){
            redirect('http://localhost/codeigniter/mement');
            exit;
        }
        
        $user_id = $this->session->userdata('user_id');
        $user_full_name = $this->session->userdata('last_name')." ".$this->session->userdata('first_name');
        $content_title = trim($this->input->post('comment_title'));
        $content = trim($this->input->post('comment'));
        $db_table = 'notice_board';
        $this->load->model("board_model");
        $upload_content = $this->board_model->upload_content($user_id,$user_full_name,$content_title,$content,$db_table);

        //정보 입력 후 시나리오 작성
        redirect('http://localhost/codeigniter/mement/board/1');
    }

    public function content_reply(){
        $this->load->library('session');
        if(!$this->session->userdata('user_id')){
            redirect('http://localhost/codeigniter/mement');
            exit;
        }

        $notice_id = trim($this->input->post('notice_id'));
        $user_id = $this->session->userdata('user_id');
        $first_name = $this->session->userdata('first_name');
        $reply_content = trim($this->input->post('reply_content'));
        echo $notice_id;
        echo "<br>";
        echo $user_id;
        echo "<br>";
        echo $first_name;
        echo "<br>";
        echo $reply_content;
        $this->load->model("board_model");
        $upload_reply = $this->board_model->upload_reply($notice_id,$user_id,$first_name,$reply_content);

        redirect('http://localhost/codeigniter/mement/details/'.$notice_id);
    }

    public function re_reply(){
        $this->load->library('session');
        if(!$this->session->userdata('user_id')){
            redirect('http://localhost/codeigniter/mement');
            exit;
        }
        
        $notice_id = trim($this->input->post('notice_id'));
        $reply_id = trim($this->input->post('reply_id'));
        $user_id = $this->session->userdata('user_id');
        $first_name = $this->session->userdata('first_name');
        $content = trim($this->input->post('content'));
        $reg_date = date("Y-m-d H:i:s");
        
        $this->load->model('board_model');
        $upload_re_reply = $this->board_model->upload_re_reply($notice_id, $reply_id, $user_id, $first_name, $content, $reg_date);
        echo "Re: ".$first_name." ".$content." ".$reg_date;
    }

    public function api($id){
        $this->load->library('session');
        if(!$this->session->userdata('user_id')){
            redirect('http://localhost/codeigniter/mement');
            exit;
        }
        $this->load->model("board_model");
        $details = $this->board_model->get_details($id);
        echo json_encode($details);
    }

    public function inputReply($id){
        $this->load->library('session');
        if(!$this->session->userdata('user_id')){
            redirect('http://localhost/codeigniter/mement');
            exit;
        }
        
        $reply_content = trim($this->input->get('replyContent'));
        //$first_name = $this->session->userdata('first_name');
        //$this->load->model("board_model");
        echo $reply_content;
    }

    function logout(){
        $this->session->sess_destroy();
        redirect('http://localhost/codeigniter/mement');
    }

    //나중에 한번씩 볼 페이지들
    public function vue_ex(){
        $this->load->view('vue/vue_ex');
    }
    //parameter 값으로 데이터 처리
    public function test(){
        echo $this->input->get('parameter1');
        echo "<br>";
        echo $this->input->get('parameter2');
        echo "<br>";
        echo $this->input->get('mama');
    }
}
?>