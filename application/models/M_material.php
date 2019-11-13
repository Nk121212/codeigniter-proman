<?php
    class M_material extends CI_Model{

        function insert_material(){
            date_default_timezone_set("Asia/Jakarta");
            $id = $this->input->post('my_id');
            $nama_mat = $this->input->post('nm_mat');
            $jumlah = $this->input->post('jml_mat');
            $nama_satuan = $this->input->post('sat_mat');
            $hrg_satuan = $this->input->post('hrg_mat');
            $total_hrg = $this->input->post('tot_hrg_mat');
            $add_by = $this->session->userdata('user_name');
            $add_at = date("Y-m-d h:i:s");

            $cek_master = $this->db->query("select * from m_material where nama_material = '$nama_mat' 
            and satuan='$nama_satuan' and harga_satuan = '$hrg_satuan'");
            if($cek_master->num_rows() < 1){
                $data = array(
                    'nama_material' => $nama_mat,
                    'satuan' => $nama_satuan,
                    'harga_satuan' => $hrg_satuan,
                    'add_by' => $add_by,
                    'add_at' =>$add_at
                );
                $query = $this->db->insert('m_material',$data);
            }else{
                $data = array(
                    'nama_material' => $nama_mat,
                    'satuan' => $satuan_mat,
                    'harga_satuan' => $hrg_satuan,
                    'add_by' => $add_by,
                    'add_at' =>$add_at
                );
                
                $this->db->where('nama_material', $nama_mat);
                $this->db->where('satuan', $nama_satuan);
                $update_material = $this->db->update('m_material', $data);
            }

            $data = array(
				'id_project' => $id,
				'nama_material' => $nama_mat,
				'jumlah' => $jumlah,
                'id_satuan' => $nama_satuan,
                'harga_satuan' => $hrg_satuan,
                'total_harga' => $total_hrg,
                'mat_add_by' => $add_by,
                'mat_add_at' =>$add_at
            );
            
            $query = $this->db->insert('material',$data);
            if($query){
                redirect("../materialcontroller/index");
            }else{
                echo "Gagal Insert";
            }

        }

        function show_mproject(){
            $id = $this->input->post("id");
            $query = $this->db->query("select * from act_project where status = 1");
            $row = $query->num_rows();

            $no = 1;
            if($row < 1){
                echo '
                <tr>
                    <td colspan="9" style="font-weight:bold;text-align:center;">No Data</td>
                </tr>';
            }else{
                foreach($query->result() as $data){
                    $id = $data->id;
                    $project = $data->act_pname;
                    $start = $data->act_pstart;
                    if($start == NULL){
                        $mulai = '00/00/0000';
                    }else{
                        $mulai = date('d/m/Y', strtotime($start));
                    }
                    
                    $end = $data->act_pend;
                    if($end == NULL){
                        $selesai = '00/00/0000';
                    }else{
                        $selesai = date('d/m/Y', strtotime($end));
                    }
                    $rentang = $data->act_pdays;
                    $add_by = $data->act_add_by;
                    $add_at = $data->act_add_at;
        
                    echo '
                    <tr>
                    <td>'.$no.'</td>
                    <td>
                        <input type="text" id="id_ku'.$no.'" value="'.$id.'" hidden>
                        <a data-toggle="modal" data-target="#material_modal" data-toggle="tooltip" data-placement="top" title="Add New Material" id="add_btn'.$no.'" class="btn-floating btn-sm blue-gradient">
                            <i class="fa fa-plus"></i> 
                        </a>
    
                        <a href="m_detail/'.$id.'" data-toggle="tooltip" data-placement="top" title="Detail Material '.$project.'" class="btn-floating btn-sm btn-info">
                            <i class="fa fa-eye"></i> 
                        </a>
                    </td>
                    <td>'.$project.'</td>
                    <td>'.$mulai.'</td>
                    <td>'.$selesai.'</td>
                    <td>'.$rentang.'  Hari</td>
                    <td>'.$add_by.'</td>
                    <td>'.$add_at.'</td>
                    ';
                    echo '
                    <script>
                        $("#add_btn'.$no.'").click(function(){
                            var id = $("#id_ku'.$no.'").val();
                            alert(id);
                            $("#my_id").val("'.$id.'");
                        })
                    </script>';
                    $no ++;
                }
            }
        }

        function show_msatuan(){
            $query = $this->db->query("select * from satuan");
            $row = $query->row();
    
            echo '
            <option value="" disabled selected>Satuan</option>';
            foreach($query->result() as $data){
                
                $id = $data->id;
                $nama = $data->nama_satuan;
    
                echo '
                <option value="'.$id.'">'.$nama.'</option>';
            }
        }

        function update_material(){
            $id = $this->input->post('id_material');
            $nm_mat = $this->input->post('nama_mat');
            $jml_mat = $this->input->post('jumlah_mat');
            $satuan_mat = $this->input->post('satuan_mat');
            $harga_mat = $this->input->post('harga_mat');
            $total_hrg = $this->input->post('tot_harga_mat');
    
            $data = array(
                'nama_material' => $nm_mat,
                'jumlah' => $jml_mat,
                'id_satuan' => $satuan_mat,
                'harga_satuan' => $harga_mat,
                'total_harga' => $total_hrg
            );
            
            $this->db->where('id', $id);
            $update_material = $this->db->update('material', $data);
            if($update_material){
                redirect($_SERVER['HTTP_REFERER']);
            }else{
                echo "Gagal Update !";
            }
        }

        function delete_material(){
            $id = $this->input->post('del_id');
            //echo $id;
            $this->db->where('id', $id);
            $del = $this->db->delete('material');
            if($del){
                redirect($_SERVER['HTTP_REFERER']);
            }else{
                echo "Gagal Delete !";
            }
        }
        function select_dept(){
            $query = $this->db->query("select * from departemen");
            
                echo '
                <option value ="" disabled selected>Departemen</option>';
                foreach($query->result() as $data){
                    
                    $id = $data->id;
                    $nama = $data->nama_departemen;
    
                    echo '
                    <option value="'.$id.'">'.$nama.'</option>';
                }
        }
        

    }