-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 13 Jan 2024 pada 04.50
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sisfo_menurestoran`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_level_213049`
--

CREATE TABLE `tbl_level_213049` (
  `213049_id` int NOT NULL,
  `213049_nama_level` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tbl_level_213049`
--

INSERT INTO `tbl_level_213049` (`213049_id`, `213049_nama_level`) VALUES
(1, 'administrator'),
(2, 'pelanggan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_meja_213049`
--

CREATE TABLE `tbl_meja_213049` (
  `213049_no_meja` int NOT NULL,
  `213049_status_meja` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tbl_meja_213049`
--

INSERT INTO `tbl_meja_213049` (`213049_no_meja`, `213049_status_meja`) VALUES
(1, 2),
(2, 2),
(3, 1),
(4, 1),
(5, 2),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 2),
(11, 1),
(12, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_menu_213049`
--

CREATE TABLE `tbl_menu_213049` (
  `213049_id` int NOT NULL,
  `213049_menu_nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `213049_menu_jenis` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `213049_menu_harga` int NOT NULL,
  `213049_menu_stok` int NOT NULL,
  `213049_idstatus` int NOT NULL,
  `213049_menu_gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tbl_menu_213049`
--

INSERT INTO `tbl_menu_213049` (`213049_id`, `213049_menu_nama`, `213049_menu_jenis`, `213049_menu_harga`, `213049_menu_stok`, `213049_idstatus`, `213049_menu_gambar`) VALUES
(48, 'NASI GORENG', 'makanan', 20000, 0, 1, '6577e9daedc06_Nasi Goreng.png'),
(50, 'SPAGHETTI', 'makanan', 25000, 6, 1, '6577f20bd6bc1_SPAGHETTI.png'),
(51, 'AYAM PENYET', 'makanan', 20000, 0, 1, '6577f2558aa9e_AYAM PENYET.png'),
(52, 'AYAM BAKAR', 'makanan', 20000, 3, 1, '6577f28235855_AYAM BAKAR.png'),
(53, 'CHICKEN STIEK', 'makanan', 30000, 0, 1, '6577f2e6270ac_CHICKEN STIEK.png'),
(56, 'JUS ALPUKAT', 'minuman', 15000, 0, 1, '657864ba1c6d1_JUS.jpeg'),
(57, 'JUS MANGGA', 'minuman', 15000, 7, 1, '657864d612dfd_JUS.jpeg'),
(59, 'JUS APEL', 'minuman', 15000, 4, 1, '65786503879a8_JUS.jpeg'),
(60, 'JUS LEMON', 'minuman', 15000, 10, 1, '65786519ed8ea_JUS.jpeg'),
(61, 'SOTO AYAM', 'makanan', 20000, 8, 1, '65786abfc2c5d_SOTO AYAM.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_order_213049`
--

CREATE TABLE `tbl_order_213049` (
  `213049_id` int NOT NULL,
  `213049_idadmin` varchar(255) DEFAULT NULL,
  `213049_idpengunjung` varchar(255) DEFAULT NULL,
  `213049_waktu_pesan` datetime DEFAULT CURRENT_TIMESTAMP,
  `213049_no_meja` int DEFAULT NULL,
  `213049_total_harga` int NOT NULL,
  `213049_uang_bayar` int DEFAULT NULL,
  `213049_uang_kembali` int DEFAULT NULL,
  `213049_idstatus` int DEFAULT NULL,
  `213049_nama_admin` varchar(255) DEFAULT NULL,
  `213049_nama_pengunjung` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tbl_order_213049`
--

INSERT INTO `tbl_order_213049` (`213049_id`, `213049_idadmin`, `213049_idpengunjung`, `213049_waktu_pesan`, `213049_no_meja`, `213049_total_harga`, `213049_uang_bayar`, `213049_uang_kembali`, `213049_idstatus`, `213049_nama_admin`, `213049_nama_pengunjung`) VALUES
(50, 'admin', 'admin', '2023-12-13 03:31:32', 1, 25000, 30000, 5000, 0, 'admin', 'admin'),
(51, 'admin', 'admin', '2023-12-13 03:39:34', 1, 45000, 45000, 0, 0, 'admin', 'admin'),
(52, 'admin', 'admin', '2023-12-13 10:45:39', 1, 20000, 50000, 30000, 1, 'admin', 'admin'),
(54, 'admin', 'sajdy', '2023-12-13 11:26:22', 2, 50000, 100000, 50000, 1, '', 'sajdyy'),
(55, 'admin', 'admin', '2023-12-13 21:52:47', 2, 90000, 100000, 10000, 1, 'admin', 'admin'),
(57, 'admin', 'admin', '2023-12-13 22:14:00', 1, 20000, 20000, 0, 1, 'admin', 'admin'),
(66, 'admin', '11', '2023-12-24 23:14:37', 3, 20000, 25000, 5000, 1, '', 'akram'),
(70, 'admin', '11', '2023-12-25 17:16:31', 1, 90000, 100000, 10000, 1, '', 'akram'),
(72, 'admin', '11', '2023-12-27 19:41:12', 7, 100000, 100000, 0, 1, '', 'akram'),
(74, 'admin', 'admin', '2023-12-28 15:48:19', 1, 25000, NULL, NULL, 2, 'admin', 'admin'),
(75, 'admin', 'admin', '2023-12-28 15:59:33', 5, 25000, NULL, NULL, 2, 'admin', 'admin'),
(76, 'admin', 'admin', '2023-12-28 16:25:32', 2, 25000, NULL, NULL, 2, 'admin', 'admin'),
(77, NULL, '11', '2023-12-28 17:22:33', 10, 365000, NULL, NULL, 2, '', 'akram');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pesanan_213049`
--

CREATE TABLE `tbl_pesanan_213049` (
  `213049_id` int NOT NULL,
  `213049_idorder` int NOT NULL,
  `213049_jumlah` int NOT NULL,
  `213049_idstatus` int NOT NULL,
  `213049_idmenu` int NOT NULL,
  `213049_subtotal` int DEFAULT NULL,
  `213049_menu_nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `213049_menu_harga` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tbl_pesanan_213049`
--

INSERT INTO `tbl_pesanan_213049` (`213049_id`, `213049_idorder`, `213049_jumlah`, `213049_idstatus`, `213049_idmenu`, `213049_subtotal`, `213049_menu_nama`, `213049_menu_harga`) VALUES
(67, 50, 1, 1, 50, 25000, 'SPAGHETTI', 25000),
(68, 51, 1, 1, 53, 30000, 'CHICKEN STIEK', 30000),
(69, 51, 1, 1, 57, 15000, 'JUS MANGGA', 15000),
(70, 52, 1, 1, 48, 20000, 'NASI GORENG', 20000),
(72, 54, 2, 1, 50, 50000, 'SPAGHETTI', 25000),
(73, 55, 1, 1, 50, 25000, 'SPAGHETTI', 25000),
(74, 55, 1, 1, 52, 20000, 'AYAM BAKAR', 20000),
(75, 55, 1, 1, 53, 30000, 'CHICKEN STIEK', 30000),
(76, 55, 1, 1, 60, 15000, 'JUS LEMON', 15000),
(78, 57, 1, 1, 51, 20000, 'AYAM PENYET', 20000),
(86, 66, 1, 1, 52, 20000, 'AYAM BAKAR', 20000),
(100, 70, 1, 1, 52, 20000, 'AYAM BAKAR', 20000),
(101, 70, 1, 1, 50, 25000, 'SPAGHETTI', 25000),
(102, 70, 1, 1, 59, 15000, 'JUS APEL', 15000),
(103, 70, 1, 1, 57, 15000, 'JUS MANGGA', 15000),
(104, 70, 1, 1, 56, 15000, 'JUS ALPUKAT', 15000),
(106, 72, 1, 1, 50, 25000, 'SPAGHETTI', 25000),
(107, 72, 3, 1, 59, 45000, 'JUS APEL', 15000),
(108, 72, 1, 1, 60, 15000, 'JUS LEMON', 15000),
(109, 72, 1, 1, 57, 15000, 'JUS MANGGA', 15000),
(112, 74, 1, 2, 50, 25000, 'SPAGHETTI', 25000),
(113, 75, 1, 2, 50, 25000, 'SPAGHETTI', 25000),
(114, 76, 1, 2, 50, 25000, 'SPAGHETTI', 25000),
(115, 77, 1, 2, 52, 20000, 'AYAM BAKAR', 20000),
(116, 77, 2, 2, 59, 30000, 'JUS APEL', 15000),
(117, 77, 1, 2, 60, 15000, 'JUS LEMON', 15000),
(118, 77, 1, 2, 57, 15000, 'JUS MANGGA', 15000),
(119, 77, 19, 2, 56, 285000, 'JUS ALPUKAT', 15000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_session_213049`
--

CREATE TABLE `tbl_session_213049` (
  `213049_id` varchar(255) NOT NULL,
  `213049_iduser` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tbl_session_213049`
--

INSERT INTO `tbl_session_213049` (`213049_id`, `213049_iduser`) VALUES
('6589cbb7ece49', '11'),
('658d3e0664b04', '11'),
('6598e62365254', '11'),
('65a2158b497a6', '11'),
('65765fcd08bdd', 'admin'),
('6577f697b48e2', 'admin'),
('6579c2f8a8fe0', 'admin'),
('658166074d37a', 'admin'),
('658944ff44760', 'admin'),
('658bed7abb807', 'admin'),
('658c14b6deb2f', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_status_213049`
--

CREATE TABLE `tbl_status_213049` (
  `213049_id` int NOT NULL,
  `213049_status_user` varchar(255) DEFAULT NULL,
  `213049_status_pesan` varchar(255) DEFAULT NULL,
  `213049_status_order` varchar(255) DEFAULT NULL,
  `213049_status_menu` varchar(255) DEFAULT NULL,
  `213049_status_meja` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tbl_status_213049`
--

INSERT INTO `tbl_status_213049` (`213049_id`, `213049_status_user`, `213049_status_pesan`, `213049_status_order`, `213049_status_menu`, `213049_status_meja`) VALUES
(0, NULL, NULL, NULL, 'selesai', NULL),
(1, 'aktif', 'sudah pesan', 'sudah bayar', 'tersedia', 'tersedia'),
(2, 'non-aktif', 'belum pesan', 'belum bayar', 'tidak tersedia', 'ditempati');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user_213049`
--

CREATE TABLE `tbl_user_213049` (
  `213049_id` varchar(255) NOT NULL,
  `213049_nama` varchar(255) NOT NULL,
  `213049_password` varchar(255) NOT NULL,
  `213049_idlevel` int DEFAULT NULL,
  `213049_idstatus` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tbl_user_213049`
--

INSERT INTO `tbl_user_213049` (`213049_id`, `213049_nama`, `213049_password`, `213049_idlevel`, `213049_idstatus`) VALUES
('11', 'akram', '$2y$10$S650WlS/fJZifTqJ7uDch.MrxIzLPqN4aHTaI58HixGqcXPc4FIYW', 2, 1),
('1212', 'eqrqrfnh', '$2y$10$fiySg7DXhSnOPtOnzfCBEO8Vmjt/DFY1yPvevm2bfuYPYQz1tdIJa', 2, 1),
('2345r', 'e', '$2y$10$V/hd3pI3fa6iwhv8VlafFeezDaZw0E2Lq2kTFfUuiTDt5MCMc6bEu', 2, 1),
('444', 'hskk', '$2y$10$hFTWr3QIBPOxXSvFKMz/M.fX7W1AcL78izc89/VxI/vWuaa1D64iS', 2, 1),
('626', 'hh', '$2y$10$FlVIHI.hm3xRoyL5qS3epOetQf.k7HsHIiZymvlmFfkSWJWyTEre.', 2, 1),
('admin', 'admin', '$2y$10$WCh6WE8EzXpYM03yrjcR1eY6G0OI2hU1MYInwjVeIrUg46m/cjqSm', 1, 1),
('bahrul', 'muh bahrul', '$2y$10$c3xd25VFSdCmBMm/Ysw0Aeic64slnr0U5SffYOUZcLQdZxdBND1be', 2, 1),
('heri', 'herianto', '$2y$10$4ovzfna7GwGQoyoxPgql2.Q0RNg7VEimYZacygMvZZse6f0AbeOn.', 2, 1),
('sajdy', 'sajdyy', '$2y$10$yyouI6kvVhoJclfxHpvRIewgLjmXV3XICEObmko/U/4NK0tCIZBte', 2, 1),
('saldy', 'Saldy Husaini', '$2y$10$k7aalQowstj8OzsnvQGphef9Tf42K8YWYEJ.yMm5FZQe099B3hYDi', 2, 1),
('ssss', 's', '$2y$10$sCyDRVgdFDrL.wgmzacF1.YBRZcCuZwmsWCvrJubtsbXQ8MHcavea', 2, 1),
('sssss', 'aaa', '$2y$10$P3EgMJafxYulR1vrsYEAJ.UGK773Kyif51sCQA8aMBzH6MlAFYO.q', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_level_213049`
--
ALTER TABLE `tbl_level_213049`
  ADD PRIMARY KEY (`213049_id`);

--
-- Indeks untuk tabel `tbl_meja_213049`
--
ALTER TABLE `tbl_meja_213049`
  ADD PRIMARY KEY (`213049_no_meja`);

--
-- Indeks untuk tabel `tbl_menu_213049`
--
ALTER TABLE `tbl_menu_213049`
  ADD PRIMARY KEY (`213049_id`),
  ADD KEY `fk_idstatus` (`213049_idstatus`);

--
-- Indeks untuk tabel `tbl_order_213049`
--
ALTER TABLE `tbl_order_213049`
  ADD PRIMARY KEY (`213049_id`),
  ADD KEY `fk_idadmin` (`213049_idadmin`),
  ADD KEY `fk_idpengunjung` (`213049_idpengunjung`),
  ADD KEY `fk_status` (`213049_idstatus`),
  ADD KEY `fk_nomeja` (`213049_no_meja`);

--
-- Indeks untuk tabel `tbl_pesanan_213049`
--
ALTER TABLE `tbl_pesanan_213049`
  ADD PRIMARY KEY (`213049_id`),
  ADD KEY `fk_statusid` (`213049_idstatus`),
  ADD KEY `fke_menu` (`213049_idmenu`),
  ADD KEY `fk_order` (`213049_idorder`);

--
-- Indeks untuk tabel `tbl_session_213049`
--
ALTER TABLE `tbl_session_213049`
  ADD PRIMARY KEY (`213049_id`),
  ADD KEY `fk_session_user` (`213049_iduser`);

--
-- Indeks untuk tabel `tbl_status_213049`
--
ALTER TABLE `tbl_status_213049`
  ADD PRIMARY KEY (`213049_id`);

--
-- Indeks untuk tabel `tbl_user_213049`
--
ALTER TABLE `tbl_user_213049`
  ADD PRIMARY KEY (`213049_id`),
  ADD KEY `fk_idlevel` (`213049_idlevel`),
  ADD KEY `fk_status_user` (`213049_idstatus`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_meja_213049`
--
ALTER TABLE `tbl_meja_213049`
  MODIFY `213049_no_meja` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tbl_menu_213049`
--
ALTER TABLE `tbl_menu_213049`
  MODIFY `213049_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT untuk tabel `tbl_order_213049`
--
ALTER TABLE `tbl_order_213049`
  MODIFY `213049_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT untuk tabel `tbl_pesanan_213049`
--
ALTER TABLE `tbl_pesanan_213049`
  MODIFY `213049_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_menu_213049`
--
ALTER TABLE `tbl_menu_213049`
  ADD CONSTRAINT `fk_idstatus` FOREIGN KEY (`213049_idstatus`) REFERENCES `tbl_level_213049` (`213049_id`);

--
-- Ketidakleluasaan untuk tabel `tbl_order_213049`
--
ALTER TABLE `tbl_order_213049`
  ADD CONSTRAINT `fk_idadmin` FOREIGN KEY (`213049_idadmin`) REFERENCES `tbl_user_213049` (`213049_id`),
  ADD CONSTRAINT `fk_idpengunjung` FOREIGN KEY (`213049_idpengunjung`) REFERENCES `tbl_user_213049` (`213049_id`),
  ADD CONSTRAINT `fk_nomeja` FOREIGN KEY (`213049_no_meja`) REFERENCES `tbl_meja_213049` (`213049_no_meja`),
  ADD CONSTRAINT `fk_status` FOREIGN KEY (`213049_idstatus`) REFERENCES `tbl_status_213049` (`213049_id`);

--
-- Ketidakleluasaan untuk tabel `tbl_pesanan_213049`
--
ALTER TABLE `tbl_pesanan_213049`
  ADD CONSTRAINT `fk_order` FOREIGN KEY (`213049_idorder`) REFERENCES `tbl_order_213049` (`213049_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_statusid` FOREIGN KEY (`213049_idstatus`) REFERENCES `tbl_status_213049` (`213049_id`),
  ADD CONSTRAINT `fke_menu` FOREIGN KEY (`213049_idmenu`) REFERENCES `tbl_menu_213049` (`213049_id`);

--
-- Ketidakleluasaan untuk tabel `tbl_session_213049`
--
ALTER TABLE `tbl_session_213049`
  ADD CONSTRAINT `fk_session_user` FOREIGN KEY (`213049_iduser`) REFERENCES `tbl_user_213049` (`213049_id`);

--
-- Ketidakleluasaan untuk tabel `tbl_user_213049`
--
ALTER TABLE `tbl_user_213049`
  ADD CONSTRAINT `fk_idlevel` FOREIGN KEY (`213049_idlevel`) REFERENCES `tbl_level_213049` (`213049_id`),
  ADD CONSTRAINT `fk_status_user` FOREIGN KEY (`213049_idstatus`) REFERENCES `tbl_status_213049` (`213049_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
