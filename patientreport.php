<?php date_default_timezone_set("Asia/Kolkata"); ?>
<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');

if(isset($_POST['btnsubmit']))
{
  $bsql = "INSERT INTO billing (patientid, appointmentid, billingdate, billingtime)
          VALUES ('$_POST[patientid]', '$_POST[appointmentid]', '$_POST[billingdate]', '$_POST[billingtime]')";

            if($qsql = mysqli_query($conn,$bsql))
            {
            location: "patientreport.php?patientid=$_POST[patientid]&appointmentid=$_POST[appointmentid]";
          }
          else
          {
              echo mysqli_error($conn);
          }
}


if(isset($_GET['delid']))
{
  $sql ="UPDATE appointment SET delete_status='1' WHERE appointmentid='$_GET[delid]'";
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
         <?php echo "<script>setTimeout(\"location.href = 'view-pending-appointment.php';\",1500);</script>"; ?>
        </p>
      </div>
    </div>
 <?php
    //echo "<script>alert('appointment record deleted successfully..');</script>";
    //echo "<script>window.location='view-pending-appointment.php';</script>";
  }
}
if(isset($_GET['approveid']))
{
  $sql ="UPDATE patient SET status='Active' WHERE patientid='$_GET[patientid]'";
  $qsql=mysqli_query($conn,$sql);

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
         <?php echo "<script>setTimeout(\"location.href = 'view-pending-appointment.php';\",1500);</script>"; ?>
        </p>
      </div>
    </div>
 <?php
    //echo "<script>alert('Appointment record Approved successfully..');</script>";
    //echo "<script>window.location='view-pending-appointment.php';</script>";
  }
}
?>
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
<h4>Patient Report</h4>

</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class="breadcrumb-title">
<li class="breadcrumb-item">
<a href="index.php"> <i class="feather icon-home"></i> </a>
</li>
<li class="breadcrumb-item"><a>Patient Report</a>
</li>
<li class="breadcrumb-item"><a href="#">Report</a>
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
         <?php if(isset($useroles)){  if(in_array("create_user",$useroles)){ ?>
        <a href="add_user.php"><button class="btn btn-primary pull-right">+ Add Users</button></a>
        <?php } } ?>
    </div>
