<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/Trabalho WebServidor/controllers/LoginController.php';
require_once __DIR__ . '/Trabalho WebServidor/controllers/JogoController.php';
require_once __DIR__ . '/Trabalho WebServidor/controllers/RegisterController.php';

use Pecee\SimpleRouter\SimpleRouter;

define('BASE_URL', '/Trabalho WebServidor');

SimpleRouter::get('/', function () {
    require_once __DIR__ . '/Trabalho WebServidor/view/login/Login.php';
});

SimpleRouter::post('/', ['LoginController', 'login']);

SimpleRouter::get('/registro', function() {
    require_once __DIR__ . '/Trabalho WebServidor/view/login/Registro.php';
});
SimpleRouter::post('/registro', ['RegisterController','register']);

SimpleRouter::get('/painel/painelCliente.php', function() {
    require_once __DIR__ . '/Trabalho WebServidor/view/painel/painelCliente.php';
});
SimpleRouter::get('/painel/painelEmpresa.php', function() {
    require_once __DIR__ . '/Trabalho WebServidor/view/painel/painelEmpresa.php';
});
SimpleRouter::get('/Trabalho WebServidor/loja', function() {
    require_once __DIR__ . '/Trabalho WebServidor/view/painel/painelCliente.php';
});


SimpleRouter::get('/Trabalho WebServidor/biblioteca', function() {
    require_once __DIR__ . '/Trabalho WebServidor/view/navCliente/biblioteca.php';
});


SimpleRouter::get('/Trabalho WebServidor/carrinho', function() {
    require_once __DIR__ . '/Trabalho WebServidor/view/navCliente/Carrinho.php';
});


SimpleRouter::get('/Trabalho WebServidor/suporte', function() {
    require_once __DIR__ . '/Trabalho WebServidor/view/navCliente/Suporte.php';
});


SimpleRouter::get('/Trabalho WebServidor/sobre', function() {
    require_once __DIR__ . '/Trabalho WebServidor/view/navCliente/Sobre.php';
});


SimpleRouter::get('Trabalho WebServidor/minha-conta', function() {
    require_once __DIR__ . '/Trabalho WebServidor/view/navCliente/MinhaConta.php';
});


SimpleRouter::get('Trabalho WebServidor/logout', function() {
    session_start();
    session_destroy();
    header('Location: /');
    exit;
});


SimpleRouter::match(['get','post'], '/Trabalho WebServidor/painel/painelEmpresa.php/    ', function() {
    require_once __DIR__ . '/Trabalho WebServidor/view/painel/painelEmpresa.php';
});


SimpleRouter::start();
