
<!-- Author Name: Nikhil Bhalerao +919423979339.
PHP, Laravel and Codeignitor Developer
-->
<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');
if(isset($_POST["submitfullamount"]))
{
  $sql ="INSERT INTO payment(patientid,appointmentid,paiddate,paidtime,paidamount,status) values('$_GET[patientid]','$_GET[appointmentid]','$dt','$tim','$_POST[paidamount]','Active')";
  if($qsql = mysqli_query($conn,$sql))
  {
?>
        <div class="popup popup--icon -success js_success-popup popup--visible">
          <div class="popup__background"></div>
          <div class="popup__content">
            <h3 class="popup__content__title">
              Success
            </h3>
            <p>Payment record inserted successfully.</p>
            <p>
             <!--  <a href="index.php"><button class="button button--success" data-for="js_success-popup"></button></a> -->
             <?php echo "<script>setTimeout(\"location.href = 'patientreport.php';\",1500);</script>"; ?>
            </p>
          </div>
        </div>
<?php
   //echo "<script>alert('payment record inserted successfully...');</script>";
 }
 else
 {
   echo mysqli_error($conn);
 }

 $sql ="UPDATE billing SET discount=$_POST[discountamount]+ discount, discountreason=CONCAT('$_POST[discountreason] , ', discountreason),discharge_time='$_POST[dischargetime]',discharge_date='$_POST[dischargedate]' WHERE appointmentid='$_GET[appointmentid]'";
 $qsql = mysqli_query($conn,$sql);
 echo mysqli_error($conn);

 echo "<script>window.location='patientreport.php?patientid=$_GET[patientid]&appointmentid=$_GET[appointmentid]'</script>";
}
if(isset($_SESSION['patientid']))
{
  $sql="SELECT * FROM payment WHERE paymentid='$_GET[editid]' ";
  $qsql = mysqli_query($con,$sql);
  $rsedit = mysqli_fetch_array($qsql);

}
$billappointmentid = $_GET['appointmentid'];
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
<h4>Make Payment</h4>

