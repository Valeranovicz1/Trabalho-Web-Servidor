<?php

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] !== 'cliente') {
        header('Location: /view/login/login.php?erro=acesso_negado');
        exit;
    }

    include_once __DIR__ . '/../partials/header.php'; 
?>


    <main>
        <h1>Seu Carrinho</h1>
        <div class="cart-items">
            <?php if (!empty($cartItems)): ?>
                <?php foreach ($cartItems as $item): ?>
                    <div class="cart-item">
                        <img src="<?= htmlspecialchars($item['foto']) ?>" alt="<?= htmlspecialchars($item['nome']) ?>">
                        <p><?= htmlspecialchars($item['nome']) ?></p>
                        <p>R$ <?= htmlspecialchars($item['preco']) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Seu carrinho está vazio.</p>
            <?php endif; ?>
        </div>
    </main>
    
    <?php include_once __DIR__ . '/../partials/footer.php'; ?>