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
//Get the name of the recipe from the URL
$URL_name = $_GET['param'];
// Get the recipe which name is in the URL
$recipe = mysqli_query($link,"SELECT recipe.name AS recipe_name, ingredients, description, category.name AS category_name FROM recipe JOIN category ON category.id = recipe.category_id WHERE recipe.name='".$URL_name."'");
$row = mysqli_fetch_array($recipe);

// Edit the selected recipe
if(isset($_POST['Update'])){

// Include config file
    require_once 'config.php';
// Get the data from the form
    $name = mysqli_real_escape_string($link,$_POST['name']);
    $ingredients = mysqli_real_escape_string($link,$_POST['ingredients']);
    $description = mysqli_real_escape_string($link,$_POST['description']);
    $category_id = mysqli_real_escape_string($link,$_POST['category_id']);
// Edit the selected recipe data with an UPDATE query
    $query = "UPDATE recipe SET name='$name', ingredients='$ingredients', description='$description' WHERE name='$URL_name'";
    mysqli_query($link, $query);
// Close the connection
    mysqli_close($link);
// Navigate to the list page of recipes
    header("Location: listRecipe.php");
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

<!--            The form to edit the selected recipe-->
<!--            In the input field we show the stored data of the selected recipe-->
            <form method="post" action="editRecipe.php?param=<?php echo $URL_name; ?>">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Name of the recipe" name="name" value="<?=$row["recipe_name"]?>" required>
                </div>
                <div class="form-group">
                    <label for="ingredients">Ingredients:</label>
                    <input type="text" class="form-control" id="ingredients" placeholder="Give the ingredients of the recipe" name="ingredients" value="<?=$row["ingredients"]?>">
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <input class="form-control" id="description" placeholder="Give the description of the recipe" name="description" value="<?=$row["description"]?>">
                </div>
                <div class="form-group">
                    <label for="category">Category:</label>
                    <?php
                    // Include config file
                    require_once 'config.php';
                    $result = $link->query("select * from category");
                    // Get all the categories from the database
                    echo "<select class='form-control' id='category_id' name='category_id'>";

                    // set default text which won't be shown in drop-down list
                    echo "<option selected disabled hidden>Choose here</option>";
                    // Show the categories as a drop-down list
                    while ($row = $result->fetch_assoc()) {
                        unset($id, $name);
                        $id = $row['id'];
                        $name = $row['name'];
                        // Show the name and store the id of the category
                        echo '<option value="'.$id.'">'.$name.'</option>';
                    }

                    echo "</select>";
                    ?>
                </div>
                <button name="Update" type="submit" value="ok" class="btn btn-primary">Update the recipe</button>
            </form>

        </div>
    </div>
</div>

<?php include('footer.php'); ?>

</body>
</html>