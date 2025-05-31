<?php

namespace App\Model;

use Exception;
use pdo;

class Jogo
{

    private $id_jogo;
    private $nome;
    private $descricao;
    private $categoria;
    private $foto;
    private $preco;
    private $classificacao;
    private $idEmpresa;

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

        if (empty($this->nome) || empty($this->descricao) || $this->preco === null || !is_numeric($this->preco) || $this->preco < 0 || empty($this->idEmpresa)) {
            error_log("Campos Obrigatórios Vazios.");
            return false;
        }

        $sql = "INSERT INTO jogos (nome, descricao, categoria, imagem, preco, classificacao, id_empresa) VALUES (:nome, :descricao, :categoria, :foto, :preco, :classificacao, :id_empresa)";

        try {
            $st = $this->conexao->prepare($sql);
            $st->bindParam(':nome', $this->nome);
            $st->bindParam(':descricao', $this->descricao);
            $st->bindParam(':categoria', $this->categoria);
            $st->bindParam(':foto', $this->foto);
            $st->bindParam(':preco', $this->preco);
            $st->bindParam(':classificacao', $this->classificacao);
            $st->bindParam(':id_empresa', $this->idEmpresa);
            if ($st->execute()) {
                $this->id_jogo = $this->conexao->lastInsertId();
                return true;
            }

            error_log("Erro ao adicionar jogo. Tente Novamente.");
            return false;
        } catch (Exception $e) {
            error_log("Erro ao adicionar jogo: " . $e->getMessage());
            return false;
        }
    }

    public function listarJogosDaEmpresa($idEmpresa)
    {

        $sql = "SELECT nome, descricao, categoria, preco, classificacao FROM jogos WHERE id_empresa = :idEmpresa ORDER BY nome ASC";

        try {

            $st = $this->conexao->prepare($sql);
            $st->bindParam(':idEmpresa', $idEmpresa);
            $st->execute();
            return $st->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Erro ao listar jogos da empresa: " . $e->getMessage());
            return [];
        }
    }

    public function listarJogosCategoria($categoria)
    {

        $sql = "SELECT id_jogo,nome,descricao,categoria, imagem, preco, classificacao FROM jogos WHERE categoria = :categoria";

        try {

            $st = $this->conexao->prepare($sql);
            $st->bindParam(':categoria', $categoria);
            $st->execute();
            return $st->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Erro ao listar jogos por categoria: " . $e->getMessage());
            return [];
        }
    }


    public function listarJogosBiblioteca($idUsuario)
    {

        $sql = "SELECT j.nome, j.descricao, j.categoria, j.imagem, j.classificacao FROM jogos j INNER JOIN biblioteca b ON j.id_jogo = b.id_jogo WHERE b.id_usuario = :id_usuario ORDER BY j.nome ASC";

        try {

            $st = $this->conexao->prepare($sql);
            $st->bindParam(':id_usuario', $idUsuario);
            $st->execute();
            return $st->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Erro ao listar jogos mais vendidos: " . $e->getMessage());
            return [];
        }
    }

    public function listarJogosCategoriaBiblioteca($categoria, $idUsuario)
    {

        $sql = "SELECT j.nome, j.descricao, j.categoria, j.imagem, j.classificacao FROM jogos j INNER JOIN biblioteca b ON j.id_jogo = b.id_jogo WHERE b.id_usuario = :id_usuario AND j.categoria = :categoria ORDER BY j.nome ASC";

        try {

            $st = $this->conexao->prepare($sql);
            $st->bindParam(':id_usuario', $idUsuario);
            $st->bindParam(':categoria', $categoria);
            $st->execute();
            return $st->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Erro ao listar jogos por categoria: " . $e->getMessage());
            return [];
        }
    }

    public function excluirJogo($nomeJogo, $idEmpresa)
    {

        $sql = "DELETE FROM jogos WHERE nome = :nome AND id_empresa = :id_empresa";

        try {
            $st = $this->conexao->prepare($sql);
            $st->bindParam(':nome', $nomeJogo);
            $st->bindParam(':id_empresa', $idEmpresa);

            if ($st->execute()) {
                if ($st->rowCount() > 0) {
                    return true;
                } else {

                    error_log("Nenhum jogo encontrado. Tente Novamente.");
                    return false;
                }
            } else {
                $errorInfo = $st->errorInfo();
                error_log("Erro ao excluir jogo.");
                return false;
            }
        } catch (Exception $e) {
            error_log("Erro ao excluir jogo da empresa: " . $e->getMessage());
            return false;
        }
    }
}
