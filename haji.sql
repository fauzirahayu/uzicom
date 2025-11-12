-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 12, 2025 at 02:59 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `haji`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `username` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`) VALUES
(1, 'ge', 'ge@gmail.com', '$2y$10$eW8TSqUFuzEoIHrjwHOoheLzZuK9dszyihmXlRjFaLst3gipALdy6'),
(2, 'gi', 'gi@gmail.com', '$2y$10$a6EJqMMPj2HF05cCvLjPvemyLivwNqwef304/vIDZAEACKTgYvsfi'),
(3, 'gu', 'gu@gmail.com', '$2y$10$nJKT5B4zuUQFh0CCz0cG4.XEDJBvQlRFDrmU6vDWM8ApOmLb0VduO'),
(5, 'land', 'land@gmail.com', '$2y$10$y1w3mvQ3ERfZWmv0WUaj7eqb5yXgWUKL18OCx5VsDueB2F09RvwCi'),
(6, 'hayu', 'hayu@gmail.com', '$2y$10$j0aTHF3duwsTDfJUWGYAourVMs1J8BSsIA4787IWrLMpqU.gstRK.');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int NOT NULL,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `konten` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_publikasi` date NOT NULL,
  `penulis` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `judul`, `konten`, `tanggal_publikasi`, `penulis`, `gambar`) VALUES
