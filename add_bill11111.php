<?php

$link = mysqli_connect("localhost", "root", "", "clinic_db");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Define variables and initialize with empty values

// Escape user inputs for security
$patientid = mysqli_real_escape_string($link, $_REQUEST['patientid']);
$appointmentid = mysqli_real_escape_string($link, $_REQUEST['appointmentid']);
$billingdate = mysqli_real_escape_string($link, $_REQUEST['billingdate']);
$billingtime = mysqli_real_escape_string($link, $_REQUEST['billingtime']);

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){


// Attempt insert query execution
$sql = "INSERT INTO billing (patientid, appointmentid, billdate, billtime)
        VALUES ('$patientid', '$appointmentid', '$billdate', '$billtime')";



if(mysqli_query($link, $sql)){
    header("location: patientreport.php?patientid=$patientid&appointmentid=$appointmentid");
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);
}

?>
