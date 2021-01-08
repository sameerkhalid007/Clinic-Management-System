
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
$medicine_id = mysqli_real_escape_string($link, $_REQUEST['medicineid']);
$unit = mysqli_real_escape_string($link, $_REQUEST['unit']);
$dosage = mysqli_real_escape_string($link, $_REQUEST['dosage']);
$instruction = mysqli_real_escape_string($link, $_REQUEST['instruction']);


$sql ="SELECT * FROM medicine WHERE medicineid=$medicine_id";
$qsql = mysqli_query($link,$sql);
while($rs = mysqli_fetch_array($qsql))
{
  $sqlmedicine = "SELECT * FROM medicine WHERE medicineid='$rs[medicineid]'";
  $qsqlmedicine = mysqli_query($link,$sqlmedicine);
  $rsmedicine = mysqli_fetch_array($qsqlmedicine);

$medicine_name = $rsmedicine['medicinename'];
$medicine_type = $rsmedicine['medicinetype'];

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){


// Attempt insert query execution
$sql = "INSERT INTO prescription_records (prescription_id, medicine_name, unit, dosage, instruction, status)
        VALUES ('$prescription_id', '$medicine_name ($medicine_type)', '$unit', '$dosage', '$instruction', 'Active')";



if(mysqli_query($link, $sql)){
    header("location: prescriptionrecord.php?prescriptionid=$prescription_id&patientid=$patientid&appid=$_GET[appid]");
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);
}
}
?>
