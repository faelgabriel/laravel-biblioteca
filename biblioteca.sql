-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 04-Ago-2018 às 16:36
-- Versão do servidor: 5.7.20-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biblioteca`
--
CREATE DATABASE IF NOT EXISTS `biblioteca` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `biblioteca`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `authors`
--

CREATE TABLE `authors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `authors`
--

INSERT INTO `authors` (`id`, `name`, `surname`, `created_at`, `updated_at`) VALUES
(1, 'Rafael', 'Gabriell', '2018-07-21 21:52:22', '2018-08-04 21:24:26'),
(3, 'Nome do autor', 'Sobrenome do autor', '2018-07-21 21:53:04', '2018-07-21 21:53:04');

-- --------------------------------------------------------

--
-- Estrutura da tabela `books`
--

CREATE TABLE `books` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `books`
--

INSERT INTO `books` (`id`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Batman', 'Descriicao', '1533389397.jpg', '2018-08-04 15:40:13', '2018-08-04 21:24:32'),
(2, 'Qlqr Livro', 'Book description.', '1533387201.png', '2018-08-04 15:53:13', '2018-08-04 15:53:21');

-- --------------------------------------------------------

--
-- Estrutura da tabela `books_authors`
--

CREATE TABLE `books_authors` (
  `book_id` int(10) UNSIGNED NOT NULL,
  `author_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `books_authors`
--

INSERT INTO `books_authors` (`book_id`, `author_id`, `created_at`, `updated_at`) VALUES
(2, 1, NULL, NULL),
(1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `books_lendings`
--

CREATE TABLE `books_lendings` (
  `lending_id` int(10) UNSIGNED NOT NULL,
  `book_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `books_lendings`
--

INSERT INTO `books_lendings` (`lending_id`, `book_id`, `created_at`, `updated_at`) VALUES
(3, 1, NULL, NULL),
(4, 1, NULL, NULL),
(5, 2, NULL, NULL),
(6, 1, NULL, NULL),
(6, 2, NULL, NULL),
(7, 1, NULL, NULL),
(8, 2, NULL, NULL),
(9, 1, NULL, NULL),
(9, 2, NULL, NULL),
(10, 1, NULL, NULL),
(10, 2, NULL, NULL),
(11, 1, NULL, NULL),
(12, 1, NULL, NULL),
(12, 2, NULL, NULL),
(13, 1, NULL, NULL),
(13, 2, NULL, NULL),
(14, 2, NULL, NULL),
(2, 1, NULL, NULL),
(2, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `lendings`
--

CREATE TABLE `lendings` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `date_start` timestamp NULL DEFAULT NULL,
  `date_end` timestamp NULL DEFAULT NULL,
  `date_finish` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `lendings`
--

INSERT INTO `lendings` (`id`, `user_id`, `date_start`, `date_end`, `date_finish`, `created_at`, `updated_at`) VALUES
(2, 1, '2018-08-04 03:00:00', '2018-08-11 03:00:00', '2018-08-05 03:00:00', '2018-08-04 20:50:16', '2018-08-04 22:30:06'),
(3, 1, '2018-08-04 03:00:00', '2018-08-11 03:00:00', '2018-08-04 20:55:42', '2018-08-04 20:50:21', '2018-08-04 20:55:42'),
(4, 1, '2018-08-04 03:00:00', '2018-08-11 03:00:00', NULL, '2018-08-04 20:55:40', '2018-08-04 20:55:40'),
(5, 1, '2018-08-04 03:00:00', '2018-08-11 03:00:00', NULL, '2018-08-04 20:55:47', '2018-08-04 20:55:47'),
(6, 1, '2018-08-04 03:00:00', '2018-08-11 03:00:00', NULL, '2018-08-04 20:56:23', '2018-08-04 20:56:23'),
(7, 1, '2018-08-04 03:00:00', '2018-08-11 03:00:00', NULL, '2018-08-04 21:08:04', '2018-08-04 21:08:04'),
(8, 1, '2018-08-04 03:00:00', '2018-08-11 03:00:00', NULL, '2018-08-04 21:08:08', '2018-08-04 21:08:08'),
(9, 1, '2018-08-04 03:00:00', '2018-08-11 03:00:00', NULL, '2018-08-04 21:08:12', '2018-08-04 21:08:12'),
(10, 1, '2018-08-04 03:00:00', '2018-08-11 03:00:00', NULL, '2018-08-04 21:08:15', '2018-08-04 21:08:15'),
(11, 1, '2018-08-04 03:00:00', '2018-08-11 03:00:00', NULL, '2018-08-04 21:08:19', '2018-08-04 21:08:19'),
(12, 1, '2018-08-04 03:00:00', '2018-08-11 03:00:00', NULL, '2018-08-04 21:08:23', '2018-08-04 21:08:23'),
(13, 1, '2018-08-04 03:00:00', '2018-08-11 03:00:00', NULL, '2018-08-04 21:08:58', '2018-08-04 21:08:58'),
(14, 1, '2018-08-04 03:00:00', '2018-08-11 03:00:00', NULL, '2018-08-04 21:31:29', '2018-08-04 21:31:29');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_07_21_160141_create_authors_table', 1),
(4, '2018_07_21_160141_create_books_table', 1),
(5, '2018_07_21_160141_create_lendings_table', 1),
(6, '2018_07_21_160142_create_books_authors_table', 1),
(7, '2018_07_21_160143_create_books_lendings_table', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Test', 'test@test.com', '$2y$10$JUFUZZHqYwgkPj6oIpfFJeWP5BheLqSvHvwDgQrZsCaMEq0pmJfZu', 'Ip33ufrb2xS4mR8TjY2B0nYgnsXSMU1BgeES2slIcrlYP1xxnzKPrAzxQAtZ', 0, '2018-07-21 20:44:03', '2018-08-04 14:48:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books_authors`
--
ALTER TABLE `books_authors`
  ADD KEY `books_authors_author_id_foreign` (`author_id`),
  ADD KEY `books_authors_book_id_foreign` (`book_id`);

--
-- Indexes for table `books_lendings`
--
ALTER TABLE `books_lendings`
  ADD KEY `books_lendings_book_id_foreign` (`book_id`),
  ADD KEY `books_lendings_lending_id_foreign` (`lending_id`);

--
-- Indexes for table `lendings`
--
ALTER TABLE `lendings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lendings_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lendings`
--
ALTER TABLE `lendings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `books_authors`
--
ALTER TABLE `books_authors`
  ADD CONSTRAINT `books_authors_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`),
  ADD CONSTRAINT `books_authors_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`);

--
-- Limitadores para a tabela `books_lendings`
--
ALTER TABLE `books_lendings`
  ADD CONSTRAINT `books_lendings_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `books_lendings_lending_id_foreign` FOREIGN KEY (`lending_id`) REFERENCES `lendings` (`id`);

--
-- Limitadores para a tabela `lendings`
--
ALTER TABLE `lendings`
  ADD CONSTRAINT `lendings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
