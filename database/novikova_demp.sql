-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 28, 2025 at 05:31 PM
-- Server version: 10.11.11-MariaDB-ubu2204
-- PHP Version: 8.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `novikova_demp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `name`) VALUES
(1, 'Администратор'),
(2, 'Пользователь');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `name_category` varchar(255) NOT NULL,
  `photo_category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_category`, `name_category`, `photo_category`) VALUES
(1, 'Стрижка', '68129818e06e1.jpg'),
(2, 'Маникюр', '6812982f16b3c.jpg'),
(3, 'Окрашивание волос', '6812983b94b88.jpg'),
(4, 'Прическа', '68129846b93ce.jpg'),
(5, 'Уход за телом', '681298522ee4e.jpg'),
(6, 'Уход за лицом', '6812985d05858.jpg'),
(7, 'Макияж', '6812987187cf9.jpg'),
(8, 'Брови', '6812987ccd76b.png'),
(9, 'Ресницы', '6812988a7dd25.png');

-- --------------------------------------------------------

--
-- Table structure for table `ordder`
--

CREATE TABLE `ordder` (
  `id_order` int(11) NOT NULL,
  `status` enum('Новый','Подтвержден','Отменен','Выполнен') NOT NULL,
  `created_at` datetime NOT NULL,
  `appointment_datetime` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ordder`
--

INSERT INTO `ordder` (`id_order`, `status`, `created_at`, `appointment_datetime`, `user_id`, `product_id`) VALUES
(101, 'Отменен', '2025-05-06 19:04:41', '2025-05-12 10:00:00', 11, 25),
(102, 'Отменен', '2025-05-20 16:46:04', '2025-05-21 09:00:00', 15, 6),
(103, 'Отменен', '2025-05-20 18:44:28', '2025-05-22 14:00:00', 15, 25),
(104, 'Новый', '2025-05-20 19:56:01', '2025-05-22 15:00:00', 15, 6);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id_product` int(11) NOT NULL,
  `photo_product` varchar(255) NOT NULL,
  `name_product` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id_product`, `photo_product`, `name_product`, `price`, `category_id`) VALUES
(6, 'assets/images/каре.png', 'Каре', 7000, 1),
(7, 'assets/images/пикси.png', 'Пикси', 1200, 1),
(15, 'assets/images/шатуш.jpg', 'Шатуш', 12000, 3),
(16, 'assets/images/балаяж.jpg', 'Балаяж', 15000, 3),
(17, 'assets/images/омбре.jpg', 'Омбре', 10000, 3),
(18, 'assets/images/однотонное.jpg', 'Однотонное', 5000, 3),
(19, 'assets/images/мелирование.jpg', 'Мелирование', 7000, 3),
(20, 'assets/images/боб.png', 'Боб', 3000, 1),
(21, 'assets/images/ровныйсрез.jpg', 'Ровный срез', 1500, 1),
(22, 'assets/images/лесенка.jpg', 'Лесенка', 1000, 1),
(23, 'assets/images/чёлка.png', 'Чёлка', 500, 1),
(24, 'assets/images/гельлак.png', 'Маникюр с гель лаком', 1500, 2),
(25, 'assets/images/классический.png', 'Классический маникюр', 2000, 2),
(26, 'assets/images/маникюрсдизайном.png', 'Маникюр с дизайном', 2500, 2),
(27, 'assets/images/френч.jpg', 'Френч', 1700, 2),
(28, 'assets/images/наращивание.jpeg', 'Наращивание ногтей', 3000, 2),
(29, 'assets/images/свадебная.jpg', 'Свадебная прическа', 5000, 4),
(30, 'assets/images/локоны.png', 'Завивка', 1000, 4),
(31, 'assets/images/пучок.jpg', 'Вечерняя прическа', 2000, 4),
(32, 'assets/images/гофре.jpg', 'Гофре', 3000, 4),
(33, 'assets/images/выпрямление.jpg', 'Выпрямление', 800, 4),
(34, 'assets/images/массаж.jpg', 'Массаж', 4500, 5),
(35, 'assets/images/пилинг.jpg', 'Пилинг', 4000, 5),
(36, 'assets/images/скраб.png', 'Скраб', 2000, 5),
(37, 'assets/images/обертывание.jpg', 'Обертывание', 2400, 5),
(38, 'assets/images/массаж_лица.jpg', 'Массаж', 1450, 6),
(39, 'assets/images/пилинг_лица.jpg', 'Пилинг', 1600, 6),
(41, 'assets/images/маска.jpg', 'Маски', 800, 6),
(42, 'assets/images/чистка.jpg', 'Чистка', 1000, 6),
(43, 'assets/images/лифтинг.png', 'Лифтинг', 4000, 6),
(44, 'assets/images/фотоомоложение.jpg', 'Фотоомоложение', 5000, 6),
(45, 'assets/images/смоки.jpg', 'Smoky Eyes', 2000, 7),
(46, 'assets/images/свадебный_макияж.jpg', 'Свадебный макияж', 7000, 7),
(47, 'assets/images/вечерний_макияж.jpg', 'Вечерний макияж', 1300, 7),
(48, 'assets/images/ежедневный_макияж.jpg', 'Ежедневный макияж', 1000, 7),
(49, 'assets/images/ламинирование.png\r\n', 'Ламинирование', 1200, 8),
(50, 'assets/images/коррекция_воском.jpg\r\n', 'Коррекция воском', 1000, 8),
(51, 'assets/images/долговременная_укладка.png\r\n', 'Долговременная укладка', 980, 8),
(52, 'assets/images/архитектура_бровей.png\r\n', 'Архитектура бровей', 1550, 8),
(53, 'assets/images/пудровое_напыление.jpg\r\n', 'Пудровое напыление', 650, 8),
(54, 'assets/images/ламинирование_ресниц.png', 'Ламинирование', 1000, 9),
(55, 'assets/images/окрашивание_ресниц.jpg', 'Окрашивание', 1100, 9),
(56, 'assets/images/наращивание_ресниц.png', 'Наращивание', 1200, 9);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `patronymic` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `name`, `surname`, `patronymic`, `login`, `email`, `password`, `id_admin`) VALUES
(1, 'админ', 'админов', 'админович', 'admin', 'admin1@gmail.com', 'admin44', 1),
(2, 'Валерий', 'Альбертович', 'Альбертов', 'valerii4', 'valerii@gmail.com', 'password7', 2),
(11, 'Никита', 'Забивной', 'Васильевич', 'nikita', 'nikita1@mail.ru', 'nikita', 2),
(12, 'Полина', 'Денисова', 'Владимировна', 'polin4ka', 'polina@mail.ru', 'polina4', 2),
(14, 'Анна', 'Смирнова', 'Александровна', 'anna5', 'anna@mail.ru', 'Anna56', 2),
(15, 'тест', 'тест', 'тест', 'test', 'test@test.ru', 'test11', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `ordder`
--
ALTER TABLE `ordder`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_admin` (`id_admin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `ordder`
--
ALTER TABLE `ordder`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ordder`
--
ALTER TABLE `ordder`
  ADD CONSTRAINT `ordder_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `ordder_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id_product`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
