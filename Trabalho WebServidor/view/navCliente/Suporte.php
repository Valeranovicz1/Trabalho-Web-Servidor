<?php

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] !== 'cliente') {
        header('Location: ../view/login/login.php?erro=acesso_negado');
        exit;
    }

    $nome = $_SESSION['usuario']['nome'] ?? 'Não definido';
    $email = $_SESSION['usuario']['email'] ?? 'Não definido';

// Processa o envio do suporte
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mensagem = trim($_POST['mensagem'] ?? '');

    if ($mensagem !== '') {
        $arquivoSuportes = '../../storage/suportes.php';   

        if (file_exists($arquivoSuportes)) {
            $suportes = include $arquivoSuportes;
            if (!is_array($suportes)) {
                $suportes = [];
            }
        } else {
            $suportes = [];
        }

        $suportes[] = [
            'nome' => $nome,
            'email' => $email,
            'mensagem' => $mensagem,
            'data' => date('Y-m-d H:i:s'),
        ];

        file_put_contents($arquivoSuportes, "<?php\nreturn " . var_export($suportes, true) . ";");

        echo "<script>
                alert('Mensagem enviada com sucesso!');
              </script>";
    }
}


include '../partials/header.php'; 
?>

<div class="suporte-container">
    <h1>Suporte ao Comprador</h1>

    <?php if (isset($_GET['sucesso'])): ?>
        <div class="alert alert-success">
            Mensagem enviada com sucesso!
        </div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="mensagem">Mensagem:</label>
            <textarea id="mensagem" name="mensagem" maxlength="500" placeholder="Escreva sua mensagem (máx. 500 caracteres)" required></textarea>
        </div>
        <button type="submit" class="btn-submit">Enviar</button>
    </form>
</div>

<?php include '../partials/footer.php'; ?>
