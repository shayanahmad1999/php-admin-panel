<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Login</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- favicon
		============================================ -->
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
  <!-- Google Fonts
		============================================ -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
  <!-- Bootstrap CSS
		============================================ -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <!-- font awesome CSS
		============================================ -->
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">
  <!-- owl.carousel CSS
		============================================ -->
  <link rel="stylesheet" href="assets/css/owl.carousel.css">
  <link rel="stylesheet" href="assets/css/owl.theme.css">
  <link rel="stylesheet" href="assets/css/owl.transitions.css">
  <!-- animate CSS
		============================================ -->
  <link rel="stylesheet" href="assets/css/animate.css">
  <!-- normalize CSS
		============================================ -->
  <link rel="stylesheet" href="assets/css/normalize.css">
  <!-- mCustomScrollbar CSS
		============================================ -->
  <link rel="stylesheet" href="assets/css/scrollbar/jquery.mCustomScrollbar.min.css">
  <!-- wave CSS
		============================================ -->
  <link rel="stylesheet" href="assets/css/wave/waves.min.css">
  <!-- Notika icon CSS
		============================================ -->
  <link rel="stylesheet" href="assets/css/notika-custom-icon.css">
  <!-- main CSS
		============================================ -->
  <link rel="stylesheet" href="assets/css/main.css">
  <!-- style CSS
		============================================ -->
  <link rel="stylesheet" href="assets/style.css">
  <!-- responsive CSS
		============================================ -->
  <link rel="stylesheet" href="assets/css/responsive.css">
  <!-- modernizr JS
		============================================ -->
  <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
  <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
  <!-- Login Register area Start-->
  <div class="login-content">
    <!-- Login -->
    <div class="nk-block toggled" id="l-login">
      <?php if (isset($_SESSION['error'])) : ?>
        <div class="alert alert-danger">
          <?= $_SESSION['error']; ?>
        </div>
        <?php unset($_SESSION['error']); 
        ?>
      <?php endif; ?>
      <form action="index?page=user&action=userlogin" method="post">
        <div class="nk-form">
          <div class="input-group">
            <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
            <div class="nk-int-st">
              <input type="email" class="form-control" name="email" placeholder="Username" required>
            </div>
          </div>
          <div class="input-group mg-t-15">
            <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-edit"></i></span>
            <div class="nk-int-st">
              <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
          </div>
          <div class="fm-checkbox">
            <label><input type="checkbox" class="i-checks"> <i></i> Keep me signed in</label>
          </div>
          <button type="submit" class="btn btn-login btn-success btn-float"><i class="notika-icon notika-right-arrow right-arrow-ant"></i></button>
        </div>
      </form>
    </div>
  </div>
  <!-- Login Register area End-->
  <!-- jquery
		============================================ -->
  <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
  <!-- bootstrap JS
		============================================ -->
  <script src="assets/js/bootstrap.min.js"></script>
  <!-- wow JS
		============================================ -->
  <script src="assets/js/wow.min.js"></script>
  <!-- price-slider JS
		============================================ -->
  <script src="assets/js/jquery-price-slider.js"></script>
  <!-- owl.carousel JS
		============================================ -->
  <script src="assets/js/owl.carousel.min.js"></script>
  <!-- scrollUp JS
		============================================ -->
  <script src="assets/js/jquery.scrollUp.min.js"></script>
  <!-- meanmenu JS
		============================================ -->
  <script src="assets/js/meanmenu/jquery.meanmenu.js"></script>
  <!-- counterup JS
		============================================ -->
  <script src="assets/js/counterup/jquery.counterup.min.js"></script>
  <script src="assets/js/counterup/waypoints.min.js"></script>
  <script src="assets/js/counterup/counterup-active.js"></script>
  <!-- mCustomScrollbar JS
		============================================ -->
  <script src="assets/js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
  <!-- sparkline JS
		============================================ -->
  <script src="assets/js/sparkline/jquery.sparkline.min.js"></script>
  <script src="assets/js/sparkline/sparkline-active.js"></script>
  <!-- flot JS
		============================================ -->
  <script src="assets/js/flot/jquery.flot.js"></script>
  <script src="assets/js/flot/jquery.flot.resize.js"></script>
  <script src="assets/js/flot/flot-active.js"></script>
  <!-- knob JS
		============================================ -->
  <script src="assets/js/knob/jquery.knob.js"></script>
  <script src="assets/js/knob/jquery.appear.js"></script>
  <script src="assets/js/knob/knob-active.js"></script>
  <!--  wave JS
		============================================ -->
  <script src="assets/js/wave/waves.min.js"></script>
  <script src="assets/js/wave/wave-active.js"></script>
  <!-- icheck JS
		============================================ -->
  <script src="assets/js/icheck/icheck.min.js"></script>
  <script src="assets/js/icheck/icheck-active.js"></script>
  <!--  todo JS
		============================================ -->
  <script src="assets/js/todo/jquery.todo.js"></script>
  <!-- plugins JS
		============================================ -->
  <script src="assets/js/plugins.js"></script>
  <!-- main JS
		============================================ -->
  <script src="assets/js/main.js"></script>
</body>

</html>