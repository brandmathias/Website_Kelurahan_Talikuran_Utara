-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Nov 2025 pada 04.44
-- Versi server: 10.1.32-MariaDB
-- Versi PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `talikuran_utara`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500');

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL,
  `judul` varchar(150) NOT NULL,
  `isi` text NOT NULL,
  `tanggal` date NOT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id`, `judul`, `isi`, `tanggal`, `foto`) VALUES
(6, 'Mahasiswa KKT Unsrat Angkatan 144 Resmi Diterima untuk Mengabdi di Kecamatan Kawangkoan Utara', 'Kawangkoan Utara, Minahasa â€“ Mahasiswa Kuliah Kerja Terpadu (KKT) Universitas Sam Ratulangi (Unsrat) Angkatan 144 telah resmi diterima oleh pemerintah dan masyarakat Kecamatan Kawangkoan Utara. Acara penyerahan yang berlangsung khidmat ini dipusatkan di Kantor Desa Kiawa Dua Timur dan menjadi penanda dimulainya masa pengabdian mahasiswa di sepuluh desa dan kelurahan yang tersebar di wilayah tersebut.\r\n\r\nKegiatan ini dihadiri oleh perwakilan pemerintah kecamatan, para hukum tua dan lurah, tokoh masyarakat, serta dosen pembimbing lapangan. Penyerahan ini secara simbolis menandai dimulainya kolaborasi antara dunia akademis dan masyarakat dalam upaya pembangunan dan pemberdayaan di tingkat lokal. Para mahasiswa akan mengimplementasikan berbagai program kerja yang telah dirancang sesuai dengan kebutuhan dan potensi masing-masing lokasi penempatan.\r\n\r\nKoordinator KKT Kecamatan Kawangkoan Utara menyatakan bahwa seluruh mahasiswa siap untuk belajar dan berkontribusi secara langsung di tengah-tengah masyarakat. \"Kami hadir di sini bukan hanya untuk memenuhi kewajiban akademik, tetapi juga untuk menjadi bagian dari masyarakat, belajar dari kearifan lokal, dan memberikan kontribusi nyata melalui program-program yang telah kami siapkan,\" ujarnya.\r\n\r\nPemerintah Kecamatan Kawangkoan Utara menyambut baik kehadiran para mahasiswa dan berharap energi serta inovasi dari kaum intelektual muda ini dapat membawa dampak positif. Program KKT ini diharapkan dapat membantu akselerasi program pemerintah desa dan kelurahan, sekaligus memberikan pengalaman berharga bagi para mahasiswa sebelum terjun ke dunia kerja.\r\n\r\nAdapun kesepuluh kelompok posko mahasiswa KKT Angkatan 144 akan tersebar di lokasi-lokasi berikut:\r\n\r\n1. Posko Kelurahan Uner\r\n2. Posko Kelurahan Talikuran\r\n3. Posko Kelurahan Talikuran Utara\r\n4. Posko Kelurahan Talikuran Barat\r\n5. Posko Desa Kiawa I\r\n6. Posko Desa Kiawa I Utara\r\n7. Posko Desa Kiawa I Barat\r\n8. Posko Desa Kiawa II\r\n9. Posko Desa Kiawa II Timur\r\n10. Posko Desa Kiawa II Barat\r\n\r\nDengan telah resminya penerimaan ini, para mahasiswa KKT Unsrat Angkatan 144 siap memulai perjalanan pengabdian mereka. Kehadiran mereka diharapkan tidak hanya meninggalkan program kerja yang bermanfaat, tetapi juga kenangan dan semangat kolaborasi yang akan terus berlanjut di masa mendatang.', '2025-10-28', 'uploads/1761621950_WhatsApp Image 2025-10-28 at 11.12.06.jpeg'),
(7, 'Gali Potensi dan Kebutuhan, Mahasiswa KKT Unsrat 144 Lakukan Observasi Lapangan di Kelurahan Talikuran Utara', 'Talikuran Utara, Minahasa â€“ Mahasiswa Kuliah Kerja Terpadu (KKT) Universitas Sam Ratulangi (Unsrat) Angkatan 144 dari Posko Kelurahan Talikuran Utara memulai langkah awal pengabdian mereka dengan melaksanakan observasi lapangan secara menyeluruh. Kegiatan ini dilakukan bersama aparat pemerintah Kelurahan Talikuran Utara dan para Kepala Lingkungan setempat pada Jumat, 17 Oktober 2024.\r\n\r\nObservasi ini bertujuan utama untuk memetakan potensi, tantangan, serta kebutuhan nyata yang ada di setiap sudut kelurahan. Dengan turun langsung ke lapangan, para mahasiswa dapat melihat dan mendengar langsung dari masyarakat mengenai kondisi sosial, ekonomi, pendidikan, dan lingkungan yang ada. Keterlibatan para Kepala Lingkungan menjadi krusial karena mereka memahami secara mendalam seluk-beluk wilayahnya masing-masing.\r\n\r\nKoordinator Posko KKT Talikuran Utara menyatakan bahwa data dan informasi yang terkumpul dari observasi ini akan menjadi fondasi utama dalam perancangan program kerja. \"Kami tidak ingin program kerja yang kami buat hanya berdasarkan asumsi. Dengan observasi bersama ini, kami bisa merancang program yang benar-benar relevan, tepat sasaran, dan solutif bagi masyarakat Talikuran Utara,\" jelasnya.\r\n\r\nSelama kegiatan berlangsung, para mahasiswa dibagi ke dalam beberapa tim untuk menyusuri setiap lingkungan. Mereka aktif berdialog dengan warga, mengamati fasilitas umum, serta mendokumentasikan temuan-temuan penting. Interaksi langsung ini juga menjadi ajang perkenalan dan silaturahmi antara mahasiswa dengan warga, membangun kedekatan yang akan mempermudah kolaborasi ke depan.\r\n\r\nLurah Talikuran Utara menyambut positif inisiatif proaktif dari para mahasiswa. \"Kami sangat mengapresiasi semangat mahasiswa yang langsung turun ke lapangan. Keterlibatan mereka sejak tahap awal ini menunjukkan keseriusan untuk memberikan kontribusi terbaik. Kami siap mendukung penuh agar program-program KKT nanti dapat berjalan lancar dan memberikan manfaat maksimal,\" ungkapnya.\r\n\r\nHasil dari observasi ini akan segera dianalisis dan didiskusikan secara internal oleh kelompok mahasiswa untuk kemudian dirumuskan menjadi serangkaian program kerja yang inovatif dan aplikatif. Proses ini memastikan bahwa setiap kegiatan yang akan dilaksanakan selama masa KKT benar-benar lahir dari kebutuhan masyarakat dan untuk kesejahteraan masyarakat Kelurahan Talikuran Utara.', '2025-10-28', 'uploads/1761622498_WhatsApp Image 2025-10-28 at 07.35.32.jpeg'),
(16, 'Transformasi Ikon Daerah: Mahasiswa KKT Unsrat 144 Bersama Warga Sukses Lakukan Kerja Bakti dan Pengecatan Tugu Kacang', 'Talikuran Utara, Minahasa â€“ Semangat kolaborasi dan kepedulian terekam jelas di Kelurahan Talikuran Utara pada Jumat, 24 Oktober 2025. Mahasiswa Kuliah Kerja Terpadu (KKT) Universitas Sam Ratulangi (Unsrat) Angkatan 144 Posko Talikuran Utara, bahu-membahu bersama warga setempat, melaksanakan program ganda: kerja bakti pembersihan dan pengecatan kembali Tugu Kacang.\n\nKegiatan ini merupakan program kerja utama yang diinisiasi oleh mahasiswa KKT sebagai bentuk kepedulian terhadap fasilitas umum dan simbol daerah. Tugu Kacang, yang merupakan lambang perekonomian dan identitas masyarakat Kawangkoan, telah mengalami penurunan estetika akibat kusam dan lumut.\n\nProses restorasi dimulai dengan tahapan kerja bakti pembersihan. Para mahasiswa dan warga bergotong royong menghilangkan lumut, menyapu area sekitar tugu, dan membersihkan kotoran yang menempel. Setelah tugu bersih dan siap, dilanjutkan dengan pengecatan kembali. Warna cat yang mulai pudar kini digantikan dengan lapisan baru yang lebih cerah dan menarik perhatian, membuat Tugu Kacang kini tampil segar dan memukau.\n\nKoordinator posko KKT 144 di Talikuran Utara menyatakan bahwa tujuan kegiatan ini adalah multifungsi. \"Kami ingin tugu ini kembali indah, tetapi yang lebih penting, kami ingin membangkitkan kembali rasa memiliki dan semangat kebersamaan di antara warga. Dengan membersihkan dan mengecatnya bersama, semangat Mapalus dan kebanggaan terhadap ikon daerah juga ikut diperbaharui,\" jelasnya.\n\nPelaksanaan program ini mendapat sambutan hangat dari pemerintah dan warga kelurahan. Keterlibatan aktif para Kepala Lingkungan dan tokoh masyarakat menunjukkan dukungan penuh terhadap inisiatif mahasiswa. Salah seorang tokoh masyarakat setempat mengungkapkan rasa terima kasihnya: \"Kami sangat bersyukur atas inisiatif adik-adik KKT Unsrat. Mereka tidak hanya memberikan kontribusi nyata dalam bentuk tenaga dan material cat, tetapi juga berhasil menyatukan warga dalam kegiatan positif. Tugu kebanggaan kami sekarang terlihat terawat dan bersemangat kembali.\"\n\nDengan tuntasnya kegiatan kerja bakti dan pengecatan Tugu Kacang, para mahasiswa KKT Angkatan 144 Posko Talikuran Utara telah meninggalkan kenangan positif dan warisan berupa simbol daerah yang terawat. Program ini menjadi bukti nyata bahwa kegiatan KKT merupakan perpaduan harmonis antara aksi nyata di lapangan dan pelestarian nilai-nilai komunal.', '2025-11-03', 'uploads/1762137021_1761626320_WhatsApp_Image_2025-10-28_at_12.36.02.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `galeri`
--

CREATE TABLE `galeri` (
  `id` int(11) NOT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `galeri`
--

INSERT INTO `galeri` (`id`, `judul`, `foto`) VALUES
(5, '1', 'uploads/1761754737_boudewijn-boer-eX1s8F9AjeM-unsplash.jpg'),
(6, '2', 'uploads/1761754752_dikaseva-8o4W9LZv6eo-unsplash.jpg'),
(7, '3', 'uploads/1761754762_dinis-bazgutdinov-GlN9riTYDWE-unsplash.jpg'),
(8, '4', 'uploads/1761754774_ilya-zoria-5pGT32puBKo-unsplash.jpg'),
(9, '5', 'uploads/1761754788_karsten-wurth-JVc7HuM8oS8-unsplash.jpg'),
(10, '6', 'uploads/1761754817_mathew-schwartz-mrTp7ivEMq0-unsplash.jpg'),
(11, '7', 'uploads/1761754831_messrro-cO1t2rQ6wMU-unsplash.jpg'),
(12, '8', 'uploads/1761754839_nick-fewings-Bd1MhsLxeRI-unsplash.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
--

CREATE TABLE `laporan` (
  `id` int(11) NOT NULL,
  `nama_pelapor` varchar(100) NOT NULL,
  `kontak` varchar(100) NOT NULL,
  `judul_laporan` varchar(150) NOT NULL,
  `isi_laporan` text NOT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('baru','diproses','selesai') DEFAULT 'baru'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `laporan`
--

INSERT INTO `laporan` (`id`, `nama_pelapor`, `kontak`, `judul_laporan`, `isi_laporan`, `kategori`, `foto`, `video`, `tanggal`, `status`) VALUES
(1, 'Andi', 'Andi@gmail.com', 'Jalan Rusak', 'Jalan Rusak', 'Infrastruktur', NULL, NULL, '2025-11-01 10:19:49', 'baru'),
(2, 'Andi', 'Andi@gmail.com', 'Jalan Rusak', 'Jalan Rusak', 'Infrastruktur', 'uploads/1761992697_6905dff95e389.jpg', '', '2025-11-01 10:24:57', 'baru'),
(3, 'Andi', 'Andi@gmail.com', 'Jalan Rusak', 'Jalan Rusak', 'Infrastruktur', '../uploads/1761994569_6905e749508bf.jpg', NULL, '2025-11-01 10:56:09', 'baru'),
(4, 'Andi', 'Andi@gmail.com', 'Jalan Rusak', 'Andi', 'Keamanan', '../uploads/1761994610_6905e77224675.docx', NULL, '2025-11-01 10:56:50', 'baru'),
(5, 'Andi', 'Andi@gmail.com', 'Jalan Rusak', 'Jalan Rusak', 'Lainnya', NULL, '../uploads/1761994772_6905e8145c8c6.mp4', '2025-11-01 10:59:32', 'baru'),
(6, 'Andi', 'Andi@gmail.com', 'Jalan Rusak', 'Jalan Rusak', 'Lainnya', NULL, NULL, '2025-11-01 11:02:53', 'baru'),
(7, 'Andi', 'Andi@gmail.com', 'Jalan Rusak', 'Jalan Rusak', 'Lainnya', NULL, NULL, '2025-11-01 11:04:01', 'baru'),
(8, 'Andi', 'Andi@gmail.com', 'Jalan Rusak', 'Jalan Rusak', 'Sarana Publik', '../uploads/1761995810_6905ec2217aa9.png', NULL, '2025-11-01 11:16:50', 'baru'),
(9, 'Andi', 'Andi@gmail.com', 'Jalan Rusak', 'Jalan Rusak', 'Infrastruktur', NULL, '../uploads/1761995842_6905ec4262510.mp4', '2025-11-01 11:17:22', 'baru'),
(10, 'Andi', 'Andi@gmail.com', 'Jalan Rusak', 'Jalan Rusak', 'Ekonomi & Usaha', '../uploads/1761995881_6905ec69c0177.docx', NULL, '2025-11-01 11:18:01', 'selesai'),
(11, 'Dimas', 'DImas', 'Lampu Jalan Mati', 'Lampu jalan di tikungan', 'Keamanan', '../uploads/1762094215_69076c8777cea.jpg', NULL, '2025-11-02 14:36:55', 'baru'),
(12, 'Dimas', 'DImas', 'Lampu Jalan Mati', 'Lampu jalan di tikungan', 'Keamanan', '../uploads/1762094245_69076ca57c589.jpg', NULL, '2025-11-02 14:37:25', 'baru'),
(13, 'Dimas', 'DImas@gmail.com', 'Lampu Jalan Mati', 'Lampu jalan di tikungan sudah mati', 'Sarana Publik', '../uploads/1762094300_69076cdc89d28.docx', NULL, '2025-11-02 14:38:20', 'baru'),
(14, 'Dimas', 'Dimas@gmail.com', 'Lampu Jalan Mati', '4 lampu jalan sudah mati', 'Infrastruktur', NULL, '../uploads/1762094358_69076d1663155.mp4', '2025-11-02 14:39:18', 'baru'),
(15, 'Dimas', 'Dimas@gmail.com', 'Lampu Jalan Mati', '4 lampu jalan sudah mati', 'Infrastruktur', NULL, '../uploads/1762094410_69076d4a6d0be.mp4', '2025-11-02 14:40:10', 'baru');

-- --------------------------------------------------------

--
-- Struktur dari tabel `potensi`
--

CREATE TABLE `potensi` (
  `id` int(11) NOT NULL,
  `kategori` varchar(30) NOT NULL,
  `judul` varchar(150) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `potensi`
--

INSERT INTO `potensi` (`id`, `kategori`, `judul`, `deskripsi`, `foto`, `tanggal`) VALUES
(3, 'Pertanian', 'Pertanian', 'Lahan subur Desa Talikuran Utara menghasilkan komoditas unggulan seperti cengkeh, kelapa, dan pala yang menjadi tulang punggung perekonomian warga.', 'uploads/1761668071_dan-meyers-IQVFVH0ajag-unsplash.jpg', '2025-10-28'),
(4, '', 'Perikanan', 'Dengan garis pantai yang panjang, sektor perikanan menyediakan sumber daya laut melimpah, dari ikan segar hingga olahan, yang dipasarkan ke berbagai daerah.', 'uploads/1761713049_photo-1707384337224-8550a7a03fe8.jpg', '0000-00-00'),
(5, '', 'UMKM', 'Keindahan pantai, pemandangan bawah laut, dan keramahan penduduk menjadikan Talikuran Utara destinasi wisata yang menarik untuk dikunjungi.', 'uploads/1761713392_photo-1567131349667-933eb56baec0.jpg', '0000-00-00'),
(9, '', 'Pariwisata', 'Keindahan pantai, pemandangan bawah laut, dan keramahan penduduk menjadikan Talikuran Utara destinasi wisata yang menarik untuk dikunjungi.Keindahan pantai, pemandangan bawah laut, dan keramahan penduduk menjadikan Talikuran Utara destinasi wisata yang menarik untuk dikunjungi.', 'uploads/1762134360_1761713430_photo-1468413253725-0d5181091126.jpg', '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `profil_desa`
--

CREATE TABLE `profil_desa` (
  `id` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `isi` text NOT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `profil_desa`
--

INSERT INTO `profil_desa` (`id`, `judul`, `isi`, `foto`) VALUES
(1, 'Sejarah Desa', 'Kelurahan Talikuran Utara awalnya merupakan bagian dari Talikuran Induk di Kecamatan Kawangkoan Utara, Kabupaten Minahasa. Nama â€œTalikuranâ€ berasal dari tradisi masyarakat masa lampau yang mahir membuat tali dari serabut pohon kelapa atau sawit, disebut â€œputar taliâ€. Wilayah ini dihuni oleh penduduk asli yang berkembang dari kelompok Gautara dan Pemara, kemudian membentuk permukiman baru di wilayah utara karena faktor kenyamanan. Secara administratif, Talikuran Utara resmi dimekarkan berdasarkan SK Bupati Minahasa Nomor 231 Tahun 2008, dengan alasan peningkatan penduduk dan efisiensi pelayanan. Dalam perkembangannya, wilayah ini dikenal religius dan harmonis, memiliki situs bersejarah Waruga â€œKoko Maka Siow Siowâ€, serta perekonomian yang didukung oleh pertanian, kerajinan, dan perdagangan besi tua yang menjadi sumber penghasilan utama masyarakat.', 'uploads/gambarutama.png'),
(2, 'Visi & Misi', 'Menjadi desa maju, sejahtera, dan mandiri berbasis kearifan lokal.', 'visi.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `struktur_pemerintahan`
--

CREATE TABLE `struktur_pemerintahan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `struktur_pemerintahan`
--

