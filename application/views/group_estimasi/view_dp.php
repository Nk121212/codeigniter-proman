<body class="fixed-sn black-skin">
<!--Main layout-->
<main>
    <div class="container-fluid">
        <!--Section: Intro-->

        <div style="height: 5px"></div>
        <!--Section: Main panel-->
            <section class="mb-5">

                <div class="panel-group">
                    <div class="card-header white-text info-color">

                        <div class="panel-heading in">
                            <div class="row">

                                <div class="col-lg-6 md-form">
                                    <a class="btn btn-outline btn-rounded">
                                        Detail Project
                                    </a>
                                </div>

                                <div class="col-lg-6 md-form" id="add_p" align="right" style="font-size: large;" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="true" aria-controls="collapseExample2">
                                    <a class="btn btn-outline btn-rounded">
                                        <i id="add_pi" class="fa fa-toggle-on slide-toggle" id="toggle"></i>
                                    </a>
                                </div>

                            </div>
                        </div>

                    </div>
                    
                    <div class="card collapse show" id="collapseExample2">
                            
                            <div class="card-body">

                                <div class="col-lg-12">
                                    <div class="row">

                                    <a href="<?php echo base_url();?>c_edit/edit_page/<?php echo $id_project;?>" class="btn btn-warning"><i class="fa fa-refresh"></i> Edit Purpose</a>

                                        <div class="col-lg-12">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th colspan="4">Project Detail</th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                $q_prodet = $this->db->query("
                                                select a.nama_project,a.kategori,a.purpose,a.est_mulai,a.est_selesai,a.est_hari,
                                                a.kordinator,a.complexity,a.lokasi,a.resource,a.attachment,b.nama_kategori 
                                                from project as a 
                                                left join kategori as b on b.id = a.kategori
                                                where a.id = '$id_project'
                                                ");
                                                
                                                $project = $q_prodet->row()->nama_project;
                                                $kategori = $q_prodet->row()->kategori;
                                                $purpose = $q_prodet->row()->purpose;
                                                $est_mulai = date("d M Y",strtotime($q_prodet->row()->est_mulai));
                                                $est_selesai = date("d M Y",strtotime($q_prodet->row()->est_selesai));
                                                $est_hari = $q_prodet->row()->est_hari;
                                                $kordinator = $q_prodet->row()->kordinator;
                                                $complexity = $q_prodet->row()->complexity;
                                                $lokasi = $q_prodet->row()->lokasi;
                                                $resource = $q_prodet->row()->resource;
                                                if($resource == 1){
                                                    $res = "Internal";
                                                }elseif($resource == 2){
                                                    $res = "External";
                                                }elseif($resource == 3){
                                                    $res = "Internal & External";
                                                }else{
                                                    $res = "No Resource";
                                                }
                                                $attachment = $q_prodet->row()->attachment;

                                                $cari_kat = $this->db->query("
                                                select nama_kategori as nk from kategori where id IN($kategori)
                                                ");
                                                $nmk = "";
                                                foreach($cari_kat->result() as $data){
                                                    $nmk .= $data->nk.', ';
                                                }
                                                $cari_comp = $this->db->query("
                                                select nama_complex from complexity where id IN($complexity)
                                                ");
                                                $nmc = "";
                                                foreach($cari_comp->result() as $com){
                                                    $nmc .= $com->nama_complex.", ";
                                                }
                                                ?>
                                                <tbody>
                                                    <tr>
                                                        <td colspan="2" style="text-align:center;">
                                                            <img src="<?php echo base_url(); ?><?php echo $attachment;?>" alt="No Image" height="120" width ="120">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Project</td>
                                                        <td><?php echo $project; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Category</td>
                                                        <td><?php echo $str = trim($nmk, ", "); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Purpose</td>
                                                        <td style="width:100%;max-width:100;">
                                                            <?php echo $purpose; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Schedule</td>
                                                        <td>
                                                            <?php 
                                                                if($q_prodet->row()->est_mulai == "" || $q_prodet->row()->est_mulai == "0000-00-00"){
                                                                    echo $mli = 'Todo still empty';
                                                                }else{
                                                                    $mli = $est_mulai;
                                                                    echo $mli." - ";
                                                                }  
                                                                
                                                                if($q_prodet->row()->est_selesai == "" || $q_prodet->row()->est_selesai == "0000-00-00"){
                                                                    //echo $slsi = 'Todo still empty';
                                                                }else{
                                                                    $slsi = $est_selesai;
                                                                    echo $slsi." [$est_hari Days]";
                                                                }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Location</td>
                                                        <td><?php echo $lokasi; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Complexity</td>
                                                        <td><?php echo $str = trim($nmc, ", "); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Resource</td>
                                                        <td><?php echo $res; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="col-lg-12">
                                            <h5>Data Task</h5>
                                            <div class="table-responsive">
                                                <table id="dt_task" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Task</th>
                                                            <th>Plan Start</th>
                                                            <th>Plan End</th>
                                                            <th>Duration</th>
                                                            <th>Res. Internal</th>
                                                            <th>Res. External</th>
                                                            <th>PIC</th>
                                                            <th>Bobot</th>
                                                            <th>Image</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $q_task = $this->db->query("
                                                            select a.*,b.nama_departemen as res_int, c.nama as kordinator 
                                                            from task as a 
                                                            left join departemen as b on b.id = a.est_res_internal
                                                            left join coordinator as c on a.est_pic = c.id
                                                            where a.id_project = '$id_project'
                                                            order by a.est_start asc
                                                        ");
                                                        
                                                        $no = 1;
                                                        foreach($q_task->result() as $data){
                                                            $d_ext = $data->est_res_external;
                                                            if($d_ext == NULL){
                                                                $external = '';
                                                            }else{
                                                                $external = $d_ext;
                                                            }
                                                            if($data->est_start == NULL || $data->est_start == ""){
                                                                $ests = "";
                                                            }else{
                                                                $ests = date("d M Y",strtotime($data->est_start));
                                                            }
                                                            if($data->est_end == NULL || $data->est_end == ""){
                                                                $estf = "";
                                                            }else{
                                                                $estf = date("d M Y",strtotime($data->est_end));
                                                            }
                                                            echo '
                                                            <tr>
                                                                <td>'.$no.'</td>
                                                                <td>'.$data->nama_task.'</td>
                                                                <td>'.$ests.'</td>
                                                                <td>'.$estf.'</td>
                                                                <td>'.$data->est_days.' Days</td>
                                                                <td>'.$data->res_int.'</td>
                                                                <td>'.$external.'</td>
                                                                <td>'.$data->kordinator.'</td>
                                                                <td>'.$data->est_bobot.' %</td>
                                                                <td>
                                                                    <img src="'.base_url().''.$data->est_attachment.'" height="100" width="100" alt="No Image">
                                                                </td>
                                                            </tr>
                                                            ';
                                                            $no ++;
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6" style="margin-top:20px;">
                                            <h5>Data Material</h5>
                                            <div class="table-responsive">
                                                <table id="dt_material" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Material</th>
                                                            <th>Satuan</th>
                                                            <th>Jumlah</th>
                                                            <th>Harga</th>
                                                            <th>Total Harga</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $q_idtask = $this->db->query("
                                                        select group_concat(id separator ',') as id_task 
                                                        from task where id_project = '$id_project'
                                                    ");
                                                    $id_task = $q_idtask->row()->id_task;

                                                    $q_material = $this->db->query("
                                                        select a.nama_material,a.satuan,a.est_jumlah,a.est_harga,a.est_total_harga,b.nama_satuan 
                                                        from material a
                                                        inner join satuan b on a.satuan = b.id
                                                        where id_task IN($id_task)
                                                        order by a.nama_material asc
                                                    ");
                                                    $no = 1;
                                                    //$budget = 0;
                                                    foreach($q_material->result() as $data){
                                                        echo '
                                                        <tr>
                                                            <td>'.$no.'</td>
                                                            <td>'.$data->nama_material.'</td>
                                                            <td>'.$data->nama_satuan.'</td>
                                                            <td>'.$data->est_jumlah.'</td>
                                                            <td>'.number_format($data->est_harga,0,',','.').'</td>
                                                            <td>'.number_format($data->est_total_harga,0,',','.').'</td>
                                                        </tr>
                                                            ';
                                                        $no++;
                                                    }
                                                    $q_sum = $this->db->query("
                                                        select sum(est_total_harga) as grand_total from material 
                                                        where id_task IN($id_task)
                                                    ");
                                                    echo '
                                                    <tr>
                                                    <td>'.$no.'</td>
                                                    <td style="border-right:1px solid white;"></td>
                                                    <td style="border-right:1px solid white;"></td>
                                                    <td style="border-right:1px solid white;"></td>
                                                    <td><b>Grand Total</b></td>
                                                    <td><b>'.number_format($q_sum->row()->grand_total,0,',','.').'</b></td>
                                                    </tr>
                                                    ';

                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-lg-6" style="margin-top:20px;">
                                            <h5>Data Todo</h5>
                                            <div class="table-responsive">
                                                <table id="dt_todo" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Todo</th>
                                                            <th>Plan Start</th>
                                                            <th>Plan End</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $q_todo = $this->db->query("
                                                            select * from todo where id_task IN($id_task)
                                                            order by est_start asc
                                                        ");
                                                        $no = 1;
                                                        foreach($q_todo->result() as $data){
                                                            if($data->est_start == NULL || $data->est_start == "" || $data->est_start == "0000-00-00"){
                                                                $tests = "";
                                                            }else{
                                                                $tests = date("d M Y",strtotime($data->est_start));
                                                            }
                                                            if($data->est_finish == NULL || $data->est_finish == "" || $data->est_finish == "0000-00-00"){
                                                                $tesf = "";
                                                            }else{
                                                                $tesf = date("d M Y", strtotime($data->est_finish));
                                                            }
                                                            echo '
                                                            <tr>
                                                                <td>'.$no.'</td>
                                                                <td>'.$data->to_do.'</td>
                                                                <td>'.$tests.'</td>
                                                                <td>'.$tesf.'</td>
                                                            </tr>
                                                            ';
                                                            $no++;
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                    </div>

                </div> <!--Panel Group-->

            </section>

        </div>

    </div>

</main>
<!--Main layout-->
<!-- SCRIPTS -->
<!-- JQuery -->
<script src="<?php echo base_url();?>plugin/template/js/jquery-3.3.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="<?php echo base_url();?>plugin/template/js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="<?php echo base_url();?>plugin/template/js/bootstrap.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>daterangepicker/daterangepicker.min.js"></script>

<!-- MDB core JavaScript -->
<script type="text/javascript" src="<?php echo base_url();?>plugin/template/js/mdb.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>daterangepicker/initial.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/mdb_init.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>dttable/js/datatables.min.js"></script>
<!--Initializations-->
<script>
    $(document).ready(function(){
        $('#dt_task').DataTable();
        $('.dataTables_length').addClass('bs-select');

        $('#dt_material').DataTable();
        $('.dataTables_length').addClass('bs-select');

        $('#dt_todo').DataTable();
        $('.dataTables_length').addClass('bs-select');
        document.getElementById("page").innerHTML = "<a href='<?php echo base_url();?>c_kick_off/index'>All Project</a> || <a href='#'>View Data Project</a>";
    })


    $("#add_p").click(function(){ 
        if ($("#add_pi").hasClass('fa fa-toggle-on')) {
            $("#add_pi").removeClass('fa fa-toggle-on');
            $("#add_pi").addClass('fa fa-toggle-off'); 
        }else{
            $("#add_pi").removeClass('fa fa-toggle-off');
            $("#add_pi").addClass('fa fa-toggle-on');  
        }
    });
</script>

</body>