
<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');
if(isset($_GET['id']))
{
  $sql ="UPDATE appointment SET delete_status='1' WHERE departmentid='$_GET[id]'";
  $qsql=mysqli_query($conn,$sql);
  if(mysqli_affected_rows($conn) == 1)
  {
?>
         <div class="popup popup--icon -success js_success-popup popup--visible">
          <div class="popup__background"></div>
          <div class="popup__content">
            <h3 class="popup__content__title">
              Success
            </h3>
            <p>Appointment record deleted successfully.</p>
            <p>
             <!--  <a href="index.php"><button class="button button--success" data-for="js_success-popup"></button></a> -->
             <?php echo "<script>setTimeout(\"location.href = 'view-prescription.php';\",1500);</script>"; ?>
            </p>
          </div>
        </div>
<?php
    //echo "<script>alert('Department record deleted successfully..');</script>";
    //echo "<script>window.location='view-appointment.php';</script>";
  }
}


if(isset($_GET['approveid']))
{
  $sql ="UPDATE appointment SET status='Approved' WHERE appointmentid='$_GET[approveid]'";
  $qsql=mysqli_query($conn,$sql);
  if(mysqli_affected_rows($conn) == 1)
  {
?>
         <div class="popup popup--icon -success js_success-popup popup--visible">
          <div class="popup__background"></div>
          <div class="popup__content">
            <h3 class="popup__content__title">
              Success
            </h3>
            <p>Appointment record Approved successfully.</p>
            <p>
             <!--  <a href="index.php"><button class="button button--success" data-for="js_success-popup"></button></a> -->
             <?php echo "<script>setTimeout(\"location.href = 'view-prescription.php';\",1500);</script>"; ?>
            </p>
          </div>
        </div>
     <?php
    //echo "<script>alert('Appointment record Approved successfully..');</script>";
    //echo "<script>window.location='view-appointment.php';</script>";
  }
}
?>
<?php
if(isset($_GET['delid']))
{ ?>
<div class="popup popup--icon -question js_question-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Sure
    </h1>
    <p>Are You Sure To Delete This Record?</p>
    <p>
      <a href="view-department.php?id=<?php echo $_GET['delid']; ?>" class="button button--success" data-for="js_success-popup">Yes</a>
      <a href="view-department.php" class="button button--error" data-for="js_success-popup">No</a>
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
<h4>View Prescription Record</h4>

</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class="breadcrumb-title">
<li class="breadcrumb-item">
<a href="index.php"> <i class="feather icon-home"></i> </a>
</li>
<li class="breadcrumb-item"><a>View Prescription Record</a>
</li>
<li class="breadcrumb-item"><a href="#">View Prescription Record</a>
</li>
</ul>
</div>
</div>
</div>
</div>

<div class="page-body">
      <?php

      $sql ="SELECT * FROM prescription where patientid='$_SESSION[patientid]'";
      $qsql = mysqli_query($conn,$sql);
      while($rs = mysqli_fetch_array($qsql))
      {
        $sqlpatient = "SELECT * FROM patient WHERE patientid='$rs[patientid]'";
        $qsqlpatient = mysqli_query($conn,$sqlpatient);
        $rspatient = mysqli_fetch_array($qsqlpatient);

        $sqlpres ="SELECT * FROM prescription where patientid='$rs[patientid]'";
        $qsqlpres = mysqli_query($conn,$sqlpres);
        $rspres = mysqli_fetch_array($qsqlpres);

        $sqlprescription = "SELECT * FROM prescription_records WHERE prescription_id='$rspres[prescriptionid]'";
        $qsqlprescription = mysqli_query($conn,$sqlprescription);
        $rsprescription = mysqli_fetch_array($qsqlprescription);

        $sqldoctor = "SELECT * FROM doctor WHERE doctorid='$rs[doctorid]'";
        $qsqldoctor = mysqli_query($conn,$sqldoctor);
        $rsdoctor = mysqli_fetch_array($qsqldoctor);
      ?>




      <div class="card">
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
          $sql ="SELECT * FROM prescription WHERE prescriptionid='$rspres[prescriptionid]'";
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
          $sql ="SELECT * FROM prescription_records LEFT JOIN medicine on prescription_records.medicine_name=medicine.medicineid WHERE prescription_id='$rspres[prescriptionid]'";
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
          $sql ="SELECT * FROM lifestyle WHERE prescription_id='$rspres[prescriptionid]'";
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
      <div align="center">
      <a href=""><input Class="btn btn-primary m-b-0" type="submit" name="print" id="print" value="Print" onclick="myFunction()"/></a>
      </div>
      </div>
      <div class="ftr" style="width:100%; background:#2B66B1; padding:7px;">
        <h4 style="color:#ffffff;" align="center"><strong>Polyclinic, Mysore</strong></h4>
      </div>
      </div>

      </div>

<?php }?>






</div>

</div>
</div>

<div id="#">
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
  function myFunction()
  {
   window.print();
 }
</script>