<!-- <h5>DOM/Jquery</h5>
<span>Events assigned to the table can be exceptionally useful for user interaction, however you must be aware that DataTables will add and remove rows from the DOM as they are needed (i.e. when paging only the visible elements are actually available in the DOM). As such, this can lead to the odd hiccup when working with events.</span> -->
</div>
<div class="card-block">
  <div class="row">
      <div class="col-lg-12">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs md-tabs tabs-left b-none" role="tablist">

            <?php if(($_SESSION['user'] == 'admin') || ($_SESSION['user'] == 'doctor')){ ?>

              <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#profile" role="tab">Patient Profile</a>
                  <div class="slide"></div>
              </li>
              <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#appointment" role="tab">Appointment Record</a>
                  <div class="slide"></div>
              </li>
              <!--
              <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#treatment" role="tab">Treatment Record</a>
                  <div class="slide"></div>
              </li>
            -->
              <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#prescription" role="tab">Prescription record</a>
                  <div class="slide"></div>
              </li>

              <?php } ?>

              <?php if($_SESSION['user'] == 'admin') { ?>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#bill" role="tab">Billing</a>
                    <div class="slide"></div>
                </li>

              <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#billing" role="tab">Billing Report</a>
                  <div class="slide"></div>
              </li>
              <!--
              <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#payment" role="tab">Payment Report</a>
                  <div class="slide"></div>
              </li>
            -->

              <?php } ?>

          </ul>
          <!-- Tab panes -->
          <div class="tab-content tabs-left-content card-block">
              <div class="tab-pane active" id="profile" role="tabpanel">
                  <p class="m-0">
              <?php
                $sqlpatient = "SELECT * FROM patient where patientid='$_GET[patientid]'";
                $qsqlpatient = mysqli_query($conn,$sqlpatient);
                $rspatient=mysqli_fetch_array($qsqlpatient);
              ?>

                  <div class="table-responsive dt-responsive">
                    <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                      <tbody>
                        <tr>
                          <th>Patient Name</th>
                          <td>&nbsp;<?php echo $rspatient['patientname']; ?></td>
                          <th>Patient ID</th>
                          <td>&nbsp;<?php echo $rspatient['patientid']; ?></td>
                        </tr>
                        <tr>
                          <th>Address</th>
                          <td>&nbsp;<?php echo $rspatient['address']; ?></td>
                          <th>Gender</th>
                          <td> <?php echo $rspatient['gender'];?></td>
                        </tr>
                        <tr>
                          <th>Contact Number</th>
                          <td>&nbsp;<?php echo $rspatient['mobileno']; ?></td>
                          <th>Date Of Birth </th>
                          <td>&nbsp;<?php echo $rspatient['dob']; ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  </p>
              </div>
              <div class="tab-pane" id="appointment" role="tabpanel">
                  <p class="m-0">
        <?php
          $sqlappointment1 = "SELECT max(appointmentid) FROM appointment where patientid='$_GET[patientid]' AND (status='Active' OR status='Approved')";
          $qsqlappointment1 = mysqli_query($conn,$sqlappointment1);
          $rsappointment1=mysqli_fetch_array($qsqlappointment1);

          $sqlappointment = "SELECT * FROM appointment where appointmentid='$rsappointment1[0]'";
          $qsqlappointment = mysqli_query($conn,$sqlappointment);
          $rsappointment=mysqli_fetch_array($qsqlappointment);

          $sqlappointment = "SELECT * FROM appointment where appointmentid='$rsappointment1[0]'";
          $qsqlappointment = mysqli_query($conn,$sqlappointment);
          $rsappointment=mysqli_fetch_array($qsqlappointment);

          $sqlroom = "SELECT * FROM room where roomid='$rsappointment[roomid]' ";
          $qsqlroom = mysqli_query($conn,$sqlroom);
          $rsroom =mysqli_fetch_array($qsqlroom);

          $sqldepartment = "SELECT * FROM department where departmentid='$rsappointment[departmentid]'";
          $qsqldepartment = mysqli_query($conn,$sqldepartment);
          $rsdepartment =mysqli_fetch_array($qsqldepartment);

          $sqldoctor = "SELECT * FROM doctor where doctorid='$rsappointment[doctorid]'";
          $qsqldoctor = mysqli_query($conn,$sqldoctor);
          $rsdoctor =mysqli_fetch_array($qsqldoctor);
        ?>
                    <div class="table-responsive dt-responsive">
                      <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                        <tr>
                          <th>Department</th>
                          <td>&nbsp;<?php echo $rsdepartment['departmentname']; ?></td>
                        </tr>
                        <tr>
                          <th>Doctor</th>
                          <td>&nbsp;<?php echo $rsdoctor['doctorname']; ?></td>
                        </tr>
                        <tr>
                          <th>Appointment Date</th>
                          <td>&nbsp;<?php echo date("d-M-Y",strtotime($rsappointment['appointmentdate'])); ?></td>
                        </tr>
                        <tr>
                          <th>Appointment Time</th>
                          <td>&nbsp;<?php echo date("h:i A",strtotime($rsappointment['appointmenttime'])); ?></td>
                        </tr>
                        <tr>
                          <th>Appointment Number</th>
                          <td>&nbsp;<?php echo $rsappointment['appointmentid']; ?></td>
                        </tr>
                      </table>
                    </div>
                  </p>
              </div>

              <div class="tab-pane" id="prescription" role="tabpanel">
                  <p class="m-0">
                    <div class="table-responsive dt-responsive">
                      <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                      <tr>
                        <th>Doctor Name</th>
                        <th>Patient Name</th>
                        <th>Prescription Date</th>
                        <th>View</th>
                        <?php if(($_SESSION['user'] == 'doctor')){ ?>
                        <th>

                          <form id="main" method="post" action="new_prescription.php" enctype="multipart/form-data">
                              <?php
                                  if(isset($_GET['patid']))
                                  {
                                      $sqlpatient= "SELECT * FROM patient WHERE patientid='".$_GET['patid']."'";
                                      $qsqlpatient = mysqli_query($con,$sqlpatient);
                                      $rspatient=mysqli_fetch_array($qsqlpatient);
                                      echo $rspatient[patientname] . " (Patient ID - $rspatient[patientid])";
                                      echo "<input type='hidden' name='select4' value='$rspatient[patientid]'>";
                                  }
                              ?>

                                    <input type="hidden" class="form-control" name="doctorid" value="<?php echo $rsdoctor['doctorid']; ?>">
                                    <input class="form-control" type="hidden" name="patientid" value="<?php echo $rspatient['patientid']; ?>">
                                    <input type="hidden" class="form-control" name="prescriptiondate" value="<?php echo date("Y-m-d"); ?>">
                                    <input type="hidden" class="form-control" name="appointmentid" value="<?php echo $rsappointment['appointmentid']; ?>">

                                    <button type="submit" name="submit" class="btn btn-primary m-b-0">Add Prescription</button>
                          </form>

                        </th>
                        <?php } ?>
                      </tr>
    <?php
      $sql ="SELECT * FROM prescription WHERE patientid='$_GET[patientid]'"; #AND appointmentid='$rsappointment[appointmentid]'
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
                <td><a class='btn btn-primary m-b-0' href='prescriptionrecord.php?prescriptionid=$rs[0]&patientid=$rs[patientid]' >View</td>
                  </tr>";
      }
    ?>
                      </table>
                    </div>
                  </p>

              </div>

