-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2023 at 10:04 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gym-1`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230126123244', '2023-01-26 13:32:56', 68),
('DoctrineMigrations\\Version20230131120521', '2023-01-31 13:05:26', 86),
('DoctrineMigrations\\Version20230131120733', '2023-01-31 13:07:36', 55),
('DoctrineMigrations\\Version20230131142609', '2023-01-31 15:26:18', 55),
('DoctrineMigrations\\Version20230131142828', '2023-01-31 15:28:35', 56),
('DoctrineMigrations\\Version20230131143633', '2023-01-31 15:36:41', 81),
('DoctrineMigrations\\Version20230131144233', '2023-01-31 15:42:43', 93),
('DoctrineMigrations\\Version20230131145416', '2023-01-31 15:54:24', 148),
('DoctrineMigrations\\Version20230201091105', '2023-02-01 10:11:13', 136),
('DoctrineMigrations\\Version20230201154553', '2023-02-01 16:46:00', 110);

-- --------------------------------------------------------

--
-- Table structure for table `lessen`
--

CREATE TABLE `lessen` (
  `id` int(11) NOT NULL,
  `training_id` int(11) NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_persons` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lessen`
--

INSERT INTO `lessen` (`id`, `training_id`, `instructor_id`, `date`, `time`, `location`, `max_persons`) VALUES
(1, 1, 3, '2023-02-10', '14:00:00', 'Zuiderpark', 12),
(2, 2, 5, '2023-02-12', '15:00:00', 'Centrum', 8),
(3, 1, 3, '2023-01-14', '11:00:00', 'Zuiderpark', 12),
(6, 4, 11, '2023-02-28', '09:13:39', 'malta', 20),
(7, 6, 11, '2023-02-19', '15:20:39', 'roma', 22),
(8, 3, 5, '2023-02-22', '14:26:29', 'USA', 12),
(9, 7, 5, '2023-02-20', '10:00:00', 'Centrum', 50),
(10, 3, 14, '2023-01-05', '00:00:00', 'Den Haag', 23);

-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `payment` smallint(6) NOT NULL,
  `member_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `payment`, `member_id`, `lesson_id`) VALUES
(13, 0, 3, 1),
(16, 0, 3, 2),
(17, 0, 4, 2),
(18, 0, 4, 3),
(19, 0, 4, 1),
(20, 0, 12, 6),
(21, 0, 12, 2),
(23, 0, 14, 6),
(24, 0, 13, 6);

-- --------------------------------------------------------

--
-- Table structure for table `training`
--

