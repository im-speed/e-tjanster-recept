<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class FormIngredient
{
    public function __construct(public int $id, public float $weight)
    {
    }
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit("Form not submitted");
}

if (!isset($_POST["title"], $_POST["instructions"])) {
    exit("Some fields are empty");
}

$title = $_POST["title"];
$instructions = $_POST["instructions"];
$ingredients = [];

if ((isset($_FILES["img"])) && ($_FILES["img"]["error"] !== 4)) {
    $file = $_FILES['img'];
    $fileName = $_FILES['img']['name'];
    $fileTmpName = $_FILES['img']['tmp_name'];
    $fileSize= $_FILES['img']['size'];
    $fileError = $_FILES['img']['error'];
    $fileType = $_FILES['img']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');   
    
    if(in_array($fileActualExt, $allowed)) {
        if($fileError === 0){
            if($fileSize < 10000000) {
                $fileNameNew = uniqid('', true).".". $fileActualExt;
                $fileDestination = "img/uploads/" . $fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
            } else {
                header("Location: writeRecipe.php?error=Filen är för stor");
                exit();
            }

        }
        else {
            header("Location: writeRecipe.php?error=Fel");
            exit();
        }
    }
    else { 
        header("Location: writeRecipe.php?error=Otillåten filtyp på bilden. Endast JPG och PNG tillåts.");
        exit();
    }
}

$next_ingredient = 0;
while (isset(
    $_POST["ingredient-{$next_ingredient}"],
    $_POST["ingredient-weight-{$next_ingredient}"]
)) {
    $id = $_POST["ingredient-{$next_ingredient}"];
    $weight = $_POST["ingredient-weight-{$next_ingredient}"];

    if (is_numeric($id) && is_numeric($weight)) {
        array_push($ingredients, new FormIngredient(intval($id), intval($weight)));
    }

    $next_ingredient++;
}

session_start();

$user_id = isset($_SESSION["UserID"]) ? $_SESSION["UserID"] : null;

if (!$user_id) {
    exit("Not logged in as user");
}

$conn = new SQLite3("db/gastronomy.db");
if (!$conn) {
    die("Connection failed: " . $conn->lastErrorMsg());
}

$stmt = $conn->prepare("INSERT INTO recipe (PostedBy, Name, Instructions, Image) VALUES (:PostedBy, :Name, :Instructions, :Image)");

$stmt->bindParam(":PostedBy", $user_id);
$stmt->bindParam(":Name", $title);
$stmt->bindParam(":Instructions", $instructions);
$stmt->bindParam(":Image", $img);

if (!$stmt->execute()) {
    exit("Error: " . $conn->lastErrorMsg());
}

$recipe_id = $conn->lastInsertRowID();

foreach ($ingredients as $ingredient) {
    $stmtIng = $conn->prepare("INSERT INTO ingredient (RecipeID, Number, Weight) VALUES (:RecipeID, :Number, :Weight)");

    $stmtIng->bindParam(":RecipeID", $recipe_id);
    $stmtIng->bindParam(":Number", $ingredient->id);
    $stmtIng->bindParam(":Weight", $ingredient->weight);

    if (!$stmtIng->execute()) {
        exit("Error: " . $conn->lastErrorMsg());
    }
}

//header("Location: recipe.php?id={$recipe_id}");
