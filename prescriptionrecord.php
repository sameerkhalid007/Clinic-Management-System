
<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');

if(isset($_POST['btnsubmit']))
{
  if(isset($_GET['editid']))
  {
      $sql ="UPDATE prescription_records SET prescription_id='$_POST[prescriptionid]',medicine_name='$_POST[medicine]',unit='$_POST[unit]',dosage='$_POST[dosage]',status='$_POST[select]',instruction='$_POST[instruction]' WHERE prescription_record_id='$_GET[editid]'";
    if($qsql = mysqli_query($conn,$sql))
    {
?>
        <div class="popup popup--icon -success js_success-popup popup--visible">
          <div class="popup__background"></div>
          <div class="popup__content">
            <h3 class="popup__content__title">
              Success
            </h3>
            <p>Prescription record updated successfully.</p>
            <p>
             <!--  <a href="index.php"><button class="button button--success" data-for="js_success-popup"></button></a> -->
             <?php echo "<script>setTimeout(\"location.href = 'prescriptionrecord.php';\",1500);</script>"; ?>
            </p>
          </div>
        </div>
<?php
      //echo "<script>alert('prescription record updated successfully...');</script>";
    }
    else
    {
      echo mysqli_error($conn);
    }
  }
  else
  {
    $sql ="INSERT INTO prescription_records(prescription_id,medicine_name,unit,dosage,instruction) values('$_POST[prescriptionid]','$_POST[medicineid]','$_POST[unit]','$_POST[dosage]','Active','$_POST[instruction]')";
    if($qsql = mysqli_query($conn,$sql))
    {
      $presamt=$_POST[cost]*$_POST[unit];
      $billtype = "Prescription update";
      $prescriptionid= $_POST[prescriptionid];
      //include("insertbillingrecord.php");
?>
        <div class="popup popup--icon -success js_success-popup popup--visible">
          <div class="popup__background"></div>
          <div class="popup__content">
            <h3 class="popup__content__title">
              Success
            </h3>
            <p>Prescription record Inserteed successfully.</p>
            <p>
             <!--  <a href="index.php"><button class="button button--success" data-for="js_success-popup"></button></a> -->
             <?php echo "<script>setTimeout(\"location.href = 'prescriptionrecord.php?prescriptionid=$_GET[prescriptionid]&patientid=$_GET[patientid]&appid=$_GET[appid]';\",1500);</script>"; ?>
            </p>
          </div>
        </div>
<?php
      //echo "<script>alert('prescription record inserted successfully...');</script>";
      //echo "<script>window.location='prescriptionrecord.php?prescriptionid=$_GET[prescriptionid]&patientid=$_GET[patientid]&appid=$_GET[appid]';</script>";
    }
    else
    {
      echo mysqli_error($conn);
    }
  }
}
if(isset($_GET['editid']))
{
  $sql="SELECT * FROM prescription_records WHERE prescription_record_id='$_GET[editid]' ";
  $qsql = mysqli_query($conn,$sql);
  $rsedit = mysqli_fetch_array($qsql);

}
?>
<?php
if(isset($_GET['id']))
{ ?>
<div class="popup popup--icon -question js_question-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Sure
    </h1>
    <p>Are You Sure To Delete This Record?</p>
    <p>
      <a href="view-pending-appointment.php?delid=<?php echo $_GET['id']; ?>" class="button button--success" data-for="js_success-popup">Yes</a>
      <a href="view-pending-appointment.php" class="button button--error" data-for="js_success-popup">No</a>
    </p>
  </div>
</div>
<?php } ?>
<div class="pcoded-content">
<div class="pcoded-inner-content">

<div class="main-body">
<div class="page-wrapper">

<div class="page-header">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
<div class="d-inline">
<h4>Prescription Record
</h4>

</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class="breadcrumb-title">
<li class="breadcrumb-item">
<a href="index.php"> <i class="feather icon-home"></i> </a>
</li>
<li class="breadcrumb-item"><a>Prescription Record</a>
</li>
<li class="breadcrumb-item"><a href="#">Prescription Record</a>
</li>
</ul>
</div>
</div>
</div>
</div>

<div class="page-body">

<div class="card">
<div class="card-header">
    <div class="col-sm-10">
    </div>
