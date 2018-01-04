<?php

session_start();
$token = function ($lock = null) {
    if (! isset($_SESSION['token'])) {
        $_SESSION['token'] = bin2hex(random_bytes(32));
    }

    if (! isset($_SESSION['second_token'])) {
        $_SESSION['second_token'] = bin2hex(random_bytes(32));
    }

    if (is_null($lock)) {
        $_SESSION['right_token'] = $_SESSION['token'];
    }

    $_SESSION['right_token'] = hash_hmac('sha256', $lock, $_SESSION['second_token']);

    return $_SESSION['right_token'];
};

if(isset($_POST['submit']) && hash_equals($_SESSION['right_token'], $_POST['token'])){
    echo $_POST['name']."\n";
    echo $_POST['token'];
}
?>

<form method="POST" action="/">
    <input type="hidden" name="token" value="<?php echo $token() ?>">
    <input type="text" name="name">
    <input type="submit" name="submit" value="save">
</form>

