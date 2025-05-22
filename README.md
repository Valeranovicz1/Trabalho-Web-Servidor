# Projeto Web em PHP - ET Games

## 📋 Informações Gerais
Este repositório contém o código-fonte e a documentação do trabalho da disciplina de Web-Servidor, desenvolvido conforme as diretrizes fornecidas pelo professor. A estrutura segue o padrão MVC.

## 👨‍💻 Integrantes do Grupo
Eduardo Massuqueto de Andrade | Thomas Valeranovicz

## 💡 Descrição do Projeto
O projeto consiste em um aplicativo web com foco na aquisição de jogos digitais, simulando uma loja virtual de games. 

## ✅ Funcionalidades
Os usuários podem se cadastrar, realizar login e acessar diversas funcionalidades, como:

  - Adicionar jogos à sua biblioteca pessoal;
  - Enviar mensagens para o suporte da plataforma;
  - Visualizar e editar as informações da própria conta;
  - Acessar detalhes completos sobre os jogos disponíveis.
    
Além disso, o sistema possui um painel administrativo, onde o administrador tem permissões para:

  - Criar novos jogos no catálogo;
  - Listar os jogos já existentes;
  - Remover jogos da plataforma.
  - Editar jogos da plataforma(Funcionalidade faltante);

# ⚙️ Instalação e Configuração
  - PHP 8.0 ou superior;
  - Git instalado;
  - MySQL ou MariaDB;
  - Servidor Web (Apache ou similar);
  - Navegador moderno.

## Copie o repositório
<pre>git clone https://github.com/Valeranovicz1/Trabalho-Web-Servidor.git 
cd Trabalho-Web-Servidor.git </pre>

## Inicie o servidor
Se estiver usando XAMPP:
Inicie o Apache e o MySQL;

Acesse no navegador:
http://localhost/TrabalhoWebServidor/index.php
  


## 📂 Estrutura do Projeto
- Model: Contém as classes responsáveis pela representação dos dados e regras de negócio da aplicação. 
- controllers: Contém os arquivos responsáveis pela lógica da aplicação.
- view: Inclui os arquivos de interface do usuário (HTML e PHP).
- storage: Contém os arquivos de armazenamento de dados.
- assets: Contém os recursos estáticos da aplicação (CSS,JS e Imagens).
