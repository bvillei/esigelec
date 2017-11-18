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
// get the parameter from the URL
$name = $_GET['param'];
// get the recipe that has the name field corresponding to the parameter which one stored in the URL
$recipe = mysqli_query($link,"SELECT recipe.name AS recipe_name, ingredients, description, category.name AS category_name FROM recipe JOIN category ON category.id = recipe.category_id WHERE recipe.name='".$name."'");
$row = mysqli_fetch_assoc($recipe);

?>

<!DOCTYPE html>
<html>
<head>
<!--    We use the recipe name as a title on this page-->
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

<!--            Delete function. If we click on the delete button, then the shown recipe will be deleted from the database-->
            <td class="contact-delete">
                <form action='deleteRecipe.php?name="<?php echo $row['recipe_name'] ?>"' method="post">
                    <input type="hidden" name="name" value="<?php echo $row['recipe_name']; ?>">
                    <input type="submit" class="btn btn-danger" name="submit" value="Delete">
<!--                    Edit button. If we click on the Edit button, then we go to the edit page of the recipe-->
                    <a class="btn btn-info" href="editRecipe.php?param=<?=$name?>">Edit</li></a>
<!--                    Cancel button. If we click on the Cancel button, then it navigate us back to the list page-->
                    <a class="btn btn-warning" href="listRecipe.php">Cancel</li></a>
                </form>
            </td>

        </div>
    </div>
</div>

<?php include('footer.php'); ?>

</body>
</html>