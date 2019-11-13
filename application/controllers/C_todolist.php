<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_todolist extends CI_Controller {
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
            $this->load->view("group_actual/vu_todolist");         
    
        }else{
    
            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("logincontroller");
        }
	}
	
	function page($id){
		if($this->admin->logged_id())
        {
			$data['id_project'] = $id;
            $this->load->view("plugin/plugin");
            $this->load->view("group_actual/vu_todolist", $data);         
    
        }else{
    
            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("logincontroller");
        }
	}

    function show_todolist(){

        $id_project = $this->input->post("idp");
        $query = $this->db->query("select * from task where id_project = '$id_project'");
        $no = 1;
        foreach($query->result() as $data){
			$id_task = $data->id;

			$a = $this->db->query("
				select count(id) as idku from todo where id_task = '$id_task'
			");
			$b = $a->row()->idku;
			
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
			<a href="'.base_url().'c_todolist/page_todolist/'.$data->id.'" class="btn btn-sm btn-primary">
			<i class="fa fa-eye"></i> Todo List <span style="font-size:1.1em;" class="badge badge-danger">'.$b.'</span></a>
            </td>
            </tr>
            ';
            $no++;
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

		$cek_idp = $this->db->query("
			select id_project from task where id = '$id_task'
		");

		$idp = $cek_idp->row()->id_project;

		$cek_idt_all = $this->db->query("
			select group_concat(id separator ',') as all_idt from task where id_project = '$idp'
		");
		
		$all_idt = $cek_idt_all->row()->all_idt;

		$cek1 = $this->db->query("
			select count(id) as not_start from todo where id_task IN($all_idt) and status = '0'
		");
		$sn = $cek1->row()->not_start;

		$cek2 = $this->db->query("
			select count(id) as not_finish from todo where id_task IN($all_idt) and status = '1'
		");
		$ss = $cek2->row()->not_finish;

		$cek3 = $this->db->query("
			select count(id) as idm from material where id_task IN($all_idt) and bpb IS NOT NULL
		");
		$tm = $cek3->row()->idm;

		if($sn == '0' && $ss == '1' && $tm == '0'){
			$notif = '<p><span>* </span>Project ini belum memiliki material, silakan isi material (Klik Close) lebih dahulu sebelum finish project !</p>';
		}else{
			$notif = '';
		}

		$no = 1;
		foreach($query->result() as $data){
			if($data->status == 0){
				$status = 'Not Started';
			}elseif($data->status == 1){
				$status = 'Started';
			}else{
				$status = 'Finish';
            }
            
            if($data->status == 0){
                $sof = '<span data-toggle="modal" data-target = "#modal_start">
                <a id="sof'.$no.'" data-toggle="tooltip" title="Click Here To Start" class="btn btn-sm btn-blue-grey" type="button" href="#"> 
                <i class="fa fa-play"></i></a>
                </span>';
			}elseif($data->status == 1){
                $sof = '<span data-toggle="modal" data-target = "#modal_start">
                <a id="sof'.$no.'" data-toggle="tooltip" title="Click Here To Finish" class="btn btn-sm btn-mdb-color" type="button" href="#"> 
                <i class="fa fa-stop"></i></a>
                </span>';
			}else{
                $sof = '<span data-toggle="" data-target = "#">
                <a id="sof'.$no.'" data-toggle="tooltip" title="Has Finish" class="btn btn-sm btn-elegant" type="button" href="#" disabled> 
                <i class="fa fa-check"></i></a>
                </span>';
            }
            if($data->est_start == "" || $data->est_start == NULL || $data->est_start == '0000-00-00'){
				$est_start = 'Not Estimated';
			}else{
				$est_start = date("d M Y",strtotime($data->est_start));
			}

			if($data->start == "" || $data->start == NULL || $data->start == '0000-00-00'){
				$start = 'Not Started Yet';
			}else{
				$start = date("d M Y",strtotime($data->start));
			}

			if($data->est_finish == "" || $data->est_finish == NULL || $data->est_finish == '0000-00-00'){
				$estf = 'Not Finish Yet';
			}else{
				$estf = date("d M Y",strtotime($data->est_finish));
			}

			if($data->finish == "" || $data->finish == NULL || $data->finish == '0000-00-00'){
				$finish = 'Not Finish Yet';
			}else{
				$finish = date("d M Y",strtotime($data->finish));
			}

			echo '
			<tr style="text-align:center;">
				<td>'.$no.'</td>
				<td>'.$data->to_do.'</td>
				<td>'.$start.'</td>
				<td>'.$finish.'</td>				
				<td>
					<input id="estf'.$no.'" type="text" value="'.$estf.'" hidden>
					<input id="est'.$no.'" type="text" value="'.$est_start.'" hidden>
					<input id="act'.$no.'" type="text" value="'.$start.'" hidden>
                    <input id="cek'.$no.'" type="text" value="'.$data->id.'" hidden>
                    <input id="stat_val'.$no.'" type="text" value="'.$data->status.'" hidden>
                    '.$status.'
				</td>
                <td>
					'.$sof.'
					<br><br>
                    <span data-toggle="modal" data-target="#md_todo">
                        <a id="a'.$no.'" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
					</span>
					<br><br>
					<span data-toggle="tooltip" data-title="Edit">
						<a href="../edit_todo/'.$data->id.'" type="button" class="btn btn-sm btn-warning"><i class="fa fa-refresh"></i></a>
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
            $("#sof'.$no.'").click(function(){
                var a = $("#stat_val'.$no.'").val();
				var b = $("#cek'.$no.'").val();
				var c = $("#est'.$no.'").val();
				var d = $("#act'.$no.'").val();
				var e = $("#estf'.$no.'").val(); 
				var f = "'.$notif.'";
                $("#sof").val(a);
				$("#id_todo").val(b);
				document.getElementById("bold").innerHTML = c;
				document.getElementById("bold2").innerHTML = d;
				document.getElementById("bold3").innerHTML = e;
				document.getElementById("bold4").innerHTML = f;
            })
            
			</script>
			';
			$no ++;
		}
	}

	function edit_todo($idto){
		$data['id_todo'] = $idto;
		if($this->admin->logged_id())
        {
            //$data['id_project']=$id;
            $this->load->view("plugin/plugin");
            $this->load->view("edit/edit_todolist",$data);         
    
        }else{
    
            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("logincontroller");
        }
	}

	function fetch_todo(){
		$id_todo = $this->input->post("id_todo");

		$query = $this->db->query("
			select * from todo where id = $id_todo
		");

		$i = 0;
		foreach($query->result() as $data){
			$arr[] = array();
			$arr[$i]['id_task'] = $data->id_task;
			$arr[$i]['todoname'] = $data->to_do;
			$arr[$i]['ests'] = $data->est_start;
			$arr[$i]['estf'] = $data->est_finish;
			$arr[$i]['start'] = $data->start;
			$arr[$i]['finish'] = $data->finish;
			$arr[$i]['status'] = $data->status;
			$i++;
		}
		header('Content-Type: application/json');
		echo json_encode($arr);
	}

	function update_todo(){
		//update dulu tbl todo where id todo =
		$id_todo = $this->input->post("id_todo");
		$nm_todo = $this->input->post("todo_name");
		$start = $this->input->post("s_date");
		$finish = $this->input->post("f_date");
		
		$up_todo = $this->db->query("
			update todo set start = '$start', finish='$finish', update_date = '$finish' where id='$id_todo'
		");

		if($up_todo){
			//select tbl todo dengan id terpilih
			$slct_todo = $this->db->query("
				select * from todo where id = '$id_todo'
			");

			foreach($slct_todo->result() as $dt1){
				$id_task = $dt1->id_task;
				$nm_to = $dt1->to_do;
				$start = $dt1->start;
				$finish = $dt1->finish;
			}

			$up_th = $this->db->query("
				update todo_history set start = '$start', update_date = '$start' where id_task = '$id_task' and to_do = '$nm_to' and status = 1
			");
			$up_th2 = $this->db->query("
				update todo_history set start = '$start', finish = '$finish', update_date = '$finish' where id_task = '$id_task' and to_do = '$nm_to' and status = 2
			");
		}else{
			echo 'update failed';
		}
		
		//update start tbl todo history where status = 1 and id_task = and nama_todo =
		//update start dan finish where status = 2 and id_task = and nama_todo =

	}

	function status_todo(){
		$id_todo = $this->input->post("id_todo");
		$stat_todo = $this->input->post("sof");
		$date_todo = $this->input->post("date_todo");

		//cari id task buat reload
		$cari_idt = $this->db->query("select id_task from todo where id='$id_todo'");
		$row_idt = $cari_idt->row();
		$id_task = $row_idt->id_task;

		//cari id_project
		$q_cidp = $this->db->query("select id_project from task where id = '$id_task'");
		$r_cidp = $q_cidp->row()->id_project;

		if($stat_todo == '0'){
            //echo 'update status jadi 1 dan start dari post';
			$q_update = $this->db->query("update todo set start = '$date_todo', status = '1', update_date = '$date_todo' where id='$id_todo'");
			//ambil data yg baru d update untuk d masukan ke log
			$qs_todo = $this->db->query("select * from todo where id = '$id_todo'");
			$rt_it = $qs_todo->row()->id_task;
			$rt_td = $qs_todo->row()->to_do;
			$rt_es = $qs_todo->row()->est_start;
			$rt_ef = $qs_todo->row()->est_finish;
			$rt_s = $qs_todo->row()->start;
			$rt_f = $qs_todo->row()->finish;
			$rt_stat = $qs_todo->row()->status;
			$rt_ud = $qs_todo->row()->update_date;
			
			$this->db->query("
				insert into todo_history (id_task,to_do,est_start,est_finish,start,finish,status,update_date)
				values
				('$rt_it','$rt_td','$rt_es','$rt_ef','$rt_s','$rt_f','$rt_stat','$rt_ud')	
			");

			//select min date dari start date todo menjadi start task dari todolist tersebut
			$q_at = $this->db->query("
			select group_concat(id separator ',') as id from task where id_project = '$r_cidp'
			");
			$all_task = $q_at->row()->id;
			$q_min = $this->db->query("
			select min(start) as minimal from todo where id_task IN($all_task) and start IS NOT NULL
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
					update project set mulai = DEFAULT(mulai), status = '1' where id = '$r_cidp'
				");
			}else{
				//update start date task 
				$update = $this->db->query("
					update project set mulai = '$pmin', status = '2' where id = '$r_cidp'
				");

			}

			$hitung_bobot = $this->count_weight($id_task);

			redirect("c_todolist/page_todolist/$id_task");
            
		}elseif($stat_todo == '1'){
			//echo 'update status jadi 2 dan finish dari post';
			//ambil data yg baru d update untuk d masukan ke log
			$qs_todo = $this->db->query("select * from todo where id = '$id_todo'");
			$rt_it = $qs_todo->row()->id_task;
			$rt_td = $qs_todo->row()->to_do;
			$rt_es = $qs_todo->row()->est_start;
			$rt_ef = $qs_todo->row()->est_finish;
			$rt_s = $qs_todo->row()->start;
			$rt_f = $qs_todo->row()->finish;
			$rt_stat = $qs_todo->row()->status;
			$rt_ud = $qs_todo->row()->update_date;

			if($date_todo < $rt_s){	
				echo '
				<script>
				alert("Tanggal Finish Tidak Boleh Kurang Dari Tanggal Start !");
				window.location.replace("page_todolist/'.$id_task.'");
				</script>';
			}else{
				$q_update = $this->db->query("update todo set finish = '$date_todo', status = '2', update_date = '$date_todo' where id='$id_todo'");
				
				$after_update = $this->db->query("select * from todo where id = '$id_todo'");
				$rt_it2 = $after_update->row()->id_task;
				$rt_td2 = $after_update->row()->to_do;
				$rt_es2 = $after_update->row()->est_start;
				$rt_ef2 = $after_update->row()->est_finish;
				$rt_s2 = $after_update->row()->start;
				$rt_f2 = $after_update->row()->finish;
				$rt_stat2 = $after_update->row()->status;
				$rt_ud2 = $after_update->row()->update_date;

				$this->db->query("
					insert into todo_history (id_task,to_do,est_start,est_finish,start,finish,status,update_date)
					values
					('$rt_it2','$rt_td2','$rt_es2','$rt_ef2','$rt_s2','$rt_f2','2','$rt_ud2')	
				");
	
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
	
					//select ater update start and finish task
					$q_snf = $this->db->query("select start, end from task where id = '$id_task'");
					$st = $q_snf->row()->start;
					$ft = $q_snf->row()->end;
	
					$date1 = new DateTime($st);
					$date2 = new DateTime($ft);
	
					$diff = $date2->diff($date1);
					$hari = $diff->format('%a');
	
					$t1 = StrToTime($st);
					$t2 = StrToTime($ft);
					$diff = $t2 - $t1;
					$hours = $diff / ( 60 * 60 );
	
					$qu_task = $this->db->query("update task set hours = '$hours', days = '$hari' where id='$id_task'");
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
					if($q_usf){
						$hitung_prioritas = $this->real_priority($id_task);
					}else{
						echo 'status project tidak berubah jadi close';
					}
					
				}

				$hitung_bobot = $this->count_weight($id_task);

				echo '
				<script>
				window.location.replace("page_todolist/'.$id_task.'");
				</script>';

			}

		}elseif($stat_todo == '2'){
			//echo 'sudah finish';
			redirect("c_todolist/page_todolist/$id_task");
		}
    }
    
    function add_todo(){
		date_default_timezone_set("Asia/Jakarta");
		$id_task = $this->input->post("id_task");
		$todo = $this->input->post("todo");
		$by = $this->session->userdata('name');
		$at = date("Y-m-d h:i:s");
		//$start = $this->input->post("mulai");
		//$finish = $this->input->post("selesai");

		//cari id_project untuk update project
		$cari_idp = $this->db->query("
		select id_project from task where id='$id_task'
		");
		$id_pro = $cari_idp->row()->id_project;

		//echo $id_task.'-'.$todo.'-'.$start.'-'.$finish;
		$query = $this->db->query("
			insert into todo (id_task,to_do,update_by)
			values
			('$id_task','$todo','$by')	
		");
		$this->db->query("
		insert into todo_history (id_task,to_do,update_date,update_by)
		values
		('$id_task','$todo','0000-00-00','$by')	
	");


		$f_task = $this->db->query("update task set end = DEFAULT(end), hours = DEFAULT(hours), days = DEFAULT(days) where id='$id_task'");

		$update_project = $this->db->query("
			update project set selesai = DEFAULT(selesai), jam = DEFAULT(jam), hari = DEFAULT(hari), status = '2' where id = '$id_pro'
		");

		$this->count_weight($id_task);
		$this->real_priority($id_task);

		redirect("c_todolist/page_todolist/$id_task");
    }

	function del_todo(){
        
		$id_todo = $this->input->post("idto");

		$q_idt = $this->db->query("
			select id_task,to_do from todo where id = '$id_todo'
		");
		$r_idt = $q_idt->row();
		$id_task = $r_idt->id_task;
		$tdh = $r_idt->to_do;

		/*cek ada estimasinya atau tidak
		$cek_est = $this->db->query("
			select est_start from todo where id = '$id_todo'
		");
		$val_ests = $cek_est->row()->est_start;

		if($val_ests == NULL || $val_ests == ""){
			//maka delete todo

		}else{
			//maka update todo
			
		}
		*/

		$del_th = $this->db->query("delete from todo_history where id_task = '$id_task' AND to_do = '$tdh'");
        
        $qcidp = $this->db->query("select id_project from task where id='$id_task'");
        $id_project = $qcidp->row()->id_project;

		$query = $this->db->query("
			delete from todo where id = '$id_todo'
        ");
        
        $q1 = $this->db->query("select finish from todo where id_task = '$id_task' order by finish desc");

        foreach($q1->result() as $data){
			if($q1->num_rows() < 1 || $q1->num_rows() == 0){
				$df = "";
			}else{
				$df = $data->finish;
			}
        }

            if($df == NULL || $df == ""){ //jika data finish pada todo masih ada yg kosong atau null maka

                $qmin_todo = $this->db->query("select min(start) as min from todo where id_task = '$id_task'");
                $min_todo = $qmin_todo->row()->min;

                if($min_todo == NULL || $min_todo == ""){
                    //echo $min_todo;
                    $qu_start = $this->db->query("update task set start = DEFAULT(start), end= DEFAULT(end), hours = DEFAULT(hours), days = DEFAULT(days) where id='$id_task'");
                }else{
                    $qu_start = $this->db->query("update task set start = '$min_todo', hours = DEFAULT(hours), days = DEFAULT(days) where id='$id_task'");
                }

            }else{ //jika data finish pada todo tidak ada yg null atau kosong
                $qmax_todo = $this->db->query("select max(finish) as max from todo where id_task = '$id_task'");
                $max_todo = $qmax_todo->row()->max;

                if($max_todo == NULL || $max_todo == ""){
                    //echo $max_todo;
                    $qu_finish = $this->db->query("update task set end = DEFAULT(end), hours = DEFAULT(hours), days = DEFAULT(days) where id='$id_task'");
                }else{
                    $qu_finish = $this->db->query("update task set end = '$max_todo' where id='$id_task'");
                    //select ater update start and finish task
                    $q_snf = $this->db->query("select start, end from task where id = '$id_task'");
                    $st = $q_snf->row()->start;
                    $ft = $q_snf->row()->end;

                    if($ft == NULL || $ft == ""){ //jika finish date pada task null maka kosongkan hours dan days
                        //echo 'kosongkan hours dan days';
                        $this->db->query("update task set hours = DEFAULT(hours), days = DEFAULT(days) where id ='$id_task'");

                    }else{
                        //echo 'update hours dan days';
                        $date1 = new DateTime($st);
                        $date2 = new DateTime($ft);
                
                        $diff = $date2->diff($date1);
                        $hari = $diff->format('%a');
                        $t1 = StrToTime($st);
                        $t2 = StrToTime($ft);
                        $diff = $t2 - $t1;
                        $hours = $diff / ( 60 * 60 );
                        $qu_task = $this->db->query("update task set hours = '$hours', days = '$hari' where id='$id_task'"); 

                        $qmf_task = $this->db->query("select end from task where id='$id_task' order by end desc");
                        
                        foreach($qmf_task->result() as $data){
                            $ftf = $data->end;
                        }

                        if($ftf == NULL || $ftf == ""){
                            //update project set selesai = null/default
                            $this->db->query("
                                update project set selesai = DEFAULT(selesai), jam = DEFAULT(jam), hari = DEFAULT(hari) where id = '$id_project'
                            ");
                        }else{
                            //cari max date finish dari task
                            $qmax_task = $this->db->query("select max(end) as end from task where id_project ='$id_project'");
                            $max_task = $qmax_task->row()->end;
                            //update project max task end.
                            $this->db->query("
                                update project set selesai = '$max_task' where id = '$id_project'
                            ");
                            $qht = $this->db->query("select mulai, selesai from project where id = '$id_project'");
                            $mulai = $qht->row()->mulai;
                            $selesai = $qht->row()->selesai;

                            $d1 = new DateTime($mulai);
                            $d2 = new DateTime($selesai);
                    
                            $diff = $d2->diff($d1);
                            $pdays = $diff->format('%a');

                            $dt1 = StrToTime($mulai);
                            $dt2 = StrToTime($selesai);

                            $diff = $dt2 - $dt1;
                            $phours = $diff / ( 60 * 60 );

                            $this->db->query("update project set jam = '$phours', hari = '$pdays' where id = '$id_project'");

                        }
                    }
                }
            }

        $this->count_weight($id_task);
		redirect("c_todolist/page_todolist/$id_task");
	}

	function add_comment(){
		$id_task = $this->input->post("id_task");
		$comment = $this->input->post("comment");
		$query = $this->db->query("
		update task set comment_todo = '$comment' where id='$id_task'
		");
		if($query){
			redirect("c_todolist/page_todolist/$id_task");
		}else{
			echo 'Error Add Comment !';
		}
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
			//redirect("c_todolist/page_todolist/$id_task");
		}
    }
    
    function real_priority($id_task){
		//setelah insert material hitung budget per id task (estimasi)
		// 1. hitung budget dari material
		$cek_budget = $this->db->query("
		select sum(total_harga) as budget from material where id_task = '$id_task'
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
		$qu_pro = $this->db->query("update project set budget = '$total' where id = '$id_project'");

		//hitung total point untuk menghasilkan priority project
		// 1. select column yg diperlukan utk mnghitung priority
		$qs_prior = $this->db->query("select kategori,budget,resource,hari,complexity from project where id = '$id_project'");
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

} //TUTUP CONTROLLER
