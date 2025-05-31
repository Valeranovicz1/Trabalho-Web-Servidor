<?php

namespace App\Controllers;


use App\Model\Jogo;
use App\Model\Conexao;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


class JogoController
{

    private $db;

    public function __construct()
    {
        $this->db = Conexao::get();
    }

    private function verificarAcessoEmpresa()
    {
        if (!isset($_SESSION['usuario']) || !isset($_SESSION['usuario']['id']) || !isset($_SESSION['usuario']['tipo']) || $_SESSION['usuario']['tipo'] !== 'empresa') {
            header('Location: /');
            exit;
        }
    }

    public function cadastrarJogo()
    {
        $this->verificarAcessoEmpresa();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['cadastrar'])) {

            return;
        }

        $imagemPathParaBanco = null;

        if (isset($_FILES['imagem_jogo']) && $_FILES['imagem_jogo']['error'] === UPLOAD_ERR_OK) {
            $arquivoTmp = $_FILES['imagem_jogo']['tmp_name'];
            $nomeArquivoOriginal = basename($_FILES['imagem_jogo']['name']);
            $extensaoArquivo = strtolower(pathinfo($nomeArquivoOriginal, PATHINFO_EXTENSION));
            $permitirExtensoes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

            if (in_array($extensaoArquivo, $permitirExtensoes)) {
                $novoNomeArquivo = uniqid('jogo_img_', true) . '.' . $extensaoArquivo;
                $diretorioRaizProjeto = dirname(__DIR__);
                $diretorioStorage = $diretorioRaizProjeto . DIRECTORY_SEPARATOR . 'storage';
                $subpastaImagensJogo = $diretorioStorage . DIRECTORY_SEPARATOR . 'imagens_jogos';

                if (!is_dir($diretorioStorage)) {
                    if (!mkdir($diretorioStorage, 0775, true)) {
                        $_SESSION['mensagem_erro_jogo'] = "Falha crítica ao criar diretório de storage.";
                        error_log("Falha ao criar diretório: " . $diretorioStorage);
                        header('Location: /painelEmpresa');
                        exit;
                    }
                }
                if (!is_dir($subpastaImagensJogo)) {
                    if (!mkdir($subpastaImagensJogo, 0775, true)) {
                        $_SESSION['mensagem_erro_jogo'] = "Falha crítica ao criar subpasta de imagens do jogo.";
                        error_log("Falha ao criar diretório: " . $subpastaImagensJogo);
                        header('Location: /painelEmpresa');
                        exit;
                    }
                }

                $caminhoCompletoDestino = $subpastaImagensJogo . DIRECTORY_SEPARATOR . $novoNomeArquivo;

                if (move_uploaded_file($arquivoTmp, $caminhoCompletoDestino)) {
                    $imagemPathParaBanco = 'storage/imagens_jogos/' . $novoNomeArquivo;
                } else {
                    error_log("Falha ao mover arquivo de upload: de {$arquivoTmp} para {$caminhoCompletoDestino}. Verifique permissões e o caminho de destino. Existe a pasta {$subpastaImagensJogo}?");
                    $_SESSION['mensagem_erro_jogo'] = "Erro ao salvar a imagem do jogo. O upload pode ter falhado.";
                    header('Location: /painelEmpresa');
                    exit;
                }
            } else {
                $_SESSION['mensagem_erro_jogo'] = "Tipo de arquivo de imagem inválido. Permitidos: " . implode(', ', $permitirExtensoes);
                header('Location: /painelEmpresa');
                exit;
            }
        } elseif (isset($_FILES['imagem_jogo']) && $_FILES['imagem_jogo']['error'] !== UPLOAD_ERR_NO_FILE) {
            $_SESSION['mensagem_erro_jogo'] = "Ocorreu um erro durante o upload da imagem. Código: " . $_FILES['imagem_jogo']['error'];
            error_log("Erro de upload de imagem (código): " . $_FILES['imagem_jogo']['error']);
            header('Location: /painelEmpresa');
            exit;
        }

        if ($imagemPathParaBanco === null) {

            if (isset($_FILES['imagem_jogo']) && $_FILES['imagem_jogo']['error'] === UPLOAD_ERR_NO_FILE) {
                $_SESSION['mensagem_erro_jogo'] = "A imagem do jogo é obrigatória.";
            } else if (empty($_SESSION['mensagem_erro_jogo'])) {
                $_SESSION['mensagem_erro_jogo'] = "Nenhuma imagem enviada ou falha no processamento da imagem.";
            }
            header('Location: /painelEmpresa');
            exit;
        }

        $jogo = new Jogo($this->db);

        $jogo->nome = trim($_POST['nome'] ?? '');
        $jogo->descricao = trim($_POST['descricao'] ?? '');
        $jogo->categoria = trim($_POST['categoria'] ?? '');
        $jogo->foto = $imagemPathParaBanco;

        $precoPost = str_replace(',', '.', $_POST['preco'] ?? '0');
        $jogo->preco = filter_var($precoPost, FILTER_VALIDATE_FLOAT);

        if ($jogo->preco === false || $jogo->preco < 0) {
            $_SESSION['mensagem_erro_jogo'] = "Preço inválido fornecido.";
            header('Location: /painelEmpresa?erro=preco_invalido');
            exit;
        }

        $jogo->classificacao = trim($_POST['classificacao'] ?? '');
        $jogo->idEmpresa = $_SESSION['usuario']['id'];

        if ($jogo->adicionarJogo()) {
            $_SESSION['mensagem_sucesso_jogo'] = "Jogo '" . htmlspecialchars($jogo->nome) . "' adicionado com sucesso!";
        } else {
            $_SESSION['mensagem_erro_jogo'] = "Erro ao adicionar o jogo '" . htmlspecialchars($jogo->nome) . "'. Verifique os dados e tente novamente.";
        }
        header('Location: /painelEmpresa');
        exit;
    }

    public function excluirJogoPainel()
    {
        $this->verificarAcessoEmpresa();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['excluir'])) {
            return;
        }
        $nomeExcluir = trim($_POST['nome_excluir'] ?? '');
        $idEmpresa = $_SESSION['usuario']['id'];

        if (!empty($nomeExcluir)) {
            $jogo = new Jogo($this->db);
            if ($jogo->excluirJogo($nomeExcluir, $idEmpresa)) {
                $_SESSION['mensagem_sucesso_jogo'] = "Jogo '" . htmlspecialchars($nomeExcluir) . "' excluído com sucesso!";
            } else {
                $_SESSION['mensagem_erro_jogo'] = "Erro ao excluir o jogo '" . htmlspecialchars($nomeExcluir) . "'.";
            }
        } else {
            $_SESSION['mensagem_erro_jogo'] = "Nenhum jogo selecionado para exclusão.";
        }
        header('Location: /painelEmpresa');
        exit;
    }

    public function listarJogosEmpresa()
    {

        if (isset($_POST['listar_empresa']) || (empty($_POST) && !empty($jogos))) {

            $this->verificarAcessoEmpresa();

            $idEmpresa = $_SESSION['usuario']['id'];
            $jogo = new Jogo($this->db);
            return $jogo->listarJogosDaEmpresa($idEmpresa);
        }
    }

    public function listaJogosCategoria($categoria)
    {

        $jogo = new Jogo($this->db);
        return $jogo->listarJogosCategoria($categoria);
    }
}
