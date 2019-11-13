<?php
class M_task extends CI_Model{

	//fungsi menampilkan tabel
	function project_data(){
		$query = $this->db->query("select * from act_project");
		$no = 1;
		foreach($query->result() as$data){
			$id = $data->id;
			$nm_project = $data->act_pname;

			$start = $data->act_pstart;
			$mulai = date('d/m/Y', strtotime($start));
			$end = $data->act_pend;
			$selesai = date('d/m/Y', strtotime($end));

			$range = $data->act_pdays;
			$add_by = $data->act_add_by;
			$add_at = $data->act_add_at;

			echo '
			<tr>
				<td>'.$no.'</td>
				<td>
					<input type="text" value="'.$id.'" id="id_pro'.$no.'" hidden>
					<a href="t_detail/'.$id.'" class="btn-floating btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="View Task">
						<i class="fa fa-eye"></i> 
					</a>
				</td>
				<td><a href="#p_detail" id="nm_project'.$no.'" data-toggle="modal"><u><p>'.$nm_project.'</p></u></a></td>
				<td>'.$mulai.'</td>
				<td>'.$selesai.'</td>
				<td>'.$range.' Hari</td>
				<td>'.$add_by.'</td>
				<td>'.$add_at.'</td>
				</tr>
			</tr>';
			echo '
			<script type="text/javascript">
				$("#add_task'.$no.'").click(function(){
					var id = $("#id_pro'.$no.'").val();
					$("#val_p").val(id);
				})
				$("#nm_project'.$no.'").click(function(){
					var id = $("#id_pro'.$no.'").val();
					$("#idp").val(id);
				})

			</script>
			';

			$no++;
			
		}
	}

