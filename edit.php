<?php 

session_start();
    
if (!isset($_SESSION["authorization"])) {
  header("location: ./home.php");
  return;
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/edit.css">
    <title>Edit</title>
  </head>
  <body>
    <div class="container">
      <div class="box form-box">
        <header>Edit Profile</header>
        <p> Please enter your details.</p>
        <form id="form" method="post" onsubmit="return false;">
        </form>
      </div>
    </div>
  </body>
</html>

<script>
async function fetchInfo() {
  const infoBox = document.getElementById("form");
  const config = {
    method: "GET"
  }

  const response = await fetch("./php/edit.php", config);
  const result = await response.text();
  infoBox.innerHTML = result;
}

async function saveInfo() {
  const responseBox = document.getElementById("response");
  const form = document.getElementById("form");
  const formData = new FormData(form)

  const config = {
    method: "POST",
    body: formData 
  }

  const response = await fetch("./php/edit.php", config);
  const result = await response.text();
  responseBox.innerHTML = result;
}

fetchInfo()
</script>