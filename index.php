<?php

include __DIR__ . "/include/bootstrap.php";

view_head("Gastronomer's Gateway");

view_header();

?>

<form class="flexCenter mt-3" action="search.php" method="get">
    <input id="search-recipe" type="search" name="q" placeholder="Search Recipe">
</form>

<div id="food_row_container">
    <div id="row1" class="food_row">
        <img src="img/tests/1.jpg" class="food_preview">
        <img src="img/tests/2.jpg" class="food_preview">
        <img src="img/tests/3.jpg" class="food_preview">
        <img src="img/tests/4.jpg" class="food_preview">
        <img src="img/tests/5.jpg" class="food_preview">
        <img src="img/tests/6.jpg" class="food_preview">
        <img src="img/tests/7.jpg" class="food_preview">
        <img src="img/tests/8.jpg" class="food_preview">
        <img src="img/tests/9.jpg" class="food_preview">
    </div>

    <div id="row2" class="food_row">
        <img src="img/tests/5.jpg" class="food_preview">
        <img src="img/tests/6.jpg" class="food_preview">
        <img src="img/tests/7.jpg" class="food_preview">
        <img src="img/tests/8.jpg" class="food_preview">
        <img src="img/tests/9.jpg" class="food_preview">
        <img src="img/tests/1.jpg" class="food_preview">
        <img src="img/tests/2.jpg" class="food_preview">
        <img src="img/tests/3.jpg" class="food_preview">
        <img src="img/tests/4.jpg" class="food_preview">
    </div>

    <div id="row3" class="food_row">
        <img src="img/tests/8.jpg" class="food_preview">
        <img src="img/tests/9.jpg" class="food_preview">
        <img src="img/tests/1.jpg" class="food_preview">
        <img src="img/tests/2.jpg" class="food_preview">
        <img src="img/tests/3.jpg" class="food_preview">
        <img src="img/tests/4.jpg" class="food_preview">
    </div>

    <div id="row4" class="food_row">
        <img src="img/tests/1.jpg" class="food_preview">
        <img src="img/tests/2.jpg" class="food_preview">
        <img src="img/tests/3.jpg" class="food_preview">
        <img src="img/tests/4.jpg" class="food_preview">
        <img src="img/tests/5.jpg" class="food_preview">
        <img src="img/tests/6.jpg" class="food_preview">
        <img src="img/tests/7.jpg" class="food_preview">
        <img src="img/tests/8.jpg" class="food_preview">
        <img src="img/tests/9.jpg" class="food_preview">
    </div>
</div>

<?php view_foot();
