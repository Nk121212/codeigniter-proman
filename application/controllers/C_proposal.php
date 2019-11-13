<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_proposal extends CI_Controller {
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
			$this->load->view("group_estimasi/v_proposal");         

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("logincontroller");
        }
    }
    function get_proposal(){

        $idp = $this->input->post("idp");
        $dbt = $this->input->post("dibuat");
        $dkt = $this->input->post("diketahui");
        $mytj = $this->input->post("menyetujui");

        if(is_array($dbt)){
            $dibuat = implode(",",$dbt);
        }else{
            $dibuat = $this->input->post("dibuat");
        }

        if(is_array($dkt)){
            $diketahui = implode(",",$dkt);
        }else{
            $diketahui = $this->input->post("diketahui");
        }

        if(is_array($mytj)){
            $menyetujui = implode(",",$mytj);
        }else{
            $menyetujui = $this->input->post("menyetujui");
        }

        //$dibuat = $this->input->post("dibuat");
        //$diketahui = $this->input->post("diketahui");
        //$menyetujui = $this->input->post("menyetujui");

        $data = 
        array('id_project' => $idp, 
            'dibuat' => $dibuat, 
            'diketahui' => $diketahui, 
            'menyetujui' => $menyetujui
        );
        
        $this->load->library("pdf");
        
        $this->pdf->load_view('proposal/v_proposal',$data);
        $this->pdf->set_paper('A4', 'potrait');
        $this->pdf->render();
        $this->pdf->stream("name-file.pdf", array("Attachment" => false));
    }

} //TUTUP CONTROLLER
