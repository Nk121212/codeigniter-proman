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
                                            Add Satuan
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

                                <form action="<?php echo base_url();?>c_master/add_satuan" method="post">

                                    <div class="row">
                                        <div class="col-lg-6 md-form">
                                            <input onkeyup="this.value = this.value.toUpperCase();" type="text" name="satuan" id="satuan" class="form-control" required>
                                            <label for="satuan" class="iser">Nama Satuan</label>
                                        </div>
                                        <div class="col-lg-6 md-form">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Save</button>
                                        </div>

                                    </div>

                                    

                                </form>

                            </div>
                            
                        </div>

                    </div> <!--Panel Group-->




                    <!-- Modal -->
                    <div class="modal fade" id="md_todo" tabindex="-1" role="dialog" aria-labelledby="md_todo" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="md_todo">Delete Todo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form action="<?php echo base_url();?>c_todolist/del_todo" method="post">
                                    <div class="modal-body">

                                        <input type="text" class="fom-control" id="idto" name="idto" hidden>

                                        <div class="row">

                                        </div>
                                        
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                                        <button data-toggle="tooltip" data-title="Save To do" type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Delete</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>



                    <!-- Modal Start-->
                    <div class="modal fade" id="modal_start" tabindex="-1" role="dialog" aria-labelledby="modal_start" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <input type="text" id="tah" hidden>
                                    <h5 class="modal-title" id="modal_start2">
                                    Update Task
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form name="myForm" onsubmit="return validateForm()" action="<?php echo base_url();?>c_todolist/status_todo" method="post">

                                    <div class="modal-body">

                                        <div class="row">

                                            <div class="col-lg-6 md-form">
                                                <p>Estimate Start : <b id="bold"></b></p>
                                            </div>
                                            <div class="col-lg-6 md-form">
                                                <p>Actual Start : <b id="bold2"></b></p>
                                            </div>

                                            <input type="text" class="fom-control" id="id_todo" name="id_todo" hidden>
                                            <input type="text" class="form-control" id="sof" name="sof" hidden>

                                            <div class="col-lg-12 md-form">

                                                <div align="center">
                                                    <input type="text" name="date_todo" id="date_todo" class="form-control datepicker pointer" required>
                                                    <label for="start_todo" class="iser">Date Update</label>
                                                </div>

                                            </div>

                                        </div>
                                        
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                                        <button data-toggle="tooltip" data-title="Save To do" type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Save Changes</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                    <!-- Modal add todo -->
                    <div class="modal fade" id="modal_todo" tabindex="-1" role="dialog" aria-labelledby="modal_todo" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal_todo">
                                    <?php
                                    $q_tn = $this->db->query("
                                    select nama_task from task where id= '$id_task'
                                    ");
                                    echo "Task ".$tn = $q_tn->row()->nama_task;
                                    ?>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form method="post" action="<?php echo base_url();?>c_todolist/add_todo">
                                    
                                    <div class="modal-body">

                                            <input type="text" value="<?php echo $id_task; ?>" name="id_task" id="id_task" hidden>
                                            <?php
                                                $cek_idp = $this->db->query("select id_project from task where id = '$id_task'");
                                                $rows = $cek_idp->row();
                                                $id_project = $rows->id_project;
                                            ?>
                                            <input type="text" value="<?php echo $id_project;?>" name="id_project" id="id_project" hidden>
                                            
                                            <div class="row">

                                                <div class="col-lg-12 md-form">
                                                    <input onkeyup="this.value = this.value.toUpperCase();" type="text" name="todo" id="todo" class="form-control" required>
                                                    <label for="todo" class="iser">To Do Name</label>
                                                </div>

                                            </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                                        <i class="fa fa-close"></i> Close
                                        </button>
                                        <button data-toggle="tooltip" data-title="Save To do" type="submit" class="btn btn-primary">
                                        <i class="fa fa-floppy-o"></i> Save Changes
                                        </button>
                                    </div>

                                </form> 

                            </div>
                        </div>
                    </div>


                    <!-- Modal add comment-->
                    <div class="modal fade" id="modal_comment" tabindex="-1" role="dialog" aria-labelledby="modal_comment" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal_comment">
                                    <?php
                                    $nmt = $this->db->query("
                                    select nama_task from task where id='$id_task'
                                    ");
                                    echo 'Task '.$nmt->row()->nama_task;
                                    ?> 
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form action="<?php echo base_url();?>c_todolist/add_comment" method="post">
                                    <div class="modal-body">

                                        <input type="text" class="fom-control" id="id_task" name="id_task" value="<?php echo $id_task;?>" hidden>

                                        <div class="col-lg-12 md-form">
                                            <textarea name="comment" id="comment" cols="87" rows="10"></textarea>
                                            <label for="comment" class="iser">Comment</label>                
                                        </div>      
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                                        <button data-toggle="tooltip" data-title="Save To do" type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Save</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>


                </section>

            </div>

        </div>

    </main>
    <!--Initializations-->
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
    <script>
        $(document).ready(function(){ 
            document.getElementById("page").innerHTML = "<a>Add Satuan</a>";
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