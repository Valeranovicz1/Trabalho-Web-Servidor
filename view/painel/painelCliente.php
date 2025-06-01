<?php include_once __DIR__ . '/../partials/header.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ET Games</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/style-painel.css">
    <link rel="icon" href="/assets/img/logo/logo.png" type="image/png">
</head>

<body>

    <main>

        <section class="carousel-section mb-5">
            <h2 class="text-white mb-3">AÇÃO</h2>

            <?php if (!empty($jogosAcao)): ?>
                <div id="carouselAcao" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        $itemsPerSlide = 4;
                        $totalSlides = ceil(count($jogosAcao) / $itemsPerSlide);

                        for ($slide = 0; $slide < $totalSlides; $slide++):
                            $activeClass = ($slide === 0) ? 'active' : '';
                        ?>
                            <div class="carousel-item <?= $activeClass ?>">
                                <div class="row">
                                    <?php
                                    $startIndex = $slide * $itemsPerSlide;
                                    $endIndex = min(($slide + 1) * $itemsPerSlide, count($jogosAcao));

                                    for ($i = $startIndex; $i < $endIndex; $i++):
                                        $jogo = $jogosAcao[$i];
                                        $caminhoImagemDoBanco = $jogo['imagem'] ?? null;
                                        $imagemParaExibir = null;
                                        if (!empty($jogo['imagem'])) {
                                            $imagemParaExibir = $imgPathPrefix . $caminhoImagemDoBanco;
                                        }
                                    ?>
                                        <div class="col-md-3">
                                            <div class="game-card"
                                                data-game-id="<?= intval($jogo['id_jogo'] ?? 0) ?>"
                                                data-game-name="<?= htmlspecialchars($jogo['nome'] ?? 'Jogo', ENT_QUOTES, 'UTF-8') ?>"
                                                data-game-price="R$<?= number_format(floatval($jogo['preco'] ?? 0), 2, ',', '.') ?>"
                                                data-game-image="<?= htmlspecialchars($imagemParaExibir, ENT_QUOTES, 'UTF-8') ?>"
                                                data-game-category="<?= htmlspecialchars($jogo['categoria'] ?? 'N/A', ENT_QUOTES, 'UTF-8') ?>">
                                                <img src="<?= htmlspecialchars($imagemParaExibir) ?>" class="img-fluid game-image" alt="<?= htmlspecialchars($jogo['nome'] ?? 'Jogo', ENT_QUOTES, 'UTF-8') ?>">
                                                <div class="game-info">
                                                    <p class="game-title text-white"><?= htmlspecialchars($jogo['nome'] ?? 'Jogo', ENT_QUOTES, 'UTF-8') ?></p>
                                                    <p class="game-price text-success">R$<?= number_format(floatval($jogo['preco'] ?? 0), 2, ',', '.') ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselAcao" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselAcao" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                        <span class="visually-hidden">Próximo</span>
                    </button>
                </div>
            <?php else: ?>
                <p class="text-white">Nenhum jogo de ação para exibir no momento.</p>
            <?php endif; ?>
        </section>

        <section class="carousel-section mb-5">
            <h2 class="text-white mb-3">FPS</h2>

            <?php if (!empty($jogosFPS)): ?>
                <div id="carouselFPS" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        $itemsPerSlide = 4;
                        $totalSlides = ceil(count($jogosFPS) / $itemsPerSlide);

                        for ($slide = 0; $slide < $totalSlides; $slide++):
                            $activeClass = ($slide === 0) ? 'active' : '';
                        ?>
                            <div class="carousel-item <?= $activeClass ?>">
                                <div class="row">
                                    <?php
                                    $startIndex = $slide * $itemsPerSlide;
                                    $endIndex = min(($slide + 1) * $itemsPerSlide, count($jogosFPS));

                                    for ($i = $startIndex; $i < $endIndex; $i++):
                                        $jogo = $jogosFPS[$i];
                                        $caminhoImagemDoBanco = $jogo['imagem'] ?? null;
                                        $imagemParaExibir = null;
                                        if (!empty($jogo['imagem'])) {
                                            $imagemParaExibir = $imgPathPrefix . $caminhoImagemDoBanco;
                                        }
                                    ?>
                                        <div class="col-md-3">
                                            <div class="game-card"
                                                data-game-id="<?= intval($jogo['id_jogo'] ?? 0) ?>"
                                                data-game-name="<?= htmlspecialchars($jogo['nome'] ?? 'Jogo', ENT_QUOTES, 'UTF-8') ?>"
                                                data-game-price="R$<?= number_format(floatval($jogo['preco'] ?? 0), 2, ',', '.') ?>"
                                                data-game-image="<?= htmlspecialchars($imagemParaExibir, ENT_QUOTES, 'UTF-8') ?>"
                                                data-game-category="<?= htmlspecialchars($jogo['categoria'] ?? 'N/A', ENT_QUOTES, 'UTF-8') ?>">
                                                <img src="<?= htmlspecialchars($imagemParaExibir) ?>" class="img-fluid game-image" alt="<?= htmlspecialchars($jogo['nome'] ?? 'Jogo', ENT_QUOTES, 'UTF-8') ?>">
                                                <div class="game-info">
                                                    <p class="game-title text-white"><?= htmlspecialchars($jogo['nome'] ?? 'Jogo', ENT_QUOTES, 'UTF-8') ?></p>
                                                    <p class="game-price text-success">R$<?= number_format(floatval($jogo['preco'] ?? 0), 2, ',', '.') ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselFPS" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselFPS" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Próximo</span>
                    </button>
                </div>
            <?php else: ?>
                <p class="text-white">Nenhum jogo de FPS para exibir no momento.</p>
            <?php endif; ?>
        </section>
    </main>


    <div class="modal fade" id="gameModal" tabindex="-1" aria-labelledby="gameModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header border-bottom border-secondary">
                    <h5 class="modal-title" id="modalTitle">Título do Jogo</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="Imagem do Jogo" class="img-fluid mb-3" style="max-height: 200px;">
                    <p id="modalPrice" class="fs-5 text-success">Preço: R$ 0,00</p>
                    <p id="modalDetails" class="text-light">Detalhes do jogo serão exibidos aqui.</p>
                </div>
                <div class="modal-footer border-top border-secondary">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-success" id="addToCartButton" onclick="addToCart()">Colocar no Carrinho</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <script src="/assets/js/scriptLoja.js" defer></script>

    <?php include_once __DIR__ . '/../partials/footer.php'; ?>