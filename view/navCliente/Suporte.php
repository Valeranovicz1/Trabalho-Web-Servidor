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

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - ET Games</title>
    <link rel="icon" href="../../assets/img/logo/logo.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <style>
        body {
            background-color: #121212;
        }
    </style>
</head>

<body>
    <div class="suporte-container">
    <h1 class="text-success">Suporte ao Comprador</h1>

        <?php if (isset($_GET['sucesso'])): ?>
            <div class="alert alert-success">
                Mensagem enviada com sucesso!
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="form-group">
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Nome</label>
                    <div class="col-sm-10">
                        <input type="text" id="nome" name="nome" readonly value="<?php echo htmlspecialchars($nome); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" id="email" name="email" readonly value="<?php echo htmlspecialchars($email); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Mensagem</label>
                            <textarea id="mensagem" name="mensagem" maxlength="500" placeholder="Escreva sua mensagem (máx. 500 caracteres)" required></textarea>
                        </div>
                        <div class="text-center">
                        <button type="submit" class="btn btn-outline-success btn-lg">Enviar</button>
                        </div>
        </form>
    </div>
</body>

<?php include '../partials/footer.php'; ?>