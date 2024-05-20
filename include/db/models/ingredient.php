<?php

class Ingredient
{
    public int $recipeID;
    public int $number;
    public int $weight;

    public static function from_row(array $row): Ingredient
    {
        $ingredeint = new Ingredient();

        $ingredeint->recipeID = $row["RecipeID"];
        $ingredeint->number = $row["Number"];
        $ingredeint->weight = $row["Weight"];

        return $ingredeint;
    }

    public static function getRows(SQLite3 $conn, int $recipeID): array
    {
        $stmt = $conn->prepare("SELECT * FROM ingredient WHERE RecipeID = :id");
        $stmt->bindParam(":id", $recipeID);
        $res = $stmt->execute();

        if (!$res) {
            return null;
        }

        $ingredeints = [];

        while ($row = $res->fetchArray()) {
            if ($row) {
                array_push($ingredeints, Ingredient::from_row($row));
            }
        }

        return $ingredeints;
    }
}
