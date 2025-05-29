<?php

namespace App\Model;

use Exception;

class Suporte
{

    private $idSuporte;
    private $idUsuario;
    private $mensagem;

    public function __get($propriedade)
    {

        return $this->$propriedade;
    }

    public function __set($propriedade, $valor)
    {

        $this->$propriedade = $valor;
    }

    public function __construct($db)
    {
        $this->conexao = $db;
    }

    public function enviarMensagem()
    {

        if (empty($this->mensagem)) {
            error_log("Campos Obrigatórios Vazios.");
            return false;
        }

        $sql = "INSERT INTO suporte (id_usuario, mensagem) VALUES (:id_usuario, :mensagem)";

        try {

            $st = $this->conexao->prepare($sql);
            $st->bindParam(':id_usuario', $this->idUsuario);
            $st->bindParam(':mensagem', $this->mensagem);
            if ($st->execute()) {
                $this->idSuporte = $this->conexao->lastInsertId();
                return true;
            }
            $errorInfo = $st->errorInfo();
            error_log("Erro ao enviar mensagem. Tente Novamente.");
            return false;
        } catch (Exception $e) {
            error_log("Erro ao enviar mensagem: " . $e->getMessage());
            return false;
        }
    }
}
