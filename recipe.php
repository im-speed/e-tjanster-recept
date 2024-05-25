<?php

require_once __DIR__ . "/include/db/models/recipe.php";
require_once __DIR__ . "/include/db/models/ingredient.php";
require_once __DIR__ . "/include/db/functions/user.php";
require_once __DIR__ . "/include/db/functions/recipe.php";
include __DIR__ . "/include/bootstrap.php";

$id = isset($_GET["id"]) && is_numeric($_GET["id"]) ? (int) $_GET["id"] : null;

if (!$id) {
    header("Location: index.php");
    exit;
}

include __DIR__ . '/include/db/functions/establish-db-connection.php';

$recipe = Recipe::select($conn, $id);

$isAdmin = verifyAdmin($conn, $user_id);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["remove"]) && $isAdmin) {
    if (mark_deleted_recipe($conn, $recipe->id)) {
        header("Location: index.php?notice=Recipe was deleted");
    } else {
        header("Location: recipe.php?id={$recipe->id}&error=Failed to delete recipe");
    }
}

view_head($recipe ? $recipe->name : "Recipe Not Found");

view_header($user_id);

?>

<main class="center">
    <?php if ($recipe) : ?>

        <script type="module" src="js/viewRecipe/index.js" defer></script>

        <div id="recipe_holder">
            <img id="recipe_thumb" src="img/uploads/<?= $recipe->imgHref ?>">
            <div id="recipe_info">
                <div class="space-between">
                    <h1 id="recipe_title"><?= $recipe->name ?></h1>

                    <?php if ($isAdmin) : ?>
                        <form action="" method="post">
                            <button class="button" type="submit" name="remove">Remove</button>
                        </form>
                    <?php endif ?>
                </div>
                <p id="recipe_instructions"><?= $recipe->instructions ?></p>

                <h2 class="mt-3">Ingredients</h2>
                <ul id="ingredients">
                    <?php foreach ($recipe->ingredients as $ingredient) : ?>
                        <li class="waiting-ingredient" data-number="<?= $ingredient->number ?>" data-weight="<?= $ingredient->weight ?>">Loading ingredient...</li>
                    <?php endforeach ?>
                </ul>

                <h2 class="mt-3">Total Nutrition Values</h2>
                <ul id="nutrition-list"></ul>
            </div>
        </div>

    <?php else : ?>

        <h1 class="mt-3">Recipe Not Found</h1>

    <?php endif ?>
</main>

<?php

view_foot();
