<?php

require_once("user.php");
require_once("utils.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $user = new user($_SESSION["authorization"]);
  echo '<div class="field input">';
  echo '<label for="email"> Email (You can\'t edit your email.) </label>';
  echo '<input type="text" name="email" id="email" disabled autocomplete="off" value="'. $user->email .'">';
  echo '</div>';

  echo '<div class="field input">';
  echo '<label for="name"> Name </label>';
  echo '<input name="name" id="name" autocomplete="off" value="'. $user->name .'">';
  echo '</div>';
  
  echo '<div class="field input">';
  echo '<label for="dob"> Date of Birth </label>';
  echo '<input type="date" name="dob" id="dob" value="'. $user->birthday .'">';
  echo '</div>';
  
  
  echo '<div class="field input">';
  echo '<label for="username"> Username </label>';
  echo '<input type="text" name="username" id="username" autocomplete="off" value="'. $user->username .'">';
  echo '</div>';
  
  echo '<div class="field input">';
  echo '<label for="password">Password (Optional, fill only if you want to change your password.)</label>';
  echo '<input type="password" name="password" id="password">';
  echo '</div>';
  
  echo '<div class="field input">';
  echo '<label for="password"> Confirm Password </label>';
  echo '<input type="password" name="confirm-password" id="Confirm">';
  echo '</div>';

  echo '<div id="response"></div>';
  
  echo '<div class="field">';
  echo '<input type="submit" class="btn" name="submit" onclick="saveInfo()" value="Save Changes">';
  echo '</div>';
  echo '<div class="field">';
  echo '<a class="cnclbtn" href="home.php" name="cancel">Back</a>';
  echo '</div>';
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = trim($_POST["name"]);
  $password = isset($_POST["password"]) ? trim($_POST["password"]) : ""; // Optional password field
  $confirmPassword = isset($_POST["confirm-password"]) ? trim($_POST["confirm-password"]) : ""; // Optional confirm password field
  $username = trim($_POST["username"]);
  $dob = trim($_POST["dob"]);
  
  # VALIDATION
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
  
  if ($password != "" && strlen($password) < 6) {
    echo "<p class='err'>Password length must be greater than 6.</p>";
    return;
  }
  
  if ($password != $confirmPassword) {
    echo "<p class='err'>Password confirmation mismatch.</p>";
    return;
  }
  
  # HASH (if password is provided)
  $hashedPassword = "";
  if ($password != "") {
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
  }
  
  # SAVE
  $db = connectDB();

  $sql = "UPDATE users SET name = ?, dob = ?, username = ?";

  if ($password != "") {
    $sql .= ", password = ?";
  }

  $sql .= " WHERE email = ?";
  
  $stmt = $db->prepare($sql);

  if ($password != "") {
    $stmt->bind_param("sssss", $name, $dob, $username, $hashedPassword, $_SESSION["authorization"]);
  } else {
    $stmt->bind_param("ssss", $name, $dob, $username, $_SESSION["authorization"]);
  }

  $stmt->execute();
  $db->close();

  echo "<p class='ok'>Your information updated successfully!</p>";
}

?>