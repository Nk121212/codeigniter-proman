<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_material extends CI_Controller {
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
            $this->load->view("group_actual/vu_material");         
    
        }else{
    
            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("logincontroller");
        }
	}
	
	function page($id){
		if($this->admin->logged_id())
        {
            $data['id_project']=$id;
            $this->load->view("plugin/plugin");
            $this->load->view("group_actual/vu_material", $data);         
    
        }else{
    
            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("logincontroller");
        }
	}

    function show_material(){
        $id_project = $this->input->post("idp");
        $query = $this->db->query("select * from task where id_project = '$id_project'");
        $no = 1;
        foreach($query->result() as $data){
			$id_task = $data->id;

			$c = $this->db->query("
			select count(id) as idku from material where id_task = '$id_task' and bpb IS NOT NULL
			");
			$d = $c->row()->idku;

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
			<a href="'.base_url().'c_material/page_material/'.$data->id.'" class="btn btn-sm btn-warning">
			<i class="fa fa-eye"></i> Material <span style="font-size:1.1em;" class="badge badge-primary">'.$d.'</span></a>
            </td>
            </tr>
            ';
            $no++;
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
		//echo $id_material;
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
		from material_history as a left join satuan as b on a.satuan = b.id where a.id_task = '$id_task' and a.jumlah = 0
		order by a.nama_material asc");
		$no = 1;
		foreach($query->result() as $data){
			echo '
			<tr>
				<td>'.$no.'</td>
				<td>'.$data->nama_material.'</td>
                <td>'.number_format($data->est_harga,2,',','.').'</td>
                <td>'.$data->est_jumlah.'</td>
                <td>'.number_format($data->est_total_harga,2,',','.').'</td>
			</tr>
			';
			
			$no ++;
		}
	}
	function data_material2(){
		$id_task = $this->input->post("id_task");
		$query = $this->db->query("select a.*, b.nama_satuan as nm_sat 
		from material as a left join satuan as b on a.satuan = b.id where a.id_task = '$id_task' and a.jumlah != 0 
		order by a.nama_material asc");
		$no = 1;
		foreach($query->result() as $data){
			echo '
			<tr>
				<td>'.$no.'</td>
				<td>'.$data->bpb.'</td>
				<td>'.$data->nama_material.'</td>
                <td>'.number_format($data->harga,2,',','.').'</td>
                <td>'.$data->jumlah.'</td>
                <td>'.number_format($data->total_harga,2,',','.').'</td>
                
				<td>
					<input id="cek'.$no.'" type="text" value="'.$data->id.'" hidden>
					<input id="id_task'.$no.'" type="text" value="'.$id_task.'" hidden>
					<a id="a'.$no.'" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></a>
					<a href="'.base_url().'c_material/page_edit/'.$data->id.'" class="btn btn-sm btn-outline-warning"><i class="fa fa-refresh"></i></a>
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
					url: "'.base_url().'" + "c_material/del_material",
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

	function page_edit($id_material){
		$data['id_material'] = $id_material;

		$this->load->view("plugin/plugin");
		$this->load->view("edit/edit_material", $data);
	}

	function edit_material(){
		$id_material = $this->input->post("id_material");
		$qg_dm = $this->db->query("
			select * from material where id = $id_material
		");

		$id_task1 = $qg_dm->row()->id_task;

		/*echo '
			<script type="text/javascript">
				alert("Fungsi edit dihilangkan sementara !");
				location.href = "http://proman.local.sipatex.co.id:3500/c_material/page_material/'.$id_task1.'";
			</script>
		';
		$id_material = $this->input->post("id_material");*/
		$nm_mat = $this->input->post("nm_mat");
		$satuan = $this->input->post("satuan");
		$jml = $this->input->post("jml");
		$hrg = $this->input->post("hrg");
		$tot_hrg = $this->input->post("tot_hrg");

		$qg_dm = $this->db->query("
			select * from material where id = $id_material
		");

		$id_task1 = $qg_dm->row()->id_task;
		$nm_mat1 = $qg_dm->row()->nama_material;
		$bpb1 = $qg_dm->row()->bpb;

		$qu_mh = $this->db->query("
			update material_history 
			set nama_material = '$nm_mat', satuan = '$satuan', jumlah = '$jml', harga = '$hrg', total_harga = '$tot_hrg'
			where id_task = '$id_task1' and nama_material = '$nm_mat1'
			and bpb = '$bpb1'
		");

		//cari id project
		$cip = $this->db->query("
			select id_project from task where id = '$id_task1'
		");

		$ip = $cip->row()->id_project; //id project

		if($qu_mh){

			$qu_m = $this->db->query("
				update material
				set nama_material = '$nm_mat', satuan = '$satuan', jumlah = '$jml', harga = '$hrg', total_harga = '$tot_hrg'
				where id = '$id_material'
			");

			//hitung total budget from material history
			$abm = $this->db->query("
				select sum(a.total_harga) as total from material_history a where a.id_task = $id_task1 AND a.bpb IS NOT NULL
			");
			$tb = $abm->row()->total; //total budget per task

			//update act budget task
			$ut = $this->db->query("
				update task set budget = '$tb' where id = '$id_task1'
			");

			//hitung total budget per project
			$hbp = $this->db->query("
				select sum(budget) as budget from task where id_project = '$ip'
			");

			$tbp = $hbp->row()->budget;

			//update used budget project 
			$ubp = $this->db->query("
				update project set used_budget = '$tbp' where id = '$ip'
			");

		}else{
			echo 'error !';
		}

		$this->real_priority($ip);

		redirect("c_material/page_material/$id_task1");
		/**/

	}
	
	function add_comment(){
		$id_task = $this->input->post("id_task");
		$comment = $this->input->post("comment");
		$update = $this->db->query("
		UPDATE task set comment_material= '$comment' where id = '$id_task'
		");
		if($update){
			//echo 'Succes update comment';
			redirect("c_material/page_material/$id_task");
		}else{
			echo 'failed update comment';
		}
	}
	function cek(){
		$a = $this->input->post("cek");
		echo $a;
	}
	
	function add_material2(){
		date_default_timezone_set("Asia/Jakarta");
        $id_material = $this->input->post("id_material");
        $id_task = $this->input->post("id_task");
		$material = $this->input->post("nm_mat");
		$satuan = $this->input->post("satuan");
		$jumlah = $this->input->post("jml");
		$harga = $this->input->post("harga");
		$tharga = $this->input->post("tharga");
		$date = $this->input->post("du");
		$bpb = $this->input->post("bpb");
		$a = $this->input->post("cek");
		$by = $this->session->userdata('name');
		$at = date("Y-m-d h:i:s");

		if($a == "on"){
			$cek = 1;
		}else{
			$cek = 2;
		}
		//======================== GET ID PROJECT ==========================
		$get_ip = $this->db->query("
			select id_project from task where id = '$id_task'
		");
		$ip = $get_ip->row()->id_project; //id project
		//==================================================================


		// cek tbl material exist / tidak bpb , id task dan nama material yg sama
		$cek_material = $this->db->query("
			select * from material where id_task = '$id_task' AND nama_material = '$material' AND bpb = '$bpb'
		");

		$r_bpb = $cek_material->num_rows();
		
		//jika ada yg sama notif
		//jika tidak maka update tbl material dan insert material history
		if($r_bpb < 1){

			echo 'data dengan id_task : '.$id_task.', material : '.$material.', dan NO BPB : '.$bpb.' tidak ada yg sama';

			$z = $this->db->query("
				select * from material where id_task = '$id_task' and nama_material = '$material' and bpb IS NULL
			");

			$zr = $z->num_rows();

			if($zr != 0){

				$y = $this->db->query("
					update material set jumlah = '$jumlah', harga = '$harga', total_harga = '$tharga', bpb = '$bpb', 
					update_date = '$date', sesuai = '$cek'
					where id = '$id_material'
				");

				if($y){
					$grm = $this->db->query("
						select * from material where id = '$id_material'
					");

					$id_grm =  $grm->row()->id;
					$idt_grm = $grm->row()->id_task;
					$nm_grm = $grm->row()->nama_material;
					$estj_grm = $grm->row()->est_jumlah;
					$esth_grm =  $grm->row()->est_harga;
					$estth_grm = $grm->row()->est_total_harga;
					$bpb_grm = $grm->row()->bpb;
					$ud_grm = $grm->row()->update_date;
					$s_grm = $grm->row()->sesuai;
					$ab_grm = $grm->row()->add_by;
					$aa_grm = $grm->row()->add_at;
					
					$this->db->query("
						insert into material_history 
						(id_task, id_material, nama_material, satuan, est_jumlah, jumlah, est_harga, harga,
						est_total_harga, total_harga, bpb, update_date, sesuai, add_by, add_at) 
						values('$id_task','$id_material','$material','$satuan','$estj_grm','$jumlah','$esth_grm','$harga','$estth_grm','$tharga'
						,'$bpb ','$date','$s_grm','$ab_grm','$aa_grm')
					");
				}else{
					echo 'update_material gagal !';
				}
				$this->real_priority($ip);

			}else{
				echo '<br> data  dengan id_task : '.$id_task.', material : '.$material.', dan NO BPB : NULL tidak ada';
				//tambahkan value dalam record material
				$p = $this->db->query("
					select * from material where id = '$id_material'
				");

				$ta = $p->num_rows();
				
				if($ta != 0){
					$qty2 =  $p->row()->jumlah;
					
					$qty3 = ($qty2+$jumlah);
					$price2 = $p->row()->harga;
	
					$bpb2 = $p->row()->bpb;
					$ud2 = $date;
					$s2 =  $cek;
					$val_bpb = $bpb2.' - '.$bpb;
	
					$up1 = $this->db->query("
						update material set jumlah = '$qty3',harga = '$harga',total_harga = $qty3*$price2, bpb = '$val_bpb',
						update_date = '$date', sesuai = '$cek'
						where id_task = '$id_task' and nama_material = '$material' and bpb = '$bpb2'
					");

					if($up1){
						
						$p2 = $this->db->query("
							select * from material where id = '$id_material'
						");
	
						$idm3 = $p2->row()->id; 
						$idt3 = $p2->row()->id_task;
						$nm3 = $p2->row()->nama_material;
						$sat3 = $p2->row()->satuan;
						$ejml3 = $p2->row()->est_jumlah;
						$jml3 = $p2->row()->jumlah;
						$ehrg3 = $p2->row()->est_harga;
						$hrg3 = $p2->row()->harga;
						$ethrg3 = $p2->row()->est_total_harga;
						$thrg3 = $p2->row()->total_harga;
						$bpb3 = $p2->row()->bpb;
						$ud3 = $p2->row()->update_date;
						$s3 = $p2->row()->sesuai;
						$ab3 = $p2->row()->add_by;
						$aa3 = $p2->row()->add_at;
	
						$ins1 = $this->db->query("
							insert into material_history 
							(id_material,id_task,nama_material,satuan,est_jumlah,jumlah,est_harga,harga,est_total_harga,total_harga,bpb,update_date,sesuai,add_by,add_at)
							values
							('$idm3','$idt3','$nm3','$sat3','$ejml3','$jml3','$ehrg3','$hrg3','$ethrg3','$thrg3','$bpb3','$ud3','$s3','$ab3','$aa3')
						");
	
					}else{
						echo 'insert gagal';
					}
					
				}else{
					//jika id material nya kosong atau insert material yang baru tidak ada pada estimasi
					$this->db->query("
					insert into material (id_task,nama_material,satuan,harga,jumlah,total_harga,bpb,update_date,add_by,add_at) 
					values('$id_task','$material','$satuan','$harga','$jumlah','$tharga','$bpb', '$date', '$by','$at')
					");
			
					$last_id = $this->db->query("
						select max(id) as latest_id from material
					");
			
					$latest_id = $last_id->row()->latest_id;
			
					$this->db->query("
					insert into material_history (id_task,id_material,nama_material,satuan,harga,jumlah,total_harga,bpb,update_date,add_by,add_at) 
					values('$id_task','$latest_id','$material','$satuan','$harga','$jumlah','$tharga','$bpb', '$date', '$by','$at')
					");

				}

				//hitung total est budget & actual budget dari material
				$c_etb = $this->db->query("
					select sum(est_total_harga) as esth, sum(total_harga) as acth from material where id_task  = '$id_task'
				");

				$estb = $c_etb->row()->esth;
				$actb = $c_etb->row()->acth;

				$utp = $this->db->query("
					update task set est_budget = '$estb', budget = '$actb' where id = '$id_task'
				");

				//hitung total budget dari task
				$c_etbt = $this->db->query("
					select sum(est_budget) as estbt, sum(budget) as actbt from task where id_project = '$ip'
				");

				$estbt = $c_etbt->row()->estbt;
				$actbt = $c_etbt->row()->actbt;

				$ubp = $this->db->query("
					update project set est_budget = '$estbt', used_budget = '$actbt' where id = '$ip'
				");

				$this->real_priority($ip);

			}

			
		}else{
			echo '
			<div class="card-header white-text info-color">
				<div class="col-lg-12 md-form">
					<p>Material '.$material.' with BPB Number '.$bpb.' is already exist on this project !</p>
				</div>
			</div>
			<a class="btn btn-primary" href="'.base_url().'c_material/page_material/'.$id_task.'">Click Here To Back</a>
			';
		}
		redirect("c_material/page_material/$id_task");

    }
    
    function del_material(){
		$id_material = $this->input->post("a");
		$id_task = $this->input->post("b");

		$qg_ip = $this->db->query("
			select id_project from task where id = $id_task
		");

		$ip = $qg_ip->row()->id_project; //id project

		//select nama material nya
		$q1 = $this->db->query("select * from material where id = '$id_material'");
		$nm_mat = $q1->row()->nama_material;
		//echo $id_material;
		$query = $this->db->query("delete from material_history where id_material = '$id_material' and id_task = '$id_task' and nama_material = '$nm_mat' and bpb IS NOT NULL");
		
		//select material jika pada id material tersebut est jumlah = 0 maka delete juga pada material tersebut
		//jika ada est jumlah maka update
		$dq1 = $this->db->query("
			select est_jumlah from material where id = '$id_material'
		");

		$res_dq1 = $dq1->row();

		if($res_dq1->est_jumlah == 0 || $res_dq1->est_jumlah == NULL){
			// delete juga pada material
			$q2 = $this->db->query("
				delete from material where id = '$id_material'
			");

		}else{
			// updatematerial
			$q2 = $this->db->query("update material 
			set jumlah = default(jumlah), harga = default(harga), total_harga = default(total_harga), bpb = default(bpb), 
			update_date = default(update_date), sesuai = default(sesuai) where id = '$id_material'");
		}

		$get_sab = $this->db->query("
			select sum(a.total_harga) as total from material_history a where a.id_task = $id_task AND a.bpb IS NOT NULL;
		");
		
		$th = $get_sab->row()->total;

		$ubt = $this->db->query("
			update task set budget = '$th' where id = '$id_task'
		");

		$get_ait = $this->db->query("
			select group_concat(id separator ',') as id_task from task where id_project = '$ip';
		");

		$ait = $get_ait->row()->id_task;

		$get_bft = $this->db->query("
			select sum(a.total_harga) as total_budget from material_history a where a.id_task IN($ait) AND a.bpb IS NOT NULL;
		");
		//get total budget lalu update project

		$tb = $get_bft->row()->total_budget;

		$up = $this->db->query("
			update project set used_budget = '$tb' where id = $ip
		");

		$this->real_priority($ip);	

		redirect("c_kick_off/page_material/$id_task");
		
	}
	
	function real_priority($id_project){
		$qs_prior = $this->db->query("select kategori,used_budget,resource,hari,complexity from project where id = '$id_project'");
		$fr = $qs_prior->row();
		$kat = $fr->kategori;
		$bdgt = $fr->used_budget;
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
		elseif($bdgt > 15000000 && $bdgt <= 50000000){
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
