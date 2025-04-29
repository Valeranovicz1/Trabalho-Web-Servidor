<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

    class LoginController{

        public function login(){

            $usuarios = require __DIR__ . '/../storage/usuarios.php';

            $nickname = $_POST['nickname'] ?? '';
            $senha = $_POST['senha'] ?? '';


            foreach($usuarios as $usuario){
                if($usuario['nickname'] === $nickname){
                    if($usuario['senha'] === $senha){
                        $_SESSION['usuario'] = [
                            'id' => $usuario['id'],
                            'nickname' => $usuario['nickname'], 
                            'nome' => $usuario['nome'],
                            'email' => $usuario['email'],
                            'data_nascimento' => $usuario['data_nascimento'],
                            'tipo' => $usuario['tipo']
                        ];
    
                        if($usuario['tipo'] === 'empresa'){
                            header('Location: ../painel/painelEmpresa.php');
                            exit;
                            
                        }else if($usuario['tipo'] === 'cliente'){
                            header('Location: ../painel/painelCliente.php');
                            exit;
            
                        }else{
                            header('Location: ../view/login/login.php?erro=tipo_desconhecido');
                            exit;
                        }
    
                    }else{
                        header('Location: ../view/login/login.php?erro=senha_incorreta');
                        exit;
                    }
                }
            }

            header('Location: ../view/login/login.php?erro=usuario_nao_encontrado');
            exit;
        }     
        
        public function logout(){

            if (isset($_COOKIE['user_token'])) {
                setcookie('user_token', '', time() - 3600, '/', '', isset($_SERVER['HTTPS']), true); // Expira o cookie
            }
        
            session_start(); 
            $_SESSION = []; 
            session_destroy(); 
        
            header("Location: view/login/login.php");
            exit;
        }

    }


