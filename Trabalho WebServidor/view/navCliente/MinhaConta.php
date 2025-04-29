<?php

$nickname = isset($_SESSION['nickname']) ? $_SESSION['nickname'] : 'Não definido';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : 'Não definido';
$nome = isset($_SESSION['nome']) ? $_SESSION['nome'] : 'Não definido';
$data_nascimento = isset($_SESSION['data_nascimento']) ? $_SESSION['data_nascimento'] : 'Não definido';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Conta - ET Games</title>
    <link rel="icon" href="img/logo/logo.png" type="image/png">
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

        .logo {
            position: absolute;
            top: 10px;
            left: 10px;
            width: 200px;
            height: auto;
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
        <img src="img/logo/logo.png" alt="Logo" class="logo">
        <img src="img/outros/myaccount.png" alt="Foto de Perfil" class="profile-pic">
        <h1>Minha Conta</h1>
        <div class="info">
            <label>Nickname:</label>
            <span><?php echo htmlspecialchars($nickname); ?></span>
        </div>
        <div class="info">
            <label>Email:</label>
            <span><?php echo htmlspecialchars($email); ?></span>
        </div>
        <div class="info">
            <label>Nome:</label>
            <span><?php echo htmlspecialchars($nome); ?></span>
        </div>
        <div class="info">
            <label>Data de Nascimento:</label>
            <span><?php echo htmlspecialchars($data_nascimento); ?></span>
        </div>

        <form action="editarConta.php" method="GET">
            <button type="submit" class="edit-button">Editar Perfil</button>
        </form>

    </div>
    
</body>
</html>
