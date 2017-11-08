<?php
// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
    header("location: login.php");
    exit;
}

if(isset($_POST['Add'])){ //új recept felvétele

// Include config file
    require_once 'config.php';
    $name = mysqli_real_escape_string($link,$_POST['name']);
    $query = "INSERT INTO category (name)" . "values ('$name')";
    mysqli_query($link, $query);
    mysqli_close($link);
    header("Location: listCategory.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add category</title>

    <?php include('head.php'); ?>
</head>
<body>

<?php include('header.php'); ?>
<?php include('navbar.php'); ?>

<div class="container-fluid text-center">
    <div class="row content">

        <?php include('sidebar.php'); ?>

        <div class="col-sm-6 text-left">

            <h2>Add New Category</h2>
            <form method="post" action="editCategory.php" onsubmit="alert('Successfully added');">
                <div class="form-group">
                    <label for="name">name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Name of the category" name="name" required>
                </div>
                <button name="Add" type="submit" value="ok" class="btn btn-primary">Add the category</button>
            </form>

        </div>
    </div>
</div>

<?php include('footer.php'); ?>

</body>
</html>