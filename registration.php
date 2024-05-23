<?php

include __DIR__ . "/include/bootstrap.php";

view_head("Register", "registration_body");

?>

<div id="registration_container">
    <div class="montserrat-regular" id="registration_form_container">
        <h2>Register</h2>
        <form id="registration_Form" name="registration_form" action="handle-registration.php" method="post">
            <label class="montserrat-regular" for="name">Name</label><br>
            <input class="montserrat-regular" type="text" id="name" name="name" required><br>
            <label class="montserrat-regular" for="email">Email</label><br>
            <input class="montserrat-regular" type="text" id="email" name="email" required pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Emails require an @, followed by atleast 2 characters with a . in between."><br>
            <label class="montserrat-regular" for="password">Password</label><br>
            <input class="montserrat-regular" type="password" id="password" name="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"><br><br>
            <input id="submit" type="submit" class="button" value="Register">
        </form>
    </div>
    <a href='login.php' id='submit' class='button'>Go back to log in</a>
</div>

<?

view_foot();
