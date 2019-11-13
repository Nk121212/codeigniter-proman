<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_report extends CI_Controller {
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
			$this->load->view("report_form/vr_status");         

        }else{
            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("logincontroller");
        }
    }

    function p_open(){
		$status = $this->input->post("status");
		//echo $status;
		if($status == 'all'){
			$query = $this->db->query("select * from project");
		}else{
			$query = $this->db->query("select * from project where status = '$status'");
		}
		
		if($query->num_rows() < 1){
			echo '
			<tr>
				<td style="text-align:center;background-color:#CC0000;color:white;" colspan = "7">No Data</td>
			</tr>';
		}else{
			$no = 1;
			foreach($query->result() as $data){

				$id = $data->id;
				$nm_project = $data->nama_project;

				$q2 = $this->db->query("
					select GROUP_CONCAT(id separator ',') as id_task from task where id_project = $id;
				");

				$id_task = $q2->row()->id_task;

				$q3 = $this->db->query("
					select min(a.`start`) as mulai, max(a.finish) as finish from todo_history a where id_task IN($id_task);
				");


				$start = $q3->row()->mulai;
				$end = $q3->row()->finish;

				$rh = $this->db->query("
					select DATEDIFF('$end','$start') as rtg;
				");

				$rtgd = $rh->row()->rtg;

				$dur = $data->hari;
				
                if($rtgd == NULL){
                    $rentang = '';
                }else{
                    $rentang = $rtgd." Hari";
				}
				
				$add_by = $data->add_by;
				$stat = $data->status;

				if($stat == 1){
					$status = 'Not Started';
				}elseif($stat == 2){
					$status = 'Started';
				}elseif($stat == 3){
					$status = 'Cancel';
				}elseif($stat == 4){
					$status = 'Close';
				}

				echo '
				<tr>
					<td>'.$no.'</td>
					<td>'.$nm_project.'</td>
					<td>'.$start.'</td>
					<td>'.$end.'</td>
					<td>'.$rentang.'</td>
                    <td>'.$add_by.'</td>
                    <td>'.$status.'</td>
				</tr>
				';

				$no++;

			}
		}
    }
    
    function pdf_report($stat){
        $data["status"] = $stat;
        $this->load->library("pdf");
        $this->pdf->load_view('report_form/vr_pdf',$data);
        $this->pdf->set_paper('A4', 'landscape');
        $this->pdf->render();
        $this->pdf->stream("name-file.pdf", array("Attachment" => false));
	}
	
    function xcl_all($stat){
        $data["status"] = $stat;
        $this->load->view("report_form/vr_excel",$data);
	}
	
	function progress_page(){
		
	if($this->admin->logged_id())
		{
			$this->load->view("plugin/plugin");
			$this->load->view("report_form/vr_progress");         

		}else{
			//jika session belum terdaftar, maka redirect ke halaman login
			redirect("logincontroller");
		}
	}

	function start_date(){
		$id_project = $this->input->post("id_project");
		//echo $id_project;
		$query = $this->db->query("
		select mulai from project where id = '$id_project'
		");
		$rows = $query->row();
		$start = $rows->mulai;
		if($start == NULL || $start == ""){
			echo 'Not Started Yet';
		}else{
			echo $start;
		}
	}

	function report_progress(){
		$date_to = $this->input->post("tgl");
		$id_project = $this->input->post("idp");

		$data = array('date_to' => $date_to, 'id_project' => $id_project);
		$this->load->library("pdf"); //load library pdf
		//$this->pdf->set_option('isHtml5ParserEnabled', TRUE);
		//$this->pdf->loadHtml($html);
        //$this->load->view("plugin/plugin");
        $this->pdf->load_view('report_form/tes',$data);
        $this->pdf->set_paper('A4', 'landscape');
        $this->pdf->render();
		$this->pdf->stream("name-file.pdf", array("Attachment" => false));
	}
	function tes_style(){
		//$this->load->view("report_form/tes.php");
		$this->load->library("pdf"); //load library pdf
        $this->load->view("plugin/plugin");
        $this->pdf->load_view('report_form/tes');
        $this->pdf->set_paper('A4', 'landscape');
        $this->pdf->render();
		$this->pdf->stream("name-file.pdf", array("Attachment" => false));
	}

	function summary(){
		if($this->admin->logged_id())
        {
			$this->load->view("plugin/plugin");
			$this->load->view("report_form/summary");         

        }else{
            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("logincontroller");
        }
	}

} //TUTUP CONTROLLER
