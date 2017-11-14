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
// Get all the category
$eredmeny = mysqli_query($link,"SELECT name FROM category");
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Categories</title>
    <?php include('head.php'); ?>
</head>
<body>

<?php include('header.php'); ?>
<?php include('navbar.php'); ?>

<div class="container-fluid text-center">
    <div class="row content">

        <?php include('sidebar.php'); ?>

        <div class="col-sm-5 text-left">

            <h1>List of the Categories:</h1>
            <?php while($row = mysqli_fetch_array($eredmeny)): ?>
                <ul class="list-group">
                    <li class="list-group-item justify-content-between">
<!--                        If we have admin role, then we can click on the categories, and go to the edit page of the category-->
                        <?php if($_SESSION['admin'] != 1){ ?>
                            <a href="editCategory.php?param=<?=$row['name']?>"><?=$row['name']?></a>
<!--                            If we are not admin, then we can't click on the categories, and we can't edit just see the categories-->
                        <?php } else { ?>
                            <?=$row['name']?>
                        <?php } ?>
<!--                        If we have admin role, then we can see a delete button. If we click on it, then we delete the category.-->
                        <?php if($_SESSION['admin'] != 1){ ?>
                            <span class="badge badge-default badge-pill">
                                <form action='deleteCategory.php?name="<?php echo $row['name'] ?>"' method="post">
                                    <input type="hidden" name="name" value="<?php echo $row['name']; ?>">
                                    <input type="submit" name="submit" class="btn-danger" value="Delete">
                                </form>
                            </span>
                        <?php } ?>
                    </li>
                </ul>
            <?php endwhile; ?>
            <?php
            // Close the connection
            mysqli_close($link);
            ?>

<!--            Button to add new category-->
            <a href="addCategory.php"><button type="button" class="btn btn-primary">Add New Category</button></a>

        </div>
    </div>
</div>

<?php include('footer.php'); ?>

</body>
</html>