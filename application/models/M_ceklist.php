<?php
    class M_ceklist extends CI_Model{

        function show_cproject(){
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
                        <a data-toggle="modal" data-target="#ceklist_modal" data-toggle="tooltip" data-placement="top" title="Add Ceklist" id="add_btn'.$no.'" class="btn-floating btn-sm blue-gradient">
                            <i class="fa fa-plus"></i> 
                        </a>
    
                        <a href="c_detail/'.$id.'" data-toggle="tooltip" data-placement="top" title="Detail Ceklist '.$project.'" class="btn-floating btn-sm btn-info">
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
                            $("#cek_id").val("'.$id.'");
                        })
                    </script>';
                    $no ++;
                }
            }
        }

    }