</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class="breadcrumb-title">
<li class="breadcrumb-item">
<a href="index.php"> <i class="feather icon-home"></i> </a>
</li>
<li class="breadcrumb-item"><a>Make Payment</a>
</li>
<li class="breadcrumb-item"><a href="#">Make Payment</a>
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
  <?php
      $sqlbilling_records ="SELECT * FROM billing WHERE appointmentid='$billappointmentid'";
      $qsqlbilling_records = mysqli_query($conn,$sqlbilling_records);
      $rsbilling_records = mysqli_fetch_array($qsqlbilling_records);

    ?>
      <div class="table-responsive dt-responsive">
        <table id="dom-jqry" class="table table-striped table-bordered nowrap">
          <tbody>
            <tr>
              <th scope="col"><div align="right">Bill number &nbsp; </div></th>
              <td><?php echo $rsbilling_records['billingid']; ?></td>
              <td>Appointment Number &nbsp;</td>
              <td><?php echo $rsbilling_records['appointmentid']; ?></td>
            </tr>
            <tr>
              <th width="442" scope="col"><div align="right">Billing Date &nbsp; </div></th>
              <td width="413"><?php echo $rsbilling_records['billingdate']; ?></td>
              <td width="413">Billing time&nbsp; </td>
                <td width="413"><?php echo $rsbilling_records['billingtime'] ; ?></td>
            </tr>

        <tr>
              <th scope="col"><div align="right"></div></th>
              <td></td>
              <th scope="col"><div align="right">Bill Amount &nbsp; </div></th>
              <td><?php
        $sql ="SELECT * FROM billing_records where billingid='$rsbilling_records[billingid]'";
        $qsql = mysqli_query($conn,$sql);
        $billamt= 0;
        while($rs = mysqli_fetch_array($qsql))
        {
          $billamt = $billamt +  $rs['bill_amount'];
        }
    ?>
      &nbsp;&#x20B9;. <?php echo $billamt; ?></td>
            </tr>
            <tr>
              <th width="442" scope="col"><div align="right"></div></th>
              <td width="413">&nbsp;</td>
              <th width="442" scope="col"><div align="right">Tax Amount (5%) &nbsp; </div></th>
              <td width="413">&nbsp;&#x20B9;. <?php echo $taxamt = 5 * ($billamt / 100); ?></td>
            </tr>

        <tr>
          <th scope="col"><div align="right">Disount reason</div></th>
          <td rowspan="4" valign="top"><?php echo $rsbilling_records['discountreason']; ?></td>
          <th scope="col"><div align="right">Discount &nbsp; </div></th>
          <td>&nbsp;&#x20B9;. <?php echo $rsbilling_records['discount']; ?></td>
          </tr>

        <tr>
          <th rowspan="3" scope="col">&nbsp;</th>
          <th scope="col"><div align="right">Grand Total &nbsp; </div></th>
          <td>&nbsp;&#x20B9;. <?php echo $grandtotal = ($billamt + $taxamt)  - $rsbilling_records['discount'] ; ?></td>
          </tr>
        <tr>
          <th scope="col"><div align="right">Paid Amount </div></th>
          <td>&#x20B9;. <?php
            $sqlpayment ="SELECT sum(paidamount) FROM payment where appointmentid='$billappointmentid'";
          $qsqlpayment = mysqli_query($conn,$sqlpayment);
          $rspayment = mysqli_fetch_array($qsqlpayment);
          echo $rspayment[0];
           ?></td>
          </tr>
        <tr>
          <th scope="col"><div align="right">Balance Amount</div></th>
          <td>&#x20B9;. <?php echo $balanceamt = $grandtotal - $rspayment[0]  ; ?></td>
          </tr>
          </tbody>
        </table>

        <p><strong>Payment report:</strong></p>
        <?php
          $sqlpayment = "SELECT * FROM payment where appointmentid='$billappointmentid'";
          $qsqlpayment = mysqli_query($conn,$sqlpayment);
          if(mysqli_num_rows($qsqlpayment) == 0)
          {
            echo "<strong>No transaction details found..</strong>";
          }
          else
          {
        ?>
            <div class="table-responsive dt-responsive">
              <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                <tbody>
                   <tr>
                     <th scope="col">Paid Date</th>
                     <th scope="col">Paid time</th>
                     <th scope="col">Paid amount</th>
                   </tr>
            <?php
                while($rspayment = mysqli_fetch_array($qsqlpayment))
                {
                ?>
                     <tr>
                     <td>&nbsp;<?php echo $rspayment['paiddate']; ?></td>
                     <td>&nbsp;<?php echo $rspayment['paidtime']; ?></td>
                     <td>&nbsp;&#x20B9;. <?php echo $rspayment['paidamount']; ?></td>
                     </tr>
                <?php
                }
            ?>

                 </tbody>
              </table>
            </div>
      <?php } ?><br><br>

      <form method="post" action="">
        <div class="table-responsive dt-responsive">
          <table id="dom-jqry" class="table table-striped table-bordered nowrap">
            <thead>
            <tr>
              <th colspan="2">Discharge</th>
            </tr>
          </thead>
            <tbody>
              <tr>
                <td>Discharge date</td>
                <td><input class="form-control" name="dischargedate" type="text" id="dischargedate" value="<?php echo date("Y-m-d"); ?>" readonly></td>
              </tr>
              <tr>
                <td>Discharge time</td>
                <td><input class="form-control" name="dischargetime" type="text" id="dischargetime" value="<?php echo date("h:i:s"); ?>" readonly></td>
              </tr>
              <tr>
                <td>Balance amount</td>
                <td><input class="form-control" name="balamt" type="text" id="balamt" value="<?php echo $balanceamt; ?>" readonly onkeyup="calculatepayable()"></td>
              </tr>
              <tr>
                <td>Discount *</td>
                <td><input class="form-control" name="discountamount" type="text" id="discountamount" value="0" onkeyup="calculatepayable()"></td>
              </tr>
              <tr>
                <td>Payable amount</td>
                <td><input class="form-control" name="paidamount" type="text" id="paidamount" value="<?php echo $balanceamt; ?>" readonly></td>
              </tr>
              <tr>
                <td>Discount reason</td>
                <td><textarea name="discountreason" id="discountreason"></textarea></td>
              </tr>
              <tr>
                <td colspan="2" align="center"><input class="form-control" type="submit" name="submitfullamount" id="submitfullamount" value="Submit" /></td>
              </tr>
            </tbody>
          </table>
        </div>
      </form>


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
