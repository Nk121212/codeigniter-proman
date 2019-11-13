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
                                    <a class="btn btn-outline btn-rounded" data-toggle="modal" data-target="#modal_faq">
                                        Add Task Project
                                        <?php 
                                        $query = $this->db->query("select id,nama_project from project where id = '$id_project'"); 
                                        echo $nm = $query->row()->nama_project;
                                        $id_project = $query->row()->id;
                                        ?>
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
                    <form action="<?php echo base_url();?>c_task/edit_task" method="post" enctype="multipart/form-data">

                        <div class="card collapse show" id="collapseExample2">
                                
                                <div class="card-body">

                                    <div class="row">
                                    <input type="text" name="idp" id="idp" value="<?php echo $id_project; ?>" hidden>
                                    <input type="text" name="id_task" id="id_task" value="<?php echo $id_task; ?>" hidden>

                                        <div class="col-lg-6 md-form" style="margin-top:48px;">
                                            <input type="text" name="task" id="task" class="form-control" required>
                                            <label for="task" class="iser">Task Name</label>
                                        </div>
                                        <div class="col-lg-6 md-form">
                                            <select name="pic" id="pic" class="mdb-select md-form colorful-select dropdown-primary" required>
                                            <?php
                                                $query3 = $this->db->query("select * from coordinator");
                                                echo '
                                                <option value="" disabled selected>PIC</option>
                                                ';
                                                foreach($query3->result() as $data){
                                                    echo '<option value="'.$data->id.'">'.$data->nama.'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-lg-12 card" style="margin-top:10px;">
                                            <div class="card-header white-text primary-color-dark">
                                                Resource
                                            </div>
                                            <!--/.Card-->
                                            <div class="card-body pt-0 px-1">
                                                <!--Card content-->
                                                <div class="card-body text-center">
                                                    
                                                    <div class="row">
                                                        
                                                    <?php 
                                                        $cek = $this->db->query("
                                                        select resource from project where id = '$id_project'
                                                        ");
                                                        $res = $cek->row()->resource;

                                                        $query = $this->db->query("select * from departemen");

                                                        if($res == 1){
                                                            echo '
                                                            <div class="col-lg-6 md-form">
                                                                <select name="res_internal" id="res_internal" class="mdb-select md-form colorful-select dropdown-primary" required>
                                                            
                                                                <option value="" disabled selected>Resource Internal</option>
                                                                <option value="-">-</option>
                                                            ';
                                                                foreach($query->result() as $data){
                                                            echo '
                                                                    <option value="'.$data->id.'">'.$data->nama_departemen.'</option>
                                                            ';
                                                                }
                                                            echo '
                                                                </select>
                                                            </div>
                                                            ';
                                                        }elseif($res == 2){
                                                            echo '
                                                            <div class="col-lg-6 md-form" style="margin-top:48px;">
                                                                <input type="text" name="res_external" id="res_external" class="form-control" required>
                                                                <label for="res_external" class="iser">Resource External</label>
                                                            </div>
                                                            ';
                                                        }elseif($res == 3){
                                                            echo '
                                                            <div class="col-lg-6 md-form">
                                                                <select name="res_internal" id="res_internal" class="mdb-select md-form colorful-select dropdown-primary" required>
                                                            
                                                                <option value="" disabled selected>Resource Internal</option>
                                                                <option value="-">-</option>
                                                            ';
                                                                foreach($query->result() as $data){
                                                            echo '
                                                                    <option value="'.$data->id.'">'.$data->nama_departemen.'</option>
                                                            ';
                                                                }
                                                            echo '
                                                                </select>
                                                            </div>
                                                            ';
                                                            echo '
                                                            <div class="col-lg-6 md-form" style="margin-top:48px;">
                                                                <input type="text" name="res_external" id="res_external" class="form-control" required>
                                                                <label for="res_external" class="iser">Resource External</label>
                                                            </div>
                                                            ';
                                                        }elseif($res == 0){
                                                            echo 'Please Choose Resource on Create Project';
                                                        }
                                                    ?>


                                                    </div>
                                                    
                                                </div>
                                                <!--/.Card content-->
                                            </div>
                                            <!--/.Card-->
                                        </div>

                                        <div class="col-lg-6 file-field" style="margin-top:48px;">
                                            <div class="btn btn-primary btn-sm float-left">
                                                <span><i class="fa fa-upload"></i>  Upload</span>
                                                <input type="file" class="file-upload" name="file" required>
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="form-control file-path validate" type="text" placeholder="Upload your file" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-12" style="margin-top:50px;">
                                            <div align="center">
                                                <button type="submit" class="btn btn-outline-primary"><i class="fa fa-floppy-o"></i> Save</button>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                        </div>
                    </form>

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

        var id_task = $("#id_task").val();

        $.ajax({  
            url: "<?php echo base_url(); ?>" + "c_task/detail_task",
            method:"POST",
            data:{id_task:id_task},             
                success:function(data){
                    console.log(data);
                    var task = data[0].task;
                    var pic = data[0].pic;
                    //var start = data[0].start;
                    //var end = data[0].end;
                    //var hours = data[0].hours;
                    //var days = data[0].days;
                    var rint = data[0].rint;
                    var rext = data[0].rext;
                    var upload = data[0].upload;

                    $("#task").val(task).trigger("change");
                    $("#pic").val(pic).trigger("change");
                    //$("#psc").val(start+" => "+end).trigger("change");
                    //$("#psc_awal").val(start).trigger("change");
                    //$("#psc_akhir").val(end).trigger("change");
                    //$("#phours").val(hours).trigger("change");
                    //$("#pdurations").val(days).trigger("change");
                    $("#res_internal").val(rint).trigger("change");
                    $("#res_external").val(rext).trigger("change");
                    $(".validate").val(upload).trigger("change");
                    //alert(data);
                }
        });

        document.getElementById("page").innerHTML = "<a href='<?php echo base_url();?>c_task/page_task_update2/<?php echo $id_project;?>'><i class='fa fa-arrow-left'></i> Go Back</a> || <a>Add Task</a>";
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

    $('input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        $('.file-path').val(fileName);
    });
</script>

</body>