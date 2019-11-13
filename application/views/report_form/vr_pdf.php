<title>
Report All Project
</title>

<style>
    .page_break2 { page-break-after: always; text-align:center;border:1px 1px 1px 1px solid black;}

    @page {
        margin: 0cm 0cm;
    }

    h1,h2,h3,h4,h5,table {
        font-family: Arial, Helvetica, sans-serif;
        font-size : 12px;
    }

    table, td, th {  
    border: 1px solid #ddd;
    text-align: left;
    border:1px solid #dedede;
    padding: 1rem;
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
        margin-top: 3cm;
        margin-left: 2cm;
        margin-right: 2cm;
        margin-bottom: 2cm;
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
    top: 20px;
    right: 20px;
    font-weight:bold;
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

<!-- Define header and footer blocks before your content -->
        <header class="container">
            <div class="top-left white"><b>PT. SIPATEX PUTRI LESTARI</b></div>
            <div class="top-left2 white">Project Management</div>
            <div class="top-right white">
            <?php
                if($status == 'all'){
                    echo 'All Project Report';
                }elseif($status == '1'){
                    echo 'Not Started Project Report';
                }elseif($status == '2'){
                    echo 'Started Project Report';
                }elseif($status == '3'){
                    echo 'Cancel Project Report';
                }elseif($status == '4'){
                    echo 'Close Project Report';
                }
            ?>
            </div>
        </header>

        <footer class="container">
            <div class="bottom-left white"></div>
            <div class="bottom-right2 white"><b><?php echo date("d M Y");?> - <?php echo $this->session->userdata('name') ?></b></div>
            <div class="bottom-right white"></div>
        </footer>

        <?php
            if($status == 'all'){
                $query = $this->db->query("select a.*,b.nama as nama_kordinator from project as a left join coordinator as b on a.kordinator = b.id");
            }else{
                $query = $this->db->query("select a.*,b.nama as nama_kordinator from project as a left join coordinator as b on a.kordinator = b.id where a.status = '$status'");
            }
            
            if($query->num_rows() < 1){
                echo '
                No Data !
                ';
            }else{
                $no = 1;
                foreach($query->result() as $data){
                    $id_project = $data->id;

                    $task = $this->db->query("
                        select id as id_task from task where id_project = '$id_project'
                    ");
                    
                    $idt = array();

                    foreach($task->result() as $data_task){
                        $idt[] = $data_task->id_task;
                    }

                    $id_task = implode(',',$idt);

                    $idtask = $task->row()->id_task;

                    $qt = $this->db->query("
                        select min(start) as start, max(finish) as finish, DATEDIFF(max(finish),min(start)) as hari from todo_history where id_task IN($idtask);
                    ");


                    if($id_task != NULL){

                        $a = $this->db->query("
                            select count(id) as idtd from todo where id_task IN($id_task)
                        ");

                        $b = "";

                        foreach($a->result() as $c){
                            $b .= $c->idtd;
                        }

                        $ttd = $b;
                        $max = 100/$ttd;
                        $min = (100/$ttd)/2;

                        $q_todo = $this->db->query("
                            select status from todo where id_task IN($id_task)
                        ");

                        $z = 0;
                        $percen = 0;

                        foreach($q_todo->result() as $data_todo){
                            $std = $data_todo->status; 
                            if($std == 1){
                                $percen = $min;
                            }elseif($std == 2){
                                $percen = $max;
                            }elseif($std == 0){
                                $percen = 0;
                            }
                            //echo $std;
                            $z += $percen;
                        }
                        
                        $progress = round($z);
                        
                    }else{

                    }

                    $nm_project = $data->nama_project;
                    $kategori = $data->kategori;
                    $tujuan = $data->purpose;
                    
                    if($qt->row()->start == NULL){
                        $start = "Not Started Yet";
                    }else{
                        $start = date("d M Y",strtotime($data->mulai));
                    }

                    $fd = $data->selesai;

                    if($qt->row()->finish == NULL || $qt->row()->finish == "" || $qt->row()->finish == "0000-00-00"){
                        $end = 'Not Finish Yet';
                    }else{
                        $end = date("d M Y",strtotime($qt->row()->finish));
                    }  

                    $dr = $data->hari;

                    if($qt->row()->hari == NULL || $qt->row()->hari == ""){
                        $range = "";
                    }else{
                        $range = $qt->row()->hari." Days";
                    }
                    
                    $loc = $data->lokasi;
                    $coor = $data->nama_kordinator;
                    $status = $data->status;
                    if($status == 1){
                        $stat = "Not Started";
                    }elseif($status == 2){
                        $stat = "Started";
                    }elseif($status == 3){
                        $stat = "Cancel";
                    }elseif($status == 4){
                        $stat = "Closed";
                    }

                    $scat = $this->db->query("select nama_kategori from kategori where id IN($kategori)");
                    $cat = "";
                    foreach($scat->result() as $data1){
                        $cat .= $data1->nama_kategori.",";
                    }
                    echo '
                    <div class="page_break2">
                    ';
                    echo '
                    <h2>'.$no.'. '.$nm_project.' ('.$progress.'% Finish)</h2>
                    <h3>'.$str = trim($cat, ", ").' </h3>
                    
                    <p>'.$start.' - '.$end.' ['.$range.']</p>
                    <p>'.$loc.'</p>
                    <p>'.$coor.'</p>
                    '.$tujuan.'
                    ';
                    echo '</div>';
                    $no++;
                }
            }    
        ?>