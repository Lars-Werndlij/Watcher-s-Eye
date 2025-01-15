DROP DATABASE IF EXISTS `watcherseye`;

CREATE DATABASE `watcherseye`;

USE `watcherseye`;


CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `type` enum('film','serie') NOT NULL,
  `name` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `length_in_minutes` int(11) NOT NULL,
  `rating` tinyint(4) DEFAULT NULL,
  `trailer_url` varchar(255) NOT NULL,
  `wiki_page` varchar(255) NOT NULL,
  `producer` varchar(255) NOT NULL,
  `main_cast` text NOT NULL,
  `release_date` date NOT NULL,
  `streaming` tinyint(4) NOT NULL,
  `cinema` tinyint(4) NOT NULL,
  `poster` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(2048) DEFAULT NULL,
  `email` varchar(2048) DEFAULT NULL,
  `password` varchar(2048) DEFAULT NULL,
  `favorite_genre` varchar(2048) DEFAULT NULL,
  `watchtime` int(11) DEFAULT NULL,
  `rank` varchar(2048) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_media`
--

CREATE TABLE `user_media` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `favorited` tinyint(4) NOT NULL,
  `watch_status` enum('nog niet gekeken','aan het kijken','gekeken') NOT NULL,
  `rating` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);
-- Indexen voor tabel `user_media`
--
ALTER TABLE `user_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_foreign` (`user_id`),
  ADD KEY `media_foreign` (`media_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `user_media`
--
ALTER TABLE `user_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `user_media`
--
ALTER TABLE `user_media`
  ADD CONSTRAINT `user_media_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_media_ibfk_2` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`);
