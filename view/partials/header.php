<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ET Games</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/style-painel.css">
    <link rel="icon" href="../assets/img/logo/logo.png" type="image/png">


</head>

<body>

    <header>
        <div class="account-menu">
            <img src="../../assets/img/outros/myaccount.png" alt="Minha Conta" class="account-icon" onclick="toggleAccountMenu()">
            <div class="account-dropdown" id="accountDropdown">
                <a href="../navCliente/MinhaConta.php">Ir para a conta</a>
                <a href="../../index.php?action=logout">Sair</a>
            </div>
        </div>

        <div class="logo-container">
            <img src="../../assets/img/logo/logo.png" alt="Logo" class="logo">
            <img src="../../assets/img/logo/etgamesnome.png" alt="ET Games Nome" class="logo-text">
        </div>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav w-100 justify-content-center">
                        <li class="nav-item"><a class="link-success nav-link fs-3" href="../painel/PainelCliente.php">Loja</a></li>
                        <li class="nav-item"><a class="link-success nav-link fs-3" href="../navCliente/biblioteca.php">Biblioteca</a></li>
                        <li class="nav-item"><a class="link-success nav-link fs-3" href="../navCliente/Carrinho.php">Carrinho</a></li>
                        <li class="nav-item"><a class="link-success nav-link fs-3" href="../navCliente/Suporte.php">Suporte</a></li>
                        <li class="nav-item"><a class="link-success nav-link fs-3" href="../navCliente/Sobre.php">Sobre</a></li>
                    </ul>
                </div>
            </div>
    </header>