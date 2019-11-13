<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_task extends CI_Controller {
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
			$this->load->view("group_estimasi/v-task");         

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("logincontroller");
        }
	}

	function all_project(){
		$query = $this->db->query("select * from project where estimasi = 1 order by id desc");

		if($query->num_rows() < 1){
			echo '
			<tr>
				<td colspan="6">
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<i class="fa fa-info"></i>   <strong>Informasi </strong></br> 
					<a href="'.base_url().'estimatecontroller/index"><u>Klik Disini</u> Untuk Membuat Project</a>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				</td>
			</tr>
			';
		}else{
			$no = 1;
			foreach($query->result() as $data){
				$id_project = $data->id;
				if($data->status == 1){
					$stat = 'Not Started';
				}else{
					$stat = '';
				}
				echo '
				<tr>
					<td>'.$no.'</td>
					<td>'.$data->nama_project.'</td>
					<td>'.$data->est_mulai.'</td>
					<td>'.$data->est_selesai.'</td>
					<td>'.$stat.'</td>
					<td>
						<input type="text" name="idp'.$no.'" id="idp'.$no.'" value="'.$id_project.'" hidden>
						<a href="'.base_url().'c_task/task_page/'.$id_project.'" data-toggle="tooltip" data-placement="top" title="Add Task" class="btn btn-sm btn-primary">
						<i class="fa fa-plus"></i> Add Task</a>
						<a href="'.base_url().'c_task/view_task/'.$id_project.'" data-toggle="tooltip" data-placement="top" title="View Task" class="btn btn-sm btn-warning">
						<i class="fa fa-eye"></i> View Task</a>
					</td>
				</tr>
				';
				echo '
				<script>
				$("#span_fe'.$no.'").click(function(){
					var idp = $("#idp'.$no.'").val();
					$("#id_project").val(idp);
				})
				</script>
				';
				$no ++;
			}
		}
	}

	function kick_off_page(){
		
		if($this->admin->logged_id())
        {
			$this->load->view("plugin/plugin");
			$this->load->view("group_actual/v-kick-off");         

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("logincontroller");
        }
	}	

	function page_task_update(){
		if($this->admin->logged_id())
        {
			$this->load->view("plugin/plugin");
			$this->load->view("edit/vu_task");    
        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("logincontroller");
        }
	}
	function page_task_update2($id){
		if($this->admin->logged_id())
        {
			$data['id_project'] = $id;
			$this->load->view("plugin/plugin");
			$this->load->view("edit/vu_task",$data);     
        }else{
            redirect("logincontroller");
        }
	}

	function show_task(){
		$id_project = $this->input->post("idp");
        $query = $this->db->query("select * from task where id_project = '$id_project'");
        $no = 1;
        foreach($query->result() as $data){
			$id_task = $data->id;
            $task = $data->nama_task;
            $start = $data->start;
            $end = $data->end;
            $bobot = $data->bobot;

            echo '
            <tr>
            <td>'.$no.'</td>
            <td>'.$task.'</td>
            <td>'.$start.'</td>
            <td>'.$end.'</td>
            <td>'.$bobot.'%</td>
			<td>
            <a href="'.base_url().'c_task/task_update/'.$data->id.'" class="btn btn-sm btn-warning"><i class="fa fa-refresh"> Edit Task</i></a>
            </td>
            </tr>
			';
            $no++;
        }
	}
	
	function task_update($id){
		$qs_idp = $this->db->query("select id_project from task where id = '$id'");
		$r_idp = $qs_idp->row()->id_project;

		$data = array('id_project' => $r_idp, 'id_task' => $id);

		if($this->admin->logged_id())
        {
			$this->load->view("plugin/plugin");
			$this->load->view("edit/update_task",$data);         

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("logincontroller");
        }
	}

	function detail_task(){
		$id_task = $this->input->post("id_task");
		//echo $id_task;
		$query = $this->db->query("select * from task where id = '$id_task'");
		$i = 0;
		foreach($query->result() as $data){
			$dt[] = array();
			$dt[$i]["task"] = $data->nama_task;
			$dt[$i]["pic"] = $data->est_pic;
			$dt[$i]["start"] = $data->est_start;
			$dt[$i]["end"] = $data->est_end;
			$dt[$i]["hours"] = $data->est_hours;
			$dt[$i]["days"] = $data->est_days;
			$dt[$i]["rint"] = $data->est_res_internal;
			$dt[$i]["rext"] = $data->est_res_external;
			$dt[$i]["upload"] = $data->est_attachment;

			$i ++;
		}
		header('Content-Type: application/json');
		echo json_encode($dt);
	}

	function edit_task(){
		date_default_timezone_set("Asia/Jakarta");
		$id_task = $this->input->post("id_task");
		$task = $this->input->post("task");
		$res_internal = $this->input->post("res_internal");
		$res_external = $this->input->post("res_external");
		$pic = $this->input->post("pic");

		$by = $this->session->userdata('name');
		$at = date("Y-m-d h:i:s");

		$config['upload_path']="./uploads/task/";
		$lokasi = "uploads/task";
        //$config['allowed_types']='gif|jpg|png|docx|doc|pptx|xlsx|js|pdf|mp4|mkv|wmv|zip|rar|sql|xls';
		$config['allowed_types'] = '*';
		$config['detect_mime'] = false;
        $config['max_size'] = '0';
		$config['file_name'] = $task;
		$config['overwrite'] = TRUE;
		$this->load->library('upload',$config);

		if($this->upload->do_upload("file")){
	    	//batasan max size post upload php.ini upload_max_size : 500M;
	        $data = array('upload_data' => $this->upload->data());
	        $image = $data['upload_data']['file_name'];
			$attach = $lokasi."/".$image;

			$update = $this->db->query("
				update task set nama_task = '$task', est_res_internal = '$res_internal', est_res_external = '$res_external', 
				res_internal = '$res_internal', res_external = '$res_external',
				est_pic = '$pic', est_attachment = '$attach', attachment='$attach', update_by = '$by', update_at = '$at'
				where id='$id_task'
			");

			if($update){
				redirect("../c_task/page_task_update");
			}else{
				echo '
				<script>alert("Update Failed !");</script>
				';
			}

        }else{
			$update = $this->db->query("
				update task set nama_task = '$task', est_res_internal = '$res_internal', est_res_external = '$res_external', 
				res_internal = '$res_internal', res_external = '$res_external',
				est_pic = '$pic', update_by = '$by', update_at = '$at'
				where id='$id_task'
			");

			if($update){
				redirect("../c_task/page_task_update");
			}else{
				echo '
				<script>alert("Update Failed !");</script>
				';
			}
			//$error = array('error' => $this->upload->display_errors());
		}
	}

	function kick_off_tbl(){
		$query = $this->db->query("select * from project where estimasi = 1 order by id desc");

		if($query->num_rows() < 1){
			echo '
			<tr>
				<td colspan="7">
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<i class="fa fa-info"></i>   <strong>Informasi </strong></br> 
					<a href="'.base_url().'c_todolist/index"><u>Klik Disini</u> Untuk Update Project</a>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				</td>
			</tr>
			';
		}else{
			$no = 1;
			foreach($query->result() as $data){
				$id_project = $data->id;
				echo '
				<tr>
					<td>'.$no.'</td>
					<td>'.$data->nama_project.'</td>
					<td>'.$data->est_mulai.'</td>
					<td>'.$data->est_selesai.'</td>
					<td>'.$data->est_prioritas.'</td>
					<td>Rp. '.number_format($data->est_budget,0,',','.').'</td>
					<td>
					<input type="text" name="idp'.$no.'" id="idp'.$no.'" value="'.$id_project.'" hidden>
					<span data-toggle="tooltip" data-placement="top" title="View Data Project '.$data->nama_project.'">
						<a href="../c_task/view_dp/'.$id_project.'" id="btn_vdp'.$no.'" class="btn btn-sm btn-info">
						<i class="fa fa-eye"></i> View Data</a>
					</span>
					<span data-toggle="modal" data-target="#mf_est">
						<a id="btn_fe'.$no.'" data-toggle="tooltip" data-placement="top" title="Finish Estimasi" class="btn btn-sm btn-secondary">
						<i class="fa fa-hourglass-start"></i> Finish Estimasi</a>
					</span>
					<span data-toggle="modal" data-target="#mc_pro">
						<a id="btn_cp'.$no.'" href="#" class="btn btn-sm btn-warning">
						<i class=" fa fa-refresh"></i>
						Cancel</a>
					</span>
				</td>
				</tr>
				';
				echo '
				<script>
				$("#btn_fe'.$no.'").click(function(){
					var idp = $("#idp'.$no.'").val();
					//alert(idp);
					$("#idp").val(idp);
				})
				$("#btn_cp'.$no.'").click(function(){
					var idp = $("#idp'.$no.'").val();
					//alert(idp);
					$("#idcp").val(idp);
				})
				</script>
				';
				$no ++;
			}
		}
	}

	function cancel_project(){
		$idcp = $this->input->post("idcp");
		$query = $this->db->query("
			UPDATE project SET status = 3 WHERE id = $idcp
		");
		redirect("C_task/kick_off_page");

	}

	function view_dp($id_project){
		$cek = $this->db->query("
		select id from task where id_project = '$id_project'
		");
		if($cek->num_rows() < 1){
			echo '
			<script>
			alert("Please add task to View Data !");
			window.location.replace("../index");
			</script>';
		}else{

		}
		if($this->admin->logged_id())
        {
			$data['id_project'] = $id_project;
			$this->load->view("plugin/plugin");
			$this->load->view("group_estimasi/view_dp", $data);         

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("logincontroller");
        }
	}

	function finish_estimasi(){
		$id_pro = $this->input->post("idp");
		//echo $id_pro;
		//cek task ada atau tidak
		$cek = $this->db->query("
		select id from task where id_project = '$id_pro'
		");
		if($cek->num_rows() < 1){
			echo '
			<script>
			alert("Please add task to finish estimasi !");
			window.location.replace("../c_task/index");
			</script>';
		}else{
			//cek ada todo & material/tidak jika task ada
			$idt_concat = $this->db->query("
			select group_concat(id separator ',') as idt from task where id_project = '$id_pro'
			");
			$id_task = $idt_concat->row()->idt;
			$cek_todo = $this->db->query("
			select id from todo where id_task IN($id_task)
			");
				if($cek_todo->num_rows() < 1){
					echo '
					<script>
					alert("Please add todo to finish estimasi !");
					window.location.replace("../c_task/index");
					</script>';
				}else{
					$cek_material = $this->db->query("
					select id from material where id_task IN($id_task)
					");
						if($cek_material->num_rows() < 1){
							echo '
							<script>
							alert("Please add material to finish estimasi !");
							window.location.replace("../c_task/index");
							</script>';
						}else{
							$query = $this->db->query("update project set estimasi = '2' where id = '$id_pro'");
							redirect("c_task/page_task_update");
						}
				}
				
		}
	}

	function task_page($id){
		if($this->admin->logged_id())
        {
			$data['id_project']=$id;
            $this->load->view("plugin/plugin");
			$this->load->view("group_estimasi/v-add-task", $data);         

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("logincontroller");
        }
	}
	function view_task($id){
		$cek = $this->db->query("
		select id from task where id_project = '$id'
		");
		if($cek->num_rows() < 1){
			echo '
			There is <strong><u>No Task</u></strong> in this project please insert Task First !
			<a href="../index">Go Back</a>
			';
		}else{

			if($this->admin->logged_id())
			{
				$data['id_project']=$id;
				$this->load->view("plugin/plugin");
				$this->load->view("group_estimasi/v-view-task", $data);         
	
			}else{
	
				//jika session belum terdaftar, maka redirect ke halaman login
				redirect("logincontroller");
			}

		}
		
	}
	function view_task_page(){
		$id_project = $this->input->post("id_project");

		$query = $this->db->query("
		select a.*, b.nama from task as a
		left join coordinator as b
		on a.est_pic = b.id
		where a.id_project = '$id_project'
		order by a.id asc
		");
		$no = 1;
		foreach($query->result() as $data){
			$id_task = $data->id;
			$a = $this->db->query("
			select count(id) as idku from todo where id_task = '$id_task'
			");
			$b = $a->row()->idku;

			$c = $this->db->query("
			select count(id) as idku from material where id_task = '$id_task'
			");
			$d = $c->row()->idku;

			echo '
			<tr>
			<td>'.$no.'</td>
			<td>
				<a href="'.base_url().'c_task/page_material/'.$id_task.'" data-toggle="tooltip" data-placement="top" title="Add Material" class="btn btn-sm btn-primary">
				<i class="fa fa-plus"></i> Material <span style="font-size:1.1em;" class="badge badge-primary">'.$d.'</span></a>
				<a href="'.base_url().'c_task/page_todolist/'.$id_task.'" data-toggle="tooltip" data-placement="top" title="Add To Do List" class="btn btn-sm btn-primary">
				<i class="fa fa-plus"></i> To Do List <span style="font-size:1.1em;" class="badge badge-danger">'.$b.'</span></a>
			</td>
			<td>'.$data->nama_task.'</td>
			<td>'.$data->est_start.'</td>
			<td>'.$data->est_end.'</td>
			<td>'.$data->nama.'</td>
			<td>'.$data->est_bobot.'%</td>
			</tr>
			';
		$no ++;	
		}	
	}

	function show_task_detail(){
		$id_project = $this->input->post("id_project");
		$query = $this->db->query("select a.id,a.nama_task, a.est_start, a.est_end, a.est_days,b.nama from task as a left join coordinator as b 
		on a.est_pic = b.id
		where id_project = '$id_project' order by a.id desc");

		$no = 1;
		foreach($query->result() as $data){
			$id_task = $data->id;
			$nama_task = $data->nama_task;
			$nama = $data->nama;
			$est_start = $data->est_start;
			$est_end = $data->est_end;
			$hari = $data->est_days;

			if($est_start == NULL){
				$ests = 'Estimated When Todolist Exist';
			}else{
				$ests = $est_start." s/d ".$est_end." [$hari Days]";
			}

			echo '
			<tr>
				<td>'.$no.'</td>
				<td>'.$nama_task.'</td>
				<td>'.$ests.'</td>
				<td>'.$nama.'</td>
				<td>
					<input type="text" name="idp" id="idp'.$no.'" value="'.$id_task.'" hidden>
					<a id="btn'.$no.'" type="submit" class="btn btn-sm btn-danger"> <i class="fa fa-trash"></i> Delete</a>
				</td>
			</tr>
			';
			echo '
			<script>
			$("#btn'.$no.'").click(function(){
				var id_task = $("#idp'.$no.'").val();
				//alert(id_task);
				$.ajax({  
					url: "'.base_url().'c_task/delete_task",
					method:"POST",
					data:{id_task:id_task},             
						success:function(data){
							alert(data);
							window.location.reload(true);
						}
				});
			})
			</script>
			';
			$no++;
		}
	}

	function delete_task(){
		$id_task = $this->input->post("id_task");
		//echo $id_task;
		$query = $this->db->query("delete from task where id ='$id_task'");
		if($query){
			echo 'success delete';
		}else{
			echo 'gagal';
		}
	}

	function padd_task($id){
		if($this->admin->logged_id())
        {
			$data['id_project']=$id;
            $this->load->view("plugin/plugin");
			$this->load->view("edit/va_task", $data);         

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("logincontroller");
        }
	}
	
	function add_task(){
		date_default_timezone_set("Asia/Jakarta");
		$id_project = $this->input->post("id_project");
		$task = $this->input->post("task");
		//$psc_awal = $this->input->post("psc_awal");
		//$psc_akhir = $this->input->post("psc_akhir");
		//$phours = $this->input->post("phours");
		//$pdurations = $this->input->post("pdurations");
		$res_internal = $this->input->post("res_internal");
		$res_external = $this->input->post("res_external");
		$pic = $this->input->post("pic");

		$add_by = $this->session->userdata('name');
		$add_at = date("Y-m-d h:i:s");

		$config['upload_path']="./uploads/task/";
		$lokasi = "uploads/task";
        //$config['allowed_types']='gif|jpg|png|docx|doc|pptx|xlsx|js|pdf|mp4|mkv|wmv|zip|rar|sql|xls';
		$config['allowed_types'] = '*';
		$config['detect_mime'] = false;
        $config['max_size'] = '0';
		$config['file_name'] = $task;
		$config['overwrite'] = TRUE;
		$this->load->library('upload',$config);

		if($this->upload->do_upload("file")){
	    	//batasan max size post upload php.ini upload_max_size : 500M;
	        $data = array('upload_data' => $this->upload->data());
	        $image = $data['upload_data']['file_name'];
			$attach = $lokasi."/".$image;

			$query = $this->db->query("
			insert into task 
			(id_project,nama_task,est_res_internal,est_res_external,est_pic,est_attachment,res_internal,res_external,pic,attachment,add_by,add_at) 
			values 
			('$id_project','$task','$res_internal','$res_external','$pic','$attach','$res_internal','$res_external','$pic','$attach','$add_by','$add_at')
			");
			$base = base_url();
			if($query){
				redirect("../c_task/task_page/$id_project");
			}else{
				echo '
				<script>alert("Insert Failed !");</script>
				';
			}

        }else{
			//$error = array('error' => $this->upload->display_errors());
			$query = $this->db->query("
			insert into task 
			(id_project,nama_task,est_res_internal,est_res_external,est_pic,est_attachment,res_internal,res_external,pic,add_by,add_at) 
			values 
			('$id_project','$task','$res_internal','$res_external','$pic','$attach','$res_internal','$res_external','$pic','$add_by','$add_at')
			");
			$base = base_url();
			if($query){
				redirect("../c_task/task_page/$id_project");
			}else{
				echo '
				<script>alert("Insert Failed !");</script>
				';
			}
		}
		
	}

	function page_material($id){
		if($this->admin->logged_id())
        {
			$data['id_task']=$id;
            $this->load->view("plugin/plugin");
			$this->load->view("group_estimasi/v-add-material", $data);         

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("logincontroller");
        }
	}
	function select_material(){
		$id_material = $this->input->post("id_material");
		$query = $this->db->query("select * from material where id='$id_material'");

		if($query->num_rows() < 1){

		}else{
			$i = 0;
			foreach($query->result() as $data){
				$material = $data->nama_material;
				$satuan	= $data->satuan;
				$harga = $data->est_harga;
				
				$dm[] = array();
				$dm[$i]['nama_material'] = $material;
				$dm[$i]['satuan'] = $satuan;
				$dm[$i]['harga'] = $harga;
	
				$i++;
			}
			header('Content-Type: application/json');
			echo json_encode($dm);
		}
		
	}
	function add_material(){
		date_default_timezone_set("Asia/Jakarta");
		$id_task = $this->input->post("id_task");
		$material = $this->input->post("nm_mat");
		$satuan = $this->input->post("satuan");
		$jumlah = $this->input->post("jml");
		$harga = $this->input->post("harga");
		$tharga = $this->input->post("tharga");
		$by = $this->session->userdata('name');
		$at = date("Y-m-d h:i:s");

		//cari id_project
		$q_cidp = $this->db->query("select id_project from task where id = '$id_task'");
		$r_cidp = $q_cidp->row()->id_project;

		//echo $id_task.'-'.$material.'-'.$satuan.'-'.$harga;
		$this->db->query("
		insert into material (id_task,nama_material,satuan,est_harga,est_jumlah,est_total_harga,add_by,add_at) 
		values('$id_task','$material','$satuan','$harga','$jumlah','$tharga','$by','$at')
		");

		$last_id = $this->db->query("
			select max(id) as latest_id from material
		");

		$latest_id = $last_id->row()->latest_id;

		$this->db->query("
		insert into material_history (id_task,id_material,nama_material,satuan,est_harga,est_jumlah,est_total_harga,add_by,add_at) 
		values('$id_task','$latest_id','$material','$satuan','$harga','$jumlah','$tharga','$by','$at')
		");
		
		$this->count_priority($id_task,$r_cidp);
	}

	function data_material(){
		$id_task = $this->input->post("id_task");
		$query = $this->db->query("select * from material where id_task = $id_task");
		$no = 1;
		foreach($query->result() as $data){
			echo '
			<tr>
				<td>'.$no.'</td>
				<td>'.$data->nama_material.'</td>
				<td>'.number_format($data->est_harga,2,',','.').'</td>
				<td>
					<input id="cek'.$no.'" type="text" value="'.$data->id.'" hidden>
					<input id="id_task'.$no.'" type="text" value="'.$id_task.'" hidden>
					<a id="a'.$no.'" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></a>
				</td>
			</tr>
			';
			echo '
			<script>
			$("#a'.$no.'").click(function(){
				var a = $("#cek'.$no.'").val();
				var b = $("#id_task'.$no.'").val();
				//alert(a);
				$.ajax({  
					url: "'.base_url().'" + "c_task/del_material",
					method:"POST",
					data:{a:a,b:b},             
						success:function(data){							
							//console.log(data);
							//alert(data);
							location.reload();
						}
				});
			})
			</script>
			';
			$no ++;
		}
	}
	function del_material(){
		$id_material = $this->input->post("a");
		$id_task = $this->input->post("b");

		$cek_mh = $this->db->query("select * from material where id = '$id_material'");
		$id_tm = $cek_mh->row()->id_task;
		$nmm = $cek_mh->row()->nama_material;
		$q_dmh = $this->db->query("DELETE FROM material_history WHERE id_task = '$id_tm' AND nama_material = '$nmm'");

		//echo $id_material;
		$query = $this->db->query("delete from material where id = '$id_material'");	

		$this->count_priority($id_task);	
		
		//$this->db->query("update project set prioritas = est_prioritas, prioritas_value = est_prioritas_value where id = '$r_cidp'");
	}
	function data_todo(){
		$id_task = $this->input->post("id_task");
		$query = $this->db->query("select * from todo where id_task = $id_task");
		$no = 1;
		foreach($query->result() as $data){
			if($data->status == 0){
				$status = 'Not Started';
			}else{
				$status = 'Finish';
			}
			echo '
			<tr>
				<td>'.$no.'</td>
				<td>'.$data->to_do.'</td>
				<td>'.$status.'</td>
				<td>
					<input id="cek'.$no.'" type="text" value="'.$data->id.'" hidden>
					<a data-toggle="tooltip" data-title="Delete '.$data->to_do.'" id="a'.$no.'" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></a>
				</td>
			</tr>
			';
			echo '
			<script>
			$("#a'.$no.'").click(function(){
				var id_todo = $("#cek'.$no.'").val();
				//alert(id_todo);
				$.ajax({  
					url: "'.base_url().'" + "c_task/del_todo",
					method:"POST",
					data:{id_todo},             
						success:function(data){							
							//console.log(data);
							//alert(data);
							location.reload();
						}
				});
			})
			</script>
			';
			$no ++;
		}
	}
	function del_todo(){
		$id_todo = $this->input->post("id_todo");

		$cek_idtask = $this->db->query("
			select id_task,to_do from todo where id = '$id_todo'
		"); 
		$id_task = $cek_idtask->row()->id_task;
		$tdh = $cek_idtask->row()->to_do;

		$del_hist = $this->db->query("delete from todo_history where id_task = '$id_task' and to_do = '$tdh'");

		$cek_idpro = $this->db->query("
			select id_project from task where id = '$id_task'
		");
		$id_project = $cek_idpro->row()->id_project;
		
		//echo $id_todo;
		$query = $this->db->query("delete from todo where id = '$id_todo'");

		$cek_mins = $this->db->query("
			select min(est_start) as ests, max(est_finish) as estf from todo where id_task = '$id_task'
		");
		$est_min = $cek_mins->row()->ests; //min date todolist with id task = $id_task
		$est_max = $cek_mins->row()->estf; //max date todolist with id task = $id_task

		$date1 = new DateTime($est_min);
		$date2 = new DateTime($est_max);

		$diff = $date2->diff($date1);
		$hari = $diff->format('%a');

		$t1 = StrToTime($est_min);
		$t2 = StrToTime($est_max);
		$diff = $t2 - $t1;
		$hours = $diff / ( 60 * 60 );

		$updt = $this->db->query("
		update task set bobot = est_bobot, est_start = '$est_min', est_end = '$est_max', est_hours = '$hours', est_days = '$hari' 
		where id = '$id_task'
		");

		$cek_mintask = $this->db->query("
		select min(est_start) as min_task, max(est_end) as max_task from task where id_project = '$id_project' and est_start != '0000-00-00'
		");
		$min_task = $cek_mintask->row()->min_task;
		$max_task = $cek_mintask->row()->max_task;

		$date3 = new DateTime($min_task);
		$date4 = new DateTime($max_task);

		$diff3 = $date4->diff($date3);
		$hari2 = $diff3->format('%a');

		$t1 = StrToTime($min_task);
		$t2 = StrToTime($max_task);
		$diff4 = $t2 - $t1;
		$hours2 = $diff4 / ( 60 * 60 );

		$updt_pro = $this->db->query("
		update project set est_mulai = '$min_task', est_selesai = '$max_task', est_jam = '$hours2', est_hari = '$hari2' 
		where id = '$id_project'
		");

	}
	function page_todolist($id){
		if($this->admin->logged_id())
        {
			$data['id_task']=$id;
            $this->load->view("plugin/plugin");
			$this->load->view("group_estimasi/v-add-todo", $data);         

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("logincontroller");
        }
	}

	function add_todo(){
		$id_task = $this->input->post("id_task");
		$todo = $this->input->post("todo");
		$start = $this->input->post("mulai");
		$finish = $this->input->post("selesai");

		$by = $this->session->userdata('name');
		$at = date("Y-m-d h:i:s");

		//echo $id_task.'-'.$todo.'-'.$start.'-'.$finish;
		$query = $this->db->query("
			insert into todo (id_task,to_do,est_start,est_finish,update_by)
			values
			('$id_task','$todo','$start','$finish','$by')	
		");
		//insert histori
		$this->db->query("
			insert into todo_history (id_task,to_do,est_start,est_finish,update_date,update_by)
			values
			('$id_task','$todo','$start','$finish','0000-00-00','$by')	
		");

		$cek_mins = $this->db->query("
		select min(est_start) as ests, max(est_finish) as estf from todo where id_task = '$id_task'
		");
		$est_min = $cek_mins->row()->ests; //min date todolist with id task = $id_task
		$est_max = $cek_mins->row()->estf; //max date todolist with id task = $id_task

		$date1 = new DateTime($est_min);
		$date2 = new DateTime($est_max);

		$diff = $date2->diff($date1);
		$hari = $diff->format('%a');

		$t1 = StrToTime($est_min);
		$t2 = StrToTime($est_max);
		$diff = $t2 - $t1;
		$hours = $diff / ( 60 * 60 );

		$updt = $this->db->query("
		update task set bobot = est_bobot, est_start = '$est_min', est_end = '$est_max', est_hours = '$hours', est_days = '$hari' 
		where id = '$id_task'
		");

		$idpt = $this->db->query("
		select id_project from task where id = '$id_task'
		");
		$id_project = $idpt->row()->id_project;

		$cek_mintask = $this->db->query("
		select min(est_start) as min_task, max(est_end) as max_task from task where id_project = '$id_project'
		");
		$min_task = $cek_mintask->row()->min_task;
		$max_task = $cek_mintask->row()->max_task;

		$date3 = new DateTime($min_task);
		$date4 = new DateTime($max_task);

		$diff3 = $date4->diff($date3);
		$hari2 = $diff3->format('%a');

		$t1 = StrToTime($min_task);
		$t2 = StrToTime($max_task);
		$diff4 = $t2 - $t1;
		$hours2 = $diff4 / ( 60 * 60 );

		$updt_pro = $this->db->query("
		update project set est_mulai = '$min_task', est_selesai = '$max_task', est_jam = '$hours2', est_hari = '$hari2' 
		where id = '$id_project'
		");

		$this->count_weight($id_task);
		
		
	}

	function count_priority($id_task,$r_cidp){
		//setelah insert material hitung budget per id task (estimasi)
		// 1. hitung budget dari material
		$cek_budget = $this->db->query("
		select sum(est_total_harga) as budget from material where id_task = '$id_task'
		");
		$row_budget = $cek_budget->row();
		$est_budget = $row_budget->budget;

		// 2. Update budget  task hasil hitung sum dari material
		/*$update = $this->db->query("
		update task set est_budget = '$est_budget', budget = '$est_budget' where id = '$id_task'
		");*/
		$update = $this->db->query("
		update task set est_budget = '$est_budget' where id = '$id_task'
		");
		
		//cek total budget pada task per id project
		// 1. Select id project dari task
		$cek_idp = $this->db->query("select id_project from task where id= '$id_task'");
		$id_pro = $cek_idp->row();
		$id_project = $id_pro->id_project;

		// 2. sum/jumlahkan total budget dari task dengan id project tertentu
		$sum = $this->db->query("select sum(est_budget) as est_budget from task where id_project = '$id_project'");
		$r_sum = $sum->row();
		$total = $r_sum->est_budget;

		//update budget pada project dengan id tertentu
		$qu_pro = $this->db->query("update project set est_budget = '$total' where id = '$id_project'");

		//hitung total point untuk menghasilkan priority project
		// 1. select column yg diperlukan utk mnghitung priority
		$qs_prior = $this->db->query("select kategori,est_budget,resource,est_hari,complexity from project where id = '$id_project'");
		$fr = $qs_prior->row();
		$kat = $fr->kategori;
		$bdgt = $fr->est_budget;
		$res = $fr->resource;
		$days = $fr->est_hari;
		$complex = $fr->complexity;

		$kategori = substr_count($kat, ",");
		$p_kat = $kategori+1;      //kategori point
		$val_ket1 = $p_kat*5;			
		$val_ket = $val_ket1*0.30;		// ==========================fix value

		if($bdgt <= 15000000){
			$budget = 3;
		}
		elseif($bdgt > 16000000 && $bdgt <= 50000000){
			$budget = 5;
		}
		elseif($bdgt > 50000000 && $bdgt <= 100000000){
			$budget = 7;
		}
		elseif($bdgt > 100000000 && $bdgt <= 250000000){
			$budget = 10;
		}
		elseif($bdgt > 250000000 && $bdgt <= 500000000){
			$budget = 15;
		}
		elseif($bdgt > 500000000 && $bdgt <= 1000000000){
			$budget = 20;
		}
		elseif($bdgt > 1000000000){
			$budget = 25;
		}
		$val_budget = $budget*0.20;			// ==========================fix value
		
		if($res == '1'){
			$resource = '10';
		}elseif($res == '2'){
			$resource = '10';
		}elseif($res == '3'){
			$resource = '20';
		}else{
			$resource = '';
		}
		$val_resource = $resource*0.15;			// ==========================fix value

		if($days <= '30'){
			$bln = '3';
		}
		elseif($days > '30' && $days <= '60'){
			$bln = '6';
		}
		elseif($days > '60' && $days <= '90'){
			$bln = '9';
		}
		elseif($days > '90' && $days <= '120'){
			$bln = '15';
		}
		elseif($days > '120' && $days <= '150'){
			$bln = '20';
		}elseif($days > '150'){
			$bln = '20';
		}
		$val_bln = $bln*0.15;					// ==========================fix value
		//echo $val_bln;

		$comp = substr_count($complex, ",");
		$complexity = $comp+1;
		$val_com1 = $complexity*5; 
		$val_com = $val_com1*0.20;				// ==========================fix value

		//===================hitung point hasil render dari rumus priority
		$priority = ($val_ket+$val_budget)+($val_resource+$val_bln)+$val_com;
		//jika <= 9 = bronze, >9 & <=18 = silver, > 18 = gold
		if($priority <= 9){
			$val_priority = 'BRONZE';
		}elseif($priority > 9 && $priority <= 18){
			$val_priority = 'SILVER';
		}elseif($priority > 18){
			$val_priority = 'GOLD';
		}else{
			$val_priority = 'UNKNOWN';
		}
		//========================update priority hasil perhitungan
		$update_priority = $this->db->query("update project set est_prioritas = '$val_priority', est_prioritas_value = '$priority' where id = '$id_project'");
		
		$act_prio = $this->db->query("update project set prioritas = est_prioritas, prioritas_value = est_prioritas_value where id = '$r_cidp'");
		
		redirect("c_task/page_material/$id_task");
	}

	function count_weight($id_task){
		//cari id project dari id task
		$query_idp = $this->db->query("select id_project from task where id = '$id_task'");
		$row_idp = $query_idp->row();
		$idp = $row_idp->id_project;

		//echo "id_projecct :".$idp."</br>";
		//cari id_task berdasarkan id project
		$query_idt = $this->db->query("select group_concat(id separator ',') as id from task where id_project = '$idp'");
		$row_idt = $query_idt->row();
		$idt = $row_idt->id;
		//echo "id_task :".$idt."</br>";

		$cari_task = $this->db->query("select id from task where id_project = '$idp'");
		foreach($cari_task->result() as $data){
			//hitung total todo per project 
			$idt_foreach = $data->id;
			$query_hitung_todo = $this->db->query("select count(id) as id from todo where id_task in($idt)");
			$row_todo = $query_hitung_todo->row();
			$total_todo = $row_todo->id;
			//echo "total todo / project".$total_todo."</br>";
			//echo $idt_foreach;
			
			// cari total todo per task
			$todo_task = $this->db->query("select count(id) as id from todo where id_task = '$idt_foreach'");
			$row_todo_task = $todo_task->row();
			$total_todo_task = $row_todo_task->id;
			//echo "Total Todo / Task".$total_todo_task."</br>";
			
			$hitung = $total_todo_task/$total_todo*100;
			//echo $hitung."</br>";
			//echo round(39.130434782609,2);
			$bobot = round($hitung);
			//echo "Bobot :".round($hitung);
			//.update estimasi bobot 
			$query = $this->db->query("update task set est_bobot = '$bobot', bobot = '$bobot' where id = '$idt_foreach'");
			
			//cari id task berdasarkan id project untuk fungsi update auto all task
		}
		redirect("c_task/page_todolist/$id_task");
	}
} //TUTUP CONTROLLER
