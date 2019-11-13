<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_master extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        //load model admin
        $this->load->model('admin');
	}
	
	public function index(){

		if($this->admin->logged_id())
        {
            //$data['id_project']=$id;
            $this->load->view("plugin/plugin");
            $this->load->view("master/add_satuan");         
    
        }else{
    
            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("logincontroller");
        }
    }

    function add_satuan(){
        $nm_satuan = $this->input->post("satuan");
        $cek = $this->db->query("
        select * from satuan where nama_satuan = '$nm_satuan'
        ");
        if($cek->num_rows() < 1){
            //redirect("c_master/index");
            $ins = $this->db->query("
            INSERT INTO satuan (nama_satuan) VALUES('$nm_satuan')
            ");
            if($ins){
                echo 'Insert Succes <br> <a href="index">Go Back</a>';
            }else{
                echo 'Insert Failed';
            }

            
        }else{
            //echo 'Sudah Ada Satuan';
        }
        
    }

    function prioritas(){
		$this->load->library("pdf"); 
        $this->pdf->load_view('master/prioritas');
        $this->pdf->set_paper('A4', 'landscape');
        $this->pdf->render();
		$this->pdf->stream("name-file.pdf", array("Attachment" => false));
    }

} //TUTUP CONTROLLER
