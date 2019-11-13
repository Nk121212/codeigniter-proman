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
                                            Edit Project
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

                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Alert !</strong> Jika data tidak keluar silakan refresh supaya datanya tertarik.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                            <form id="submit" method="post" action="<?php echo base_url();?>c_edit/edit_project">
                            
                            <input type="hidden" value="<?php echo $id_project;?>" id="id_project" name="id_project">

                                <!--Grid row-->
                                <div class="p-2 mb-3 mx-4 mb-5">
                                    <div class="row" id="rmv">
                                        <!--div class="col-lg-6 md-form" style="margin-top:48px;">
                                            <input type="text" id="pname" name="pname" class="form-control" required>
                                            <label for="pname" class="iser">Project Name</label>
                                        </div>
                                        
                                        <div class="col-lg-6 md-form">
                                            <select name="pcategory[]" id="pcategory" class="mdb-select md-form colorful-select dropdown-primary"  multiple required>
                                                <?php
                                                $query3 = $this->db->query("select * from kategori");
                                                echo '
                                                <option value="" disabled selected>Category</option>
                                                ';
                                                foreach($query3->result() as $data){
                                                    echo '<option value="'.$data->id.'">'.$data->nama_kategori.'</option>';
                                                }
                                                ?>
                                                ?>
                                            </select>
                                        </div-->

                                        <div class="col-lg-12 form-group shadow-textarea">
                                            <label for="ckeditor1">Purpose</label>
                                            <textarea id="ckeditor1" name="ppurpose" required></textarea>
                                            <!--textarea class="form-control z-depth-1" id="ppurpose" name="ppurpose" rows="3" placeholder="Write Here ...." required></textarea-->
                                        </div>

                                        
                                        <!--div class="col-lg-4 md-form">
                                            <select name="pcoordinator" id="pcoordinator" class="mdb-select md-form colorful-select dropdown-primary" required>
                                            <?php
                                                $query3 = $this->db->query("select * from coordinator order by nama");
                                                echo '
                                                <option value="" disabled selected>Coordinator</option>
                                                ';
                                                foreach($query3->result() as $data){
                                                    echo '<option value="'.$data->id.'">'.$data->nama.'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-lg-4 md-form">
                                            <select name="complex[]" id="complex" class="mdb-select md-form colorful-select dropdown-primary" multiple required>
                                                <?php 
                                                $query =$this->db->query("select * from complexity order by nama_complex");
                                                echo '<option value="" disabled selected>Complexity</option>';
                                                foreach($query->result() as $data){
                                                    echo '
                                                    <option value="'.$data->id.'">'.$data->nama_complex.'</option>
                                                    ';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        
                                        <div class="col-lg-4 md-form" style="margin-top:48px;">
                                            <input placeholder="Lokasi" type="text" list="lok" id="lokasi" name="lokasi" class="form-control" required>   
                                            <datalist id="lok">
                                                <?php
                                                $query2 = $this->db->query("select * from departemen order by nama_departemen");
                                                foreach($query2->result() as $data){
                                                    echo '<option value="'.$data->nama_departemen.'">'.$data->nama_departemen.'</option>';
                                                }
                                                ?>
                                            </datalist>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <select name="res[]" id="res" class="mdb-select md-form colorful-select dropdown-primary" multiple required>
                                                <option value="" disabled selected>Choose Resource</option>
                                                <option value="1">Internal</option>
                                                <option value="2">External</option>
                                            </select>
                                        </div>

                                        <div class="col-lg-6 file-field" style="margin-top:48px;">
                                            <div class="btn btn-primary btn-sm float-left">
                                                <span><i class="fa fa-upload"></i>  Upload</span>
                                                <input type="file" class="file-upload" name="file">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="form-control file-path validate" type="text" placeholder="Upload your file">
                                            </div>
                                        </div-->

                                    </div></br>
                                    <div align="center"><button class="btn btn-outline-primary" id="spro" type="submit"><i class="fa fa-floppy-o"></i>  Save</button></div>
                                </div>    
                                <!--Grid row-->
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
    <!--Initializations-->
    <script src="<?php echo base_url();?>ckeditor/ckeditor.js"></script>

    <script>
        var roxyFileman = '../../../ckeditor/plugins/fileman/index.html';
        $(function () {
            CKEDITOR.replace('ckeditor1', {filebrowserBrowseUrl: roxyFileman,
                filebrowserImageBrowseUrl: roxyFileman + '?type=image',
                removeDialogTabs: 'link:upload;image:upload'});
        });
        
        $(document).ready(function(){

            var id_project = $("#id_project").val();
                $.ajax({  
                    url: "<?php echo base_url(); ?>" + "c_edit/data_project",
                    method:"POST",
                    data:{id_project:id_project},             
                        success:function(data){

                        console.log(data);
                        $("#ckeditor1").val(data[0].purpose).trigger("change");

                        }
                });
        }) 

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

            document.getElementById("page").innerHTML = "Create New Project";
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

            $('input[type="file"]').change(function(e){
                var fileName = e.target.files[0].name;
                $('.file-path').val(fileName);
            });
    </script>

</body>