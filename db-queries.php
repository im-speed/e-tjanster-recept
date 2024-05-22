<?php
function matchEmail(SQLite3 $conn, string $newEmail)
{
    $searchExistingEmail = $conn->prepare("SELECT * FROM user WHERE Email=:email;");
    $searchExistingEmail->bindParam(':email', $newEmail, SQLITE3_TEXT);
    $matchingEmail = $searchExistingEmail->execute();

    if ($matchingEmail) {
        if (!$matchingEmail->fetchArray(SQLITE3_ASSOC)) {
            $conn->close();
            return false;
        } else {
            $conn->close();
            return true;
        }
    } else {
        $conn->close();
        return "SQL-Query failed";
    }
}

function addNewUser($conn, $name, $email, $hashedPassword)
{
    $stmt = $conn->prepare("INSERT INTO 'user' ('name', 'email', 'password') VALUES (:name, :email, :password)");
    $stmt->bindParam(':name', $name, SQLITE3_TEXT);
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


function getPassFromEmail($conn, $email){
    $passQuery = $conn->prepare("SELECT * FROM user WHERE user.Email = :email");
    $passQuery->bindParam(':email', $email, SQLITE3_TEXT);
    $result = $passQuery->execute();
    if(!$result){
        $conn->close();
        return "error";
    }
    else {
        $row = $result->fetchArray(SQLITE3_ASSOC);
        $conn->close();
        return $row;
    }
}