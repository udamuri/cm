-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 29, 2016 at 02:09 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `2016_cm`
--

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1469859803),
('m130524_201442_init', 1469859834);

-- --------------------------------------------------------

--
-- Table structure for table `nestamenu`
--

CREATE TABLE `nestamenu` (
  `menu_id` int(3) NOT NULL,
  `menu_parent_id` int(3) DEFAULT NULL,
  `menu_sort` int(3) DEFAULT NULL,
  `menu_title` varchar(100) DEFAULT NULL,
  `menu_link` varchar(255) DEFAULT NULL,
  `menu_status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nestamenu`
--

INSERT INTO `nestamenu` (`menu_id`, `menu_parent_id`, `menu_sort`, `menu_title`, `menu_link`, `menu_status`) VALUES
(1, 0, 1, 'Home', 'empty', 1),
(2, 0, 2, 'Perfectplaces', 'empty', 1),
(3, 2, 3, 'Lakerentals', 'empty', 1),
(4, 2, 4, 'Mountainskirentals', 'empty', 1),
(5, 0, 5, 'Redawning', 'empty', 1),
(6, 5, 6, 'Booking', 'empty', 1),
(7, 4, 7, 'Jakarta', 'empty', 1),
(8, 6, 8, 'Medan', 'empty', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_content`
--

CREATE TABLE `tbl_content` (
  `content_id` int(15) NOT NULL,
  `content_category_id` int(11) NOT NULL,
  `content_label` varchar(100) NOT NULL,
  `content_desc` text NOT NULL,
  `content_date` datetime NOT NULL,
  `content_status` smallint(1) NOT NULL DEFAULT '1',
  `content_meta_keyword` varchar(256) NOT NULL,
  `content_meta_desc` varchar(256) NOT NULL,
  `content_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_content`
--

INSERT INTO `tbl_content` (`content_id`, `content_category_id`, `content_label`, `content_desc`, `content_date`, `content_status`, `content_meta_keyword`, `content_meta_desc`, `content_user_id`) VALUES
(1, 0, 'Tentang Kami data', '&lt;ol&gt;\r\n	&lt;li&gt;lorem ipsum dolor sit amet&lt;/li&gt;\r\n	&lt;li&gt;lorem ipsum dolor sit amet&lt;/li&gt;\r\n	&lt;li&gt;lorem ipsum dolor sit amet&lt;/li&gt;\r\n	&lt;li&gt;lorem ipsum dolor sit amet&lt;/li&gt;\r\n	&lt;li&gt;lorem ipsum dolor sit amet&lt;/li&gt;\r\n	&lt;li&gt;lorem ipsum dolor sit amet&lt;/li&gt;\r\n	&lt;li&gt;lorem ipsum dolor sit amet&lt;/li&gt;\r\n&lt;/ol&gt;', '2016-08-05 04:24:09', 1, 'bukittinggi, arsyicom, cctv, kota bukittinggi, makasar', 'Tentang arsyicom bukittinggi cctv termurah di bukittinggi jakarta', 1),
(2, 1, 'Berita Hari Ini', '&lt;ul&gt;\r\n	&lt;li&gt;cat_name&lt;/li&gt;\r\n	&lt;li&gt;cat_name&lt;/li&gt;\r\n	&lt;li&gt;cat_name&lt;/li&gt;\r\n	&lt;li&gt;cat_name&lt;/li&gt;\r\n	&lt;li&gt;cat_name&lt;/li&gt;\r\n	&lt;li&gt;cat_name&lt;/li&gt;\r\n	&lt;li&gt;cat_name&lt;/li&gt;\r\n	&lt;li&gt;cat_name&lt;/li&gt;\r\n&lt;/ul&gt;', '2016-08-05 04:28:50', 1, 'berita, artikel, cctv', 'Tentang arsyicom bukittinggi cctv termurah di bukittinggi halo tes lorem ispum', 1),
(3, 0, 'Kerjasama', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur convallis libero vitae nisi iaculis, vitae semper ex ullamcorper. Donec id turpis feugiat, suscipit elit id, molestie magna. Etiam vitae pretium nulla. Donec molestie libero et tortor fermentum, ut maximus sem facilisis. Nunc augue ante, hendrerit vitae efficitur tincidunt, consequat eu nisi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Pellentesque eget massa non mauris rutrum sollicitudin.&lt;/p&gt;\r\n\r\n&lt;p&gt;Sed fermentum hendrerit velit ut auctor. Suspendisse imperdiet odio lorem, at bibendum orci dictum in. Maecenas hendrerit dapibus ante, vitae accumsan massa pretium ac. Quisque eget venenatis dolor. In hac habitasse platea dictumst. Quisque rhoncus libero viverra, dignissim lacus in, vestibulum elit. Nullam ultrices quam rhoncus, tempor turpis id, pretium ex. Sed metus magna, pulvinar non aliquet vel, tempus a justo. Vivamus nibh dolor, aliquam quis dapibus eget, gravida et orci. Mauris placerat risus non magna aliquet posuere. Pellentesque hendrerit mi nibh, eget consectetur libero semper nec. Proin at accumsan nibh. Phasellus dolor augue, ultricies non purus eu, placerat tristique enim. Vivamus eget mi egestas, consectetur nibh eget, egestas tortor.&lt;/p&gt;\r\n\r\n&lt;p&gt;Fusce malesuada quam ut dolor sodales, id ullamcorper dolor auctor. Ut non volutpat quam, sit amet auctor orci. Sed accumsan sollicitudin turpis blandit sodales. Duis cursus est a ligula pulvinar, ac fringilla nisi maximus. Morbi dictum ipsum sed nisl condimentum, a fermentum metus aliquet. Pellentesque lacinia massa non lacus laoreet, ac tempus velit rutrum. Ut aliquet nibh sed accumsan volutpat. Nulla eu ligula sit amet urna lobortis posuere nec a tellus. Praesent at nunc ex. Vestibulum et leo enim. Sed vel risus diam. Nunc fermentum, orci sit amet sagittis euismod, ligula metus gravida augue, vel interdum sem lorem non est. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Proin vel nisi eu odio tempus vestibulum. Nullam fringilla quam id neque finibus, eu commodo risus mollis. Nam consectetur, sem a egestas convallis, lectus urna porttitor ligula, non ornare dui elit nec sapien.&lt;/p&gt;\r\n\r\n&lt;p&gt;Suspendisse mollis neque a justo hendrerit, quis mattis mauris elementum. Vivamus et rhoncus neque. Donec ac purus ut urna pulvinar volutpat ut sed quam. Duis laoreet dolor mattis tincidunt lobortis. Proin posuere id lectus sit amet pulvinar. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut a enim at ante finibus porta. Aliquam sagittis dolor ut arcu pretium, id malesuada felis elementum. Aenean efficitur sodales mi et mattis. In ut lorem at lectus pharetra accumsan. Praesent vitae erat blandit, dictum mi et, aliquam ex. Duis viverra arcu eget imperdiet facilisis. Vestibulum eget augue feugiat, iaculis libero scelerisque, luctus magna. Fusce non sollicitudin ipsum, vel rhoncus eros. Pellentesque rhoncus urna vitae tellus condimentum, ac eleifend libero posuere. Nullam auctor dolor ac molestie aliquet.&lt;/p&gt;\r\n\r\n&lt;p&gt;In auctor est eget dictum rutrum. Quisque cursus massa maximus, pretium ligula vitae, sodales odio. Praesent et quam eu nisi varius porta quis non nibh. Aenean semper eu lectus vel elementum. Nam magna magna, sollicitudin eu convallis nec, mattis id purus. Praesent id erat elementum, pharetra sem sit amet, efficitur ante. Nunc pulvinar lorem nec mauris ornare, ac placerat ante dapibus. Sed condimentum, nunc et imperdiet semper, magna dolor consequat nibh, eu eleifend tellus sapien ut nisl. Nulla id lorem elementum, vulputate turpis ut, aliquam est. Phasellus vitae nibh massa. Suspendisse consectetur placerat justo sed iaculis. In varius dui at sem eleifend porta. Aliquam eu facilisis nisl. Nam gravida elit at porttitor dictum.&lt;/p&gt;', '2016-08-13 06:15:36', 1, 'Kerjasama', 'Kerjasama dengan Arsyicom', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_content_category`
--

CREATE TABLE `tbl_content_category` (
  `cat_id` int(11) NOT NULL,
  `cat_parent_id` int(11) NOT NULL,
  `cat_name` varchar(100) NOT NULL,
  `cat_status` smallint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_content_category`
--

INSERT INTO `tbl_content_category` (`cat_id`, `cat_parent_id`, `cat_name`, `cat_status`) VALUES
(1, 0, 'Berita Arsyicom', 1),
(2, 0, 'Artikel Arsyicom', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_file`
--

CREATE TABLE `tbl_file` (
  `file_id` int(15) NOT NULL,
  `file_name` varchar(256) NOT NULL,
  `file_folder` varchar(10) NOT NULL,
  `file_type` varchar(50) NOT NULL,
  `file_size` int(11) NOT NULL,
  `file_date_upload` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_file`
--

INSERT INTO `tbl_file` (`file_id`, `file_name`, `file_folder`, `file_type`, `file_size`, `file_date_upload`, `user_id`) VALUES
(1, 'IMG-20160927-WA0001.jpg', '2016_11/', 'image/jpeg', 130783, '2016-11-06 13:17:01', 1),
(2, 'IMG-20160927-WA0002.jpg', '2016_11/', 'image/jpeg', 62569, '2016-11-06 13:17:02', 1),
(3, 'IMG-20160927-WA0003.jpg', '2016_11/', 'image/jpeg', 356068, '2016-11-06 13:17:02', 1),
(4, 'IMG-20160927-WA0004.jpg', '2016_11/', 'image/jpeg', 91854, '2016-11-06 13:17:02', 1),
(5, 'IMG-20160928-WA0001.jpg', '2016_12/', 'image/jpeg', 52687, '2016-12-20 13:58:39', 1),
(6, 'IMG-20160928-WA0000.jpg', '2016_12/', 'image/jpeg', 122880, '2016-12-20 13:58:39', 1),
(7, 'IMG-20160927-WA0004.jpg', '2016_12/', 'image/jpeg', 91854, '2016-12-20 13:58:39', 1),
(8, 'IMG-20160927-WA0003.jpg', '2016_12/', 'image/jpeg', 356068, '2016-12-20 13:58:39', 1),
(9, 'IMG-20161007-WA0005.jpg', '2016_12/', 'image/jpeg', 240687, '2016-12-29 13:58:10', 1),
(10, 'IMG-20161006-WA0001.jpg', '2016_12/', 'image/jpeg', 131597, '2016-12-29 13:58:11', 1),
(11, 'IMG-20161005-WA0003.jpg', '2016_12/', 'image/jpeg', 24770, '2016-12-29 13:58:11', 1),
(12, 'IMG-20161005-WA0001.jpg', '2016_12/', 'image/jpeg', 107477, '2016-12-29 13:58:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `menu_id` int(11) NOT NULL,
  `menu_rang` int(11) NOT NULL,
  `menu_parent_id` int(11) NOT NULL,
  `menu_name` varchar(256) NOT NULL,
  `menu_icon` varchar(255) NOT NULL,
  `menu_publish` enum('1','0') NOT NULL,
  `menu_link_module` varchar(100) NOT NULL,
  `menu_url` varchar(256) NOT NULL,
  `menu_description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`menu_id`, `menu_rang`, `menu_parent_id`, `menu_name`, `menu_icon`, `menu_publish`, `menu_link_module`, `menu_url`, `menu_description`) VALUES
(1, 0, 0, 'Profile Sekolah', '<i class="fa fa-university"></i>', '1', '0', '', ''),
(3, 1, 1, 'Sambutan Kepala Sekolah', '', '1', '8', '', ''),
(4, 2, 1, 'Sejarah Sekolah', '', '1', '10', '', ''),
(5, 3, 1, 'Visi Dan Misi', '', '1', '7', '', ''),
(6, 4, 1, 'Tujuan Sekolah', '', '1', '9', '', ''),
(7, 5, 1, 'Semboyan Sekolah', '', '1', '4', '', ''),
(8, 6, 1, 'Unggulan Sekolah', '', '1', '20', '', ''),
(9, 7, 1, 'Program Kerja', '', '1', '21', '', ''),
(10, 8, 0, 'Fasilitas', '', '1', '0', '', ''),
(11, 9, 10, 'Ruang Kepala Sekolah', '', '1', '22', '', ''),
(12, 10, 10, 'Ruang Guru', '', '1', '23', '', ''),
(13, 11, 10, 'Lab Komputer dan Perpustakaan', '', '1', '24', '', ''),
(14, 12, 10, 'Prestasi', '', '1', '25', '', ''),
(15, 13, 0, 'Berita', '', '1', '1', '', ''),
(16, 14, 0, 'Agenda Kegiatan', '', '1', '31', '', ''),
(17, 17, 0, 'Kontak', '', '1', 'contact', '', ''),
(18, 16, 0, 'FAQ', '', '1', '27', '', ''),
(19, 15, 0, 'Gallery', '', '1', '26', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_options`
--

CREATE TABLE `tbl_options` (
  `option_id` int(11) NOT NULL,
  `option_name` varchar(200) NOT NULL,
  `option_label` varchar(255) NOT NULL,
  `option_value` text NOT NULL,
  `option_autoload` varchar(20) NOT NULL,
  `option_status` enum('0','1','2','3','4','5','6','7','8','9','0') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_options`
--

INSERT INTO `tbl_options` (`option_id`, `option_name`, `option_label`, `option_value`, `option_autoload`, `option_status`) VALUES
(1, '_blog_name', 'Website Name', 'Bukittinggi', 'text', '1'),
(2, '_blog_description', 'Website Description', 'Web Profile Muri Budiman', 'textarea', '1'),
(3, '_meta_title', 'Meta Title', 'Muri', 'text', '1'),
(4, '_meta_description', 'Meta Description', 'Web Profile Muri Budiman', 'textarea', '1'),
(5, '_facebook', 'Facebook (Link)', 'https://facebook.com/muribudiman/', 'text', '2'),
(6, '_twitter', 'Twitter (Link)', 'https://twitter.com/muribudiman/', 'text', '2'),
(7, '_pinterest', 'Pinterest (Link)', 'https://www.pinterest.com/muribudiman', 'text', '2'),
(8, '_dribbble', 'Dribbble (Link)', 'https://dribbble.com/', 'text', '2'),
(9, '_meta_keyword', 'Keyword', 'indonesia, jakarta, bukittinggi, yogyakarta, SMA Bukittinggi, SMA Swasta, SMA Muhammadiyah Bukittinggi', 'textarea', '1'),
(10, '_email_setting', 'Email', 'udamuri@gmail.com', 'email', '1'),
(11, '_password_email', 'Password Email', '123456789', 'password', '1'),
(12, '_flick', 'Flickr feed', '130044503@N03', 'text', '2'),
(13, '_google_map', 'Google Map (lang, lat)', '-0.316953,100.3850244', 'text', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `setting_id` int(11) NOT NULL,
  `setting_name` varchar(100) NOT NULL,
  `setting_content` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_setting`
--

INSERT INTO `tbl_setting` (`setting_id`, `setting_name`, `setting_content`) VALUES
(1, 'Address', 'Jl. Kehakiman No. 268 Belakang Balok '),
(2, 'phone', '0752-33788'),
(3, 'Email', 'kami@arsyicom.co.id'),
(4, 'facebook', 'https://facebook.com/arsyicom.bkt'),
(5, 'instagram', 'https://www.instagram.com/muribudiman'),
(6, 'datat witter', 'https://www.twitter.com/muribudiman');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `level` smallint(4) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `level`, `created_at`, `updated_at`) VALUES
(1, 'muribudiman', 'bH6TzAW14WCsApOrNJa9xCXMURJD-tYO', '$2y$13$ZhJaFCaf24xdlkUoNA9vV.9jxLTLz5XXl8jYR14jzlrAeUSKzRGHm', NULL, 'udamuri@gmail.com', 10, 84, 1469931763, 1477723541);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `nestamenu`
--
ALTER TABLE `nestamenu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `tbl_content`
--
ALTER TABLE `tbl_content`
  ADD PRIMARY KEY (`content_id`),
  ADD KEY `content_user_id` (`content_user_id`);

--
-- Indexes for table `tbl_content_category`
--
ALTER TABLE `tbl_content_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `tbl_file`
--
ALTER TABLE `tbl_file`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `tbl_options`
--
ALTER TABLE `tbl_options`
  ADD PRIMARY KEY (`option_id`),
  ADD UNIQUE KEY `option_name` (`option_name`);

--
-- Indexes for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nestamenu`
--
ALTER TABLE `nestamenu`
  MODIFY `menu_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_content`
--
ALTER TABLE `tbl_content`
  MODIFY `content_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_content_category`
--
ALTER TABLE `tbl_content_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_file`
--
ALTER TABLE `tbl_file`
  MODIFY `file_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
