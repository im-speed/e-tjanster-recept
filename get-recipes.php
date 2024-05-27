<?php

require_once __DIR__ . "/include/db/models/recipe.php";
require_once __DIR__ . "/include/db/functions/recipe.php";

header('Content-Type: application/json; charset=utf-8');

include __DIR__ . "/include/db/functions/establish-db-connection.php";

echo json_encode(list_all_recipes($conn));
