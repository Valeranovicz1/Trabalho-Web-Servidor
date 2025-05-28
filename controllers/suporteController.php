<?php

    require_once __DIR__ . '/../Model/Conexao.php'; 
    require_once __DIR__ . '/../Model/Suporte.php';

    class SuporteController{

        private $db;

        public function __construct() {
            $this->db = Conexao::get();
        }

        public function enviarMensagem(){

            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

                return; 
            }

            $suporte = new Suporte($this->db);

            $suporte->idUsuario = $_SESSION['usuario']['id'];
            $suporte->mensagem = trim($_POST['mensagem'] ?? '');

            if ($suporte->enviarMensagem()) {
                $_SESSION['mensagem_sucesso'] = "Mensagem enviada com sucesso!";
            } else {
                $_SESSION['mensagem_erro'] = "Erro ao enviar Mensagem! Verifique os dados e tente novamente.";
            }
            header('Location: /suporte');
            exit;

        }
    }


?>