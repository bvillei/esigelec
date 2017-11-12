<?php
// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
    header("location: login.php");
    exit;
}

if(isset($_POST['Add'])){ //új recept felvétele

// Include config file
    require_once 'config.php';
    $name = mysqli_real_escape_string($link,$_POST['name']);
    $ingredients = mysqli_real_escape_string($link,$_POST['ingredients']);
    $description = mysqli_real_escape_string($link,$_POST['description']);
    $category_id = mysqli_real_escape_string($link,$_POST['category_id']);
    $user_id = $_SESSION['id'];
    $query = "INSERT INTO recipe (name, ingredients, description, category_id, user_id)" . "values ('$name','$ingredients','$description','$category_id','$user_id')"; //beszúrás a receptek közé
    mysqli_query($link, $query);
    mysqli_close($link);
    header("Location: listRecipe.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Recipe Edit</title>

    <?php include('head.php'); ?>
</head>
<body>

<?php include('header.php'); ?>
<?php include('navbar.php'); ?>

<div class="container-fluid text-center">
    <div class="row content">

        <?php include('sidebar.php'); ?>

        <div class="col-sm-6 text-left">

                <h2>Edit the Recipe</h2>
                <form method="post" action="editRecipe.php" onsubmit="alert('Successfully added');">
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
                        <label for="category">Categories:</label>
                        <?php

                        require_once 'config.php';
                        $result = $link->query("select * from category");

                        echo "<select class='form-control' id='category_id' name='category_id'>";

                        while ($row = $result->fetch_assoc()) {
                            unset($id, $name);
                            $id = $row['id'];
                            $name = $row['name'];
                            echo '<option value="'.$id.'">'.$name.'</option>';
                        }

                        echo "</select>";
                        ?>
                    </div>
                    <button name="Add" type="submit" value="ok" class="btn btn-primary">Add the recipe</button>
                </form>

        </div>
    </div>
</div>

<?php //include('footer.php'); ?>

</body>
</html>