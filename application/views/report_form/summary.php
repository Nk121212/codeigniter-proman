<style>
    canvas {
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
    .chart-container {
        width: 500px;
        margin-left: 40px;
        margin-right: 40px;
    }
    .container {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: center;
    }
    table, td, th {  
    padding: 1rem;
    }

    table {
    border-collapse: collapse;
    width: 98%;
    }
    .baris{
        height:23px !important;
        background-color:#6280af !important;
        width:98%;
    }
    #print_this{
        width:100% !important;
        background-color:white;
    }
    .enter_top{
        margin-top:20px;
    }
</style>
<body class="fixed-sn black-skin">
<!--Main layout-->
<main>
    <div class="container-fluid">
        <!--Section: Intro-->

        <div style="height: 35px"></div>
        <!--Section: Main panel-->
        <section>

                <div class="panel-group">
                    <div class="card-header white-text info-color">

                        <div class="panel-heading in">
                            <div class="row">

                                <div class="col-lg-6 md-form">
                                    <a class="btn btn-outline btn-rounded">
                                        Summary Project
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

                            <div class="col-sm-6 md-form">
                                <select name="idp" id="idp" class="mdb-select md-form colorful-select dropdown-primary">
                                    <?php
                                    echo '<option value="" disabled selected>Choose Project</option>';
                                    $q = $this->db->query("
                                        select * from project WHERE mulai IS NOT NULL
                                    ");
                                    foreach($q->result() as $data){
                                        echo '
                                        <option value="'.$data->id.'">'.$data->nama_project.'</option>
                                        ';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div id="print_this">
                                    <table border="0">
                                        <tr>
                                            <th></th>
                                        </tr>
                                    </table>

                                <div class="row">

                                    <div class="col-sm-4 print" style="text-align:center;">
                                        <img src="<?php echo base_url();?>image/logo_web/proman.jpg" alt="No Image" width="150" height="150">
                                        <p style="font-size:30px;color:#2690D4;text-shadow: 2px 2px black;font-weight:bold;"><b>PROJECT MANAGEMENT</b></p>
                                    </div>

                                    <div class="col-sm-8 print" style="text-align:center;">

                                        <table>
                                            <thead>
                                                <tr>
                                                    <th style="font-weight:bold;border-left:1px solid #6280af;border-bottom:1px solid #6280af;" id="nmp">Nama Project</th>
                                                    <th style="font-weight:bold;border-bottom:1px solid #6280af;" colspan="3" id="nmp"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr style="border-left:1px solid #6280af;">
                                                    <td style="font-weight:bold;">Location</td>
                                                    <td style="font-weight:bold;" id="loc"></td> 
                                                    <td style="font-weight:bold;">Status</td> 
                                                    <td style="font-weight:bold;" id="stat"></td>
                                                </tr>
                                                <tr style="border-left:1px solid #6280af;">
                                                    <td style="font-weight:bold;">Coordinator</td>
                                                    <td style="font-weight:bold;" id="pic"></td>
                                                    <td style="font-weight:bold;">Priority</td>
                                                    <td style="font-weight:bold;" id="prioritas"></td>
                                                </tr>
                                                <tr style="border-left:1px solid #6280af; border-bottom:1px solid #6280af;">
                                                    <td style="font-weight:bold;">Percent Complete</td>
                                                    <td style="font-weight:bold;" id="progress"></td>
                                                    <td style="font-weight:bold;">Date</td>
                                                    <td style="font-weight:bold;"><?php date_default_timezone_set("Asia/Jakarta"); echo date("d M Y");?></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>

                                </div>

                                <div class="baris print">
                                    <p style="margin-left:5px;font-weight:bold;color:white;">PROJECT SUMMARY REPORT</p>
                                </div>

                                <table class="enter_top print" border="0" style="border-bottom:1px solid #6280af;">
                                    <tr>
                                        <th style="border-right:1px solid #6280af;" id="est_budget"></th>
                                        <th style="border-right:1px solid #6280af;" id="est_start"></th>
                                        <th style="border-right:1px solid #6280af;" id="act_start"></th>
                                        <th id="res_int"></th>
                                    </tr>
                                    
                                    <tr> 
                                        <th style="border-right:1px solid #6280af;" id="act_budget"></th>
                                        <th style="border-right:1px solid #6280af;" id="est_finish"></th>
                                        <th style="border-right:1px solid #6280af;" id="act_finish"></th>
                                        <th id="res_ext"></th>
                                    </tr>
                                </table>
                                <br>

                                <div class="baris print">
                                    <p style="margin-left:5px;font-weight:bold;color:white;">PROGRESS CHART</p>
                                </div>

                                    
                                <div class="col-lg-12 print" id="chart_div">
                                    <canvas id="chart-legend-normal"></canvas>
                                </div>

                            </div>

                            <div id="dt_task">
                                    
                            </div>
                            
                            
                            <button id="pdf" class="btn btn-danger print"><i class="fa fa-file-pdf-o"></i> Print Graphic</button>


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

<script type="text/javascript" src="<?php echo base_url();?>jspdf/html2canvas.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>jspdf/jspdf.debug.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/chart.bundle.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/chart.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/utils.js"></script>

<!--Initializations-->

<script>
$(document).ready(function(){
    document.getElementById("page").innerHTML = "Grafik Progress";
    $(".print").hide();
})


    $("#pdf").click(function(){
        var doc = new jsPDF("p", "pt", "a4");
        doc.addHTML($('#print_this')[0], 15, 15, {
            pagesplit: false
        }, function() {
        doc.save("Summary_<?php echo date("d M Y");?>.pdf");
        });
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

    $("#idp").change(function(){
        $(".print").show();

        $('#chart-legend-normal').remove(); // this is my <canvas> element
        $('#chart_div').append('<canvas id="chart-legend-normal"></canvas>');

        var id_project = $("#idp").val();
        //alert(id_project);.
        $.ajax({  
            url: "<?php echo base_url(); ?>" + "c_summary/index",
            method:"POST",
            data:{id_project:id_project},  
                success:function(resp){

                    $.ajax({  
                        url: "<?php echo base_url(); ?>" + "c_summary/data_project",
                        method:"POST",
                        data:{id_project:id_project},  
                            success:function(resp2){
                                //console.log(resp2);
                                
                                $.ajax({  
                                    url: "<?php echo base_url(); ?>" + "c_summary/data_task",
                                    method:"POST",
                                    data:{id_project:id_project},  
                                        success:function(resp3){

                                            if(!resp3 || !resp2 || !resp){
                                                console.log("No response");
                                            }else{
                                                console.log("ada response");
                                            }

                                            var arr = [];
                                                for (i = 1; i <= resp.length; ++i) {
                                                    var x = arr.push('wk '+i);
                                                }
                                                console.log(arr);
                                                var a = resp;

                                                var ctx = document.getElementById('chart-legend-normal').getContext('2d');
                                                new Chart(ctx, {
                                                    type: 'bar',
                                                    data: {
                                                        labels: arr,
                                                        datasets: [{
                                                            label: 'Progress',
                                                            data: a,
                                                            backgroundColor: '#71cce8',
                                                            borderColor: '#cdedf7',
                                                            borderWidth: 1,
                                                            pointStyle: 'rectRot',
                                                            pointRadius: 5,
                                                            pointBorderColor: '#0b637f'
                                                        }]
                                                    },
                                                    options: {
                                                        responsive: true,
                                                        legend: {
                                                            labels: {
                                                                usePointStyle: false
                                                            }
                                                        },
                                                        scales: {
                                                            xAxes: [{
                                                                display: true,
                                                                scaleLabel: {
                                                                    display: true,
                                                                    labelString: 'Weeks'
                                                                }
                                                            }],
                                                            yAxes: [{
                                                                display: true,
                                                                scaleLabel: {
                                                                    display: true,
                                                                    labelString: 'Percentage %'
                                                                }
                                                            }]
                                                        },
                                                        title: {
                                                            display: true,
                                                            text: ''
                                                        }
                                                    }
                                                });

                                            $("#dt_task").html(resp3);
                                            var a = resp2[0].lokasi;
                                            var b = resp2[0].status;
                                            var c = resp2[0].pic;
                                            var d = resp2[0].prioritas;
                                            var e = resp2[0].progress;

                                            var f = resp2[0].estb;
                                            var g = resp2[0].ests;
                                            var h = resp2[0].start;
                                            var i = resp2[0].actb;
                                            var j = resp2[0].estf;
                                            var k = resp2[0].finish;
                                            var l = resp2[0].resint;
                                            var m = resp2[0].resext;

                                            document.getElementById("nmp").innerHTML = resp2[0].nm_pro;    
                                            document.getElementById("loc").innerHTML = a;
                                            document.getElementById("stat").innerHTML = b;
                                            document.getElementById("pic").innerHTML = c;
                                            document.getElementById("prioritas").innerHTML = d;
                                            document.getElementById("progress").innerHTML = e+' %';

                                            document.getElementById("est_budget").innerHTML = 'Estimate Budget - Rp. '+f;
                                            document.getElementById("est_start").innerHTML = 'Plan Start - '+g;
                                            document.getElementById("act_start").innerHTML = 'Actual Start - '+h;
                                            document.getElementById("act_budget").innerHTML = 'Actual Budget - Rp. '+i;
                                            document.getElementById("est_finish").innerHTML = 'Plan Finish - '+j;
                                            document.getElementById("act_finish").innerHTML = 'Actual Finish - '+k;
                                            document.getElementById("res_int").innerHTML = 'Resource Internal - '+l;
                                            document.getElementById("res_ext").innerHTML = 'Resource External - '+m;

                                            console.log(resp);
                                            console.log(resp2);
                                            console.log(resp3);
                                            $(".print").show();


                                        }
                                }) 


                            }
                    })        
                    
                    /*
                    
                    */
                }
            });

    })  

</script>

</body>