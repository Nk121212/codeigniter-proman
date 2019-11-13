<?php
$a = $this->db->query("
select id_project from task where id = '$id_task'
");
$b = $a->row()->id_project;
?>
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
                                            Add Material
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

                                <span data-toggle="modal" data-target="#modal_mat">
                                    <button data-toggle="tooltip" data-title="Add New Material" type="button" class="btn btn-Primary">
                                    <i class="fa fa-plus"></i> Add Used Material</button>
                                </span>
                                <span data-toggle="modal" data-target="#comment_mat">
                                    <button data-toggle="tooltip" data-title="Add New Material" type="button" class="btn btn-secondary">
                                    <i class="fa fa-comment"></i> Add Comment</button>
                                </span>
                                <span data-toggle="modal" data-target="#view_est">
                                    <button data-toggle="tooltip" data-title="View Estimated" type="button" class="btn btn-warning">
                                    <i class="fa fa-eye"></i> Estimated Material</button>
                                </span>
                                
                                <div class="row" style="margin-top:48px;">

                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <div align="left"><h5>Actual Material Used</h5></div>
                                            <table class="table table-stripped" id="act_mat">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>No BPB</th>
                                                        <th>Material</th>
                                                        <th>Harga</th>
                                                        <th>Jumlah</th>
                                                        <th>Total Harga</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="act_body">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="view_est" tabindex="-1" role="dialog" aria-labelledby="view_est" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="view">View Estimate</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                            <div class="modal-body">

                                                <div class="row">
                                            
                                                <div class="col-lg-12">
                                                    <div class="table-responsive">
                                                        <h5 style="font-family: Arial, Helvetica, sans-serif;">Estimate Material Used</h5>
                                                        <table class="table table-stripped" id="tbl_mat">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Material</th>
                                                                    <th>Harga</th>
                                                                    <th>Jumlah</th>
                                                                    <th>Total Harga</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="material_body">

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                </div>
                                                
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                <i class="fa fa-close"></i> Close</button>
                                            </div>

                                    </div>

                                </div>

                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="modal_mat" tabindex="-1" role="dialog" aria-labelledby="modal_mat" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modal_mat">Task
                                            <?php
                                            $a = $this->db->query("
                                            select nama_task from task where id = '$id_task'
                                            ");
                                            echo $a->row()->nama_task;
                                            ?>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form method="post" action="<?php echo base_url();?>c_material/add_material2">

                                            <div class="modal-body">

                                                <div class="row">
                                            
                                                    <input type="text" value="<?php echo $id_task; ?>" name="id_task" id="id_task" hidden>
                                                    <?php
                                                        $cek_idp = $this->db->query("select id_project from task where id = '$id_task'");
                                                        $rows = $cek_idp->row();
                                                        $id_project = $rows->id_project;
                                                    ?>
                                                    <input type="text" value="<?php echo $id_project;?>" name="id_project" id="id_project" hidden>

                                                    <input type="text" name="id_material" name="id_material" class="idm" hidden>
                                                        
                                                    <div class="col-lg-6 md-form" style="margin-top:48px;">
                                                        <input onkeyup="this.value = this.value.toUpperCase();" placeholder="Material" type="text" list="m_data" id="nm_mat" name="nm_mat" class="form-control" required>   
                                                        <datalist id="m_data">
                                                        <?php 
                                                        $query = $this->db->query("select * from material where id_task = '$id_task' order by nama_material asc");
                                                        foreach($query->result() as $data){
                                                            echo '
                                                            <option value="'.$data->id.'">'.$data->nama_material.'</option>
                                                            ';
                                                        }
                                                        ?>
                                                        </datalist>
                                                    </div>

                                                    <div class="col-lg-6 md-form">
                                                        <select name="satuan" id="satuan" class="mdb-select md-form colorful-select dropdown-primary" searchable ="seach here ..." required>
                                                            <?php 
                                                            $query = $this->db->query("select * from satuan order by nama_satuan");
                                                            echo '
                                                            <option value="" disabled selected>Satuan</option>
                                                            ';
                                                            foreach($query->result() as $data){
                                                                echo '
                                                                <option value="'.$data->id.'">'.$data->nama_satuan.'</option>
                                                                ';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="col-lg-4 md-form">
                                                        <input type="text" name="jml" id="jml" class="form-control" required>
                                                        <label for="jml" class="iser">Jumlah</label>
                                                    </div>

                                                    <div class="col-lg-4 md-form">
                                                        <input type="text" name="harga" id="harga" class="form-control" required>
                                                        <label for="harga" class="iser">Harga</label>
                                                    </div>

                                                    <div class="col-lg-4 md-form">
                                                        <input type="text" name="tharga" id="tharga" class="form-control" readonly required>
                                                        <label for="tharga" class="iser">Total Harga</label>
                                                    </div>

                                                    <div class="col-lg-6 md-form" style="margin-top:48px;">
                                                        <input style="cursor:pointer;" type="text" name="du" id="du" class="form-control datepicker" required>
                                                        <label for="du" class="iser">Update Date</label>
                                                    </div>

                                                    <div class="col-lg-6 md-form" style="margin-top:48px;">
                                                        <input onkeyup="this.value = this.value.toUpperCase();" type="text" name="bpb" id="bpb" class="form-control" required>
                                                        <label for="bpb" class="iser">No BPB</label>
                                                    </div>

                                                    <div class="col-lg-12 md-form">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="materialUnchecked" name="cek">
                                                            <label class="form-check-label" for="materialUnchecked">Sesuai ?</label>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                <i class="fa fa-close"></i> Close</button>
                                                <button  data-toggle="tooltip" data-title="Save Material" type="submit" class="btn btn-primary">
                                                <i class="fa fa-floppy-o"></i> Save</button>
                                            </div>

                                        </form>

                                    </div>

                                </div>

                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="comment_mat" tabindex="-1" role="dialog" aria-labelledby="comment_mat" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5>
                                            <?php
                                            $nmt = $this->db->query("select nama_task from task where id='$id_task'");
                                            echo 'Task '.$nm_task = $nmt->row()->nama_task;
                                            ?>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form method="post" action="<?php echo base_url();?>c_material/add_comment">
                                            <input type="text" value="<?php echo $id_task; ?>" name="id_task" id="id_task" hidden>
                                            <div class="modal-body">

                                                <div class="col-lg-12 md-form">
                                                    <textarea name="comment" id="comment" cols="87" rows="10"></textarea>
                                                    <label for="comment" class="iser">Comment</label>                
                                                </div>
                                                
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                <i class="fa fa-close"></i> Close</button>
                                                <button  data-toggle="tooltip" data-title="Save Material" type="submit" class="btn btn-primary">
                                                <i class="fa fa-floppy-o"></i> Save</button>
                                            </div>

                                        </form>

                                    </div>

                                </div>

                            </div>








                        </div>

                    </div> <!--Panel Group-->
                    
                </section>

            </div>

        </div>

    </main>
    <!--Initializations-->

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

    <script>
        $("#jml,#harga").keyup(function(){
            var jml = $("#jml").val();
            var hrg = $("#harga").val();
            var tharga = jml*hrg;
            $("#tharga").val(tharga).trigger("change");
        })

        $("#nm_mat").change(function(){
            var id_material = $("#nm_mat").val();
            $.ajax({  
                    url: "<?php echo base_url(); ?>" + "c_material/select_material",
                    method:"POST",
                    data:{id_material:id_material},             
                        success:function(data){
                            //alert(data);
                            console.log(data);
                            $("#nm_mat").val(data[0].nama_material);
                            $("#harga").val(data[0].harga).trigger("change");
                            $("#satuan").val(data[0].satuan).trigger("change"); 
                            $(".idm").val(data[0].id);                            
                            //data[0].aaa;
                        }
                });
        })

        $(document).ready(function(){

            var id_task = $("#id_task").val();
            $.ajax({  
                url: "<?php echo base_url(); ?>" + "c_material/data_material",
                method:"POST",
                data:{id_task:id_task},             
                    success:function(data){
                        $(function () {
                            $('[data-toggle="tooltip"]').tooltip()
                        })
                        //console.log(data);
                        $("#material_body").html(data); 
                        $('#tbl_mat').DataTable();
                        $('.dataTables_length').addClass('bs-select');   

                    }
            });

            $.ajax({  
                url: "<?php echo base_url(); ?>" + "c_material/data_material2",
                method:"POST",
                data:{id_task:id_task},             
                    success:function(data){
                        $(function () {
                            $('[data-toggle="tooltip"]').tooltip()
                        })
                        //console.log(data);
                        $("#act_body").html(data); 
                        $('#act_mat').DataTable();
                        $('.dataTables_length').addClass('bs-select');   

                    }
            });

            $('input[type="file"]').change(function(e){
                var fileName = e.target.files[0].name;
                $('.file-path').val(fileName);
            });

            var id_project = $("#id_project").val();
            document.getElementById("page").innerHTML = "<a href='../page/<?php echo $b;?>'><i class='fa fa-arrow-left'></i> Go Back</a> || <a>Add Material</a>";
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