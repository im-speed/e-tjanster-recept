<?php

function view_header()
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
                    <a class="button montserrat-regular" href="gaga.php">Recept</a>
                    <a class="button montserrat-regular" href="writeRecipe.php">Skapa Recept</a>
                </div>
                <a class="button montserrat-regular" href="login.php">Logga in</a>
            </menu>
        </div>
    </header>
<?php
}
