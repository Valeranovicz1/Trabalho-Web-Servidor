<?php


    require_once __DIR__ . '/../../controllers/registerController.php';

    $registerController = new RegisterController();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = trim($_POST['nome']);
        $email = trim($_POST['email']);
        $nickname = trim($_POST['nickname']);
        $senha = trim($_POST['senha']);
        $data_nascimento = trim($_POST['data_nascimento']);

        $resultado = $registerController->register($nome, $email, $nickname, $senha, $data_nascimento);

        if ($resultado) {
            header('Location: /view/login/Login.php');
            exit;
        } else {
            $erro = 'Erro ao registrar. Tente novamente.';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - ET Games</title>
    <link rel="icon" href="../../assets/img/logo/logo.png" type="image/png">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #121212;
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .registro-container {
            text-align: center;
            background-color: #1e1e1e;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
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

        .register-button {
            background-color: #00ff00;
            color: #121212;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }

        .register-button:hover {
            background-color: #028202;
        }

        .back-icon img {
            width: 20px;
            height: 20px;
            filter: brightness(300%);
            float: left;
        }
    </style>
</head>
<body>
    <div class="registro-container">
        <a href="../login/Login.php" class="back-icon">
            <img src="../../assets/img/outros/icovoltar.webp" alt="Voltar">
        </a>
        <div class="logo">
            <img src="../../assets/img/logo/logo.png" alt="ET Games Logo">
            <h1>ET Games</h1>
        </div>

        <h2>Registro</h2>

        <?php if (!empty($erro)): ?>
            <p style="color: red;"><?php echo htmlspecialchars($erro); ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <input type="text" id="nome" name="nome" placeholder="Nome" required>
            </div>
            <div class="form-group">
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="text" id="nickname" name="nickname" placeholder="Nickname" required>
            </div>
            <div class="form-group">
                <input type="password" id="senha" name="senha" placeholder="Senha" required>
            </div>
            <div class="form-group">
                <input type="date" id="data_nascimento" name="data_nascimento" required>
            </div>
            <button type="submit" class="register-button">Registrar</button>
        </form>
    </div>
</body>
</html>