CREATE TABLE `training` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training`
--

INSERT INTO `training` (`id`, `name`, `description`, `image`, `duration`) VALUES
(1, 'Kickboxing', 'Kickboxing is a combat sport focused on kicking and punching. The fight takes place in a boxing ring, normally with boxing gloves, mouth guards, shorts, and bare feet to favor the use of kicks. Kickboxing is practiced for self-defense, general fitness, or for competition.', '78850f35f2a47da4c57ab9a5b5174379.jpg', 60),
(2, 'Punching bag training', 'A punchbag is a sturdy bag designed to be repeatedly punched. A punching bag is usually cylindrical, and filled with various materials of suitable hardness.', '60b478e1fb62d72d4b1cb7899b17f445.jpg', 30),
(3, 'Pads training', 'Pads training is an intensive workout for athletes who already master the basic boxing techniques. With pads you not only work on your technique, but it is also ideal for improving your endurance. In short: just relax and burn calories! Do you want to participate in a pads training and have you been boxing for at least a month?', '3f4dce55e03b3f7720315e08e671398c.jpg', 30),
(4, 'Brazilian Jiu-Jitsu', 'Brazilian jiu-jitsu is a self-defence martial art and combat sport based on grappling, ground fighting, and submission holds. BJJ approaches self-defense by emphasizing taking an opponent to the ground, gaining a dominant position, and using a number of techniques to force them into submission via joint locks or chokeholds.', '6df7a34564a91b95552793c8683a78e3.jpg', 45),
(5, 'BodyShaping', 'BodyShaping is an American fitness and exercise television series that has shown on ESPN, with segments on weight training, cardiovascular exercise, stretching and nutrition. It was in production from 1988 to 1998, and has been in reruns ever since.', '99d540859d90679448505c66ce4dd78c.jpg', 30),
(6, 'Fighting Bootcamp', 'In mixed martial arts (MMA), a training camp (also often referred to as a fight camp or just camp) is the period prior to an organised bout in which a fighter trains specifically for the upcoming event.', 'f19fd846398dc5d7543c04bdf71600bb.jpg', 90),
(7, 'Cardio Kickboxing', 'If you are looking for a high-energy, calorie-torching, cardio workout—look no further! Cardio kickboxing is an exciting group fitness class that engages multiple muscle groups and will be sure to leave you feeling stronger than ever before. Simply put, it is a kickboxing workout combined with a cardio pace. But let’s get into the specifics of cardio kickboxing and its benefits.', 'ddd661c994aca44cc1921e0b120da29c.jpg', 30),
(9, 'Ultimate Fighting Championship', 'Ultimate Fighting Championship (UFC) is de grootste mixed-martial-artsorganisatie ter wereld. Ze is het bezit van de Amerikaanse amusementsorganisatie WME-IMG, die haar in juli 2016 voor vier miljard dollar kocht van sportpromotiebedrijf Zuffa.', '7c120a3aa14e3ce273204c325024d4e6.jpg', 60);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `residence` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `firstname`, `lastname`, `birthday`, `gender`, `address`, `postcode`, `residence`, `username`) VALUES
(3, 'max@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$7roSRGCWfs8EBiS0SByXuOHfvxPhTN60/Lwz9XVZ4NNW0oL/MxgZC', 'Mark', 'Marko', '2012-05-06', 'Male', 'Amsterdamstraat', '1004AN', 'Amsterdam', 'Mark'),
(4, 'Kon@gmail.com', '[\"ROLE_MEMBER\"]', '$2y$13$EFoqSP9nRwSfLVkyp2Xr4Oy14h1tMar2qZSb236Eb5bCAzkVkPNka', 'Kon', 'Kon', '1992-02-03', 'Female', 'Amsterdamstraat', '1004AN', 'Amsterdam', 'Kon'),
(5, 'sam@gmail.com', '[\"ROLE_INSTRUCTOR\"]', '$2y$13$dvTGyMTHUrGGux15ENwpX.Cu3gSk61DxcYFSQkffudHf3fiEI8Lue', 'Sam', 'Sam', '1996-10-25', 'Male', 'Amsterdamstraat', '1004AN', 'Amsterdam', 'Sam'),
(11, 'rok@gmail.com', '[\"ROLE_INSTRUCTOR\"]', '$2y$13$4y9RevozDOCM79KurkFHWO1YrbFnRcY33ZvjgU1zs..JPWBU6b2Ku', 'rok', 'rok', '1903-01-01', 'Male', 'roma', '1234', 'milan', 'rok'),
(12, 'drago@gmail.com', '[\"ROLE_MEMBER\"]', '$2y$13$ULk1X6k525TCw61iEDw0NOP7D7VCYpyqqr66BCroKcJTDkWfiAolq', 'drago', 'drago', '1920-03-12', 'Female', 'londen', '42232', 'UK', 'drago'),
(13, 'Rambo@gmail.com', '[\"ROLE_MEMBER\"]', '$2y$13$a1RwJAXac5vYEW5SENs/zuuuwu/P7qZVlnNm2By0JPToCXZBBTUuW', 'Rambo', 'Rony', '1994-11-18', 'Male', 'Amsterdamstraat', '1004AN', 'Delft', 'Rambo'),
(14, 'Zakria@gmail.com', '[\"ROLE_INSTRUCTOR\"]', '$2y$13$gA/T/Tqli8BQY5ZTGsNDi.G0vFppZXk2nqWnumBIp4R7TzZkjZ9i.', 'Zakria', 'Ennaji', '2000-10-04', 'Male', 'Amsterdamstraat', '1004AN', 'Den Haag', 'Zakria');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `lessen`
--
ALTER TABLE `lessen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_29B9C79BEFD98D1` (`training_id`),
  ADD KEY `IDX_29B9C798C4FC193` (`instructor_id`);

--
-- Indexes for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_62A8A7A77597D3FE` (`member_id`),
  ADD KEY `IDX_62A8A7A7CDF80196` (`lesson_id`);

--
-- Indexes for table `training`
--
ALTER TABLE `training`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lessen`
--
ALTER TABLE `lessen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `training`
--
ALTER TABLE `training`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lessen`
--
ALTER TABLE `lessen`
  ADD CONSTRAINT `FK_29B9C798C4FC193` FOREIGN KEY (`instructor_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_29B9C79BEFD98D1` FOREIGN KEY (`training_id`) REFERENCES `training` (`id`);

--
-- Constraints for table `registration`
--
ALTER TABLE `registration`
  ADD CONSTRAINT `FK_62A8A7A77597D3FE` FOREIGN KEY (`member_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_62A8A7A7CDF80196` FOREIGN KEY (`lesson_id`) REFERENCES `lessen` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
