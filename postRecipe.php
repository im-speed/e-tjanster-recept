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
    header("Location: writeRecipe.php?error=Recipe form not submitted");
    exit;
}

if (!isset($_POST["title"])) {
    header("Location: writeRecipe.php?error=Title is empty");
    exit;
}

if (!isset($_POST["instructions"])) {
    header("Location: writeRecipe.php?error=Instructions is empty");
    exit;
}

if (!isset($_POST["categories"])) {
    header("Location: writeRecipe.php?error=No category chosen");
    exit;
}


$category = $_POST["categories"];
$title = htmlspecialchars($_POST["title"]);
$instructions = htmlspecialchars($_POST["instructions"]);

if ((isset($_FILES["img"])) && ($_FILES["img"]["error"] !== 4)) {
    $file = $_FILES['img'];
    $fileName = $_FILES['img']['name'];
    $fileTmpName = $_FILES['img']['tmp_name'];
    $fileSize = $_FILES['img']['size'];
    $fileError = $_FILES['img']['error'];
    $fileType = $_FILES['img']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 10000000) {
                $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                $fileDestination = "img/uploads/" . $fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
            } else {
                header("Location: writeRecipe.php?error=File is to large.");
                exit();
            }
        } else {
            header("Location: writeRecipe.php?error=Could not upload file.");
            exit();
        }
    } else {
        header("Location: writeRecipe.php?error=Unsupported file type. Only JPG, JPEG, or PNG allowed.");
        exit();
    }
}

$ingredients = [];

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

if (empty($ingredients)) {
    header("Location: writeRecipe.php?error=Ingredients is empty");
    exit;
}

session_start();

$user_id = isset($_SESSION["UserID"]) ? $_SESSION["UserID"] : null;

if (!$user_id) {
    header("Location: writeRecipe.php?error=Could not verify login");
    exit;
}

$conn = new SQLite3("db/gastronomy.db");
if (!$conn) {
    die("Connection failed: " . $conn->lastErrorMsg());
}

$stmt = $conn->prepare("INSERT INTO recipe (PostedBy, Name, Instructions, Image, Category) VALUES (:PostedBy, :Name, :Instructions, :Image, :Category)");

$stmt->bindParam(":PostedBy", $user_id);
$stmt->bindParam(":Name", $title);
$stmt->bindParam(":Instructions", $instructions);
$stmt->bindParam(":Image", $fileNameNew);
$stmt->bindParam(":Category", $category);

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

header("Location: recipe.php?id={$recipe_id}&notice=Recipe succesfully created");
