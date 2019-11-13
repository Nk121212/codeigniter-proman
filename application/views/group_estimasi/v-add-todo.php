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
                                <span data-toggle="modal" data-target="#modal_todo">
                                    <button data-toggle="tooltip" data-title="Add New To do" type="button" class="btn btn-outline-primary"><i class="fa fa-plus"></i> Add Todo</button>
                                </span>

                                <div class="table-responsive">

                                    <table class="table table-stripped" id="tbl_todo">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Todo</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="todo_body">

                                        </tbody>
                                    </table>
                                    
                                </div>

                            </div>
                            
                        </div>

                    </div> <!--Panel Group-->

                    <!-- Modal -->
                    <div class="modal fade" id="modal_todo" tabindex="-1" role="dialog" aria-labelledby="modal_todo" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal_todo">Todo List 
                                    <?php 
                                    $query = $this->db->query("select nama_task from task where id = '$id_task'"); 
                                    echo $query->row()->nama_task;
                                    ?>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form name="myForm" method="post" action="<?php echo base_url();?>c_task/add_todo" onsubmit="return validateForm()">

                                <div class="modal-body">

                                        <input type="text" value="<?php echo $id_task; ?>" name="id_task" id="id_task" hidden>
                                        <?php
                                            $cek_idp = $this->db->query("select id_project from task where id = '$id_task'");
                                            $rows = $cek_idp->row();
                                            $id_project = $rows->id_project;
                                        ?>
                                        <input type="text" value="<?php echo $id_project;?>" name="id_project" id="id_project" hidden>

                                        <div class="row">

                                            <div class="col-lg-12 md-form">
                                                <input onkeyup="this.value = this.value.toUpperCase();" type="text" name="todo" id="todo" class="form-control" required>
                                                <label for="todo" class="iser">To Do Name</label>
                                            </div>
                                            <div class="col-lg-6 md-form">
                                                <input type="text" name="mulai" id="mulai" class="form-control datepicker pointer" required>
                                                <label for="mulai" class="iser">Start Date</label>
                                            </div>
                                            <div class="col-lg-6 md-form">
                                                <input type="text" name="selesai" id="selesai" class="form-control datepicker pointer" required>
                                                <label for="selesai" class="iser">Finish Date</label>
                                            </div>

                                        </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
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
        $(document).ready(function(){
            var id_task = $("#id_task").val();
                $.ajax({  
                    url: "<?php echo base_url(); ?>" + "c_task/data_todo",
                    method:"POST",
                    data:{id_task:id_task},             
                        success:function(data){
                            $(function () {
                                $('[data-toggle="tooltip"]').tooltip()
                            })
                            //console.log(data);
                            $("#todo_body").html(data); 
                            $('#tbl_todo').DataTable();
                            $('.dataTables_length').addClass('bs-select');   

                        }
                });
              var id_project = $("#id_project").val();  
            document.getElementById("page").innerHTML = "<a href='<?php echo base_url();?>c_task/index'>All Project</a> || <a href='<?php echo base_url();?>c_task/view_task/"+id_project+"'>View Task</a> || <a>Add Material</a>";
        })
        
        function validateForm() {
            var x = document.forms["myForm"]["mulai"].value;
            var y = document.forms["myForm"]["selesai"].value;
            if (x == "" || y == "") {
                alert("Silakan Isi Start Date Dan Finish Date");
                return false;
            }
            else if(y < x){
                alert("Pilih Tanggal Dengan Benar !");
                return false;
            }
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
        

    </script>

</body>