	//menampilkan detail progress
	function p_progress(){
		echo '
		<table class="table table-stripped" style="text-align:center;">
		<tr>
			<th>Purpose</th>
			<th>Budget</th>
			<th>Area</th>
			<th>Progress</th>
		</tr>
		';
		$id_project = $this->input->post("id");
		$query = $this->db->query("select * from act_task where id_act_project='$id_project'");

		$cek_loc = $this->db->query("select act_plocation from act_project where id='$id_project'");
		$a = $cek_loc->row();
		$b = $a->act_plocation;

		$query2 = $this->db->query("select act_project.*, departemen.nama_departemen as nama_dept from act_project 
		left join departemen on departemen.id IN($b) where act_project.id=$id_project group by nama_dept");
		$departemen = "";
		foreach($query2->result() as $data){
			$tujuan = $data->act_ppurpose;
			$departemen .= $data->nama_dept."|";

			$rbudget = $data->act_pbudget;
			$sbudget = number_format($rbudget,2,',','.'); //format currency budget
		}
		
		$total_task = $query->num_rows();
		$val = 100/($total_task*2);
		$val_all = 100/($total_task);
		$total = 0;
		foreach($query->result() as $data){
			$progress = $data->act_progress;
			if($progress == 1){
				$progress = $val;
			}elseif($progress == 2){
				$progress = $val_all;			
			}else{
				$progress = 0;
			}
			$total += $progress;
		}
		$t_progress = round($total);		
		echo '
			<tr>
				<td>'.$tujuan.'</td>
				<td>Rp.'.$sbudget.'</td>
				<td>'.$departemen.'</td>
				<td>
					<div class="progress md-progress" style="height: 20px">
						<div class="progress-bar info-color text-white" role="progressbar" style="width: '.$t_progress.'%; height: 20px" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'.$t_progress.'%</div>
					</div>
				</td>
			</tr>
		</table>
		';
	}

	function show_task(){
		$id_project = $this->input->post("id");
		$query = $this->db->query("select * from act_task where id_act_project='$id_project'");
		$no = 1;
		foreach($query->result() as $data){
			$id_task = $data->id;
			$nama_task = $data->act_nama_task;
			$start = $data->act_start_task;
			$end = $data->act_end_task;
			//$progress = $data->act_progress;
			echo '
			<tr>
				<td>'.$no.'</td>
				<td>'.$nama_task.'</td>
				<td>'.$start.'</td>
				<td>'.$end.'</td>
				<td>
					<input type="text" id="nmt'.$no.'" value="'.$nama_task.'" hidden>
					<input type="text" id="id_ku'.$no.'" value="'.$id_task.'" hidden>
					<input type="text" id="id_pro" value="'.$id_project.'" hidden>
					<a id="btn_task'.$no.'" data-toggle="modal" data-target="#ed_task" data-toggle="tooltip" data-placement="top" title="Edit Task" class="btn btn-warning btn-rounded">
						<i class="fa fa-edit"></i>
					</a>
					<a data-toggle="modal" data-target="#" data-toggle="tooltip" data-placement="top" title="Delete Task" class="btn btn-danger btn-rounded">
						<i class="fa fa-trash"></i>
					</a>
				</td>
			</tr>';
			echo '
			<script type="text/javascript">
				$("#btn_task'.$no.'").click(function(){
					var id_task = $("#id_ku'.$no.'").val();
					var id_project = $("#id_pro").val();
					var nama_task = $("#nmt'.$no.'").val();
					$("#val_task").val(id_task);
					$("#val_project").val(id_project);
					$("#mdl_task").val(nama_task);
				})
			</script>';
			$no++;
		}

	}

	function show_prog(){
		$id_task = $this->input->post("id");
		$query = $this->db->query("select * from act_task where id ='$id_task'");
		$i = 0;
		foreach($query->result() as $data){
			$arr[] = array();
			/*
			$arr[$i]['id_project'] = $data->id_act_project;
			$arr[$i]['start'] = $data->act_start_task;
			$arr[$i]['end'] = $data->act_end_task;
			$arr[$i]['rint'] = $data->act_resint_task; 
			$arr[$i]['rext'] = $data->act_resext_task;
			$arr[$i]['add_by'] = $data->act_add_by;
			*/

			$arr[$i]['progress'] = $data->act_progress;
			$arr[$i]['detail'] = $data->act_detail_task;
			$arr[$i]['upload'] = $data->upload;
			$arr[$i]['add_at'] = $data->act_add_at; 
			$i++;
		}
		header('Content-Type: application/json');
		echo json_encode ($arr);
	}

	function est_task(){
		date_default_timezone_set('Asia/Jakarta');
		$cek_id = $this->db->query("select max(id) as id from act_project");
		$rows = $cek_id->row();
		$id = $rows->id;
		if(IS_NULL($id) || $id == NULL || $id == ""){
			$idp = 1;
		}else{
			$idp = $id;
		}

		$log_user = $this->session->userdata('name');
		$log_date = date('Y-m-d h:i:s');

		$nm_task = $this->input->post('en_task');
		$durasi = $this->input->post('ve_task');
		$internal = $this->input->post("eres_int");
		$external = $this->input->post("eres_ext");	
		$task_budget = $this->input->post("est_bud");

		error_reporting(0);
		$i = 0;
		foreach($nm_task as $val){
			$iparr = split("=>", $durasi[$i]); 
			//print_r($iparr);
			
			$data = array(
				'id_act_project' => $idp,
				'act_nama_task' => $nm_task[$i],
				'act_resint_task' => $internal[$i],
				'act_resext_task' => $external[$i],
				'est_start_task' => $iparr[0],
				'est_end_task' => $iparr[1],
				'est_budget_task' => $task_budget[$i],
				'act_add_by' => $log_user,
				'act_add_at' => $log_date
			);
			$i++;
			$query = $this->db->insert('act_task',$data);
		}
					
		if(!$query){
			echo "gagal insert !";
		}else{
			//update range tiap record
			$update = $this->db->query("update act_task set est_range_task = abs(datediff(est_start_task,est_end_task))");
		}

	}

	function act_task(){
		$cek_id = $this->db->query("select max(id) as id from act_project");
		$rows = $cek_id->row();
		$id = ($rows->id);

		$id_est = $this->input->post("exec_id");

		error_reporting(0);
		date_default_timezone_set('Asia/Jakarta');
		$id = $this->input->post("exec_id");
		$nm_task = $this->input->post('en_task');
		$durasi = $this->input->post('ve_task');
		$internal = $this->input->post("eres_int");
		$external = $this->input->post("eres_ext");	
		$task_budget = $this->input->post("act_bud");
		$log_user = $this->session->userdata('name');
		$log_date = date('Y-m-d h:i:s');

		$i = 0;
		foreach($nm_task as $val){
			$iparr = split("=>", $durasi[$i]); 
			//print_r($iparr);
			
			$data = array(
				'id_act_project' => $id,
				'act_nama_task' => $nm_task[$i],
				'act_start_task' => $iparr[0],
				//'act_end_task' => $iparr[1],
				'act_resint_task' => $internal[$i],
				'act_resext_task' => $external[$i],
				'act_budget_task' => $task_budget[$i],
				'act_add_by' => $log_user,
				'act_add_at' => $log_date
			);

			$query = $this->db->insert('act_task',$data);
			//$query2 = $this->db->insert('act_task_log',$data);
			$i++;
			
		}
		if($query){
			$sum_tot = $this->db->query("select sum(act_budget_task) as budget_act from act_task where id_act_project=$id");
			foreach($sum_tot->result() as $data){
				$tsum = $data->budget_act;
			}
			$a = $tsum;
			$update2 = $this->db->query("update act_project set act_pbudget=$a where id=$id");
			$upd_stat = $this->db->query("update est_project set status = 1 where id=$id_est"); 
			redirect("executecontroller/index");
		}else{
			echo 'Failed';
		}

	}
	function update_act_task(){
		error_reporting(0);
		date_default_timezone_set('Asia/Jakarta');
		
		$id_project = $this->input->post("val_p");
		$log_user = $this->session->userdata('name');
		$log_date = date('Y-m-d h:i:s');
		$nm_task = $this->input->post('en_task');
		$durasi = $this->input->post('ve_task');
		$internal = $this->input->post("eres_int");
		$external = $this->input->post("eres_ext");
		$task_budget = $this->input->post("act_bud");

		
		$i = 0;
		foreach($nm_task as $val){
			$iparr = split("=>", $durasi[$i]); 
			//print_r($iparr);
			
			$data = array(
				'id_act_project' => $id_project,
				'act_nama_task' => $nm_task[$i],
				'est_start_task' => $iparr[0],
				'est_end_task' => $iparr[1],
				'act_resint_task' => $internal[$i],
				'act_resext_task' => $external[$i],
				'est_budget_task' => $task_budget[$i],
				'act_add_by' => $log_user,
				'act_add_at' => $log_date
			);
			$i++;
			$query = $this->db->insert('act_task',$data);
			//$query2 = $this->db->insert('act_task_log',$data);
		}
		if($query){
			$sum_tot = $this->db->query("select sum(act_budget_task) as budget_act from act_task where id_act_project=$id_project");
			foreach($sum_tot->result() as $data){
				$tsum = $data->budget_act;
			}
			$a = $tsum;
			$update2 = $this->db->query("update act_project set act_pbudget=$a where id=$id_project");

			$slct_task = $this->db->query("select * from act_task where id_act_project='$id_project'");
			$total_task = $slct_task->num_rows();
			$val = 100/($total_task*2);
			$val_all = 100/($total_task);
			$total = 0;
			foreach($slct_task->result() as $data){
				$progress = $data->act_progress;
				if($progress == 1){
					$progress = $val;
				}elseif($progress == 2){
					$progress = $val_all;			
				}else{
					$progress = 0;
				}
				$total += $progress;
			}
			$t_progress = round($total);
			if($t_progress == '100' || $t_progress == 100){
				echo 'update status act_project jadi 2 dan update tanggal akhir/selesai act_project';
				$update = $this->db->query("update act_project set act_pend = '$tgl_update',status='1' where id = $id_project");
			}else{
				echo 'jangan update status dan tgl akhir';
				$update = $this->db->query("update act_project set act_pend = DEFAULT(act_pend),status='1' where id = $id_project");
			}
			redirect("taskcontroller/index");
		}else{
			echo "Error !";
		}

	}
	function update_budget(){
		$cek_id = $this->db->query("select max(id) as id from act_project");
		$rows = $cek_id->row();
		if($rows == NULL || $rows == ""){
			$id = '1';
		}else{
			$id = $rows->id;
		}
		echo $id;
		//cari total budget dari task berdasarkan id yg baru masuk
		$ct = $this->db->query("select sum(est_budget_task) as budget from act_task where id_act_project=$id");
		$tot = $ct->row();
		$hasil = $tot->budget;
		//$upd = $this->db->query("update est_project set est_pbudget = 32000 where id=1");

		$this->db->set('est_pbudget', $hasil);
		$this->db->where('id', $id);
		$update = $this->db->update('act_project');
		if($update){
			redirect("estimatecontroller/index");
		}else{
			echo '<script>alert("Insert Failed");</script>';
		}
		
	}
//insert log update progress log
function act_task_log($id,$nm_task,$durasi,$internal,$external,$log_user,$log_date,$task_bud){
	error_reporting(0);
	$i = 0;
	foreach($nm_task as $val){
		$iparr = split("=>", $durasi[$i]); 
		//print_r($iparr);
		
		$data = array(
			'id_act_project' => $id,
			'act_nama_task' => $nm_task[$i],
			'act_start_task' => $iparr[0],
			'act_end_task' => $iparr[1],
			'act_resint_task' => $internal[$i],
			'act_resext_task' => $external[$i],
			'act_budget_task' => $task_bud[$i],
			'act_add_by' => $log_user,
			'act_add_at' => $log_date
		);
		$i++;
		$query = $this->db->insert('act_task_log',$data);
	}
	if($query){	
		redirect("taskcontroller/index");
	}else{
		echo 'Failed';
	}

}

	function del_task(){
		$id_task = $this->input->post("delid");
		$cari_idp = $this->db->query("select id_act_project as id_project from act_task where id=$id_task");
		$rows = $cari_idp->row();
		$idp = $rows->id_project;

		$act_del = $this->db->query("delete from act_task where id=$id_task");
		$log_del = $this->db->query("delete from act_task_log where id_act_task=$id_task");

		echo $id_task."</br>";
		echo $idp."</br>";

		$act_budget = $this->db->query("select sum(act_budget_task) as budget from act_task where id_act_project=$idp");
		$rows2 = $act_budget->row();
		$tbudget = $rows2->budget;
		echo $tbudget;
		$bud_pro = $this->db->query("update act_project set act_pbudget='$tbudget' where id=$idp");
		if($bud_pro){
			echo 'berhasil update budget';
		}else{
			echo 'gagal update';
		}
		$slct_task = $this->db->query("select * from act_task where id_act_project='$idp'");
		$total_task = $slct_task->num_rows();
		$val = 100/($total_task*2);
		$val_all = 100/($total_task);
		$total = 0;
		foreach($slct_task->result() as $data){
			$progress = $data->act_progress;
			if($progress == 1){
				$progress = $val;
			}elseif($progress == 2){
				$progress = $val_all;			
			}else{
				$progress = 0;
			}
			$total += $progress;
		}
		$t_progress = round($total);
		if($t_progress == '100' || $t_progress == 100){
			echo 'update status act_project jadi 2 dan update tanggal akhir/selesai act_project';
			$update = $this->db->query("update act_project set act_pend = '$tgl_update',status='3' where id = $idp");
			
			$this->db->query("
			update act_project set act_pdays = abs(datediff(act_pstart,act_pend)), 
			act_phours = SEC_TO_TIME(timestampdiff(second,act_pstart,act_pend))
			where id = $idpb
			");
		}else{
			echo 'jangan update status dan tgl akhir';
			$update = $this->db->query("update act_project set act_pend = DEFAULT(act_pend),status='1' where id = $idp");

			$this->db->query("
			update act_project set act_pdays = abs(datediff(act_pstart,act_pend)), 
			act_phours = SEC_TO_TIME(timestampdiff(second,act_pstart,act_pend))
			where id = $idpb
			");
		}

		redirect("taskcontroller/index");
	}

	
}