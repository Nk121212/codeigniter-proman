<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EstimateController extends CI_Controller {
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
            $this->load->view("plugin/plugin");
			$this->load->view("group_estimasi/v_estimasi");         

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("logincontroller");
        }
	}

	function insert_project(){
		date_default_timezone_set("Asia/Jakarta");
		$nama_project = $this->input->post("pname");
		$config['upload_path']="./uploads/project/";
		$lokasi = "uploads/project";
        //$config['allowed_types']='gif|jpg|png|docx|doc|pptx|xlsx|js|pdf|mp4|mkv|wmv|zip|rar|sql|xls';
		$config['allowed_types'] = '*';
		$config['detect_mime'] = false;
        $config['max_size'] = '0';
		$config['file_name'] = $nama_project;
		$config['overwrite'] = TRUE;
		$this->load->library('upload',$config);
		
		$kat = $this->input->post("pcategory");
		$complex = $this->input->post("complex");
		$res = $this->input->post("res");

		if($res == "" || $res == NULL){
			echo 'pilih resource'; // jikia masih null resource
		}elseif($kat == "" || $kat == NULL){
			echo "pilih kategori"; // jika masih null kategori
		}elseif($complex == "" || $complex == NULL){
			echo 'Pilih Complexity'; //jika masih null complexity
		}else{

			$purpose = $this->input->post("ppurpose");
			$kordinator = $this->input->post("pcoordinator");
			$lok = $this->input->post("lokasi");
			$add_by = $this->session->userdata('name');
			$add_at = date("Y-m-d h:i:s");

			if(is_array($kat)){
				$kategori = implode(",", $kat);
			}else{
				$kategori = $this->input->post("pcategory");
			}

			if(is_array($complex)){
				$complexity = implode(",", $complex);
			}else{
				$complexity = $this->input->post("complex");
			}

			if(is_array($res)){

				$resource = implode(",", $res);
					if($resource == '1'){
						//echo 'internal = 1';
						$res_fix = '1';
					}elseif($resource == '2'){
						//echo 'external = 2';
						$res_fix = '2';
					}else{
						//echo 'internal & external = 3';
						$res_fix = '3';
					}

			}else{

				$resource = $this->input->post("res");
					if($resource == '1'){
						//echo 'internal = 1';
						$res_fix = '1';
					}else{
						//echo 'external = 2';
						$res_fix = '2';
					}
			}
		}

	    if($this->upload->do_upload("file")){
	    	//batasan max size post upload php.ini upload_max_size : 500M;
	        $data = array('upload_data' => $this->upload->data());
	        $image = $data['upload_data']['file_name'];
			$attach = $lokasi."/".$image;

            $config['image_library'] = 'gd2';
            $config['source_image'] = $attach;
            $config['new_image'] = $attach;
            $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 500;
            $config['height'] = 500;

            // Load the Library
            $this->load->library('image_lib', $config);
            // resize image
            $this->image_lib->resize();
            // handle if there is any problem
            if (!$this->image_lib->resize()){ 
                echo $this->image_lib->display_errors();
            }

			$query = $this->db->query("
				insert into project 
				(nama_project,kategori,purpose,lokasi,
				kordinator,attachment,add_by,add_at,complexity,resource) 
				values 
				('$nama_project','$kategori','$purpose','$lok',
				'$kordinator','$attach','$add_by','$add_at','$complexity','$res_fix')
			");
			if($query){
				echo '<script>alert(Success !);</script>';
				redirect("c_task/index");
			}else{
				echo '<script>alert(Error !);</script>';
				redirect("estimatecontroller/index");
			}	

        }else{
			$query = $this->db->query("
				insert into project 
				(nama_project,kategori,purpose,lokasi,
				kordinator,add_by,add_at,complexity,resource) 
				values 
				('$nama_project','$kategori','$purpose','$lok',
				'$kordinator','$add_by','$add_at','$complexity','$res_fix')
			");
			if($query){
				echo '<script>alert(Success !);</script>';
				redirect("c_task/index");
			}else{
				echo '<script>alert(Error !);</script>';
				redirect("estimatecontroller/index");
			}
			//$error = array('error' => $this->upload->display_errors());
		}

	}

} //=============Tutup Controller