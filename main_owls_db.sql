-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2023 at 01:28 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `main_owls_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `subtitulo` varchar(100) NOT NULL,
  `conteudo` longtext NOT NULL,
  `data_cadastro` datetime NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `imagem` varchar(140) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cursos`
--

INSERT INTO `cursos` (`id`, `titulo`, `subtitulo`, `conteudo`, `data_cadastro`, `preco`, `imagem`) VALUES
(1, 'teste 1', 'Многие думают, что Lorem Ipsum - взятый с потолка псевдо-латинский набор слов,', 'Многие думают, что Lorem Ipsum - взятый с потолка псевдо-латинский набор слов, но это не совсем так. Его корни уходят в один фрагмент классической латыни 45 года н.э., то есть более двух тысячелетий назад. Ричард МакКлинток, профессор латыни из колледжа Hampden-Sydney, штат Вирджиния, взял одно из самых странных слов в Lorem Ipsum, \"consectetur\", и занялся его поисками в классической латинской литературе. В результате он нашёл неоспоримый первоисточник Lorem Ipsum в разделах 1.10.32 и 1.10.33 книги \"de Finibus Bonorum et Malorum\" (\"О пределах добра и зла\"), написанной Цицероном в 45 году н.э. Этот трактат по теории этики был очень популярен в эпоху Возрождения. Первая строка Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", происходит от одной из строк в разделе 1.10.32\r\n\r\nКлассический текст Lorem Ipsum, используемый с XVI века, приведён ниже. Также даны разделы 1.10.32 и 1.10.33 \"de Finibus Bonorum et Malorum\" Цицерона и их английский перевод, сделанный H. Rackham, 1914 год.', '2023-05-27 04:49:21', 450.00, './upload/64716fb1ecf30.jpg'),
(3, 'Почему он используется?', 'электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.', 'это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.\r\n\r\n', '2023-05-27 04:50:45', 37.00, './upload/647170587c361.jpg'),
(5, 'I got black, I got white, what you want? Hop outside a Ghost and hop up in a Phantom', 'I got black, I got white, what you want? Hop outside a Ghost and hop up in a Phantom I know I\'m \'bou', 'Turn you to a dancer\r\nYeah\r\nInternet Money, bitch\r\n\r\nI got black, I got white, what you want?\r\nHop outside a Ghost and hop up in a Phantom\r\nI know I\'m \'bout to blow, I ain\'t dumb\r\nThey try to take my flow, I take they ass for ransom\r\nI know that I\'m gone\r\nThey see me blowin\' up, now they say they want some\r\nI got two twin Glocks, turn you to a dancer\r\nI see two twin opps, leave \'em on a banner\r\nAnd I got two thick thots, wanna lick the gang, yeah\r\n\r\nI got red, I got blue, what you want?\r\nThe Chanel or Balenciaga, Louis and Vuitton\r\nShe know I got the Fendi, Prada when I hit Milan\r\nI needed me a die or rider, I need me the one\r\nI started from the bottom, you could see the way I stunt\r\nI want all the diamonds, I want that shit to weigh a ton\r\nThe opps, they tryna line me \'cause they hate the place I\'m from\r\nBut them niggas don\'t know me, they just know the place I\'m from\r\nI got lots of shawties tryna pull up to my place\r\nBut you ain\'t want me last year, so just get up out my face\r\nThey all up in my inbox, so I know they want a taste\r\nI know they want my downfall, lil\' nigga, are you laced?\r\n\r\nI got black, I got white, what you want?\r\nHop outside a Ghost and hop up in a Phantom\r\nI know I\'m \'bout to blow, I ain\'t dumb\r\nThey try to take my flow, I take they ass for ransom\r\nI know that I\'m gone\r\nThey see me blowin\' up, now they say they want some\r\nI got two twin Glocks, turn you to a dancer\r\nI see two twin opps, leave \'em on a banner\r\nAnd I got two thick thots, wanna lick the gang, yeah\r\n\r\n[Juice WRLD]\r\nI\'m in it to win it, I\'ma be the best, yes, sir\r\nStarted from the bottom, I ain\'t have no one, yes, sir\r\nHad to get big on them niggas, Bruce Banner\r\nBro split wigs, turn a nigga to a dancer\r\nI got hard, I got soft, what you want?\r\nSince the day that I\'ve been on, they been blowing up my phone\r\nI can\'t hear \'em, I got all this loud in my lungs\r\nThumbin\' through these blue faces while I\'m smoking on Runtz\r\nUh, I\'m in the hills (ooh, yeah), countin\' them bills (ooh, yeah)\r\nAll baguette diamonds (ooh, yeah), chandelier give her chills (yeah)\r\nFeel like yesterday I was just watching Fresh Prince (uh)\r\nNow the crib look like Bel-Air, rip to Uncle Phil\r\nMoney big, Uncle Phil, twin Glocks, Phil and Lil\r\nNiggas hate, Uncle Tom, spin them off me, carousel\r\nGet \'em off me, go to hell, silencer, kill \'em soft\r\nTecca\'ll take you for ransom, me, I\'ll put you in a coffin\r\n\r\n[Lil Tecca]\r\nI got black, I got white, what you want?\r\nHop outside a Ghost and hop up in a Phantom\r\nI know I\'m \'bout to blow, I ain\'t dumb\r\nThey try to take my flow, I take they ass for ransom\r\nI know that I\'m gone\r\nThey see me blowin\' up, now they say they want some\r\nI got two twin Glocks, turn you to a dancer\r\nI see two twin opps, leave \'em on a banner\r\nAnd I got two thick thots, wanna lick the gang, yeah\r\n\r\nclick here to open music \r\n\r\n<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/jQR9Kb-rbSM\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', '2023-05-29 01:23:49', 334.00, './upload/6473e285a4921.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `first_test`
--

CREATE TABLE `first_test` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `msg` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `first_test`
--

INSERT INTO `first_test` (`id`, `nome`, `email`, `msg`) VALUES
(1, 'guilherme', 'd@g.com', 'teste'),
(2, 'guilherme', 'd@g.com', 'fgfdsbfhgfh');

-- --------------------------------------------------------

--
-- Table structure for table `relatorio`
--

CREATE TABLE `relatorio` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `data_compra` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `relatorio`
--

INSERT INTO `relatorio` (`id`, `id_usuario`, `id_curso`, `valor`, `data_compra`) VALUES
(1, 2, 3, 37.00, '2023-05-29 02:58:14'),
(2, 2, 5, 334.00, '2023-05-29 02:58:19'),
(3, 2, 4, 29.00, '2023-05-29 03:02:00'),
(4, 4, 4, 29.00, '2023-06-06 19:52:16'),
(5, 4, 3, 37.00, '2023-06-06 19:52:27'),
(6, 4, 5, 334.00, '2023-06-06 19:52:36'),
(7, 6, 3, 37.00, '2023-08-30 22:07:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `senha` varchar(256) NOT NULL,
  `data_cadastro` datetime NOT NULL,
  `creditos` decimal(10,2) DEFAULT 0.00,
  `admin` tinyint(1) DEFAULT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nome`, `senha`, `data_cadastro`, `creditos`, `admin`, `email`) VALUES
(5, 'admin', '$2y$10$orbR4MBwMku9wVvt5ZYV1OyPkOdUQ4UFOGHxO1vz6GVBtJwNnyZEm', '2023-08-30 20:10:40', 0.00, 1, 'admin@admin.com'),
(6, 'aslann', '$2y$10$kO3BcuikfJHzW2L1SOXxFucqqUyblF/mCewujJV5P.B4eDMUrzS2q', '2023-08-30 21:55:40', 263.00, 0, 'aslann@g.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `first_test`
--
ALTER TABLE `first_test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relatorio`
--
ALTER TABLE `relatorio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `first_test`
--
ALTER TABLE `first_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `relatorio`
--
ALTER TABLE `relatorio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
