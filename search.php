<?php

require_once __DIR__ . "/include/db/models/recipe.php";
include __DIR__ . "/include/bootstrap.php";
include __DIR__ . '/include/db/functions/establish-db-connection.php';

$query = isset($_GET["q"]) ? $_GET["q"] : null;

$recipes = Recipe::search($conn, $query);

view_head($query ? $query : "Search");

view_header($user_id);

?>

<script type="module" src="js/search/index.js"></script>

<main class="content">
    <form class="center" action="" method="get">
        <input id="search-recipe" type="search" name="q" placeholder="Search Recipe">
    </form>

    <h2 class="flexCenter mt-1">Gastronomer's Gateway</h2>

    <?php if ($recipes) : ?>

        <div class="search-results">

            <?php foreach ($recipes as $recipe) : ?>

                <a class="search-result" href="recipe.php?id=<?= $recipe->id ?>">
                    <img class="search-result-thumb" src="img/uploads/<?= $recipe->imgHref ?>" alt="Recipe thumbnail">
                    <div>
                        <div class="search-result-title"><?= $recipe->name ?></div>
                        <p class="search-result-instructions"><?= $recipe->instructions ?></p>
                    </div>
                </a>

            <?php endforeach ?>

        </div>

    <?php else : ?>

        <p class="flexCenter mt-1">No Recipes Found</p>

    <?php endif ?>

    <h2 class="flexCenter mt-1">TheMealDB</h2>

    <div id="api-search-results" class="search-results">

    </div>
</main>

<?php

view_foot();