(2, 'Serah Terima Santunan Ekstra Cover, Sesditjen PHU: Bukti Negara Hadir Bagi Jemaah', 'Surabaya (PHU) – Pasca operasional ibadah haji tahun 1446 H/2025 M, pemerintah melalui Kementerian Agama terus berupaya memberikan pelindungan maksimal bagi jemaah haji, terutama bagi jemaah yang wafat atau mengalami cacat tetap. Hal ini ditegaskan Sekretaris Ditjen PHU Kemenag RI, Arfi Hatim, dalam kegiatan Serah Terima Santunan Ekstra Cover Jemaah Haji Tahun 1446 H/2025 M yang berlangsung di Aula Bidang Penyelenggaraan Haji dan Umrah Kanwil Kemenag Provinsi Jawa Timur di Surabaya.\r\n\r\n“Pelindungan tersebut diwujudkan dalam bentuk asuransi jiwa dan kecelakaan bagi setiap jemaah yang wafat atau mengalami cacat tetap. Bahkan, jemaah yang wafat dalam lingkup tanggung jawab pihak penerbangan juga mendapat tambahan perlindungan berupa ekstra cover asuransi. Ini adalah bentuk nyata negara hadir untuk memenuhi hak dan memberikan kenyamanan serta keamanan bagi jemaah,” ujar Arfi, Jum’at (12/9/2025).\r\n\r\nArfi menambahkan, tahun ini terdapat enam jemaah embarkasi Surabaya yang wafat dalam perjalanan dengan Saudia Airlines. Sesuai kontrak kerja sama, ahli waris berhak menerima santunan ekstra cover yang diserahkan langsung oleh pihak maskapai.\r\n\r\n“Kami berpesan kepada keluarga, jangan melihat besar kecilnya santunan. Ini adalah bentuk perhatian, rasa empati, dan tanggung jawab negara bersama mitra penerbangan. Semoga almarhum dan almarhumah diterima di sisi Allah Swt, dan keluarga diberi ketabahan,” pungkas Arfi.\r\n\r\ne80c7b83-2a8a-4cff-a093-56ef9bf6c523.jpeg\r\n\r\nSementara itu, Country Manager Saudia Airlines Indonesia-Singapura-Australia, Faisal Alallah menyampaikan duka cita mendalam kepada keluarga jemaah yang wafat. Ia menegaskan bahwa pemberian ekstra cover ini adalah bagian dari kesepakatan resmi dengan Kemenag RI, sebagai bentuk dukungan dan kebermanfaatan bagi keluarga jemaah.\r\n\r\n“Saudia Airlines berterima kasih atas kepercayaan pemerintah Indonesia yang selalu menjadikan kami bagian dari penyelenggaraan haji. Ekstra cover ini bukan hanya di Surabaya, sebelumnya juga telah diberikan untuk jemaah dari embarkasi Palembang. Semoga kerja sama ini terus berlanjut dengan baik di masa mendatang,” kata Faisal.\r\n\r\nKepala Kanwil Kemenag Jawa Timur, Akhmad Sruji Bahtiar, turut memberikan apresiasi atas sinergi yang terbangun antara pemerintah, maskapai, dan seluruh pemangku kepentingan. Ia menegaskan bahwa seluruh jajaran Kemenag di daerah terus berkomitmen menghadirkan pelayanan terbaik, mulai dari pembinaan, pelayanan, hingga perlindungan jemaah.\r\n\r\n“Alhamdulillah, penyelenggaraan haji 1446H/2025M yang telah berakhir pada 11 Juli lalu berjalan sukses dengan segala dinamikanya. Berdasarkan hasil survei, indeks kepuasan jemaah haji Indonesia juga meningkat dan masuk kategori sangat memuaskan. Ini adalah buah kerja keras bersama, baik Kemenag pusat maupun daerah,” tegasnya.\r\n\r\nDalam acara tersebut, dilakukan penyerahan simbolis santunan ekstra cover asuransi oleh pihak Saudia Airlines kepada keluarga dari enam jemaah yang wafat dari embarkasi Surabaya, yaitu:\r\n\r\n• Hj. Nur Fadilah (Kab. Sidoarjo) • Hj. Sri Umami Kasih (Kab. Probolinggo) • Hj. Mukatin Wakimin Samin (Kab. Bangkalan) • Hj. Salimah Deman Sadih (Kab. Bangkalan) • Hj. Sriani Saniman (Kab. Malang) • Hj. Maryati Kamijo (Kota Probolinggo)\r\n\r\nProgram pelindungan asuransi ini membuktikan bahwa negara selalu hadir untuk jemaah dan pelayanan haji Indonesia terus bertransformasi menuju lebih baik, transparan, dan responsif terhadap kebutuhan jemaah. (Rd)', '2024-10-10', 'Admin', 'a76fa8f3_f059_4916_ae81_cb803f666305_679acfa6dc.jpeg'),
(3, 'Raih Indeks Sangat Memuaskan, Menag Ungkap Tantangan Penyelenggaraan Haji 2025', 'Jakarta (PHU) – Indeks Kepuasan Jemaah Haji 2025 meraih indeks 88,64, Menteri Agama Nasaruddin Umar mengungkap berbagai tantangan dalam penyelenggaraannya, mulai dari perubahan regulasi Arab Saudi yang berulang kali hingga penerapan aturan teknis baru. Menurut Menag, semua itu menuntut petugas haji Indonesia beradaptasi cepat di lapangan.\r\n\r\n“Pernah satu hari itu tiga kali perubahan. Nah, kemampuan teman-teman Panitia (Petugas) Haji yang melakukan adaptasi dengan perubahan itu, ini yang kami apresiasi luar biasa,” ujar Nasaruddin Umar, Menteri Agama, dalam konferensi pers publikasi hasil Survei Kepuasan Jemaah Haji 2025 di Jakarta, Rabu (10/9/2025).\r\n\r\nPerubahan aturan itu dicontohkan Menag terkait pelaksananan Murur. Diungkapkannya, awalnya panitia sudah siap untuk pelaksanaan murur, namun terjadi perubahan aturan untuk tidak ada pelaksanaan murur. Menghadapi hal tersebut, panitia harus melakukan penyesuaian data dalam waktu yang sangat singkat. Namun, dengan berbagai pertimbangan yang dilakukan pembuat regulasi, dengan menimbang kondisi jemaah Indonesia, aturan berubah lagi dan murur dapat dilaksanakan.\r\n\r\nTantangan lainnya, lanjut Menag, masa transisi tahun ini diwarnai banyak aturan baru. “Dulu syarikah-nya hanya satu, sekarang ini menjadi delapan. Dulu pembatasan-pembatasannya tidak banyak ya, tapi sekarang ini banyak sekali pembatasan terutama menyangkut masalah rumah sakit, kemudian juga Nusuk. Arah lalu lintasnya pun banyak sekali berubah. Kemudian juga banyak sekali ketentuan-ketentuan yang lebih detail yang tidak pernah terjadi sebelumnya dan ini tiba-tiba ada,” jelasnya.\r\n\r\nMeski begitu, Menag menilai jajaran Kemenag berhasil melewati tantangan tersebut dengan baik. “Tapi dalam keadaan seperti ini pun alhamdulillah teman-teman dari Kementerian Agama mampu melewatinya dengan baik,” tegasnya.\r\n\r\n“(Saya) Berterima kasih kepada seluruh panitia dan semua pihak yang terlibat untuk membantu kelancaran pelaksanaan haji tahun ini. Rekan-rekan kami dari Amirul Hajj sampai kepada lembaga-lembaga yang terkait, TNI Polri yang berjasa di dalam upaya menertibkan jamaah kami, membantu jamaah kami yang membutuhkan pertolongan. Tentu yang paling penting juga adalah Badan Pusat Statistik yang telah melakukan penilaian sedemikian rupa,” pungkas Nasaruddin Umar.', '2024-10-05', 'Admin', '1757524173_00258915f1.jpg'),
(4, 'Informasi Biaya Haji 2028', 'Biaya haji untuk tahun 2028 telah ditetapkan. Lihat detail biaya di halaman pembayaran. Biaya dasar haji sebesar Rp 50.000.000,- termasuk akomodasi, transportasi, dan konsumsi. Pembayaran dapat dilakukan melalui transfer bank atau aplikasi resmi.', '2024-10-01', 'Admin', 'berita4.jpg'),
(6, 'Perkuat Sinergi Lintas Sektor, PHU Kemenag Tabalong Gelar Pembinaan PPIU/PIHK dan Sosialisasi Kebijakan Umrah', 'Jakarta (PHU) – Indeks Kepuasan Jemaah Haji 2025 meraih indeks 88,64, Menteri Agama Nasaruddin Umar mengungkap berbagai tantangan dalam penyelenggaraannya, mulai dari perubahan regulasi Arab Saudi yang berulang kali hingga penerapan aturan teknis baru. Menurut Menag, semua itu menuntut petugas haji Indonesia beradaptasi cepat di lapangan.\r\n\r\n“Pernah satu hari itu tiga kali perubahan. Nah, kemampuan teman-teman Panitia (Petugas) Haji yang melakukan adaptasi dengan perubahan itu, ini yang kami apresiasi luar biasa,” ujar Nasaruddin Umar, Menteri Agama, dalam konferensi pers publikasi hasil Survei Kepuasan Jemaah Haji 2025 di Jakarta, Rabu (10/9/2025).\r\n\r\nPerubahan aturan itu dicontohkan Menag terkait pelaksananan Murur. Diungkapkannya, awalnya panitia sudah siap untuk pelaksanaan murur, namun terjadi perubahan aturan untuk tidak ada pelaksanaan murur. Menghadapi hal tersebut, panitia harus melakukan penyesuaian data dalam waktu yang sangat singkat. Namun, dengan berbagai pertimbangan yang dilakukan pembuat regulasi, dengan menimbang kondisi jemaah Indonesia, aturan berubah lagi dan murur dapat dilaksanakan.\r\n\r\nTantangan lainnya, lanjut Menag, masa transisi tahun ini diwarnai banyak aturan baru. “Dulu syarikah-nya hanya satu, sekarang ini menjadi delapan. Dulu pembatasan-pembatasannya tidak banyak ya, tapi sekarang ini banyak sekali pembatasan terutama menyangkut masalah rumah sakit, kemudian juga Nusuk. Arah lalu lintasnya pun banyak sekali berubah. Kemudian juga banyak sekali ketentuan-ketentuan yang lebih detail yang tidak pernah terjadi sebelumnya dan ini tiba-tiba ada,” jelasnya.\r\n\r\nMeski begitu, Menag menilai jajaran Kemenag berhasil melewati tantangan tersebut dengan baik. “Tapi dalam keadaan seperti ini pun alhamdulillah teman-teman dari Kementerian Agama mampu melewatinya dengan baik,” tegasnya.\r\n\r\n“(Saya) Berterima kasih kepada seluruh panitia dan semua pihak yang terlibat untuk membantu kelancaran pelaksanaan haji tahun ini. Rekan-rekan kami dari Amirul Hajj sampai kepada lembaga-lembaga yang terkait, TNI Polri yang berjasa di dalam upaya menertibkan jamaah kami, membantu jamaah kami yang membutuhkan pertolongan. Tentu yang paling penting juga adalah Badan Pusat Statistik yang telah melakukan penilaian sedemikian rupa,” pungkas Nasaruddin Umar.\r\n\r\nBagikan', '2025-09-30', 'Mustrini Bella Vitiara', '1757524173_00258915f1.jpg'),
(7, 'Raih Indeks Sangat Memuaskan, Menag Ungkap Tantangan Penyelenggaraan Haji 2025', 'Jakarta (PHU) – Indeks Kepuasan Jemaah Haji 2025 meraih indeks 88,64, Menteri Agama Nasaruddin Umar mengungkap berbagai tantangan dalam penyelenggaraannya, mulai dari perubahan regulasi Arab Saudi yang berulang kali hingga penerapan aturan teknis baru. Menurut Menag, semua itu menuntut petugas haji Indonesia beradaptasi cepat di lapangan.\r\n\r\n“Pernah satu hari itu tiga kali perubahan. Nah, kemampuan teman-teman Panitia (Petugas) Haji yang melakukan adaptasi dengan perubahan itu, ini yang kami apresiasi luar biasa,” ujar Nasaruddin Umar, Menteri Agama, dalam konferensi pers publikasi hasil Survei Kepuasan Jemaah Haji 2025 di Jakarta, Rabu (10/9/2025).\r\n\r\nPerubahan aturan itu dicontohkan Menag terkait pelaksananan Murur. Diungkapkannya, awalnya panitia sudah siap untuk pelaksanaan murur, namun terjadi perubahan aturan untuk tidak ada pelaksanaan murur. Menghadapi hal tersebut, panitia harus melakukan penyesuaian data dalam waktu yang sangat singkat. Namun, dengan berbagai pertimbangan yang dilakukan pembuat regulasi, dengan menimbang kondisi jemaah Indonesia, aturan berubah lagi dan murur dapat dilaksanakan.\r\n\r\nTantangan lainnya, lanjut Menag, masa transisi tahun ini diwarnai banyak aturan baru. “Dulu syarikah-nya hanya satu, sekarang ini menjadi delapan. Dulu pembatasan-pembatasannya tidak banyak ya, tapi sekarang ini banyak sekali pembatasan terutama menyangkut masalah rumah sakit, kemudian juga Nusuk. Arah lalu lintasnya pun banyak sekali berubah. Kemudian juga banyak sekali ketentuan-ketentuan yang lebih detail yang tidak pernah terjadi sebelumnya dan ini tiba-tiba ada,” jelasnya.\r\n\r\nMeski begitu, Menag menilai jajaran Kemenag berhasil melewati tantangan tersebut dengan baik. “Tapi dalam keadaan seperti ini pun alhamdulillah teman-teman dari Kementerian Agama mampu melewatinya dengan baik,” tegasnya.\r\n\r\n“(Saya) Berterima kasih kepada seluruh panitia dan semua pihak yang terlibat untuk membantu kelancaran pelaksanaan haji tahun ini. Rekan-rekan kami dari Amirul Hajj sampai kepada lembaga-lembaga yang terkait, TNI Polri yang berjasa di dalam upaya menertibkan jamaah kami, membantu jamaah kami yang membutuhkan pertolongan. Tentu yang paling penting juga adalah Badan Pusat Statistik yang telah melakukan penilaian sedemikian rupa,” pungkas Nasaruddin Umar.\r\n\r\nBagikan', '2025-10-01', 'Mustrini Bella Vitiara', '1761128331_1757524173_00258915f1.jpg'),
(8, 'gfhjfgh', 'fghjfghjgfhjg', '2025-11-10', 'sdfgdfs', '1762763657_pass.png');

