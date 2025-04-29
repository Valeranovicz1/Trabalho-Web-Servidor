<?php
    
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['usuario'])) {
        if ($_SESSION['usuario']['tipo'] === 'empresa') {
            header('Location: ../painel/painelEmpresa.php');
        } else {
            header('Location: ../painel/painelCliente.php');
        }
        exit;
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
    <link rel="icon" href="/assets/img/logo/logo.png" type="image/png">
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

        .login-container {
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

        .login-button, .register-button {
            background-color: #00ff00;
            color: #121212;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }

        .login-button:hover, .register-button:hover {
            background-color: #028202;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <img src="../../assets/img/logo/logo.png" alt="ET Games Logo">
            <h1>ET Games</h1>
        </div>
        <h2>Login</h2>

        <?php if (isset($_GET['erro'])): ?>
            <div style="color: red; margin-bottom: 10px;">
                <?php
                switch ($_GET['erro']) {
                    case 'usuario_nao_encontrado':
                        echo "<script> alert(' Usuário não encontrado.') </script>";
                        break;
                    case 'senha_incorreta':
                        echo "<script> alert(' Senha Incorreta.') </script>";
                        break;
                    case 'tipo_desconhecido':
                        echo "<script> alert(' Tipo de Usuário Desconhecido.') </script>";
                        break;
                    default:
                        echo "<script> alert(' Erro ao Fazer Login.') </script>";
                }
                ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="form-group">
                <input type="text" id="nickname" name="nickname" placeholder="Nickname" required>
            </div>
            <div class="form-group">
                <input type="password" id="senha" name="senha" placeholder="Senha" required>
            </div>
            <button type="submit" class="login-button">Login</button>
            <button type="button" class="register-button" onclick="window.location.href='../login/Registro.php'">Registrar</button>
        </form>
    </div>
</body>
</html>
