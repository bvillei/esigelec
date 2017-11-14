<?php
// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
    header("location: login.php");
    exit;
}

// Include config file
require_once 'config.php';
//Get the name of the category from the URL
$URL_name = $_GET['param'];
// Get the category which name is in the URL
$category = mysqli_query($link,"SELECT name FROM category WHERE name='".$URL_name."'");
$row = mysqli_fetch_array($category);

// Edit the selected category
if(isset($_POST['Update'])){

// Include config file
    require_once 'config.php';
// Get the data from the form
    $name = mysqli_real_escape_string($link,$_POST['name']);
// Edit the selected category name with an UPDATE query
    $query = "UPDATE category SET name='$name' WHERE name='$URL_name'";
    mysqli_query($link, $query);
// Close the connection
    mysqli_close($link);
// Navigate to the list page of categories
    header("Location: listCategory.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Category</title>
    <?php include('head.php'); ?>
</head>
<body>

<?php include('header.php'); ?>
<?php include('navbar.php'); ?>

<div class="container-fluid text-center">
    <div class="row content">

        <?php include('sidebar.php'); ?>

        <div class="col-sm-6 text-left">

            <h2>Update the Category</h2>

<!--            The form to edit the selected category -->
            <form method="post" action="editCategory.php?param=<?php echo $URL_name; ?>">
                <div class="form-group">
                    <label for="name">Category:</label>
<!--                    In the input field we show the stored name of the selected category-->
                    <input type="text" class="form-control" id="name" placeholder="Give a Category name" name="name" value="<?=$row["name"]?>" required>
                </div>
                <button name="Update" type="submit" value="ok" class="btn btn-primary">Update the Category</button>
            </form>

        </div>
    </div>
</div>

<?php include('footer.php'); ?>

</body>
</html>