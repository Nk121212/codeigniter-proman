<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_summary extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        //load model admin
        $this->load->model('admin');
	}
	
	public function index(){
        date_default_timezone_set("Asia/Jakarta");
        $id_project = $this->input->post("id_project");

        $q_idt = $this->db->query("
            select group_concat(id separator ',') as id_task from task where id_project = $id_project
        ");

        $id_task = $q_idt->row()->id_task;

        $q_mulai = $this->db->query("
            select min(start) as mulai from todo where id_task IN($id_task)
        ");

        $mulai = $q_mulai->row()->mulai;
        //$now = date("Y-m-d");
    
        
        // cari total minggu diantara tgl start dan tgl sekarang
        $tm = $this->db->query("
            SELECT FLOOR(DATEDIFF(curdate(),'$mulai')/7) as z;
        ");

        $z = $tm->row()->z;

        if($z == ""){
            $y = 1;
        }else{
            $y = $z;
        }
        // bikin looping cari progress / minggu sebanyak total minggu x
    
        $q_ttd = $this->db->query("
        select count(id) as total_todo from todo where id_task IN($id_task)
        ");
        $total_todo = $q_ttd->row()->total_todo;
    
        $full = 100/$total_todo;
        $half = 100/($total_todo*2);
    
        $jsa = 0;
        $wk = 1;
        $tp = 0;
        for( $i = 0; $i<$y; $i++ ) {
    
            $tes1 = $this->db->query("
                select a.id_task, a.to_do, a.est_start, a.est_finish, 
                MAX(a.start) as start, MAX(a.finish) as finish, MAX(a.status) as status 
                from todo_history a
                where a.update_date BETWEEN '$mulai' AND ('$mulai' + INTERVAL $wk WEEK)
                and a.id_task in($id_task)
                group by a.to_do;
            ");
    
            $stt = 0;
            $sumtp = 0;
            foreach($tes1->result() as $data){
                if($data->status == 0){
                    $statusnya = 0;
                }elseif($data->status == 1){
                    $statusnya = $half;
                }elseif($data->status == 2){
                    $statusnya = $full;
                }else{
                    $statusnya = 0;
                }
                //echo 'progress '.$wk.' '.$stt = $statusnya.'<br>';
                $sumtp += $statusnya;
            }
            
            $arr[] = array();
            $arr[$jsa] = round($sumtp);
    
            $wk ++;
            $jsa ++;
        }
        header('Content-Type: application/json');
        echo json_encode($arr);
		
    }

    function data_project(){
        $id_project = $this->input->post("id_project");

        $q_idt = $this->db->query("
            SELECT GROUP_CONCAT(id SEPARATOR ', ') as id_task FROM task WHERE id_project = '$id_project' 
        ");

        $id_task = $q_idt->row()->id_task;

        $q_mulai = $this->db->query("
            select
            min(tt.est_start) as est_start, max(tt.est_finish) as est_finish, 
            min(tt.`start`) as mulai, max(tt.finish) as selesai 
            from todo tt where id_task IN($id_task);
        ");

        $plan_mulai = $q_mulai->row()->est_start;
        $plan_selesai = $q_mulai->row()->est_finish;
        $tgl_mulai = $q_mulai->row()->mulai;
        $tgl_selesai = $q_mulai->row()->selesai;

        $query1 = $this->db->query("
            select a.*, b.nama from project a 
            LEFT JOIN coordinator b
            ON a.kordinator = b.id
            where a.id = '$id_project'
        ");
        

        $todo_sf = $this->db->query("
            select
            min(tt.est_start) as est_start, max(tt.est_finish) as est_finish, 
            min(tt.`start`) as mulai, max(tt.finish) as selesai 
            from todo tt where id_task IN($id_task);
        ");

        $r_awal = $todo_sf->row()->est_start;
        $r_akhir = $todo_sf->row()->est_finish;
        $awal = $todo_sf->row()->mulai;
        $akhir = $todo_sf->row()->selesai;

        if($r_awal == NULL || $r_awal == "0000-00-00"){
            $estb = "Not Estimated";
        }else{
            $estb = date("d M Y",strtotime($r_awal));
        }

        if($r_akhir == NULL || $r_akhir == "0000-00-00"){
            $estf = "Not Estimated";
        }else{
            $estf = date("d M Y",strtotime($r_akhir));
        }

        if($awal == NULL || $awal == "0000-00-00"){
            $awal1 = 'Not Started Yet';
        }else{
            $awal1 = date("d M Y",strtotime($awal));
        }

        if($akhir == NULL || $akhir == "0000-00-00"){
            $akhir1 = 'Not Started Yet';
        }else{
            $akhir1 = date("d M Y",strtotime($akhir));
        }

        $material_query = $this->db->query("
            select max(a.id_task) as id_task,a.nama_material,max(a.satuan) as satuan,
            max(a.est_jumlah) as est_jumlah, max(a.jumlah) as jumlah, max(a.est_harga) as est_harga,
            max(a.harga) as harga,  max(a.est_total_harga) as est_total_harga, max(a.total_harga) as total_harga,
            max(a.bpb) as bpb, max(a.update_date) as update_date, b.nama_satuan
            FROM material_history as a
            left join satuan b on a.satuan = b.id
            where a.id_task IN($id_task) 
            group by a.nama_material;
        ");
        $estb1 = 0;
        $actb1 = 0;
        foreach($material_query->result() as $mymat){
            $estb1 += $mymat->est_total_harga;
            $actb1 += $mymat->total_harga;
        }

        $q_res = $this->db->query("
            SELECT GROUP_CONCAT(a.res_external SEPARATOR ', ') as res_ext, GROUP_CONCAT(b.nama_departemen SEPARATOR ', ') as res_int 
            FROM task a 
            LEFT JOIN departemen b 
            ON a.res_internal = b.id
            WHERE a.id IN($id_task)
        ");
        $res_int = $q_res->row()->res_int;
        $res_ext = $q_res->row()->res_ext;

        $q_total_todo = $this->db->query("
            select count(id) as tt from todo a where a.id_task IN($id_task);
        ");
        $tt = $q_total_todo->row()->tt;

        $full = 100/$tt;
        $half = 100/($tt*2);

        $q_progress = $this->db->query("
            select a.id_task, a.to_do, a.est_start,a.est_finish, MAX(a.`start`) as start, MAX(a.finish) as finish,
            MAX(a.`status`) as status, MAX(a.update_date) as tgl_update 
            from todo_history a 
            WHERE a.update_date between '$tgl_mulai' and CURDATE() AND 
            id_task IN($id_task)
            GROUP BY a.to_do;
        ");

        $progress = 0;
        foreach($q_progress->result() as $data){
            $status = $data->status;
            if($status == 1){
                $jml_prog = $half;
            }elseif($status == 2){
                $jml_prog = $full;
            }elseif($status == 0){
                $jml_prog = 0;
            }else{
                $jml_prog = 0;
            }
            
            $progress += $jml_prog;
        }
        
        $i = 0;
        foreach($query1->result() as $data){

            if($data->status == 1){
                $stat = 'Not Started';
            }elseif($data->status == 2){
                $stat = 'Started';
            }elseif($data->status == 3){
                $stat = 'Cancel';
            }elseif($data->status == 4){
                $stat = 'Close';
            }

            /*
            if($data->mulai == NULL || $data->mulai == "0000-00-00"){
                $mulai = "Not Started Yet";
            }else{
                $mulai = date("d M Y",strtotime($data->mulai));
            }

            if($data->selesai == NULL || $data->selesai == "0000-00-00"){
                $selesai = "Not Finish Yet";
            }else{
                $selesai = date("d M Y",strtotime($data->selesai));
            }
            */

            $arr1[] = array();
            $arr1[$i]['nm_pro'] = $data->nama_project;
            $arr1[$i]['lokasi'] = $data->lokasi;
            $arr1[$i]['status'] = $data->status;
            $arr1[$i]['pic'] = $data->nama;
            $arr1[$i]['status'] = $stat;
            $arr1[$i]['prioritas'] = $data->prioritas;
            $arr1[$i]['progress'] = round($progress);


            $arr1[$i]['estb'] = number_format($estb1,2,',','.');
            $arr1[$i]['actb'] = number_format($actb1,2,',','.');
            $arr1[$i]['ests'] = $estb;
            $arr1[$i]['estf'] = $estf;
            $arr1[$i]['start'] = $awal1;
            $arr1[$i]['finish'] = $akhir1;
            $arr1[$i]['resint'] = $res_int;
            $arr1[$i]['resext'] = $res_ext;

            $i++;
        }
        header('Content-Type: application/json');
        echo json_encode($arr1);

    }

    function data_task(){
        $id_project = $this->input->post("id_project");

        $que1 = $this->db->query("
        SELECT * from task where id_project = '$id_project'
        "); 

        $nt = 1;
        foreach($que1->result() as $data){
            $id_task = $data->id;
            $nm_task = $data->nama_task;
            $gambar = $data->attachment;
            
            $que2 = $this->db->query("
                SELECT * FROM todo WHERE id_task = '$id_task'
            ");

            $que3 = $this->db->query("
                SELECT count(id) as tr FROM todo WHERE id_task = '$id_task'
            ");
            $tr = $que3->row()->tr;

            echo '
                <table class="table">
                    <thead>
                        <tr>
                            <th>'.$nt.'. '.$nm_task.'</th>
                            <th>Todo Name</th>
                            <th>Plan Start</th>
                            <th>Plan Finish</th>
                            <th>Actual Start</th>
                            <th>Actual Finish</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td  rowspan="'.$tr.'">
                                <img src="'.base_url().''.$gambar.'" alt="No Image" height="250" width="250">
                            </td>
            ';

            foreach($que2->result() as $data2){
                $to_do = $data2->to_do;
                $est_start = $data2->est_start;
                $est_finish = $data2->est_finish;
                $act_start = $data2->start;
                $act_start = $data2->finish;
                if($est_start == NULL || $est_start == "" || $est_start == "0000-00-00"){
                    $new = '*';
                }else{
                    $new = '';
                }

                echo '
                        <td >'.$new.' '.$to_do.'</td>
                        <td >'.$est_start.'</td>
                        <td >'.$est_finish.'</td>
                        <td >'.$act_start.'</td>
                        <td >'.$act_start.'</td>
                    </tr>
                        
                ';
            }

            $nt++;

            echo '  
            </tbody>
        </table>
        ';
        }
        echo '
        <br></br>
        
        <div class="baris">
            <p style="margin-left:5px;font-weight:bold;color:white;">BENCHMARK OVERVIEW</p>
        </div>
        ';

        $que4 = $this->db->query("
            SELECT * FROM rating WHERE id_project = '$id_project'
        ");
        echo '
        <table class="table">
            <thead>
                <tr>
                    <th>Benchmark Overview</th>
                    <th>Rating</th>
                    <th>Comment</th>
                </tr>
            </thead>
            <tbody>
        ';
        foreach($que4->result() as $data3){
            $benchmark = $data3->tolak_ukur;
            $rate = $data3->rate;
            $comment = $data3->comment;

            if($rate == "Happy"){
                $pictures = "smile.png";
            }elseif($rate == "Neutral"){
                $pictures = "meh.png";
            }else{
                $pictures = "angry.png";
            }

            echo '
                <tr>
                    <td>'.$benchmark.'</td>
                    <td>
                    <img src="'.base_url().'image/rate/'.$pictures.'" alt="No Image" height="60" width="60">
                    '.$rate.'
                    </td>
                    <td>'.$comment.'</td>
                </tr>
            ';
        }
        echo '
            </tbody>
        </table>
        ';
    }

} //TUTUP CONTROLLER

?>