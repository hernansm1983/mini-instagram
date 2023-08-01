-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 31-07-2023 a las 21:47:36
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mini_instagram`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `id` int(255) NOT NULL,
  `user_id` int(255) DEFAULT NULL,
  `image_id` int(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `image_id`, `content`, `created_at`, `updated_at`) VALUES
(4, 4, 8, 'hermosa foto del chalten, aguante Argentina', '2023-07-10 23:02:30', '2023-07-10 23:02:30'),
(5, 4, 8, 'hermosa foto del chalten, aguante Argentina', '2023-07-10 23:02:59', '2023-07-10 23:02:59'),
(6, 4, 8, 'prueba 1', '2023-07-10 23:03:46', '2023-07-10 23:03:46'),
(7, 4, 8, 'prueba 1', '2023-07-10 23:04:53', '2023-07-10 23:04:53'),
(8, 4, 8, 'prueba 2', '2023-07-10 23:08:20', '2023-07-10 23:08:20'),
(9, 4, 8, 'prueba 3', '2023-07-10 23:09:51', '2023-07-10 23:09:51'),
(10, 4, 8, 'prueba 4', '2023-07-10 23:10:19', '2023-07-10 23:10:19'),
(11, 4, 8, 'prueba 5', '2023-07-10 23:11:36', '2023-07-10 23:11:36'),
(12, 4, 8, 'prueba 6', '2023-07-10 23:12:20', '2023-07-10 23:12:20'),
(14, 4, 8, 'ultima prueba', '2023-07-10 23:14:55', '2023-07-10 23:14:55'),
(15, 4, 8, 'Prueba de comentario', '2023-07-11 21:35:03', '2023-07-11 21:35:03'),
(16, 4, 8, 'Hermosa foto', '2023-07-13 20:14:13', '2023-07-13 20:14:13'),
(20, 4, 13, 'Increible ... hay que volver', '2023-07-30 14:25:10', '2023-07-30 14:25:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images`
--

CREATE TABLE `images` (
  `id` int(255) NOT NULL,
  `user_id` int(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `images`
--

INSERT INTO `images` (`id`, `user_id`, `image_path`, `description`, `created_at`, `updated_at`) VALUES
(8, 4, '1688671789chalten.jpg', 'Una del Chalten .... Paraiso Total', '2023-07-06 19:29:49', '2023-07-06 19:29:49'),
(9, 4, '1690396848perito_moreno.jpg', 'Hermoso el Glaciar !!!', '2023-07-26 18:40:48', '2023-07-26 18:40:48'),
(10, 4, '1690500881norte.jpg', 'Una del Norte, Aguante Argentina !!!', '2023-07-27 23:34:41', '2023-07-27 23:34:41'),
(11, 4, '1690501668patagonia.jpg', 'Tremendo Lugar', '2023-07-27 23:47:48', '2023-07-27 23:47:48'),
(13, 4, '1690581506sur.jpg', 'Tremendo lugar !!!!', '2023-07-28 20:01:36', '2023-07-28 22:02:55'),
(14, 4, '1690727681cataratas.jpg', 'Las Cataratas .... otro paraiso', '2023-07-30 14:34:42', '2023-07-30 14:34:42'),
(15, 4, '1690731662patagonia_2.jpg', 'Caminando entre montañas ....', '2023-07-30 15:41:02', '2023-07-30 15:41:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

CREATE TABLE `likes` (
  `id` int(255) NOT NULL,
  `user_id` int(255) DEFAULT NULL,
  `image_id` int(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `image_id`, `created_at`, `updated_at`) VALUES
(21, 4, 8, '2023-07-24 19:48:27', '2023-07-24 19:48:27'),
(28, 4, 11, '2023-07-28 20:02:16', '2023-07-28 20:02:16'),
(29, 4, 10, '2023-07-28 20:02:18', '2023-07-28 20:02:18'),
(30, 4, 14, '2023-07-30 14:34:47', '2023-07-30 14:34:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `role` varchar(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `surname` varchar(200) DEFAULT NULL,
  `nick` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `surname`, `nick`, `email`, `password`, `image`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'user', 'Roberto', 'Carlos', 'Robert', 'rcarlos@hotmail.com', 'pass', NULL, '2023-06-25 08:27:00', '2023-06-25 08:27:00', NULL),
(2, 'user', 'Juan', 'Lopez', 'JLopez', 'juanlopez@gmail.com', 'pass', NULL, '2023-06-25 08:29:44', '2023-06-25 08:29:44', NULL),
(3, 'user', 'Ramon', 'Perez', 'Raymond', 'rperez@hotmail.com', 'pass', NULL, '2023-06-25 08:29:44', '2023-06-25 08:29:44', NULL),
(4, 'admin', 'Hernan', 'San Martin', 'hernansm1983', 'admin@admin.com', '$2y$10$EeRhh3Ph.z028CBC1J5I5Okd5crWjjXR0JDdBPIiGy68mj6m38pfq', '1688227094foto_perfil.jpg', '2023-06-28 19:02:35', '2023-07-27 23:41:04', NULL),
(5, NULL, 'Hernan', 'San Martin', 'Ninja', 'her_san_martin@hotmail.com', '$2y$10$HyHFmJZbyHJ4nLqZKotPieppp3oX7NdVIj8cfSS212NBq6io7AMg2', NULL, '2023-06-28 20:10:53', '2023-06-28 20:10:53', NULL),
(6, NULL, 'Ernesto', 'Sabato', 'Tito83', 'tito@raymond.com', '$2y$10$BcaFojP5Y9HK8r.IWb2MWOQfW1JjIJ.7MlAxorAKPTZKUdEz8LnN.', NULL, '2023-06-29 22:04:30', '2023-06-29 22:04:30', NULL),
(7, 'user', 'Carlos', 'Bianchi', 'cbianchi', 'carlitos@charles.com', '$2y$10$6ioHp5G.L2Cs9/2PKMGuDOD7eAlxUzWF.ukj5W72T7wR/Th1x087K', NULL, '2023-06-29 22:06:56', '2023-06-29 22:06:56', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comments_users` (`user_id`),
  ADD KEY `fk_comments_images` (`image_id`);

--
-- Indices de la tabla `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_images_users` (`user_id`);

--
-- Indices de la tabla `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_likes_users` (`user_id`),
  ADD KEY `fk_likes_images` (`image_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `images`
--
ALTER TABLE `images`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_images` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`),
  ADD CONSTRAINT `fk_comments_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `fk_images_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `fk_likes_images` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`),
  ADD CONSTRAINT `fk_likes_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
