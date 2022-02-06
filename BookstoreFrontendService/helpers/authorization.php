<?php

require_once "./destroy.php";

if (
    isset($_POST['user']) &&
    isset($_POST['username']) &&
    isset($_POST['token'])
) {
    $_SESSION['user'] = $_POST['user'];
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['token'] = $_POST['token'];
}
else if (isset($_POST['logout'])) {
    unset($_SESSION['user']);
    unset($_SESSION['username']);
    unset($_SESSION['token']);
    session_destroy();
}

$authorized = false;
if (isset($_SESSION['user']) && isset($_SESSION['username']) && isset($_SESSION['token'])) {
    header("Authorization: {$_SESSION['token']}");
    $authorized = true;
} else if (!isset($index) || (isset($index) && !$index)) {
    header("location: index.php?message=Login To Continue");
}
