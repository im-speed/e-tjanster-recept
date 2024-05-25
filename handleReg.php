<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["name"])) {
        $name = $_POST["name"];
    } else {
        echo "Name field is empty";
    }

    if (isset($_POST["email"])) {
        $email = $_POST["email"];
    } else {
        echo "Email field is empty";
    }

    if (isset($_POST["password"])) {
        $password = $_POST["password"];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    } else {
        echo "Password field is empty";
    }
} else {
    echo "Form not submitted";
}


$db_file = "db/gastronomy.db";
$conn = new SQLite3($db_file);
if (!$conn) {
    die("Connection failed: " . $conn->lastErrorMsg());
}


$searchExistingEmail = $conn->prepare("SELECT Email FROM user WHERE Email=:email;");
$searchExistingEmail->bindParam(':email', $email, SQLITE3_TEXT);
$matchingEmail = $searchExistingEmail->execute();


if ($matchingEmail) {
    if (!$matchingEmail->fetchArray(SQLITE3_ASSOC)) {
        $stmt = $conn->prepare($sql = "INSERT INTO 'user' ('name', 'email', 'password') VALUES (:name, :email, :password)");
        $stmt->bindParam(':name', $name, SQLITE3_TEXT);
        $stmt->bindParam(':email', $email, SQLITE3_TEXT);
        $stmt->bindParam(':password', $hashedPassword, SQLITE3_TEXT);

        if (!$stmt->execute()) {
            // Ifall queryn inte lyckas
            echo "Error: " . $conn->lastErrorMsg();
        } else {

            //Fallet då kontot har lyckats skapas
            echo "<p class='centerText newspapertext font22'>Ditt konto har skapats</p>";
            echo "<a href='login.php' id='btnToIndex' class='newspapertext zoom paper'>Logga in</a>";
        }
    } else {
        // Emailen är redan registrerad
        echo "<p class='centerText newspapertext font22'>Emailadressen är redan registrerad</p>";
        echo "<a href='registration.php' id='btnToIndex' class='newspapertext zoom paper'>Försök igen?</a>";
    }
} else {
    //Queryn kunde inte utföras för någon anledning
    echo "Error: " . $conn->lastErrorMsg();
}
