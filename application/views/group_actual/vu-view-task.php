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
                                            All Task
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
                                
                                <input type="text" value="<?php echo $id_project; ?>" name="id_project" id="id_project" hidden>
                                
                                <div class="card-body">

                                    <div class="table-responsive">

                                        <table id="v_task" class="table table-stripped center">
                                            <thead>
                                                <th>No</th>
                                                <th>Action</th>
                                                <th>Task</th>
                                                <th>Start</th>
                                                <th>End</th>
                                                <th>PIC</th>
                                                <th>Bobot</th>
                                                
                                            </thead>
                                            <tbody id="tbl_v_task">
                                            
                                            </tbody>
                                        </table>

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
            var id_project = $("#id_project").val();
            $.ajax({  
                url: "<?php echo base_url(); ?>" + "c_kick_off/vu_task_page",
                method:"POST",
                data:{id_project:id_project},             
                    success:function(data){
                        $(function () {
                            $('[data-toggle="tooltip"]').tooltip()
                        })
                        //console.log(data);
                        $("#tbl_v_task").html(data); 
                        $('#v_task').DataTable();
                        $('.dataTables_length').addClass('bs-select');   
                        
                        //console.log(data);
                    }
            });

            document.getElementById("page").innerHTML = "<a href='<?php echo base_url();?>c_kick_off/page_update_task'>All Project</a> || <a>View Task</a>";
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