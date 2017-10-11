<?php

$session = session_id();
if (!$session) {
  session_start();
  $session = session_id();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  logoutUser();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  unsetPassword();
}

function logoutUser() {
  unset($_SESSION['username'], $_SESSION['password'], $_SESSION['responseArray'], $_SESSION['authenticated']);
  header("Location: index.php");
  var_dump($_SESSION);
}

function unsetPassword() {
  if(isset($_SESSION['password'])) {
    unset($_SESSION['password'], $_SESSION['responseArray']);
  }
  header("Location: index.php");
}

