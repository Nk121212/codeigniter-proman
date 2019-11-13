<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_register extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //load model admin
        $this->load->model('admin');
    }
	
	public function index(){
        if($this->admin->logged_id())
        {
            $this->load->view("plugin/reg");
            $this->load->view("daftar");        

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("logincontroller");
        }
    }
   
    function daftar(){
        date_default_timezone_set("Asia/Jakarta");
        $nm_user = $this->input->post("nm_user");
        $email = $this->input->post("email");
        $password = $this->input->post("password");
        $date = date("Y-m-d");

        //cek email sama
        $qv_mail = $this->db->query("
        select * from users where email = '$email'
        ");
        if($qv_mail->num_rows() < 1){

            $query = $this->db->query("
            INSERT INTO users (nama_user,email,password,created_date) VALUES ('$nm_user','$email',MD5('$password'),'$date')
            ");
            if($query){
    
                $cek = $this->db->query("
                select id from users where email = '$email'
                ");

                $id_user = $cek->row()->id;

                $this->send_activasi($id_user);
    
            }else{
                echo '';
            }

        }else{

            echo 'Email Sudah Ada';

        }
    }
    function send_activasi($id_user){

        $q1 = $this->db->query("select * from users where id = '$id_user'");
        $mail_user = $q1->row()->email;

        $this->load->library('email');
        $config = array();                          /* Deklarasi config sebagai array */
        $config['protocol'] = 'smtp';               /* Set konfigurasi email */
        $config['smtp_host'] = '192.168.225.2';     /* Set konfigurasi email */
        $config['smtp_user'] = '';                  /* Set konfigurasi email */
        $config['smtp_pass'] = '';                  /* Set konfigurasi email */
        $config['smtp_port'] = 25;                  /* Set konfigurasi email */
        $this->email->initialize($config);          /* Terapkan configurasi */
        
        $this->email->from('noreply@sipatex.co.id', 'PROJECT MANAGEMENT');
        $this->email->to($mail_user);
        //$this->email->cc('m.alamin@sipatex.co.id');
        //$this->email->bcc('');
        $data['id_user'] = $id_user;
        
        $this->email->subject('Activation Account');

        $this->email->set_mailtype("html"); 
        
        $message = $this->load->view('email/register.php', $data, True);

        $this->email->message($message);
        
        if($this->email->send()){
            redirect("logincontroller/index");
        }else{

            echo $this->email->print_debugger();

        }
    }

    function activated($id){
        $idusr = $id;

        $query = $this->db->query("
        UPDATE users SET valid = '1' WHERE id = '$idusr'
        ");
        if($query){
            echo 'Account Has Been Activated ! </br>
            <a href="'.base_url().'">click here to go to Login Page</a>
            ';
        }else{
            echo 'Activatio Failed !';
        }
    }

    function reset(){
        
    }

} //TUTUP CONTROLLER
