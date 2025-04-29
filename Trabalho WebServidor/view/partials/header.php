<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ET Games</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="../assets/img/logo/logo.png" type="image/png">
    
</head>
<body>

<header>
    <div class="account-menu">
        <img src="../../assets/img/outros/myaccount.png" alt="Minha Conta" class="account-icon" onclick="toggleAccountMenu()">
        <div class="account-dropdown" id="accountDropdown">
            <a href="../partials/MinhaConta.php">Ir para a conta</a>
            <a href="../../index.php?action=logout">Sair</a>
        </div>
    </div>

    <div class="logo-container">
        <img src="../../assets/img/logo/logo.png" alt="Logo" class="logo">
        <img src="../../assets/img/logo/etgamesnome.png" alt="ET Games Nome" class="logo-text">
    </div>

    <nav>
        <a href="../painel/PainelCliente.php">Loja</a>
        <a href="../navCliente/biblioteca.php">Biblioteca</a>
        <a href="../navCliente/Carrinho.php">Carrinho</a>
        <a href="../navCliente/Suporte.php">Suporte</a>
        <a href="../navCliente/Sobre.php">Sobre</a>
    </nav>
</header>