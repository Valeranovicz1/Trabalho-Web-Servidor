# Projeto Web em PHP - ET Games

## 📋 Informações Gerais
Este repositório contém o código-fonte e a documentação do trabalho da disciplina de Web-Servidor, desenvolvido conforme as diretrizes fornecidas pelo professor. A estrutura segue o padrão MVC.

## 👨‍💻 Integrantes do Grupo
Eduardo Massuqueto de Andrade | Thomas Valeranovicz

## 💡 Descrição do Projeto
O projeto consiste em um aplicativo web com foco na aquisição de jogos digitais, simulando uma loja virtual de games. 

## ✅ Funcionalidades
Os usuários podem se cadastrar, realizar login e acessar diversas funcionalidades, como:

  - Adicionar jogos à sua biblioteca pessoal (faltante);
  - Enviar mensagens para o suporte da plataforma;
  - Visualizar e editar as informações da própria conta;
  - Acessar detalhes completos sobre os jogos disponíveis.
    
Além disso, o sistema possui um painel administrativo, onde o administrador tem permissões para:

  - Criar novos jogos no catálogo;
  - Listar os jogos já existentes;
  - Remover jogos da plataforma.

# ⚙️ Instalação e Configuração
  - PHP 8.0 ou superior;
  - Git instalado;
  - MySQL ou MariaDB;
  - Servidor Web (Apache ou similar);
  - VSCode (Ou outro editor);
  - Composer;
  - Navegador moderno.

## Copie o repositório
<pre>git clone https://github.com/Valeranovicz1/Trabalho-Web-Servidor.git 
cd Trabalho-Web-Servidor.git </pre>

## Inicie o servidor
Se estiver usando XAMPP:
Inicie o Apache e o MySQL;

## Configurando o Apache
Clique no botão config e selecione o Apache(httpd.conf)
Tire o # da linha LoadModule rewrite_module modules/mod_rewrite.so
Procure por AllowOverride e modifique para AllowOverride All

## Configurando o Banco de Dados
Acesse o site:
<pre>http://localhost/phpmyadmin/index.php</pre>
Crie um novo banco de dados chamado et_gamas
Clique na aba importar e selecione o arquivo BancoDadosSQL e execute

## Instalando o Composer
Entre no site:
<pre> https://getcomposer.org/download/</pre>
Selecione a opção de download desejada
Execute o instalador do composer
Configure o composer e o selecione o executável php dentro da pasta xampp\php
Finalize o processo

## Configurando o Composer no VSCode
Dentro do VSCode abra a pasta do arquivo do projeto localizada em:
<pre>C:\xampp\htdocs\Trabalho-Web-Servidor</pre>
Agora dentro do terminal execute os seguintes comandos:
<pre> composer init </pre>
Configure o seu composer.
<pre>composer install
     composer dump-autoload
     composer require pecee/simple-router
     composer dump-autoload
     php -S localhost:8000</pre>

Acesse no navegador:
http://localhost:8000/
  


## 📂 Estrutura do Projeto
- Model: Contém as classes responsáveis pela representação dos dados e regras de negócio da aplicação. 
- controllers: Contém os arquivos responsáveis pela lógica da aplicação.
- view: Inclui os arquivos de interface do usuário (HTML e PHP).
- storage: Contém as imagens dos jogos.
- assets: Contém os recursos estáticos da aplicação (CSS,JS e Imagens).
