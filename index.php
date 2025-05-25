<?php

require_once __DIR__ . '/controllers/loginController.php';
require_once __DIR__ . '/controllers/registerController.php';
require_once __DIR__ . '/controllers/JogoController.php';

$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'login':
        $loginController = new LoginController();
        $loginController->login();
        break;
    case 'logout':
        $loginController = new LoginController();
        $loginController->logout();
        break;
    case 'register':
        $registerController = new RegisterController();
        $registerController->register();
        break;
    case 'visualizarPerfil':
        $usuarioController = new UsuarioController();
        $usuarioController->visualizarPerfil();
        break;
    case 'editarPerfil':
        $usuarioController = new UsuarioController();
        $usuarioController->editarPerfil();
        break;
    case 'criarJogo':
        $JogoController = new JogoController();
        $JogoController->criarJogo();
        break;
    case 'listarJogos':
        $JogoController = new JogoController();
        $JogoController->listarJogos();
        break;
    case 'deletarJogo':
        $JogoController = new JogoController();
        $JogoController->excluirJogoPorNome($_GET['id'] ?? null);
        break;
    case 'enviarSuporte':
    $controller = new SuporteController();
    $controller->enviarMensagem();
    break;
    default:
        header('Location: /views/auth/login.php');
        break;
}