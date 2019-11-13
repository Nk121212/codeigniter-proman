<body class="fixed-sn black-skin">
<!--Main layout-->
<style>
.like{
    color:#0000FF;
}
.dislike {
    color: red;
}
.pointer{
    cursor:pointer;
}
</style>
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
                                        Register New Account
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
                                
                            <form action="<?php echo base_url(); ?>c_register/daftar" method="post">
                        
                                <div class="card-body">
                                
                                    <div class="row">

                                        <div class="col-lg-4 md-form">
                                            <input type="text" name="nm_user" id="nm_user" class="form-control" required>
                                            <label for="nm_user" class="iser">Nama Lengkap</label>
                                        </div>

                                        <div class="col-lg-4 md-form">
                                            <input type="email" name="email" id="email" class="form-control" required>
                                            <label for="email" class="iser">Email Sipatex</label>
                                        </div>

                                        <div class="col-lg-4 md-form">
                                            <input type="password" name="password" id="password" class="form-control" required>
                                            <label for="password" class="iser">Password</label>
                                        </div>

                                        <div class="col-lg-12 md-form">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Register</button>
                                            <a href="<?php echo base_url();?>" type="button" class="btn btn-danger"><i class="fa fa-sign-out"></i> Login Page</a>
                                        </div>
                                        
                                    </div>

                                </div>

                            </form>

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
<!--script type="text/javascript" src="<?php echo base_url();?>js/mdb_init.js"></script>


<!--Initializations-->
<script>
    $(document).ready(function(){
        document.getElementById("page").innerHTML = "<a>Register</a>";
        $("#hide_me").hide();
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