<?php
// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
    header("location: login.php");
    exit;
}

//Add new category
if(isset($_POST['Add'])){
// Include config file
    require_once 'config.php';
// Get the data from the form
    $name = mysqli_real_escape_string($link,$_POST['name']);
// Add the new category to the database
    $query = "INSERT INTO category (name)" . "values ('$name')";
    $res = mysqli_query($link, $query);
// Catch errors
    if(!$res) {printf("Errormessage: %s\n", $link->error);}
// Close the connection
    mysqli_close($link);
// Navigate to the list page of categories
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
<!--            The form to add new category -->
            <form method="post" action="addCategory.php" onsubmit="alert('Successfully added');">
                <div class="form-group">
                    <label for="name">name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Name of the category" name="name" required>
                </div>
                <button name="Add" type="submit" value="ok" class="btn btn-success">Save</button>
<!--                Cancel button. If we click on the Cancel button, then we don't save the recipe, and it navigate us back to the list page-->
                <a class="btn btn-warning" href="listCategory.php">Cancel</li></a>
            </form>

        </div>
    </div>
</div>

<?php include('footer.php'); ?>

</body>
</html>