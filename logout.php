<?php
session_start(); //to ensure you are using same session
session_destroy(); //destroy the session

?>
<script>
window.location="login.php";
</script>
<?php
//to redirect back to "index.php" after logging out
  exit;
?>
