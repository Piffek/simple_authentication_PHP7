<?php

session_start();
if (! isset($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
    $token = $_SESSION['token'];
} else {
    $token = $_SESSION['token'];
}

if (hash_equals($_SESSION['token'], $_POST['token'])) {
    if (isset($_POST['submit'])) {
        echo $_POST['name']."\n";
        echo $_SESSION['token'];
    }
} else {
    echo 'Bad authentication';
}

?>