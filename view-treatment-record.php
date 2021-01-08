
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
  $sql ="UPDATE department SET delete_status='1' WHERE departmentid='$_GET[id]'";
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
            <p>Treatment record deleted successfully.</p>
            <p>
             <!--  <a href="index.php"><button class="button button--success" data-for="js_success-popup"></button></a> -->
             <?php echo "<script>setTimeout(\"location.href = 'view-treatment-record.php';\",1500);</script>"; ?>
            </p>
          </div>
        </div>
     <?php
    //echo "<script>alert('Treatment record deleted successfully..');</script>";
    //echo "<script>window.location='view-treatment-record.php';</script>";
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
      <a href="view-treatment-record.php?id=<?php echo $_GET['delid']; ?>" class="button button--success" data-for="js_success-popup">Yes</a>
      <a href="view-treatment-record.php" class="button button--error" data-for="js_success-popup">No</a>
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
<h4>View Treatment Record</h4>

</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class="breadcrumb-title">
<li class="breadcrumb-item">
<a href="index.php"> <i class="feather icon-home"></i> </a>
</li>
<li class="breadcrumb-item"><a>View Treatment Record</a>
</li>
<li class="breadcrumb-item"><a href="#">View Treatment Record</a>
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
    <th width="71"  scope="col">Treatment type</th>
    <th width="52"  scope="col">Patient</th>
    <th width="78"  scope="col">Doctor</th>
    <th width="82"  scope="col">Treatment Description</th>
    <th width="43"  scope="col">Treatment date</th>
    <th width="43"  scope="col">Treatment time</th>
</tr>
</thead>
<tbody>
  <?php
    $sql ="SELECT * FROM treatment_records where status='Active'";
    if(isset($_SESSION['patientid']))
    {
      $sql = $sql . " AND patientid='$_SESSION[patientid]'";
    }
    if(isset($_SESSION['doctorid']))
    {
      $sql = $sql . " AND doctorid='$_SESSION[doctorid]'";
    }
    $qsql = mysqli_query($conn,$sql);
    while($rs = mysqli_fetch_array($qsql))
    {
      $sqlpat = "SELECT * FROM patient WHERE patientid='$rs[patientid]'";
      $qsqlpat = mysqli_query($conn,$sqlpat);
      $rspat = mysqli_fetch_array($qsqlpat);

      $sqldoc= "SELECT * FROM doctor WHERE doctorid='$rs[doctorid]'";
      $qsqldoc = mysqli_query($conn,$sqldoc);
      $rsdoc = mysqli_fetch_array($qsqldoc);

      $sqltreatment= "SELECT * FROM treatment WHERE treatmentid='$rs[treatmentid]'";
      $qsqltreatment = mysqli_query($conn,$sqltreatment);
      $rstreatment = mysqli_fetch_array($qsqltreatment);

        echo "<tr>
          <td>&nbsp;$rstreatment[treatmenttype]</td>
       <td>&nbsp;$rspat[patientname]</td>
        <td>&nbsp;$rsdoc[doctorname]</td>
      <td>&nbsp;$rs[treatment_description]</td>
       <td>&nbsp;$rs[treatment_date]</td>
        <td>&nbsp;$rs[treatment_time]</td>";

       echo " </tr>";
    }
    ?>
</tbody>
<tfoot>
<tr>
    <th>Doctor Name</th>
    <th>Description</th>
    <th>Status</th>
    <?php
      if(isset($_SESSION['adminid']))
      {
        ?>
        <td><strong>Action</strong></td>
        <?php
      }
    ?>
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
