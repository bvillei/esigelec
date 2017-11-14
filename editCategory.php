<?php
// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
    header("location: login.php");
    exit;
}

require_once 'config.php';
$URL_name = $_GET['param'];
$category = mysqli_query($link,"SELECT name FROM category WHERE name='".$URL_name."'"); //kiválsztott recept
$row = mysqli_fetch_array($category);

if(isset($_POST['Update'])){ //új recept felvétele

// Include config file
    require_once 'config.php';
    $name = mysqli_real_escape_string($link,$_POST['name']);
    $query = "UPDATE category SET name='$name' WHERE name='$URL_name'"; //beszúrás a receptek közé
    mysqli_query($link, $query);
    mysqli_close($link);
    header("Location: listCategory.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Recipe</title>

    <?php include('head.php'); ?>
</head>
<body>

<?php include('header.php'); ?>
<?php include('navbar.php'); ?>

<div class="container-fluid text-center">
    <div class="row content">

        <?php include('sidebar.php'); ?>

        <div class="col-sm-6 text-left">

            <h2>Update the Recipe</h2>

            <!--            <form method="post" action="editRecip.php" onsubmit="alert('Successfully added');">-->
            <form method="post" action="editCategory.php?param=<?php echo $URL_name; ?>">
                <div class="form-group">
                    <label for="name">Category:</label>
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