<?php
    $lvl = $this->session->userdata('auth');
?>
<head>
        <title>MTC Project Management</title>
        <link rel="icon" href="<?php echo base_url();?>image/logo_web/proman.jpg">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url();?>plugin/font-awesome/css/font-awesome.min.css">
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="<?php echo base_url();?>plugin/template/css/bootstrap.min.css">
        <!-- Material Design Bootstrap -->
        <link rel="stylesheet" href="<?php echo base_url();?>plugin/template/css/mdb.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>plugin/upload/css/upload.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>daterangepicker/daterangepicker.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>dttable/dt_tbl.css">
        <link rel="stylesheet" href="<?php echo base_url();?>plugin/template/css/mdb_table.css">
        <link rel="stylesheet" href="<?php echo base_url();?>plugin/rating/starrr.css">

        <style>
            .toggle {
                cursor:pointer;
            }
            .pointer {
                cursor:pointer;
            }
        </style>
</head>
<!--Main Navigation-->
    <header>
        <!-- Sidebar navigation -->
        <div id="slide-out" class="side-nav sn-bg-4 fixed">
            <ul class="custom-scrollbar">
            <!-- Logo -->
            <li class="logo-sn waves-effect" style="border-radius: 25px;background-color:#ccd2dd;">
                <div class="text-center">
                    <a href="#" class="pl-0"><img style="box-shadow: 10px 10px grey;" width="50px" height="50px" src="<?php echo base_url();?>image/logo_web/proman.jpg" class=""></a>
                </div>
            </li>
            <!--/. Logo -->

            <!--/.Search Form-->
            <!-- Side navigation links -->
            <li>

            <?php
                if($lvl == 0){
                    //user
                    echo '
                    <ul class="collapsible collapsible-accordion">
                    <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-file"></i> Report<i class="fa fa-angle-down rotate-icon"></i></a>
                        <div class="collapsible-body">
                            <ul class="collapsible collapsible-accordion">
                            <li><a href="'.base_url().'c_report/summary" class="collapsible-header waves-effect"><i class="fa fa-file"></i> Summary Project</a></li>
                                <li><a href="'.base_url().'c_report/index" class="collapsible-header waves-effect"><i class="fa fa-file"></i> Status Project</a></li>
                                <li><a href="'.base_url().'c_report/progress_page" class="collapsible-header waves-effect"><i class="fa fa-file"></i> Progress Project</a></li>
                            </ul>
                        </div>
                    </li>
                    <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-question"></i> Help<i class="fa fa-angle-down rotate-icon"></i></a>
                        <div class="collapsible-body">
                            <ul class="collapsible collapsible-accordion">
                                <li><a href="'.base_url().'c_manual/index" class="collapsible-header waves-effect"><i class="fa fa-eye"></i> Manual Book</a></li>
                                <li><a href="'.base_url().'c_manual/flow" class="collapsible-header waves-effect"><i class="fa fa-eye"></i> Flow</a></li>
                            </ul>
                        </div>
                    </li>
                    </ul>
                    ';
                }elseif($lvl == 1){
                    //admin
                    echo '
                    <ul class="collapsible collapsible-accordion">
                    
                        <li><a href="'.base_url().'dashboardcontroller/index" class="collapsible-header waves-effect"><i class="fa fa-home"></i> Dashboard</a></li>

                        <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-plus"></i> New Project<i class="fa fa-angle-down rotate-icon"></i></a>
                            <div class="collapsible-body">
                                <ul class="collapsible collapsible-accordion">
                                    <li><a href="'.base_url().'estimatecontroller/index" class="collapsible-header waves-effect"><i class="fa fa-plus"></i> Create Project</a></li>
                                    <li><a href="'.base_url().'c_task/index" class="collapsible-header waves-effect"><i class="fa fa-plus"></i> Create Task</a></li>
                                    <li><a href="'.base_url().'c_proposal/index" class="collapsible-header waves-effect"><i class="fa fa-file"></i> Print Proposal</a></li>

                                    <li><a href="'.base_url().'c_task/kick_off_page" class="collapsible-header waves-effect"><i class="fa fa-play"></i> Kick Off Project</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-refresh"></i> Update Project<i class="fa fa-angle-down rotate-icon"></i></a>
                            <div class="collapsible-body">
                                <ul class="collapsible collapsible-accordion">
                                    <li><a href="'.base_url().'c_task/page_task_update" class="collapsible-header waves-effect"><i class="fa fa-refresh"></i> Update Task</a></li>
                                    <li><a href="'.base_url().'c_material/index" class="collapsible-header waves-effect"><i class="fa fa-refresh"></i> Update Material</a></li>
                                    <li><a href="'.base_url().'c_todolist/index" class="collapsible-header waves-effect"><i class="fa fa-refresh"></i> Update Todolist</a></li>
                                    
                                    <li><a href="'.base_url().'c_rating/index" class="collapsible-header waves-effect"><i class="fa fa-refresh"></i> Rating Project</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-file"></i> Report<i class="fa fa-angle-down rotate-icon"></i></a>
                            <div class="collapsible-body">
                                <ul class="collapsible collapsible-accordion">
                                <li><a href="'.base_url().'c_report/summary" class="collapsible-header waves-effect"><i class="fa fa-file"></i> Summary Project</a></li>
                                    <li><a href="'.base_url().'c_report/index" class="collapsible-header waves-effect"><i class="fa fa-file"></i> Status Project</a></li>
                                    <li><a href="'.base_url().'c_report/progress_page" class="collapsible-header waves-effect"><i class="fa fa-file"></i> Progress Project</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-plus"></i> Data Master<i class="fa fa-angle-down rotate-icon"></i></a>
                            <div class="collapsible-body">
                                <ul class="collapsible collapsible-accordion">
                                    <li><a href="'.base_url().'c_master/index" class="collapsible-header waves-effect"><i class="fa fa-plus"></i> Satuan</a></li>
                                    <li><a href="'.base_url().'c_master/prioritas" target="_blank" class="collapsible-header waves-effect"><i class="fa fa-eye"></i> Priority Formula</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-question"></i> Help<i class="fa fa-angle-down rotate-icon"></i></a>
                            <div class="collapsible-body">
                                <ul class="collapsible collapsible-accordion">
                                    <li><a href="'.base_url().'c_manual/index" class="collapsible-header waves-effect"><i class="fa fa-eye"></i> Manual Book</a></li>
                                    <li><a href="'.base_url().'c_manual/flow" class="collapsible-header waves-effect"><i class="fa fa-eye"></i> Flow</a></li>
                                </ul>
                            </div>
                        </li>
                        </ul>
                    ';
                }else{
                    //superuser
                    echo '
                    <ul class="collapsible collapsible-accordion">
                    
                        <li><a href="'.base_url().'dashboardcontroller/index" class="collapsible-header waves-effect"><i class="fa fa-home"></i> Dashboard</a></li>

                        <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-plus"></i> New Project<i class="fa fa-angle-down rotate-icon"></i></a>
                            <div class="collapsible-body">
                                <ul class="collapsible collapsible-accordion">
                                    <li><a href="'.base_url().'estimatecontroller/index" class="collapsible-header waves-effect"><i class="fa fa-plus"></i> Create Project</a></li>
                                    <li><a href="'.base_url().'c_task/index" class="collapsible-header waves-effect"><i class="fa fa-plus"></i> Create Task</a></li>
                                    <li><a href="'.base_url().'c_proposal/index" class="collapsible-header waves-effect"><i class="fa fa-file"></i> Print Proposal</a></li>

                                    <li><a href="'.base_url().'c_task/kick_off_page" class="collapsible-header waves-effect"><i class="fa fa-play"></i> Kick Off Project</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-refresh"></i> Update Project<i class="fa fa-angle-down rotate-icon"></i></a>
                            <div class="collapsible-body">
                                <ul class="collapsible collapsible-accordion">
                                    <li><a href="'.base_url().'c_task/page_task_update" class="collapsible-header waves-effect"><i class="fa fa-refresh"></i> Update Task</a></li>
                                    <li><a href="'.base_url().'c_material/index" class="collapsible-header waves-effect"><i class="fa fa-refresh"></i> Update Material</a></li>
                                    <li><a href="'.base_url().'c_todolist/index" class="collapsible-header waves-effect"><i class="fa fa-refresh"></i> Update Todolist</a></li>
                                    
                                    <li><a href="'.base_url().'c_rating/index" class="collapsible-header waves-effect"><i class="fa fa-refresh"></i> Rating Project</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-file"></i> Report<i class="fa fa-angle-down rotate-icon"></i></a>
                            <div class="collapsible-body">
                                <ul class="collapsible collapsible-accordion">
                                <li><a href="'.base_url().'c_report/summary" class="collapsible-header waves-effect"><i class="fa fa-file"></i> Summary Project</a></li>
                                    <li><a href="'.base_url().'c_report/index" class="collapsible-header waves-effect"><i class="fa fa-file"></i> Status Project</a></li>
                                    <li><a href="'.base_url().'c_report/progress_page" class="collapsible-header waves-effect"><i class="fa fa-file"></i> Progress Project</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-plus"></i> Data Master<i class="fa fa-angle-down rotate-icon"></i></a>
                            <div class="collapsible-body">
                                <ul class="collapsible collapsible-accordion">
                                    <li><a href="'.base_url().'c_master/index" class="collapsible-header waves-effect"><i class="fa fa-plus"></i> Satuan</a></li>
                                    <li><a href="'.base_url().'c_master/prioritas" target="_blank" class="collapsible-header waves-effect"><i class="fa fa-eye"></i> Priority Formula</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-question"></i> Help<i class="fa fa-angle-down rotate-icon"></i></a>
                            <div class="collapsible-body">
                                <ul class="collapsible collapsible-accordion">
                                    <li><a href="'.base_url().'c_manual/index" class="collapsible-header waves-effect"><i class="fa fa-eye"></i> Manual Book</a></li>
                                    <li><a href="'.base_url().'c_manual/flow" class="collapsible-header waves-effect"><i class="fa fa-eye"></i> Flow</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="'.base_url().'c_user/index" class="collapsible-header waves-effect"><i class="fa fa-plus"></i> Add User</a></li>
                    </ul>
                    ';
                }
            ?>
            </li>
            <!--/. Side navigation links -->
            </ul>
            <div class="sidenav-bg mask-strong"></div>
        </div>
        <!--/. Sidebar navigation -->

        <!-- Navbar -->
        <nav class="navbar fixed-top navbar-expand-lg scrolling-navbar double-nav">
            <!-- SideNav slide-out button -->
            <div class="float-left">
                <a href="#" data-activates="slide-out" class="button-collapse black-text"><i class="fa fa-bars"></i></a>
            </div>
            <!-- Breadcrumb-->
            <div class="breadcrumb-dn mr-auto">
                <p style="font-family: fantasy; font-size: 30px;"><span style="color: lightblue;">Pro</span>Man || 
                <span style="font-size:20px;" id="page"></span></p>
            </div>

            <!--Navbar links-->
            <ul class="nav navbar-nav nav-flex-icons ml-auto">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect" href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user"></i> <span class="clearfix d-none d-sm-inline-block"><?php echo $this->session->userdata('name') ?></span></a>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?php echo base_url(); ?>dashboardcontroller/logout"><i class="fa fa-sign-out"></i> Log Out</a>
                        <!--a class="dropdown-item" href="#">My account</a-->
                    </div>
                </li>

            </ul>
            <!--/Navbar links-->
        </nav>

    </header>
    <!--Main Navigation-->