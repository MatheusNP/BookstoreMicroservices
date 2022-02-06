<?php
if (isset($_GET['destroy'])) {
    session_start();
    unset($_SESSION['user']);
    session_destroy();
}
