<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>
        <form action="handleReg.php" name="myForm" method="post" onsubmit="return validate()">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" required minlength="3" maxlength="50" placeholder="John Smith"><br>
            <label for="email">Email:</label><br>
            <input type="text" id="email" name="email" required placeholder="john@smith.com" pattern="[^@\s]+@[^@\s]+\.[^@\s]+"><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required placeholder="Password"><br><br>
            <input type="submit" value="register">
        </form>
    </div>
</body>

</html>