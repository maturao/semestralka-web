-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Ned 10. led 2021, 00:16
-- Verze serveru: 5.7.17
-- Verze PHP: 7.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `semestralka-web`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `maturao_article`
--

CREATE TABLE `maturao_article` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `display_name` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `abstract` text COLLATE utf8_czech_ci NOT NULL,
  `pdf_file` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `id_article_state` varchar(255) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `maturao_article`
--

INSERT INTO `maturao_article` (`id`, `id_user`, `display_name`, `abstract`, `pdf_file`, `id_article_state`) VALUES
(6, 7, 'Drátová fragmentace', 'Etiam commodo dui eget wisi. Donec quis nibh at felis congue commodo. Fusce dui leo, imperdiet in, aliquam sit amet, feugiat eu, orci. In dapibus augue non sapien. Nulla quis diam. Integer in sapien. Nunc dapibus tortor vel mi dapibus sollicitudin. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Duis sapien nunc, commodo et, interdum suscipit, sollicitudin et, dolor. Donec iaculis gravida nulla. Aenean id metus id velit ullamcorper pulvinar. Maecenas ipsum velit, consectetuer eu lobortis ut, dictum at dui. Integer in sapien. Duis condimentum augue id magna semper rutrum.\r\n\r\nIn rutrum. Fusce nibh. Maecenas aliquet accumsan leo. Donec iaculis gravida nulla. Fusce suscipit libero eget elit. Sed convallis magna eu sem. Etiam sapien elit, consequat eget, tristique non, venenatis quis, ante. Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? Nullam sapien sem, ornare ac, nonummy non, lobortis a enim. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat. Integer malesuada. Mauris tincidunt sem sed arcu. Aliquam erat volutpat. Sed convallis magna eu sem. Nulla non arcu lacinia neque faucibus fringilla. Nullam justo enim, consectetuer nec, ullamcorper ac, vestibulum in, elit. Nullam lectus justo, vulputate eget mollis sed, tempor sed magna. Fusce nibh. Praesent id justo in neque elementum ultrices. Nullam rhoncus aliquam metus.', 'upload/article1610217018.pdf', 'denied'),
(7, 7, 'Temporální vlákno', 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris elementum mauris vitae tortor. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Aenean vel massa quis mauris vehicula lacinia. Vivamus luctus egestas leo. Nullam at arcu a est sollicitudin euismod. Duis condimentum augue id magna semper rutrum. Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? Donec quis nibh at felis congue commodo. Integer malesuada.', 'upload/article1610217189.pdf', 'accepted'),
(8, 7, 'Zkreslení paměti', 'Duis viverra diam non justo. Fusce dui leo, imperdiet in, aliquam sit amet, feugiat eu, orci. Duis risus. Vivamus luctus egestas leo. Proin pede metus, vulputate nec, fermentum fringilla, vehicula vitae, justo. Suspendisse sagittis ultrices augue. Vivamus luctus egestas leo. Quisque tincidunt scelerisque libero. Mauris tincidunt sem sed arcu. Duis pulvinar. Et harum quidem rerum facilis est et expedita distinctio. Phasellus faucibus molestie nisl. Quisque tincidunt scelerisque libero. Duis pulvinar. Sed ac dolor sit amet purus malesuada congue. Praesent id justo in neque elementum ultrices. Nulla quis diam. Duis bibendum, lectus ut viverra rhoncus, dolor nunc faucibus libero, eget facilisis enim ipsum id lacus.', 'upload/article1610217223.pdf', 'reviewing'),
(9, 7, 'Digitální odpor', 'Aenean vel massa quis mauris vehicula lacinia. Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. Suspendisse nisl. Suspendisse sagittis ultrices augue. Nulla accumsan, elit sit amet varius semper, nulla mauris mollis quam, tempor suscipit diam nulla vel leo. Nulla non lectus sed nisl molestie malesuada. Aliquam erat volutpat. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Duis sapien nunc, commodo et, interdum suscipit, sollicitudin et, dolor. Nullam dapibus fermentum ipsum. Praesent vitae arcu tempor neque lacinia pretium. Proin in tellus sit amet nibh dignissim sagittis.', 'upload/article1610217270.pdf', 'accepted'),
(10, 6, 'Vnitřní fragmentace', 'Fusce nibh. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Vivamus porttitor turpis ac leo. Aenean fermentum risus id tortor. Fusce consectetuer risus a nunc. Aenean fermentum risus id tortor. Nam sed tellus id magna elementum tincidunt. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Pellentesque sapien. Duis ante orci, molestie vitae vehicula venenatis, tincidunt ac pede. Fusce tellus odio, dapibus id fermentum quis, suscipit id erat. Fusce wisi. Fusce aliquam vestibulum ipsum.', 'upload/article1610217329.pdf', 'reviewing'),
(11, 6, 'Virtuální kapacita', 'Pellentesque ipsum. Nullam dapibus fermentum ipsum. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Etiam quis quam. Mauris tincidunt sem sed arcu. Nulla accumsan, elit sit amet varius semper, nulla mauris mollis quam, tempor suscipit diam nulla vel leo. In rutrum. Curabitur bibendum justo non orci. Proin pede metus, vulputate nec, fermentum fringilla, vehicula vitae, justo. In rutrum. Suspendisse nisl. Vivamus ac leo pretium faucibus. Sed ac dolor sit amet purus malesuada congue. Integer pellentesque quam vel velit. Nullam at arcu a est sollicitudin euismod. Phasellus enim erat, vestibulum vel, aliquam a, posuere eu, velit.', 'upload/article1610217361.pdf', 'accepted'),
(12, 6, 'Lineární odchylka', 'Pellentesque arcu. Nullam eget nisl. Nullam lectus justo, vulputate eget mollis sed, tempor sed magna. Integer tempor. Nunc tincidunt ante vitae massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Cras pede libero, dapibus nec, pretium sit amet, tempor quis. Proin mattis lacinia justo. Donec vitae arcu. Mauris elementum mauris vitae tortor. Duis bibendum, lectus ut viverra rhoncus, dolor nunc faucibus libero, eget facilisis enim ipsum id lacus. Fusce aliquam vestibulum ipsum. Aenean vel massa quis mauris vehicula lacinia. Vestibulum fermentum tortor id mi. Et harum quidem rerum facilis est et expedita distinctio. Fusce aliquam vestibulum ipsum. Nullam at arcu a est sollicitudin euismod. Suspendisse sagittis ultrices augue. Fusce wisi.\r\n\r\nPhasellus rhoncus. Donec ipsum massa, ullamcorper in, auctor et, scelerisque sed, est. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat. Praesent in mauris eu tortor porttitor accumsan. Fusce wisi. Vestibulum fermentum tortor id mi. Integer vulputate sem a nibh rutrum consequat. Nulla quis diam. Nunc tincidunt ante vitae massa. In sem justo, commodo ut, suscipit at, pharetra vitae, orci. Mauris metus. Fusce aliquam vestibulum ipsum. Etiam egestas wisi a erat. Pellentesque ipsum.', 'upload/article1610217400.pdf', 'accepted'),
(13, 6, 'Fázované zarovnání', 'Cras elementum. Aliquam erat volutpat. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Fusce consectetuer risus a nunc. Duis pulvinar. Praesent dapibus. Nunc dapibus tortor vel mi dapibus sollicitudin. Vivamus ac leo pretium faucibus. Fusce dui leo, imperdiet in, aliquam sit amet, feugiat eu, orci. Curabitur vitae diam non enim vestibulum interdum. Sed vel lectus. Donec odio tempus molestie, porttitor ut, iaculis quis, sem. Suspendisse sagittis ultrices augue. Nullam justo enim, consectetuer nec, ullamcorper ac, vestibulum in, elit. Fusce aliquam vestibulum ipsum. Aenean vel massa quis mauris vehicula lacinia. Nullam sapien sem, ornare ac, nonummy non, lobortis a enim. Sed vel lectus. Donec odio tempus molestie, porttitor ut, iaculis quis, sem. Nam quis nulla. Cras pede libero, dapibus nec, pretium sit amet, tempor quis.', 'upload/article1610217466.pdf', 'reviewing');

-- --------------------------------------------------------

--
-- Struktura tabulky `maturao_article_state`
--

CREATE TABLE `maturao_article_state` (
  `id` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `maturao_article_state`
--

INSERT INTO `maturao_article_state` (`id`, `display_name`) VALUES
('accepted', 'Schválen'),
('denied', 'Zamítnut'),
('reviewing', 'V hodnocení');

-- --------------------------------------------------------

--
-- Zástupná struktura pro pohled `maturao_article_view`
-- (See below for the actual view)
--
CREATE TABLE `maturao_article_view` (
`id` int(10) unsigned
,`id_user` int(10) unsigned
,`display_name` varchar(255)
,`abstract` text
,`pdf_file` varchar(255)
,`id_article_state` varchar(255)
,`user` varchar(60)
,`article_state` varchar(255)
,`review_count` bigint(21)
);

-- --------------------------------------------------------

--
-- Struktura tabulky `maturao_review`
--

CREATE TABLE `maturao_review` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `id_article` int(10) UNSIGNED NOT NULL,
  `content_quality` tinyint(3) UNSIGNED DEFAULT NULL,
  `technical_quality` tinyint(3) UNSIGNED DEFAULT NULL,
  `language_quality` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `maturao_review`
--

INSERT INTO `maturao_review` (`id`, `id_user`, `id_article`, `content_quality`, `technical_quality`, `language_quality`) VALUES
(9, 8, 6, 76, 54, 87),
(10, 11, 6, 43, 56, 57),
(11, 9, 6, 1, 3, 4),
(12, 10, 6, 23, 14, 86),
(13, 8, 7, 33, 23, 10),
(14, 10, 7, 66, 45, 34),
(15, 11, 7, 32, 12, 23),
(16, 8, 8, NULL, 51, NULL),
(17, 9, 8, NULL, NULL, NULL),
(18, 10, 8, 34, 10, 25),
(19, 9, 9, 77, 69, 56),
(20, 11, 9, 100, 100, 100),
(21, 10, 10, 43, 76, 88),
(22, 10, 11, NULL, NULL, NULL),
(23, 9, 11, 100, 99, 88),
(24, 8, 11, 54, 34, 75),
(25, 11, 11, 76, 79, 69),
(26, 9, 12, 76, 68, 51),
(27, 8, 12, 37, 86, 99),
(28, 11, 12, 100, 74, 87),
(29, 9, 13, 45, 41, 33),
(30, 10, 13, 99, 86, 77),
(31, 11, 13, NULL, NULL, NULL),
(32, 8, 9, 87, 79, 52);

-- --------------------------------------------------------

--
-- Zástupná struktura pro pohled `maturao_review_view`
-- (See below for the actual view)
--
CREATE TABLE `maturao_review_view` (
`id` int(10) unsigned
,`id_user` int(10) unsigned
,`id_article` int(10) unsigned
,`content_quality` tinyint(3) unsigned
,`technical_quality` tinyint(3) unsigned
,`language_quality` tinyint(3) unsigned
,`user` varchar(60)
,`article` varchar(255)
,`id_article_state` varchar(255)
);

-- --------------------------------------------------------

--
-- Struktura tabulky `maturao_role`
--

CREATE TABLE `maturao_role` (
  `id` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `maturao_role`
--

INSERT INTO `maturao_role` (`id`, `display_name`) VALUES
('admin', 'Admin'),
('author', 'Autor'),
('reviewer', 'Recenzent');

-- --------------------------------------------------------

--
-- Struktura tabulky `maturao_user`
--

CREATE TABLE `maturao_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `login` varchar(60) COLLATE utf8_czech_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_czech_ci NOT NULL,
  `id_role` varchar(255) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `maturao_user`
--

INSERT INTO `maturao_user` (`id`, `login`, `password`, `id_role`) VALUES
(1, 'admin', '$2y$10$b1wu85RPJ793mQq2V.Iy5u1hMZAU6N90yDkCfYbuNtC.kb5Dw/wrW', 'admin'),
(6, 'AutorPepek', '$2y$10$uOWn9iGgnGcSfgwvYhlqsuAhtztD6s9IEC8k5yO1.jbCo8mQDFNue', 'author'),
(7, 'AutorAdam', '$2y$10$P1.uY6xpM6KAdM06T4iBUel.hsOjIQ1eMLmEGW80zf2j.FovuBm1y', 'author'),
(8, 'RecenzentRadek', '$2y$10$X1QZugZX8vj7t20XCjhb.ey7HTu6.CyGUnxD9LfLTojVdxqREy88W', 'reviewer'),
(9, 'RecenzentKarel', '$2y$10$lL6oGEJrFYMwIpLpnsveWe6dYemQIBngmSI55TKk719Sc/pGHpMwm', 'reviewer'),
(10, 'RecenzentMarek', '$2y$10$vZsVj.sK/6e90Te0IwpZCet3PzQMnKEpIEsNLpvVw08maKS3Zjbbe', 'reviewer'),
(11, 'RecenzentVlasta', '$2y$10$ix0L.KN8WPFOkR//ouPmUukr33YI.w8iLKP1VARRjDv8nmP4B0taG', 'reviewer');

-- --------------------------------------------------------

--
-- Zástupná struktura pro pohled `maturao_user_view`
-- (See below for the actual view)
--
CREATE TABLE `maturao_user_view` (
`id` int(10) unsigned
,`login` varchar(60)
,`password` varchar(60)
,`id_role` varchar(255)
,`role` varchar(255)
);

-- --------------------------------------------------------

--
-- Struktura pro pohled `maturao_article_view`
--
DROP TABLE IF EXISTS `maturao_article_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `maturao_article_view`  AS  select `maturao_article`.`id` AS `id`,`maturao_article`.`id_user` AS `id_user`,`maturao_article`.`display_name` AS `display_name`,`maturao_article`.`abstract` AS `abstract`,`maturao_article`.`pdf_file` AS `pdf_file`,`maturao_article`.`id_article_state` AS `id_article_state`,`maturao_user`.`login` AS `user`,`maturao_article_state`.`display_name` AS `article_state`,(select count(`maturao_review`.`id`) from `maturao_review` where ((`maturao_review`.`id_article` = `maturao_article`.`id`) and (`maturao_review`.`content_quality` is not null) and (`maturao_review`.`technical_quality` is not null) and (`maturao_review`.`language_quality` is not null))) AS `review_count` from ((`maturao_article` join `maturao_user` on((`maturao_article`.`id_user` = `maturao_user`.`id`))) join `maturao_article_state` on((`maturao_article`.`id_article_state` = `maturao_article_state`.`id`))) ;

-- --------------------------------------------------------

--
-- Struktura pro pohled `maturao_review_view`
--
DROP TABLE IF EXISTS `maturao_review_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `maturao_review_view`  AS  select `maturao_review`.`id` AS `id`,`maturao_review`.`id_user` AS `id_user`,`maturao_review`.`id_article` AS `id_article`,`maturao_review`.`content_quality` AS `content_quality`,`maturao_review`.`technical_quality` AS `technical_quality`,`maturao_review`.`language_quality` AS `language_quality`,`maturao_user`.`login` AS `user`,`maturao_article`.`display_name` AS `article`,`maturao_article`.`id_article_state` AS `id_article_state` from ((`maturao_review` join `maturao_user` on((`maturao_review`.`id_user` = `maturao_user`.`id`))) join `maturao_article` on((`maturao_review`.`id_article` = `maturao_article`.`id`))) ;

-- --------------------------------------------------------

--
-- Struktura pro pohled `maturao_user_view`
--
DROP TABLE IF EXISTS `maturao_user_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `maturao_user_view`  AS  select `maturao_user`.`id` AS `id`,`maturao_user`.`login` AS `login`,`maturao_user`.`password` AS `password`,`maturao_user`.`id_role` AS `id_role`,`maturao_role`.`display_name` AS `role` from (`maturao_user` join `maturao_role` on((`maturao_user`.`id_role` = `maturao_role`.`id`))) ;

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `maturao_article`
--
ALTER TABLE `maturao_article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_maturao_article_maturao_user1_idx` (`id_user`),
  ADD KEY `fk_maturao_article_maturao_article_state1_idx` (`id_article_state`);

--
-- Klíče pro tabulku `maturao_article_state`
--
ALTER TABLE `maturao_article_state`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `maturao_review`
--
ALTER TABLE `maturao_review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_maturao_review_maturao_user1_idx` (`id_user`),
  ADD KEY `fk_maturao_review_maturao_article1_idx` (`id_article`);

--
-- Klíče pro tabulku `maturao_role`
--
ALTER TABLE `maturao_role`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `maturao_user`
--
ALTER TABLE `maturao_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login_UNIQUE` (`login`),
  ADD KEY `fk_maturao_user_maturao_role_idx` (`id_role`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `maturao_article`
--
ALTER TABLE `maturao_article`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pro tabulku `maturao_review`
--
ALTER TABLE `maturao_review`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT pro tabulku `maturao_user`
--
ALTER TABLE `maturao_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `maturao_article`
--
ALTER TABLE `maturao_article`
  ADD CONSTRAINT `fk_maturao_article_maturao_article_state1` FOREIGN KEY (`id_article_state`) REFERENCES `maturao_article_state` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_maturao_article_maturao_user1` FOREIGN KEY (`id_user`) REFERENCES `maturao_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Omezení pro tabulku `maturao_review`
--
ALTER TABLE `maturao_review`
  ADD CONSTRAINT `fk_maturao_review_maturao_article1` FOREIGN KEY (`id_article`) REFERENCES `maturao_article` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_maturao_review_maturao_user1` FOREIGN KEY (`id_user`) REFERENCES `maturao_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Omezení pro tabulku `maturao_user`
--
ALTER TABLE `maturao_user`
  ADD CONSTRAINT `fk_maturao_user_maturao_role` FOREIGN KEY (`id_role`) REFERENCES `maturao_role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
