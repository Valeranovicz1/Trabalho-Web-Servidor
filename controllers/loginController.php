<?php

namespace App\Controllers;
use App\Model\Conexao;

use Exception;
use App\Model\Usuario;


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class LoginController
{

    private $db;

    public function __construct()
    {

        $this->db = Conexao::get();
    }

    public function login()
    {

        $nickname = trim($_POST['nickname'] ?? '');
        $senha = $_POST['senha'] ?? '';

        if (empty($nickname) || empty($senha)) {

            header('Location: ../../view/login/Login.php?erro=campos_vazios');
            exit;
        }

        $resultado = Usuario::logar($this->db, $nickname, $senha);

        if ($resultado['success']) {
            $usuario = $resultado['data'];

            session_regenerate_id(true);

            $_SESSION['usuario'] = [
                'id' => $usuario['id'],
                'nome' => $usuario['nome'],
                'nickname' => $usuario['nickname'],
                'email' => $usuario['email'],
                'tipo' => $usuario['tipo_usuario']
            ];

            if ($usuario['tipo_usuario'] === 'empresa') {
                header('Location: /painelEmpresa');
            } elseif ($usuario['tipo_usuario'] === 'cliente') {
                header('Location: /loja');  
            } else {
                session_destroy();
                header('Location: /');
            }
            exit;
        } else {

            $codigoErro = $resultadoAutenticacao['error'] ?? 'login_falhou';
            header('Location:../../view/login/Login.php?erro=erro_login' . urlencode($codigoErro));
            exit;
        }
    }

    public function logout()
    {

        if (isset($_COOKIE['user_token'])) {
            setcookie('user_token', '', time() - 3600, '/', '', isset($_SERVER['HTTPS']), true);
        }

        session_start();
        $_SESSION = [];
        session_destroy();

        header("Location: view/login/login.php");
        exit;
    }
}
