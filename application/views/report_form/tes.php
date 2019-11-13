<html>
    <head>
        <style>
            .page_break2 { page-break-after: always; text-align:center;}

            @page {
                margin: 0cm 0cm;
            }

            table, td, th {  
                border: 1px solid #ddd;
                text-align: left;
                border:1px solid #dedede;
                padding: 1rem;
            }

            h1,h2,h3,h4,h5,table {
                font-family: Arial, Helvetica, sans-serif;
                font-size : 12px;
            }

            table {
                border-collapse: collapse;
                width: 100%;
            }
            .grey {
                background-color:#c6c9ce;
            }
            th, td {
                padding: 15px;
            }

            body {
                margin-top: 2cm;
                margin-left: 1cm;
                margin-right: 1cm;
                margin-bottom: 1cm;
            }

            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 1.5cm;
            }

            footer {
                position: fixed; 
                bottom: -10cm; 
                left: 0cm; 
                right: 0cm;
                height: 1.5cm;
            }

            .bottom-left {
            position: absolute;
            bottom: 12px;
            left: 16px;
            }

            .top-left {
            position: absolute;
            top: 8px;
            left: 16px;
            }

            .top-left2 {
            position: absolute;
            top: 28px;
            left: 16px;
            }

            .top-right {
            position: absolute;
            top: 5px;
            right: 80px;
            }

            .bottom-right {
            position: absolute;
            bottom: 10px;
            right: 16px;
            }

            .bottom-right2 {
            position: absolute;
            bottom: 15px;
            right: 16px;
            }
            
            .container {
                background-color:#64b5f6;
            }

            .white {
                color:white;
            }
            .grey {
                background-color:grey;
                color: white;
            }
            .grey2 {
                background-color: #a59675;
                color: white;
                text-align:center;
            }
        </style>
    </head>
    <body>
        <?php
        $q_pro = $this->db->query("
            select a.*, b.nama from project as a
            left join coordinator as b on a.kordinator = b.id
            where a.id='$id_project'
        ");

        $p_rows = $q_pro->row();

        $nama_project = $p_rows->nama_project;

        $status = $p_rows->status;
        
        if($status==1){
            $stat = '<h3 style="color:black;background-color:white;">NOT STARTED</h3>';
        }elseif($status==2){
            $stat = '<h3 style="color:black;background-color:white;">OPEN</h3>';
        }elseif($status==3){
            $stat = '<h3 style="color:black;background-color:white;">CANCEL</h3>';
        }elseif($status==4){
            $stat = '<h3 style="color:black;background-color:white;">CLOSED</h3>';
        }
        $prioritas = "<h3 style='background-color:white; color:black;'>".$p_rows->prioritas." PRIORITY</h3>";
        if($prioritas == 'GOLD'){
            $prior = 'gold.png';
        }elseif($prioritas == 'SILVER'){
            $prior = 'silver.png';
        }elseif($prioritas == 'BRONZE'){
            $prior = 'bronze.png';
        }
        $est_mulai = $p_rows->est_mulai;
        $est_selesai = $p_rows->est_selesai;
        $est_hari = $p_rows->est_hari;
        $est_budget = $p_rows->est_budget;
        $kordinator = $p_rows->nama;
        $used_budget = $p_rows->used_budget;

        //get id task 
        $q_gt = $this->db->query("
            select group_concat(id separator ',') as id_task from task where id_project = '$id_project'
        ");
        $id_task_concat = $q_gt->row()->id_task;

        //get resource ffrom task
        $q_resource = $this->db->query("
        select group_concat(a.res_internal separator ',') as res_internal, 
        group_concat(a.res_external) as res_external, 
        group_concat(DISTINCT b.nama_departemen) as nama_departemen 
        from task a 
        inner join departemen b on a.res_internal = b.id
        where a.id IN($id_task_concat)
        ");
        $res_int = $q_resource->row()->res_internal;
        $res_external = $q_resource->row()->res_external;
        $nama_departemen = $q_resource->row()->nama_departemen;
        //get progress
        $q_prog = $this->db->query("
        select distinct
        a.id_task,
        a.to_do as todo
        ,max(a.est_start) as est_start
        ,max(a.est_finish) as est_finish
        ,max(a.status) as status
        ,max(a.start) as start
        ,max(a.finish) as finish
        ,MAX(a.update_date) as latest_date, 
        b.pic, b.nama_task, c.nama
        
        from todo_history a
        
        left join task b
        on b.id = a.id_task
        
        left join coordinator c
        on c.id = b.pic
        
        where a.update_date between '0000-00-00' and '$date_to'
        and a.id_task in($id_task_concat) 
        group by a.to_do
        order by id_task asc;
        ");
        //get total todo    
        $q_ttd = $this->db->query("
        select count(id) as total_todo from todo where id_task IN($id_task_concat)
        ");
        $total_todo = $q_ttd->row()->total_todo;

        $full = 100/$total_todo;
        $half = 100/($total_todo*2);

        $progress = 0;
        foreach($q_prog->result() as $data){
            $status = $data->status;
            if($status == 1){
                $jml_prog = $half;
            }elseif($status == 2){
                $jml_prog = $full;
            }elseif($status == 0){
                $jml_prog = 0;
            }else{
                $jml_prog = 0;
            }
            
            $progress += $jml_prog;
        }

        $material_query = $this->db->query("
            select max(a.id_task) as id_task,a.nama_material,max(a.satuan) as satuan,
            max(a.est_jumlah) as est_jumlah, max(a.jumlah) as jumlah, max(a.est_harga) as est_harga,
            max(a.harga) as harga,  max(a.est_total_harga) as est_total_harga, max(a.total_harga) as total_harga,
            max(a.bpb) as bpb, max(a.update_date) as update_date, b.nama_satuan
            FROM material_history as a
            left join satuan b on a.satuan = b.id
            where a.id_task IN($id_task_concat) and a.update_date >= '0000-00-00' and a.update_date <= '$date_to' 
            group by a.nama_material;
        ");
        $estb = 0;
        $actb = 0;
        foreach($material_query->result() as $mymat){
            $estb += $mymat->est_total_harga;
            $actb += $mymat->total_harga;
        }

        //get est start dan finish
        $gsf = $this->db->query("
            select min(est_start) as est_start2, max(est_finish) as est_finish2,
            datediff(max(est_finish), min(est_start)) as tc_days
            from todo where id_task IN($id_task_concat);
        ");

        $emul = $gsf->row()->est_start2;
        $esel = $gsf->row()->est_finish2;
        $tc_days = $gsf->row()->tc_days;
        
        ?>
        <!-- Define header and footer blocks before your content -->
        <header class="container">
            <div class="top-left white"><b>PT. SIPATEX PUTRI LESTARI</b></div>
            <div class="top-left2 white">Project Management</div>
            <div class="top-right white">
            
            </div>
        </header>

        <footer class="container">
            <div class="bottom-left white"></div>
            <div class="bottom-right2 white"><b><?php echo date("d M Y");?> - <?php echo $this->session->userdata('name') ?></b></div>
            <div class="bottom-right white"></div>
        </footer>

            <div class="page_break2">
                <table>
                    <thead>
                        <tr>
                            <th class="grey2" colspan="4"><h3 style="font-family: Arial, Helvetica, sans-serif;">Project Status Report</h3></th>
                            <!--th class="grey2">
                            <img src="<?php echo base_url()?>image/status/<?php echo $stat;?>" alt="No Image" width="130" height="150">
                            </th>
                            <th class="grey2">
                            <img src="<?php echo base_url()?>image/rating/<?php echo $prior;?>" alt="No Image" width="130" height="150">
                            </th-->
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="background-color:#d8d3c7;">
                            <td>Project Name</td>
                            <td><?php echo $nama_project; ?></td>
                            <td>Report Date</td>
                            <td><?php echo date("d M Y",strtotime($date_to));?></td>
                        </tr>
                        <tr style="background-color:#d8d3c7;">
                            <td>Schedule</td>
                            <td><?php echo date("d M Y",strtotime($emul)). " s/d " .date("d M Y",strtotime($esel)). " </br>[$tc_days Hari]" ?></td>
                            <td>Est Budget</td>
                            <td>Rp. <?php echo number_format($estb,2,',','.'); ?></td>
                        </tr>
                        <tr style="background-color:#d8d3c7;">
                            <td>Resource</td>
                            <td><?php echo $nama_departemen?></td>
                            <td>Act Budget</td>
                            <td>Rp. <?php echo number_format($actb,2,',','.')?></td>
                        </tr>
                        <tr style="background-color:#d8d3c7;">
                            <td>Coordinator</td>
                            <td><?php echo $kordinator;?></td>
                            <td>Progress</td>
                            <td><?php echo round($progress);?> %</td>
                        </tr>
                        <tr style="background-color:#d8d3c7;">
                            <td colspan="2" style="text-align:center;"><?php echo $stat;?></td>
                            <td colspan="2" style="text-align:center;"><?php echo $prioritas;?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <!-- Wrap the content of your PDF inside a main tag -->

            <div class="">
                <!-- Table Task-->
                <?php
                $cek_record = $this->db->query("
                    select a.*, b.nama_departemen from 
                    task a
                    left join departemen b
                    on a.res_internal = b.id
                    where id_project = '$id_project'
                    
                    order by 
                    CASE
                        WHEN a.est_start IS NULL THEN a.start
                        ELSE a.est_start
                    END   
                    asc;           
                ");

                $no = 1;

                foreach($cek_record->result() as $data1){
                    //echo $data1->id;
                    
                    echo '
                    <div class="page_break2">
                    <table>
                        <thead style="color:red;background-color:#f2ebdc;">
                            <tr>
                                <th>
                                    <th colspan="7" style="text-align:center;">'.$no.'. '.$data1->nama_task.' - ['.$data1->bobot.' %] 
                                    <br> <p>'.$data1->nama_departemen.'</p>
                                    <p>'.$data1->res_external.'</p>
                                    </th>
                                </th>
                            </tr>
                            <tr>
                                <th>No</th>
                                <th>Todo Name</th>
                                <th>Plan Start</th>
                                <th>Actual Start</th>
                                <th>Plan Finish</th>
                                <th>Actual Finish</th>
                                <th>PIC</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody style="background-color:#f2ebdc;">
                    ';

                        $idt_cr = $data1->id;

                        $q_prog2 = $this->db->query("
                            select distinct
                            max(a.id_task) as id_task,
                            a.to_do as todo
                            ,max(a.est_start) as est_start
                            ,max(a.est_finish) as est_finish
                            ,max(a.status) as status
                            ,max(a.start) as start
                            ,max(a.finish) as finish
                            ,MAX(a.update_date) as latest_date, 
                            b.pic, b.nama_task, c.nama
                            
                            from todo_history a
                            
                            left join task b
                            on b.id = a.id_task
                            
                            left join coordinator c
                            on c.id = b.pic
                            
                            where a.update_date between '0000-00-00' and '$date_to'
                            and a.id_task = '$idt_cr'
                            group by a.to_do
                            order by 
                                CASE
                                    WHEN a.est_start IS NULL THEN a.`start`
                                    ELSE a.est_start
                                END 
                            asc
                        ");
                
                        foreach($q_prog2->result() as $dt_todo){

                            if($dt_todo->est_start == NULL || $dt_todo->est_start == "" || $dt_todo->est_start == "0000-00-00"){
                                $est_start = "Not Estimated";
                                $mark = "*";
                            }else{
                                $est_start = date("d M Y",strtotime($dt_todo->est_start));
                                $mark = "";
                            }
                            if($dt_todo->start == NULL || $dt_todo->start == "" || $dt_todo->start == "0000-00-00"){
                                $start = "-";
                            }else{
                                $start = date("d M Y",strtotime($dt_todo->start));
                            }
                            if($dt_todo->est_finish == NULL || $dt_todo->est_finish == "" || $dt_todo->est_finish == "0000-00-00"){
                                $est_finish = "Not Estimated";
                            }else{
                                $est_finish = date("d M Y",strtotime($dt_todo->est_finish));
                            }
                            if($dt_todo->finish == NULL || $dt_todo->finish == "" || $dt_todo->finish == "0000-00-00"){
                                $finish = "-";
                            }else{
                                $finish = date("d M Y",strtotime($dt_todo->finish));
                            }
                            if($dt_todo->status == 0){
                                $stat = "Not Started";
                            }elseif($dt_todo->status == 1){
                                $stat = "Started";
                            }elseif($dt_todo->status == 2){
                                $stat = "Finish";
                            }

                            echo '
                            <tr>
                                <td>'.$mark.'</td>
                                <td>'.$dt_todo->todo.'</td>
                                <td>'.$est_start.'</td>
                                <td>'.$start.'</td>
                                <td>'.$est_finish.'</td>
                                <td>'.$finish.'</td>
                                <td>'.$dt_todo->nama.'</td>
                                <td>'.$stat.'</td>
                            </tr>
                            ';
                        }
                    echo '
                    <tr>
                        <td colspan="4" style="text-align:center;">Comment</td>
                        <td colspan="4">'.$data1->comment_todo.'</td>
                    </tr>
                    ';
                    echo '
                        </tbody>
                    </table>
                    </div>  
                    ';
                    $no++;
                }
                ?>
                <!-- Table Material-->
            </div>
            
            <div class="">
                <?php
                $cek_record2 = $this->db->query("
                    select id,nama_task,bobot from task where id_project = '$id_project'            
                ");
                $no = 1;
                foreach($cek_record2->result() as $data2){
                    echo '
                    <div class="page_break2">
                    <table>
                        <thead style="color:orange;background-color:#f2ebdc;">
                            <tr>
                                <th>'.$no.'</th>
                                <th>'.$data2->nama_task.' - ['.$data2->bobot.' %]</th>
                                <th>Est QTY</th>
                                <th>Act QTY</th>
                                <th>Est Price</th>
                                <th>Act Price</th>
                                <th>Unit</th>
                                <th>Status</th>
                                <th>Est Budget</th>
                                <th>Act Budget</th>
                                <th>Percentage</th>
                            </tr>
                        </thead>
                        <tbody style="background-color:#f2ebdc;">
                    ';
                    $idt_foreach2 = $data2->id;

                    $m_progress = $this->db->query("
                        select max(a.id_task) as id_task,a.nama_material,max(a.satuan) as satuan,
                        max(a.est_jumlah) as est_jumlah, max(a.jumlah) as jumlah, max(a.est_harga) as est_harga,
                        max(a.harga) as harga,  max(a.est_total_harga) as est_total_harga, max(a.total_harga) as total_harga,
                        max(a.bpb) as bpb, max(a.update_date) as update_date, b.nama_satuan
                        FROM material_history as a
                        left join satuan b on a.satuan = b.id
                        where a.id_task = '$idt_foreach2' and a.update_date >= '0000-00-00' and a.update_date <= '$date_to' 
                        group by a.nama_material;
                    ");

                    foreach($m_progress->result() as $rec){
                        if($rec->bpb == NULL || $rec->bpb == ""){
                            $stat = 'Not Ready';
                        }else{
                            $stat = 'Ready';
                        }
                        if($rec->total_harga == "" || $rec->total_harga == NULL || $rec->total_harga == 0){
                            $persen = '0';
                        }elseif($rec->est_total_harga == "" || $rec->est_total_harga == NULL || $rec->est_total_harga == 0){
                            $persen = '0';
                        }else{
                            $persen = round(($rec->total_harga/$rec->est_total_harga)*100);
                        }

                        $cek = $rec->est_jumlah;
                        if($cek == NULL || $cek == "" || $cek == 0){
                            $seon = '*';
                        }else{
                            $seon = '';
                        }
                        echo '
                        <tr>
                            <td>'.$seon.'</td>
                            <td>'.$rec->nama_material.'</td>
                            <td>'.$rec->est_jumlah.'</td>
                            <td>'.$rec->jumlah.'</td>
                            <td>'.number_format($rec->est_harga,2,',','.').'</td>
                            <td>'.number_format($rec->harga,2,',','.').'</td>
                            <td>'.$rec->nama_satuan.'</td>
                            <td>'.$stat.'</td>
                            <td>'.number_format($rec->est_total_harga,2,',','.').'</td>
                            <td>'.number_format($rec->total_harga,2,',','.').'</td>
                            <td>'.$persen.' %</td>
                        </tr>
                        ';
                    }
                    echo '
                    <tr>
                        <td colspan="4" style="text-align:center;">Comment</td>
                        <td colspan="7">'.$data1->comment_material.'</td>
                    </tr>
                    ';
                    echo '
                        </tbody>
                    </table>
                    </div>
                    ';
                    $no++;
                    
                }
                ?>
            </div>

            <div>
                <table>
                    <thead style="color:#42d1f4;background-color:#f2ebdc;">
                        <tr>
                            <th colspan="3">Rating Project</th>
                        </tr>
                        <tr>
                            <th style="text-align:center;">Benchmark</th>
                            <th style="text-align:center;">Rating</th>
                            <th style="text-align:center;">Comment</th>
                        </tr>
                    </thead>
                    <tbody style="background-color:#f2ebdc;">
                        <?php
                            $qrp = $this->db->query("
                            select * from rating where id_project = '$id_project'
                            ");
                            if($qrp->num_rows() < 1){
                                echo '
                                <tr>
                                    <td style="text-align:center;background-color:red;color:white;font-weight:bold;" colspan="3">Not Rated Yet</td>
                                </tr>
                                ';
                            }else{
                                
                                foreach($qrp->result() as $rate){
                                    if($rate->rate == 'Happy'){
                                        $imgr = 'smile2.png';
                                    }elseif($rate->rate == 'Neutral'){
                                        $imgr = 'meh2.png';
                                    }elseif($rate->rate == 'Upset'){
                                        $imgr = 'angry2.png';
                                    }

                                    echo '
                                    <tr>
                                        <td style="text-align:center;">'.$rate->tolak_ukur.'</td>
                                        <td style="text-align:center;"><img src="'.base_url().'image/rate/'.$imgr.'" height="100" width="100"></td>
                                        <td style="text-align:center;">'.$rate->comment.'</td>
                                    </tr>
                                    ';
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>

            
        <main>

    </body>
</html>
