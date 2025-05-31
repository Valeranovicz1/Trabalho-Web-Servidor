<?php

namespace App\Model;

use App\Controllers\JogoController;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario']) || !isset($_SESSION['usuario']['id']) || !isset($_SESSION['usuario']['tipo']) || $_SESSION['usuario']['tipo'] !== 'empresa') {

    header('Location: /view/login/login.php?erro=acesso_negado_view');
    exit;
}


$jogoController = new JogoController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['cadastrar'])) {
        $jogoController->cadastrarJogo();
    } elseif (isset($_POST['excluir'])) {
        $jogoController->excluirJogoPainel();
    }
}


$jogos = $jogoController->listarJogosEmpresa();

$mensagemSucesso = $_SESSION['mensagem_sucesso_jogo'] ?? null;
$mensagemErro = $_SESSION['mensagem_erro_jogo'] ?? null;
unset($_SESSION['mensagem_sucesso_jogo'], $_SESSION['mensagem_erro_jogo']);

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ET Games - Empresa</title>

    <link rel="stylesheet" href="/assets/css/style-painel.css">
    <script src="/assets/js/scriptLoja.js" defer></script>
    <link rel="icon" href="/assets/img/logo/logo.png" type="image/png">
</head>

<body>
    <?php include_once __DIR__ . '/../partials/headerEmpresa.php'; ?>
    <div class="empresa-painel-container container mt-5">
        <h1 class="text-success text-center mb-5">Painel da Empresa</h1>

        <?php if ($mensagemSucesso): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($mensagemSucesso); ?></div>
        <?php endif; ?>
        <?php if ($mensagemErro): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($mensagemErro); ?></div>
        <?php endif; ?>

        <h2 class="text-white">Cadastrar Novo Jogo</h2>
        <form method="POST" action="/painelEmpresa" enctype="multipart/form-data">

            <label class="text-success form-label" for="nome">Nome do Jogo:</label>
            <input class="form-control" type="text" id="nome" name="nome" required>

            <label class="text-success form-label" for="descricao">Descrição:</label>
            <input class="form-control" type="text" id="descricao" name="descricao" required>

            <label class="text-success form-label" for="categoria">Categoria:</label>
            <select class="form-select" aria-label="categoria" id="categoria" name="categoria" required>
                <option selected>Selecione uma Categoria</option>
                <option value="FPS">FPS</option>
                <option value="Ação">Ação</option>
            </select>

            <label class="text-success form-label" for="imagem_jogo">Imagem do Jogo:</label>
            <input class="form-control" type="file" id="imagem_jogo" name="imagem_jogo">

            <label class="text-success form-label" for="preco">Preço (R$):</label>
            <input class="form-control" type="text" id="preco" name="preco" placeholder="Ex: 29,90" required>

            <label class="text-success form-label" for="classificacao">Classificação (0-21):</label>
            <input class="form-control" type="number" id="classificacao" name="classificacao" min="0" max="21" required>

            <button type="submit" name="cadastrar" class="btn btn-success">Cadastrar Jogo</button>
        </form>

        <h2 class="text-white">Excluir Jogo</h2>
        <form method="POST" action="/painelEmpresa">

            <label class="text-success form-label" for="nome_excluir">Selecione o jogo para excluir:</label>
            <select class="form-select" id="nome_excluir" name="nome_excluir" required>
                <option value="">Selecione um Jogo</option>
                <?php if (!empty($jogos)): ?>
                    <?php foreach ($jogos as $jogo): ?>
                        <option value="<?php echo htmlspecialchars($jogo['nome']); ?>">
                            <?php echo htmlspecialchars($jogo['nome']); ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
            <button type="submit" name="excluir" class="btn btn-danger">Excluir Jogo</button>
        </form>

        <h2 class="text-white">Listar Jogos</h2>
        <form method="POST" action="painelEmpresa">
            <button type="submit" name="listar_empresa" class="btn btn-info">
                Clique aqui para listar os jogos
            </button>
        </form>

        <?php
        if (isset($_POST['listar_empresa']) || (empty($_POST) && !empty($jogos))):
        ?>
            <h3 class="text-white">Jogos Cadastrados:</h3>
            <?php if (empty($jogos)): ?>
                <p class="text-white">Nenhum jogo cadastrado por sua empresa.</p>
            <?php else: ?>
                <ul class="lista-jogos">
                    <?php foreach ($jogos as $jogo): ?>
                        <li>
                            <strong><?php echo htmlspecialchars($jogo['nome']); ?></strong><br>
                            <small>Descrição: <?php echo htmlspecialchars($jogo['descricao']); ?></small><br>
                            <small>Categoria: <?php echo htmlspecialchars($jogo['categoria'] ?? 'N/A'); ?></small><br>
                            <small>Preço: R$ <?php echo number_format(floatval($jogo['preco']), 2, ',', '.'); ?></small><br>
                            <small>Classificação: <?php echo htmlspecialchars($jogo['classificacao'] ?? 'N/A'); ?></small><br>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        <?php endif; ?>

    </div>

    <script src="/Trabalho-Web-Servidor/assets/js/scriptLoja.js" defer></script>

    <?php include_once __DIR__ . '/../partials/footer.php'; ?>



</body>

</html>