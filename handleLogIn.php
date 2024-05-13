
<?php
    session_start();
    ini_set('display_errors', 1);   
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {   
        if (isset($_POST["email"])) {
            $email = $_POST["email"];
            }
        else {
            echo "Email field is empty";
            }

        if (isset($_POST["password"])) {
            $password = $_POST["password"];
            }
        else {
            echo "Password field is empty";
            }
    }

    else {
            echo "Form not submitted";
    }
    

    $db_file = "db/gastronomy.db";
    $conn = new SQLite3($db_file);
    if(!$conn){
        die("Connection failed: " . $conn->lastErrorMsg());
    }


    $sql = $conn->prepare("SELECT * FROM user WHERE Email=:email;");
    $sql->bindParam(':email', $email, SQLITE3_TEXT);


    if($sql->execute()){
        $row = $sql->execute()->fetchArray(SQLITE3_ASSOC);

        if(!$row) {
            echo "<a href='login.php'>Försök igen?</a>";
            $conn->close();
        } 

        else {
            if(password_verify($password, $row['Password'])){   
                $_SESSION['UserID'] = $row['UserID'];
                echo "<a href='index.php' id='btnToIndex' class='newspapertext zoom paper'>Gå in på anslagstavlan</a>";
                $conn->close(); 
            }
            else{
                echo "<a href='login.php'>Försök igen?</a>";
                $conn->close();
            }
        }
    }
    else {
        echo "Error: " . $conn->lastErrorMsg();
        $conn->close();
    }
