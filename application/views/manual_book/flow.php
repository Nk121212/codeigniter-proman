<style>
.enter {
    margin-top:10px;
}
.pointer{
    border-radius:25px;
}    
</style>
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
                                            App Flow
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

                            <div class="col-lg-12 md-form">

                                <div align="center">
                                    
                                    <div class="col-lg-12 md-form">
                                        <h5>Flow Project Management Application</h5>
                                    </div>

                                    <div class="view overlay zoom pointer">
                                        <img src="<?php echo base_url();?>image/flow/proman_fixed.png" class="img-fluid " alt="smaple image">
                                        <div class="mask flex-center">
                                            <p class="white-text"></p>
                                        </div>
                                    </div>
                                
                                </div>
                                
                            </div>

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
    <script src="<?php echo base_url();?>ckeditor/ckeditor.js"></script>

    <script>
        $(document).ready(function(){
            document.getElementById("page").innerHTML = "Flow Application";
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