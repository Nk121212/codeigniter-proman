<body class="fixed-sn black-skin">
<!--Main layout-->
<main>
    <div class="container-fluid">
        <!--Section: Intro-->

        <input type="text" name="id_project" id="id_project" value="<?php error_reporting(0); echo $id_project;?>" hidden>

        <div style="height: 5px"></div>
        <!--Section: Main panel-->
            <section class="mb-5">

                <div class="panel-group">
                    <div class="card-header white-text info-color">

                        <div class="panel-heading in">
                            <div class="row">

                                <div class="col-lg-6 md-form">
                                    <a class="btn btn-outline btn-rounded" data-toggle="modal" data-target="#modal_faq">
                                        Material
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
                                
                                    <div class="col-lg-6 md-form">
                                        <select onchange="cek_id()" id="idp" name="idp" class="mdb-select md-form colorful-select dropdown-primary" searchable="Search Here...." required>
                                            <?php
                                            $query3 = $this->db->query("select * from project where estimasi = '2' and status != '4'");
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

                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-stripped" id="tbl_todo">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Task Name</th>
                                                        <th>Start</th>
                                                        <th>End</th>
                                                        <th>Bobot</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="td_body">
                                                
                                                </tbody>
                                            </table>
                                        </div>
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
<script type="text/javascript" src="<?php echo base_url();?>dttable/dt_tbl1.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>dttable/dt_tbl2.js"></script>
<!--Initializations-->
<script>
    $(document).ready(function(){
        document.getElementById("page").innerHTML = "<a>Update Material</a>";
        var idp = $("#id_project").val();
        $("#idp").val(idp).trigger("change");
    })

    function cek_id(){
        $('#td_body').html(""); 
        var table = $('#tbl_todo').DataTable();
        table.destroy();

        var idp = $("#idp").val();
        
        $.ajax({  
            url: "<?php echo base_url(); ?>" + "c_material/show_material",
            method:"POST",
            data:{idp:idp},             
                success:function(data){
                    //alert(data);
                    $(function () {
                        $('[data-toggle="tooltip"]').tooltip()
                    })
                    //console.log(data);
                    $("#td_body").html(data); 
                    $('#tbl_todo').DataTable();
                }
        });

        //alert(idp);
    }

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