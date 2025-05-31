<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$tipo = $_SESSION['usuario']['tipo'] ?? '';
$nome = $_SESSION['usuario']['nome'] ?? 'Não definido';
$email = $_SESSION['usuario']['email'] ?? 'Não definido';
$nickname = $_SESSION['usuario']['nickname'] ?? 'Não definido';
$data_nascimento = $_SESSION['usuario']['data_nascimento'] ?? 'Não definido';

$mensagem_sucesso = $_SESSION['mensagem_sucesso'] ?? null;
$mensagem_erro = $_SESSION['mensagem_erro'] ?? null;

unset($_SESSION['mensagem_sucesso'], $_SESSION['mensagem_erro']);

if ($tipo === 'cliente') {
    $backUrl =  '/loja';
} else if ($tipo === 'empresa') {
    $backUrl = '/painelEmpresa';
} else {
    $backUrl = '/';
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Conta - ET Games</title>
    <link rel="icon" href="/assets/img/logo/logo.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            text-align: center;
            background-color: #1e1e1e;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            width: 350px;
            position: relative;
        }

        .profile-pic {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
            border: 3px solid #198754;
        }

        .info {
            margin-bottom: 15px;
            text-align: left;
        }

        .info label {
            font-weight: bold;
            color: #198754;
            display: block;
            margin-bottom: 5px;
        }

        .info span {
            font-size: 16px;
            color: #c7d5e0;
            display: block;
            background-color: #2a2a2a;
            padding: 10px;
            border-radius: 5px;
        }

        .logo {
            position: absolute;
            top: 1px;
            left: -500px;
            width: 150px;
            height: auto;
        }
        
        .back-icon img {
            width: 20px;
            height: 20px;
            filter: brightness(3000%);
            position: absolute;
            top: 20px;
            left: 10px;
        }

    </style>
</head>

<body>
    
    <div class="container">
        <a href="<?= $backUrl ?>" class="back-icon">
            <img src="/assets/img/outros/icovoltar.webp" alt="Voltar">
        </a>
        <img src="/assets/img/logo/logo.png" alt="Logo" class="logo">
        <img src="/assets/img/outros/myaccount.png" alt="Foto de Perfil" class="profile-pic">

        <h1 class="text-white">Minha Conta</h1>
        
        <?php if ($mensagem_sucesso): ?>
            <div class="alert alert-success" role="alert">
                <?php echo htmlspecialchars($mensagem_sucesso); ?>
            </div>
        <?php endif; ?>
        
        <?php if ($mensagem_erro): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($mensagem_erro); ?>
            </div>
        <?php endif; ?>
        <div class="info">
            <label class="text-success">Nickname:</label>
            <span><?php echo htmlspecialchars($nickname); ?></span>
        </div>
        <div class="info">
            <label class="text-success">Email:</label>
            <span><?php echo htmlspecialchars($email); ?></span>
        </div>
        <div class="info">
            <label class="text-success">Nome:</label>
            <span><?php echo htmlspecialchars($nome); ?></span>
        </div>
        <div class="info">
            <label class="text-success">Data de Nascimento:</label>
            <span><?php echo htmlspecialchars($data_nascimento); ?></span>
        </div>

        <form action="/editar-conta" method="GET">
            <button type="submit" class="btn btn-success">Editar Perfil</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.min.js" …></script>
</body>
</html>