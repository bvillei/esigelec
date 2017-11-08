<?php
// Initialize the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>HOME</title>
<?php include('head.php'); ?>
</head>
<body>

<?php include('header.php'); ?>
<?php include('navbar.php'); ?>

<div class="container-fluid text-center">
    <div class="row content">

        <?php include('sidebar.php'); ?>

        <div class="col-sm-10 text-left">
            <h1>Title about the webstite</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

</body>
</html>
