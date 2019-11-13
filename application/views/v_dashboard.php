<body class="fixed-sn black-skin">
    <!--Main layout-->
    <main>
        <div class="container-fluid">
            <!--Section: Intro-->

            <div style="height: 5px"></div>
            <!--Section: Main panel-->
            <section class="mb-5">
                <!--Card-->
                <div class="card card-cascade narrower">
					
                    <div class="card-header white-text info-color">
                        Dashboard
                    </div>

                        <div class="card-body">

                            <div align="center">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert" id="notif"></div>
                            </div>

                            <div class="row">

                                <div class="col-lg-6">
                                    <table class="table table-striped" id="tbl_start">
                                        <thead>
                                            <tr>
                                                <th colspan="3" class="white-text info-color">Todolist Estimate Start Today</th>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="need_start">

                                        </tbody>
                                        
                                    </table>
                                </div>

                                <div class="col-lg-6">
                                    <table class="table table-striped" id="tbl_finish">
                                        <thead>
                                            <tr>
                                                <th colspan="3" class="white-text danger-color">Todolist Estimate Finish Today</th>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="need_finish">

                                        </tbody>
                                        
                                    </table>
                                </div>
                                
                                <div class="col-lg-12">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th colspan="3" class="info-color white-text">Complete Project Not Yet Rated</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-lg-12 md-form">
                                    <div class="row" id="project_end">
                                    
                                    </div>
                                </div>

                            </div>

                        </div>
					
                </div>	



                <!-- Modal Start-->
                <div class="modal fade" id="upd_stt" tabindex="-1" role="dialog" aria-labelledby="upd_stt" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <input type="text" id="tah" hidden>
                                <h5 class="modal-title" id="upd_stt2">
                                Update Task
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form action="<?php echo base_url();?>dashboardcontroller/todo_status" method="post">

                                <div class="modal-body">

                                    <div class="row">

                                        <input type="text" class="fom-control" id="id_todo" name="id_todo" hidden>
                                        <input type="text" class="form-control" id="sof" name="sof" hidden>

                                        <div class="col-lg-12 md-form">

                                            <div align="center">
                                                <input type="text" name="date_todo" id="date_todo" class="form-control datepicker pointer" required>
                                                <label for="date_todo" class="iser">Date Update</label>
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

            </section>

        </div>    
                    <!--Section: Chart-->
    </main>
    <!--Main layout-->
    <!--Footer-->
    <footer class="page-footer pt-0 mt-5 rgba-stylish-light">

        <!--Copyright-->
        <div class="footer-copyright py-3 text-center">
              <div class="container-fluid">
                 © 2018 Copyright: <a href="#" target="_blank"> MDBootstrap.com </a>

            </div>
        </div>
        <!--/.Copyright-->

    </footer>
    <!--/.Footer-->
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
	<script type="text/javascript" src="<?php echo base_url(); ?>dttable/js/datatables.min.js"></script>
    <!--Initializations-->
    <script>
          $(document).ready(function(){
            document.getElementById("page").innerHTML = "Dashboard";
            $.ajax({  
                url: "<?php echo base_url(); ?>" + "dashboardcontroller/task_today",
                method:"POST",
                data:{},             
                    success:function(data){    
                        $("#notif").html(data);
                        $(".alert").alert();
                    }
            });

            //fungsi mengilangkan popover ketika klik di body html
            $('body').on('click', function (e) {
                $('[data-toggle="popover"]').each(function () {
                    //the 'is' for buttons that trigger popups
                    //the 'has' for icons within a button that triggers a popup
                    if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                        $(this).popover('hide');
                    }
                });
            });

            $.ajax({  
                url: "<?php echo base_url(); ?>" + "dashboardcontroller/todo_today",
                method:"POST",
                data:{},             
                    success:function(data){  
                        $(function () {
                            $('[data-toggle="tooltip"]').tooltip()
                        })  
                        $("#need_start").html(data);
                        $('#tbl_start').DataTable();
                        $('.dataTables_length').addClass('bs-select');  
                    }
            });

            $.ajax({  
                url: "<?php echo base_url(); ?>" + "dashboardcontroller/todo_today2",
                method:"POST",
                data:{},             
                    success:function(data){  
                        $(function () {
                            $('[data-toggle="tooltip"]').tooltip()
                        })  
                        $("#need_finish").html(data);
                        $('#tbl_finish').DataTable();
                        $('.dataTables_length').addClass('bs-select');  
                    }
            });

            $.ajax({  
                url: "<?php echo base_url(); ?>" + "dashboardcontroller/com_pro",
                method:"POST",
                data:{},             
                    success:function(data){  
                        $("#project_end").html(data); 
                    }
            });
            
          })
    </script>
</body>