<?php

require_once __DIR__ . "/ingredient.php";

class Recipe
{
    private bool $deleted;
    public int $id;
    public int $postedBy;
    public string $name;
    public string $instructions;
    public ?string $imgHref;
    public array $ingredients;
    public int $category;

    public static function from_row($row): Recipe
    {
        $recipe = new Recipe();

        $recipe->postedBy = $row["PostedBy"];
        $recipe->id = $row["RecipeID"];
        $recipe->name = $row["Name"];
        $recipe->instructions = $row["Instructions"];
        $recipe->imgHref = isset($row["Image"]) ? $row["Image"] : null;
        $recipe->deleted = $row["Deleted"];
        $recipe->category = $row["Category"];

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

        if ($recipe->deleted) {
            return null;
        }

        $recipe->ingredients = Ingredient::getRows($conn, $recipe->id);

        return $recipe;
    }

    public static function search(SQLite3 $conn, string $query): array
    {
        $query = "%{$query}%";

        $stmt = $conn->prepare("SELECT * FROM recipe WHERE Name LIKE :query");
        $stmt->bindParam(":query", $query);
        $res = $stmt->execute();

        $recipes = [];

        while ($row = $res->fetchArray()) {
            if ($row) {
                $recipe = Recipe::from_row($row);

                if (!$recipe->deleted) {
                    array_push($recipes, $recipe);
                }
            }
        }

        return $recipes;
    }

    public function isDeleted(): bool
    {
        return $this->deleted;
    }
}
