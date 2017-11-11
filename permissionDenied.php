<?php
if($_SESSION['admin'] !== 1){
    $message = "You do not have permission";
    echo "<SCRIPT type='text/javascript'>alert('$message'); window.location.replace('index.php'); </SCRIPT>";
    exit;
}
?>