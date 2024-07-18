<?php

require_once("user.php");

session_start();

$user = new user($_SESSION["authorization"]);

echo '<div class="field">';
echo '<p class="label">Fan ID</p>';
echo '<p class="context">FAN_' . $user->id . '</p>';
echo '</div>';

echo '<div class="field">';
echo '<p class="label">Email</p>';
echo '<p class="context">' . $user->email . '</p>';
echo '</div>';

echo '<div class="field">';
echo '<p class="label">Name</p>';
echo '<p class="context">' . $user->name . '</p>';
echo '</div>';

echo '<div class="field">';
echo '<p class="label">Birthday</p>';
echo '<p class="context">' . $user->formatted_birthday . '</p>';
echo '</div>';

echo '<div class="field">';
echo '<p class="label">Username</p>';
echo '<p class="context">' . $user->username . '</p>';
echo '</div>';

?>