<?php

require_once __DIR__ . "/../models/recipe.php";

function mark_deleted_recipe(SQLite3 $conn, int $recipe_id): bool
{
    $stmt = $conn->prepare("UPDATE recipe SET Deleted = 1 WHERE RecipeID = :id");
    $stmt->bindParam(":id", $recipe_id);

    return $stmt->execute() == true;
}

function list_all_recipes(SQLite3 $conn): ?array
{
    $stmt = $conn->prepare("SELECT * FROM recipe");

    if (!$res = $stmt->execute()) {
        return null;
    }

    $recipes = [];
    while ($row = $res->fetchArray()) {
        $recipe = Recipe::from_row($row);
        if (!$recipe->isDeleted()) {
            array_push($recipes, $recipe);
        }
    }

    return $recipes;
}
