<?php
require_once 'config.php';

$name = $_POST['name'];

//Define the query
$query = "DELETE FROM recipe WHERE name='".$name."' LIMIT 1";

//sends the query to delete the entry
$res = mysqli_query ($link, $query);

// Catch errors
if(!$res) {printf("Errormessage: %s\n", $link->error);}

if (mysqli_affected_rows($link) == 1) {
//if it updated
    ?>
        <strong>Recipe Has Been Deleted</strong><br /><br />
    <?php
} else {
//if it failed
    ?>
        <strong>Deletion Failed</strong><br /><br />
    <?php
}
// After 3 seconds it redirect us to the Recipe list page
header( "refresh:3;url=listRecipe.php" );
?>