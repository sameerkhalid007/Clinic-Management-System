
<!-- Author Name: Nikhil Bhalerao +919423979339. 
PHP, Laravel and Codeignitor Developer
-->
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="popup_style.css">
<?php include('connect.php');?>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<title>Admin Panel</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="description" content="#">
<meta name="keywords" content="Admin , Responsive">
<meta name="author" content="Nikhil Bhalerao +919423979339.">


<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="files/bower_components/bootstrap/css/bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="files/assets/icon/themify-icons/themify-icons.css">

<link rel="stylesheet" type="text/css" href="files/assets/icon/icofont/css/icofont.css">

<link rel="stylesheet" type="text/css" href="files/assets/css/style.css">
</head>
<body class="fix-menu">

<div class="theme-loader">
<div class="ball-scale">
<div class='contain'>
<div class="ring"><div class="frame"></div></div>
<div class="ring"><div class="frame"></div></div>
<div class="ring"><div class="frame"></div></div>
<div class="ring"><div class="frame"></div></div>
<div class="ring"><div class="frame"></div></div>
<div class="ring"><div class="frame"></div></div>
<div class="ring"><div class="frame"></div></div>
<div class="ring"><div class="frame"></div></div>
<div class="ring"><div class="frame"></div></div>
<div class="ring"><div class="frame"></div></div>
</div>
</div>
</div>

<?php
$que="select * from manage_website";
$query=$conn->query($que);
while($row=mysqli_fetch_array($query))
{
  //print_r($row);
  extract($row);
  $business_name = $row['business_name'];
  $business_email = $row['business_email'];
  $business_web = $row['business_web'];
  $portal_addr = $row['portal_addr'];
  $addr = $row['addr'];
  $curr_sym = $row['curr_sym'];
  $curr_position = $row['curr_position'];
  $front_end_en = $row['front_end_en'];
  $date_format = $row['date_format'];
  $def_tax = $row['def_tax'];
  $logo = $row['logo'];
}
?>

<section class="login-block">

<div class="container-fluid">
<div class="row">
<div class="col-sm-12">


<div class="auth-box card">
<div class="card-block">
<form id="main" method="post" action="pages/save_user_client.php" enctype="multipart/form-data">
<div class="row m-b-20">
<div class="col-md-6 text-center" >
<image class="profile-img" src="uploadImage/Logo/<?php echo $logo; ?>" style="width: 50%"></image>
</div>
<div class="col-md-6" style="margin-top: 40px;">
<h3 class="text-center txt-primary">Sign up</h3>
</div>
</div>
<div class="row">
<div class="col-sm-6">
 <div class="form-group form-primary">
<input type="text" class="form-control" name="fname" id="fname" placeholder="Firstname" required=""><span class="form-bar"></span>
</div>
</div>
<div class="col-sm-6">
<div class="form-group form-primary">
<input type="text" class="form-control" name="lname" id="lname" placeholder="Lastname" required="">
<span class="form-bar"></span>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-6">
 <div class="form-group form-primary">
<input type="email" class="form-control" id="email" name="email" placeholder="E-mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required="">
<span class="form-bar"></span>
</div>
</div>
<div class="col-sm-6">
<div class="form-group form-primary">
<input type="text" class="form-control mob_no" data-mask="9999-999-999" id="contact" name="contact" placeholder="Phone number" required="">
<span class="form-bar"></span>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-6">
 <div class="form-group form-primary">
<input type="text" class="form-control" name="company" id="company" placeholder="Company" required="">
<span class="form-bar"></span>
</div>
</div>
<div class="col-sm-6">
<div class="form-group form-primary">
<textarea name="addr" placeholder="  Address" style="width: 190px;"></textarea>
<span class="form-bar"></span>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-6">
 <div class="form-group form-primary">
<input type="password" name="password" class="form-control" required="" placeholder="Password">
<span class="form-bar"></span>
</div>
</div>
<div class="col-sm-6">
<div class="form-group form-primary">
<input type="password" name="confirm-password" class="form-control" required="" placeholder="Confirm Password">
<span class="form-bar"></span>
</div>
</div>
</div>

<input type="hidden" name="username" class="form-control" value="client">
<div class="row m-t-25 text-left">
<div class="col-md-12">
<div class="checkbox-fade fade-in-primary">
<label>
<input type="checkbox" value="">
<span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
<span class="text-inverse">I accept your terms and conditions</span>
</label>
</div>
</div>
</div>

<div class="row m-t-30">
<div class="col-md-6">
<button type="submit" name="btn_check" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Sign up now</button>
</div>
<div class="col-md-6">
<p class="text-inverse text-right m-b-0">Thank you.</p>
<p class="text-inverse text-right"><a href="login.php"><b class="f-w-600">Back to Login</b></a></p>
</div>
</div>
</div>
</div>
</form>
</div>

</div>

</div>

</section>


<script type="text/javascript" src="files/bower_components/jquery/js/jquery.min.js"></script>
<script type="text/javascript" src="files/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="files/bower_components/popper.js/js/popper.min.js"></script>
<script type="text/javascript" src="files/bower_components/bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript" src="files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>

<script type="text/javascript" src="files/bower_components/modernizr/js/modernizr.js"></script>
<script type="text/javascript" src="files/bower_components/modernizr/js/css-scrollbars.js"></script>

<script type="text/javascript" src="files/bower_components/i18next/js/i18next.min.js"></script>
<script type="text/javascript" src="files/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
<script type="text/javascript" src="files/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>
<script type="text/javascript" src="files/bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>
<script type="text/javascript" src="files/assets/js/common-pages.js"></script>

<script async src="#"></script>
<script></script>
</body>

<!-- for any PHP, Laravel or Codeignitor Develoopment connect me at mayuri.infospace@gmail.com-->
</html>
