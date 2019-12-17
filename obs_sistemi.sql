-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 17 Eki 2019, 02:04:00
-- Sunucu sürümü: 10.4.8-MariaDB
-- PHP Sürümü: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `obs_sistemi`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ders`
--

CREATE TABLE `ders` (
  `id` int(11) NOT NULL,
  `tam_adi` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `kisa_adi` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `kurs_id` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `anonymous` int(11) NOT NULL,
  `timecreated` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `ders`
--

INSERT INTO `ders` (`id`, `tam_adi`, `kisa_adi`, `kurs_id`, `kategori`, `anonymous`, `timecreated`) VALUES
(5, 'C# Programlama', 'CME224', '5', 'Programlama Dersleri', 0, 0);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ders`
--
ALTER TABLE `ders`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
