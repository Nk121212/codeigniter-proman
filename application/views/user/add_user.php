<body class="fixed-sn black-skin">
<!--Main layout-->
<main>
    <div class="container-fluid">
        <!--Section: Intro-->

        <div style="height: 5px"></div>
        <!--Section: Main panel-->
            <section class="mb-5">

                <div class="panel-group">
                    <div class="card-header white-text default-color-dark">

                        <div class="panel-heading in">
                            <div class="row">

                                <div class="col-lg-6 md-form">
                                    <a class="btn btn-outline btn-rounded" data-toggle="modal" data-target="#modal_faq">
                                        Add New User
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

                                    <form action="<?php echo base_url();?>c_user/add" method="post">

                                        <div class="row">
                                            <div class="col-lg-3 md-form" style="margin-top:48px;"> 
                                                <input type="text" name="nm_user" id="nm_user" class="form-control" required>
                                                <label for="nm_user" class="iser">Nama</label>
                                            </div>
                                            <div class="col-lg-3 md-form" style="margin-top:48px;">
                                                <input type="email" name="mail" id="mail" class="form-control" required>
                                                <label for="mail" class="iser">Email</label>
                                            </div>
                                            <div class="col-lg-3 md-form" style="margin-top:48px;">
                                                <input type="password" name="pw" id="pw" class="form-control" required>
                                                <label for="pw" class="iser">Password</label>
                                            </div>
                                            <div class="col-lg-3 md-form">
                                                <select name="lvl" id="lvl" class="mdb-select md-form colorful-select dropdown-primary" required>
                                                    <option value="" disabled selected>Level User</option>
                                                    <option value="0">User</option>
                                                    <option value="1">Admin</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-4 md-form">
                                                <button type="submit" class="btn btn-default"><i class="fa fa-floppy-o"></i>  Save</button>
                                            </div>
                                        </div>

                                    </form>
                                    

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
        document.getElementById("page").innerHTML = "<a>Add User</a>";
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