-- --------------------------------------------------------

--
-- Table structure for table `jamaah_2027`
--

CREATE TABLE `jamaah_2027` (
  `id` int NOT NULL,
  `foto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nik` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `no_porsi` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_lengkap` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_kelamin` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telepon` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_paspor` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `golongan_darah` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `penyakit_bawaan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jadwal_berangkat` date DEFAULT NULL,
  `status` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `data_pulang` date DEFAULT NULL,
  `id_pembimbing` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jamaah_2027`
--

INSERT INTO `jamaah_2027` (`id`, `foto`, `nik`, `no_porsi`, `nama_lengkap`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `telepon`, `no_paspor`, `golongan_darah`, `penyakit_bawaan`, `jadwal_berangkat`, `status`, `data_pulang`, `id_pembimbing`) VALUES
(9, '', '1231232131321311', '0098828211', 'sudan', 'Laki-laki', '2025-10-10', 'KP teapal', '11112333331', 'B 21651', 'B', '', '2027-07-08', 'Lunas', '2027-08-17', 1),
(11, '', '123123678001', '', 'sudan', 'Laki-laki', '2025-10-11', 'KP teapal', '11112333331', 'B 21651', '', '', NULL, '', NULL, 1),
(13, '', '123123678001', '', 'sudan', 'Laki-laki', '2025-10-01', 'kp babakan ', '08927556145', 'B 12367', '', '', '2026-06-10', 'Belum lunas', '2026-07-20', 1),
(14, '1762910059_rpl.png', '1122223333311133', '-', 'aditya', 'Perempuan', '2025-11-04', 'KP malela', '08927556145', 'B 21651', 'B', 'kasep', '2027-11-13', 'Belum lunas', '2027-12-23', 1),
(15, '1762911029_STARRT.PNG', '12312367800222221', '-', 'aditya', 'Laki-laki', '2025-11-05', 'KP malela', '08927556145', 'B 21651', 'B', 'gak ada', '2027-10-17', 'Belum lunas', '2027-11-26', 3);

-- --------------------------------------------------------

--
-- Table structure for table `jamaah_2028`
--

CREATE TABLE `jamaah_2028` (
  `id` int NOT NULL,
  `foto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nik` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `no_porsi` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_lengkap` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_kelamin` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telepon` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_paspor` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `golongan_darah` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `penyakit_bawaan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jadwal_berangkat` date DEFAULT NULL,
  `status` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `data_pulang` date DEFAULT NULL,
  `id_pembimbing` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jamaah_2028`
--

INSERT INTO `jamaah_2028` (`id`, `foto`, `nik`, `no_porsi`, `nama_lengkap`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `telepon`, `no_paspor`, `golongan_darah`, `penyakit_bawaan`, `jadwal_berangkat`, `status`, `data_pulang`, `id_pembimbing`) VALUES
(12, '', '12312321313213', '009882824', 'nurahman', 'Laki-laki', '2025-10-09', 'KP teapal', '11112333331', 'B 21651', 'B', 'QQQ', '2028-11-17', 'Lunas', '2028-12-27', 1),
(15, '', '12312321313213', '-', 'nurahman', 'Laki-laki', '2025-10-15', 'KP teapal', '11112333331', 'B 21651', '', '', '2028-01-16', 'Belum lunas', '2028-02-25', 1),
(17, '', '12312321313213', '0000012331', 'sudan', 'Laki-laki', '2025-10-04', 'kp babakan ', '08927556145', 'B 12367', 'B', 'gak ada', '2029-06-12', 'Lunas', '2029-07-22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jamaah_2029`
--

CREATE TABLE `jamaah_2029` (
  `id` int NOT NULL,
  `foto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nik` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `no_porsi` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_lengkap` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_kelamin` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telepon` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_paspor` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `golongan_darah` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `penyakit_bawaan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jadwal_berangkat` date DEFAULT NULL,
  `status` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `data_pulang` date DEFAULT NULL,
  `id_pembimbing` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jamaah_2029`
--

INSERT INTO `jamaah_2029` (`id`, `foto`, `nik`, `no_porsi`, `nama_lengkap`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `telepon`, `no_paspor`, `golongan_darah`, `penyakit_bawaan`, `jadwal_berangkat`, `status`, `data_pulang`, `id_pembimbing`) VALUES
(3, '', '12312321313213', '-', 'nurahman', 'Laki-laki', '2025-10-10', 'KP teapal', '11112333331', 'B 21651', 'B', 'QQQ', '2029-01-18', 'Belum lunas', '2029-02-27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jamaah_haji`
--

CREATE TABLE `jamaah_haji` (
  `id` int NOT NULL,
  `foto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nik` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `no_porsi` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_lengkap` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_kelamin` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telepon` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_paspor` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `golongan_darah` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `penyakit_bawaan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jadwal_berangkat` date DEFAULT NULL,
  `status` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `data_pulang` date DEFAULT NULL,
  `id_pembimbing` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jamaah_haji`
--

INSERT INTO `jamaah_haji` (`id`, `foto`, `nik`, `no_porsi`, `nama_lengkap`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `telepon`, `no_paspor`, `golongan_darah`, `penyakit_bawaan`, `jadwal_berangkat`, `status`, `data_pulang`, `id_pembimbing`) VALUES
(19, '1760170108_esok_lebih_baik-removebg-preview.png', '12312321313213', '0000012334', 'nurahman', 'Laki-laki', '2025-10-25', 'KP teapal', '11', 'B 21651', 'B', 'gak ada', '2027-08-13', '', '2027-09-22', 1),
(23, '', '12312321313215', '-', 'aditya', 'Laki-laki', '2007-12-04', 'KP malela', '+62 851-4239-5637', 'B 21651', 'o', 'kasep', '2025-10-11', 'Belum lunas', '2025-11-20', 4),
(24, '', '12312321313233', '0000012311', 'nurahman', 'Laki-laki', '2025-10-10', 'gak tau ah cape', '+62 857-2095-8285', 'B 21651', '', '', '2025-10-11', '', '2025-11-20', 1),
(28, '1760323340_ppp.PNG', '123123678044', '-', 'sudan', 'Laki-laki', '2025-10-07', 'kp babakan ', '+62 831-5599-0900', 'B 12367', 'B', 'gak ada', '2026-09-14', 'Belum lunas', '2026-10-24', 1),
(29, '1762748990_pass.png', '123123678008', '-', 'asep kurdirman', 'Laki-laki', '2025-10-30', 'KP teapal', '11', 'B 12367', 'B', 'gak ada', '2026-04-18', 'Belum lunas', '2026-05-28', 1),
(30, '1762749419_Annotation2025-10-06092038.png', '12312321313222', '-', 'aditya', 'Laki-laki', '2025-11-01', 'kp babakan ', '08927556145', 'B 12367', 'B', 'gak ada', '2026-09-13', 'Belum lunas', '2026-10-23', 1),
(31, '1762750143_png-transparent-dashboard-grid-menu-menu-icon-dashboard-line-style-icon.png', '1231236780221', '-', 'nurahman', 'Perempuan', '2025-10-30', 'kp babakan ', '08927556145', 'B 12367', 'B', 'gak ada', '2026-12-19', 'Belum lunas', '2027-01-28', 1),
(32, '', '12312367800154', '211', 'ezz', 'Laki-laki', '2025-11-06', 'df', 'dfg', 'B 12367', 'B', 'gak ada', '2026-11-16', 'Lunas', '2026-12-26', 3),
(33, '1762766115_uu.PNG', '1122223333311111', '00000121122', 'aditya', 'Perempuan', '2025-11-04', 'KP malela', '08927556145', 'B 21651', 'B', 'gak ada', '2026-12-19', 'Lunas', '2027-01-28', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pembimbing_haji`
--

CREATE TABLE `pembimbing_haji` (
  `id` int NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `nik` varchar(30) NOT NULL,
  `telepon` varchar(30) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pembimbing_haji`
--

INSERT INTO `pembimbing_haji` (`id`, `nama_lengkap`, `nik`, `telepon`, `alamat`, `email`, `foto`, `keterangan`) VALUES
(1, 'Agus Nurahman', '123465162543651', '02812366551', 'gak tau ah cape', 'mmm@gmail.com', '1759829713_smk-removebg-preview.png', 'dia suka becanda'),
(3, 'asep kurdirman', '123123678001', '+62 851-4239-5637', 'KP teapal', 'gi@gmail.com', '1760406912_onic-kairi.jpg', 'halo semua nya'),
(4, 'nurahman', '12312321313213', '11112333331', 'KP teapal', 'gi@gmail.com', '1762766865_pass.png', '1231');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int NOT NULL,
  `username` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nik` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `username`, `email`, `nik`, `password`) VALUES
(1, 'uzo', 'uzo@gmail.com', '', '$2y$10$7ZY42vbP1EF8zrHBglenI.YWii380cXIvU88zKAOztMS7l8AbstHe'),
(2, 'hi', 'hu@gmail.com', '', '$2y$10$Qhou6pstEtPVaqUA58n2TeYtLi1r0km6JfQvWHwlaJ9Q1NC7ZIuOC'),
(4, 'fauzi rahayu', 'fauzi@gmail.com', '', '$2y$10$ReXtyOHbvZ8BjZfuSDx/B.DcAS6EdSRTPPCy7S2.56Ij.EGfsMjny'),
(8, 'eww', 'ew@gmail.com', '1122223333311111', '$2y$10$8Cbfcrn0d8j.5e4Zs2n6j.N0ggupiEQiD3UwnZfwHfJ27G/e74doS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jamaah_2027`
--
ALTER TABLE `jamaah_2027`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jamaah_2028`
--
ALTER TABLE `jamaah_2028`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jamaah_2029`
--
ALTER TABLE `jamaah_2029`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fk_pembimbing` (`id_pembimbing`) USING BTREE;

--
-- Indexes for table `jamaah_haji`
--
ALTER TABLE `jamaah_haji`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pembimbing` (`id_pembimbing`);

--
-- Indexes for table `pembimbing_haji`
--
ALTER TABLE `pembimbing_haji`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jamaah_2027`
--
ALTER TABLE `jamaah_2027`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `jamaah_2028`
--
ALTER TABLE `jamaah_2028`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `jamaah_2029`
--
ALTER TABLE `jamaah_2029`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jamaah_haji`
--
ALTER TABLE `jamaah_haji`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `pembimbing_haji`
--
ALTER TABLE `pembimbing_haji`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jamaah_haji`
--
ALTER TABLE `jamaah_haji`
  ADD CONSTRAINT `fk_pembimbing` FOREIGN KEY (`id_pembimbing`) REFERENCES `pembimbing_haji` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
