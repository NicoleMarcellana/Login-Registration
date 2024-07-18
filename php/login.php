<?php
    include_once("connection.php");
    include_once("utils.php");
    
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    # VALIDATION
    if ($email == "") {
        echo "<p class='err'>Email is required.</p>";
        return;
    }

    if (!is_email_registered($email)) {
        echo "<p class='err'>Email not registered.</p>";
        return;
    }

    if ($password == "") {
        echo "<p class='err'>Password is required.</p>";
        return;
    }

    if (!is_password_correct($email, $password)) {
        echo "<p class='err'>Invalid credentials.</p>";
        return;   
    }

    session_start();
    $_SESSION["authorization"] = $email;
    echo "<p class='ok'>You are now logged in.</p>";
?>