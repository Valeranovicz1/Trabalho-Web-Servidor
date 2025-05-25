<?php

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] !== 'cliente') {
        header('Location: ../view/login/login.php?erro=acesso_negado');
        exit;
    }

    include '../partials/header.php';
?>

<style>
        .game-filter-section {
            margin-top: 20px;
            padding: 15px;
            background-color: #1e1e1e;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 20px;
        }

        .game-filter-section label {
            color: #00ff00;
            margin-right: 10px;
        }

        .game-filter-section select {
            padding: 8px;
            border: 1px solid #333;
            border-radius: 4px;
            background-color: #2a2a2a;
            color: #c7d5e0;
        }

        .game-filter-section input[type="submit"] {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            background-color: #00ff00;
            color: #121212;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .game-filter-section input[type="submit"]:hover {
            background-color: #00cc00;
        }

        .game-grid-section {
            padding: 20px;
            background-color: #1e1e1e;
            border-radius: 8px;
        }

        .game-grid-section h2 {
            color: #00ff00;
            margin-bottom: 15px;
            text-align: center;
        }

        .game-grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
        }

        .game-item {
            background-color: #2a2a2a;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
        }

        .game-image {
            width: 40%;
            height: auto;
        }

        .game-image img {
            display: block;
            width: 100%;
            height: auto;
            aspect-ratio: 1 / 1;
            object-fit: cover;
        }

        .game-title {
            padding: 10px;
            text-align: center;
            color: #c7d5e0;
        }

        .game-title p {
            margin: 0;
            font-size: 1em;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
    </style>

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
        <div class="game-grid-container">
            

        </div>
    </section>
</main>

<?php include '../partials/footer.php'; ?>
