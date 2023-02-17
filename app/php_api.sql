-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 30 Nis 2022, 17:51:50
-- Sunucu sürümü: 10.4.22-MariaDB
-- PHP Sürümü: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `php_api`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `age` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `name`, `country`, `age`) VALUES
(1, 'Gilberto Cops', 'South Africa', '23'),
(2, 'Heywood Kissock', 'China', '20'),
(3, 'Ted Conybear', 'Russia', '17'),
(4, 'Daryl Beetles', 'Ethiopia', '45'),
(5, 'Tamma Stobbart', 'Greece', '21'),
(6, 'Shela Frostdick', 'Russia', '28'),
(7, 'Romeo Wittier', 'China', '21'),
(8, 'Christian Fitchell', 'Bahrain', '18'),
(9, 'Alec Causton', 'China', '37'),
(10, 'Fritz Pressland', 'Indonesia', '38'),
(11, 'Sandy Boulden', 'Germany', '22'),
(12, 'Layla Houldcroft', 'Indonesia', '29'),
(13, 'Lucien Marshfield', 'United States', '38'),
(14, 'Lenard MacMoyer', 'Panama', '18'),
(15, 'Hazel Seer', 'Ukraine', '24'),
(16, 'Justinian Stampfer', 'Uganda', '22'),
(17, 'Sutton Waggatt', 'Martinique', '43'),
(18, 'Pearl Bustard', 'Russia', '17'),
(19, 'Claudetta Trodd', 'United States', '42'),
(20, 'Stafani Lockhurst', 'China', '37');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
