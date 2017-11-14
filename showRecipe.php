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

$name = $_GET['param']; //név lekérdezése URL-ből
$recipe = mysqli_query($link,"SELECT recipe.name AS recipe_name, ingredients, description, category.name AS category_name FROM recipe JOIN category ON category.id = recipe.category_id WHERE recipe.name='".$name."'"); //kiválsztott recept
$row = mysqli_fetch_assoc($recipe);

?>

<!DOCTYPE html>
<html>
<head>
    <title><?=$row["recipe_name"]?></title>
    <?php include('head.php'); ?>
</head>
<body>

<?php include('header.php'); ?>
<?php include('navbar.php'); ?>


<div class="container-fluid text-center">
    <div class="row content">

        <?php include('sidebar.php'); ?>

        <div class="col-sm-5 text-left">

            <h1><?=$row["recipe_name"]?></h1>

            <h4>Category: <?=$row["category_name"]?></h4>

            <h4>Ingredients: <?=$row["ingredients"]?></h4>

            <p><i>How to make it: </i><br/> <?=$row["description"]?></p>

            <td class="contact-delete">
                <form action='deleteRecipe.php?name="<?php echo $row['recipe_name'] ?>"' method="post">
                    <input type="hidden" name="name" value="<?php echo $row['recipe_name']; ?>">
                    <input type="submit" class="btn btn-danger" name="submit" value="Delete">
                </form>
            </td>

            <a class="btn btn-primary" href="editRecip.php?param=<?=$name?>">UPDATE</li></a>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

</body>
</html>