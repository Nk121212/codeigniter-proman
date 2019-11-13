<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_rating extends CI_Controller {
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
            $this->load->view("group_actual/vu_rating");         
    
        }else{
    
            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("logincontroller");
        }
    }

    function show_rating(){
        $id_project = $this->input->post("id_project");
        //echo $id_project;
        $query = $this->db->query("select * from rating where id_project = '$id_project'");

        $i = 0;
        foreach($query->result() as $data){ 

            $dm[] = array();
            $dm[$i]['id_project'] = $data->id_project;
            $dm[$i]['schedule'] = $data->schedule;
            $dm[$i]['costing'] = $data->costing;
            $dm[$i]['resource'] = $data->resource;
            $dm[$i]['material'] = $data->material;
            $i++;

        }

        header('Content-Type: application/json');
        echo json_encode($dm);
        
    }

    function data_p(){
        $idp = $this->input->post("id_project");
        //echo $idp;
        $query = $this->db->query("
            select * from project where id = '$idp'
        ");

        $qidt = $this->db->query("select group_concat(id separator ',') as id_task from task where id_project = '$idp'");
        $id_task = $qidt->row()->id_task;

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

        $estb = 0;
        $actb = 0;

        foreach($material_query->result() as $mymat){
            $estb += $mymat->est_total_harga;
            $actb += $mymat->total_harga;
        }

        $percentage = $actb/$estb*100;

        $todo_sf = $this->db->query("
            select min(est_start) as est_awal, max(est_finish) as est_akhir, min(start) as awal, max(finish) as akhir from todo where id_task IN($id_task);
        ");

        $est_awal = $todo_sf->row()->est_awal;
        $est_akhir = $todo_sf->row()->est_akhir;
        
        $awal = $todo_sf->row()->awal;
        $akhir = $todo_sf->row()->akhir;

        if($est_awal == NULL || $est_awal == "0000-00-00"){
            $est_awal1 = 'Not Started Yet';
        }else{
            $est_awal1 = date("d M Y",strtotime($est_awal));
        }

        if($est_akhir == NULL || $est_akhir == "0000-00-00"){
            $est_akhir1 = 'Not Started Yet';
        }else{
            $est_akhir1 = date("d M Y",strtotime($est_akhir));
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

        //===========================hitung hari awal sampai akhir
        $date1 = new DateTime($awal);
        $date2 = new DateTime($akhir);
        $diff = $date2->diff($date1);
        $hari = $diff->format('%a');
        //===========================hitung hari awal sampai akhir

        //===========================hitung hari est_awal sampai est_akhir
        $date3 = new DateTime($est_awal);
        $date4 = new DateTime($est_akhir);
        $diff2 = $date4->diff($date3);
        $hari2 = $diff2->format('%a');
        //===========================hitung hari awal sampai akhir

        $qcount = $this->db->query("select sum(sesuai=1) as sesuai from material where id_task IN($id_task)");
        $sesuai = $qcount->row()->sesuai;
        $qcount2 = $this->db->query("select sum(sesuai=2) as tidak from material where id_task IN($id_task)");
        $tidak = $qcount2->row()->tidak;

        $i = 0;
        foreach($query->result() as $data){
            $est_budget = $data->est_budget;
            $budget = $data->used_budget;

            $dp[] = array();
            $dp[$i]['est_mulai'] = date("d M Y",strtotime($est_awal));
            $dp[$i]['est_selesai'] = date("d M Y",strtotime($est_akhir));
            $dp[$i]['est_hari'] = $hari2;
            $dp[$i]['mulai'] = date("d M Y",strtotime($awal1));
            $dp[$i]['selesai'] = date("d M Y",strtotime($akhir1));
            $dp[$i]['hari'] = $hari;
            $dp[$i]['est_budget'] = number_format($estb,2,',','.');
            $dp[$i]['budget'] = number_format($actb,2,',','.');
            $dp[$i]['persen'] = round($percentage);
            $dp[$i]['sesuai'] = $sesuai;
            $dp[$i]['tidak'] = $tidak;



            $i ++;
        }
        header('Content-Type: application/json');
        echo json_encode($dp);
    }


    function add_rate(){

        $id_project = $this->input->post("idp");
        
        $post_sche = $this->input->post("sche");
        $cost = $this->input->post("cost");
        $mat = $this->input->post("mat");
        $resint = $this->input->post("res_int");
        $resext = $this->input->post("res_ext");
        
        $sche_tu = $this->input->post("sche_tu");
        $cost_tu = $this->input->post("cost_tu");
        $mat_tu = $this->input->post("mat_tu");
        $resint_tu = $this->input->post("resint_tu");
        $resext_tu = $this->input->post("resext_tu");

        
        if($post_sche == '1'){
            $schedule = 'Happy';
        }elseif($post_sche == '2'){
            $schedule = 'Neutral';
        }elseif($post_sche == '3'){
            $schedule = 'Upset';
        }else{
            $schedule = 'Not Rated';
        }

        if($cost == '1'){
            $costing = 'Happy';
        }elseif($cost == '2'){
            $costing = 'Neutral';
        }elseif($cost == '3'){
            $costing = 'Upset';
        }else{
            $costing = 'Not Rated';
        }

        if($mat == '1'){
            $material = 'Happy';
        }elseif($mat == '2'){
            $material = 'Neutral';
        }elseif($mat == '3'){
            $material = 'Upset';
        }else{
            $material = 'Not Rated';
        }

        if($resint == '1'){
            $internal = 'Happy';
        }elseif($resint == '2'){
            $internal = 'Neutral';
        }elseif($resint == '3'){
            $internal = 'Upset';
        }else{
            $internal = 'Not Rated';
        }

        if($resext == '1'){
            $external = 'Happy';
        }elseif($resext == '2'){
            $external = 'Neutral';
        }elseif($resext == '3'){
            $external = 'Upset';
        }else{
            $external = 'Not Rated';
        }

        $sche_rate = $this->input->post("sche_rate");
        $cost_rate = $this->input->post("cost_rate");
        $mat_rate = $this->input->post("mat_rate");
        $resint_rate = $this->input->post("resint_rate");
        $resext_rate = $this->input->post("resext_rate");

        //echo 'insert new record';
        $this->db->query("
        insert into rating (id_project,tolak_ukur,rate,comment) 
        values('$id_project','$sche_tu','$schedule','$sche_rate')
        ");
        $this->db->query("
        insert into rating (id_project,tolak_ukur,rate,comment) 
        values('$id_project','$cost_tu','$costing','$cost_rate')
        ");
        $this->db->query("
        insert into rating (id_project,tolak_ukur,rate,comment) 
        values('$id_project','$mat_tu','$material','$mat_rate')
        ");
        $this->db->query("
        insert into rating (id_project,tolak_ukur,rate,comment) 
        values('$id_project','$resint_tu','$internal','$resint_rate')
        ");
        $this->db->query("
        insert into rating (id_project,tolak_ukur,rate,comment) 
        values('$id_project','$resext_tu','$external','$resext_rate')
        ");
        
        $this->db->query("
        update project set rated = '1' where id = '$id_project'
        ");
        
        redirect("../c_rating/index");

    }
   

} //TUTUP CONTROLLER
