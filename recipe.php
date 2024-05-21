<?php

require_once __DIR__ . "/include/db/models/recipe.php";
require_once __DIR__ . "/include/db/models/ingredient.php";
include __DIR__ . "/include/views/_bootstrap.php";
include __DIR__ . "/include/views/_header.php";

$id = isset($_GET["id"]) && is_numeric($_GET["id"]) ? (int) $_GET["id"] : null;

if (!$id) {
    header("Location: index.php");
    exit;
}

include __DIR__ . "/establish-db-connection.php";

$recipe = Recipe::select($conn, $id);

view_head("Gastronomer's Gateway");

view_header();

?>

<main class="center">
    <?php if ($recipe) : ?>

        <script type="module" src="/js/viewRecipe/index.js"></script>

        <div id="recipe_holder">
            <img src="img/tests/1.jpg" width="550">

            <div id="recipe_info">
                <h1 id="recipe_title"><?= $recipe->name ?></h1>
                <p id="recipe_instructions"><?= $recipe->instructions ?></p>
                <ul id="ingredients">
                    <?php foreach ($recipe->ingredients as $ingredient) : ?>
                        <li class="waiting-ingredient" data-number="<?= $ingredient->number ?>" data-weight="<?= $ingredient->weight ?>">Loading ingredient...</li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>

    <?php else : ?>

        <h1 class="mt-3">Recipe Not Found</h1>

    <?php endif ?>
</main>

<?php

view_foot();
