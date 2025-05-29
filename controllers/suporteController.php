<?php

namespace App\Controllers;

use App\Model\Conexao;
use App\Model\Suporte;

class SuporteController
{

    private $db;

    public function __construct()
    {
        $this->db = Conexao::get();
    }

    public function enviarMensagem()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
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
