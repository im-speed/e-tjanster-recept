<?php

function view_header(?int $user_id = null)
{
?>
    <header>
        <div class="center">
            <img alt="loggotyp" id="logo" src="img/logo.png">
        </div>


        <div class="flexCenter" id="menu_container">
            <menu id="btn_container">
                <div id="menu">
                    <a class="button montserrat-regular" href="index.php">Start</a>
                    <a class="button montserrat-regular" href="writeRecipe.php">Write Recipe</a>
                </div>

                <?php if (is_null($user_id)) : ?>
                    <a class="button montserrat-regular" href="login.php">Log in</a>
                <?php else : ?>
                    <a class="button montserrat-regular" href="logout.php">Log out</a>
                <?php endif ?>
            </menu>
        </div>
    </header>
<?php
}
