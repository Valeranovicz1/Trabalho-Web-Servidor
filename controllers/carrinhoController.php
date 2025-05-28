<?php

    require_once __DIR__ . '/../Model/Conexao.php';
    require_once __DIR__ . '/../Model/Jogo.php';
    require_once __DIR__ . '/../Model/Biblioteca.php';


    class CarrinhoController {
        
    private $db;
    
    public function __construct() {
    
        $this->db = Conexao::get(); 

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = []; 
        }
    }
    
    public function adicionarAoCarrinho($idJogo) {
        
        if ($idJogo <= 0) {
            $_SESSION['mensagem_erro'] = "ID do jogo inválido.";
            error_log("Tentativa de adicionar ID de jogo inválido ao carrinho: " . $idJogo);
            return false;
        }

        if (!in_array($idJogo, $_SESSION['carrinho'])) {
            $_SESSION['carrinho'][] = $idJogo;
            $_SESSION['mensagem_sucesso'] = "Jogo adicionado ao carrinho!";
        } else {
            $_SESSION['mensagem_info'] = "Este jogo já está no seu carrinho.";
        }

        return true;
    }

    public function removerDoCarrinho($idJogo) {
        
        $key = array_search($idJogo, $_SESSION['carrinho']);
        if ($key !== false) {
            unset($_SESSION['carrinho'][$key]);
            $_SESSION['mensagem_sucesso'] = "Jogo removido do carrinho.";
        } else {
            $_SESSION['mensagem_info'] = "Jogo não encontrado no carrinho para remoção.";
        }
    }

    public function getJogosCarrinho() {
        return $_SESSION['carrinho'] ?? [];
    }

     public function limparCarrinho() {
        $_SESSION['carrinho'] = [];
    }

    public function finalizarCompra() {

        $idUsuario = $_SESSION['usuario']['id'];
        $jogosCarrinho = $this->getJogosCarrinho();

        if (empty($jogosCarrinho)) {
            $_SESSION['mensagem_info'] = "Seu carrinho está vazio. Adicione jogos antes de finalizar a compra.";
            header('Location: /view/navCliente/Carrinho.php');
            exit;
        }

        $biblioteca = new Biblioteca($this->db); 

        if ($biblioteca->finalizarCompra($jogosCarrinho, $idUsuario)) {
            
            $this->limparCarrinho(); 
            $_SESSION['mensagem_sucesso'] = "Compra finalizada com sucesso! Seus jogos foram adicionados à sua biblioteca.";
            header('Location: /view/navCliente/biblioteca.php'); 
            exit;
        } else {
            
            $_SESSION['mensagem_erro'] = "Ocorreu um erro ao processar sua compra. Alguns jogos podem não ter sido adicionados. Por favor, verifique sua biblioteca ou tente novamente.";
            header('Location: /view/navCliente/Carrinho.php');
            exit;
        }
    }
}

?>