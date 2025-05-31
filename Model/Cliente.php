<?php

namespace App\Model;

use Exception;


class Cliente extends Usuario
{

    private $dataNascimento;

    public function __construct($conexaoDb)
    {

        $this->conexao = $conexaoDb;
        $this->tipoUsuario = 'cliente';
    }

    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    public function setDataNascimento($data)
    {
        $this->dataNascimento = $data;
    }

    public function registrarCliente()
    {

        if (empty($this->nome) || empty($this->email) ||  empty($this->nickname) ||  empty($this->senha) || empty($this->dataNascimento)) {
            return false;
        }

        try {


            $this->conexao->beginTransaction();

            $sql = "INSERT INTO usuarios (nome, email, senha, nickname,tipo_usuario) VALUES (:nome, :email, :senha, :nickname, :tipoUsuario)";

            $stUsuario = $this->conexao->prepare($sql);
            $stUsuario->bindParam(':nome', $this->nome);
            $stUsuario->bindParam(':email', $this->email);
            $stUsuario->bindParam(':nickname', $this->nickname);
            $stUsuario->bindParam(':senha', $this->senha);
            $stUsuario->bindParam(':tipoUsuario', $this->tipoUsuario);

            if (!$stUsuario->execute()) {
                $this->conexao->rollBack();
                $errorInfo = $stUsuario->errorInfo();
                error_log("Erro ao inserir em usuarios: " . ($errorInfo[2] ?? 'Erro desconhecido'));
                return false;
            }

            $id = $this->conexao->lastInsertId();
            $this->id = $id;

            $sqlCliente = "INSERT INTO clientes (id_usuario, data_nascimento) VALUES (:id_usuario, :dataNascimento)";

            $stCliente = $this->conexao->prepare($sqlCliente);
            $stCliente->bindParam(':id_usuario', $id);
            $stCliente->bindParam(':dataNascimento', $this->dataNascimento);

            if (!$stCliente->execute()) {
                $errorInfo = $stCliente->errorInfo();
                error_log("Erro ao inserir em clientes: " . ($errorInfo[2] ?? 'Erro desconhecido'));
                $this->conexao->rollBack();
                return false;
            }

            $this->conexao->commit();
            return true;
        } catch (Exception $e) {
            if ($this->conexao && $this->conexao->inTransaction()) {
                $this->conexao->rollBack();
            }

            error_log("Exeção ao cadastrar cliente");
            return false;
        }
    }

    public function editarPerfil()
    {

        if (empty($this->nome) || empty($this->email) ||  empty($this->nickname) || empty($this->dataNascimento)) {
            return false;
        }

        try {


            $this->conexao->beginTransaction();

            $sqlUsuario = "UPDATE usuarios SET nome = :nome, email = :email, nickname = :nickname WHERE id = :id";

            $stUsuario = $this->conexao->prepare($sqlUsuario);

            $stUsuario->bindParam(':nome', $this->nome);
            $stUsuario->bindParam(':email', $this->email);
            $stUsuario->bindParam(':nickname', $this->nickname);
            $stUsuario->bindParam(':id', $this->id);

            if (!$stUsuario->execute()) {
                $this->conexao->rollBack();
                error_log("Erro ao atualizar usuario.");
                return false;
            }

            $sqlCliente = "UPDATE clientes SET data_nascimento = :dataNascimento WHERE id_usuario = :id_usuario";

            $stCliente = $this->conexao->prepare($sqlCliente);
            $stCliente->bindParam(':id_usuario', $this->id);
            $stCliente->bindParam(':dataNascimento', $this->dataNascimento);

            if (!$stCliente->execute()) {
                error_log("Erro ao atualizar cliente.");
                $this->conexao->rollBack();
                return false;
            }

            $this->conexao->commit();
            return true;
        } catch (Exception $e) {

            if ($this->conexao && $this->conexao->inTransaction()) {
                $this->conexao->rollBack();
            }
            error_log("Exeção ao editar perfil");
            return false;
        }
    }
}
