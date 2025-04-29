<?php

    class RegisterController{

        public function register(){
            
            $usuarios = require_once __DIR__ . '/../storage/usuarios.php';

            $nome = trim($_POST['nome'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $nickname = trim($_POST['nickname'] ?? '');
            $senha = trim($_POST['senha'] ?? '');
            $data_nascimento = trim($_POST['data_nascimento'] ?? '');

            foreach($usuarios as $usuario){
                if($usuario['nickname'] === $nickname){
                    header('Location: /view/login/register.php?erro=nickname_ja_cadastrado');
                    exit;
                }

                if($usuario['email'] === $email){
                    header('Location: /view/login/register.php?erro=email_ja_cadastrado');
                    exit;
                }
            }

            $novoUsuario = [

                'id' => count($usuarios) + 1,
                'nome' => $nome,
                'email' => $email,
                'nickname' => $nickname,
                'senha' => $senha,
                'data_nascimento' => $data_nascimento,
                'tipo' => 'cliente'
            ];
    
            $usuarios[] = $novoUsuario;
            
            $arquivo = __DIR__ . '/../storage/usuarios.php';
            $conteudo = '<?php return ' . var_export($usuarios, true) . ';';

            if (file_put_contents($arquivo, $conteudo, LOCK_EX) === false) {
                header('Location: /view/login/register.php?erro=erro_ao_salvar');
                exit;
}
            header('Location: ../login/login.php');
            exit;
        }
    }
?>
