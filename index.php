<?php

session_start();

$token = function (string $lock = null) {
    if (! isset($_SESSION['token'])) {
        $_SESSION['token'] = bin2hex(random_bytes(32));
    }

    if (! isset($_SESSION['second_token'])) {
        $_SESSION['second_token'] = bin2hex(random_bytes(32));
    }

    if (is_null($lock)) {
        $_SESSION['rightToken'] = $_SESSION['token'];
    }

    $_SESSION['rightToken'] = hash_hmac('sha256', $lock, $_SESSION['second_token']);

    return $_SESSION['rightToken'];
};

if (isset($_POST['token']) && hash_equals($_POST['token'], $_SESSION['rightToken'])) {
    echo $_POST['name']."\n";
    echo $_SESSION['rightToken'];
}

?>

<form method="POST" action="/">
    <input type="hidden" name="token" value="<?php echo $token() ?>">
    <input type="text" name="name">
    <input type="submit" name="submit" value="save">
</form>

