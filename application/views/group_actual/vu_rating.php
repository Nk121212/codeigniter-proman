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
                                        Update Rating
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
                                
                            <form action="<?php echo base_url(); ?>c_rating/add_rate" method="post" id ="rform">
                        
                                <div class="card-body">
                                
                                    <div class="col-lg-6 md-form">
                                        <select id="idp" name="idp" class="mdb-select md-form colorful-select dropdown-primary" searchable="Search Here...." required>
                                            <?php
                                            $query3 = $this->db->query("select * from project where status = 4 and rated = '0'");
                                            echo '
                                            <option value="" disabled selected>Choose Project</option>
                                            ';
                                            foreach($query3->result() as $data){
                                                echo '<option value="'.$data->id.'">'.$data->nama_project.'</option>';
                                            }
                                            ?>
                                            ?>
                                        </select>
                                    </div>


                                    <div class="col-lg-12 md-form" id="hide_me">

                                        <div class="row">

                                            <div class="col-lg-6 md-form">
                                                
                                                <div class="col-lg-12">
                                                    <p>
                                                        <b>Schedule :</b>
                                                    </p>
                                                </div>

                                                <input type="text" name="sche" id="sche" hidden required>
                                                <input type="text" name="sche_tu" value="Schedule" hidden required>

                                                <div class="row">

                                                    <div class="col-lg-12">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Estimated</th>
                                                                    <th>Actual</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td id="estm"></td>
                                                                    <td id="ests"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" style="text-align:center;">
                                                                        <ul class="nav" role="tablist" style="margin-left:150">

                                                                            <li class="nav-item p-0 waves-effect">
                                                                                <span data-toggle="tooltip" data-title="Happy ?">
                                                                                    <a id="sche1" class="btn-floating btn-md btn-amber" data-toggle="tab" role="tab" aria-controls="home" aria-selected="true">
                                                                                        <i class="fa fa-smile-o"></i>
                                                                                    </a>
                                                                                </span>
                                                                            </li>
                                                                            <li class="nav-item p-0 waves-effect">
                                                                            <span data-toggle="tooltip" data-title="Neutral ?">
                                                                                <a id="sche2" class="btn-floating btn-md btn-yellow" data-toggle="tab" role="tab" aria-controls="profile" aria-selected="false">
                                                                                    <i class="fa fa-meh-o fa-2x pointer"></i>
                                                                                </a>
                                                                                </span>
                                                                            </li>
                                                                            <li class="nav-item p-0 waves-effect">
                                                                            <span data-toggle="tooltip" data-title="Upset ?">
                                                                                <a id="sche3" class="btn-floating btn-md btn-dark-green" data-toggle="tab" role="tab" aria-controls="profile" aria-selected="false">
                                                                                    <i class="fa fa-frown-o fa-2x pointer"></i>
                                                                                </a>
                                                                                </span>
                                                                            </li>

                                                                        </ul>
                                                                        
                                                                        <div class="md-form">
                                                                            <input type="text" id="sche_rate" name="sche_rate" class="form-control" required>
                                                                            <label for="sche_rate">Comment</label>
                                                                        </div>

                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div> 

                                            </div>

                                            <div class="col-lg-6 md-form">

                                                <p>
                                                    <b>Budget :</b>
                                                </p>

                                                <input type="text" name="cost" id="cost" hidden required>
                                                <input type="text" name="cost_tu" value="Budget" hidden required>

                                                <div class="row">

                                                    <div class="col-lg-12">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Estimated</th>
                                                                    <th>Actual</th>
                                                                    <th>Persen</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td id="estbud"></td>
                                                                    <td id="actbud"></td>
                                                                    <td id="persen"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="3" style="text-align:center;">
                                                                        <ul class="nav" role="tablist" style="margin-left:150">
 
                                                                            <li class="nav-item p-0 waves-effect">
                                                                                <span data-toggle="tooltip" data-title="Happy ?">
                                                                                <a id="cost1" class="btn-floating btn-md btn-amber" data-toggle="tab" role="tab" aria-controls="home" aria-selected="true">
                                                                                    <i class="fa fa-smile-o"></i>
                                                                                </a>
                                                                                </span>
                                                                            </li>
                                                                            <li class="nav-item p-0 waves-effect">
                                                                            <span data-toggle="tooltip" data-title="Neutral ?">
                                                                                <a id="cost2" class="btn-floating btn-md btn-yellow" data-toggle="tab" role="tab" aria-controls="profile" aria-selected="false">
                                                                                    <i class="fa fa-meh-o fa-2x pointer"></i>
                                                                                </a>
                                                                                </span>
                                                                            </li>
                                                                            <li class="nav-item p-0 waves-effect">
                                                                            <span data-toggle="tooltip" data-title="Upset ?">
                                                                                <a id="cost3" class="btn-floating btn-md btn-dark-green" data-toggle="tab" role="tab" aria-controls="profile" aria-selected="false">
                                                                                    <i class="fa fa-frown-o fa-2x pointer"></i>
                                                                                </a>
                                                                                </span>
                                                                            </li>
                                                                            
                                                                        </ul>
                                                                        
                                                                        <div class="md-form">
                                                                            <input type="text" id="cost_rate" name="cost_rate" class="form-control" required>
                                                                            <label for="cost_rate">Comment</label>
                                                                        </div>

                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="col-lg-12 md-form">

                                                <p>
                                                    <b>Material :</b> 
                                                </p>

                                                <input type="text" name="mat" id="mat" hidden required>
                                                <input type="text" name="mat_tu" value="Material" hidden required>

                                                <div class="row">

                                                    <div class="col-lg-12">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Sesuai</th>
                                                                    <th>Tidak Sesuai</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td id="smat"></td>
                                                                    <td id="tmat"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" style="text-align:center;">
                                                                        <ul class="nav" role="tablist" style="margin-left:450">
                                                                        
                                                                            <li class="nav-item p-0 waves-effect">
                                                                            <span data-toggle="tooltip" data-title="Happy ?">
                                                                                <a id="mat1" class="btn-floating btn-md btn-amber" data-toggle="tab" role="tab" aria-controls="home" aria-selected="true">
                                                                                    <i class="fa fa-smile-o"></i>
                                                                                </a>
                                                                                </span>
                                                                            </li>
                                                                            <li class="nav-item p-0 waves-effect">
                                                                            <span data-toggle="tooltip" data-title="Neutral ?">
                                                                                <a id="mat2" class="btn-floating btn-md btn-yellow" data-toggle="tab" role="tab" aria-controls="profile" aria-selected="false">
                                                                                    <i class="fa fa-meh-o fa-2x pointer"></i>
                                                                                </a>
                                                                                </span>
                                                                            </li>
                                                                            <li class="nav-item p-0 waves-effect">
                                                                            <span data-toggle="tooltip" data-title="Upset ?">
                                                                                <a id="mat3" class="btn-floating btn-md btn-dark-green" data-toggle="tab" role="tab" aria-controls="profile" aria-selected="false">
                                                                                    <i class="fa fa-frown-o fa-2x pointer"></i>
                                                                                </a>
                                                                                </span>
                                                                            </li>
                                                                            
                                                                        </ul>
                                                                        
                                                                        <div class="md-form">
                                                                            <input type="text" id="mat_rate" name="mat_rate" class="form-control" required>
                                                                            <label for="mat_rate">Comment</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="col-lg-6 md-form">

                                                <p>
                                                    <b>Resource Internal :</b> 
                                                </p>

                                                <input type="text" name="res_int" id="res_int" hidden required>
                                                <input type="text" name="resint_tu" value="Resource Internal" hidden required>

                                                <div class="row">

                                                    <div class="col-lg-12">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th></th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" style="text-align:center;">
                                                                        <ul class="nav" role="tablist" style="margin-left:150px;">
                                                                        
                                                                            <li class="nav-item p-0 waves-effect">
                                                                            <span data-toggle="tooltip" data-title="Happy ?">
                                                                                <a id="res_int1" class="btn-floating btn-md btn-amber" data-toggle="tab" role="tab" aria-controls="home" aria-selected="true">
                                                                                    <i class="fa fa-smile-o"></i>
                                                                                </a>
                                                                                </span>
                                                                            </li>
                                                                            <li class="nav-item p-0 waves-effect">
                                                                            <span data-toggle="tooltip" data-title="Neutral ?">
                                                                                <a id="res_int2" class="btn-floating btn-md btn-yellow" data-toggle="tab" role="tab" aria-controls="profile" aria-selected="false">
                                                                                    <i class="fa fa-meh-o fa-2x pointer"></i>
                                                                                </a>
                                                                                </span>
                                                                            </li>
                                                                            <li class="nav-item p-0 waves-effect">
                                                                            <span data-toggle="tooltip" data-title="Upset ?">
                                                                                <a id="res_int3" class="btn-floating btn-md btn-dark-green" data-toggle="tab" role="tab" aria-controls="profile" aria-selected="false">
                                                                                    <i class="fa fa-frown-o fa-2x pointer"></i>
                                                                                </a>
                                                                                </span>
                                                                            </li>
                                                                            
                                                                        </ul>
                                                                        
                                                                        <div class="md-form">
                                                                            <input type="text" id="resint_rate" name="resint_rate" class="form-control" required>
                                                                            <label for="resint_rate">Comment</label>
                                                                        </div>

                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="col-lg-6 md-form">

                                                <p>
                                                    <b>Resource External :</b> 
                                                </p>

                                                <input type="text" name="res_ext" id="res_ext" hidden required>
                                                <input type="text" name="resext_tu" value="Resource External" hidden required>

                                                <div class="row">
                                                    
                                                    <div class="col-lg-12">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th></th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" style="text-align:center;">
                                                                        <ul class="nav" role="tablist" style="margin-left:150px;">
                                                                        
                                                                            <li class="nav-item p-0 waves-effect">
                                                                            <span data-toggle="tooltip" data-title="Happy ?">
                                                                                <a id="res_ext1" class="btn-floating btn-md btn-amber" data-toggle="tab" role="tab" aria-controls="home" aria-selected="true">
                                                                                    <i class="fa fa-smile-o"></i>
                                                                                </a>
                                                                                </span>
                                                                            </li>
                                                                            <li class="nav-item p-0 waves-effect">
                                                                            <span data-toggle="tooltip" data-title="Neutral ?">
                                                                                <a id="res_ext2" class="btn-floating btn-md btn-yellow" data-toggle="tab" role="tab" aria-controls="profile" aria-selected="false">
                                                                                    <i class="fa fa-meh-o fa-2x pointer"></i>
                                                                                </a>
                                                                                </span>
                                                                            </li>
                                                                            <li class="nav-item p-0 waves-effect">
                                                                            <span data-toggle="tooltip" data-title="Upset ?">
                                                                                <a id="res_ext3" class="btn-floating btn-md btn-dark-green" data-toggle="tab" role="tab" aria-controls="profile" aria-selected="false">
                                                                                    <i class="fa fa-frown-o fa-2x pointer"></i>
                                                                                </a>
                                                                                </span>
                                                                            </li>
                                                                            
                                                                        </ul>
                                                                        
                                                                        <div class="md-form">
                                                                            <input type="text" id="resext_rate" name="resext_rate" class="form-control" required>
                                                                            <label for="resext_rate">Comment</label>
                                                                        </div>

                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>

                                            </div>

                                            
                                            <div class="col-lg-12">
                                                <button type="submit" class="btn btn-success"><i class="fa fa-star"></i> Save Rate</button>
                                            </div>

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
<script type="text/javascript" src="<?php echo base_url();?>js/mdb_init.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>dttable/js/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>plugin/rating/starrr.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/sweetalert.min.js"></script>


