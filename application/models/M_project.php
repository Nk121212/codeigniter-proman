<?php
class M_project extends CI_Model{

	function insert_est(){
		$project = $this->input->post('pname');
		$config['upload_path']="./uploads/project/";
		$lokasi = "uploads/project";
        //$config['allowed_types']='gif|jpg|png|docx|doc|pptx|xlsx|js|pdf|mp4|mkv|wmv|zip|rar|sql|xls';
		$config['allowed_types'] = '*';
		$config['detect_mime'] = false;
        $config['max_size'] = '0';
		$config['file_name'] = "Est_Project_".$project;
		$config['overwrite'] = TRUE;
		
        
        $this->load->library('upload',$config);

	    if($this->upload->do_upload("file")){			
	    	//batasan max size post upload php.ini upload_max_size : 500M;
	        $data = array('upload_data' => $this->upload->data());
			//$config['file_name'] = 'ceksound ah';
			
	        $image = $data['upload_data']['file_name'];

	        $nm_project = $this->input->post('pname');
	        $attach = $lokasi."/".$image;
	        //$value = $this->input->post('pvalue');
	        //$budget = $this->input->post('pbudget');
	        	
			$cek = $this->input->post('pcategory');
			if(is_array($cek)){
				$category = implode(",", $cek);
			}else{
				$category = $this->input->post('pcategory');
			}
			
			$purpose = $this->input->post('ppurpose');
			$psc_awal = $this->input->post('psc_awal');
			$psc_akhir = $this->input->post('psc_akhir');
			$hours = $this->input->post('phours');
			$duration = $this->input->post('pdurations');

			$c_lok = $this->input->post('plokasi');
			if(is_array($c_lok)){
				$lokasi = implode(",", $c_lok);
			}else{
				$lokasi = $this->input->post('plokasi');
			}
			
			
			$arr_subloc = $this->input->post('sub_lokasi');
			if(is_array($arr_subloc)){
				$sub_loc = implode(",", $arr_subloc);
			}else{
				$sub_loc = $this->input->post('sub_lokasi');
			}
			

	        $coordinator = $this->input->post('pcoordinator');
	        $log_user = $this->session->userdata('name');
	        date_default_timezone_set('Asia/Jakarta');
			$log_date = date('Y-m-d h:i:s');

        }else{
			$error = array('error' => $this->upload->display_errors());
			echo implode(",",$error);
		}

		$data = array(
	        	'act_pname' => $nm_project,
	        	//'est_pbudget' => $budget,
	        	'act_pcategory' => $category,
	        	'act_ppurpose' => $purpose,
	        	'est_pstart' => $psc_awal,
				'est_pend' => $psc_akhir,
				'est_pdays' => $duration,
	        	'est_phours' => $hours,
				'act_plocation' => $lokasi,
				'act_sub_plocation' => $sub_loc,
				'act_pcordinator' => $coordinator,
				'act_attachment' => $attach,
	        	'act_add_by' => $log_user,
	        	'act_add_at' => $log_date
			   );  
			   
	    $result = $this->db->insert('act_project',$data);
	    return $result;
	}

	function insert_act(){
		$project = $this->input->post('pname');
		$config['upload_path']="./uploads/project/";
		$lokasi = "uploads/project";
        //$config['allowed_types']='gif|jpg|png|docx|doc|pptx|xlsx|js|pdf|mp4|mkv|wmv|zip|rar|sql|xls';
		$config['allowed_types'] = '*';
		$config['detect_mime'] = false;
        $config['max_size'] = '0';
		$config['file_name'] = "Act_Project_".$project;
		$config['overwrite'] = TRUE;
		
        
        $this->load->library('upload',$config);

	    if($this->upload->do_upload("file")){
	    	//batasan max size post upload php.ini upload_max_size : 500M;
	        $data = array('upload_data' => $this->upload->data());
			//$config['file_name'] = 'ceksound ah';
			
	        $image = $data['upload_data']['file_name'];

	        $nm_project = $this->input->post('pname');
	        $attach = $lokasi."/".$image;
	        //$value = $this->input->post('pvalue');
	        //$budget = $this->input->post('pbudget');
	        	
			$cek = $this->input->post('pcategory');
			if(is_array($cek)){
				$category = implode(",", $cek);
			}else{
				$category = $this->input->post('pcategory');
			}
			
			$purpose = $this->input->post('ppurpose');
			$psc_awal = $this->input->post('psc_awal');
			$psc_akhir = $this->input->post('psc_akhir');
			$hours = $this->input->post('phours');
			$duration = $this->input->post('pdurations');
			$act_start = $this->input->post("act_start");

			$c_lok = $this->input->post('plokasi');
			if(is_array($c_lok)){
				$lokasi = implode(",", $c_lok);
			}else{
				$lokasi = $this->input->post('plokasi');
			}
			
			$arr_subloc = $this->input->post('sub_lokasi');
			if(is_array($arr_subloc)){
				$sub_loc = implode(",", $arr_subloc);
			}else{
				$sub_loc = $this->input->post('sub_lokasi');
			}
			
	        $coordinator = $this->input->post('pcoordinator');
	        $log_user = $this->session->userdata('name');
	        date_default_timezone_set('Asia/Jakarta');
			$log_date = date('Y-m-d h:i:s');
        }else{
			$error = array('error' => $this->upload->display_errors());
			echo implode(",",$error);
		}
		$data = array(
	        	'act_pname' => $nm_project,
	        	//'act_pbudget' => $budget,
	        	'act_pcategory' => $category,
	        	'act_ppurpose' => $purpose,
	        	'act_pstart' => $act_start,
				//'act_pend' => $psc_akhir,
				//'act_pdays' => $duration,
	        	//'act_phours' => $hours,
				'act_plocation' => $lokasi,
				'act_sub_plocation' => $sub_loc,
				'act_pcordinator' => $coordinator,
				'act_attachment' => $attach,
	        	'act_add_by' => $log_user,
	        	'act_add_at' => $log_date
			   );  
			   
	    $result = $this->db->insert('act_project',$data);
	    return $result;
	}

	function update_act($nm_project,$attach,$budget,$category,$purpose,$psc_awal,$psc_akhir,$hours,$duration,$lokasi,$sub_loc,$coordinator,$log_user,$log_date){
		$data = array(
	        	'act_pname' => $nm_project,
	        	'act_pbudget' => $budget,
	        	'act_pcategory' => $category,
	        	'act_ppurpose' => $purpose,
	        	'act_pstart' => $psc_awal,
				'act_pend' => $psc_akhir,
				'act_pdays' => $duration,
	        	'act_phours' => $hours,
				'act_plocation' => $lokasi,
				'act_sub_plocation' => $sub_loc,
				'act_pcordinator' => $coordinator,
				'act_attachment' => $attach,
	        	'act_add_by' => $log_user,
	        	'act_add_at' => $log_date
			   );  

		$this->db->where('id', $id);
	    $result = $this->db->update('act_project',$data);
	    return $result;
	}

	
}