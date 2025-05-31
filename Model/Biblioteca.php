<?php

namespace App\Model;


use Exception;

class Biblioteca
{

    private $idUsuario;
    private $idJogo;

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

    public function adicionarJogo()
    {

        $sql = "INSERT INTO biblioteca (id_usuario, id_jogo) VALUES (:id_usuario, :id_jogo)";

        try {

            $st = $this->conexao->prepare($sql);
            $st->bindParam(':id_usuario', $this->idUsuario);
            $st->bindParam(':id_jogo', $this->idJogo);

            if ($st->execute()) {
                return true;
            }

            error_log("Erro ao adicionar jogo. Tente Novamente.");
            return false;
        } catch (Exception $e) {

            error_log("Exceção ao adicionar jogo a biblioteca: " . $e->getMessage());
            return false;
        }
    }

    public function finalizarCompra($jogosCarrinho, $idUsuario)
    {

        if (empty($jogosCarrinho)) {
            error_log("Carrinho vazio. Adicione algum jogo e tente Novamente.");
            return true;
        }

        $this->idUsuario = $idUsuario;

        try {
            $this->conexao->beginTransaction();

            foreach ($jogosCarrinho as $jogo) {

                $this->idJogo = $jogo;

                if (!$this->adicionarJogo()) {
                    error_log("Erro ao adicionar jogo.");
                    return false;
                }
            }

            $this->conexao->commit();
        } catch (Exception $e) {
            if ($this->conexao->inTransaction()) {
                $this->conexao->rollBack();
            }
            error_log("Erro ao finalizar compra : " . $e->getMessage());
            return false;
        }

        return true;
    }
}
