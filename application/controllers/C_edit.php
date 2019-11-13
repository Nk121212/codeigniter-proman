<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_edit extends CI_Controller {
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
			$this->load->view("group_actual/v-kick-off");         

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("logincontroller");
        }
    }

    function edit_page($idp){

        $data['id_project'] = $idp;

        if($this->admin->logged_id())
        {
			$this->load->view("plugin/plugin");
            $this->load->view("edit/edit_project", $data);            

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("logincontroller");
        }
    }

    function data_project(){
        $id_project = $this->input->post("id_project");
        $query = $this->db->query("
            SELECT * FROM project WHERE id = '$id_project'
        ");
        $i = 0;
        foreach($query->result() as $data){
            if($data->resource == '3'){
                $res = '1,2';
            }else{
                $res = $data->resource;
            }

        
            $arr[] = array();
            $arr[$i]['nama_project'] = $data->nama_project;
            $arr[$i]['kategori'] = $data->kategori;
            $arr[$i]['purpose'] = $data->purpose;
            $arr[$i]['kordinator'] = $data->kordinator;
            $arr[$i]['complexity'] = $data->complexity;
            $arr[$i]['lokasi'] = $data->lokasi;
            $arr[$i]['resource'] = $res;
            $arr[$i]['attachment'] = $data->attachment;

            $i++;
        }
        header('Content-Type: application/json');
        echo json_encode($arr);
    }

    function edit_project(){

        $id_project = $this->input->post("id_project");
        $purpose = $this->input->post("ppurpose");

        $query = $this->db->query("
            update project set purpose='$purpose' where id = '$id_project'
        ");
        if($query){
            echo '<script>alert(Success !);</script>';
            redirect("c_task/view_dp/$id_project");
        }else{
            echo '<script>alert(Error !);</script>';
            redirect("c_task/view_dp/$id_project");
        }	

    }
    
    function de_material(){
        $id_material = $this->input->post("id_material");
        $query = $this->db->query("
            SELECT * FROM material WHERE id = '$id_material'
        ");
        $i = 0;
        foreach($query->result() as $data){

            $arr[] = array();
            $arr[$i]['nama_material'] = $data->nama_material;

            $arr[$i]['satuan'] = $data->satuan;
            $arr[$i]['jumlah'] = $data->jumlah;
            $arr[$i]['harga'] = $data->harga;
            $arr[$i]['total_harga'] = $data->total_harga;

            $i++;
        }
        header('Content-Type: application/json');
        echo json_encode($arr);

    }

} //TUTUP CONTROLLER
