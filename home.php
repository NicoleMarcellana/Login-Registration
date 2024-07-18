<?php
    session_start();
    
    if (!isset($_SESSION["authorization"])) {
        header("location: ./login.php");
        return;
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <title>Home</title>
  </head>
  <body>
    <div class="nav">
      <div class="logo">
        <p>Kpop Hub</p>
      </div>
      <div class="right-links">
        <a href="edit.php" class="edit">
          <span>Edit Profile</span>
        </a>
        <button onclick="logout()" class="btn">Log Out</button>
      </div>
    </div>
    <main>
      <div id="info-box" class="info-box">
        <!-- CONTAINER OF INFORMATION -->
      </div>
    </main>
  </body>
</html>

<script>
async function logout() {
  const config = {
    method: "GET"
  }

  await fetch("./php/logout.php", config)
  window.location.reload()
}

async function fetchInfo() {
  const infoBox = document.getElementById("info-box");
  const config = {
    method: "GET"
  }

  const response = await fetch("./php/info.php", config);
  const result = await response.text();
  infoBox.innerHTML = result;
}

fetchInfo()
</script>