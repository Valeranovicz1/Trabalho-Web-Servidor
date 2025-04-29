<?php

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['usuario']) || !in_array($_SESSION['usuario']['tipo'], ['cliente', 'empresa'])
    ) {
        header('Location: /view/login/login.php?erro=acesso_negado');
        exit;
    }

    $usuario = $_SESSION['usuario'] ?? [];

    $nickname = $usuario['nickname'] ?? 'Não definido';
    $email = $usuario['email'] ?? 'Não definido';
    $nome = $usuario['nome'] ?? 'Não definido';
    $data_nascimento = $usuario['data_nascimento'] ?? 'Não definido';
    
    ?>
    
    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title>Minha Conta - ET Games</title>
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
                border: 3px solid #00ff00;
            }
    
            .info {
                margin-bottom: 15px;
                text-align: left;
            }
    
            .info label {
                font-weight: bold;
                color: #00ff00;
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
    
            .edit-button {
                margin-top: 20px;
                background-color: #00ff00;
                color: #121212;
                border: none;
                padding: 10px 20px;
                font-size: 16px;
                font-weight: bold;
                border-radius: 5px;
                cursor: pointer;
                transition: 0.3s;
            }
    
            .edit-button:hover {
                background-color: #00cc00;
            }
    
        </style>
    </head>
    <body>
        <div class="container">
            <img src="../../assets/img/outros/myaccount.png" alt="Foto de Perfil" class="profile-pic">
            <h1>Minha Conta</h1>
            <div class="info">
                <label>Nickname:</label>
                <span><?= htmlspecialchars($nickname) ?></span>
            </div>
            <div class="info">
                <label>Email:</label>
                <span><?= htmlspecialchars($email) ?></span>
            </div>
            <div class="info">
                <label>Nome:</label>
                <span><?= htmlspecialchars($nome) ?></span>
            </div>
            <div class="info">
                <label>Data de Nascimento:</label>
                <span><?= htmlspecialchars($data_nascimento) ?></span>
            </div>
    
            <form action="../../index.php" method="GET">
                <input type="hidden" name="action" value="editarPerfil">
                <button type="submit" class="edit-button">Editar Perfil</button>
            </form>
    
        </div>
    </body>
    </html>