<?php

include __DIR__ . "/include/bootstrap.php";

class ApiIngredient
{
    public function __construct(public string $name, public string $measure)
    {
    }
}

$id = isset($_GET["id"]) && is_numeric($_GET["id"]) ? (int) $_GET["id"] : null;

if (!$id) {
    header("Location: index.php");
    exit;
}

$api_path = "https://www.themealdb.com/api/json/v1/1/search.php?s={$id}";
$response = file_get_contents($api_path);
$json = json_decode($response, true);

$recipe = null;

if (isset($json["meals"]) && $json["meals"]) {

    $recipe = $json["meals"][0];

    $ingredients = [];

    $ingridient_number = 1;
    while (
        isset($recipe["strIngredient{$ingridient_number}"])
        && !empty($recipe["strIngredient{$ingridient_number}"])
    ) {
        $ingredient = new ApiIngredient(
            $recipe["strIngredient{$ingridient_number}"],
            $recipe["strMeasure{$ingridient_number}"]
        );

        array_push($ingredients, $ingredient);

        $ingridient_number++;
    }
}

view_head("Gastronomer's Gateway");

view_header($user_id);

?>

<main class="center">
    <?php if ($recipe) : ?>

        <div id="recipe_holder">
            <img id="recipe_thumb" src="<?= $recipe["strMealThumb"] ?>">

            <div id="recipe_info">
                <h1 id="recipe_title"><?= $recipe["strMeal"] ?></h1>
                <p id="recipe_instructions"><?= $recipe["strInstructions"] ?></p>
                <ul id="ingredients">
                    <?php foreach ($ingredients as $ingredient) : ?>
                        <li class="recipe-ingredient">
                            <span><?= $ingredient->name ?></span>
                            <span><?= $ingredient->measure ?></span>
                        </li>
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
