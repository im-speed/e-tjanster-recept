<?php

function mark_deleted_recipe(SQLite3 $conn, int $recipe_id): bool
{
    $stmt = $conn->prepare("UPDATE recipe SET Deleted = 1 WHERE RecipeID = :id");
    $stmt->bindParam(":id", $recipe_id);

    return $stmt->execute() == true;
}