<!--Initializations-->
<script>
    $(document).ready(function(){
        document.getElementById("page").innerHTML = "<a>Update Rating Project</a>";
        $("#hide_me").hide();
    })

    $("#idp").change(function(){
        $("#hide_me").show();
        var id_project = $(this).val();
        //alert(id_project);
            
            $.ajax({  
                url: "<?php echo base_url(); ?>" + "c_rating/data_p",
                method:"POST",
                data:{id_project:id_project},             
                    success:function(data){
                        console.log(data);
                        document.getElementById("estm").innerHTML = data[0].est_mulai+" - "+data[0].est_selesai+" <b>["+data[0].est_hari+" Days]</b>";
                        document.getElementById("ests").innerHTML = data[0].mulai+" - "+data[0].selesai+" <b>["+data[0].hari+" Days]</b>";
                        document.getElementById("estbud").innerHTML = "Rp. "+data[0].est_budget;
                        document.getElementById("actbud").innerHTML = "Rp. "+data[0].budget;
                        document.getElementById("persen").innerHTML = "<b>"+data[0].persen+" %</b>";
                        document.getElementById("smat").innerHTML = data[0].sesuai+" Material";
                        document.getElementById("tmat").innerHTML = data[0].tidak+" Material";
                        
                    }
            });

    })

    //schedule group
    $("#sche1").click(function(){
        $("#sche").val("1");
        swal('You Choose Happy', '', 'success');
    })
    $("#sche2").click(function(){
        $("#sche").val("2");
        swal('You Choose Neutral', '', 'success');
    })
    $("#sche3").click(function(){
        $("#sche").val("3");
        swal('You Choose Upset', '', 'success');
    })

    //costing group
    $("#cost1").click(function(){
        $("#cost").val("1");
        swal('You Choose Happy', '', 'success');
    })
    $("#cost2").click(function(){
        $("#cost").val("2");
        swal('You Choose Neutral', '', 'success');
    })
    $("#cost3").click(function(){
        $("#cost").val("3");
        swal('You Choose Upset', '', 'success');
    })

    //costing group
    $("#cost1").click(function(){
        $("#cost").val("1");
        swal('You Choose Happy', '', 'success');
    })
    $("#cost2").click(function(){
        $("#cost").val("2");
        swal('You Choose Neutral', '', 'success');
    })
    $("#cost3").click(function(){
        $("#cost").val("3");
        swal('You Choose Upset', '', 'success');
    })

    //Material group
    $("#mat1").click(function(){
        $("#mat").val("1");
        swal('You Choose Happy', '', 'success');
    })
    $("#mat2").click(function(){
        $("#mat").val("2");
        swal('You Choose Neutral', '', 'success');
    })
    $("#mat3").click(function(){
        $("#mat").val("3");
        swal('You Choose Upset', '', 'success');
    })


    //Resource internal group
    $("#res_int1").click(function(){
        $("#res_int").val("1");
        swal('You Choose Happy', '', 'success');
    })
    $("#res_int2").click(function(){
        $("#res_int").val("2");
        swal('You Choose Neutral', '', 'success');
    })
    $("#res_int3").click(function(){
        $("#res_int").val("3");
        swal('You Choose Upset', '', 'success');
    })


    //Resource external group
    $("#res_ext1").click(function(){
        $("#res_ext").val("1");
        swal('You Choose Happy', '', 'success');
    })
    $("#res_ext2").click(function(){
        $("#res_ext").val("2");
        swal('You Choose Neutral', '', 'success');
    })
    $("#res_ext3").click(function(){
        $("#res_ext").val("3");
        swal('You Choose Upset', '', 'success');
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