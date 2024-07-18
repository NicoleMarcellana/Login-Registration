<?php
    include_once("connection.php");
    include_once("utils.php");
    
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $confirmPassword = trim($_POST["confirm_password"]);
    $username = trim($_POST["username"]);
    $dob = trim($_POST["dob"]);

    # VALIDATION
    if ($email == "") {
        echo "<p class='err'>Email is required.</p>";
        return;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p class='err'>Email is not a valid email.</p>";
        return;
    }

    if (is_email_registered($email)) {
        echo "<p class='err'>Email is already registered.</p>";
        return;
    }

    if ($name == "") {
        echo "<p class='err'>Name is required.</p>";
        return;
    }

    if ($dob == "") {
        echo "<p class='err'>Date of birth is required.</p>";
        return;
    }

    if ($username == "") {
        echo "<p class='err'>Username is required.</p>";
        return;
    }

    if ($password == "") {
        echo "<p class='err'>Password is required.</p>";
        return;
    }


    if (strlen($password) < 6) {
        echo "<p class='err'>Password length must be greater than 6.</p>";
        return;
    }

    if ($password != $confirmPassword) {
        echo "<p class='err'>Password confirmation mismatch.</p>";
        return;
    }
    # HASH
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    # SAVE
    $db = connectDB();
    $sql = "INSERT INTO users (name, dob, email, username, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("sssss", $name, $dob, $email, $username, $hashedPassword);
    $stmt->execute();
    $db->close();

    echo "<p class='ok'>You are now registered! <a href='login.php'>Login here.</a></p>";
?>