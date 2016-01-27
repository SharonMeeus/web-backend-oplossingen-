-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 27 jan 2016 om 04:27
-- Serverversie: 5.6.26
-- PHP-versie: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todo`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2016_01_26_113047_create_users_table', 1),
('2016_01_26_114453_create_todos_table', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `todos`
--

CREATE TABLE IF NOT EXISTS `todos` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `nametodo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `done` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `todos`
--

INSERT INTO `todos` (`id`, `user_id`, `nametodo`, `done`, `created_at`, `updated_at`) VALUES
(3, 1, 'lalala', 1, '2016-01-27 02:46:53', '2016-01-27 01:46:53'),
(4, 1, 'lala', 0, '2016-01-27 02:46:51', '2016-01-27 01:46:51'),
(6, 13, 'Gig met Miles', 0, '2016-01-26 22:16:57', '2016-01-26 22:16:57'),
(7, 13, 'Parker blues repeteren', 1, '2016-01-26 23:17:18', '2016-01-26 22:17:18'),
(8, 2, 'test1', 0, '2016-01-26 22:19:02', '2016-01-26 22:19:02'),
(9, 2, 'test2', 0, '2016-01-26 22:19:07', '2016-01-26 22:19:07'),
(10, 2, 'test3', 0, '2016-01-26 22:19:12', '2016-01-26 22:19:12'),
(11, 3, 'test1', 0, '2016-01-26 22:19:56', '2016-01-26 22:19:56'),
(12, 3, 'test2', 0, '2016-01-26 22:20:01', '2016-01-26 22:20:01'),
(13, 3, 'test3', 0, '2016-01-26 22:20:05', '2016-01-26 22:20:05'),
(14, 4, 'task1', 1, '2016-01-26 23:22:20', '2016-01-26 22:22:20'),
(15, 4, 'task2', 1, '2016-01-26 23:22:21', '2016-01-26 22:22:21'),
(16, 4, 'task3', 1, '2016-01-26 23:22:22', '2016-01-26 22:22:22'),
(17, 5, 'example1', 1, '2016-01-26 23:23:15', '2016-01-26 22:23:15'),
(18, 5, 'example2', 0, '2016-01-26 22:23:08', '2016-01-26 22:23:08'),
(19, 5, 'example3', 0, '2016-01-26 22:23:13', '2016-01-26 22:23:13'),
(20, 6, 'Get into the 27 club', 1, '2016-01-26 23:25:35', '2016-01-26 22:25:35'),
(21, 6, 'release album ''Lioness: Hidden Treasures''', 0, '2016-01-26 22:25:33', '2016-01-26 22:25:33'),
(22, 7, 'Sing like a star', 1, '2016-01-26 23:26:38', '2016-01-26 22:26:38'),
(23, 7, 'Be happy', 1, '2016-01-26 23:26:46', '2016-01-26 22:26:46'),
(25, 8, 'Divorce', 0, '2016-01-27 03:19:22', '2016-01-27 02:19:22'),
(26, 9, 'Put my guitar on fire', 1, '2016-01-26 23:29:07', '2016-01-26 22:29:07'),
(27, 9, 'Play Wind Cries Mary', 0, '2016-01-26 22:29:18', '2016-01-26 22:29:18'),
(28, 11, 'Write chord progressions on wall', 0, '2016-01-27 01:35:28', '2016-01-27 00:35:28'),
(29, 11, 'Invent Parker Blues', 1, '2016-01-27 01:34:55', '2016-01-27 00:34:55'),
(30, 12, 'Chill with Dave Brubeck', 0, '2016-01-26 22:31:53', '2016-01-26 22:31:53'),
(31, 12, 'Play some more Bossa ', 0, '2016-01-26 22:32:04', '2016-01-26 22:32:04'),
(32, 13, 'Recover from lung cancer', 0, '2016-01-26 22:34:20', '2016-01-26 22:34:20'),
(33, 10, 'Stop being blue', 1, '2016-01-27 01:37:52', '2016-01-27 00:37:52'),
(35, 8, 'Put frustration and past through sarcasm into songs', 1, '2016-01-27 01:43:13', '2016-01-27 00:43:13'),
(36, 8, 'Call Nina Simone', 1, '2016-01-27 03:19:16', '2016-01-27 02:19:16'),
(39, 7, 'Rehearse with Louis Armstrong', 1, '2016-01-27 03:04:05', '2016-01-27 02:04:05'),
(40, 6, 'Go to rehab', 0, '2016-01-27 03:25:26', '2016-01-27 02:25:26');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `emailadres` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `emailadres`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'test1@gmail.com', '$2y$10$.3VfOEGRMYPxJLE1bzrWhuFiF2V6efKIFzJWiL17pHqQDTWY0akM.', 'NTBVRUJ4Joc43D7oCcEaDGrdu06IPTXGwHS3gvs0j1CaCwRziSWAJcxbHFpD', '2016-01-27 02:46:59', '2016-01-27 01:46:59'),
(2, 'test2@gmail.com', '$2y$10$ttc796lQMkN5wtJgx8780eRC5tLU792k6F6yoR8nC8BSFijdXQgCS', 'XZMTFQMks7W7NQrbGnp0B76ojsJyI6bUlqOxyWhFmPufyg28DREQQ0hnHJfd', '2016-01-26 23:19:41', '2016-01-26 22:19:41'),
(3, 'test3@gmail.com', '$2y$10$73Ru.RJGAMS.19TTkjyef.7CmxpaoygAk5iN7D6aAKcep8j03ExRa', '8FaHz0bVkdivUEOlLQpw9VlR6lAH6G1oRT4nAjU9nuw60pKsY2ywBco6SBSM', '2016-01-26 23:20:07', '2016-01-26 22:20:07'),
(4, 'user@hotmail.com', '$2y$10$.wvRMVpUu.WjJaPey3FKzOzScbSbJoSdf28tCqbZtMhgTFSCYkHy6', 'KuzHfXPNMBkOg7T9EpXQcpJJtqvHdyEdIfEym4l8on8weD5ajYCiFvSJi0QZ', '2016-01-26 23:22:27', '2016-01-26 22:22:27'),
(5, 'example@example.com', '$2y$10$r1pqZwaEk3jGy5.nsRpinOz9Cd0PWcM224QgtOIQ/8evswowxgTIu', 'IhqRMJYouMPPl5z2tCMD0B0qJLySfsMsbE11ij7HPskRpxpglAXdZXmEPT9R', '2016-01-26 23:23:18', '2016-01-26 22:23:18'),
(6, 'amy.winehouse@gmail.com', '$2y$10$yhuZSJjI4XEtz8lVP1fkjOCfoLpC0pAcXhgfSExHu4l9nuHun/PuO', 'qCBx68ON9zkVVftPxJOdXx7bsgVdz8YsecP4nZheiA72e94OH69OkRJ6hvVD', '2016-01-27 01:05:31', '2016-01-27 00:05:31'),
(7, 'ella.fitzgerald@gmail.com', '$2y$10$idHtErhM3vRE7eCC.m9TYuzTQCYIgUHSLzRCNceN9sKpBmnYAb09K', 'RtYHkM0Tfaa2pdvtOAeK5fhfpJU5he1IzmGVNdvnyRlndKbiAiy7z1ENKpBU', '2016-01-27 03:17:22', '2016-01-27 02:17:22'),
(8, 'billie.holiday@gmail.com', '$2y$10$budWcw2e4nsouSTpjOPoze3DqIrAUPRbxYbWqIOpfhTcFwX4Pbj3e', 'YE8G1QogC2MvUkg2u9nNDvNArvUa5h6ntPNVWKnQQ7u18ChIIRBb2Mc6Rc2Q', '2016-01-27 03:23:56', '2016-01-27 02:23:56'),
(9, 'Jimi.Hendrix@gmail.com', '$2y$10$qAsZEL5TxYXgtR0xCQXYWOoqd4YNGaDwFyHO5qnqtfHI/xDep4EH2', 'VD7IPwNTvVEcPJzEpBzyghgedPp2d6lPLxPPEx50srAx9EuNFgRDTQD3En6X', '2016-01-26 23:29:20', '2016-01-26 22:29:20'),
(10, 'Miles.Davis@gmail.com', '$2y$10$XqARGK9vBrrfPTXftIkGCOEJ5TnGTD2kiy1s/wFScpKccO7ku45Ka', 'FM9Ti5wLjoemSNJ2IWnf4E3hH9j3cwmRir90IlsAlj4dr9yjeEQmFAgCjESb', '2016-01-27 01:38:11', '2016-01-27 00:38:11'),
(11, 'Charlie.Parker@gmail.com', '$2y$10$Uof6SEZnc9G/FcaTynXwh.JRTYF0cbUah/KuvSnD8iiL5rKkTAmgW', 'fbfHrvF6Oqgjbt0WlNuMoZK4eir1NcCNfCKfDv4KVenbJv1lZNM4bwVW3JLO', '2016-01-27 01:35:46', '2016-01-27 00:35:46'),
(12, 'Stan.Getz@gmail.com', '$2y$10$8Pd7jtx0xmTVHiayDpHz4.6YFueh/5l9ILwj4NqSBgt/SCUF4OpZS', 'PoHTAJKEZmyXf4J2PE1GpSRmnKQOLDK0FL6ylYjFwN25cqmusStzS3l6pBG6', '2016-01-26 23:32:10', '2016-01-26 22:32:10'),
(13, 'Sarah.Vaughan@gmail.com', '$2y$10$Rj3OCixghAVaqIKh7vgl6OIQhpc7AidInpT3XO5CiAhPv1jSFS8Sm', 'qCJ53W00SO4tVTaNsfQsO6Zgwzeyh8Na59Mz1cjp2j3ryF5tL0wq1xdOGqJ1', '2016-01-26 23:35:21', '2016-01-26 22:35:21');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `todos`
--
ALTER TABLE `todos`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `todos`
--
ALTER TABLE `todos`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
