<?php

if (
    isset($_POST['user']) &&
    isset($_POST['token'])
) {
    $_SESSION['user'] = $_POST['user'];
    $_SESSION['token'] = $_POST['token'];
}
else if (isset($_POST['logout'])) {
    unset($_SESSION['user']);
    unset($_SESSION['token']);
    session_destroy();
    // header("location: index.php?Message=successfully logged out!!");
}

$authorized = false;
if (isset($_SESSION['user']) && isset($_SESSION['token'])) {
    header("Authorization: {$_SESSION['token']}");
    $authorized = true;
} else if (!isset($index) || (isset($index) && !$index)) {
    // header("location: index.php?Message=Login To Continue");
}