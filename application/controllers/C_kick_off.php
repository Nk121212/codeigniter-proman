<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_kick_off extends CI_Controller {
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
    function view_project(){
		$query = $this->db->query("
			select a.*, b.nama_status from project as a left join status_project as b on a.status = b.id where a.status = 1
		");
		$no = 1;
		foreach($query->result() as $data){
            $id_project = $data->id;
            $stat = $data->nama_status;
			echo '
			<tr>
				<td>'.$no.'</td>
				<td>'.$data->nama_project.'</td>
				<td>'.$data->est_mulai.'</td>
				<td>'.$data->est_selesai.'</td>
				<td>'.$data->est_prioritas.'</td>
                <td>
                    <input type="text" value="'.$id_project.'" id="idp'.$no.'" hidden>
                    <span data-toggle="modal" data-target="#modal_project">
                        <a id="stat'.$no.'" data-toggle="tooltip" data-placement="top" title="Change Status" class="btn btn-sm btn-primary">'.$stat.'</a>
                    </span>
				</td>
			</tr>
            ';
            echo '
            <script>
            $("#stat'.$no.'").click(function(){
                var idp = $("#idp'.$no.'").val();
                //alert(idp);
                $("#id_project").val(idp);
            })
            </script>
            ';
			$no ++;
		}
    }

    function fetch_project(){
        $id_project = $this->input->post("id_project");
        $query = $this->db->query("select status from project where id = '$id_project'");
        $i = 0;
        foreach($query->result() as $data){
            $p_data[] = array();
            $p_data[$i]['status'] = $data->status;
            $i++;
        }
        header('Content-Type: application/json');
		echo json_encode($p_data);

    }
    function update_status(){
        $id_project = $this->input->post("id_project");
        $date_update = $this->input->post("date_update");
        $status = $this->input->post("sp");

        $query = $this->db->query("
        update project set status = '$status', mulai = '$date_update' where id = '$id_project';
        ");
        if($query){
            echo "berhasil update status = '.$status.', mulai = '.$date_update.', id project = '.$id_project.'";
        }else{
            echo "error";
        }
    }

    function page_update_task(){
        if($this->admin->logged_id())
        {
			$this->load->view("plugin/plugin");
			$this->load->view("group_actual/v-update-task");         

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("logincontroller");
        }
    }
    function tbl_update_task(){
		$query = $this->db->query("
			select a.*, b.nama_status 
			from project as a 
			left join status_project as b 
			on a.status = b.id 
			where estimasi = 2 order by id desc
			");
		$no = 1;
		foreach($query->result() as $data){
            $id_project = $data->id;
            $stat = $data->nama_status;
			echo '
			<tr>
				<td>'.$no.'</td>
				<td>
					<input type="text" value="'.$id_project.'" id="idp'.$no.'" hidden>
					<a href="'.base_url().'c_kick_off/add_task_page/'.$id_project.'" data-toggle="tooltip" data-placement="top" title="Add Task" class="btn btn-sm btn-primary">
					<i class="fa fa-plus"></i> Add Task</a>
					<a href="'.base_url().'c_kick_off/view_update_task/'.$id_project.'" data-toggle="tooltip" data-placement="top" title="View Task" class="btn btn-sm btn-warning">
					<i class="fa fa-eye"></i> View Task</a>
				</td>
				<td>'.$data->nama_project.'</td>
				<td>'.$data->mulai.'</td>
				<td>'.$data->selesai.'</td>
                <td>'.$data->prioritas.'</td>
                <td>'.$stat.'</td>
			</tr>
            ';
            echo '
            <script>
            $("#stat'.$no.'").click(function(){
                var idp = $("#idp'.$no.'").val();
                //alert(idp);
                $("#id_project").val(idp);
            })
            </script>
            ';
			$no ++;
		}
    }

    function add_task_page($id){
        if($this->admin->logged_id())
        {
            $data['id_project']=$id;
            $this->load->view("plugin/plugin");
            $this->load->view("group_actual/vu-add-task", $data);         
    
        }else{
    
            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("logincontroller");
        }
	}
	
    function view_update_task($id){
        if($this->admin->logged_id())
        {
			$data['id_project']=$id;
            $this->load->view("plugin/plugin");
			$this->load->view("group_actual/vu-view-task", $data);         

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("logincontroller");
        }
    }

    function vu_task_page(){
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
            echo '
            <tr>
            <td>'.$no.'</td>
            <td>
                <a href="'.base_url().'c_kick_off/page_material/'.$id_task.'" data-toggle="tooltip" data-placement="top" title="Add Material" class="btn btn-sm btn-primary">
                <i class="fa fa-plus"></i> Material</a>
                <a href="'.base_url().'c_kick_off/page_todolist/'.$id_task.'" data-toggle="tooltip" data-placement="top" title="Add To Do List" class="btn btn-sm btn-primary">
				<i class="fa fa-plus"></i> To Do List</a>
				<a href="'.base_url().'c_kick_off/update_task/'.$id_task.'" data-toggle="tooltip" data-placement="top" title="Edit Task" class="btn btn-sm btn-warning">
				<i class="fa fa-refresh"></i> Edit Task</a>
            </td>
            <td>'.$data->nama_task.'</td>
            <td>'.$data->start.'</td>
            <td>'.$data->end.'</td>
			<td>'.$data->nama.'</td>
			<td>'.$data->bobot.'%</td>
            </tr>
            ';
        $no ++;	
        }
	}
	
	function update_task($id_task){
		if($this->admin->logged_id())
        {
			$data['id_task']=$id_task;
            $this->load->view("plugin/plugin");
			$this->load->view("group_actual/vu-task", $data);         

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("logincontroller");
        }
	}

	function view_dt(){
		$id_task = $this->input->post("id_task");
		$query = $this->db->query("
		select * from task where id = '$id_task'
		");
		$i = 0;
		foreach($query->result() as $data){
			$external = $data->est_res_external;
			if($external == 0){
				$r_ext = '-';
			}else{
				$r_ext = $external;
			}
			$det[] = array();
			$det[$i]['nama_task'] = $data->nama_task;
			$det[$i]['start'] = $data->est_start;
			$det[$i]['finish'] = $data->est_end;
			$det[$i]['jam'] = $data->est_hours;
			$det[$i]['hari'] = $data->est_days;
			$det[$i]['r_int'] = $data->est_res_internal;
			$det[$i]['r_ext'] = $r_ext;
			$det[$i]['attachment'] = $data->est_attachment;
			$det[$i]['pic'] = $data->est_pic;
			$i++;
		}
		header('Content-Type: application/json');
		echo json_encode($det);
	}

	function edit_task(){
		$id_task = $this->input->post("id_task");
		echo $id_task;
		
	}

    function add_task(){
        $id_project = $this->input->post("id_project");
		$task = $this->input->post("task");
		$psc_awal = $this->input->post("psc_awal");
		$psc_akhir = $this->input->post("psc_akhir");
		$phours = $this->input->post("phours");
		$pdurations = $this->input->post("pdurations");
		$res_internal = $this->input->post("res_internal");
		$res_external = $this->input->post("res_external");
		$pic = $this->input->post("pic");

		$config['upload_path']="./uploads/project/";
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
			(id_project,nama_task,est_start,est_end,est_hours,est_days,est_res_internal,est_res_external,est_pic,est_attachment) 
			values 
			('$id_project','$task','$psc_awal','$psc_akhir','$phours','$pdurations','$res_internal','$res_external','$pic','$attach')
			");
			$base = base_url();
			if($query){
				redirect("../c_kick_off/add_task_page/$id_project");
			}else{
				echo '
				<script>alert("Insert Failed !");</script>
				';
			}

        }else{
			$error = array('error' => $this->upload->display_errors());
		}
    }

    function page_material($id){
		if($this->admin->logged_id())
        {
			$data['id_task']=$id;
            $this->load->view("plugin/plugin");
			$this->load->view("group_actual/vu-add-material", $data);         

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("logincontroller");
        }
    }
    function select_material(){
		$id_material = $this->input->post("id_material");
		$query = $this->db->query("select * from material where id = '$id_material'");
		$i = 0;
		foreach($query->result() as $data){
			$material = $data->nama_material;
			$satuan	= $data->satuan;
			$harga = $data->est_harga;
			
            $dm[] = array();
            $dm[$i]['id'] = $data->id;
			$dm[$i]['nama_material'] = $material;
			$dm[$i]['satuan'] = $satuan;
			$dm[$i]['harga'] = $harga;

			$i++;
		}
		header('Content-Type: application/json');
		echo json_encode($dm);
    }
    function data_material(){
		$id_task = $this->input->post("id_task");
		$query = $this->db->query("select a.*, b.nama_satuan as nm_sat 
		from material as a left join satuan as b on a.satuan = b.id where a.id_task = '$id_task'");
		$no = 1;
		foreach($query->result() as $data){
			echo '
			<tr>
				<td>'.$no.'</td>
				<td>'.$data->nama_material.'</td>
				<td>'.$data->nm_sat.'</td>
                <td>'.$data->harga.'</td>
                <td>'.$data->jumlah.'</td>
                <td>'.$data->total_harga.'</td>
                
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
    function add_material(){
        $id_material = $this->input->post("id_material");
        $id_task = $this->input->post("id_task");
		$material = $this->input->post("nm_mat");
		$satuan = $this->input->post("satuan");
		$jumlah = $this->input->post("jml");
		$harga = $this->input->post("harga");
		$tharga = $this->input->post("tharga");

		//echo 'insert baru langsung actual tanpa estimasi';
		$query = $this->db->query("
		insert into material (id_task,nama_material,satuan,harga,jumlah,total_harga) 
		values('$id_task','$material','$satuan','$harga','$jumlah','$tharga')
		");	

		$cek_master = $this->db->query("select * from material_master where nama_material = '$material' AND satuan = '$satuan' AND harga = '$harga'");
		if($cek_master->num_rows() < 1){
			$insert_master = $this->db->query("
			insert into material_master (id_task,nama_material,satuan,harga,jumlah,total_harga) 
			values('$id_task','$material','$satuan','$harga','$jumlah','$tharga')
			");	
		}else{
			$update_master = $this->db->query("
			update material_master 
			set id_task = '$id_task', nama_material = '$material', satuan = '$satuan', harga = '$harga', jumlah = '$jumlah', total_harga = '$tharga'");
		}

		$hitung_prioritas = $this->real_priority($id_task);

		if($hitung_prioritas){
			redirect("c_kick_off/page_material/$id_task");
		}else{
			echo 'Error';
		}

    }
    
    function del_material(){
		$id_material = $this->input->post("a");
		$id_task = $this->input->post("b");
		//echo $id_material;
		$query = $this->db->query("delete from material where id = '$id_material'");	

		$hitung_prioritas = $this->real_priority($id_task);	

		if($hitung_prioritas){
			redirect("c_kick_off/page_material/$id_task");
		}else{
			echo 'Error';
		}
		
    }
    
    function page_todolist($id){
		if($this->admin->logged_id())
        {
			$data['id_task']=$id;
            $this->load->view("plugin/plugin");
			$this->load->view("group_actual/vu-add-todo", $data);         

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("logincontroller");
        }
	}
	function data_todo(){
		$id_task = $this->input->post("id_task");
		$query = $this->db->query("select * from todo where id_task = $id_task");
		$no = 1;
		foreach($query->result() as $data){
			if($data->status == 0){
				$status = '<i class="fa fa-hourglass-start"></i> Not Started</a>';
			}elseif($data->status == 1){
				$status = '<i class="fa fa-hourglass-half"></i> Started</a>';
			}else{
				$status = '<i class="fa fa-hourglass-end"></i> Finish</a>';
			}
			echo '
			<tr style="text-align:center;">
				<td>'.$no.'</td>
				<td>'.$data->to_do.'</td>
				<td>'.$data->start.'</td>
				<td>'.$data->finish.'</td>				
				<td>
					<input id="cek'.$no.'" type="text" value="'.$data->id.'" hidden>
					<span data-toggle="modal" data-target="#modal_start">
						<a data-toggle="tooltip" data-title="Update Status" id="b'.$no.'" class="btn btn-sm btn-primary">
						'.$status.'
					</span>
				</td>
				<td>
					<span data-toggle="modal" data-target="#md_todo">
						<a id="a'.$no.'" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a>
					</span>
				</td>
			</tr>
			';
			echo '
			<script>
			$("#b'.$no.'").click(function(){
				var a = $("#cek'.$no.'").val();
				//alert(a);
				$("#id_todo").val(a);
			})
			$("#a'.$no.'").click(function(){
				var a = $("#cek'.$no.'").val();
				//alert(a);
				$("#idto").val(a);
			})
			</script>
			';
			$no ++;
		}
	}

	function status_todo(){
		$id_todo = $this->input->post("id_todo");
		$stat_todo = $this->input->post("status_todo");
		$date_todo = $this->input->post("date_todo");

		//cari id task buat reload
		$cari_idt = $this->db->query("select id_task from todo where id='$id_todo'");
		$row_idt = $cari_idt->row();
		$id_task = $row_idt->id_task;

		//cari id_project
		$q_cidp = $this->db->query("select id_project from task where id = '$id_task'");
		$r_cidp = $q_cidp->row()->id_project;

		if($stat_todo == '0'){
			//Not Started kembalikan field start menjadi null dan update status menjadi 0
			$query = $this->db->query("
			update todo set start = DEFAULT(start), finish = DEFAULT(finish), status = '$stat_todo' where id='$id_todo'
			");
			//update start task 
			$update = $this->db->query("
			update task set start = DEFAULT(start), end = DEFAULT(end) where id = '$id_task'
			");

		}elseif($stat_todo == '1'){
			//Started update date start todo dari value date_todo dan update status menjadi 1
			$query = $this->db->query("
			update todo set start = '$date_todo', finish = DEFAULT(finish), status = '$stat_todo' where id='$id_todo'
			");

			//select min date dari start date todo menjadi start task dari todolist tersebut
			$q_min = $this->db->query("
			select min(start) as minimal from todo where id_task = '$id_task' and start IS NOT NULL
			");

			$r_min = $q_min->row();
			$min = $r_min->minimal;

			if($min == NULL || $min == ""){
				//update start date task menjadi null
				$update = $this->db->query("
				update task set start = DEFAULT(start), end = DEFAULT(end) where id = '$id_task'
				");
			}else{
				//update start date task 
				$update = $this->db->query("
				update task set start = '$min' where id = '$id_task'
				");

			}

			//cari minimal date dari task setelah update status todo
			$q_pmin = $this->db->query("
			select min(start) as minimal from task where id = '$id_task' and start IS NOT NULL
			");

			$r_pmin = $q_pmin->row();
			$pmin = $r_pmin->minimal;

			if($pmin == NULL || $pmin == ""){
				//update start date task menjadi null
				$update = $this->db->query("
				update project set mulai = DEFAULT(mulai) where id = '$r_cidp'
				");
			}else{
				//update start date task 
				$update = $this->db->query("
				update project set mulai = '$pmin' where id = '$r_cidp'
				");

			}
			
		}elseif($stat_todo == '2'){
			//cek data start
			$q_cds = $this->db->query("select start from todo where id='$id_todo'");
			$r_cds = $q_cds->row();
			$cds = $r_cds->start;
			//echo $cds;
			if($cds == NULL || $cds == ""){
				//echo 'tidak boleh update tanggal finish todo';
			}else{
				//echo 'boleh update tanggal finish';

				$query = $this->db->query("
				update todo set finish = '$date_todo', status = '$stat_todo' where id='$id_todo'
				");
	
				//cek finish date tiap todolist 
				//jika masih ada yg kosong finish task null
				//jika sudah ada semua cari max date dari todolist
				$cek_finish = $this->db->query("select finish from todo where id_task = '$id_task' order by finish desc");
	
				foreach($cek_finish->result() as $data){	
					$finish_todo = $data->finish;
				}
	
				if($finish_todo == null || $finish_todo == "" || $finish_todo == "0000-00-00"){
					//echo 'finish task kosongkan';
					$q_finish = $this->db->query("update task set end = DEFAULT(end) where id='$id_task'");
				}else{
					//echo 'update finish dari min';
					$q_max = $this->db->query("select max(finish) as maximal from todo where id_task='$id_task'");
					$q_row = $q_max->row();
					$max = $q_row->maximal;
					//echo $max;
					$q_finish = $this->db->query("update task set end = '$max' where id='$id_task'");
				}

				//select finish date dari task jika masih ada yang null maka jangan update finish date project
				$q_cfd = $this->db->query("select end from task where id_project = '$r_cidp' order by end desc");
				foreach($q_cfd->result() as $data){
					$end_task = $data->end;
				}
				if($end_task == NULL || $end_task == "" || $end_task == "0000-00-00"){
					//jangan update finish project
					$q_udf = $this->db->query("
						update project set selesai = DEFAULT(selesai), jam = DEFAULT(jam), hari = DEFAULT(hari), status= '2' where id = '$r_cidp'
					");
				}else{
					//cari max date dari task berdasarkan id project
					$q_mt = $this->db->query("select max(end) as max_task from task where id_project = '$r_cidp'");
					$r_mt = $q_mt->row()->max_task;

					//update finish date project dari max end task
					$q_udf = $this->db->query("update project set selesai ='$r_mt' where id = '$r_cidp'");

					//select start dan finish actual untuk mendapatkan jam dan hari actual
					$q_ssf = $this->db->query("select mulai, selesai from project where id = '$r_cidp'");
					$r_sp = $q_ssf->row()->mulai;
					$r_fp = $q_ssf->row()->selesai;

					$date1 = new DateTime($r_sp);
					$date2 = new DateTime($r_fp);

					$diff = $date2->diff($date1);
					$hari = $diff->format('%a');

					$t1 = StrToTime($r_sp);
					$t2 = StrToTime($r_fp);
					$diff = $t2 - $t1;
					$hours = $diff / ( 60 * 60 );

					$q_usf = $this->db->query("update project set jam = '$hours', hari = '$hari', status = '4' where id = '$r_cidp'");
					$hitung_prioritas = $this->real_priority($id_task);
				}
				
			}
		}

		$hitung_bobot = $this->count_weight($id_task);

		redirect("c_kick_off/page_todolist/$id_task");
	}

	function del_todo(){
		$id_todo = $this->input->post("idto");

		$q_idt = $this->db->query("
		select id_task from todo where id = '$id_todo'
		");
		$r_idt = $q_idt->row();
		$id_task = $r_idt->id_task;

		$query = $this->db->query("
		delete from todo where id='$id_todo'
		");

		$this->count_weight($id_task);

		redirect("c_kick_off/page_todolist/$id_task");
	}

	function add_todo(){
		$id_task = $this->input->post("id_task");
		$todo = $this->input->post("todo");
		$start = $this->input->post("mulai");
		$finish = $this->input->post("selesai");

		//cari id_project untuk update project
		$cari_idp = $this->db->query("
		select id_project from task where id='$id_task'
		");
		$id_pro = $cari_idp->row()->id_project;

		//echo $id_task.'-'.$todo.'-'.$start.'-'.$finish;
		$query = $this->db->query("
			insert into todo (id_task,to_do,est_start,est_finish)
			values
			('$id_task','$todo','$start','$finish')	
		");

		$f_task = $this->db->query("update task set end = DEFAULT(end) where id='$id_task'");

		$update_project = $this->db->query("
			update project set selesai = DEFAULT(selesai), jam = DEFAULT(jam), hari = DEFAULT(hari), status = '2' where id = '$id_pro'
		");

		$this->count_weight($id_task);
		$this->real_priority($id_task);

		$q_bt = $this->db->query("select bobot from task where id = ");

		redirect("c_kick_off/page_todolist/$id_task");
	}
    
    function real_priority($id_task){
		//setelah insert material hitung budget per id task (estimasi)
		// 1. hitung budget dari material
		$cek_budget = $this->db->query("
		select sum(total_harga) as budget from material where id_task = '$id_task' and type= '2'
		");
		$row_budget = $cek_budget->row();
		$budget = $row_budget->budget;

		// 2. Update budget  task hasil hitung sum dari material
		$update = $this->db->query("
		update task set budget = '$budget' where id = '$id_task'
		");

		//cek total budget pada task per id project
		// 1. Select id project dari task
		$cek_idp = $this->db->query("select id_project from task where id= '$id_task'");
		$id_pro = $cek_idp->row();
		$id_project = $id_pro->id_project;

		// 2. sum/jumlahkan total budget dari task dengan id project tertentu
		$sum = $this->db->query("select sum(budget) as budget from task where id_project = '$id_project'");
		$r_sum = $sum->row();
		$total = $r_sum->budget;

		//update budget pada project dengan id tertentu
		$qu_pro = $this->db->query("update project set used_budget = '$total' where id = '$id_project'");

		//hitung total point untuk menghasilkan priority project
		// 1. select column yg diperlukan utk mnghitung priority
		$qs_prior = $this->db->query("select kategori,used_budget,resource,hari,complexity from project where id = '$id_project'");
		$fr = $qs_prior->row();
		$kat = $fr->kategori;
		$bdgt = $fr->budget;
		$res = $fr->resource;
		$days = $fr->hari;
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
		$val_budget = ($budget*0.20);			// ==========================fix value
		
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
		$update_priority = $this->db->query("
			update project set prioritas = '$val_priority', prioritas_value = '$priority' where id = '$id_project'
		");

	}

	function count_weight($id_task){
		//cari id project dari id task
		$query_idp = $this->db->query("select id_project from task where id = '$id_task'");
		$row_idp = $query_idp->row();
		$idp = $row_idp->id_project;

		echo "id_projecct :".$idp."</br>";
		//cari id_task berdasarkan id project
		$query_idt = $this->db->query("select group_concat(id separator ',') as id from task where id_project = '$idp'");
		$row_idt = $query_idt->row();
		$idt = $row_idt->id;
		echo "id_task :".$idt."</br>";

		$cari_task = $this->db->query("select id from task where id_project = '$idp'");
		foreach($cari_task->result() as $data){
			//hitung total todo per project 
			$idt_foreach = $data->id;
			$query_hitung_todo = $this->db->query("select count(id) as id from todo where id_task in($idt)");
			$row_todo = $query_hitung_todo->row();
			$total_todo = $row_todo->id;
			echo "total todo / project".$total_todo."</br>";
			echo $idt_foreach."</br>";
			
			// cari total todo per task
			$todo_task = $this->db->query("select count(id) as id from todo where id_task = '$idt_foreach'");
			$row_todo_task = $todo_task->row();
			$total_todo_task = $row_todo_task->id;
			echo "Total Todo / Task".$total_todo_task."</br>";
			
			$hitung = ($total_todo_task/$total_todo)*100;
			echo $hitung."</br>";
			//echo round(39.130434782609,2);
			$bobot = round($hitung);
			echo "Bobot :".round($hitung)."</br>";
			//.update estimasi bobot 
			$query = $this->db->query("update task set bobot = '$bobot' where id = '$idt_foreach'");
			//redirect("c_kick_off/page_todolist/$id_task");
		}
	}

} //TUTUP CONTROLLER
