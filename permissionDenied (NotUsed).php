<?php
// If the user dont have admin role, then we redirect him/her to the home page with a permission denied message
if($_SESSION['admin'] !== 1){
    $message = "You do not have permission";
    echo "<SCRIPT type='text/javascript'>alert('$message'); window.location.replace('index.php'); </SCRIPT>";
    exit;
}
?>