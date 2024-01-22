-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 22 Jan 2024 pada 07.52
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tbl_meja_213049`
--

INSERT INTO `tbl_meja_213049` (`213049_no_meja`, `213049_status_meja`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_menu_213049`
--

CREATE TABLE `tbl_menu_213049` (
  `213049_id` int NOT NULL,
  `213049_menu_nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `213049_menu_jenis` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `213049_menu_harga` int NOT NULL,
  `213049_menu_stok` int NOT NULL,
  `213049_idstatus` int NOT NULL,
  `213049_menu_gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tbl_menu_213049`
--

INSERT INTO `tbl_menu_213049` (`213049_id`, `213049_menu_nama`, `213049_menu_jenis`, `213049_menu_harga`, `213049_menu_stok`, `213049_idstatus`, `213049_menu_gambar`) VALUES
(48, 'NASI GORENG', 'makanan', 10000, 20, 2, '65aa244823a02_NASI GORENG.png'),
(50, 'SPAGHETTI', 'makanan', 25000, 10, 1, '65aa0b63d08aa_SPAGHETTI.png'),
(51, 'AYAM PENYET', 'makanan', 20000, 20, 1, '65aa24f16567d_AYAM PENYET.png'),
(52, 'AYAM BAKAR', 'makanan', 20000, 10, 1, '65aa0bbf6a350_AYAM BAKAR.png'),
(53, 'CHICKEN STIEK', 'makanan', 30000, 10, 2, '65aa0bede600b_CHICKEN STIEK.png'),
(67, 'Green Tea', 'minuman', 12000, 30, 1, '65aa1ae4032af_Green Tea.jpg'),
(68, 'Jus Alpukat', 'minuman', 15000, 20, 1, '65aa1abf7110a_Jus Alpukat.jpeg'),
(69, 'Jus Apel', 'minuman', 13000, 30, 1, '65aa1b183cb31_Jus Apel.jpg'),
(70, 'Jus Lemon', 'minuman', 10000, 30, 1, '65aa1b2e7222e_Jus Lemon.jpg'),
(71, 'Coffe Latte', 'minuman', 17000, 30, 1, '65aa1b4babcf2_Coffe Latte.jpg'),
(72, 'jus vanila', 'minuman', 9000, 50, 1, '65aa1b6549f53_jus vanila.jpeg');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `213049_menu_nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `213049_menu_harga` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_session_213049`
--

CREATE TABLE `tbl_session_213049` (
  `213049_id` varchar(255) NOT NULL,
  `213049_iduser` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tbl_session_213049`
--

INSERT INTO `tbl_session_213049` (`213049_id`, `213049_iduser`) VALUES
('65ae1e637d12b', 'admin');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('akram123', 'akram', '$2y$10$zLiEt/4xRuNkYaKEBrSA..G9y.O.B3z6A014vNxRTN5DoEcDqBZcq', 2, 1),
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
  MODIFY `213049_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT untuk tabel `tbl_order_213049`
--
ALTER TABLE `tbl_order_213049`
  MODIFY `213049_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT untuk tabel `tbl_pesanan_213049`
--
ALTER TABLE `tbl_pesanan_213049`
  MODIFY `213049_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

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
  ADD CONSTRAINT `fk_statusid` FOREIGN KEY (`213049_idstatus`) REFERENCES `tbl_status_213049` (`213049_id`);

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
