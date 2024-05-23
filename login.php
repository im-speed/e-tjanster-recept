<?php

include __DIR__ . "/include/bootstrap.php";

view_head("Login", "registration_body");

?>

<div id="registration_container">
    <div class="montserrat-regular" id="registration_form_container">
        <h2>Log in</h2>
        <form id="registration_Form" name="logInForm" action="handle-login.php" method="post">
            <label class="montserrat-regular" for="email">Email</label><br>
            <input class="montserrat-regular" type="text" id="email" name="email" required pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Emails require an @, followed by atleast 2 characters with a . in between."><br>
            <label class="montserrat-regular" for="password">Password</label><br>
            <input class="montserrat-regular" type="password" id="password" name="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"><br><br>
            <input id="submit" type="submit" class="button" value="Log in">
        </form>

    </div>
    <a href='registration.php' id='submit' class='button'>Don't have an account? Register one here!</a>
</div>

<?

view_foot();
