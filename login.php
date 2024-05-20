<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/index.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sixtyfour&family=Tilt+Prism&family=Tilt+Warp&family=Ysabeau+SC:wght@1..1000&display=swap" rel="stylesheet">
</head>
<body id="login_body">
    <div id="login_container">
        <div class="montserrat-regular" id="login_form_container" >
        <h2>Logga in</h2>
            <form id="login_Form" name="logInForm" action="handle-login.php" method="post">
                <label class="montserrat-regular" for="name">Namn</label><br>
                <input class="montserrat-regular" type="text" id="password" name="password" required><br>
                <label class="montserrat-regular" for="email">Email</label><br>
                <input class="montserrat-regular" type="text" id="email" name="email"required pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Emails require an @, followed by atleast 2 characters with a . in between."><br>
                <label class="montserrat-regular" for="password">Lösenord</label><br>
                <input class="montserrat-regular" type="password" id="password" name="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"><br><br>
                <input id="submit" type="submit" class="button" value="Logga in">
            </form>

        </div>
        <a href='register.php' id='submit' class='button'>Har du inget konto? Registrera dig här!</a>
    </div>
       
</body>
</html>
 