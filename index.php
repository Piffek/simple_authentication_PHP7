<?php

session_start();
if (! isset($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
    $token = $_SESSION['token'];
} else {
    $token = $_SESSION['token'];
}

if (isset($_POST['submit']) && hash_equals($_SESSION['token'], $_POST['token'])) {
    echo $_POST['name']."\n";
    echo $_SESSION['token'];
}

?>

