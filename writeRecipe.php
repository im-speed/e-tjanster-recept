<?php

include __DIR__ . "/include/views/_bootstrap.php";
include __DIR__ . "/include/views/_header.php";

session_start();

view_head("Gastronomer's Gateway");

view_header();

$user_id = isset($_SESSION["UserID"]) ? $_SESSION["UserID"] : null;

if (!$user_id) {
    // header("Location: login.php");
    // exit;
}

?>

<script type="module" src="js/writeRecipe/index.js"></script>
<script type="module" src="js/textareaAuto.js"></script>

<main class="content">
    <form action="postRecipe.php" method="post">
        <h1 class="my-1">Write New Recipe</h1>
        <input class="header-input" type="text" name="title" placeholder="Recipe Name" required>
        <textarea id="instructions" class="textarea-auto" name="instructions" placeholder="Instructions" required></textarea>

        <h2 class="my-1">Ingredients</h2>
        <div>
            <div id="ingredients-list" class="ingredients-list"></div>
            <button id="add-ingredient" class="button" type="button">+ Add ingredient</button>
        </div>

        <div class="my-1">
            <input class="button" type="submit" value="Post">
        </div>
    </form>
</main>

<?php

view_foot();
