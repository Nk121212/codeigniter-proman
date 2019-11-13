<?php 
    $get_id_task = $this->db->query("
        select id_task from todo where id = '$id_todo'
    ");
    $id_task = $get_id_task->row()->id_task;
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
                                            Edit Todo
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

                            <form action="<?php echo base_url();?>c_todolist/update_todo" method="post">
                            
                                <input type="text" name="id_todo" id="id_todo" value="<?php echo $id_todo;?>" hidden>

                                <div class="row">

                                    <div class="col-lg-3 md-form">
                                        <input type="text" class="form-control" name="todo_name" id="todo_name">
                                        <label for="todo_name" class="iser">Todo Name</label>
                                    </div>

                                    <div class="col-lg-3 md-form">
                                        <input type="text" class="form-control datepicker pointer" name="s_date" id="s_date">
                                        <label for="s_date" class="iser">Start Date</label>
                                    </div>

                                    <div class="col-lg-3 md-form">
                                        <input type="text" class="form-control datepicker pointer" name="f_date" id="f_date">
                                        <label for="f_date" class="iser">Finish Date</label>
                                    </div>

                                    <div class="col-lg-3 md-form">
                                        <button type="submit" class="btn btn-warning"><i class="fa fa-refresh"></i> Update</button>
                                    </div>
                                
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

    <script>

    $(document).ready(function(){
        $(function(){
                
            $('.number-only').keyup(function(e) {
                  if(this.value!='-')
                    while(isNaN(this.value))
                      this.value = this.value.split('').reverse().join('').replace(/[\D]/i,'')
                                             .split('').reverse().join('');
              })
              .on("cut copy paste",function(e){
                  e.preventDefault();
              });
          
          });
            
            document.getElementById("page").innerHTML = "<a href='<?php echo base_url();?>c_todolist/page_todolist/<?php echo $id_task;?>'></a> || Edit Todo";

            var id_todo = $("#id_todo").val();
                $.ajax({  
                    url: "<?php echo base_url(); ?>" + "c_todolist/fetch_todo",
                    method:"POST",
                    data:{id_todo:id_todo},             
                        success:function(data){

                        console.log(data);
                        $("#todo_name").val(data[0].todoname).trigger("change");
                        $("#s_date").val(data[0].start).trigger("change");
                        $("#f_date").val(data[0].finish).trigger("change");

                        }
                });
    })
//----------------------------------------------------------------------------------------------------------//
                       
//------------------------------------------------ fungsi Toggle -----------------------------------------//        

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