</div>
<div class="card-block">
<div class="table-responsive dt-responsive">
<table id="" class="table table-striped table-bordered nowrap">
<thead>
<tr>
    <th>Doctor Name</th>
    <th>Patient Name</th>
    <th>Prescription Date</th>
    <th>Status</th>
</tr>
</thead>
<tbody>
<?php
    $sql ="SELECT * FROM prescription WHERE prescriptionid='$_GET[prescriptionid]'";
    $qsql = mysqli_query($conn,$sql);
    while($rs = mysqli_fetch_array($qsql))
    {
      $sqlpatient = "SELECT * FROM patient WHERE patientid='$rs[patientid]'";
      $qsqlpatient = mysqli_query($conn,$sqlpatient);
      $rspatient = mysqli_fetch_array($qsqlpatient);


    $sqldoctor = "SELECT * FROM doctor WHERE doctorid='$rs[doctorid]'";
      $qsqldoctor = mysqli_query($conn,$sqldoctor);
      $rsdoctor = mysqli_fetch_array($qsqldoctor);

        echo "<tr>
          <td>&nbsp;$rsdoctor[doctorname]</td>
          <td>&nbsp;$rspatient[patientname]</td>
       <td>&nbsp;$rs[prescriptiondate]</td>
    <td>&nbsp;$rs[status]</td>

        </tr>";
    }
    ?>
</tbody>

</table>
</div>
</div>
</div>

<?php if(($_SESSION['user'] == 'doctor')){ ?>
<h3>Medicine</h3>
<div class="card">
  <?php
      if(!isset($_SESSION['patientid']))
      {
      ?>
<form method="post" action="add_medicine.php" name="frmpresrecord">
  <input type="hidden" name="prescriptionid" value="<?php echo $_GET['prescriptionid']; ?>"  />
  <input type="hidden" name="patientid" value="<?php echo $_GET['patientid']; ?>"  />

    <div class="table-responsive dt-responsive">
    <table id="" class="table table-striped table-bordered nowrap">
      <tbody>

        <tr>
          <td width="34%">Medicine</td>
          <td width="66%">
      <select class="form-control show-tick" name="medicineid" id="medicineid" onchange="loadmedicine(this.value)">
      <option value="">Select Medicine</option>
      <?php
    $sqlmedicine ="SELECT * FROM medicine WHERE status='Active'";
    $qsqlmedicine = mysqli_query($conn,$sqlmedicine);
    while($rsmedicine = mysqli_fetch_array($qsqlmedicine))
    {
      echo "<option value='$rsmedicine[medicineid]'>$rsmedicine[medicinename] ($rsmedicine[medicinetype])</option>";
    }
    ?>
      </select>
      </td>
        </tr>
        <tr>
          <td>Unit</td>
          <td>
            <select class="form-control show-tick" name="unit" id="unit" value="<?php echo $rsedit['unit']; ?>">
             <option value="">Select</option>
            <?php
        $arr = array("1","2","3","4","5","6","7","8","9","10","12","14","16","20","30");
        foreach($arr as $val)
        {
         if($val == $rsedit['unit'])
          {
          echo "<option value='$val' selected>$val</option>";
          }
          else
          {
            echo "<option value='$val'>$val</option>";
          }
        }
        ?>
            </select>
        </td>
        </tr>
        <tr>
          <td>Dosage</td>
          <td><select class="form-control show-tick" name="dosage" id="dosage">
           <option value="">Select</option>
          <?php
      $arr = array("0-0-1","0-1-1","1-0-1","1-1-1","1-1-0","0-1-0","1-0-0");
      foreach($arr as $val)
      {
       if($val == $rsedit['dosage'])
        {
        echo "<option value='$val' selected>$val</option>";
        }
        else
        {
          echo "<option value='$val'>$val</option>";
        }
      }
      ?>
          </select></td>
        </tr>
        <tr>
          <td>Instructions</td>
          <td><select class="form-control show-tick" name="instruction" id="instruction" value="<?php echo $rsedit['instruction']; ?>">
            <option value="">Select</option>
            <option value="Before Food">Before Food</option>
            <option value="After Food">After Food</option>
            <option value="When required">When required</option>
          </select>
        </td>
        </tr>
        <tr>
          <td colspan="2" align="center"><button id="submit" type="submit" name="submit" class="btn btn-primary m-b-0">Submit</button></td>
        </tr>
      </tbody>
    </table>
  </div>
    </form>
    <?php
      }
    ?>
</div>


<h3>Lifestyle Advice</h3>
<div class="card">
  <?php
      if(!isset($_SESSION['patientid']))
      {
      ?>
<form method="post" action="add_lifestyle.php" name="frmpresrecord">
  <input type="hidden" name="prescriptionid" value="<?php echo $_GET['prescriptionid']; ?>"  />
  <input type="hidden" name="patientid" value="<?php echo $_GET['patientid']; ?>"  />
    <div class="table-responsive dt-responsive">
    <table id="" class="table table-striped table-bordered nowrap">
      <tbody>

        <tr>
          <td width="34%">Review with</td>
          <td width="66%">
            <input class="form-control show-tick" type="text" name="review_with" value="" placeholder="Tests..." />
      </td>
        </tr>
        <tr>
          <td>Next review on</td>
          <td><input class="form-control show-tick" type="date" name="next_review" value="">
        </td>
        </tr>
        <tr>
          <td>Message</td>
          <td><input class="form-control show-tick" type="text" name="message" value="Prescription to be followed and to be reported on next review date.">
          </td>
        </tr>
        <tr>
          <td colspan="2" align="center"><button id="submit" type="submit" name="submit" class="btn btn-primary m-b-0">Submit</button></td>
        </tr>
      </tbody>
    </table>
  </div>
    </form>
    <?php
      }
    ?>
</div>
<?php } ?>



