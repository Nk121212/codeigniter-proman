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
                                            View Project
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
                                <div class="row">
                                
                                    <ul class="nav" role="tablist">
                                        <li class="nav-item p-0 waves-effect">
                                            <button id="ip_all" class="btn btn-success" data-toggle="tab" role="tab" aria-controls="home" aria-selected="true">All Project</button>
                                        </li>
                                        <li class="nav-item p-0 waves-effect">
                                            <button id="ip_open" class="btn btn-success" data-toggle="tab" role="tab" aria-controls="profile" aria-selected="false">Open Project</a>
                                        </li>
                                        <li class="nav-item p-0 waves-effect">
                                            <button id="ip_close" class="btn btn-success" data-toggle="tab" role="tab" aria-controls="profile" aria-selected="false">Cancel Project</a>
                                        </li>
                                        <li class="nav-item p-0 waves-effect">
                                            <button id="ip_cancel" class="btn btn-success" data-toggle="tab" role="tab" aria-controls="profile" aria-selected="false">Close Project</a>
                                        </li>

                                    </ul>
                                </div> 



                            <div class="table-responsive" id="div_all">
                                    
                                    <div align="center">
                                        <h3>All Project</h3>
                                    </div>

                                    <div align="right">
                                        <a href="<?php echo base_url();?>c_report/pdf_report/all" target="_blank" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Create PDF</a>
                                        <a href="<?php echo base_url();?>c_report/xcl_all/all" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Create Excel</a>
                                    </div>
                                    
                                    <table class="table table-stripped" id="p_all">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Project</th>
                                                <th>Start</th>
                                                <th>End</th>
                                                <th>Rentang</th>
                                                <th>Add By</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="all_p">

                                        </tbody>
                                    </table>

                                </div>

                                <div class="table-responsive" id="div_open">
                                    
                                    <div align="center">
                                        <h3>Open Project</h3>
                                    </div>

                                    <div align="right">
                                        <a href="<?php echo base_url();?>c_report/pdf_report/2" target="_blank" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Create PDF</a>
                                        <a href="<?php echo base_url();?>c_report/xcl_all/2" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Create Excel</a>
                                    </div>
                                    
                                    <table class="table table-stripped" id="p_open">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Project</th>
                                                <th>Start</th>
                                                <th>End</th>
                                                <th>Rentang</th>
                                                <th>Add By</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="open_p">

                                        </tbody>
                                    </table>

                                </div>

                                <div class="table-responsive" id="div_close">

                                    <div align="center">
                                        <h3>Cancel Project</h3>
                                    </div>

                                    <div align="right">
                                        <a href="<?php echo base_url();?>c_report/pdf_report/3" target="_blank" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Create PDF</a>
                                        <a href="<?php echo base_url();?>c_report/xcl_all/3" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Create Excel</a>
                                    </div>

                                    <table class="table table-stripped" id="p_close">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Project</th>
                                                <th>Start</th>
                                                <th>End</th>
                                                <th>Rentang</th>
                                                <th>Add By</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="close_p">

                                        </tbody>
                                    </table>

                                </div>

                                <div class="table-responsive" id="div_cancel">
                                    
                                    <div align="center">
                                        <h3>Close Project</h3>
                                    </div>

                                    <div align="right">
                                        <a href="<?php echo base_url();?>c_report/pdf_report/4" target="_blank" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Create PDF</a>
                                        <a href="<?php echo base_url();?>c_report/xcl_all/4" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Create Excel</a>
                                    </div>

                                    <table class="table table-stripped" id="p_cancel">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Project</th>
                                                <th>Start</th>
                                                <th>End</th>
                                                <th>Rentang</th>
                                                <th>Add By</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="cancel_p">

                                        </tbody>
                                    </table>

                                </div>   
                            
                        </div>

                    </div>

                </div>


                <!-- Modal Ganti Status -->
                <div class="modal fade" id="cstat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">

                                <form action="<?php echo base_url();?>viewcontroller/change_stat" method="post">
                                    <div class="modal-header text-white info-color">
                                        <h5 class="modal-title" id="exampleModalLabel">Ganti Status</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" id="cidp" name="cidp" hidden>
                                        <h5 id="nama_pro"></h5>
                                        
                                        <div class="row">

                                                <div class="col-lg-6 md-form">
                                                    <select name="select_stat" id="select_stat" class="mdb-select md-form colorful-select dropdown-primary" required>
                                                        <option value="" disabled selected>Status</option>
                                                        <option value="0" disabled>Not Started</option>
                                                        <option value="1">Open</option>
                                                        <option value="2">Cancel</option>
                                                        <option value="3">Close</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 md-form" style="margin-top:48px;">
                                                    <input type="text" id="tgl_pro" name="tgl_pro" class="form-control datepicker" required>
                                                    <label for="tgl_pro" class="iser">Tanggal</label>
                                                </div>
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                                        <button type="submit" class="btn btn-outline-primary"><i class="fa fa-save"></i> Save</button>
                                    </div>
                                </form>

                            </div>
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
    document.getElementById("page").innerHTML = "View Project";

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

    $(document).ready(function(){
        $("#div_all").hide();
        $("#div_open").hide();
        $("#div_close").hide();
        $("#div_cancel").hide();
    })

    $("#ip_all").click(function(){
        $("#div_open").hide();
        $("#div_all").show();
        $("#div_close").hide();
        $("#div_cancel").hide();
        var status ='all';
        $.ajax({  
            url: "<?php echo base_url(); ?>" + "c_report/p_open",
            method:"POST",
            data:{status:status},             
                success:function(data){
                    console.log(data);  
                    //alert(data);
                    $("#all_p").html(data);
                    $('#p_all').DataTable();
                    $('.dataTables_length').addClass('bs-select'); 
                }
        });
    })

    $("#ip_open").click(function(){
        $("#div_open").show();
        $("#div_all").hide();
        $("#div_close").hide();
        $("#div_cancel").hide();
        var status ='2';
        $.ajax({  
            url: "<?php echo base_url(); ?>" + "c_report/p_open",
            method:"POST",
            data:{status:status},             
                success:function(data){
                    console.log(data);  
                    //alert(data);
                    $("#open_p").html(data);
                    $('#p_open').DataTable();
                    $('.dataTables_length').addClass('bs-select'); 
                }
        });
    })

    $("#ip_close").click(function(){
        $("#div_all").hide();
        $("#div_close").show();
        $("#div_cancel").hide();
        $("#div_open").hide();
        var status ='3';
        $.ajax({  
            url: "<?php echo base_url(); ?>" + "c_report/p_open",
            method:"POST",
            data:{status:status},             
                success:function(data){
                    console.log(data);  
                    //alert(data);
                    $("#close_p").html(data);
                    $('#p_close').DataTable();
                    $('.dataTables_length').addClass('bs-select'); 
                }
        });
    })

    $("#ip_cancel").click(function(){
        $("#div_all").hide();
        $("#div_close").hide();
        $("#div_cancel").show();
        $("#div_open").hide();
        var status ='4';
        $.ajax({  
            url: "<?php echo base_url(); ?>" + "c_report/p_open",
            method:"POST",
            data:{status:status},             
                success:function(data){
                    console.log(data);  
                    //alert(data);
                    $("#cancel_p").html(data);
                    $('#p_cancel').DataTable();
                    $('.dataTables_length').addClass('bs-select'); 
                }
        });
    })

    </script>        
</body>