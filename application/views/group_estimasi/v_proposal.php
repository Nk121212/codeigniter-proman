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
                                    <a class="btn btn-outline btn-rounded" data-toggle="modal" data-target="#modal_faq">
                                        Create Proposal
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

                                    <form target="_blank" action="<?php echo base_url();?>c_proposal/get_proposal" method="post">

                                        <div class="col-lg-6 md-form">
                                            <select onchange="cek_id()" id="idp" name="idp" class="mdb-select md-form colorful-select dropdown-primary" searchable="Search Here...." required>
                                                <?php
                                                $query3 = $this->db->query("select * from project where estimasi = 1");
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

                                        <div class="row" id="div_ncr" style="padding-left:20;">

                                            <button class="btn btn-sm btn-success" type="button" id="p1"><i class="fa fa-plus"></i></button>

                                            <div class="col-lg-3 md-form">
                                                <input type="text" name="dibuat[]" id="dibuat" class="form-control" required>
                                                <label class="iser" for="dibuat">Dibuat</label>
                                            </div>

                                        </div>


                                        <div class="row" id="div_nkn" style="padding-left:20;">
                                            <!-- -->
                                            <button class="btn btn-sm btn-success" type="button" id="p2"><i class="fa fa-plus"></i></button>

                                            <div class="col-lg-3 md-form">
                                                <input type="text" name="diketahui[]" id="diketahui" class="form-control" required>
                                                <label class="iser" for="diketahui">Diketahui</label>
                                            </div>

                                        </div>
                                            <!-- -->

                                        <div class="row" id="div_appr" style="padding-left:20;">

                                            <button class="btn btn-sm btn-success" type="button" id="p3"><i class="fa fa-plus"></i></button>

                                            <div class="col-lg-3 md-form">
                                                <input type="text" name="menyetujui[]" id="menyetujui" class="form-control" required>
                                                <label class="iser" for="menyetujui">Menyetujui</label>
                                            </div>

                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-file"></i> 
                                            Submit</button>
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
        document.getElementById("page").innerHTML = "<a>Create Proposal</a>";
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

    var div = document.getElementById('div_ncr');
    function add_create() {
        
        var diver = document.createElement('div'),
        button = document.createElement('button');
      
        //input.placeholder = "More hobbies";
        diver.setAttribute("class", "col-lg-3 md-form");
        diver.innerHTML = '<input class="form-control" id="dibuat" name="dibuat[]" placeholder="Dibuat"></input>';
        //input.name = 'mouse[]';
        //input.id = 'id_mouse';
        
        button.setAttribute("class", "btn btn-sm btn-danger");
        button.innerHTML = '<i class="fa fa-minus"></i>';
        // attach onlick event handler to remove button
        button.onclick = remove_create;
      
        div.appendChild(diver);
        div.appendChild(button);
    }
    
    function remove_create() {
      // remove this button and its input
      div.removeChild(this.previousElementSibling);
      div.removeChild(this);
    }
    
    document.getElementById('p1').addEventListener('click', add_create);


    var div2 = document.getElementById('div_nkn');
    function add_know() {
        
        var diver = document.createElement('div'),
        button = document.createElement('button');
      
        //input.placeholder = "More hobbies";
        diver.setAttribute("class", "col-lg-3 md-form");
        diver.innerHTML = '<input class="form-control" id="diketahui" name="diketahui[]" placeholder="diketahui"></input>';
        //input.name = 'mouse[]';
        //input.id = 'id_mouse';
        
        button.setAttribute("class", "btn btn-sm btn-danger");
        button.innerHTML = '<i class="fa fa-minus"></i>';
        // attach onlick event handler to remove button
        button.onclick = remove_know;
      
        div2.appendChild(diver);
        div2.appendChild(button);
    }
    
    function remove_know() {
      // remove this button and its input
      div2.removeChild(this.previousElementSibling);
      div2.removeChild(this);
    }
    
    document.getElementById('p2').addEventListener('click', add_know);


    var div3 = document.getElementById('div_appr');
    function add_approve() {
        
        var diver = document.createElement('div'),
        button = document.createElement('button');
      
        //input.placeholder = "More hobbies";
        diver.setAttribute("class", "col-lg-3 md-form");
        diver.innerHTML = '<input class="form-control" id="menyetujui" name="menyetujui[]" placeholder="menyetujui"></input>';
        //input.name = 'mouse[]';
        //input.id = 'id_mouse';
        
        button.setAttribute("class", "btn btn-sm btn-danger");
        button.innerHTML = '<i class="fa fa-minus"></i>';
        // attach onlick event handler to remove button
        button.onclick = remove_approve;
      
        div3.appendChild(diver);
        div3.appendChild(button);
    }
    
    function remove_approve() {
      // remove this button and its input
      div3.removeChild(this.previousElementSibling);
      div3.removeChild(this);
    }
    
    document.getElementById('p3').addEventListener('click', add_approve);

</script>

</body>