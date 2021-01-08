<?php

$link = mysqli_connect("localhost", "root", "", "clinic_db");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Define variables and initialize with empty values


// Escape user inputs for security
$patientid = mysqli_real_escape_string($link, $_REQUEST['patientid']);
$prescription_id = mysqli_real_escape_string($link, $_REQUEST['prescriptionid']);
$review_with = mysqli_real_escape_string($link, $_REQUEST['review_with']);
$next_review = mysqli_real_escape_string($link, $_REQUEST['next_review']);
$message = mysqli_real_escape_string($link, $_REQUEST['message']);

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){


// Attempt insert query execution
$sql = "INSERT INTO lifestyle (prescription_id, review_with, next_review_on, message)
        VALUES ('$prescription_id', '$review_with', '$next_review_on', '$message')";



if(mysqli_query($link, $sql)){
    header("location: prescriptionrecord.php?prescriptionid=$prescription_id&patientid=$patientid&appid=$_GET[appid]");
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);
}

?>
