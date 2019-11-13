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
                                           Project Name :
                                            <?php 
                                            $query = $this->db->query("select nama_task,id_project from task where id = '$id_task'"); 
                                            $id_project = $query->row()->id_project;

                                            $idp = $this->db->query("select nama_project from project where id = '$id_project'");
                                            echo $idp->row()->nama_project;
                                            ?>
                                            </br>
                                            Task Name :
                                            <?php
                                            echo $task = $query->row()->nama_task;
                                            ?>
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
                                    <button data-toggle="tooltip" data-title="Add New Material" type="button" class="btn btn-primary">
                                    <i class="fa fa-plus"></i> Add Material</button>
                                </span>

                                <table class="table table-stripped" id="tbl_mat">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Material</th>
                                            <th>Harga</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="material_body">

                                    </tbody>
                                </table>

                            </div>  

                        </div>

                    </div> <!--Panel Group-->
                    

                    <!-- Modal -->
                    <div class="modal fade" id="modal_mat" tabindex="-1" role="dialog" aria-labelledby="modal_mat" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal_mat">Add Material
                                    <?php 
                                    $query = $this->db->query("select nama_task from task where id = '$id_task'"); 
                                    echo $query->row()->nama_task;
                                    ?>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form method="post" action="<?php echo base_url();?>c_task/add_material">

                                <div class="modal-body">
                                
                                    <input type="text" value="<?php echo $id_task; ?>" name="id_task" id="id_task" hidden required>
                                    <?php
                                        $cek_idp = $this->db->query("select id_project from task where id = '$id_task'");
                                        $rows = $cek_idp->row();
                                        $id_project = $rows->id_project;
                                    ?>
                                    <input type="text" value="<?php echo $id_project;?>" name="id_project" id="id_project" hidden required>

                                    <div class="row">

                                        <div class="col-lg-6 md-form" style="margin-top:48px;">
                                            <input onkeyup="this.value = this.value.toUpperCase();" placeholder="Material" type="text" list="m_data" id="nm_mat" name="nm_mat" class="form-control" required>   
                                            <datalist id="m_data">
                                            <?php 
                                            $query = $this->db->query("select * from material order by id desc");
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
                                            <input type="number" min="0" name="harga" id="harga" class="form-control" required>
                                            <label for="harga" class="iser">Harga</label>
                                        </div>

                                        <div class="col-lg-4 md-form">
                                        <input type="number" min="0" name="tharga" id="tharga" class="form-control" readonly required>
                                            <label for="tharga" class="iser">Total Harga</label>
                                        </div>



                                    </div>
                                    

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button data-toggle="tooltip" data-title="Save Material" type="submit" class="btn btn-primary">Save changes</button>
                                </div>

                                </form>

                            </div>
                        </div>
                    </div>



                </section>

            </div>

        </div>

    </main>
    <!--Initializations-->
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
                    url: "<?php echo base_url(); ?>" + "c_task/select_material",
                    method:"POST",
                    data:{id_material:id_material},             
                        success:function(data){
                            console.log(data);
                            $("#nm_mat").val(data[0].nama_material);
                            $("#harga").val(data[0].harga).trigger("change");
                            $("#satuan").val(data[0].satuan).trigger("change");
                            //data[0].aaa;
                        }
                });
        })

        $(document).ready(function(){

            var id_task = $("#id_task").val();
                $.ajax({  
                    url: "<?php echo base_url(); ?>" + "c_task/data_material",
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

            $('input[type="file"]').change(function(e){
                var fileName = e.target.files[0].name;
                $('.file-path').val(fileName);
            });

            var id_project = $("#id_project").val();
            document.getElementById("page").innerHTML = "<a href='<?php echo base_url();?>c_task/index'>All Project</a> || <a href='<?php echo base_url();?>c_task/view_task/"+id_project+"'>View Task</a> || <a>Add Material</a>";
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