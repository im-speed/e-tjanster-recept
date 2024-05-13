<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sixtyfour&family=Tilt+Prism&family=Tilt+Warp&family=Ysabeau+SC:wght@1..1000&display=swap" rel="stylesheet">
</head>
<body>
        <h2>Logga in</h2>
        <form id="logInForm" name="logInForm" action="handleLogin.php" method="post">
            <label for="email">Email</label>
            <input type="text" id="email" name="email"required pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Emails require an @, followed by atleast 2 characters with a . in between."><br>
            <label for="password">Lösenord</label>
            <input id="password" name="password" required><br><br>
            <input id="submit" type="submit" value="Logga in">
        </form>
        <a href='register.php' id='submit' class='flexcenter btn newspapertext zoom justpaper'>Har du inget konto? Registrera dig här!</a>
</body>
</html>
 