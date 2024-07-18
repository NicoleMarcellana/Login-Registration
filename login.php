<?php

session_start();
    
if (isset($_SESSION["authorization"])) {
    header("location: ./home.php");
    return;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Login</title>
</head>
<body>
 
    <div class="container">
        <div class="box form-box">
            <header>Welcome Back</header>
            <p> Please enter your details.</p>
            <form id="login-form" method="post" onsubmit="return false;">
                <div id="form-response-container"></div>
                <div class="field input">
                    <label for="email"> Email </label>
                    <input type="text" name="email" id="email">
                </div>

                <div class="field input">
                    <label for="password"> Password </label>
                    <input type="password" name="password" id="password">
                </div>

                <div class="field">
                    <input onclick="login()" type="submit" class="btn" name="submit" value="Login">
                </div>

                <div class="links">
                    Don't have an account? <a href="register.php"> Sign Up! </a>
                </div> 
            </form>     
        </div>
        <div class="image-container">
            <img src="css/images/home.png" alt="Login Image">
        </div>
    </div>
</body>
</html>

<script>
    async function login() {
        const formResponse = document.getElementById("form-response-container");
        const form = document.getElementById("login-form");
        const formData = new FormData(form);

        const config = {
            method: "POST",
            body: formData
        }

        const response = await fetch("./php/login.php", config);
        const result = await response.text();
        formResponse.innerHTML = result;

        if (result.includes("You are now logged in.")) {
            window.location.href = "home.php"
        }
    }
</script>