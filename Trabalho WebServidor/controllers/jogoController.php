<?php
require_once __DIR__ . '../../Model/Jogo.php';

class JogoController {

    private static function carregarJogos() {
        if (file_exists(__DIR__ . '/../storage/jogos.php')) {
            include __DIR__ . '/../storage/jogos.php';
            if (isset($jogos) && is_array($jogos)) {
                return $jogos;
            }
        }
        return [];
    }

    private static function salvarJogos($jogos) {
        $codigoPHP = "<?php\n\n\$jogos = " . var_export($jogos, true) . ";\n\n?>";
        file_put_contents(__DIR__ . '/../storage/jogos.php', $codigoPHP);
    }

    private static function gerarProximoId($jogos) {
        if (empty($jogos)) {
            return 1;
        }
        $ids = array_map(function($jogo) {
            return $jogo->id;
        }, $jogos);
        return max($ids) + 1;
    }

    public static function criarJogo($nome, $descricao, $preco) {
        $jogos = self::carregarJogos();  // <<< importante: carregar os jogos existentes primeiro
        
        $novoId = self::gerarProximoId($jogos);
        $novoJogo = new Jogo($novoId, $nome, $descricao, $preco);
        
        $jogos[] = $novoJogo; // <<< adicionar no final

        self::salvarJogos($jogos); // <<< salvar todos de novo
    }

    public static function excluirJogoPorNome($nome) {
        $jogos = self::carregarJogos();

        $jogos = array_filter($jogos, function($jogo) use ($nome) {
            return $jogo->nome !== $nome;
        });

        self::salvarJogos(array_values($jogos));
    }

    public static function listarJogos() {
        return self::carregarJogos();
    }
}
?>
