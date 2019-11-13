<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {
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
                //jika memang session sudah terdaftar, maka redirect ke halaman dahsboard
                redirect("dashboardcontroller/");

            }else{

                //jika session belum terdaftar

                //set form validation
                $this->form_validation->set_rules('email', 'email', 'required');
                $this->form_validation->set_rules('password', 'Password', 'required');

                //set message form validation
                $this->form_validation->set_message('required', '<div class="alert alert-danger" style="margin-top: 3px">
                    <div class="header"><b><i class="fa fa-exclamation-circle"></i> {field}</b> harus diisi</div></div>');

                //cek validasi
                if ($this->form_validation->run() == TRUE) {

                //get data dari FORM
                $email = $this->input->post("email", TRUE);
                $password = MD5($this->input->post('password', TRUE));

                //checking data via model
                $checking = $this->admin->check_login('users', array('email' => $email), array('password' => $password), array('valid' => '1'));

                //jika ditemukan, maka create session
                if ($checking != FALSE) {

                    foreach ($checking as $apps) {
                        
                        $session_data = array(
                            'user_id'   => $apps->id,
                            'user_name' => $apps->email,
                            'user_pass' => $apps->password,
                            'name' => $apps->nama_user,
                            'valid' => $apps->valid,
                            'auth' => $apps->auth,
                        );
                        //set session userdata
                        $this->session->set_userdata($session_data);
                        //$this->load->view("template/template");  
                        //$this->load->view("vhome");    
                        redirect('dashboardcontroller/');
                        
                    }
                    //}
                    
                }else{

                    $data['error'] = '
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Login Failed !</strong> </br>Please check your email & password correctly.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    ';

                    //$this->load->view('plugin/plogin');
                    $this->load->view('v_login', $data);
                }

            }else{

            	//$this->load->view('plugin/plogin');
                $this->load->view('v_login');
            }

        }
	}
}
