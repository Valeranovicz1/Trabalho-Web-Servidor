<?php  
    
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] !== 'cliente') {
    header('Location: /view/login/login.php?erro=acesso_negado');
    exit;
    }

    include '../partials/header.php'; 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ET Games</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="img/logo/logo.png" type="image/png">
</head>

<body>

    <main>
        <section class="carousel-section">
            <h2>MAIS VENDIDOS</h2>
            <div class="carousel-container">
                <button class="carousel-btn prev-btn">&lt;</button>
                <div class="carousel">
                    <div class="carousel-item" onclick="openGameDetails('The Last of Us II', 'R$199,99', '../../assets/img/jogos/jogo1.avif','Ação e Aventura')">
                        <img src="../../assets/img/jogos/jogo1.avif" alt="Game 1">
                        <p>The Last of Us II</p>
                        <p>R$199,99</p>
                    </div>
                    <div class="carousel-item" onclick="openGameDetails('God of War Ragnarok', 'R$159,99', '../../assets/img/jogos/jogo2.jpg')">
                        <img src="../../assets/img/jogos/jogo2.jpg" alt="Game 2">
                        <p>God of War Ragnarok</p>
                        <p>R$159,99</p>
                    </div>
                    <div class="carousel-item" onclick="openGameDetails('Counter-Strike 2', 'R$39,99', '../../assets/img/jogos/jogo3.jpg')">
                        <img src="../../assets/img/jogos/jogo3.jpg" alt="Game 3">
                        <p>Counter-Strike 2</p>
                        <p>R$39,99</p>
                    </div>
                    <div class="carousel-item" onclick="openGameDetails('Minecraft', 'R$29,99', '../../assets/img/jogos/jogo4.avif')">
                        <img src="../../assets/img/jogos/jogo4.avif" alt="Game 4">
                        <p>Minecraft</p>
                        <p>R$29,99</p>
                    </div>
                    <div class="carousel-item" onclick="openGameDetails('Grand Theft Auto VI', 'R$499,99', '../../assets/img/jogos/jogo5.jpg')">
                        <img src="../../assets/img/jogos/jogo5.jpg" alt="Game 5">
                        <p>Grand Theft Auto VI</p>
                        <p>R$499,99</p>
                    </div>
                    <div class="carousel-item" onclick="openGameDetails('Resident Evil 4', 'R$69,99', '../../assets/img/jogos/jogo6.avif')">
                        <img src="../../assets/img/jogos/jogo6.avif" alt="Game 6">
                        <p>Resident Evil 4</p>
                        <p>R$69,99</p>
                    </div>
                    <div class="carousel-item" onclick="openGameDetails('It Takes Two', 'R$79,99', '../../assets/img/jogos/jogo7.webp')">
                        <img src="../../assets/img/jogos/jogo7.webp" alt="Game 7">
                        <p>It Takes Two</p>
                        <p>R$79,99</p>
                    </div>
                </div>
            <button class="carousel-btn next-btn">&gt;</button>
                </div>
            </section>

        <section class="carousel-section">
            <h2>AÇÃO</h2>
            <div class="carousel-container">
                <button class="carousel-btn prev-btn">&lt;</button>
                <div class="carousel">
                    <div class="carousel-item">
                        <img src="../../assets/img/jogos/jogo5.jpg" alt="Game 5">
                        <p>Grand Theft Auto VI</p>
                        <p>R$499,99</p>
                    </div>
                    <div class="carousel-item">
                        <img src="../../assets/img/jogos/jogo6.avif" alt="Game 6">
                        <p>Resident Evil 4</p>
                        <p>R$69,99</p>
                    </div>
                    <div class="carousel-item">
                        <img src="../../assets/img/jogos/jogo7.webp" alt="Game 7">
                        <p>It Takes Two</p>
                        <p>R$79,99</p>
                    </div>
                    <div class="carousel-item">
                        <img src="../../assets/img/jogos/jogo1.avif" alt="Game 1">
                        <p>The Last of Us II</p>
                        <p>R$199,99</p>
                    </div>
                </div>
        <button class="carousel-btn next-btn">&gt;</button>
                <button class="carousel-btn next-btn">&gt;</button>
            </div>
        </section>

        <section class="carousel-section">
            <h2>LANÇAMENTOS</h2>
            <div class="carousel-container">
                <button class="carousel-btn prev-btn">&lt;</button>
                <div class="carousel">
                    <div class="carousel-item">
                        <img src="../../assets/img/jogos/jogo2.jpg" alt="Game 2">
                        <p>God of War Ragnarok</p>
                        <p>R$159,99</p>
                    </div>
                    <div class="carousel-item">
                        <img src="../../assets/img/jogos/jogo3.jpg" alt="Game 3">
                        <p>Counter-Strike 2</p>
                        <p>R$39,99</p>
                    </div>
                    <div class="carousel-item">
                        <img src="../../assets/img/jogos/jogo4.avif" alt="Game 4">
                        <p>Minecraft</p>
                        <p>R$29,99</p>
                    </div>
                    <div class="carousel-item">
                        <img src="../../assets/img/jogos/jogo5.jpg" alt="Game 5">
                        <p>Grand Theft Auto VI</p>
                        <p>R$499,99</p>

                    </div>
                </div>
                <button class="carousel-btn next-btn">&gt;</button>
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

<script src="../../assets/js/scriptLoja.js" defer></script>

<?php include '../partials/footer.php';?>