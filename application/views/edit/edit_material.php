<?php 
$query = $this->db->query("
    select * from material where id = $id_material
");                                    
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
                                            Edit Material
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

                                <form method="post" action="<?php echo base_url();?>c_material/edit_material">

                                    <input type="text" name="id_material" id="id_material" value="<?php echo $id_material;?>" hidden>

                                    <!--Grid row-->
                                    <div class="p-2 mb-3 mx-4 mb-5">
                                        <div class="row" id="rmv">
                                            <div class="col-lg-6 md-form" style="margin-top:48px;">
                                                <input type="text" id="nm_mat" name="nm_mat" class="form-control" required>
                                                <label for="nm_mat" class="iser">Material</label>
                                            </div>

                                            <div class="col-lg-6 md-form">
                                                <select name="satuan" id="satuan" class="mdb-select md-form colorful-select dropdown-primary" required>
                                                    <?php
                                                    $query3 = $this->db->query("select * from satuan");
                                                    echo '
                                                    <option value="" disabled selected>Satuan</option>
                                                    ';
                                                    foreach($query3->result() as $data){
                                                        echo '<option value="'.$data->id.'">'.$data->nama_satuan.'</option>';
                                                    }
                                                    ?>
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-lg-4 md-form">
                                                <input type="text" id="jml" name="jml" class="form-control" required>
                                                <label for="jml" class="iser">Jumlah</label>
                                            </div>

                                            <div class="col-lg-4 md-form">
                                                <input type="text" id="hrg" name="hrg" class="form-control" required>
                                                <label for="hrg" class="iser">Harga</label>
                                            </div>
                                            
                                            <div class="col-lg-4 md-form">
                                                <input type="text" id="tot_hrg" name="tot_hrg" class="form-control" required readonly>
                                                <label for="tot_hrg" class="iser">Total Harga</label>
                                            </div>

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

    <script>
 
        $("#jml, #hrg").keyup(function(){
            var jumlah = $("#jml").val();
            var harga = $("#hrg").val();

            var hitung = jumlah*harga;

            $("#tot_hrg").val(hitung);
            
        })
        
        $(document).ready(function(){

            var id_material = $("#id_material").val();
            //alert(id_material);
            
                $.ajax({  
                    url: "<?php echo base_url(); ?>" + "c_edit/de_material",
                    method:"POST",
                    data:{id_material:id_material},             
                        success:function(data){

                            console.log(data);
                            $("#nm_mat").val(data[0].nama_material).trigger("change");
                            $("#satuan").val(data[0].satuan).trigger("change");
                            $("#jml").val(data[0].jumlah).trigger("change");
                            $("#hrg").val(data[0].harga).trigger("change");
                            $("#tot_hrg").val(data[0].total_harga).trigger("change");                  

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

            document.getElementById("page").innerHTML = "Edit Material";
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