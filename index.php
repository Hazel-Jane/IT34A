<?php

require 'config/config.php';
require 'config/functions.php';

if(isset($_SESSION['user_id'])){
    header('Location: ' . BASE_URL . '/app/' . $_SESSION['user_role'] . '/index.php');
    
}
$error = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $login = trim($_POST['login'] ?? '');
    $password = $_POST['password'] ?? '';


    if($login=== '' || $password === ''){
    $error = 'Invalid login credentials';
       logActivity(
        $pdo,
        null,
        $login,
        'login',
        'failed'
       );
    }else {
       if(loginUser($pdo,$login,$password)){
        logActivity(
            $pdo,
            $_SESSION['user_id'],
            $_SESSION['user_email'],
            'login',
            'success'
        );
      header('Location: ' . BASE_URL . '/app/' . $_SESSION['user_role'] . '/index.php');
      exit;
    } 
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

<?php if($error): ?>

    <p><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <h1>User Login</h1>
    <form method = "POST">
        <label> Username or email </label>
        <input type = "text"
                        name = "login"
                        required
                    >
                        <br>
                        <label> Password </label>
                        <input type = "password"
                        name = "password"
                        required
                    >
                        <br>
                        <button type = "submit"> Sign In </button>
    </form>


</body>
</html>