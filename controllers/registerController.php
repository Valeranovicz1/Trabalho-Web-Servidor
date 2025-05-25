<?php

    require_once __DIR__ . '/../Model/Conexao.php';
    require_once __DIR__ . '/../Model/Usuario.php';
    require_once __DIR__ . '/../Model/Cliente.php';
    

    class RegisterController {
    
    private $db;

    public function __construct() { 

        $this->db = Conexao::get();
    }

    public function register() {
        
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
            header('Location: /');
            exit;
        } else {
            header('Location: /Trabalho-Web-Servidor/registro');
            exit;
        }
    }
}
?>