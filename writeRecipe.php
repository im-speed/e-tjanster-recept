<?php

include __DIR__ . "/include/views/_bootstrap.php";
include __DIR__ . "/include/views/_header.php";

view_head("Gastronomer's Gateway");

view_header();

?>

<script type="module" src="js/writeRecipe/index.js"></script>
<script type="module" src="js/textareaAuto.js"></script>

<main class="content">
    <form action="postRecipe.php" method="post">
        <h1 class="my-1">Write New Recipe</h1>
        <h2 class="my-1">Instructions</h2>
        <textarea id="instructions" class="textarea-auto" name="instructions"></textarea>

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
