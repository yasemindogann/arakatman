-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 17 Ara 2019, 23:28:01
-- Sunucu sürümü: 10.1.38-MariaDB
-- PHP Sürümü: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `arakatman`
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
  `timecreated` bigint(20) NOT NULL,
  `xml_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `ders`
--

INSERT INTO `ders` (`id`, `tam_adi`, `kisa_adi`, `kurs_id`, `kategori`, `anonymous`, `timecreated`, `xml_id`) VALUES
(21, 'C# Programlama', 'CME224', '', '', 0, 0, 1),
(22, 'Görüntü İşleme', 'CME411', '', '', 0, 0, 1),
(23, 'Mikroişlemciler', 'CME311', '', '', 0, 0, 1),
(24, 'Veri Madenciliği', 'CME412', '', '', 0, 0, 1),
(25, 'FİZİK', 'FZK1', '', '', 0, 0, 1),
(26, 'KİMYA', 'KMY1', '', '', 0, 0, 1),
(27, 'BİYOLOJİ', 'BYL1', '', '', 0, 0, 1),
(28, 'MATEMATİK', 'MAT1', '', '', 0, 0, 1),
(29, 'Lineer Cebir', 'LNR1', '', '', 0, 0, 1),
(30, 'Java Programlama', 'JAV1', '', '', 0, 0, 1),
(31, 'C# Programlama', 'CME224', '', '', 0, 0, 2),
(32, 'Görüntü İşleme', 'CME411', '', '', 0, 0, 2),
(33, 'Mikroişlemciler', 'CME311', '', '', 0, 0, 2),
(34, 'Veri Madenciliği', 'CME412', '', '', 0, 0, 2),
(35, 'FİZİK', 'FZK1', '', '', 0, 0, 2),
(36, 'KİMYA', 'KMY1', '', '', 0, 0, 2),
(37, 'BİYOLOJİ', 'BYL1', '', '', 0, 0, 2),
(38, 'MATEMATİK', 'MAT1', '', '', 0, 0, 2),
(39, 'Lineer Cebir', 'LNR1', '', '', 0, 0, 2),
(40, 'Java Programlama', 'JAV1', '', '', 0, 0, 2);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ders_baginti`
--

CREATE TABLE `ders_baginti` (
  `id` int(11) NOT NULL,
  `obs_kisa_ad` varchar(233) COLLATE utf8_turkish_ci NOT NULL,
  `obs_adi` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `moodle_kisa_ad` varchar(233) COLLATE utf8_turkish_ci NOT NULL,
  `moodle_adi` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `ekli_mi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `ders_baginti`
--

INSERT INTO `ders_baginti` (`id`, `obs_kisa_ad`, `obs_adi`, `moodle_kisa_ad`, `moodle_adi`, `ekli_mi`) VALUES
(1, 'CME224', 'C# Programlama', 'Mat1', 'Matematik', 0),
(2, 'CME411', 'Görüntü İşleme', 'CME223', 'C++ Programlama', 0),
(3, 'CME311', 'Mikroişlemciler', 'CME223', 'C++ Programlama', 0),
(5, 'CME412', 'Veri Madenciliği', 'CME111', 'Programlama Dilleri I', 0),
(6, 'FZK1', 'FİZİK', 'CME222', 'Nesne Tabanlı Programlama', 0),
(7, 'KMY1', 'KİMYA', 'CME222', 'Nesne Tabanlı Programlama', 0),
(8, 'BYL1', 'BİYOLOJİ', 'CME223', 'C++ Programlama', 0),
(9, 'MAT1', 'MATEMATİK', 'CME211', 'MATEMATİK', 0),
(11, 'LNR1', 'Lineer Cebir', 'LNR1', 'Lineer Cebir', 0),
(12, 'JAV1', 'Java Programlama', 'LNR1', 'Lineer Cebir', 0),
(13, 'PHP7', 'Php Programlama 7', 'PHP', 'Proğramlama Dillleri I', 0),
(14, 'PHP6', 'Php Programlama 6', 'PHP', 'Php Programlama 6', 0),
(15, 'PHP5', 'Php Programlama 5', 'PHP', 'Php Programlama 5', 0),
(16, 'AAA', 'Php Programlama a', 'PHP', 'Fizik', 0),
(17, 'PHP4', 'Php Programlama 4', 'PHP', 'Php Programlama 4', 0),
(18, 'MYS1', 'Mysql ', 'PHP', 'Mysql ', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogrenci`
--

CREATE TABLE `ogrenci` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `mail` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `ders_kisa_adi` varchar(50) COLLATE utf8mb4_turkish_ci NOT NULL,
  `xml_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `ogrenci`
--

INSERT INTO `ogrenci` (`id`, `username`, `name`, `lastname`, `mail`, `ders_kisa_adi`, `xml_id`) VALUES
(4, 'deneme6', 'Deneme', 'Soyad', 'deneme6@gmail.com', 'FZK1', 1),
(5, 'deneme5', 'Deneme', 'Lastname', 'deneme5@gmail.com', 'BYL1', 1),
(6, 'deneme7', 'Deneme', 'Deneme', 'deneme7@gmail.com', 'MAT1', 1),
(7, 'deneme6', 'Deneme', 'Soyad', 'deneme6@gmail.com', 'FZK1', 2),
(8, 'deneme5', 'Deneme', 'Lastname', 'deneme5@gmail.com', 'BYL1', 2),
(9, 'deneme7', 'Deneme', 'Deneme', 'deneme7@gmail.com', 'MAT1', 2);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ders`
--
ALTER TABLE `ders`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ders_baginti`
--
ALTER TABLE `ders_baginti`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ogrenci`
--
ALTER TABLE `ogrenci`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `ders`
--
ALTER TABLE `ders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Tablo için AUTO_INCREMENT değeri `ders_baginti`
--
ALTER TABLE `ders_baginti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Tablo için AUTO_INCREMENT değeri `ogrenci`
--
ALTER TABLE `ogrenci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
