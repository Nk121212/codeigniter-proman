<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_user extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //load model admin
        $this->load->model('admin');
    }

	public function index()
	{

        if($this->admin->logged_id())
        {
            $this->load->view('plugin/plugin');
            $this->load->view('user/add_user');     

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("logincontroller");
        }
        
    }
    
    function add(){
        date_default_timezone_set("Asia/Jakarta");

        $create = date("Y-m-d");
        $nm = $this->input->post("nm_user");
        $mail = $this->input->post("mail");
        $pw = $this->input->post("pw");
        $lvl = $this->input->post("lvl");

        $cek_mail = $this->db->query("
            select email from users where email = '$mail'
        ");
        if($cek_mail->num_rows() < 1){
            //boleh tambah
            $insert = $this->db->query("
                insert into users(nama_user,email,password,created_date,valid,auth,pw_text) 
                values('$nm','$mail',MD5('$pw'),'$create','1','$lvl','$pw')
            ");
            if($insert){
                echo 'Succes ';
                echo '<br> <a href="index/">Back</a>';
            }else{
                echo 'Failed';
            }
        }else{
            //email sudah terdaftar
            echo 'Email sudah terdaftar !';
            echo '<br> <a href="index/">Back</a>';
        }
    }
}
