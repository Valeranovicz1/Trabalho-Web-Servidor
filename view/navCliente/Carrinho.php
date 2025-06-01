<?php
include_once __DIR__ . '/../partials/header.php';
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Carrinho - ET Games</title>
    <link rel="stylesheet" href="/assets/css/style-painel.css">
    <link rel="icon" href="/assets/img/logo/logo.png" type="image/png">
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
        }
        main.container {
            background-color: #1e1e1e;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }
        .cart-item {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #333;
            padding: 15px 0;
            color: white;
        }
        .cart-item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-right: 20px;
            border-radius: 5px;
            border: 1px solid #00ff00;
        }
        .cart-item-details {
            flex-grow: 1;
        }
        .cart-item-details h5 {
            margin-bottom: 5px;
            color: #00ff00;
        }
        .cart-item-details p.text-muted {
            font-size: 0.9em;
            color: #aaa !important;
        }
        .cart-item-price {
            font-weight: bold;
            color: #28a745;
            font-size: 1.1em;
            min-width: 120px;
            text-align: right;
            margin-right: 10px;
        }
        .cart-total {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #444;
            text-align: right;
            font-size: 1.3em;
            color: white;
        }
        .cart-total strong {
            color: #28a745;
        }
        .btn-checkout,
        .btn-remove-item {
            color: white;
        }
        .empty-cart-message {
            text-align: center;
            padding: 60px 0;
            color: #ccc;
        }
        .btn-remove-item {
            background-color: #dc3545;
            border-color: #dc3545;
            color: white;
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            line-height: 1.5;
            border-radius: 0.2rem;
        }
        .btn-remove-item:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
        .btn-checkout {
            background-color: #00ff00;
            color: #121212;
            border: none;
            font-weight: bold;
        }
        .btn-checkout:hover {
            background-color: #00cc00;
        }
        .btn-continue {
            background-color: #00ff00;
            color: #121212;
            border: none;
            font-weight: bold;
            position: relative;
            top: -105px;
            right: -300px;
            z-index: 10;
        }
        .btn-continue:hover {
            background-color: #00cc00;
        }
        h1.page-title {
            color: #00ff00;
            text-shadow: 0 0 5px #00ff00;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <main class="container mt-5">
        <h1 class="page-title mb-4">Seu Carrinho</h1>
        <?php if (isset($_SESSION['mensagem_sucesso'])): ?>
            <div class="alert alert-success" role="alert">
                <?= htmlspecialchars($_SESSION['mensagem_sucesso']); ?>
            </div>
            <?php unset($_SESSION['mensagem_sucesso']); ?>
        <?php endif; ?>
        <?php if (isset($_SESSION['mensagem_info'])): ?>
            <div class="alert alert-info" role="alert">
                <?= htmlspecialchars($_SESSION['mensagem_info']); ?>
            </div>
            <?php unset($_SESSION['mensagem_info']); ?>
        <?php endif; ?>
        <?php if (isset($_SESSION['mensagem_erro'])): ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($_SESSION['mensagem_erro']); ?>
            </div>
            <?php unset($_SESSION['mensagem_erro']); ?>
        <?php endif; ?>
        <div class="cart-items">
            <?php if (!empty($cartItems)): ?>
                <?php foreach ($cartItems as $item): ?>
                    <div class="cart-item">
                        <img
                            src="<?= htmlspecialchars($item['imagem'] ?? '/assets/img/placeholder.png') ?>"
                            alt="Capa do <?= htmlspecialchars($item['nome'] ?? 'Jogo') ?>"
                        >
                        <div class="cart-item-details">
                            <h5><?= htmlspecialchars($item['nome'] ?? 'Nome Indisponível') ?></h5>
                            <p class="text-muted">Categoria: <?= htmlspecialchars($item['categoria'] ?? 'N/A') ?></p>
                        </div>
                        <p class="cart-item-price">
                            R$ <?= number_format(floatval($item['preco'] ?? 0), 2, ',', '.') ?>
                        </p>
                        <form action="/api/carrinho/remover" method="POST" style="margin-left: 15px;">
                            <input type="hidden" name="game_id_remove" value="<?= htmlspecialchars($item['id_jogo'] ?? 0) ?>">
                            <button type="submit" class="btn btn-sm btn-remove-item" title="Remover item">&times;</button>
                        </form>
                    </div>
                <?php endforeach; ?>
                <div class="cart-total">
                    <p>
                        Total:
                        <strong class="text-success">
                            R$ <?= number_format($totalCarrinho ?? 0, 2, ',', '.') ?>
                        </strong>
                    </p>
                    <?php if (($totalCarrinho ?? 0) > 0): ?>
                        <form action="/carrinho/finalizar" method="POST">
                            <button type="submit" class="btn btn-checkout btn-lg">Finalizar Compra</button>
                            <div class="empty-cart-message">
                                <a href="/loja" class="btn btn-continue btn-lg">Continuar Comprando</a>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="empty-cart-message">
                    <p class="fs-4">Seu carrinho está vazio.</p>
                    <a href="/loja" class="btn btn-success">Continuar Comprando</a>
                </div>
            <?php endif; ?>
        </div>
    </main>
    <?php include_once __DIR__ . '/../partials/footer.php'; ?>
</body>
