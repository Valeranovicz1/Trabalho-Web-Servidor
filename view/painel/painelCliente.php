<?php include_once __DIR__ . '/../partials/header.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ET Games</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/style-painel.css">
    <link rel="icon" href="/assets/img/logo/logo.png" type="image/png">
</head>

<body>

    <main>

        <section class="carousel-section">
            <h2 class="text-white">AÇÃO</h2>
            <div class="carousel-container">
                <button class="carousel-btn prev-btn" onclick="scrollCarousel(this, -1)">&lt;</button>
                <div class="teste">
                    <?php if (!empty($jogosAcao)): ?>
                        <?php foreach ($jogosAcao as $jogo): ?>

                            <?php

                            $caminhoImagemDoBanco = $jogo['imagem'] ?? null;
                            $imagemParaExibir = null;
                            if (!empty($jogo['imagem'])) {
                                $imagemParaExibir = $imgPathPrefix . $caminhoImagemDoBanco;
                            }
                            ?>
                            <div class="teste-item" onclick="openGameDetails( 
                                            '<?= htmlspecialchars($jogo['nome'] ?? 'Jogo', ENT_QUOTES, 'UTF-8') ?>',
                                            'R$<?= number_format(floatval($jogo['preco'] ?? 0), 2, ',', '.') ?>',
                                            '<?= htmlspecialchars($imagemParaExibir, ENT_QUOTES, 'UTF-8') ?>',
                                            '<?= htmlspecialchars($jogo['categoria'] ?? 'N/A', ENT_QUOTES, 'UTF-8') ?>'
                                )">
                                <img src="<?= htmlspecialchars($imagemParaExibir) ?>" alt="<?= htmlspecialchars($jogo['nome'] ?? 'Jogo', ENT_QUOTES, 'UTF-8') ?>">
                                <p class="text-white"><?= htmlspecialchars($jogo['nome'] ?? 'Jogo', ENT_QUOTES, 'UTF-8') ?></p>
                                <p class="text-success">R$<?= number_format(floatval($jogo['preco'] ?? 0), 2, ',', '.') ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-white">Nenhum jogo de ação para exibir no momento.</p>
                    <?php endif; ?>
                </div>
                <button class="carousel-btn next-btn" onclick="scrollCarousel(this, 1)">&gt;</button>
            </div>
        </section>

        <section class="carousel-section">
            <h2 class="text-white">FPS</h2>
            <div class="carousel-container">
                <button class="carousel-btn prev-btn" onclick="scrollCarousel(this, -1)">&lt;</button>
                <div class="teste">
                    <?php if (!empty($jogosFPS)): ?>
                        <?php foreach ($jogosFPS as $jogo): ?>

                            <?php

                            $caminhoImagemDoBanco = $jogo['imagem'] ?? null;
                            $imagemParaExibir = null;
                            if (!empty($jogo['imagem'])) {
                                $imagemParaExibir = $imgPathPrefix . $caminhoImagemDoBanco;
                            }
                            ?>
                            <div class="teste-item" onclick="openGameDetails( 
                                    '<?= htmlspecialchars($jogo['nome'] ?? 'Jogo', ENT_QUOTES, 'UTF-8') ?>',
                                    'R$<?= number_format(floatval($jogo['preco'] ?? 0), 2, ',', '.') ?>',
                                    '<?= htmlspecialchars($imagemParaExibir, ENT_QUOTES, 'UTF-8') ?>',
                                    '<?= htmlspecialchars($jogo['categoria'] ?? 'N/A', ENT_QUOTES, 'UTF-8') ?>'
                                )">
                                <img src="<?= htmlspecialchars($imagemParaExibir) ?>" alt="<?= htmlspecialchars($jogo['nome'] ?? 'Jogo', ENT_QUOTES, 'UTF-8') ?>">
                                <p class="text-white"><?= htmlspecialchars($jogo['nome'] ?? 'Jogo', ENT_QUOTES, 'UTF-8') ?></p>
                                <p class="text-success">R$<?= number_format(floatval($jogo['preco'] ?? 0), 2, ',', '.') ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-white">Nenhum jogo de FPS para exibir no momento.</p>
                    <?php endif; ?>
                </div>
                <button class="carousel-btn next-btn" onclick="scrollCarousel(this, 1)">&gt;</button>
            </div>
        </section>

    </main>

    <div id="gameModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeGameDetails()">&times;</span>
            <img id="modalImage" src="" alt="Imagem do Jogo">
            <h2 id="modalTitle"></h2>
            <p id="modalPrice"></p>
            <p id="modalDetails">Detalhes do jogo serão exibidos aqui.</p>
            <button id="addToCartButton" class="add-to-cart-button" onclick="addToCart()">Colocar no Carrinho</button>
        </div>
    </div>

    <script src="/assets/js/scriptLoja.js" defer></script>

    <?php include_once __DIR__ . '/../partials/footer.php'; ?>