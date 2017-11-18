<?php
// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
    header("location: login.php");
    exit;
}

//Add new recipe
if(isset($_POST['Add'])){ //új recept felvétele

// Include config file
    require_once 'config.php';
// Get the data from the form
    $name = mysqli_real_escape_string($link,$_POST['name']);
    $ingredients = mysqli_real_escape_string($link,$_POST['ingredients']);
    $description = mysqli_real_escape_string($link,$_POST['description']);
    $category_id = mysqli_real_escape_string($link,$_POST['category_id']);
// Get the user id from the session. We will add to the recipe as user_id.
    $user_id = $_SESSION['id'];
// Add the new recipe to the database
    $query = "INSERT INTO recipe (name, ingredients, description, category_id, user_id)" . "values ('$name','$ingredients','$description','$category_id','$user_id')";
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
    <title>Add Recipe</title>

    <?php include('head.php'); ?>
</head>
<body>

<?php include('header.php'); ?>
<?php include('navbar.php'); ?>

<div class="container-fluid text-center">
    <div class="row content">

        <?php include('sidebar.php'); ?>

        <div class="col-sm-6 text-left">

                <h2>Add new Recipe</h2>
<!--            The form to add new recipe -->
                <form method="post" action="addRecipe.php" onsubmit="alert('Successfully added');">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" placeholder="Name of the recipe" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="ingredients">Ingredients:</label>
                        <input type="text" class="form-control" id="ingredients" placeholder="Give the ingredients of the recipe" name="ingredients">
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" rows="5" id="description" placeholder="Give the description of the recipe" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="category">Category:</label>
                        <?php
                        // Include config file
                        require_once 'config.php';
                        // Get all the categories from the database
                        $result = $link->query("select * from category");

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
                    <button name="Add" type="submit" value="ok" class="btn btn-success">Save</button>
<!--                    Cancel button. If we click on the Cancel button, then we don't save the recipe, and it navigate us back to the list page-->
                    <a class="btn btn-warning" href="listRecipe.php">Cancel</li></a>
                </form>

        </div>
    </div>
</div>

<?php include('footer.php'); ?>

</body>
</html>