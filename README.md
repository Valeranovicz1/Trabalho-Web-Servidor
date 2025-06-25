# Sobre o Projeto
A API é construída em Laravel. Ela oferece endpoints para as operações de POST, PUT, GET, e DELETE , além de um sistema de autenticação via Laravel Sanctum.

#Tecnologias Utilizadas:
-PHP
-Laravel (Framework)
-MySQL (Banco de Dados)
-Laravel Sanctum (Autenticação de API)

## Funcionalidades Principais:
-Gerenciamento de Usuários (Clientes e Empresas)
-Cadastro e Gestão de Jogos
-Gerenciamento de Biblioteca de Jogos
-Sistema de Suporte
-Carrinho de Compras
-Autenticação via Token (Sanctum)

## Requisitos de Instalação
-PHP: Versão 8.1 ou superior.
-Composer.
-MySQL: Servidor de banco de dados (ou MariaDB, PostgreSQL, etc.).
-XAMPP.

#Passos Para Instalação:
1- Clone o Repositório:
    git clone https://github.com/Valeranovicz1/Trabalho-Web-Servidor.git
    cd Trabalho-Web-Servidor

2-Instale o Composer
    composer install

3-Criação do Banco de Dados
    Crie o Banco de Dados chamado de et_games

4-Rode as Migrations
    Execute o seguinte comando:
    php artisan migrate

5-Inicie o Servidor
    Execute o comando:
    php artisan serve

