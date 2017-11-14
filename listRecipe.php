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
// Basically we use the '%' operator, so we get all the recipes
$category_name = '%';
// Search engine
if(isset($_POST['Search'])){
    // If we searched for a category, then we change the category_name to the searched category
    $category_name = mysqli_real_escape_string($link, $_POST['category_id']);
}
// We get the recipes with the searched category
$query = mysqli_query($link,"SELECT recipe.name AS recipe_name, category_id, category.name AS category_name FROM recipe JOIN category ON category.id = recipe.category_id WHERE category.name LIKE '$category_name' ");
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

            <h1>List of the Recipes:</h1>

            <form method="post" action="listRecipe.php">
                <div class="form-group">
                    <label for="category">Category:</label>
                    <?php

                    // Include config file
                    require_once 'config.php';
                    // Get all the categories from the database
                    $result = $link->query("select * from category");

                    echo "<select class='form-control' id='category_id' name='category_id'>";

                    // ALL RECIPE category, if we want to change back to all the recipes. (We do a search with a '%' operator)
                    echo "<option value='%'>ALL RECIPE</option>";

                    // Show the categories as a drop-down list
                    while ($row = $result->fetch_assoc()) {
                        unset($name);
                        $name = $row['name'];
                        echo '<option value="'.$name.'">'.$name.'</option>';
                    }
                    echo "</select>";
                    ?>
                </div>
                <button name="Search" type="submit" value="ok" class="btn btn-primary">Search</button>
            </form>

            <br/>

            <label for="list">Recipes:</label>
<!--            Write in a list the recipes-->
            <?php while($row = mysqli_fetch_array($query)): ?>
                <ul class="list-group">
<!--                    All the recipes in the list are links, if we click on that, then we can go to the deatils page of the recipe.-->
                    <a href="showRecipe.php?param=<?=$row['recipe_name']?>"><li class="list-group-item list-group-item-action"><?=$row['recipe_name']?></li></a>
                </ul>
            <?php endwhile; ?>
            <?php
            // Close the conncetion
            mysqli_close($link);
            ?>

<!--            Add new recipe button, which one navigates us to the 'addRecipe.php' site-->
            <a href="addRecipe.php"><button type="button" class="btn btn-primary">Add New Recipe</button></a>

        </div>
    </div>
</div>

<?php include('footer.php'); ?>

</body>
</html>