<?php

namespace App\Controllers;


$registerController = new RegisterController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $registerController->register();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - ET Games</title>
    <link rel="icon" href="/assets/img/logo/logo.png" type="image/png">
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

        .registro-container {
            text-align: center;
            background-color: rgb(26, 26, 26);
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
            margin-left: -30px;
        }

        .logo h1 {
            font-size: 24px;
            font-weight: bold;
            color: #00ff00;
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

        .back-icon img {
            width: 20px;
            height: 20px;
            filter: brightness(3000%);
            float: left;
        }
    </style>
</head>

<body>
    <div class="registro-container">
        <a href="/" class="back-icon">
            <img src="/assets/img/outros/icovoltar.webp" alt="Voltar">
        </a>
        <div class="logo">
            <img src="/assets/img/logo/logo.png" alt="ET Games Logo">
            <h1 class="text-success">ET Games</h1>
        </div>

        <h2 class="text-light">Registro</h2>

        <?php if (!empty($erro)): ?>
            <p style="color: red;"><?php echo htmlspecialchars($erro); ?></p>
        <?php endif; ?>

        <form method="POST" action="/registro">
            <div class="form-group">
                <input type="text" id="nome" name="nome" placeholder="Nome">
            </div>
            <div class="form-group">
                <input type="email" id="email" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="text" id="nickname" name="nickname" placeholder="Nickname">
            </div>
            <div class="form-group">
                <input type="password" id="senha" name="senha" placeholder="Senha">
            </div>
            <div class="form-group">
                <input type="date" id="data_nascimento" name="data_nascimento">
            </div>
            <button type="submit" class="btn btn-success">Registrar</button>
        </form>


    </div>
</body>

</html>