INSERT INTO `struktur_pemerintahan` (`id`, `nama`, `jabatan`, `urutan`, `foto`) VALUES
(14, 'Johnny J. Rantung, SE', 'Sekretaris Lurah', 2, 'uploads/1761927972_images.png'),
(15, 'Hery Keintjem, S.IP', 'Seksi Pemerintahan', 3, 'uploads/1761928023_images.png'),
(16, 'Johny J. Montang', 'Kepala Lingkungan I', 4, 'uploads/1761928066_images.png'),
(17, 'Denny A. Tuwo', 'Kepala Lingkungan II', 5, 'uploads/1761928103_images.png'),
(18, 'Pegy O. Pesik', 'Kepala Lingkungan III', 6, 'uploads/1761928140_images.png'),
(19, 'Wenda S. Liwe', 'Kepala Lingkungan IV', 7, 'uploads/1761928191_images.png'),
(20, 'Yeny Samatara', 'Kepala Lingkungan V', 8, 'uploads/1761928229_images.png'),
(21, 'Beri Romi Pou', 'Kepala Lingkungan VI', 9, 'uploads/1761928350_images.png'),
(22, 'Alfian E. Watuseke ', 'Pembantu Kepala Lingkungan I', 10, 'uploads/1761928591_images.png'),
(23, 'Johanus V. Pessy ', 'Pembantu Kepala Lingkungan I ', 11, 'uploads/1761928700_images.png'),
(24, 'Pricilia M. Tuwo ', 'Pembantu Kepala Lingkungan II', 12, 'uploads/1761928816_images.png'),
(25, 'Rifla Y. Pesik ', 'Pembantu Kepala Lingkungan II', 13, 'uploads/1761928909_images.png'),
(26, 'Aldio R. Tuwo ', 'Pembantu Kepala Lingkungan III', 14, 'uploads/1761928947_images.png'),
(27, 'Demly H. Pandelaki ', 'Pembantu Kepala Lingkungan III ', 15, 'uploads/1761929044_images.png'),
(28, 'Dian C. Rompas ', 'Pembantu Kepala Lingkungan IV ', 16, 'uploads/1761929080_images.png'),
(29, 'Frista K. Palandeng ', 'Pembantu Kepala Lingkungan IV', 17, 'uploads/1761929115_images.png'),
(30, 'Rini Mokoagow ', 'Pembantu Kepala Lingkungan V ', 18, 'uploads/1761929179_images.png'),
(31, 'Enjely Y. Pinotoan ', 'Pembantu Kepala Lingkungan V', 19, 'uploads/1761929223_images.png'),
(32, 'Noldi N. Warokka ', 'Pembantu Kepala Lingkungan VI ', 20, 'uploads/1761929261_images.png'),
(33, 'Hernie J. Sajow ', 'Pembantu Kepala Lingkungan VI ', 21, 'uploads/1761929285_images.png'),
(35, 'James Anis', 'Lurah', 1, 'uploads/1762140069_images.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `potensi`
--
ALTER TABLE `potensi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `profil_desa`
--
ALTER TABLE `profil_desa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `struktur_pemerintahan`
--
ALTER TABLE `struktur_pemerintahan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `potensi`
--
ALTER TABLE `potensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `profil_desa`
--
ALTER TABLE `profil_desa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `struktur_pemerintahan`
--
ALTER TABLE `struktur_pemerintahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
