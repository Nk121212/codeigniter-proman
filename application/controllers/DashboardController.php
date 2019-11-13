<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardController extends CI_Controller {
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
			$this->load->view("v_dashboard");         

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("logincontroller");
        }
	}
	public function logout()
    {
        $this->session->sess_destroy();
        redirect('logincontroller');
    }
    function task_today(){
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d");
        $query = $this->db->query("
        select count(id) as todo_today_not_started from todo a where a.est_start = '$date' AND a.start IS NULL;
        ");
        if($query->num_rows() < 1){
            $todo_ns = '0';
        }else{
            $todo_ns = $query->row()->todo_today_not_started;
        }

        $query2 = $this->db->query("
        select count(id) as todo_schedule_finish from todo a where a.est_finish = '$date' AND a.finish IS NULL AND a.`start` IS NOT NULL;
        ");
        if($query2->num_rows() < 1){
            $todo_nf = '0';
        }else{
            $todo_nf = $query2->row()->todo_schedule_finish;
        }
        
        echo '
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <P>
        You have <strong>'.$todo_ns.'</strong> todo estimated start today, 
        and <strong>'.$todo_nf.'</strong> todo estimated Finish Today !
        </p>
        ';
       
    }
    function todo_today(){
        date_default_timezone_set('Asia/Jakarta');
        echo $date = date("Y-m-d");
        $query = $this->db->query("
        select * from todo a where a.est_start = '$date' AND a.start IS NULL;
        ");
        if($query->num_rows() >= 1){
            $no = 1;
            foreach($query->result() as $data){
                
                if($data->status == 0){
                    $sof = '<span data-toggle="modal" data-target = "#upd_stt">
                    <a id="btn_ss'.$no.'" data-toggle="tooltip" title="Click Here To Start" class="btn btn-sm btn-blue-grey" type="button" href="#"> 
                    <i class="fa fa-play"></i></a>
                    </span>';
                }elseif($data->status == 1){
                    $sof = '<span data-toggle="modal" data-target = "#upd_stt">
                    <a id="btn_ss'.$no.'" data-toggle="tooltip" title="Click Here To Finish" class="btn btn-sm btn-mdb-color" type="button" href="#"> 
                    <i class="fa fa-stop"></i></a>
                    </span>';
                }else{
                    $sof = '<span data-toggle="" data-target = "#">
                    <a id="btn_ss'.$no.'" data-toggle="tooltip" title="Has Finish" class="btn btn-sm btn-elegant" type="button" href="#" disabled> 
                    <i class="fa fa-check"></i></a>
                    </span>';
                }
    
                echo '
                <tr style="text-align:center;">
                    <td>'.$no.'</td>
                    <td>
                        <a data-html="true" class="pop" data-toggle="popover" data-title="Detail Todo" style="cursor:pointer;" id="btn_pop1'.$no.'">
                            <u>'.$data->to_do.'</u>
                        </a>
                    </td>		
                    <td>
                        <input id="idtd'.$no.'" type="text" value="'.$data->id.'" hidden>
                        <input id="vs'.$no.'" type="text" value="'.$data->status.'" hidden>
                        '.$sof.'
                    </td>
                </tr>
                ';
                echo '
                    <script>
                    $("#btn_ss'.$no.'").click(function(){ 
                        //alert("abcd");
                        var a = $("#vs'.$no.'").val();
                        var b = $("#idtd'.$no.'").val();
                        //alert(a);
                        //alert(b);
                        $("#sof").val(a);
                        $("#id_todo").val(b);
                    })
                    $("#btn_pop1'.$no.'").click(function(){
                        var id_todo = $("#idtd'.$no.'").val();
                        $.ajax({  
                            url: "'.base_url().'" + "dashboardcontroller/detail_todo",
                            method:"POST",
                            data:{id_todo:id_todo},             
                                success:function(data){	
                                    document.getElementById("btn_pop1'.$no.'").setAttribute("data-content", data);
                                    $(function () {
                                        $(".pop").popover({
                                          container: "body"
                                        })
                                      })	
                                    
                                }
                        });
                    })
                    </script>
                ';
                $no++;
            }
        }else{
            echo '
            <tr style="text-align:center;">
                <td colspan= "3">No Data</td>
            </tr>
            ';
        }
    }

    function todo_today2(){
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d");
        $query = $this->db->query("
        select * from todo a where a.est_finish = '$date' AND a.finish IS NULL;
        ");
        if($query->num_rows() >= 1){
            $no = 1;
            foreach($query->result() as $data){
                
                if($data->status == 0){
                    $sof = '<span data-toggle="modal" data-target = "#upd_stt">
                    <a id="btn_sf'.$no.'" data-toggle="tooltip" title="Click Here To Start" class="btn btn-sm btn-blue-grey" type="button" href="#"> 
                    <i class="fa fa-play"></i></a>
                    </span>';
                }elseif($data->status == 1){
                    $sof = '<span data-toggle="modal" data-target = "#upd_stt">
                    <a id="btn_sf'.$no.'" data-toggle="tooltip" title="Click Here To Finish" class="btn btn-sm btn-mdb-color" type="button" href="#"> 
                    <i class="fa fa-stop"></i></a>
                    </span>';
                }else{
                    $sof = '<span data-toggle="" data-target = "#">
                    <a id="btn_sf'.$no.'" data-toggle="tooltip" title="Has Finish" class="btn btn-sm btn-elegant" type="button" href="#" disabled> 
                    <i class="fa fa-check"></i></a>
                    </span>';
                }
    
                echo '
                <tr style="text-align:center;">
                    <td>'.$no.'</td>
                    <td>
                        <a data-html="true" class="pop" data-toggle="popover" data-title="Detail Todo" style="cursor:pointer;" id="dt_fns'.$no.'">
                            <u>'.$data->to_do.'</u>
                        </a>
                    </td>		
                    <td>
                        <input id="idtodo'.$no.'" type="text" value="'.$data->id.'" hidden>
                        <input id="stat_val'.$no.'" type="text" value="'.$data->status.'" hidden>
                        '.$sof.'
                    </td>
                </tr>
                ';
                echo '
                    <script>
                    $("#btn_sf'.$no.'").click(function(){ 
                        //alert("abcd");
                        var a = $("#stat_val'.$no.'").val();
                        var b = $("#idtodo'.$no.'").val();
                        //alert(a);
                        //alert(b);
                        $("#sof").val(a);
                        $("#id_todo").val(b);
                    })
                    $("#dt_fns'.$no.'").click(function(){
                        var id_todo = $("#idtodo'.$no.'").val();
                        $.ajax({  
                            url: "'.base_url().'" + "dashboardcontroller/detail_todo2",
                            method:"POST",
                            data:{id_todo:id_todo},             
                                success:function(data){	
                                    document.getElementById("dt_fns'.$no.'").setAttribute("data-content", data);
                                    $(function () {
                                        $(".pop").popover({
                                          container: "body"
                                        })
                                      })	
                                    
                                }
                        });
                    })
                    </script>
                ';
                $no++;
            } 
        }else{
            echo '
            <tr style="text-align:center;">
                <td colspan="3">No Data</td>   
            </tr>
            ';
        }
    }

    function detail_todo(){
        $id_todo = $this->input->post("id_todo");
        //echo $id_todo;
        $qc_idt = $this->db->query("
        select id_task from todo where id='$id_todo'
        ");
        $id_task = $qc_idt->row()->id_task;
        //echo $id_task;
        $qc_id_project = $this->db->query("
        select id_project from task where id = '$id_task'
        ");
        $id_project = $qc_id_project->row()->id_project;
        //echo $id_project;
        $qd_project = $this->db->query("
        select * from project where id = '$id_project'
        ");
        $qd_task = $this->db->query("
        select * from task where id='$id_task'
        ");
        $qd_todo = $this->db->query("
        select * from todo where id='$id_todo'
        ");

        $nm_project = $qd_project->row()->nama_project;
        $p_attach = $qd_project->row()->attachment;
        $nm_task = $qd_task->row()->nama_task;
        $est_start = $qd_todo->row()->est_start;
        if($est_start == date("Y-m-d")){
            $plan_start = 'Today';
        }else{
            $plan_start = date("d M Y",strtotime($est_start));
        }

        //date("d M Y",strtotime($qd_todo->row()->est_start));
        $est_finish = date("d M Y",strtotime($qd_todo->row()->est_finish));


        echo '<div align="center">';

        echo '
        <table>
            <tr>
                <th>Project</th>
                <th>: '.$nm_project.'</th>
            </tr>
            <tr>
                <th>Task</th>
                <th>: '.$nm_task.'</th>
            </tr>
            <tr>
                <th>Started Plan</th>
                <th>: '.$est_start.' ('.$plan_start.')</th>
            </tr>
            
        </table>
        ';
        echo '</div>';

    }

    function detail_todo2(){
        $id_todo = $this->input->post("id_todo");
        //echo $id_todo;
        $qc_idt = $this->db->query("
        select id_task from todo where id='$id_todo'
        ");
        $id_task = $qc_idt->row()->id_task;
        //echo $id_task;
        $qc_id_project = $this->db->query("
        select id_project from task where id = '$id_task'
        ");
        $id_project = $qc_id_project->row()->id_project;
        //echo $id_project;
        $qd_project = $this->db->query("
        select * from project where id = '$id_project'
        ");
        $qd_task = $this->db->query("
        select * from task where id='$id_task'
        ");
        $qd_todo = $this->db->query("
        select * from todo where id='$id_todo'
        ");

        $nm_project = $qd_project->row()->nama_project;
        $p_attach = $qd_project->row()->attachment;
        $nm_task = $qd_task->row()->nama_task;
        $start = $qd_todo->row()->start;
        if($start == NULL || $start == "0000-00-00"){
            $acts = "Not Started Yet";
        }else{
            $acts = date("d M Y",strtotime($start));
        }

        //date("d M Y",strtotime($qd_todo->row()->est_start));
        $est_finish = $qd_todo->row()->est_finish;
        if($est_finish == date("Y-m-d")){
            $estf = 'Today';
        }else{
            $estf = date("d M Y",strtotime($est_finish));
        }


        echo '<div align="center">';

        echo '
        <table>
            <tr>
                <th>Project</th>
                <th>: '.$nm_project.'</th>
            </tr>
            <tr>
                <th>Task</th>
                <th>: '.$nm_task.'</th>
            </tr>
            <tr>
                <th>Started</th>
                <th>: '.$acts.'</th>
            </tr>
            <tr>
                <th>Finished Plan</th>
                <th>: '.$est_finish.' ('.$estf.')</th>
            </tr>

            
        </table>
        ';
        echo '</div>';

    }

    function com_pro(){
        $query = $this->db->query("
        select * from project where status = '4' and rated = '0'
        ");
        foreach($query->result() as $data){
            $nama_project = $data->nama_project;
            $img = $data->attachment;

            echo '
            <div class="col-lg-4 md-form">
                <!-- Card -->
                <div class="card">
                
                <!-- Card image -->
                <img class="card-img-top" src="http://192.168.50.5/kahfi/project/proman/'.$img.'" alt="Card image cap" width="400" height="400">
                
                <!-- Card content -->
                <div class="card-body">
                
                    <!-- Title -->
                    <h4 class="card-title"><a>'.$nama_project.'</a></h4>

                    <a href="'.base_url().'c_rating/index" class="btn btn-primary"><i class="fa fa-star"></i> Rated</a>
                
                </div>
                
                </div>
                <!-- Card -->
            </div>
            ';
        }
    }

    function todo_status(){
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
				update project set mulai = DEFAULT(mulai) where id = '$r_cidp'
				");
			}else{
				//update start date task 
				$update = $this->db->query("
				update project set mulai = '$pmin' where id = '$r_cidp'
				");

			}

			$hitung_bobot = $this->count_weight($id_task);

			redirect("dashboardcontroller/index");
            
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
				window.location.replace("index");
				</script>';
			}else{
				//echo 'ok';
				$q_update = $this->db->query("update todo set finish = '$date_todo', status = '2', update_date = '$date_todo' where id='$id_todo'");
				
				$this->db->query("
					insert into todo_history (id_task,to_do,est_start,est_finish,start,finish,status,update_date)
					values
					('$rt_it','$rt_td','$rt_es','$rt_ef','$rt_s','$rt_f','$rt_stat','$rt_ud')	
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
					$hitung_prioritas = $this->real_priority($id_task);
				}

				$hitung_bobot = $this->count_weight($id_task);

				echo '
				<script>
				alert("Success Finish Todo!");
				window.location.replace("index");
				</script>';

			}

		}elseif($stat_todo == '2'){
			//echo 'sudah finish';
			redirect("dashboardcontroller/index");
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

}
