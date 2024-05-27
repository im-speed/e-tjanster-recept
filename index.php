<?php

include __DIR__ . "/include/bootstrap.php";

view_head("Gastronomer's Gateway");

view_header($user_id);

?>

<script type="module" src="js/start/index.js"></script>

<form class="flexCenter mt-3" action="search.php" method="get">
    <input id="search-recipe" type="search" name="q" placeholder="Search Recipe">
</form>

<div id="food_row_container"></div>

<?php view_foot();
