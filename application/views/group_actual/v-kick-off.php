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
                                        All Project
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

                                <div class="table-responsive">

                                    <table id="pro_tab" class="table table-stripped" style="text-align:center;">
                                        <thead>
                                            <th>No</th>
                                            <th>Project</th>
                                            <th>Est. Start</th>
                                            <th>Est. End</th>
                                            <th>Est. Priority</th>
                                            <th>Est Budget</th>
                                            <th>Status</th>
                                        </thead>
                                        <tbody id="all_project">

                                        </tbody>
                                    </table>

                                </div>

                            </div>

                    </div>

                </div> <!--Panel Group-->

                <!-- Modal -->

                <div class="modal fade" id="modal_project" tabindex="-1" role="dialog" aria-labelledby="modal_todo" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal_todo">Todo List</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            
                            <form action="<?php echo base_url();?>c_kick_off/update_status" method="post">

                                <div class="modal-body">

                                <input type="text" class="form-control" name="id_project" id="id_project">

                                    <div class="row">
                                        <div class="col-lg-6 md-form">
                                            <select name="sp" id="sp" class="mdb-select md-form colorful-select dropdown-primary" required>
                                            <?php
                                            $query = $this->db->query("select * from status_project");
                                            echo '
                                            <option value="" disabled selected>Status</option>
                                            ';
                                            foreach($query->result() as $data){
                                                echo '
                                                <option value="'.$data->id.'">'.$data->nama_status.'</option>
                                                ';
                                            }
                                            ?>
                                            </select>
                                        </div>  
                                        <div class="col-lg-6 md-form" style="margin-top:48px;">
                                            <input type="text" name="date_update" id="date_update" class="form-control datepicker pointer" required>
                                            <label for="date_update" class="iser">Date Update</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
                

                <!-- Modal -->
                <div class="modal fade" id="mf_est" tabindex="-1" role="dialog" aria-labelledby="mf_est" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mf_est">Finish Estimasi Task 
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form name="myForm" method="post" action="<?php echo base_url();?>c_task/finish_estimasi">

                            <div class="modal-body">

                                    <input type="text" name="idp" id="idp" hidden>
                                    <p>Dengan mengklik save changes anda telah menyetujui bahwa project ini sudah siap untuk dikerjakan</p> 
                                    
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>

                            </form>

                        </div>
                    </div>
                </div>

                <!-- Modal cancel project -->
                <div class="modal fade" id="mc_pro" tabindex="-1" role="dialog" aria-labelledby="mf_est" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mcp">Cancel Project
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form name="myForm" method="post" action="<?php echo base_url();?>c_task/cancel_project">

                            <div class="modal-body">

                                    <input type="text" name="idcp" id="idcp" hidden>
                                    <p>Dengan mengklik save changes anda telah menyetujui bahwa project ini akan dibatalkan !</p> 
                                    
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>

                            </form>

                        </div>
                    </div>
                </div>

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
        //var id_project = $("#id_project").val();
        $.ajax({  
            url: "<?php echo base_url(); ?>" + "c_task/kick_off_tbl",
            method:"POST",
            data:{},             
                success:function(data){
                    $(function () {
                        $('[data-toggle="tooltip"]').tooltip()
                    })
                    //console.log(data);
                    $("#all_project").html(data); 
                    $('#pro_tab').DataTable();
                    $('.dataTables_length').addClass('bs-select');   
                    
                    //console.log(data);
                }
        });

        document.getElementById("page").innerHTML = "<a href='<?php echo base_url();?>c_kick_off/index'>All Project</a>";
    })

    $(window).on('shown.bs.modal', function() { 
            //$('#detail_material').modal('show');
            //alert("ok");
            var id_project = $("#id_project").val();

            $.ajax({  
                url: "<?php echo base_url(); ?>" + "c_kick_off/fetch_project",
                method:"POST",
                data:{id_project:id_project},             
                    success:function(data){
                        console.log(data);
                        for (var i in data){
                            $("#sp").val(data[0].status).trigger("change");
                            //$("#det").val(data[0].detail).trigger("change");
                        }
                    }
            });
        });

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