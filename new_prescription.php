<?php

$link = mysqli_connect("localhost", "root", "", "clinic_db");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Define variables and initialize with empty values

// Escape user inputs for security
$doctorid = mysqli_real_escape_string($link, $_REQUEST['doctorid']);
$patientid = mysqli_real_escape_string($link, $_REQUEST['patientid']);
$prescriptiondate = mysqli_real_escape_string($link, $_REQUEST['prescriptiondate']);
$status = mysqli_real_escape_string($link, $_REQUEST['status']);
$appointmentid = mysqli_real_escape_string($link, $_REQUEST['appointmentid']);

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){


// Attempt insert query execution
$sql = "INSERT INTO prescription (doctorid, patientid, delivery_type, delivery_id, prescriptiondate, status, appointmentid)
        VALUES ('$doctorid', '$patientid', 'Delivered through appointment', '$appointmentid', '$prescriptiondate', 'Active', '$appointmentid')";



if(mysqli_query($link, $sql)){
    header("location: patientreport.php?patientid=$patientid&appointmentid=$appointmentid");
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);
}

?>
