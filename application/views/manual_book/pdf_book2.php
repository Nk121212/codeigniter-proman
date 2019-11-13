<style>
.enter {
    margin-top:10px;
}
.pointer{
    border-radius:25px;
}
</style>
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

                        </div>

                        <div class="card collapse show" id="collapseExample2">

                            <div class="card-body">
                                
                                <div id="div_s1" class="col-lg-12 md-form">

                                    <div align="center" class="text-white info-color">
                                        <p><strong style="font-size:30px;">1. Estimasi Project</strong></p>
                                    </div>
                                
                                    <div class="row">

                                        <div class="col-lg-6 md-form">
                                            
                                            <div align="center">
                                                <img src="<?php echo base_url();?>image/manual_book/estimasi/create_project.png" width="100%" height="100%" class="img-fluid " alt="smaple image">
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">

                                            <div class="col-lg-12 md-form">
                                                <p><strong>1.</strong> Pilih Menu <strong>New Project</strong> lalu pilih opsi <strong>Create Project</strong></p>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form"> 

                                            <div class="view overlay zoom pointer">
                                                <img src="<?php echo base_url();?>image/manual_book/estimasi/create_project2.png" class="img-fluid " alt="smaple image" width="100%" height="100%">
                                                <div class="mask flex-center">
                                                    <p class="white-text"></p>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="col-lg-12 md-form">
                                                <p><strong>2.</strong> Input Nama Project, Pilih Category (* Bisa Pilih Semua), Purpose (* Bisa Gambar)</p>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="view overlay zoom pointer">
                                                <img src="<?php echo base_url();?>image/manual_book/estimasi/create_project3.png" class="img-fluid " alt="smaple image" width="100%" height="100%">
                                                <div class="mask flex-center">
                                                    <p class="white-text"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="col-lg-12 md-form">
                                                <p><strong>3.</strong> 
                                                    Pilih Coordinator/PIC lalu pilih Complexity (* Bisa pilih semua) , Pilih Lokasi Project (* Bisa Input Manual), 
                                                    Pilih Resource (* Bisa Pilih Semua), Upload Gambar (* Bisa Kosong).
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="view overlay zoom pointer">
                                                <img src="<?php echo base_url();?>image/manual_book/estimasi/detail_project2.png" class="img-fluid " alt="smaple image" width="100%" height="100%">
                                                <div class="mask flex-center">
                                                    <p class="white-text"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="col-lg-12 md-form">
                                                <p><strong>4.</strong> 
                                                    Setelah input detail project di save halaman akan otomatis di arahkan ke halaman view all project.
                                                    Disini karena project memerlukan task maka pilih button add task !
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="view overlay zoom pointer">
                                                <img src="<?php echo base_url();?>image/manual_book/estimasi/task_insert.png" class="img-fluid " alt="smaple image" width="100%" height="100%">
                                                <div class="mask flex-center">
                                                    <p class="white-text"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="col-lg-12 md-form">
                                                <p><strong>5.</strong> 
                                                    Input Nama Task, PIC, Resource Internal, 
                                                    Resource External, (* Input Resource Internal Tidak akan muncul jika pada input detail project (langkah no. 1) 
                                                    Resource hanya memilih resource external saja dan begitupun sebaliknya).
                                                    Upload foto (* boleh kosong). Setelah di input data task akan muncul pada tabel sebelah kanan layar.
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="view overlay zoom pointer">
                                                <img src="<?php echo base_url();?>image/manual_book/estimasi/view_task.png" class="img-fluid " alt="smaple image" width="100%" height="100%">
                                                <div class="mask flex-center">
                                                    <p class="white-text"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="col-lg-12 md-form">
                                                <p><strong>6.</strong> 
                                                    Setelah semua task selesai di input, kembali ke halaman view all project (* bisa klik tulisan <strong>All Project</strong> pada taskbar).
                                                    Lalu klik view task untuk memasukan data material dan todolist yang akan dikerjakan pada task tersebut.
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="view overlay zoom pointer">
                                                <img src="<?php echo base_url();?>image/manual_book/estimasi/add_material.png" class="img-fluid " alt="smaple image" width="100%" height="100%">
                                                <div class="mask flex-center">
                                                    <p class="white-text"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="col-lg-12 md-form">
                                                <p><strong>7.</strong> 
                                                    Pada menu view task pilih button add material untuk menambahkan data material yang akan digunakan
                                                    (* acuan budgeting plan).
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="view overlay zoom pointer">
                                                <img src="<?php echo base_url();?>image/manual_book/estimasi/add_material2.png" class="img-fluid " alt="smaple image" width="100%" height="100%">
                                                <div class="mask flex-center">
                                                    <p class="white-text"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="col-lg-12 md-form">
                                                <p><strong>8.</strong> 
                                                    Klik Button Add Material
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="view overlay zoom pointer">
                                                <img src="<?php echo base_url();?>image/manual_book/estimasi/add_material3.png" class="img-fluid " alt="smaple image" width="100%" height="100%">
                                                <div class="mask flex-center">
                                                    <p class="white-text"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="col-lg-12 md-form">
                                                <p><strong>9.</strong> 
                                                    Input nama material (* bisa pilih pada input box material jika material sudah ada 
                                                    (** Silakan Pilih Data material paling atas jika data sudah ada)),
                                                    jika data material sudah ada maka ketika nama material tersebut dipilih
                                                    data satuan dan harga akan otomatis terisi, jika belum ada bisa di inputkan manual semua.
                                                    Setelah semua material yg akan digunakan selesai di inputkan semua,
                                                    silakan kembali ke menu view task (* Bisa klik tulisan <strong>View Task</strong> pada taskbar).
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="view overlay zoom pointer">
                                                <img src="<?php echo base_url();?>image/manual_book/estimasi/todolist.png" class="img-fluid " alt="smaple image" width="100%" height="100%">
                                                <div class="mask flex-center">
                                                    <p class="white-text"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="col-lg-12 md-form">
                                                <p><strong>10.</strong> 
                                                    Pilih Tombol <strong>Add Todo</strong> untuk masuk ke menu add todolist.
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                    
                                </div>
                                

                                <div id="div_s2" class="col-lg-12 md-form">

                                    <div align="center" class="text-white info-color">
                                        <p><strong style="font-size:30px;">2. Estimasi Project</strong></p>
                                    </div>

                                    <div class="row">

                                        <div class="col-lg-6 md-form">
                                                <div class="view overlay zoom pointer">
                                                    <img src="<?php echo base_url();?>image/manual_book/estimasi/todolist3.png" class="img-fluid " alt="smaple image" width="100%" height="100%">
                                                    <div class="mask flex-center">
                                                        <p class="white-text"></p>
                                                    </div>
                                                </div>
                                            </div>
                                    
                                        <div class="col-lg-6 md-form">
                                                <div class="col-lg-12 md-form">
                                                    <p><strong>11.</strong> 
                                                        Klik Tombol Add Todo untuk menambahkan todolist yg akan dilakukan.
                                                        Input Nama Todo, tanggal mulai dan tanggal selesai. 
                                                        setelah di input data yg dimasukan akan tampil pada tabel 
                                                        di menu tersebut. Setelah selesai input semua todolist yang akan dikerjakan
                                                        silakan kembali ke menu view all project (* Bisa Klik Tulisan <strong>All Project</strong> 
                                                        pada taskbar diatas).
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 md-form">
                                                <div class="view overlay zoom pointer">
                                                    <img src="<?php echo base_url();?>image/manual_book/estimasi/proposal.png" class="img-fluid " alt="smaple image" width="100%" height="100%">
                                                    <div class="mask flex-center">
                                                        <p class="white-text"></p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 md-form">
                                                <div class="col-lg-12 md-form">
                                                    <p><strong>12.</strong> 
                                                        Setelah semua detail project selesai di input, anda bisa membuat proposal
                                                        pengajuan dengan mengklik tombol <strong>create proposal</strong> (* tombol biru diatas).
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 md-form">
                                                <div class="view overlay zoom pointer">
                                                    <img src="<?php echo base_url();?>image/manual_book/estimasi/proposal2.png" class="img-fluid " alt="smaple image" width="100%" height="100%">
                                                    <div class="mask flex-center">
                                                        <p class="white-text"></p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 md-form">
                                                <div class="col-lg-12 md-form">
                                                    <p><strong>13.</strong> 
                                                        pada halaman ini pilih project yang akan dibuat proposal,
                                                        (* project yang sudah di kick off / berjalan tidak akan tampil pada menu ini) !
                                                        Input Nama yang membuat, yang mengetahui, dan yang menyetujui, lalu klik submit
                                                        setelah itu halaman akan di redirect ke halaman view proposal (* pdf view). 
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 md-form">
                                                <div class="view overlay zoom pointer">
                                                    <img src="<?php echo base_url();?>image/manual_book/estimasi/kick_off.png" class="img-fluid " alt="smaple image" width="100%" height="100%">
                                                    <div class="mask flex-center">
                                                        <p class="white-text"></p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 md-form">
                                                <div class="col-lg-12 md-form">
                                                    <p><strong>14.</strong> 
                                                        Setelah proposal disetujui silakan pilih menu <strong>Kick Off Project</strong>.
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 md-form">
                                                <div class="view overlay zoom pointer">
                                                    <img src="<?php echo base_url();?>image/manual_book/estimasi/kick_off3.png" class="img-fluid " alt="smaple image" width="100%" height="100%">
                                                    <div class="mask flex-center">
                                                        <p class="white-text"></p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 md-form">
                                                <div class="col-lg-12 md-form">
                                                    <p><strong>15.</strong> 
                                                        Pada Menu Kick Off Project akan tampil semua project yang belum di kick off,
                                                        sebelum di kick off, anda dapat melihat data-data yang sebelumnya di input
                                                        apakah sudah sesuai atau belum, dengan mengklik View Data (* Tombol Orange).
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 md-form">
                                                <div class="view overlay zoom pointer">
                                                    <img src="<?php echo base_url();?>image/manual_book/estimasi/finish_est.png" class="img-fluid " alt="smaple image" width="100%" height="100%">
                                                    <div class="mask flex-center">
                                                        <p class="white-text"></p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 md-form">
                                                <div class="col-lg-12 md-form">
                                                    <p><strong>16.</strong> 
                                                        Jika data sudah sesuai semua silakan kembali ke menu kick off project, 
                                                        lalu klik Finish Estimasi (* Tombol Biru). 
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 md-form">
                                                <div class="view overlay zoom pointer">
                                                    <img src="<?php echo base_url();?>image/manual_book/estimasi/finish_est2.png" class="img-fluid " alt="smaple image" width="100%" height="100%">
                                                    <div class="mask flex-center">
                                                        <p class="white-text"></p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 md-form">
                                                <div class="col-lg-12 md-form">
                                                    <p><strong>17.</strong> 
                                                        setelah di klik tombol finish estimasi akan keluar popup, lalu klik Save Changes.
                                                        Project Selesai di estimasi / Planning.
                                                    </p>
                                                </div>
                                            </div>

                                    </div>
                                    
                                </div>

                                <div id="div_s3" class="col-lg-12 md-form">

                                    <div align="center" class="text-white info-color">
                                        <p><strong style="font-size:30px;">3. Actual Project</strong></p>
                                    </div>

                                    <div class="row">
                                        
                                        <div class="col-lg-6 md-form">
                                            <div class="view overlay zoom pointer">
                                                <img src="<?php echo base_url();?>image/manual_book/actual/update_task.png" class="img-fluid " alt="smaple image" width="100%" height="100%">
                                                <div class="mask flex-center">
                                                    <p class="white-text"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="col-lg-12 md-form">
                                                <p><strong>18.</strong> 
                                                    Pada menu update task anda bisa menambah task / mengedit task yang sudah ada.
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="view overlay zoom pointer">
                                                <img src="<?php echo base_url();?>image/manual_book/actual/update_task3.png" class="img-fluid " alt="smaple image" width="100%" height="100%">
                                                <div class="mask flex-center">
                                                    <p class="white-text"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="col-lg-12 md-form">
                                                <p><strong>19.</strong> 
                                                    Untuk update / tambah task pertama pilih dulu projectnya, 
                                                    lalu akan keluar tombol add task dan edit task (* jika task dalam project tersebut ada)
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="view overlay zoom pointer">
                                                <img src="<?php echo base_url();?>image/manual_book/actual/update_material.png" class="img-fluid " alt="smaple image" width="100%" height="100%">
                                                <div class="mask flex-center">
                                                    <p class="white-text"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="col-lg-12 md-form">
                                                <p><strong>20.</strong> 
                                                    Pada menu update material anda harus melakukan inputan data actual material yang sudah digunakan.
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="view overlay zoom pointer">
                                                <img src="<?php echo base_url();?>image/manual_book/actual/update_material4.png" class="img-fluid " alt="smaple image" width="100%" height="100%">
                                                <div class="mask flex-center">
                                                    <p class="white-text"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="col-lg-12 md-form">
                                                <p><strong>21.</strong> 
                                                    Pada menu ini terdapat 3 tombol, add used material untuk menginput data material yang sudah digunakan,
                                                    add comment untuk memberikan komentar tentang material per task,
                                                    dan estimated material untuk melihat material yang sebelumnya 
                                                    di planning akan digunakan sebelumnya (* estimasi project material).
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="view overlay zoom pointer">
                                                <img src="<?php echo base_url();?>image/manual_book/actual/add_material.png" class="img-fluid " alt="smaple image" width="100%" height="100%">
                                                <div class="mask flex-center">
                                                    <p class="white-text"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="col-lg-12 md-form">
                                                <p><strong>22.</strong> 
                                                    Untuk input data material yang sudah digunakan anda bisa memilih material yang sudah 
                                                    ada sebelumnya / input material baru, untuk memilih data material yang sudah ada
                                                    cukup klik pada input box material, datanya akan keluar sendiri, untuk search data 
                                                    material cukup tuliskan nama material tersebut, jika sudah ada datanya akan 
                                                    otomatis mengisi satuan dan harganya.
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="view overlay zoom pointer">
                                                <img src="<?php echo base_url();?>image/manual_book/actual/comment_material.png" class="img-fluid " alt="smaple image" width="100%" height="100%">
                                                <div class="mask flex-center">
                                                    <p class="white-text"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="col-lg-12 md-form">
                                                <p><strong>23.</strong> 
                                                    Untuk menambah comment cukup klik tombol comment dan tuliskan komentar anda.
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="view overlay zoom pointer">
                                                <img src="<?php echo base_url();?>image/manual_book/actual/update_todo.png" class="img-fluid " alt="smaple image" width="100%" height="100%">
                                                <div class="mask flex-center">
                                                    <p class="white-text"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="col-lg-12 md-form">
                                                <p><strong>24.</strong> 
                                                    Pada menu update todo anda diharuskan untuk menginput tanggal actual mulai todo,
                                                    dan tanggal actual selesai todo, anda juga bisa menambah todo baru di menu ini.
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="view overlay zoom pointer">
                                                <img src="<?php echo base_url();?>image/manual_book/actual/update_todo3.png" class="img-fluid " alt="smaple image" width="100%" height="100%">
                                                <div class="mask flex-center">
                                                    <p class="white-text"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="col-lg-12 md-form">
                                                <p><strong>25.</strong> 
                                                    Untuk update / tambah todo pertama silakan pilih project, lalu data task
                                                    pada project tersebut akan otomatis keluar, kemudian kllik todo.
                                                    
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="view overlay zoom pointer">
                                                <img src="<?php echo base_url();?>image/manual_book/actual/update_todo4.png" class="img-fluid " alt="smaple image" width="100%" height="100%">
                                                <div class="mask flex-center">
                                                    <p class="white-text"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="col-lg-12 md-form">
                                                <p><strong>26.</strong> 
                                                Pada menu ini terdapat tombol add todo (* digunakan untuk menambah todo baru
                                                jika pada saat estimasi todo tersebut tidak ada), add comment (* menambahkan
                                                komentar tentang todo berdasarkan task), tombol start todo (gambar play) untuk
                                                input tgl mulai todo tersebut
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="view overlay zoom pointer">
                                                <img src="<?php echo base_url();?>image/manual_book/actual/rating3.png" class="img-fluid " alt="smaple image" width="100%" height="100%">
                                                <div class="mask flex-center">
                                                    <p class="white-text"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="col-lg-12 md-form">
                                                <p><strong>27.</strong> 
                                                Menu ini digunakan untuk memberikan rating terhadap project yang statusnya sudah close / selesai
                                                untuk menambahkan rating pertama pilih project, kemudian tentukan ratingnya dan masukan komentarnya
                                                untuk setiap tolak ukur yang tersedia.
                                                * Project yang sudah di berikan rating tidak akan muncul lagi pada menu ini.
                                                </p>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div id="div_s4" class="col-lg-12 md-form">

                                    <div align="center" class="text-white info-color">
                                        <p><strong style="font-size:30px;">4. Report</strong></p>
                                    </div>

                                    <div class="row">

                                        <div class="col-lg-6 md-form">
                                            <div class="view overlay zoom pointer">
                                                <img src="<?php echo base_url();?>image/manual_book/report/summary.png" class="img-fluid " alt="smaple image" width="100%" height="100%">
                                                <div class="mask flex-center">
                                                    <p class="white-text"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="col-lg-12 md-form">
                                                <p><strong>28.</strong> 
                                                    Menu ini  digunakan untuk melihat progress project per minggu dari pertama
                                                    dimulai sampai tanggal sekarang
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="view overlay zoom pointer">
                                                <img src="<?php echo base_url();?>image/manual_book/report/summary_grafik.png" class="img-fluid " alt="smaple image" width="100%" height="100%">
                                                <div class="mask flex-center">
                                                    <p class="white-text"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="col-lg-12 md-form">
                                                <p><strong>29.</strong> 
                                                    Untuk melihat summary grafik cukup pilih nama projectnya maka data akan keluar.
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="view overlay zoom pointer">
                                                <img src="<?php echo base_url();?>image/manual_book/report/status.png" class="img-fluid " alt="smaple image" width="100%" height="100%">
                                                <div class="mask flex-center">
                                                    <p class="white-text"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="col-lg-12 md-form">
                                                <p><strong>30.</strong> 
                                                    Menu ini digunakan untuk melihat report berdasarkan status proyek (all,open,cancel,close)
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="view overlay zoom pointer">
                                                <img src="<?php echo base_url();?>image/manual_book/report/status3.png" class="img-fluid " alt="smaple image" width="100%" height="100%">
                                                <div class="mask flex-center">
                                                    <p class="white-text"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="col-lg-12 md-form">
                                                <p><strong>31.</strong> 
                                                    Untuk melihat report berdasarkan status cukup klik tombol berdasarkan status yang ingin dilihat
                                                    kemudian klik export pdf / excel.
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="view overlay zoom pointer">
                                                <img src="<?php echo base_url();?>image/manual_book/report/progress.png" class="img-fluid " alt="smaple image" width="100%" height="100%">
                                                <div class="mask flex-center">
                                                    <p class="white-text"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="col-lg-12 md-form">
                                                <p><strong>32.</strong> 
                                                    Menu ini digunakan untuk melihat report berdasarkan tanggal mulai project sampai tanggal
                                                    yg ditentukan oleh user.
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="view overlay zoom pointer">
                                                <img src="<?php echo base_url();?>image/manual_book/report/progress2.png" class="img-fluid " alt="smaple image" width="100%" height="100%">
                                                <div class="mask flex-center">
                                                    <p class="white-text"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 md-form">
                                            <div class="col-lg-12 md-form">
                                                <p><strong>33.</strong> 
                                                    Untuk menmdapatkan report progress by user periode cukup pilih project
                                                    lalu tentukan progress yg diperlukan sampai tgl berapa.
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            
                            </div>

                        </div>

                    </div>
    </main>
</body>