<?php

namespace App\Controllers;

class UsuarioController
{

    public function visualizarPerfil()
    {
        session_start();

        if (!isset($_SESSION['usuario'])) {
            header("Location: /views/login/login.php");
            exit;
        }

        $usuario = $_SESSION['usuario'];
        include __DIR__ . '/../views/perfil/perfil.php';
    }

    public function editarPerfil()
    {
        session_start();

        if (!isset($_SESSION['usuario'])) {
            header("Location: /views/login/login.php");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome']);
            $email = trim($_POST['email']);
            $data_nascimento = $_POST['data_nascimento'];

            $_SESSION['usuario']['nome'] = $nome;
            $_SESSION['usuario']['email'] = $email;
            $_SESSION['usuario']['data_nascimento'] = $data_nascimento;

            header('Location: /index.php?action=visualizarPerfil&sucesso=1');
            exit;
        }
    }
}
