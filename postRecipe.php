<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit("Form not submitted");
}

if (!isset($_POST["instructions"])) {
    exit("Instructions field is empty");
}

class Ingredient
{
    public function __construct(public int $id, public float $weight)
    {
    }
}

$instructions = $_POST["instructions"];
$ingredients = [];

$next_ingredient = 0;
while (isset(
    $_POST["ingredient-{$next_ingredient}"],
    $_POST["ingredient-weight-{$next_ingredient}"]
)) {
    $id = $_POST["ingredient-{$next_ingredient}"];
    $weight = $_POST["ingredient-weight-{$next_ingredient}"];

    if (is_numeric($id) && is_numeric($weight)) {
        array_push($ingredients, new Ingredient(intval($id), intval($weight)));
    }

    $next_ingredient++;
}

var_dump($instructions, $ingredients);
