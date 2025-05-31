<?php

namespace App\Controllers;
use App\Model\Conexao;
use App\Model\Jogo;

use Exception;


class bibliotecaController
{

    private $db;

    public function __construct()
    {

        $this->db = Conexao::get();
    }

    public function listarJogosBiblioteca()
    {

        $idUsuario = $_SESSION['usuario']['id'];
        $jogo = new Jogo($this->db);
        return $jogo->listarJogosBiblioteca($idUsuario);
    }

    public function listarJogosCategoriaBiblioteca($categoria)
    {

        $idUsuario = $_SESSION['usuario']['id'];
        $jogo = new Jogo($this->db);
        return $jogo->listarJogosCategoriaBiblioteca($categoria, $idUsuario);
    }
}