<!-- ----------------------------------------------------------------------------------------------- -->
              <div class="tab-pane" id="bill" role="tabpanel">
                  <p class="m-0">
    <?php
      $billappointmentid= $rsappointment[0];
      $sqlbilling_records ="SELECT * FROM billing WHERE appointmentid='$billappointmentid'";
      $qsqlbilling_records = mysqli_query($conn,$sqlbilling_records);
      $rsbilling_records = mysqli_fetch_array($qsqlbilling_records);
    ?>
                    <div class="table-responsive dt-responsive">
                      <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                        <tbody>
                          <form class="" action="" method="POST">

                            <tr>
                              <th scope="col" ><div align="right">Patient Name &nbsp; </div></th>
                              <td><input class="form-control" type="text" name="patientname" value="<?php echo $rspatient['patientname'];?>" readonly></td>
                            </tr>
                          <tr>
                            <th scope="col" ><div align="right">Patient Id &nbsp; </div></th>
                            <td><input class="form-control" type="text" name="patientid" value="<?php echo $rspatient['patientid'];?>" readonly></td>
                          </tr>
                          <tr>
                            <th width="124" scope="col"><div align="right">Appointment Number &nbsp; </div></th>
                              <td width="413"><input class="form-control" type="text" name="appointmentid" value="<?php echo $rsappointment['appointmentid'];?>" readonly></td>
                          </tr>

                          <?php date_default_timezone_set("Asia/Kolkata"); ?>

                      <tr>
                        <th scope="col"><div align="right">Billing Date &nbsp; </div></th>
                        <td><input class="form-control" type="date" name="billingdate" value="<?php echo date("Y-m-d");?>"></td>
                        </tr>

                      <tr>
                        <th scope="col"><div align="right">Billing time &nbsp; </div></th>
                        <td><input class="form-control" type="time" name="billingtime" value="<?php echo date("h:i:s");?>"></td>
                        </tr>

                        <tr>
                          <td colspan="2" align="center"><button id="btnsubmit" type="submit" name="btnsubmit" class="btn btn-primary m-b-0">Submit</button></br></br>* Click only if new bill</td>
                        </tr>
                        </form>
                        <tr>
                          <td colspan="2">&nbsp;</td>
                        </tr>

                        <?php

                        if(isset($_POST['fbtnsubmit']))
                        {
                                  $sqlbill ="SELECT * FROM billing WHERE appointmentid='$rsappointment[appointmentid]'";
                                  $qsqlbill = mysqli_query($conn,$sqlbill);
                                  $rsbill = mysqli_fetch_array($qsqlbill);

                                  $sqlservice = "SELECT * FROM service_type WHERE service_type_id='$_POST[service_type_id]'";
                                  $qsqlservice = mysqli_query($conn,$sqlservice);
                                  $rsservice = mysqli_fetch_array($qsqlservice);

                                  $service_type = $rsservice['service_type'];
                                  $servicecharge = $rsservice['servicecharge'];

                                  $nsql = "INSERT INTO billing_records (billingid, bill_type_id, bill_type, bill_amount, bill_date, status)
                                            VALUES ('$rsbill[billingid]', '$_POST[service_type_id]', '$service_type', '$servicecharge', '$_POST[billingdate]', 'Active')";

                                    if($qsql = mysqli_query($conn,$nsql))
                                    {
                                      echo "<script>setTimeout(\"location.href = 'patientreport.php?patientid=$_POST[patientid]&appointmentid=$rsappointment[appointmentid]';\",1500);</script>";
                                  }
                                  else
                                  {
                                      echo mysqli_error($conn);
                                  }
                        }

                         ?>

                        <form class="" action="" method="POST">
                          <?php

                          $sqlbill ="SELECT * FROM billing WHERE appointmentid='$rsappointment[appointmentid]'";
                          $qsqlbill = mysqli_query($conn,$sqlbill);
                          $rsbill = mysqli_fetch_array($qsqlbill);

                           ?>
                           <tr style="display:none;">
                             <th scope="col"><div align="right">Billing ID &nbsp; </div></th>
                             <td><input class="form-control" type="text" name="billingid" value="<?php echo $rsbill['billingid'];?>"></td>
                             </tr>

                             <tr style="display:none;">
                               <th scope="col"><div align="right">Billing Date &nbsp; </div></th>
                               <td><input class="form-control" type="date" name="billingdate" value="<?php echo date("Y-m-d");?>"></td>
                               </tr>
                        <tr>
                          <th scope="col"><div align="right">Service &nbsp; </div></th>
                          <td>
                            &nbsp;<select class="form-control show-tick" name="service_type_id" id="service_type_id" onchange="loadmedicine(this.value)">
                          <option value="">Select Service</option>
                        <?php
                        $sqlservice ="SELECT * FROM service_type WHERE status='Active'";
                        $qsqlservice = mysqli_query($conn,$sqlservice);
                        while($rsservice = mysqli_fetch_array($qsqlservice))
                        {
                          echo "<option value='$rsservice[service_type_id]'>$rsservice[service_type] (&nbsp;&#8377;.&nbsp;$rsservice[servicecharge])</option>";
                        }
                        ?>
                          </select>
                        </td>
                      </tr>
                          <tr>
                            <td colspan="2" align="center"><button id="fbtnsubmit" type="submit" name="fbtnsubmit" class="btn btn-primary m-b-0">Submit</button></td>
                          </tr>
                          </form>
                        </tbody>
                      </table>
                    </div>

                    <div class="table-responsive dt-responsive">
                      <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                        <thead>
                         <tr>
                            <th width="97" scope="col">Date</th>
                            <th width="245" scope="col">Description</th>
                            <th width="86" scope="col">Bill Amount</th>
                          </tr>
                          </thead>
                          <tbody>
         <?php
            $sql ="SELECT * FROM billing_records where billingid='$rsbilling_records[billingid]'";
            $qsql = mysqli_query($conn,$sql);
            $billamt= 0;
            while($rs = mysqli_fetch_array($qsql))
            {
              echo "<tr>
                    <td>&nbsp;$rs[bill_date]</td>
              <td>&nbsp; $rs[bill_type]";

        if($rs['bill_type'] == "Service Charge")
        {
           $sqlservice_type1 = "SELECT * FROM service_type WHERE service_type_id='$rs[bill_type_id]'";
          $qsqlservice_type1 = mysqli_query($conn,$sqlservice_type1);
          $rsservice_type1 = mysqli_fetch_array($qsqlservice_type1);
          echo " - " . $rsservice_type1[service_type];
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
            echo " - ".$rsdoctor['doctorname'];
        }

        if($rs['bill_type'] =="Treatment Cost")
        {
          //Treatment Cost
          $sqltreatment = "SELECT * FROM treatment WHERE treatmentid='$rs[bill_type_id]'";
          $qsqltreatment = mysqli_query($con,$sqltreatment);
          $rstreatment = mysqli_fetch_array($qsqltreatment);
          echo " - ".$rstreatment['treatmenttype'];
        }

        if($rs['bill_type']  == "Prescription charge")
        {
          $sqltreatment = "SELECT * FROM prescription WHERE treatmentid='$rs[bill_type_id]'";
          $qsqltreatment = mysqli_query($con,$sqltreatment);
          $rstreatment = mysqli_fetch_array($qsqltreatment);

          $sqltreatment1 = "SELECT * FROM treatment_records WHERE treatmentid='$rstreatment[treatment_records_id]'";
          $qsqltreatment1 = mysqli_query($con,$sqltreatment1);
          $rstreatment1 = mysqli_fetch_array($qsqltreatment1);

          $sqltreatment2 = "SELECT * FROM treatment WHERE treatmentid='$rstreatment1[treatmentid]'";
          $qsqltreatment2 = mysqli_query($con,$sqltreatment2);
          $rstreatment2 = mysqli_fetch_array($qsqltreatment2);
          echo  " - " . $rstreatment2['treatmenttype'];
        }

          echo " </td><td>&nbsp;&#x20B9;. $rs[bill_amount]</td></tr>";
            $billamt = $billamt +  $rs['bill_amount'];
            }
            ?>
                        </tbody>
                      </table>
                    </div>

                    <div class="table-responsive dt-responsive">
                      <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                        <tbody>
                          <tr>
                            <th scope="col"><div align="right">Bill Amount &nbsp; </div></th>
                            <td>&nbsp;&#x20B9;. <?php echo $billamt; ?></td>
                          </tr>
                          <tr>
                            <th width="442" scope="col"><div align="right">Tax Amount (5%) &nbsp; </div></th>
                              <td width="95">&nbsp;&#x20B9;. <?php echo $taxamt = 5 * ($billamt / 100); ?>
                              </td>
                          </tr>

                      <tr>
                        <th scope="col"><div align="right">Discount &nbsp; </div></th>
                        <td>&nbsp;&#x20B9;. <?php echo $rsbilling_records['discount']; ?></td>
                        </tr>

                      <tr>
                        <th scope="col"><div align="right">Grand Total &nbsp; </div></th>
                        <td>&nbsp;&#x20B9;. <?php echo ($billamt + $taxamt)  - $rsbilling_records['discount'] ; ?></td>
                        </tr>
                        </tbody>
                      </table>
                    </div>
                  </p>
              </div>


              <div class="tab-pane" id="billing" role="tabpanel">
                  <p class="m-0">
    <?php
      $billappointmentid= $rsappointment[0];
      $sqlbilling_records ="SELECT * FROM billing WHERE appointmentid='$billappointmentid'";
      $qsqlbilling_records = mysqli_query($conn,$sqlbilling_records);
      $rsbilling_records = mysqli_fetch_array($qsqlbilling_records);
    ?>


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

      <div class="date" style="float:right;">
        <?php echo "<strong>Date:</strong>&nbsp;&nbsp;" . date("d-M-Y"); ?>
      </div>
    </br>

      <div class="details" style="float:left;">
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
            <td>&nbsp;&nbsp;&nbsp;</td>
            <td><strong>Bill number:</strong></td>
            <td>&nbsp;&nbsp;&nbsp;$rsbilling_records[billingid]</td>
            </tr>
            <tr>
            <td><strong>Patient ID:</strong></td>
            <td>&nbsp;&nbsp;&nbsp;$rs[patientid]</td>
            <td>&nbsp;&nbsp;&nbsp;</td>
            <td>&nbsp;&nbsp;&nbsp;</td>
            <td><strong>Appointment number:</strong></td>
            <td>&nbsp;&nbsp;&nbsp;$rsbilling_records[appointmentid]</td>
            </tr>
            <tr>
            <td colspan='4'>&nbsp;&nbsp;&nbsp;</td>
            </tr>";
          }
        }
           ?>
        </p>
      </div>


