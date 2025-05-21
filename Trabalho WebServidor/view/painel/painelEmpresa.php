<?php

    if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

    if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] !== 'empresa') {
        header('Location: /view/login/login.php?erro=acesso_negado');
        exit;
    }

    require_once __DIR__ . '/../../controllers/jogoController.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cadastrar'])) {
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];

        JogoController::criarJogo($nome, $descricao, $preco);
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['excluir'])) {
        $nomeExcluir = $_POST['nome_excluir'];

        JogoController::excluirJogoPorNome($nomeExcluir);
    }


    $jogos = JogoController::listarJogos();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ET Games</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/style-painel.css">
    <link rel="icon" href="../../assets/img/logo/logo.png" type="image/png">
    
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
</header>

<div class="empresa-painel-container">
    <h1 class="text-success text-center mb-5">Painel da Empresa</h1>


    <h2 class="text-white">Cadastrar Novo Jogo</h2>
    <form method="post">
        <label for="nome">Nome do Jogo:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="descricao">Descrição:</label>
        <input type="text" id="descricao" name="descricao" required>

        <label for="preco">Preço:</label>
        <input type="number" step="0.01" id="preco" name="preco" required>

        <button type="submit" name="cadastrar">Cadastrar Jogo</button>
    </form>


    <h2>Excluir Jogo</h2>
    <form method="post">
        <label for="nome_excluir">Selecione o jogo para excluir:</label>
        <select id="nome_excluir" name="nome_excluir" required>
            <?php foreach ($jogos as $jogo): ?>
                <option value="<?php echo htmlspecialchars($jogo->nome); ?>">
                    <?php echo htmlspecialchars($jogo->nome); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="excluir">Excluir Jogo</button>
    </form>


    <h2>Listar Jogos</h2>
    <form method="post">
        <button type="submit" name="listar">Clique aqui para listar os jogos</button>
    </form>


    <?php if (isset($_POST['listar'])): ?>
        <h3>Jogos Cadastrados:</h3>
        <?php if (empty($jogos)): ?>
            <p>Nenhum jogo cadastrado.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($jogos as $jogo): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($jogo->nome); ?></strong> -
                        <?php echo htmlspecialchars($jogo->descricao); ?> -
                        R$ <?php echo number_format($jogo->preco, 2, ',', '.'); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    <?php endif; ?>

</div>

<?php include '../partials/footer.php';?>
