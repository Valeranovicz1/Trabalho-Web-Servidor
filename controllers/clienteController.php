<?php

    require_once __DIR__ . '/../Model/Conexao.php';
    require_once __DIR__ . '/../Model/Usuario.php';
    require_once __DIR__ . '/../Model/Cliente.php';

    class ClienteController{

        private $db;

        public function __construct() {
            $this->db = Conexao::get();
        }

        public function editarPerfil(){

            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
             return; 
        }

            $cliente = new Cliente($this->db);

            $cliente->id = $_SESSION['usuario']['id'];
            $cliente->nome = trim($_POST['nome'] ?? '');
            $cliente->email = trim($_POST['email'] ?? '');
            $cliente->nickname = trim($_POST['nickname'] ?? '');
            $cliente->setDataNascimento(trim($_POST['dataNascimento'] ?? ''));
            
            if ($cliente->editarPerfil()) {
                $_SESSION['mensagem_sucesso'] = "Perfil editado com sucesso!";
                $_SESSION['usuario']['nome'] = $cliente->nome;
                $_SESSION['usuario']['email'] = $cliente->email;
                $_SESSION['usuario']['nickname'] = $cliente->nickname;
                $_SESSION['usuario']['data_nascimento'] = $cliente->getDataNascimento();
            } else {
                $_SESSION['mensagem_erro'] = "Erro ao editar perfil. Verifique os dados e tente novamente.";
            }
            header('Location: /minha-conta');
            exit;
        }
    }

?>