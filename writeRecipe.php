<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Write Recipe</title>
    <link rel="stylesheet" href="CSS/index.css">
</head>

<body>
    <main class="content">
        <script type="module" src="js/writeRecipe/index.js"></script>
        <script type="module" src="js/textareaAuto.js"></script>

        <div>
            <h2>Instructions</h2>
            <textarea name="instructions" id="instructions" class="textarea-auto"></textarea>
        </div>

        <div class="ingredients">
            <h2>Ingredients</h2>
            <div id="ingredients-list" class="ingredients-list"></div>
            <button id="add-ingredient" class="button">+ Add ingredient</button>
        </div>
    </main>
</body>

</html>