<?php if(($_SESSION['user'] == 'admin') || ($_SESSION['user'] == 'doctor') || ($_SESSION['user'] == 'patient')){ ?>
<h3>View Prescription record</h3>

<!-- ------------------------------------------------------------------------------------------------------- -->

<div class="print-block">

<div class="card">
<div class="card-header">
    <div class="col-sm-10">
      <div class="logo" style="float:left; margin-left:5%;">
        <image class="profile-img" src="uploadImage/Logo/<?php echo $logo; ?>" style="width: 100%"></image>
      </div>

      <div class="address" style="float:right; margin-right:5%;">
        <p class="add">
          <?php
          $add = "SELECT * FROM manage_website";
          $qadd = mysqli_query($conn,$add);
          while($rs = mysqli_fetch_array($qadd))
          {
            echo
            "<p><strong>&nbsp;$rs[business_name]</strong></p>
            <p>&nbsp;$rs[business_email]</p>
            <p>&nbsp;$rs[addr]</p>
            <p>&nbsp;$rs[business_web]</p>";
          }
           ?>
        </p>
      </div>
    </div>
</div>

<hr style="width:90%; margin-left:5%; margin-right:5%;">

<div class="card-block" style="margin-left:5%; margin-right:5%;">

  <div class="patient-details">
    <p class="add">
      <?php
          if(!isset($_SESSION['patientid']))
          {
      $ptr = "SELECT * FROM patient WHERE patientid='$_GET[patientid]'";
      $qptr = mysqli_query($conn,$ptr);


      while($rs = mysqli_fetch_array($qptr))
      {
        echo
        "<table>
        <tr>
        <td><strong>Patient Name:</strong></td>
        <td>&nbsp;&nbsp;&nbsp;$rs[patientname]</td>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Patient Id:</strong></td>
        <td>&nbsp;&nbsp;&nbsp;$rs[patientid]</td>
        </tr>
        <tr>
        <td><strong>Gender:</strong></td>
        <td>&nbsp;&nbsp;&nbsp;$rs[gender]</td>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Age:</strong></td>
        <td>&nbsp;&nbsp;&nbsp;    </td>
        </tr>
        <tr>
        <td><strong>Mobile No:</strong></td>
        <td>&nbsp;&nbsp;&nbsp;$rs[mobileno]</td>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Email:</strong></td>
        <td>&nbsp;&nbsp;&nbsp;$rs[loginid]</td>
        </tr>
        <tr>
        <td colspan='4'>&nbsp;&nbsp;&nbsp;</td>
        </tr>";
      }
    }
       ?>
    </p>
  </div>


  <div class="doctor-details" style="float:left;">
    <?php
    echo
    "<p><strong>$rsdoctor[doctorname]</strong></p>
    <p><h4>Prescription ( &rx; )</h4></p>";
     ?>
  </div>

  <div class="date" style="float:right;">
    <?php echo "Date:&nbsp;&nbsp;" . date("d-M-Y"); ?>
  </div>




<div class="table-responsive dt-responsive">
<table id="" class="table table-striped table-bordered nowrap">
<thead style="background-color: #ababab">
<tr>

          <td><strong>Medicine Name</strong></td>
          <td><strong>Unit</strong></td>
          <td><strong>Dosage</strong></td>
          <td><strong>Instructions</strong></td>
<!--
          <?php # if(($_SESSION['user'] == 'doctor')){ ?>
                    <?php /*
      if(!isset($_SESSION['patientid']))
      {
      ?>
          <td><strong>Action</strong></td>
          <?php
      } }
      */ ?>
    -->
</tr>
</thead>

<tbody>
         <?php
    $sql ="SELECT * FROM prescription_records LEFT JOIN medicine on prescription_records.medicine_name=medicine.medicineid WHERE prescription_id='$_GET[prescriptionid]'";
    $qsql = mysqli_query($conn,$sql);
    while($rs = mysqli_fetch_array($qsql))
    {
        echo "<tr>
          <td>&nbsp;$rs[medicine_name]</td>
          <td>&nbsp;$rs[unit]</td>
          <td align='center'>&nbsp;$rs[dosage]</td>
          <td>&nbsp;$rs[instruction]</td>";
          /*
          if(($_SESSION['user'] == 'doctor')){
      if(!isset($_SESSION['patientid']))
      {
       echo " <td>&nbsp; <a href='prescriptionrecord.php?delid=$rs[prescription_record_id]&prescriptionid=$_GET[prescriptionid]'>Delete</a> </td>";
     } }
     */
    echo "</tr>";
    }
    ?>

</tbody>
</table>
<br>

<div class="advice">
  <h4>Lifestyle Advice</h4>
  <br>
  <p></p>
  <p>
    <?php
    $sql ="SELECT * FROM lifestyle WHERE prescription_id='$_GET[prescriptionid]'";
    $qsql = mysqli_query($conn,$sql);
    while($rs = mysqli_fetch_array($qsql))
    {
      echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Review with <strong>$rs[review_with]</strong></br></br>";
      echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Next Review is on <b>".date("d-M-Y",strtotime($rs['next_review_on']))."</b>";
      echo "</br></br>";
      echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Note :</strong> $rs[message]";
      }
    ?>
  </p>

  <div class="sign" style="float:right; margin-top:100px; margin-right:100px;">
    <p align="center"><strong><?php echo $rsdoctor['doctorname'];?></strong></p>
    <p align="center">Authorized Signature</p>
  </div>

</div>
</div>

</div>
<div align="center">
<a href=""><input Class="btn btn-primary m-b-0" type="submit" name="print" id="print" value="Print" onclick="myFunction()"/></a>
</div>
</br>
<div class="ftr" style="width:100%; background:#2B66B1; padding:7px;">
  <h4 style="color:#ffffff;" align="center"><strong>Polyclinic, Mysore</strong></h4>
</div>
</div>

<?php } ?>

