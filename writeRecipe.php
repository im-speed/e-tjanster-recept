<?php

include __DIR__ . "/include/bootstrap.php";

if (!$user_id) {
    header("Location: login.php");
    exit;
}

view_head("Write Recipe");

view_header($user_id);

?>

<script type="module" src="js/writeRecipe/index.js"></script>
<script type="module" src="js/textareaAuto.js"></script>

<main class="content">
    <form action="postRecipe.php" method="post" enctype="multipart/form-data">
        <h1 class="my-1">Write New Recipe</h1>
        <input id="thumbnail" type="file" name="img">
        <label class="label-below" for="thumbnail">Recipe Thumbnail</label>
        <input class="header-input" type="text" name="title" placeholder="Recipe Name" minlength="2" maxlength="80" required>
        <textarea id="instructions" class="textarea-auto" name="instructions" minlength="2" maxlength="1000" placeholder="Instructions" required></textarea>

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
