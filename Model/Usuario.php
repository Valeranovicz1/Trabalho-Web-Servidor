<?php

    abstract class Usuario{

        protected $id;
        protected $nome;
        protected $email;
        protected $senha;
        protected $nickname;
        protected $fotoPerfil;
        protected $tipoUsuario;

        public function __get($propriedade){
        
        return $this->$propriedade;
        }

        public function __set($propriedade,$valor){

            $this->$propriedade = $valor;
        }
        
        public static function logar(PDO $conexaoDb, string $nickname, string $senha): array {

            try {
                
                $sql = "SELECT id, nome, email, senha, nickname, tipo_usuario
                        FROM usuarios
                        WHERE nickname = :nickname
                        LIMIT 1";
                $stmt = $conexaoDb->prepare($sql);
                $stmt->bindParam(':nickname', $nickname, PDO::PARAM_STR);
                $stmt->execute();
                $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($usuario) {

                    if ($senha === $usuario['senha']) { 

                        unset($usuario['senha']);
                        return ['success' => true, 'data' => $usuario];
                    } else {

                        return ['success' => false, 'error' => 'senha_incorreta'];
                    }
                } else {

                    return ['success' => false, 'error' => 'usuario_nao_encontrado'];
                }
            } catch (PDOException $e) {
                error_log("Erro de autenticação no Usuario::autenticar() (modo inseguro): " . $e->getMessage());
                return ['success' => false, 'error' => 'erro_sistema'];
            }
        }
    

    }



?>