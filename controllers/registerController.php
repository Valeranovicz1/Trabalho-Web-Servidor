<?php

namespace App\Controllers;

use App\Model\Conexao;
use App\Model\Cliente;
use Exception;

class RegisterController
{

    private $db;

    public function __construct()
    {

        $this->db = Conexao::get();
    }

    public function register()
    {

        $cliente = new Cliente($this->db);
        $cliente->nome = trim($_POST['nome'] ?? '');
        $cliente->email = trim($_POST['email'] ?? '');
        $cliente->nickname = trim($_POST['nickname'] ?? '');
        $cliente->senha = trim($_POST['senha'] ?? '');
        $cliente->setDataNascimento(trim($_POST['data_nascimento'] ?? ''));
        $cliente->tipoUsuario = 'cliente';
        $cliente->fotoPerfil = null;


        $resultado = $cliente->registrarCliente();


        if ($resultado === true) {
            header('Location: ../../view/login/Login.php');
            exit;
        } else {
            header('Location: ../../view/login/Registro.php?');
            exit;
        }
    }
}
