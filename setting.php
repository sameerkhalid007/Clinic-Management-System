
<!-- Author Name: Nikhil Bhalerao +919423979339.
PHP, Laravel and Codeignitor Developer
-->
<!DOCTYPE html>
<html lang="en">
<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');?>
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<?php date_default_timezone_set('Asia/Kolkata');
 $current_date = date('Y-m-d');

if(isset($_POST["btn_web"]))
{
  extract($_POST);
  if($_FILES['logo']['name']!=''){
      $file_name = $_FILES['logo']['name'];
      $file_type = $_FILES['logo']['type'];
      $file_size = $_FILES['logo']['size'];
      $file_tem_loc = $_FILES['logo']['tmp_name'];
      $file_store = "uploadImage/Logo/".$file_name;

      if (move_uploaded_file($file_tem_loc, $file_store)) {
        echo "file uploaded successfully";
      }
  }
  else{
    $file_name=$_POST['old_image'];
  }
      $folder = "uploadImage/Logo/";

      if (is_dir($folder))
      {
         if ($open = opendir($folder))

          while (($logo=readdir($open)) !=false) {

              if($logo=='.'|| $logo=="..") continue;

              echo '<img src="uploadImage/Logo/'.$logo.'" width="100" height="100">';
          }

          closedir($open);
        }
  //UPDATE `manage_website` SET `id`=[value-1],`business_name`=[value-2],`business_email`=[value-3],`business_web`=[value-4],`portal_addr`=[value-5],`addr`=[value-6],`curr_sym`=[value-7],`curr_position`=[value-8],`front_end_en`=[value-9],`date_format`=[value-10],`def_tax`=[value-11],`logo`=[value-12] WHERE 1
   $q1="UPDATE `manage_website` SET `business_name`='$business_name',`business_email`='$business_email',`business_web`='$business_web',`portal_addr`='$portal_addr' ,`addr`= '$addr',`curr_sym`= '$curr_sym',`curr_position`='$curr_position',`front_end_en`='$front_end_en' , `date_format` = '$date_format', `def_tax` = '$def_tax', `logo` = '$file_name'";
  if ($conn->query($q1) === TRUE) {

      $_SESSION['success']='Record Successfully Updated';
      ?>
      <script type="text/javascript">
        window.location = "setting.php";
      </script>
      <?php

} else {

      $_SESSION['error']='Something Went Wrong';
}
  ?>
  <script>
  //window.location = "sms_config.php";
  </script>
  <?php
}

?>



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
 <div class="pcoded-content">
<div class="pcoded-inner-content">

<div class="main-body">
<div class="page-wrapper">

<div class="page-header">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
<div class="d-inline">
<h4>Settings</h4>
</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class="breadcrumb-title">
<li class="breadcrumb-item">
<a href="index.php"> <i class="feather icon-home"></i> </a>
</li>

<li class="breadcrumb-item"><a href="setting.php">Settings</a>
</li>
</ul>
</div>
</div>
</div>
</div>


<div class="page-body">
<div class="row">
<div class="col-sm-12">

<div class="card">

<div class="card-block">

<div class="row">
<div class="col-lg-12 col-xl-12">
 <div class="sub-title">Settings</div>

<ul class="nav nav-tabs  tabs" role="tablist">
<li class="nav-item">
<a class="nav-link active" data-toggle="tab" href="general" role="tab">General</a>
</li>
</ul>

<div class="tab-content tabs card-block">
<div class="tab-pane active" id="general" role="tabpanel">

<div class="card-block">
<form id="main" method="POST" enctype="multipart/form-data">
<div class="form-group row">
<label class="col-sm-2 col-form-label">Company Name</label>
<div class="col-sm-4">
<input type="text" class="form-control" name="business_name" id="business_name" value="<?php echo $business_name;?>" required="">
<span class="messages"></span>
</div>
<label class="col-sm-2 col-form-label">Company Email</label>
<div class="col-sm-4">
<input type="text" class="form-control" name="business_email" id="business_email" value="<?php echo $business_email;?>" required="">
<span class="messages"></span>
</div>
</div>