</div>

<!-- ------------------------------------------------------------------------------------------------------- -->


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
<?php if(!empty($_SESSION['success'])) {  ?>
<div class="popup popup--icon -success js_success-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Success
    </h1>
    <p><?php echo $_SESSION['success']; ?></p>
    <p>
     <?php echo "<script>setTimeout(\"location.href = 'view_user.php';\",1500);</script>"; ?>
      <!-- <button class="button button--success" data-for="js_success-popup">Close</button> -->
    </p>
  </div>
</div>
<?php unset($_SESSION["success"]);
} ?>
<?php if(!empty($_SESSION['error'])) {  ?>
<div class="popup popup--icon -error js_error-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Error
    </h1>
    <p><?php echo $_SESSION['error']; ?></p>
    <p>
     <?php echo "<script>setTimeout(\"location.href = 'view_user.php';\",1500);</script>"; ?>
     <!--  <button class="button button--error" data-for="js_error-popup">Close</button> -->
    </p>
  </div>
</div>
<?php unset($_SESSION["error"]);  } ?>
    <script>
      var addButtonTrigger = function addButtonTrigger(el) {
  el.addEventListener('click', function () {
    var popupEl = document.querySelector('.' + el.dataset.for);
    popupEl.classList.toggle('popup--visible');
  });
};

Array.from(document.querySelectorAll('button[data-for]')).
forEach(addButtonTrigger);
    </script>

    <script>
function myFunction() {
    window.print();
}
</script>
