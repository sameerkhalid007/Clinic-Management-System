<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');
if(isset($_POST['btn_submit']))
{
    if(isset($_GET['editid']))
    {
             $sql ="UPDATE doctor_timings SET doctorid='$_POST[select2]',start_time='$_POST[ftime]',end_time='$_POST[ttime]',status='$_POST[status]'  WHERE doctor_timings_id='$_GET[editid]'";
        if($qsql = mysqli_query($conn,$sql))
        {
?>
         <div class="popup popup--icon -success js_success-popup popup--visible">
          <div class="popup__background"></div>
          <div class="popup__content">
            <h3 class="popup__content__title">
              Success
            </h3>
            <p>Doctor Timings record updated successfully.</p>
            <p>
             <!--  <a href="index.php"><button class="button button--success" data-for="js_success-popup"></button></a> -->
             <?php echo "<script>setTimeout(\"location.href = 'view-visiting-hour.php';\",1500);</script>"; ?>
            </p>
          </div>
        </div>
<?php
            //echo "<script>alert('Doctor Timings record updated successfully...');</script>";
            //echo "<script>window.location = 'view-visiting-hour.php';</script>";
        }
        else
        {
            echo mysqli_error($conn);
        }
    }
    else
    {
    $sql ="INSERT INTO doctor_timings(doctorid,start_time,end_time,status) values('$_POST[select2]','$_POST[ftime]','$_POST[ttime]','$_POST[status]')";
    if($qsql = mysqli_query($conn,$sql))
    {
?>
         <div class="popup popup--icon -success js_success-popup popup--visible">
          <div class="popup__background"></div>
          <div class="popup__content">
            <h3 class="popup__content__title">
              Success
            </h3>
            <p>Doctor Timings record inserted successfully.</p>
            <p>
             <!--  <a href="index.php"><button class="button button--success" data-for="js_success-popup"></button></a> -->
             <?php echo "<script>setTimeout(\"location.href = 'view-visiting-hour.php';\",1500);</script>"; ?>
            </p>
          </div>
        </div>
<?php
        //echo "<script>alert('Doctor Timings record inserted successfully...');</script>";
        //echo "<script>window.location = 'view-visiting-hour.php';</script>";
    }
    else
    {
        echo mysqli_error($conn);
    }
}
}
if(isset($_GET['editid']))
{
    $sql="SELECT * FROM doctor_timings WHERE doctor_timings_id='$_GET[editid]' ";
    $qsql = mysqli_query($conn,$sql);
    $rsedit = mysqli_fetch_array($qsql);

}
?>
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>

<div class="pcoded-content">
<div class="pcoded-inner-content">

<div class="main-body">
<div class="page-wrapper">

<div class="page-header">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
<div class="d-inline">
<h4>Visiting Hour</h4>
<!-- <span>Lorem ipsum dolor sit <code>amet</code>, consectetur adipisicing elit</span> -->
</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class="breadcrumb-title">
<li class="breadcrumb-item">
<a href="index.php"> <i class="feather icon-home"></i> </a>
</li>
<li class="breadcrumb-item"><a>Visiting Hour</a>
</li>
<li class="breadcrumb-item"><a href="#">Visiting Hour</a>
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
<div class="card-header">
<!-- <h5>Basic Inputs Validation</h5>
<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span> -->
</div>
<div class="card-block">
<form id="main" method="post" action="" enctype="multipart/form-data">
    <?php
        if(isset($_SESSION['doctorid']))
        {
            echo "<input class='form-control'  type='hidden' name='select2' value='$_SESSION[doctorid]' >";
        }
        else
        {
        ?>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Doctor</label>
            <div class="col-sm-8">
                <select class="form-control"  name="select2" id="select2">
                   <option value="">Select</option>
                    <?php
                    $sqldoctor= "SELECT * FROM doctor WHERE status='Active'";
                    $qsqldoctor = mysqli_query($con,$sqldoctor);
                    while($rsdoctor = mysqli_fetch_array($qsqldoctor))
                    {
                        if($rsdoctor[doctorid] == $rsedit[doctorid])
                        {
                        echo "<option value='$rsdoctor[doctorid]' selected>$rsdoctor[doctorid] - $rsdoctor[doctorname]</option>";
                        }
                        else
                        {
                        echo "<option value='$rsdoctor[doctorid]'>$rsdoctor[doctorid] - $rsdoctor[doctorname]</option>";
                        }
                    }
                  ?>

                  </select>
                <span class="messages"></span>
            </div>
        </div>
    <?php } ?>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Form</label>
        <div class="col-sm-8">
            <input class="form-control"  type="time" name="ftime" id="ftime" value="<?php echo $rsedit['start_time']; ?>"></td>
            <span class="messages"></span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">To</label>
        <div class="col-sm-8">
            <input  class="form-control" type="time" name="ttime" id="ttime"  value="<?php echo $rsedit['end_time']; ?>" >
            <span class="messages"></span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Status</label>
        <div class="col-sm-8">
            <select name="status" id="status" class="form-control" required="">
                <option value="">-- Select One -- </option>
                <option value="Active" <?php if(isset($_GET['editid']))
        { if($rsedit['status'] == 'Active') { echo 'selected'; } } ?>>Active</option>
                <option value="Inactive" <?php if(isset($_GET['editid']))
        { if($rsedit['status'] == 'Inactive') { echo 'selected'; } } ?>>Inactive</option>
            </select>
            <span class="messages"></span>
        </div>
    </div>


    <div class="form-group row">
        <label class="col-sm-2"></label>
        <div class="col-sm-10">
            <button type="submit" name="btn_submit" class="btn btn-primary m-b-0">Submit</button>
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

<?php include('footer.php');?>

<script type="text/javascript">
    $('#main').keyup(function(){
        $('#confirm-pw').html('');
    });

    $('#cnfirmpassword').change(function(){
        if($('#cnfirmpassword').val() != $('#password').val()){
            $('#confirm-pw').html('Password Not Match');
        }
    });

    $('#password').change(function(){
        if($('#cnfirmpassword').val() != $('#password').val()){
            $('#confirm-pw').html('Password Not Match');
        }
    });
</script>
