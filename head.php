

<!-- Author Name: Nikhil Bhalerao +919423979339.
PHP, Laravel and Codeignitor Developer
-->
<!DOCTYPE html>
<html lang="en">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<title>Admin Panel</title>


<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="description" content="#">
<meta name="keywords" content="Freelancer Nikhil Bhalerao">
<meta name="author" content="Freelancer Nikhil Bhalerao">
<?php
  include('connect.php');
$que="select * from manage_website";
$query=$conn->query($que);
while($row=mysqli_fetch_array($query))
{
  //print_r($row);
  extract($row);
  $logo = $row['logo'];
}
?>

<link rel="icon" href="uploadImage/Logo/<?php echo $logo; ?>" type="image/x-icon">
<link href="files/assets/css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">



<link rel="stylesheet" type="text/css" href="files/bower_components/bootstrap/css/bootstrap.min.css">


<link rel="stylesheet" type="text/css" href="files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="files/assets/pages/data-table/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="files/assets/css/default-css.css">
<link rel="stylesheet" type="text/css" href="files/assets/css/font-awesome.min.css">




<link rel="stylesheet" type="text/css" href="files/assets/icon/icofont/css/icofont.css">

<link rel="stylesheet" type="text/css" href="files/assets/icon/feather/css/feather.css">

<link rel="stylesheet" type="text/css" href="files/assets/css/style.css">


<link rel="stylesheet" type="text/css" href="files/assets/css/jquery.mCustomScrollbar.css">

<link rel="stylesheet" href="popup_style.css">
</head>
