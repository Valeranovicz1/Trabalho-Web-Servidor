<?php

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    require_once __DIR__ . '/../../controllers/clienteController.php';

    $controller = new ClienteController(); 
    $controller->editarPerfil();

    $nome = $_SESSION['usuario']['nome'] ?? 'Não definido';
    $email = $_SESSION['usuario']['email'] ?? 'Não definido';
    $nickname = $_SESSION['usuario']['nickname'] ?? 'Não definido';
    $data_nascimento = $_SESSION['usuario']['data_nascimento'] ?? 'Não definido';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Conta - ET Games</title>
    <link rel="icon" href="../../assets/img/logo/logo.png" type="image/png">
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
    <a href="/minha-conta" class="back-icon">
            <img src="/assets/img/outros/icovoltar.webp" alt="Voltar">
        </a>
        <img src="/assets/img/logo/logo.png" alt="Logo" class="logo">
        <img src="/assets/img/outros/myaccount.png" alt="Foto de Perfil" class="profile-pic">
        <h1 class="text-white">Minha Conta</h1>
         <form action="/editar-conta" method="POST">
            <div class="info">
                <label class="text-success" for="nickname">Nickname:</label>
                <input class="form-control mt-1" type="text" id="nickname" name="nickname" value="<?php echo htmlspecialchars($nickname); ?>">
            </div>
            <div class="info">
                <label class="text-success" for="email">Email:</label>
                <input class="form-control mt-1" type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
            </div>
            <div class="info">
                <label class="text-success" for="nome">Nome:</label>
                <input class="form-control mt-1" type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>">
            </div>
            <div class="info">
                <label class="text-success" for="dataNascimento">Data de Nascimento:</label>
                <input class="form-control mt-1" type="date" id="dataNascimento" name="dataNascimento" value="<?php echo htmlspecialchars($data_nascimento); ?>">
            </div>

            <button type="submit" name="editar" class="btn btn-success mt-3">Salvar Alterações</button>
        </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.min.js" integrity="sha384-VQqxDN0EQCkWoxt/0vsQvZswzTHUVOImccYmSyhJTp7kGtPed0Qcx8rK9h9YEgx+" crossorigin="anonymous"></script>
</body>

</html>