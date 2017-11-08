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
$eredmeny = mysqli_query($link,"SELECT name FROM recipe"); //receptek lekérdezése
?>

<!DOCTYPE html>
<html>
<head>
    <title>Recipes</title>
    <?php include('head.php'); ?>
</head>
<body>

<?php include('header.php'); ?>
<?php include('navbar.php'); ?>

<div class="container-fluid text-center">
    <div class="row content">

        <?php include('sidebar.php'); ?>

        <div class="col-sm-5 text-left">

            <h1>List of Recipes that you wish to edit:</h1>
            <?php while($sor = mysqli_fetch_array($eredmeny)): ?>
                <ul class="list-group">
                    <a href="showRecipe.php?param=<?=$sor['name']?>"><li class="list-group-item list-group-item-action"><?=$sor['name']?></li></a>
                </ul>
            <?php endwhile; ?>
            <?php
            mysqli_close($link);
            ?>

            <a href="editRecipe.php"><button type="button" class="btn btn-primary">Add New Recipe</button></a>

        </div>
    </div>
</div>

<?php include('footer.php'); ?>

</body>
</html>