<!-- ----------------------------------------------------------------------------- -->

      <div class="table-responsive dt-responsive" style="display:none;">
        <table id="dom-jqry" class="table table-striped table-bordered nowrap" style="display:none;">
          <tbody>
            <tr>
              <th scope="col"><div align="right">Bill number &nbsp; </div></th>
              <td> <?php echo $rsbilling_records['billingid']; ?></td>
            </tr>
            <tr>
              <th width="124" scope="col"><div align="right">Appointment Number &nbsp; </div></th>
                <td width="413"> <?php echo $rsbilling_records['appointmentid']; ?>
                </td>
            </tr>

        <tr>
          <th scope="col"><div align="right">Billing Date &nbsp; </div></th>
          <td>&nbsp;<?php echo $rsbilling_records['billingdate']; ?></td>
          </tr>

        <tr>
          <th scope="col"><div align="right">Billing time&nbsp; </div></th>
          <td>&nbsp;<?php echo $rsbilling_records['billingtime'] ; ?></td>
          </tr>
          </tbody>
        </table>
      </div>

      <div class="table-responsive dt-responsive">
        <div class="title" align="center">
          <h5>INVOICE</h5>
        </div>
      </br>

        <table id="dom-jqry" class="table table-striped table-bordered nowrap">
          <thead>
           <tr>
              <th width="97" scope="col">Date</th>
              <th width="245" scope="col">Description</th>
              <th width="86" scope="col">Bill Amount</th>
            </tr>
            </thead>
            <tbody>
