-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11-Maio-2022 às 14:40
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `arranchamento`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `arranchamentos`
--

CREATE TABLE `arranchamentos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` smallint(6) DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brekker` tinyint(4) DEFAULT 0,
  `lunch` tinyint(4) DEFAULT 0,
  `dinner` tinyint(4) DEFAULT 0,
  `status` smallint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `arranchamentos`
--

INSERT INTO `arranchamentos` (`id`, `user_id`, `company_id`, `date`, `brekker`, `lunch`, `dinner`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(86, 79, 2, '2022-05-11', 1, 1, 0, NULL, '2022-05-10 19:17:07', '2022-05-10 19:17:39', '2022-05-10 19:17:39'),
(87, 120, 2, '2022-05-11', 1, 1, 0, NULL, '2022-05-10 19:17:07', '2022-05-10 19:17:39', '2022-05-10 19:17:39'),
(88, 79, 2, '2022-05-11', 1, 1, 0, NULL, '2022-05-10 19:17:45', '2022-05-10 19:17:45', NULL),
(89, 120, 2, '2022-05-11', 1, 1, 0, NULL, '2022-05-10 19:17:45', '2022-05-10 19:17:45', NULL),
(90, 131, 2, '2022-05-11', 1, 1, 0, NULL, '2022-05-10 19:17:45', '2022-05-10 19:17:45', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `menu`
--

CREATE TABLE `menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brekker` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lunch` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `dinner` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `h_ccsv` time NOT NULL,
  `h_cia1` time NOT NULL,
  `h_cia2` time NOT NULL,
  `h_cia3` time NOT NULL,
  `updatedby` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `menu`
--

INSERT INTO `menu` (`id`, `date`, `brekker`, `lunch`, `dinner`, `h_ccsv`, `h_cia1`, `h_cia2`, `h_cia3`, `updatedby`, `created_at`, `updated_at`, `deleted_at`) VALUES
(12, '2022-05-06', '<ul><li>ertret</li><li>erterter</li><li>ertert</li><li>ertert</li><li>ertertre</li><li>retert</li><li>retre<br></li></ul>', '<ul><li>ertret</li><li>erterter</li><li>ertert</li><li>ertert</li><li>ertertre</li><li>retert</li><li>retre</li></ul><p></p>', '<ul><li>ertret</li><li>erterter</li><li>ertert</li><li>ertert</li><li>ertertre</li><li>retert</li><li>retre</li></ul><p></p>', '15:11:00', '15:11:00', '15:11:00', '15:11:00', 'Cb Eduardo', '2022-04-28 18:11:59', '2022-05-06 13:37:08', NULL),
(15, '2022-05-04', '<ul><li>Arroz </li><li>polenta</li><li>polenta<br></li></ul>', '<ul><li>Arroz </li><li>polenta</li><li>polenta</li></ul><p></p>', '<ul><li>Arroz </li><li>polenta</li><li>polenta</li></ul><p></p>', '09:00:00', '09:00:00', '09:00:00', '09:00:00', 'Cb Eduardo', '2022-05-02 12:00:36', '2022-05-02 12:00:36', NULL),
(18, '2022-05-07', '<p>rev3rtv53tb543y<br></p>', '<p>54tby45yb45yb<br></p>', '<p>5yb45yb<br></p>', '10:42:00', '10:42:00', '10:42:00', '10:42:00', 'Cb Eduardo', '2022-05-06 13:42:14', '2022-05-06 13:42:14', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2022_04_05_120230_arranchamentos', 1),
(3, '2022_04_05_121943_menu', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `arranchamentos`
--
ALTER TABLE `arranchamentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `arranchamentos`
--
ALTER TABLE `arranchamentos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT de tabela `menu`
--
ALTER TABLE `menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
