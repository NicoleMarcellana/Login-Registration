<?php

require_once("connection.php");

class user {
  public $id;
  public $name;
  public $email;
  public $birthday;
  public $formatted_birthday;
  public $username;
  
  function __construct($email) {
    $db = connectDB();
    $sql = "SELECT id, name, dob, DATE_FORMAT(dob, '%M %e, %Y') AS formatted_birthday, email, username FROM users WHERE email = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id, $name, $birthday, $formatted_birthday, $email, $username);
    $stmt->fetch();
    $db->close();

    $this->id = $id;
    $this->name = $name;
    $this->birthday = $birthday;
    $this->formatted_birthday = $formatted_birthday;
    $this->email = $email;
    $this->username = $username;
  }
}

?>