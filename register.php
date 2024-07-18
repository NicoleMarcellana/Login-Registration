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
    <link rel="stylesheet" href="css/register.css">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <header>Sign Up</header>
            <p> Please enter your details.</p>
            <form id="signup-form" method="post" onsubmit="return false;">
                <div class="field input">
                    <label for="email"> Email </label>
                    <input name="email" id="email" autocomplete="off">
                </div>

                <div class="field input">
                    <label for="name"> Name </label>
                    <input type="text" name="name" id="name" autocomplete="off">
                </div>

                <div class="field input">
                    <label for="dob"> Date of Birth </label>
                    <input type="date" name="dob" id="dob">
                </div>

                <div class="field input">
                    <label for="username"> Username </label>
                    <input type="text" name="username" id="username" autocomplete="off">
                </div>

                <div class="field input">
                    <label for="password"> Password </label>
                    <input type="password" name="password" id="password">
                </div>

                <div class="field input">
                    <label for="confirm_password"> Confirm Password </label>
                    <input type="password" name="confirm_password" id="confirm_password">
                </div>

                <div class="field">
                    <input onclick="register()" type="submit" class="btn" name="submit" value="Sign Up">
                </div>

                <div class="links">
                    Already have an account? <a href="login.php"> Log in! </a>
                </div> 

                <div id="form-response-container"></div>
            </form>     
        </div>
    </div>
</body>
</html>

<script>
    async function register() {
        const formResponse = document.getElementById("form-response-container");
        const form = document.getElementById("signup-form");
        const formData = new FormData(form);

        const config = {
            method: "POST",
            body: formData
        }

        const response = await fetch("./php/register.php", config);
        const result = await response.text();
        formResponse.innerHTML = result;
    }
</script>