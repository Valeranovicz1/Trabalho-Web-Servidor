
<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/controllers/LoginController.php';
require_once __DIR__ . '/controllers/JogoController.php';
require_once __DIR__ . '/controllers/RegisterController.php';
require_once __DIR__ . '/controllers/BibliotecaController.php';
require_once __DIR__ . '/controllers/SuporteController.php';
require_once __DIR__ . '/controllers/ClienteController.php';


use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::get('/', function () {
    require_once __DIR__ . '/view/login/Login.php';
});

SimpleRouter::post('/', ['LoginController', 'login']);

SimpleRouter::get('/registro', function() {
    require_once __DIR__ . '/view/login/Registro.php';
});

SimpleRouter::post('/registro', ['RegisterController','register']);


SimpleRouter::get('/loja', function() {

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['usuario']) || !isset($_SESSION['usuario']['tipo']) || $_SESSION['usuario']['tipo'] !== 'cliente') {

        header('Location: /?erro=acesso-negado');
        exit;
    }

    $imgPathPrefix = '../../';

    $jogoController = new JogoController();

    $jogosAcao = $jogoController->listaJogosCategoria('Ação');
    $jogosFPS = $jogoController->listaJogosCategoria('FPS');

    require_once __DIR__ . '/view/painel/painelCliente.php';
});



SimpleRouter::match(['get','post'], '/painel/painelEmpresa.php', function() {
    require_once __DIR__ . '/view/painel/painelEmpresa.php';
});



SimpleRouter::get('/biblioteca', function() {
    require_once __DIR__ . '/view/navCliente/biblioteca.php';
});


SimpleRouter::get('/carrinho', function() {
    require_once __DIR__ . 'view/navCliente/Carrinho.php';
});


SimpleRouter::get('/suporte', function() {
    require_once __DIR__ . '/view/navCliente/Suporte.php';
});


SimpleRouter::get('/sobre', function() {
    require_once __DIR__ . '/view/navCliente/Sobre.php';
});

SimpleRouter::post('/suporte', ['SuporteController','enviarMensagem']);

SimpleRouter::get('/minha-conta', function() {
    require_once __DIR__ . '/view/navCliente/MinhaConta.php';
});

SimpleRouter::get('/editar-conta', function() {
    require_once __DIR__ . '/view/navCliente/EditarConta.php';
});

SimpleRouter::post('/editar-conta', ['ClienteController','editarPerfil']);

SimpleRouter::get('/logout', function() {
    session_start();
    session_destroy();
    header('Location: /');
    exit;
});


SimpleRouter::match(['get','post'], '/painel/painelEmpresa', function() {
    require_once __DIR__ . '/view/painel/painelEmpresa.php';
});


SimpleRouter::start();
