
<!-- Author Name: Nikhil Bhalerao +919423979339.
PHP, Laravel and Codeignitor Developer
-->
<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');
if(isset($_GET['id']))
{
  $sql ="UPDATE doctor_timings SET delete_status='1' WHERE doctor_timings_id='$_GET[id]'";
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
        <p>Visiting Hour record deleted successfully.</p>
        <p>
         <!--  <a href="index.php"><button class="button button--success" data-for="js_success-popup"></button></a> -->
         <?php echo "<script>setTimeout(\"location.href = 'view-visiting-hour.php';\",1500);</script>"; ?>
        </p>
      </div>
    </div>
<?php
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
      <a href="view-visiting-hour.php?id=<?php echo $_GET['delid']; ?>" class="button button--success" data-for="js_success-popup">Yes</a>
      <a href="view-visiting-hour.php" class="button button--error" data-for="js_success-popup">No</a>
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
<h4>Income Report</h4>

</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class="breadcrumb-title">
<li class="breadcrumb-item">
<a href="index.php"> <i class="feather icon-home"></i> </a>
</li>
<li class="breadcrumb-item"><a>Income Report</a>
</li>
<li class="breadcrumb-item"><a href="#">Income Report</a>
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
<!-- <h5>DOM/Jquery</h5>
<span>Events assigned to the table can be exceptionally useful for user interaction, however you must be aware that DataTables will add and remove rows from the DOM as they are needed (i.e. when paging only the visible elements are actually available in the DOM). As such, this can lead to the odd hiccup when working with events.</span> -->
</div>
<div class="card-block">
<div class="table-responsive dt-responsive">
<table id="dom-jqry" class="table table-striped table-bordered nowrap">
<thead>
<tr>
    <th width="97" scope="col">Date</th>
    <th width="245" scope="col">Decription</th>
    <th width="86" scope="col">Bill Amount</th>
</tr>
</thead>
<tbody>
        <?php
        $sql ="SELECT * FROM billing_records where bill_type='Consultancy Charge' AND bill_type_id='$_SESSION[doctorid]'";
        $qsql = mysqli_query($conn,$sql);
        $billamt= 0;
        while($rs = mysqli_fetch_array($qsql))
        {
          echo "<tr>
          <td>$rs[bill_date]</td>
          <td> $rs[bill_type]";

          if($rs['bill_type'] == "Service Charge")
          {
            $sqlservice_type1 = "SELECT * FROM service_type WHERE service_type_id='$rs[bill_type_id]'";
            $qsqlservice_type1 = mysqli_query($conn,$sqlservice_type1);
            $rsservice_type1 = mysqli_fetch_array($qsqlservice_type1);
            echo " - " . $rsservice_type1['service_type'];
          }

          if($rs['bill_type']== "Room Rent")
          {
            $sqlroomtariff = "SELECT * FROM room WHERE roomid='$rs[bill_type_id]'";
            $qsqlroomtariff = mysqli_query($conn,$sqlroomtariff);
            $rsroomtariff = mysqli_fetch_array($qsqlroomtariff);
            echo " : ". $rsroomtariff['roomtype'] .  "- Room No." . $rsroomtariff['roomno'];
          }

          if($rs['bill_type'] == "Consultancy Charge")
          {
  //Consultancy Charge
            $sqldoctor = "SELECT * FROM doctor WHERE doctorid='$rs[bill_type_id]'";
            $qsqldoctor = mysqli_query($conn,$sqldoctor);
            $rsdoctor = mysqli_fetch_array($qsqldoctor);
            echo " - Mr.".$rsdoctor['doctorname'];
          }

          if($rs['bill_type'] =="Treatment Cost")
          {
  //Treatment Cost
            $sqltreatment = "SELECT * FROM treatment WHERE treatmentid='$rs[bill_type_id]'";
            $qsqltreatment = mysqli_query($conn,$sqltreatment);
            $rstreatment = mysqli_fetch_array($qsqltreatment);
            echo " - ".$rstreatment['treatmenttype'];
          }

          if($rs['bill_type']  == "Prescription charge")
          {
            $sqltreatment = "SELECT * FROM prescription WHERE treatmentid='$rs[bill_type_id]'";
            $qsqltreatment = mysqli_query($conn,$sqltreatment);
            $rstreatment = mysqli_fetch_array($qsqltreatment);

            $sqltreatment1 = "SELECT * FROM treatment_records WHERE treatmentid='$rstreatment[treatment_records_id]'";
            $qsqltreatment1 = mysqli_query($conn,$sqltreatment1);
            $rstreatment1 = mysqli_fetch_array($qsqltreatment1);

            $sqltreatment2 = "SELECT * FROM treatment WHERE treatmentid='$rstreatment1[treatmentid]'";
            $qsqltreatment2 = mysqli_query($conn,$sqltreatment2);
            $rstreatment2 = mysqli_fetch_array($qsqltreatment2);
            echo  " - " . $rstreatment2['treatmenttype'];
          }

          echo " </td><td>₹. $rs[bill_amount]</td></tr>";
          $billamt = $billamt +  $rs['bill_amount'];
        }
        ?>


      </tbody>
      <tfoot>
        <tr>
          <td></td>
          <td>Total Earnings :</td>
          <td>₹. <?php echo $billamt; ?></td>
        </tr>
      </tfoot>
</table>
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
