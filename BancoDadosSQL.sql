-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27/05/2025 às 23:22
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `et_games`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `biblioteca`
--

CREATE TABLE `biblioteca` (
  `id_usuario` int(11) NOT NULL,
  `id_jogo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `biblioteca`
--

INSERT INTO `biblioteca` (`id_usuario`, `id_jogo`) VALUES
(11, 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id_usuario` int(11) NOT NULL,
  `data_nascimento` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id_usuario`, `data_nascimento`) VALUES
(11, '2025-05-14'),
(13, '2025-05-20'),
(14, '2025-05-06');

-- --------------------------------------------------------

--
-- Estrutura para tabela `empresas`
--

CREATE TABLE `empresas` (
  `site` varchar(250) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `empresas`
--

INSERT INTO `empresas` (`site`, `id_usuario`) VALUES
('sitegamesutudio.com', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `jogos`
--

CREATE TABLE `jogos` (
  `id_jogo` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `descricao` varchar(250) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `imagem` varchar(150) NOT NULL,
  `preco` double NOT NULL,
  `classificacao` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `jogos`
--

INSERT INTO `jogos` (`id_jogo`, `nome`, `descricao`, `categoria`, `imagem`, `preco`, `classificacao`, `id_empresa`) VALUES
(5, 'Valeranovicz', 'legal', 'Ação', 'storage/imagens_jogos/jogo_img_6832501705bbf9.85270150.jpg', 30, 18, 2),
(8, 'Teste1', 'legal', 'Ação', 'storage/imagens_jogos/jogo_img_6834e71f03e3c6.31528635.jpg', 300, 18, 2),
(10, 'Teste 3', 'legal', 'Ação', 'storage/imagens_jogos/jogo_img_68362b5d438956.90114611.jpg', 100, 18, 2),
(11, 'Teste 4', 'teste', 'teste', 'storage/imagens_jogos/jogo_img_68362b86b50759.38631572.jpg', 30, 18, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `suporte`
--

CREATE TABLE `suporte` (
  `id_suporte` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `mensagem` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `suporte`
--

INSERT INTO `suporte` (`id_suporte`, `id_usuario`, `mensagem`) VALUES
(1, 11, 'legal'),
(2, 11, 'teste'),
(3, 14, 'mt paia'),
(4, 11, 'teste 1'),
(5, 11, 'teste 1'),
(6, 11, 'teste 1'),
(7, 11, 'teste 33'),
(8, 11, 'teste 444');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `tipo_usuario` varchar(50) NOT NULL,
  `nickname` varchar(250) NOT NULL,
  `foto_perfil` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `senha`, `tipo_usuario`, `nickname`, `foto_perfil`, `email`) VALUES
(2, 'gamestudio', '123', 'empresa', 'gamestudio', '', 'gamestudio@gmail.com'),
(11, 'Valeranovicz1', '123', 'cliente', 'Valeranovicz', '', 'thomasvaleranovicz@gmail.com'),
(13, 'Valeranovicz', '123', 'cliente', 'teste', '', 'thomasvaleranovicz@gmail.com'),
(14, 'Eduardo', '123', 'cliente', 'Eduardo', '', 'eduardo@gmail.com');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `biblioteca`
--
ALTER TABLE `biblioteca`
  ADD PRIMARY KEY (`id_usuario`,`id_jogo`),
  ADD KEY `fk_jogo_biblioteca` (`id_jogo`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD UNIQUE KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `empresas`
--
ALTER TABLE `empresas`
  ADD UNIQUE KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `jogos`
--
ALTER TABLE `jogos`
  ADD PRIMARY KEY (`id_jogo`),
  ADD KEY `fk_id_empresa` (`id_empresa`);

--
-- Índices de tabela `suporte`
--
ALTER TABLE `suporte`
  ADD PRIMARY KEY (`id_suporte`),
  ADD KEY `fk_usuario_relatorio` (`id_usuario`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `jogos`
--
ALTER TABLE `jogos`
  MODIFY `id_jogo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `suporte`
--
ALTER TABLE `suporte`
  MODIFY `id_suporte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `biblioteca`
--
ALTER TABLE `biblioteca`
  ADD CONSTRAINT `fk_jogo_biblioteca` FOREIGN KEY (`id_jogo`) REFERENCES `jogos` (`id_jogo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuario_biblioteca` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `empresas`
--
ALTER TABLE `empresas`
  ADD CONSTRAINT `fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `jogos`
--
ALTER TABLE `jogos`
  ADD CONSTRAINT `fk_id_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `suporte`
--
ALTER TABLE `suporte`
  ADD CONSTRAINT `fk_usuario_relatorio` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