<?php
$sql ="SELECT * FROM billing_records where billingid='$rsbilling_records[billingid]'";
$qsql = mysqli_query($conn,$sql);
$billamt= 0;
while($rs = mysqli_fetch_array($qsql))
{
echo "<tr>
      <td>&nbsp;$rs[bill_date]</td>
<td>&nbsp; $rs[bill_type]";

if($rs['bill_type'] == "Service Charge")
{
$sqlservice_type1 = "SELECT * FROM service_type WHERE service_type_id='$rs[bill_type_id]'";
$qsqlservice_type1 = mysqli_query($conn,$sqlservice_type1);
$rsservice_type1 = mysqli_fetch_array($qsqlservice_type1);
echo " - " . $rsservice_type1[service_type];
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
echo " - ".$rsdoctor['doctorname'];
}

if($rs['bill_type'] =="Treatment Cost")
{
//Treatment Cost
$sqltreatment = "SELECT * FROM treatment WHERE treatmentid='$rs[bill_type_id]'";
$qsqltreatment = mysqli_query($con,$sqltreatment);
$rstreatment = mysqli_fetch_array($qsqltreatment);
echo " - ".$rstreatment['treatmenttype'];
}

if($rs['bill_type']  == "Prescription charge")
{
$sqltreatment = "SELECT * FROM prescription WHERE treatmentid='$rs[bill_type_id]'";
$qsqltreatment = mysqli_query($con,$sqltreatment);
$rstreatment = mysqli_fetch_array($qsqltreatment);

$sqltreatment1 = "SELECT * FROM treatment_records WHERE treatmentid='$rstreatment[treatment_records_id]'";
$qsqltreatment1 = mysqli_query($con,$sqltreatment1);
$rstreatment1 = mysqli_fetch_array($qsqltreatment1);

$sqltreatment2 = "SELECT * FROM treatment WHERE treatmentid='$rstreatment1[treatmentid]'";
$qsqltreatment2 = mysqli_query($con,$sqltreatment2);
$rstreatment2 = mysqli_fetch_array($qsqltreatment2);
echo  " - " . $rstreatment2['treatmenttype'];
}

echo " </td><td>&nbsp;&#x20B9;. $rs[bill_amount]</td></tr>";
$billamt = $billamt +  $rs['bill_amount'];
}
?>
          </tbody>
        </table>
      </div>

      <div class="table-responsive dt-responsive">
        <table id="dom-jqry" class="table table-striped table-bordered nowrap">
          <tbody>
            <tr>
              <th scope="col"><div align="right">Bill Amount &nbsp; </div></th>
              <td>&nbsp;&#x20B9;. <?php echo $billamt; ?></td>
            </tr>
            <tr>
              <th width="442" scope="col"><div align="right">Tax Amount (5%) &nbsp; </div></th>
                <td width="95">&nbsp;&#x20B9;. <?php echo $taxamt = 5 * ($billamt / 100); ?>
                </td>
            </tr>

        <tr>
          <th scope="col"><div align="right">Discount &nbsp; </div></th>
          <td>&nbsp;&#x20B9;. <?php echo $rsbilling_records['discount']; ?></td>
          </tr>

        <tr>
          <th scope="col"><div align="right">Grand Total &nbsp; </div></th>
          <td>&nbsp;&#x20B9;. <?php echo ($billamt + $taxamt)  - $rsbilling_records['discount'] ; ?></td>
          </tr>
          </tbody>
        </table>

        <div class="sign" style="float:right; margin-top:100px; margin-right:100px;">
          <p align="center"><strong><?php echo $_SESSION['fname'];?></strong></p>
          <p align="center">Authorized Signature</p>
        </div>

      </div>





<!-- ----------------------------------------------------------------------------- -->



    </div>

    <div class="ftr" style="width:100%; background:#2B66B1; padding:7px;">
      <h4 style="color:#ffffff;" align="center"><strong>Polyclinic, Mysore</strong></h4>
    </div>

    </div>

    <div align="center">
    <a href=""><input Class="btn btn-primary m-b-0" type="submit" name="print" id="print" value="Print" onclick="myFunction()"/></a>
    </div>

    </div>







                  </p>
              </div>


              <div class="tab-pane" id="payment" role="tabpanel" style="display:none;">
                  <p class="m-0">
    <?php
      $billappointmentid= $rsappointment[0];
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
                     <a class="btn btn-primary" href="paymentdischarge.php?appointmentid=<?php echo $rsappointment[0]; ?>&patientid=<?php echo $_GET['patientid']; ?>">Make Payment</a>
                    </div>
                  </p>
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