<div class="form-group row">
<label class="col-sm-2 col-form-label">Company Website</label>
<div class="col-sm-4">
<input type="text" class="form-control" name="business_web" id="business_web" value="<?php echo $business_web;?>" required="">
<span class="messages"></span>
</div>
<label class="col-sm-2 col-form-label">Company Portal Address</label>
<div class="col-sm-4">
<input type="text" class="form-control" name="portal_addr" id="postal_addr" value="<?php echo $portal_addr;?>" required="">
<span class="messages"></span>
</div>
</div>


<div class="form-group row">

<label class="col-sm-2 col-form-label">Company Address</label>
<div class="col-sm-10">
<input type="text" class="form-control" name="addr" value="<?php echo $addr;?>" required="">
<span class="messages"></span>
</div>
</div>

<div class="form-group row">
<label class="col-sm-2 col-form-label">Currency Symbol</label>
<div class="col-sm-4">
<input type="text" class="form-control" name="curr_sym" id="curr_sym" value="<?php echo $curr_sym;?>" required="">
<span class="messages"></span>
</div>
<label class="col-sm-2 col-form-label">Currency Position</label>
<div class="col-sm-4">
<select class="form-control" id="curr_position" name="curr_position" required="">
    <option value="<?php echo "right";?>"<?php if($curr_position=='right'){echo "selected";}?>>Right</option>
    <option value="<?php echo "left";?>"<?php if($curr_position=='left'){echo "selected";}?>>Left</option>
</select>
<span class="messages"></span>
</div>
</div>

<div class="form-group row">
<label class="col-sm-2 col-form-label">Enable Front End</label>
<div class="col-sm-4">
<select type="text" class="form-control" id="front_end_en" name="front_end_en" placeholder="Add yes/no" required="">
<option value="1" <?php if($front_end_en=='1'){echo "selected";}?>>Yes</option>
<option value="0" <?php if($front_end_en=='0'){echo "selected";}?>>No</option>
</select>
<span class="messages"></span>
</div>
<label class="col-sm-2 col-form-label">Date Format</label>
<div class="col-sm-4">
<select type="text" class="form-control" id="date_format" name="date_format" placeholder="Add yes/no" required="">
<option value="Y-m-d" <?php if($date_format=='Y-m-d'){echo "selected";}?>>Y-m-d</option>
<option value="d-m-Y" <?php if($date_format=='d-m-Y'){echo "selected";}?>>d-m-Y</option>
</select>
<span class="messages"></span>
</div>
</div>

<div class="form-group row">
<label class="col-sm-2 col-form-label">Default Tax</label>
<div class="col-sm-4">
<input type="text" class="form-control" name="def_tax" id="def_tax" value="<?php echo $def_tax;?>" required="">
<span class="messages"></span>
</div>
<label class="col-sm-2 col-form-label">Company Logo</label>
<div class="col-sm-4">
 <image class="profile-img" src="uploadImage/Logo/<?php echo $logo; ?>" style="width: 50%"></image>
<input type="hidden" value="<?=$logo?>" name="old_image">
<input type="file" class="form-control" name="logo">

<span class="messages"></span>
</div>
</div>




<div class="form-group row">
<label class="col-sm-2"></label>
<div class="col-sm-10">
<button type="submit" name="btn_web" class="btn btn-primary m-b-0">Submit</button>
</div>
</div>
</form>
</div>
</div>


</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<div id="#">
</div>
</div>
</div>
</div>
</div>


<?php include('footer.php');?>

<script>
            $("input[name='def_tax']").TouchSpin({
                min: 0,
                max: 100000000,
                step: 0.01,
                decimals: 2,
                boostat: 5,
                maxboostedstep: 10,
              //  postfix: '%'
            });
</script>
