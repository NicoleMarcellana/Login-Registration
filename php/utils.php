<?php

include_once("connection.php");

function is_email_registered($email) {
    $db = connectDB();
    $sql = "SELECT email FROM users WHERE email = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    return $stmt->num_rows > 0;
}

function is_password_correct($email, $password) {
    $db = connectDB();
    $sql = "SELECT password FROM users WHERE email = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();
    $db->close();

    return password_verify($password, $hashed_password);
}

?>