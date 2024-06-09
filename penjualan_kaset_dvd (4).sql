-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Jun 2024 pada 13.22
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualan_kaset_dvd`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akunstaff`
--

CREATE TABLE `akunstaff` (
  `id` int(12) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `akunstaff`
--

INSERT INTO `akunstaff` (`id`, `username`, `password`) VALUES
(1, 'staff1', 'id123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `booking_dvd`
--

CREATE TABLE `booking_dvd` (
  `id_book_dvd` int(11) NOT NULL,
  `nama_perental` varchar(250) NOT NULL,
  `id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `booking_dvd`
--

INSERT INTO `booking_dvd` (`id_book_dvd`, `nama_perental`, `id`, `jumlah`, `booking_date`, `status`) VALUES
(3, 'elen', 13, 2, '2024-06-09 10:49:08', 'pending'),
(4, 'ria', 7, 4, '2024-06-09 10:50:46', 'pending');

-- --------------------------------------------------------

--
-- Struktur dari tabel `booking_komik`
--

CREATE TABLE `booking_komik` (
  `id_book_komik` int(11) NOT NULL,
  `nama_perental` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','confirmed') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `booking_komik`
--

INSERT INTO `booking_komik` (`id_book_komik`, `nama_perental`, `id`, `jumlah`, `booking_date`, `status`) VALUES
(8, 'elena', 17, 1, '2024-06-09 10:05:00', 'pending'),
(9, 'ijah', 16, 1, '2024-06-09 10:15:49', 'pending'),
(10, 'taipei T____T', 13, 5, '2024-06-09 10:50:24', 'confirmed');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_dvd`
--

CREATE TABLE `data_dvd` (
  `id` int(11) NOT NULL,
  `judul` varchar(250) NOT NULL,
  `genre` varchar(250) NOT NULL,
  `stok` int(12) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_dvd`
--

INSERT INTO `data_dvd` (`id`, `judul`, `genre`, `stok`, `deskripsi`, `gambar`) VALUES
(7, 'Youth Of May', 'romance', 8, 'cewenya mati bjirr gile', 'uploads/youthofmay.jpeg'),
(8, 'My Little Pony The Movie', 'adventure', 2, 'Petualangan Equesteria Girls', 'uploads/ponypre.jpg'),
(9, 'Spongebob On The Run', 'sci-fi', 4, 'Patrick lari larian', 'uploads/spongeontherun.jpg'),
(10, 'Jumanji', 'mysteri', 10, 'Petualangan Jumanji & Friends', 'uploads/jumanji.jpg'),
(11, '5 CM', 'comedy', 3, 'Pendakian Gunung', 'uploads/5cm.jpg'),
(13, 'Kimi No Nawa', 'romance', 9, 'Your Name', 'uploads/kiminonawa.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_komik`
--

CREATE TABLE `data_komik` (
  `id` int(11) NOT NULL,
  `judul` varchar(250) NOT NULL,
  `genre` varchar(250) NOT NULL,
  `stok` int(12) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_komik`
--

INSERT INTO `data_komik` (`id`, `judul`, `genre`, `stok`, `deskripsi`, `gambar`) VALUES
(12, 'Attack On Titan Vol 25', 'action', 13, 'Titan', 'uploads/aot25.jpeg'),
(13, 'Miko Vol 35', 'comedy', 7, 'Kisah Persahabatan Bocah SD', 'uploads/miko35.jpg'),
(14, 'Haikyu Vol 1', 'mysteri', 11, 'Bermain voli', 'uploads/haikyu1.jpg'),
(15, 'Haikyu Vol 32', 'adventure', 5, 'Masih bermain', 'uploads/haikyu32.jpg'),
(16, 'Tokyo Ghoul Re: Vol 1', 'action', 11, 'jenis binatang apa dah', 'uploads/tokyo1.jpeg'),
(17, 'Tokyo Ghoul Vol 2', 'horor', 2, 'gatau', 'uploads/tokyo2.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akunstaff`
--
ALTER TABLE `akunstaff`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `booking_dvd`
--
ALTER TABLE `booking_dvd`
  ADD PRIMARY KEY (`id_book_dvd`),
  ADD KEY `fk_book_dvd` (`id`);

--
-- Indeks untuk tabel `booking_komik`
--
ALTER TABLE `booking_komik`
  ADD PRIMARY KEY (`id_book_komik`),
  ADD KEY `id` (`id`);

--
-- Indeks untuk tabel `data_dvd`
--
ALTER TABLE `data_dvd`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_komik`
--
ALTER TABLE `data_komik`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akunstaff`
--
ALTER TABLE `akunstaff`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `booking_dvd`
--
ALTER TABLE `booking_dvd`
  MODIFY `id_book_dvd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `booking_komik`
--
ALTER TABLE `booking_komik`
  MODIFY `id_book_komik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `data_dvd`
--
ALTER TABLE `data_dvd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `data_komik`
--
ALTER TABLE `data_komik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `booking_dvd`
--
ALTER TABLE `booking_dvd`
  ADD CONSTRAINT `fk_book_dvd` FOREIGN KEY (`id`) REFERENCES `data_dvd` (`id`);

--
-- Ketidakleluasaan untuk tabel `booking_komik`
--
ALTER TABLE `booking_komik`
  ADD CONSTRAINT `booking_komik_ibfk_1` FOREIGN KEY (`id`) REFERENCES `data_komik` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
