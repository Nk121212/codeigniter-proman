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

                            <a href="<?php echo base_url();?>c_proposal/index" class="btn btn-sm btn-secondary"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Create Proposal</a>

                                <div class="table-responsive">

                                    <table id="pro_tab" class="table table-stripped" style="text-align:center;">
                                        <thead>
                                            <th>No</th>
                                            <th>Project</th>
                                            <th>Est Start</th>
                                            <th>Est Finish</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody id="all_project">

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
            url: "<?php echo base_url(); ?>" + "c_task/all_project",
            method:"POST",
            data:{id_project:id_project},             
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

        document.getElementById("page").innerHTML = "<a href='<?php echo base_url();?>c_task/index'>All Project</a>";
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