<?php
function matchEmail($conn, $newEmail){
    $searchExistingEmail = $conn->prepare("SELECT * FROM user WHERE Email=:email;");
    $searchExistingEmail->bindParam(':email', $newEmail, SQLITE3_TEXT);
    $matchingEmail = $searchExistingEmail->execute();   

    if($matchingEmail){
        if(!$matchingEmail->fetchArray(SQLITE3_ASSOC)){
          $conn->close();
          return false;
        }    
        else {
            $conn->close();
            return true;
        }
    }    
    else {
        $conn->close();
        return "SQL-Query failed";
    }
}

function addNewUser($conn, $email, $hashedPassword){
    $stmt = $conn->prepare($sql = "INSERT INTO 'user' ('email', 'password') VALUES (:email, :password)");
    $stmt->bindParam(':email', $email, SQLITE3_TEXT);
    $stmt->bindParam(':password', $hashedPassword, SQLITE3_TEXT);

    if (!$stmt->execute()) {
        $conn->close();
        return false;
    } else {
        $conn->close();
        return true;
    }
}