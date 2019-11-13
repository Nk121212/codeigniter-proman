<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tes extends CI_Controller {

public function index(){
        //$id_project = $this->input->post("id_project");
        $q_mulai = $this->db->query("
        select mulai from project where id = 21
        ");
        $mulai = $q_mulai->row()->mulai;
        $now = date("Y-m-d");
    
        $q_idt = $this->db->query("
        select group_concat(id separator ',') as id_task from task where id_project = 21
        ");
        $id_task = $q_idt->row()->id_task;
        // cari total minggu diantara tgl start dan tgl sekarang
        $tm = $this->db->query("
            select week('$now') - week('$mulai') as z;
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
        echo "total_todo1 : ".$total_todo = $q_ttd->row()->total_todo;
    
        echo 'Full '.$full = 100/$total_todo;
        echo 'Half'.$half = 100/($total_todo*2);
    
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
                echo ', progress : '.$sumtp += $statusnya.'<br>';
            }
            
            $arr[] = array();
            $arr[$jsa] = round($sumtp);
    
            $wk ++;
            $jsa ++;
        }
        header('Content-Type: application/json');
        //echo json_encode($arr);
		
    }

    function data_project(){
        //$id_project = $this->input->post("id_project");
        $query1 = $this->db->query("
            select a.*, b.nama from project a 
            LEFT JOIN coordinator b
            ON a.kordinator = b.id
            where a.id='21'
        ");
        $q_idt = $this->db->query("
        SELECT GROUP_CONCAT(id SEPARATOR ', ') as id_task FROM task WHERE id_project = '21' 
        ");
        $id_task = $q_idt->row()->id_task;

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
        echo 'total todo :'.$tt = $q_total_todo->row()->tt;

        echo 'Full :'.$full = 100/$tt;
        echo 'Half :'.$half = 100/($tt*2);

        $q_progress = $this->db->query("
            select a.id_task, a.to_do, a.est_start,a.est_finish, MAX(a.`start`) as start, MAX(a.finish) as finish,
            MAX(a.`status`) as status, MAX(a.update_date) as tgl_update 
            from todo_history a 
            WHERE a.update_date between '0000-00-00' and CURDATE() AND 
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
            
            echo ' , progress :'.$progress += $jml_prog. ' ';
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

            if($data->est_mulai == NULL || $data->est_mulai == "0000-00-00"){
                $estb = "Not Estimated";
            }else{
                $estb = date("d M Y",strtotime($data->est_mulai));
            }

            if($data->est_selesai == NULL || $data->est_selesai == "0000-00-00"){
                $estf = "Not Estimated";
            }else{
                $estf = date("d M Y",strtotime($data->est_selesai));
            }

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

            $arr1[] = array();
            $arr1[$i]['nm_pro'] = $data->nama_project;
            $arr1[$i]['lokasi'] = $data->lokasi;
            $arr1[$i]['status'] = $data->status;
            $arr1[$i]['pic'] = $data->nama;
            $arr1[$i]['status'] = $stat;
            $arr1[$i]['prioritas'] = $data->prioritas;
            $arr1[$i]['progress'] = round($progress);


            $arr1[$i]['estb'] = number_format($data->est_budget,2,',','.');
            $arr1[$i]['actb'] = number_format($data->used_budget,2,',','.');
            $arr1[$i]['ests'] = $estb;
            $arr1[$i]['estf'] = $estf;
            $arr1[$i]['start'] = $mulai;
            $arr1[$i]['finish'] = $selesai;
            $arr1[$i]['resint'] = $res_int;
            $arr1[$i]['resext'] = $res_ext;

            $i++;
        }
        header('Content-Type: application/json');
        //echo json_encode($arr1);

    }
}