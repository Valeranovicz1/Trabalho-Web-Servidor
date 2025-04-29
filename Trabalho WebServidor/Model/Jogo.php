<?php
class Jogo {
    public $id;
    public $nome;
    public $descricao;
    public $preco;

    public function __construct($id, $nome, $descricao, $preco) {
        $this->id = $id;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->preco = $preco;
    }

    public static function __set_state($array) {
        return new self(
            $array['id'],
            $array['nome'],
            $array['descricao'],
            $array['preco']
        );
    }
}
?>
