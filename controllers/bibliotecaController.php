<?php

    require_once __DIR__ . '/../Model/Conexao.php';
    require_once __DIR__ . '/../Model/Jogo.php';
    require_once __DIR__ . '/../Model/Biblioteca.php';

    class bibliotecaController{

        private $db;
        
        public function __construct() {
        
            $this->db = Conexao::get(); 

        }

        public function listarJogosBiblioteca(){

            $idUsuario = $_SESSION['usuario']['id'];
            $jogo = new Jogo($this->db);
            return $jogo->listarJogosBiblioteca($idUsuario);
        }

        public function listarJogosCategoriaBiblioteca($categoria){
            
            $idUsuario = $_SESSION['usuario']['id'];
            $jogo = new Jogo($this->db);
            return $jogo->listarJogosCategoriaBiblioteca($categoria,$idUsuario);
        
        }

    }


?>