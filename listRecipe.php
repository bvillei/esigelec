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
// Basically we use all the characters, so we get all the recipes
$category_name = '%';
// Search engine
if(isset($_POST['Search'])){
    // If we
    $category_name = mysqli_real_escape_string($link, $_POST['category_id']);
}
$eredmeny = mysqli_query($link,"SELECT recipe.name AS recipe_name, category_id, category.name AS category_name FROM recipe JOIN category ON category.id = recipe.category_id WHERE category.name LIKE '$category_name' ");
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

                    require_once 'config.php';
                    $result = $link->query("select * from category");

                    echo "<select class='form-control' id='category_id' name='category_id'>";

                    echo "<option value='%'>ALL RECIPE</option>";

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
            <?php while($sor = mysqli_fetch_array($eredmeny)): ?>
                <ul class="list-group">
                    <a href="showRecipe.php?param=<?=$sor['recipe_name']?>"><li class="list-group-item list-group-item-action"><?=$sor['recipe_name']?></li></a>
                </ul>
            <?php endwhile; ?>
            <?php
            mysqli_close($link);
            ?>

            <a href="addRecipe.php"><button type="button" class="btn btn-primary">Add New Recipe</button></a>

        </div>
    </div>
</div>

<?php include('footer.php'); ?>

</body>
</html>