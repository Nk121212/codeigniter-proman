<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_manual extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        //load model admin
        $this->load->model('admin');
	}
	
	public function index(){

		if($this->admin->logged_id())
        {
            $this->load->view("plugin/plugin");
			$this->load->view("manual_book/pdf_book");         

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("logincontroller");
        }
    }

    public function index2(){
        
        if($this->admin->logged_id())
        {
            //$this->load->view("plugin/plugin");
            $this->load->view("manual_book/pdf_book2");         

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("logincontroller");
        }
    }

    function flow(){
        if($this->admin->logged_id())
        {
            $this->load->view("plugin/plugin");
			$this->load->view("manual_book/flow");         

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("logincontroller");
        }
    }

    function print_manual(){
        $this->load->library("pdf");
        $this->pdf->load_view('manual_book/pdf_book2');
        $this->pdf->set_paper('A4', 'potrait');
        $this->pdf->render();
        $this->pdf->stream("name-file.pdf", array("Attachment" => true));
    }

    function manual2(){
        $this->load->view("manual_book/pdf_book2");  
    }


} //TUTUP CONTROLLER
