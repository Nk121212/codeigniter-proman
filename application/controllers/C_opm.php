<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_opm extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        //load model admin
        $this->load->model('admin');
	}
	
	public function index(){

		if($this->admin->logged_id())
        {
			//$this->load->view("plugin/plugin");
			$this->load->view("errors/fixing");         

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("logincontroller");
        }
    }

} //TUTUP CONTROLLER
