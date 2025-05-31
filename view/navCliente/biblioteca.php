<?php
    use App\Controllers\bibliotecaController;
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] !== 'cliente') {
        header('Location: ../view/login/login.php?erro=acesso_negado');
        exit;
    }

    $imgPathPrefix = '../../';
    $placeholderImage = '../../assets/img/placeholder.png';

    $biblioteca = new bibliotecaController();

    $jogosBiblioteca = $biblioteca->listarJogosBiblioteca();

?>
    <?php include_once __DIR__ . '/../partials/header.php'; ?>
<head>
    <meta charset="UTF-8">
    <title>Biblioteca de Jogos</title>
    <link rel="icon" href="../../assets/img/logo/logo.png" type="image/png">
    <link rel="stylesheet" href="/assets/css/style-painel.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<main>
    <section class="game-filter-section">
        <h2>Filtrar Jogos</h2>
        <form method="get" action="">
            <label for="categoria">Categoria:</label>
            <select name="categoria" id="categoria">
                <option value="">Todas as Categorias</option>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?php echo htmlspecialchars($categoria); ?>" 
                        <?php if (isset($_GET['categoria']) && $_GET['categoria'] === $categoria) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($categoria); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <input type="submit" value="Filtrar">
        </form>
    </section>

    <section class="game-grid-section">
    <h2>Meus Jogos</h2>
    <div class="game-grid-container"> <?php if (!empty($jogosBiblioteca)): ?>
            <?php foreach ($jogosBiblioteca as $jogo): ?>
                <?php  
                    // Lógica PHP para $imagemParaExibir (como mostrado acima)
                    $caminhoImagemDoBanco = $jogo['imagem'] ?? null;
                    $imagemParaExibir = $placeholderImage; 
                    if (!empty($caminhoImagemDoBanco)) {
                        $imagemParaExibir = $imgPathPrefix . $caminhoImagemDoBanco;
                    }   
                ?>
                <div class="game-item"  data-nome="<?= htmlspecialchars($jogo['nome'] ?? 'Jogo', ENT_QUOTES, 'UTF-8') ?>"
                     data-preco="R$<?= isset($jogo['preco']) ? number_format(floatval($jogo['preco']), 2, ',', '.') : 'N/A' ?>"
                     data-imagem="<?= htmlspecialchars($imagemParaExibir, ENT_QUOTES, 'UTF-8') ?>"
                     data-categoria="<?= htmlspecialchars($jogo['categoria'] ?? 'N/A', ENT_QUOTES, 'UTF-8') ?>"
                     data-descricao="<?= htmlspecialchars($jogo['descricao'] ?? 'Sem descrição.', ENT_QUOTES, 'UTF-8') ?>"
                     data-id_jogo="<?= htmlspecialchars($jogo['id_jogo'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                     >
                    
                    <div class="game-image-wrapper">
                        <img src="<?= htmlspecialchars($imagemParaExibir, ENT_QUOTES, 'UTF-8') ?>"
                             alt="Capa do jogo <?= htmlspecialchars($jogo['nome'] ?? 'Jogo', ENT_QUOTES, 'UTF-8') ?>">
                    </div>
                    <div class="game-info">
                        <div class="game-title">
                            <p title="<?= htmlspecialchars($jogo['nome'] ?? 'Jogo', ENT_QUOTES, 'UTF-8') ?>">
                                <?= htmlspecialchars($jogo['nome'] ?? 'Jogo Indisponível', ENT_QUOTES, 'UTF-8') ?>
                            </p>
                        </div>
                        <div class="game-category">
                            <p><?= htmlspecialchars($jogo['categoria'] ?? 'N/A', ENT_QUOTES, 'UTF-8') ?></p>
                        </div>
                    </div>
                </div> <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                 <p class="text-white-50 fs-5">Nenhum jogo comprado.</p> </div>
        <?php endif; ?>
    </div> </section>
</main>

    <?php include_once __DIR__ . '/../partials/footer.php'; ?>
