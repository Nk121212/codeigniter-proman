    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url();?>plugin/font-awesome/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>plugin/template/css/bootstrap.min.css">
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url();?>plugin/template/css/mdb.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>plugin/login/css/login.css">

<body>
    <hgroup>
    </hgroup>
        <form action="<?php echo base_url();?>loginController/index" method="post">

        <?php 
            error_reporting(0);
            echo $error;
        ?>

            <div align="center" class="group">
                <!--h3 style="font-family: fantasy; color: #2E2E2E;"><span style="font-family: fantasy;color: #4285F4;">Pro</span>Man</h3-->
                <a href="#"><img src="<?php echo base_url();?>image/logo_web/proman.jpg" alt="No Image" height="100"></a>
            </div>
            <div class="group">
                <input type="email" name="email"><span class="highlight" required></span><span class="bar"></span>
                <label>Email</label>
            </div>
            <div class="group">
                <input type="password" name="password"><span class="highlight" required></span><span class="bar"></span>
                <label>Password</label>
            </div>
            <button type="submit" class="button buttonBlue">Sign In
            <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
            </button>
            <div align="right">
                <!--a href="<?php echo base_url(); ?>c_register/index">
                    <p style="font-size:15px;font-weight:bold;">Sign Up</p>
                </a-->
            </div>
            
        </form>
        
        <!--footer>
            <a href="#"><img src="<?php echo base_url();?>image/logo_web/proman.jpg"></a>
            <p>You Gotta Like <a href="" target="_blank">Sipatex 2018</a></p>
        </footer-->
</body>

<script src="<?php echo base_url();?>plugin/template/js/jquery-3.3.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="<?php echo base_url();?>plugin/template/js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="<?php echo base_url();?>plugin/template/js/bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>daterangepicker/moment.min.js"></script>
<script src="<?php echo base_url();?>plugin/login/js/login.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/sweetalert.min.js"></script>

<script>
  $(document).ready(function(){

    //$('.alert').alert()

    $('.close').click(function(){
        $('.alert').alert('close')   
    })

  var browser = '';
  var browserVersion = 0;

  if (/Opera[\/\s](\d+\.\d+)/.test(navigator.userAgent)) {
      swal('Gunakan Google Chrome Ver.71.+', 'Supaya Compatible', 'warning');
  } else if (/MSIE (\d+\.\d+);/.test(navigator.userAgent)) {
      swal('Gunakan Google Chrome Ver.71.+', 'Supaya Compatible', 'warning');
  } else if (/Navigator[\/\s](\d+\.\d+)/.test(navigator.userAgent)) {
      swal('Gunakan Google Chrome Ver.71.+', 'Supaya Compatible', 'warning');
  } else if (/Chrome[\/\s](\d+\.\d+)/.test(navigator.userAgent)) {
      //swal('Gunakan Google Chrome Ver.7+', 'Supaya Compatible', 'warning');
  } else if (/Safari[\/\s](\d+\.\d+)/.test(navigator.userAgent)) {
      swal('Gunakan Google Chrome Ver.71.+', 'Supaya Compatible', 'warning');
  } else if (/Firefox[\/\s](\d+\.\d+)/.test(navigator.userAgent)) {
      swal('Gunakan Google Chrome Ver.71.+', 'Supaya Compatible', 'warning');
  }
  if(browserVersion === 0){
      browserVersion = parseFloat(new Number(RegExp.$1));
  }
  //alert(browser + "*" + browserVersion);
  })
</script>