<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../controllers/LoginController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $loginController = new LoginController();
    $loginController->login();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ET Games</title>
    <link rel="icon" href="../../assets/img/logo/logo.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <style>
        body {
            background-color: #121212;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            text-align: center;
            background-color:rgb(26, 26, 26);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 110, 0, 0.5);
            width: 300px;
        }

        .logo {
            margin-bottom: 20px;
        }

        .logo img {
            width: 100px;
        }

        .logo h1 {
            font-size: 24px;
            font-weight: bold;
            margin: 10px 0 0;
            font-family: 'Courier New', Courier, monospace;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group input {
            width: 90%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-group input:focus {
            outline: none;
            box-shadow: 0 0 5px #00ff00;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="logo">
            <img src="../../assets/img/logo/logo.png" alt="ET Games Logo">
            <h1 class="text-success">ET Games</h1>
        </div>
        <h2 class="text-light">Login</h2>

        <form action="" method="POST">
            <div class="form-group">
                <input type="text" id="nickname" name="nickname" placeholder="Nickname" required>
            </div>
            <div class="form-group">
                <input type="password" id="senha" name="senha" placeholder="Senha" required>
            </div>
            <button type="submit" class="btn btn-success">Login</button>
            <button type="button" class="btn btn-success" onclick="window.location.href='../login/Registro.php'">Registro</button>
        </form>
    </div>
</body>

</html>