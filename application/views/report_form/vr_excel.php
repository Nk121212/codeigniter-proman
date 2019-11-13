<?php

 if($status == 'all'){
     $rn = 'All Project';
 }elseif($status == '1'){
    $rn = 'Not Started';
 }elseif($status == '2'){
    $rn = 'Started Project';
 }elseif($status == '3'){
    $rn = 'Cancel Project';
 }elseif($status == '4'){
    $rn = 'Close Project';
 }

 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=$rn.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>
 
 <title>
Report All Project
</title>

<style>
table, td, th {  
  border: 1px solid #ddd;
  text-align: left;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 15px;
}
</style>
<div class="col-lg-12 md-form">

    <div style="text-align:center;">
        <p>
        <?php
                if($status == 'all'){
                    echo 'All Project';
                }elseif($status == '1'){
                    echo 'Not Started';
                }elseif($status == '2'){
                    echo 'Started Project';
                }elseif($status == '3'){
                    echo 'Cancel Project';
                }elseif($status == '4'){
                    echo 'Close Project';
                }
            ?>
        </p>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Project</th>
                <th>Category</th>
                <th>Benefit</th>
                <th>Start</th>
                <th>End</th>
                <th>Durasi</th>
                <th>Location</th>
                <th>Coordinator</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if($status == 'all'){
                    $query = $this->db->query("select a.*,b.nama as nama_kordinator from project as a left join coordinator as b on a.kordinator = b.id");
                }else{
                    $query = $this->db->query("select a.*,b.nama as nama_kordinator from project as a left join coordinator as b on a.kordinator = b.id where a.status = $status");
                }
                
                if($query->num_rows() < 1){
                    echo '
                    <tr>
                        <td colspan="9" style="text-align:center;color:white;background-color:red;">No Data</td>
                    </tr>';
                }else{
                    $no = 1;
                    foreach($query->result() as $data){
                        $nm_project = $data->nama_project;
                        $kategori = $data->kategori;
                        $tujuan = $data->purpose;
                        $start = $data->mulai;
                        $end = $data->selesai;
                        $dr = $data->hari;
                        if($dr == NULL || $dr == ""){
                            $range = "";
                        }else{
                            $range = $dr."Days";
                        }
                        
                        $loc = $data->lokasi;
                        $coor = $data->nama_kordinator;

                        /*
                        $sdep = $this->db->query("select nama_departemen from departemen where id IN($loc)");
                        $dep = "";
                        foreach($sdep->result() as $data){
                            $dep .= $data->nama_departemen."|";
                        }
                        */
                        $scat = $this->db->query("select nama_kategori from kategori where id IN($kategori)");
                        $cat = "";
                        foreach($scat->result() as $data){
                            $cat .= $data->nama_kategori.",";
                        }
                        echo '
                        <tr>
                            <td>'.$no.'</td>
                            <td>'.$nm_project.'</td>
                            <td>'.$cat.'</td>
                            <td>'.$tujuan.'</td>
                            <td>'.$start.'</td>
                            <td>'.$end.'</td>
                            <td>'.$range.'</td>
                            <td>'.$loc.'</td>
                            <td>'.$coor.'</td>
                        </tr>';
        
                        $no++;
                    }
                }    
            ?>
        </tbody>
    </table>
</div>