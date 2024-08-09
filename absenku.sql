-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Jul 2024 pada 07.27
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absenku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensis`
--

CREATE TABLE `absensis` (
  `id` int(11) NOT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `status_kehadiran` enum('h','i','s','t') DEFAULT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_keluar` time DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `latitude` text DEFAULT NULL,
  `langitude` text DEFAULT NULL,
  `idusers` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `absensis`
--

INSERT INTO `absensis` (`id`, `id_karyawan`, `tanggal`, `status_kehadiran`, `jam_masuk`, `jam_keluar`, `keterangan`, `latitude`, `langitude`, `idusers`, `created_at`, `updated_at`) VALUES
(1, 2, '2024-06-11', 'h', '08:09:00', '16:09:00', NULL, '5.1144211', '96.7919875', 21, '2024-06-10 22:42:24', '2024-06-10 22:42:24'),
(3, 2, '2024-06-14', 'h', '05:57:00', '17:28:00', NULL, '5.3791811', '95.9713616', 21, '2024-06-10 22:57:30', '2024-06-10 22:57:30'),
(7, 2, '2024-06-15', 'i', '15:24:00', NULL, NULL, '5.5482904', '95.3237559', 21, '2024-06-15 08:24:01', '2024-06-15 08:24:01'),
(9, 2, '2024-06-16', 'i', '22:25:00', NULL, 'Sakit perut', '5.1144193', '96.7919831', 21, '2024-06-16 15:25:17', '2024-06-16 15:25:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bagians`
--

CREATE TABLE `bagians` (
  `id` int(11) NOT NULL,
  `id_perusahaan` int(11) DEFAULT NULL,
  `nama_bagian` varchar(191) DEFAULT NULL,
  `idusers` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bagians`
--

INSERT INTO `bagians` (`id`, `id_perusahaan`, `nama_bagian`, `idusers`, `created_at`, `updated_at`) VALUES
(7, 7, 'Distribusi', 20, '2024-06-13 05:59:11', '2024-06-13 05:59:11'),
(8, 7, 'Gudang', 20, '2024-06-13 12:53:51', '2024-06-13 12:53:51'),
(9, 7, 'Pemasaran', 20, '2024-06-13 13:39:19', '2024-06-13 13:39:19'),
(10, 7, 'Pengolahan', 20, '2024-06-13 13:40:12', '2024-06-13 13:40:12'),
(11, 7, 'Exportir', 20, '2024-06-13 13:43:18', '2024-06-13 13:43:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cutis`
--

CREATE TABLE `cutis` (
  `id` int(11) NOT NULL,
  `dari_tanggal` date DEFAULT NULL,
  `sampai_tanggal` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `id_perusahaan` int(11) DEFAULT NULL,
  `idusers` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `gaji_karyawans`
--

CREATE TABLE `gaji_karyawans` (
  `id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `id_bagian` int(11) DEFAULT NULL,
  `id_posisi` int(11) DEFAULT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `gaji_pokok` double DEFAULT NULL,
  `tunjangan` double DEFAULT NULL,
  `jam_lembur` double DEFAULT NULL,
  `gaji_lembur` double DEFAULT NULL,
  `bonus` double DEFAULT NULL,
  `idusers` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawans`
--

CREATE TABLE `karyawans` (
  `id` int(11) NOT NULL,
  `nik` char(20) DEFAULT NULL,
  `nama` text DEFAULT NULL,
  `jekel` enum('L','P') DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `telp` char(20) DEFAULT NULL,
  `email` text DEFAULT NULL,
  `npwp` varchar(50) DEFAULT NULL,
  `tgl_mulai_bekerja` date DEFAULT NULL,
  `id_perusahaan` int(11) DEFAULT NULL,
  `id_bagian` int(11) DEFAULT NULL,
  `id_posisi` int(11) DEFAULT NULL,
  `idakun` int(11) DEFAULT NULL,
  `idusers` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `karyawans`
--

INSERT INTO `karyawans` (`id`, `nik`, `nama`, `jekel`, `alamat`, `telp`, `email`, `npwp`, `tgl_mulai_bekerja`, `id_perusahaan`, `id_bagian`, `id_posisi`, `idakun`, `idusers`, `created_at`, `updated_at`) VALUES
(1, '1121212112123223', 'Heri Nanu', 'L', 'Medan', '0812670920910', NULL, NULL, '2024-06-11', 5, 1, 3, 19, 7, '2024-06-10 09:33:54', '2024-06-10 09:33:54'),
(2, '1121212112123223', 'SUHERI', 'L', 'Medan', '0812670920910', NULL, '1112212', '2024-06-14', 7, 8, 9, 21, 20, '2024-06-13 14:52:53', '2024-06-13 14:52:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_gajis`
--

CREATE TABLE `master_gajis` (
  `id` int(11) NOT NULL,
  `id_perusahaan` int(11) DEFAULT NULL,
  `id_posisi` int(11) DEFAULT NULL,
  `jenis_gaji` varchar(50) DEFAULT NULL,
  `gaji_pokok` double DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `master_gajis`
--

INSERT INTO `master_gajis` (`id`, `id_perusahaan`, `id_posisi`, `jenis_gaji`, `gaji_pokok`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Bulanan', 3400000, '2024-06-08 15:48:30', '2024-06-08 15:48:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_06_04_173024_create_posts_table', 1),
(6, '2024_06_04_183237_create_perusahaans_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `perusahaans`
--

CREATE TABLE `perusahaans` (
  `id` int(11) NOT NULL,
  `nama_perusahaan` text DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `telp` char(20) DEFAULT NULL,
  `bidang` text DEFAULT NULL,
  `owner` varchar(191) DEFAULT NULL,
  `email` text DEFAULT NULL,
  `latitude` text DEFAULT NULL,
  `langitude` text DEFAULT NULL,
  `max_jarak_absen` double DEFAULT NULL,
  `approv` enum('','N','Y') DEFAULT NULL,
  `idusers` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `perusahaans`
--

INSERT INTO `perusahaans` (`id`, `nama_perusahaan`, `alamat`, `telp`, `bidang`, `owner`, `email`, `latitude`, `langitude`, `max_jarak_absen`, `approv`, `idusers`, `created_at`, `updated_at`) VALUES
(7, 'Ud. Jaya', 'hjgjgj', '0812670920910', 'Jual Hasil Bumi', 'Saya', 'suheri37@gmail.com', '5.1144206', '96.7919907', 15, 'Y', 20, '2024-06-12 09:31:53', '2024-06-12 09:31:53'),
(8, 'PT Best Profit Futures', 'jalan pahlawan kerja', '08113450263', 'toko kelontong', 'Bondan prakoso', 'bestprofit21@gmail.com', '0.4596345', '101.4487033', 5, 'Y', 22, '2024-07-09 22:20:19', '2024-07-09 22:20:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `posisis`
--

CREATE TABLE `posisis` (
  `id` int(11) NOT NULL,
  `id_perusahaan` int(11) DEFAULT NULL,
  `id_bagian` int(11) DEFAULT NULL,
  `nama_posisi` text DEFAULT NULL,
  `jenis_gaji` int(11) DEFAULT NULL,
  `gaji_pokok` double DEFAULT NULL,
  `gaji_lembur_perjam` double DEFAULT NULL,
  `idusers` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `posisis`
--

INSERT INTO `posisis` (`id`, `id_perusahaan`, `id_bagian`, `nama_posisi`, `jenis_gaji`, `gaji_pokok`, `gaji_lembur_perjam`, `idusers`, `created_at`, `updated_at`) VALUES
(1, 7, 7, 'Kepala Bagian', 3, 5000000, 50000, 20, '2024-06-07 16:40:36', '2024-06-07 16:40:36'),
(2, 1, 1, 'Karyawan Senior', 1, 4000000, NULL, 1, '2024-06-07 16:40:36', '2024-06-07 16:40:36'),
(3, 1, 1, 'Karyawan', 1, 100000, NULL, 1, '2024-06-07 16:40:36', '2024-06-07 16:40:36'),
(4, 1, 2, 'Kepala', 1, 4000000, 0, 4, '2024-06-07 16:40:36', '2024-06-07 16:40:36'),
(5, 2, 4, 'Staf', 3, 100000, 50000, 4, '2024-06-07 16:40:36', '2024-06-07 16:40:36'),
(6, 2, 5, 'Kepala Gudang', 3, 100000, 50000, 4, '2024-06-07 16:40:36', '2024-06-07 16:40:36'),
(8, 7, 8, 'Kepala Gudang', NULL, NULL, NULL, 20, '2024-06-13 13:53:27', '2024-06-13 13:53:27'),
(9, 7, 8, 'Karyawan', NULL, NULL, NULL, 20, '2024-06-13 13:53:38', '2024-06-13 13:53:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) DEFAULT NULL,
  `role_level` char(5) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `role_level`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', '1', '2024-06-08 15:49:47', '2024-06-08 15:49:47'),
(3, 'Owner Perusahaan', '2', '2024-06-08 15:49:47', '2024-06-08 15:49:47'),
(4, 'Karyawan Perusahaan', '3', '2024-06-08 15:49:47', '2024-06-08 15:49:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `idusers` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `email` text DEFAULT NULL,
  `role_level` char(2) DEFAULT NULL,
  `username` varchar(191) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `remember_token` text DEFAULT NULL,
  `pass_text` text DEFAULT NULL,
  `gauth_id` text DEFAULT NULL,
  `gauth_type` text DEFAULT NULL,
  `img_profile` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`idusers`, `nama`, `email`, `role_level`, `username`, `password`, `remember_token`, `pass_text`, `gauth_id`, `gauth_type`, `img_profile`, `created_at`, `updated_at`) VALUES
(1, 'Heri Nanu', 'suheri37@gmail.com', '1', 'admin', '$2y$12$3JI070dPT9p1w5WRAy3yveL7FJ5mjwcnMUc5a5zAJ7f5VdPxgzmw2', NULL, 'admin', NULL, NULL, NULL, '2024-06-01 09:16:40', '2024-06-01 09:16:40'),
(20, 'Heri Nanu', 'suheri37@yahoo.com', '2', 'Herinanu', '$2y$10$.Yf0fPn.jh/DhB3OwU3lou.tmSGgLW182kMc/KlnWzCT4QD6dd0Nm', NULL, '795771', NULL, 'google', NULL, '2024-06-12 08:45:25', '2024-06-12 08:45:25'),
(21, 'SUHERI', 'suheri@gmail.com', '3', 'VWQgd', '$2y$10$qA4iWJkGB8X3v3sKzt/ruesWDvxdcRZSI50.KvXipDpNJz1MgbWA.', NULL, '642012', NULL, NULL, NULL, '2024-06-13 21:52:53', '2024-06-13 21:52:53'),
(22, 'Bondan prakoso', 'bondan21@gmail.com', '2', 'bondanprakoso', '$2y$10$YaLMUFQpTR3AQ2TDXGK43ejHbhNWiHMcMZnQeleBNbu/pjFfYFOUi', NULL, 'bondanprakoso', NULL, NULL, NULL, '2024-07-09 22:19:36', '2024-07-09 22:19:36');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensis`
--
ALTER TABLE `absensis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bagians`
--
ALTER TABLE `bagians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_perusahaan` (`id_perusahaan`);

--
-- Indeks untuk tabel `cutis`
--
ALTER TABLE `cutis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `gaji_karyawans`
--
ALTER TABLE `gaji_karyawans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `karyawans`
--
ALTER TABLE `karyawans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `master_gajis`
--
ALTER TABLE `master_gajis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `perusahaans`
--
ALTER TABLE `perusahaans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `posisis`
--
ALTER TABLE `posisis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idusers`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensis`
--
ALTER TABLE `absensis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `bagians`
--
ALTER TABLE `bagians`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `gaji_karyawans`
--
ALTER TABLE `gaji_karyawans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `karyawans`
--
ALTER TABLE `karyawans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `master_gajis`
--
ALTER TABLE `master_gajis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `perusahaans`
--
ALTER TABLE `perusahaans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `posisis`
--
ALTER TABLE `posisis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `idusers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bagians`
--
ALTER TABLE `bagians`
  ADD CONSTRAINT `bagians_ibfk_1` FOREIGN KEY (`id_perusahaan`) REFERENCES `perusahaans` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
