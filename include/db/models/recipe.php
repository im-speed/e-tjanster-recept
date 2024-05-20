<?php

require_once __DIR__ . "/ingredient.php";

class Recipe
{
    public int $id;
    public int $postedBy;
    public string $name;
    public string $instructions;
    public ?string $imgHref;
    public array $ingredients;

    public static function from_row($row): Recipe
    {
        $recipe = new Recipe();

        $recipe->postedBy = $row["PostedBy"];
        $recipe->id = $row["RecipeID"];
        $recipe->name = $row["Name"];
        $recipe->instructions = $row["Instructions"];
        $recipe->imgHref = isset($row["imgHref"]) ? $row["imgHref"] : null;

        return $recipe;
    }

    public static function select(SQLite3 $conn, int $id): ?Recipe
    {
        $stmt = $conn->prepare("SELECT * FROM recipe WHERE RecipeID = :id");
        $stmt->bindParam(":id", $id);
        $res = $stmt->execute();

        if (!$res) {
            return null;
        }

        if (!$row = $res->fetchArray()) {
            return null;
        }

        $recipe = Recipe::from_row($row);
        $recipe->ingredients = Ingredient::getRows($conn, $recipe->id);

        return $recipe;
    }
}
