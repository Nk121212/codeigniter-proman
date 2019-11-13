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
                                            Progress Project
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

                            <form target="_blank" name="myForm" action="<?php echo base_url();?>c_report/report_progress" method="post" onsubmit="return validateForm()">

                                <div class="card-body">

                                    <div class="row">
                                        
                                        <div class="col-lg-6 md-form">
                                            <select name="idp" id="idp" class="mdb-select md-form colorful-select dropdown-primary" searchable = "Search Here ..." required>
                                                <?php
                                                echo '
                                                <option value="" disabled selected>Select Project</option>
                                                ';
                                                $query = $this->db->query("
                                                    select * from project where status != 1
                                                ");
                                                foreach($query->result() as $data){
                                                    echo '
                                                    <option value="'.$data->id.'">'.$data->nama_project.'</option>
                                                    ';
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                        
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <input type="text" name="from" id="from" class="form-control" readonly required>
                                            <label for="from" class="iser">From</label>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <input style="cursor:pointer;" type="text" name="tgl" id="tgl" class="form-control datepicker" required>
                                            <label for="tgl" class="iser">To</label>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <button type="submit" class="btn btn-danger"> <i class="fa fa-file-pdf-o"></i> Create PDF</button>
                                        </div>

                                    </div>

                                </div>

                            </form>
                            

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
    document.getElementById("page").innerHTML = "Progress Project";

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

    $("#idp").change(function(){
        var id_project = $("#idp").val();
        //alert(id_project);
        $.ajax({  
            url: "<?php echo base_url(); ?>" + "c_report/start_date",
            method:"POST",
            data:{id_project:id_project},             
                success:function(data){
                    console.log(data);  
                    $("#from").val(data).trigger("change");

                }
        });
    })

    function validateForm() {
        var x = document.forms["myForm"]["idp"].value;
        var y = document.forms["myForm"]["tgl"].value;
        var z = document.forms["myForm"]["from"].value;
        if (x == "") {
            alert("Silakan Isi id_project");
            return false;
        }
        else if(y == ""){
            alert("Silakan Isi Tanggal");
            return false;
        }
        else if(y < z){
            alert("Pilih Tanggal Dengan Benar");
            return false;
        }
    }

    </script>        
</body>