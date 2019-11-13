<?php
    $q_project = $this->db->query("
    select a.*, b.nama from project a left join coordinator b on a.kordinator = b.id where a.id = '$id_project'
    "); 
    $nm_project = $q_project->row()->nama_project;
    $pro_img = $q_project->row()->attachment;
    $est_start = $q_project->row()->est_mulai;
    $est_selesai = $q_project->row()->est_selesai;
    $location = $q_project->row()->lokasi;
    $est_budget = $q_project->row()->est_budget;
    $res = $q_project->row()->resource;
    if($res == 1){
        $resource = 'INTERNAL';
    }elseif($res == 2){
        $resource = 'EXTERNAL';
    }elseif($res == 3){
        $resource = 'INTERNAL & EXTERNAL';
    }
    $est_prioritas = $q_project->row()->est_prioritas;
    $kordinator = $q_project->row()->nama;
    $purpose = $q_project->row()->purpose;
?>
<html>
    <head>
        <title>Get Proposal</title>
    </head>

    <style>
    .page_break { page-break-before: always; text-align:center;}
    .page_break2 { page-break-after: always; text-align:center;}

    .example-one {
        background-color:white;
        opacity:0.5;
    }
    table, td, th {  
        border: 1px solid #ddd;
        text-align: left;
        border:1px solid #dedede;
        padding: 1rem;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }
    div{
        width:100%;
    }
    .tbl_project{
        background-color:#408711;
        color:white;
    }
    </style>

    <body>

        <div align="right" style="background-color:#e2dcd9;">
            <img src="<?php echo base_url();?>image/proposal/logo.png" alt="No Image" height="100" width="100">
        </div>
        
        <div align="right" style="height:100px;"></div>

        <div align="right"></div>

        <div align="right" >
            <h3>PT. SIPATEX PUTRI LESTARI</h3>
        </div>

        <div align="right" >
            <h4><?php echo date("d M Y"); ?></h4>
        </div>

        <div align="right" style="border-top:5px solid black;height:50px;"></div>

        <div align="center" >
            <h1>PROJECT PROPOSAL</h1>
        </div>

        <div align="center" >
            <h2><?php echo $nm_project;?></h2>
        </div>

        <div class="example-one" align="center" >
            <img src="<?php echo base_url(); echo $pro_img;?>" alt="No Image" height="250" width="250">
        </div>

        <div align="left" >
            <h2 style="font-weight:bold;color:white;">
            asasas
            </h2>
        </div>
        
        <div align="left" >
            <h2 style="font-weight:bold;">PREPARED BY</h2>
        </div>

        <div align="left" >
            <h3 style="font-weight:bold;">ENGINEERING</h3>
        </div>


        <div class="page_break2">
            <table>

                <thead>
                    <tr>
                        <th style="text-align:center;">
                            <img class="example-one" src="<?php echo base_url(); echo $pro_img;?>" alt="No Image" height="125" width="125">
                        </th>
                        <th style="text-align:center;" class="tbl_project" colspan="3"><?php echo $q_project->row()->nama_project;?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="tbl_project">
                        <td>Plan Date</td>
                        <td><?php echo date("d M Y",strtotime($est_start));?> - <?php echo date("d M Y",strtotime($est_selesai));?></td>
                        <td>Location</td>
                        <td><?php echo $location;?></td>
                    </tr>
                    <tr class="tbl_project">
                        <td>Budget</td>
                        <td>Rp. <?php echo number_format($est_budget,0,',','.');?></td>
                        <td>Resource</td>
                        <td><?php echo $resource;?></td>
                    </tr>
                    <tr class="tbl_project">
                        <td>Priority</td>
                        <td><?php echo $est_prioritas;?></td>
                        <td>Coordinator</td>
                        <td><?php echo $kordinator;?></td>
                    </tr>
                </tbody>
                
            </table>

            <h3>Purpose :</h3>
            <div style="border:1px 1px 1px 1px solid black;">
                <?php echo $purpose;?>
            </div>
        </div>
        
        <div class="page_break2">
            <?php
            $ridt = $this->db->query("
            select id from task where id_project = '$id_project'
            ");
            if($ridt->num_rows() < 1 || $ridt->num_rows() == NULL || $ridt->num_rows() == ""){
                echo '
                <table>
                    <thead>
                    <tr>
                        <th colspan="3" style="background-color:red;color:white;">Add Task To View Task !</th>
                    </tr>
                </thead>
                <tbody>
                ';
            }else{
                //echo 'Ada Task';
                $no=1;
                foreach($ridt->result() as $data){
                    $id_task = $data->id;
                
                    $ttd = $this->db->query("
                    select nama_task,bobot,attachment,est_bobot from task where id = $id_task
                    ");
                    foreach($ttd->result() as $todo){
                        $attach_task = $todo->attachment;
                        $nm_task = $todo->nama_task;
                        $est_bobot = $todo->est_bobot;
        
                        $q_todo = $this->db->query("
                        select to_do from todo where id_task = '$id_task'
                        ");
                        $b = 0;
                        foreach($q_todo->result() as $td){
                            $a = $this->db->query("
                            select count(id)+1 as id_todo from todo where id_task = '$id_task'
                            ");
                            $b = $a->row()->id_todo;
                        }
                        
                        echo '
                        <table>
                            <thead>
                            <tr>
                                <th style="text-align:center;">
                                    <img class="example-one" src="'.$attach_task.'" alt="No Image" height="125" width="125">
                                </th>
                                <th>Task_'.$no.'. '.$nm_task.'</th>
                                <th style="text-align:right;border-left:solid white;">'.$est_bobot.' %</th>
                            </tr>
                        </thead>
                        <tbody>
                        ';
                        
                        foreach($q_todo->result() as $rec_todo){
                            echo '
                            <tr>
                                <td colspan="3" style="text-align:center;">'.$rec_todo->to_do.'</td>
                            </tr> 
                            ';
                        }
                        echo '
                            </tbody>
                        </table>
                        ';    
                        $no++;    
                    }
                }
            }
            ?>
        </div>

        <div class="page_break2">
            <table>
                <thead>
                    <tr>
                        <th colspan="6">MATERIAL</th>
                    </tr>
                    <tr>
                        <th>No</th>
                        <th>Material</th>
                        <th>Unit</th>
                        <th>QTY</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $q_cc_idt = $this->db->query("
                select group_concat(id separator ',') as idt from task where id_project = '$id_project'
                ");

                    $idt_concat = $q_cc_idt->row()->idt;
                    if($idt_concat == "()" || $idt_concat == NULL || $idt_concat == ""){
                        echo '
                        <tr>
                        <td colspan="6" style="background-color:red;color:white;">Add Material First To View Material !</td>
                        </tr>
                        ';
                    }else{
                        $q_mat = $this->db->query("
                        select a.*, b.nama_satuan from material a left join satuan b on a.satuan = b.id where a.id_task IN($idt_concat)
                        ");
                        $qgt = $this->db->query("
                        select sum(est_total_harga) as gt from material where id_task IN($idt_concat)
                        ");
                        $grand_total = $qgt->row()->gt;
                        $no_m = 1;
                        foreach($q_mat->result() as $dt_mat){
                            echo '
                            <tr>
                                <td>'.$no_m.'</td>
                                <td>'.$dt_mat->nama_material.'</td>
                                <td>'.$dt_mat->nama_satuan.'</td>
                                <td>'.$dt_mat->est_jumlah.'</td>
                                <td>Rp. '.number_format($dt_mat->est_harga,0,',','.').'</td>
                                <td>Rp. '.number_format($dt_mat->est_total_harga,0,',','.').'</td>
                            </tr>
                            ';
                            $no_m++;
                        }
                        echo '
                        <tr>
                            <td style="border:1px 1px 1px 1px solid white;"></td>
                            <td style="border:1px 1px 1px 1px solid white;"></td>
                            <td style="border:1px 1px 1px 1px solid white;"></td>
                            <td style="border-bottom: 1px solid white;"></td>
                            <td>Grand Total</td>
                            <td>Rp. '.number_format($grand_total,0,',','.').'</td>
                        </tr>
                        ';
                    }   
                ?>
                </tbody>
            

            </table>
        </div>

        <div align="center">
            <h3 style="background-color:#64b5f6;height:30px;text-align:center;color:white;">Approval</h3>

            <table border="0" style="border-bottom:1px solid black;">
                
                    <?php

                        $a1 = substr_count($dibuat,",");
                        $a2 = ($a1+1);
                        $a3 = explode(",",$dibuat);

                        $b1 = substr_count($diketahui,",");
                        $b2 = ($b1+1);
                        $b3 = explode(",",$diketahui);

                        $c1 = substr_count($menyetujui,",");
                        $c2 = ($c1+1);
                        $c3 = explode(",",$menyetujui);

                        if($a2 == 1 || $a2 == 2){
                            $ttl_cp1 = 4;
                        }else{
                            $ttl_cp1 = 6;
                        }

                        if($b2 == 1 || $b2 == 2){
                            $ttl_cp2 = 4;
                        }else{
                            $ttl_cp2 = 6;
                        }

                        if($c2 == 1 || $c2 == 2){
                            $ttl_cp3 = 4;
                        }else{
                            $ttl_cp3 = 6;
                        }
                    ?>
                    <tr>
                        <th style="text-align:center;" colspan="<?php echo $ttl_cp1; ?>">Created By</th>
                        <th style="text-align:center;" colspan="<?php echo $ttl_cp2;?>">Knowledge By</th>
                    </tr>
                    <tr>
                        <td style="text-align:left;"></td>
                        <td style="text-align:right;"></td>
                        <td style="text-align:left;"></td>
                        <td style="text-align:right;"></td>
                        <td style="text-align:left;"></td>
                        <td style="text-align:right;"></td>
                        <td style="text-align:left;"></td>
                        <td style="text-align:right;"></td>
                    </tr>
                    <tr>
                        <td style="text-align:left;"></td>
                        <td style="text-align:right;"></td>
                        <td style="text-align:left;"></td>
                        <td style="text-align:right;"></td>
                        <td style="text-align:left;"></td>
                        <td style="text-align:right;"></td>
                        <td style="text-align:left;"></td>
                        <td style="text-align:right;"></td>
                    </tr>
                    <tr>
                        <td style="text-align:left;"></td>
                        <td style="text-align:right;"></td>
                        <td style="text-align:left;"></td>
                        <td style="text-align:right;"></td>
                        <td style="text-align:left;"></td>
                        <td style="text-align:right;"></td>
                        <td style="text-align:left;"></td>
                        <td style="text-align:right;"></td>
                    </tr>
                    <tr>
                        <td style="text-align:left;"></td>
                        <td style="text-align:right;"></td>
                        <td style="text-align:left;"></td>
                        <td style="text-align:right;"></td>
                        <td style="text-align:left;"></td>
                        <td style="text-align:right;"></td>
                        <td style="text-align:left;"></td>
                        <td style="text-align:right;"></td>
                    </tr>
    
                    <!--Dibuat dan diketahui-->
                    <tr style="border-left:1px solid black;">
                        <?php
                            if($a2 == 1){

                                for($i=0;$i<$a2;$i++){

                                    $a4 = $a3[$i];

                                    echo '
                                        <td style="text-align:center;" colspan="4">[ '.$a4.' ]</td>
                                    ';

                                }

                            }elseif($a2 == 2){

                                for($i=0;$i<$a2;$i++){

                                    $a4 = $a3[$i];

                                    echo '
                                        <td style="text-align:center" colspan="2">[ '.$a4.' ]</td>
                                    ';
                                }

                            }elseif($a2 == 3){

                                for($i=0;$i<$a2;$i++){

                                    $a4 = $a3[$i];

                                    echo '
                                        <td style="text-align:center" colspan="6">[ '.$a4.' ]</td>
                                    ';
                                }

                            }else{
                                echo '
                                    <td style="text-align:center;" colspan="4">Maksimal Pembuat 3 Orang</td>
                                ';
                            }
                            
                            if($b2 == 1){
                                
                                for($i=0;$i<$b2;$i++){

                                    $b4 = $b3[$i];

                                    echo '
                                        <td style="text-align:center;" colspan="4">[ '.$b4.' ]</td>
                                    ';

                                }

                            }elseif($b2 == 2){

                                for($i=0;$i<$b2;$i++){

                                    $b4 = $b3[$i];

                                    echo '
                                        <td style="text-align:center" colspan="2">[ '.$b4.' ]</td>
                                    ';
                                }

                            }elseif($b2 == 3){

                                for($i=0;$i<$b2;$i++){

                                    $b4 = $b3[$i];

                                    echo '
                                        <td style="text-align:center;" colspan="2">[ '.$b4.' ]</td>
                                    ';
                                }

                            }else{
                                echo '
                                    <td style="text-align:center;" colspan="6">Maksimal Mengetahui 3 Orang</td>
                                ';
                            }
                        ?>
                    <!--Dibuat dan diketahui-->
                    </tr>

            </table>

            <table border="0" style="border-bottom:1px solid black;">
                <tr>
                    <th style="text-align:center;" colspan="<?php echo $ttl_cp3;?>">Approved By</th>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <?php 
                        //echo $ttl_cp3;
                        if($c2 == 1){
                            
                            for($i=0;$i<$c2;$i++){

                                $c4 = $c3[$i];

                                echo '
                                    <td style="text-align:center;" colspan="4">[ '.$c4.' ]</td>
                                ';

                            }

                        }elseif($c2 == 2){

                            for($i=0;$i<$c2;$i++){

                                $c4 = $c3[$i];

                                echo '
                                    <td style="text-align:center" colspan="2">[ '.$c4.' ]</td>
                                ';
                            }

                        }elseif($c2 == 3){

                            for($i=0;$i<$c2;$i++){

                                $c4 = $c3[$i];

                                echo '
                                    <td style="text-align:center" colspan="2">[ '.$c4.' ]</td>
                                ';
                            }

                        }else{
                            echo '
                                <td style="text-align:center;" colspan="6">Maksimal Approval 3 Orang</td>
                            ';
                        }
                    ?>
                </tr>
            </table>
        </div>



    </body>

</html>