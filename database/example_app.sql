-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 20-Fev-2024 às 23:19
-- Versão do servidor: 5.7.17
-- versão do PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `example_app`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(75) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `clients`
--

INSERT INTO `clients` (`id`, `name`, `address`, `phone`, `created_at`, `updated_at`, `deleted_at`, `user_id`) VALUES
(1, 'User Demo', '1022 LC, 3062 PA, 5126 ND', '31 323235434', '2024-02-20 16:43:17', '2024-02-20 20:51:30', NULL, 1),
(2, 'User Demo 3', 'Starbucks, Av. Paulista, 1499 Lojas 02 e 03 - Bela Vista, São Paulo - SP, 01310-200', '08007778252', '2024-02-20 21:54:57', '2024-02-20 21:54:57', NULL, 3),
(3, 'User Demo 4', '6GH8+5X Edson Queiroz, Fortaleza - Ceará', '01630810432', '2024-02-20 21:57:32', '2024-02-20 21:57:32', NULL, 4),
(4, 'User Demo 5', 'piso 4 - Av. Washington Soares, 4335 - Loja 424 e 425 - Lagoa Sapiranga (Coité), Fortaleza - CE, 60833-005', '08532732175', '2024-02-20 21:58:16', '2024-02-20 21:58:16', NULL, 5),
(5, 'User Demo 6', 'piso 4 - Av. Washington Soares, 4335 - Loja 424 e 425 - Lagoa Sapiranga (Coité), Fortaleza - CE, 60833-005', '08532732175', '2024-02-20 21:59:43', '2024-02-20 21:59:43', NULL, 6),
(6, 'User Demo 7', 'piso 4 - Av. Washington Soares, 4335 - Loja 424 e 425 - Lagoa Sapiranga (Coité), Fortaleza - CE, 60833-005', '08532732175', '2024-02-20 22:00:11', '2024-02-20 22:00:11', NULL, 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `status` varchar(40) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `orders`
--

INSERT INTO `orders` (`id`, `client_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'pending', '2024-02-20 17:28:31', '2024-02-20 20:09:19', NULL),
(2, 1, 'pending', '2024-02-20 21:07:01', '2024-02-20 20:51:12', NULL),
(3, 1, 'pending', '2024-02-20 21:07:01', NULL, NULL),
(4, 1, 'pending', '2024-02-20 21:07:01', '2024-02-20 21:24:16', NULL),
(5, 1, 'pending', '2024-02-20 21:07:01', '2024-02-20 20:20:33', NULL),
(6, 1, 'finished', '2024-02-20 21:07:01', NULL, NULL),
(7, 1, 'pending', '2024-02-20 21:07:01', NULL, NULL),
(8, 1, 'finished', '2024-02-20 21:07:01', NULL, NULL),
(9, 1, 'pending', '2024-02-20 21:07:01', NULL, NULL),
(10, 1, 'finished', '2024-02-20 21:07:01', NULL, NULL),
(11, 1, 'pending', '2024-02-20 21:07:01', NULL, NULL),
(12, 1, 'finished', '2024-02-20 21:07:01', NULL, NULL),
(13, 1, 'pending', '2024-02-20 21:07:01', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(70) NOT NULL,
  `user_type` varchar(30) NOT NULL,
  `password` varchar(70) NOT NULL,
  `name` varchar(70) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `email`, `user_type`, `password`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'user@demo.com', 'client', '$2y$12$C7g8b9DJrJ40K1Bj9VI1e.7yqsCm/apqXOHIqpNbxMzALFdCvBVzC', 'User Demo', '2024-02-20 14:22:35', '2024-02-20 20:51:30', NULL),
(2, 'user2@demo.com', 'client', '$2y$12$TrQsQ2170I15j6y./JuGeurLCcba8ZY8iZBA2Ve0IoZSRlSrH2XrK', 'User Demo 2', '2024-02-20 21:52:35', '2024-02-20 21:52:35', NULL),
(3, 'user3@demo.com', 'client', '$2y$12$XTdMWop0Z6fizaHZhkEiTO9.l5v3J4NGutqflYb4/uNAz12npVfOm', 'User Demo 3', '2024-02-20 21:54:57', '2024-02-20 21:54:57', NULL),
(4, 'user4@demo.com', 'client', '$2y$12$TPb7LEapMOzG3x2Qka3N6OCSO20ZVpiYLPfjZbOu51yvebvICT5/.', 'User Demo 4', '2024-02-20 21:57:32', '2024-02-20 21:57:32', NULL),
(5, 'user5@demo.com', 'client', '$2y$12$LW/kF4RJwoKfbotGoWwtYucHEqfgiKydEYczfXHZklflWgoulwfFC', 'User Demo 5', '2024-02-20 21:58:16', '2024-02-20 21:58:16', NULL),
(6, 'user6@demo.com', 'client', '$2y$12$SpkPcMb8iA4dHJTKNHKquun27qBs9lnFsFOBUZqkaBpi8xZSZp8sy', 'User Demo 6', '2024-02-20 21:59:43', '2024-02-20 21:59:43', NULL),
(7, 'user7@demo.com', 'client', '$2y$12$oeOMbJMB.AGkkc9qFNsdR.Opq54vDe2Wm2hT2SACak/xW0fq25UdK', 'User Demo 7', '2024-02-20 22:00:11', '2024-02-20 22:00:11', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
