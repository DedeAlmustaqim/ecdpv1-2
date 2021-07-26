/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : db_ecdp

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2021-01-07 12:07:29
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `admin`
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id_user` varchar(16) NOT NULL,
  `id_akses` int(11) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE,
  KEY `username` (`username`) USING BTREE,
  KEY `id_akses` (`id_akses`) USING BTREE,
  CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id_akses`) REFERENCES `tbl_akses` (`id_akses`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('fi7js8XE0cp46ZCl', '5', 'kejaksaan', '117a78d988cf9dd02f0b849ddc457232', 'aaaaaaaaaa', '1212121212121212121', 'pm@pn.com', '2021-01-06 10:18:55', null, '2021-01-06 10:19:29');
INSERT INTO `admin` VALUES ('kfOB4iuP5lE01nab', '1', 'SuperEcdp', 'e10adc3949ba59abbe56e057f20f883e', 'Dede Almustaqim, S.kom', null, 'simpel@simpel.com', '2020-08-21 00:00:00', null, '2021-01-06 10:18:24');
INSERT INTO `admin` VALUES ('kSaCrD4AVZpy3zJP', '2', 'AdminEcdp', '117a78d988cf9dd02f0b849ddc457232', 'Dede Almustaqim', '1962042019980310001', 'simpel@simpel.com', '2020-08-21 00:00:00', '2021-01-06 09:28:49', '2021-01-06 09:59:19');
INSERT INTO `admin` VALUES ('mSaCrD4A1Zpy3zJP', '3', 'VerifikatorEcdp', 'e10adc3949ba59abbe56e057f20f883e', 'PANMUD PIDANA', '1111111111111111111', 'edit@simpel.com', '2020-08-21 00:00:00', '2020-10-14 15:36:00', '2020-12-01 10:53:50');
INSERT INTO `admin` VALUES ('UTArQPgvWi2F6uks', '5', 'kejari_bartim', '0b0bcd2df1518f1cbb06999c3783d3b5', 'Muhammad Noor', '199005272019021002', 'aamnoor89@gmail.com', '2021-01-06 09:28:28', null, '2021-01-06 09:32:50');

-- ----------------------------
-- Table structure for `apikey`
-- ----------------------------
DROP TABLE IF EXISTS `apikey`;
CREATE TABLE `apikey` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `nomor` varchar(13) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `api_key` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of apikey
-- ----------------------------
INSERT INTO `apikey` VALUES ('1', 'Orion', '08576666762', null, 'asascxzcahsjahsjkbacjsbchjsbacsahcjs');

-- ----------------------------
-- Table structure for `tbl_akses`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_akses`;
CREATE TABLE `tbl_akses` (
  `id_akses` int(11) NOT NULL AUTO_INCREMENT,
  `hak_akses` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_akses`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tbl_akses
-- ----------------------------
INSERT INTO `tbl_akses` VALUES ('1', 'Superadmin');
INSERT INTO `tbl_akses` VALUES ('2', 'Adminstrator');
INSERT INTO `tbl_akses` VALUES ('3', 'Verifikator');
INSERT INTO `tbl_akses` VALUES ('4', 'Operator');
INSERT INTO `tbl_akses` VALUES ('5', 'Kejaksaan');

-- ----------------------------
-- Table structure for `tbl_brg_ijin_sita`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_brg_ijin_sita`;
CREATE TABLE `tbl_brg_ijin_sita` (
  `id_brg_ijin_sita` varchar(25) NOT NULL,
  `id_ijin_sita` varchar(25) DEFAULT NULL,
  `nm_brg` varchar(100) DEFAULT NULL,
  `jml` int(10) DEFAULT NULL,
  `lokasi_sita` varchar(100) DEFAULT NULL,
  `plk_sita` varchar(100) DEFAULT NULL,
  `pemilik` varchar(100) DEFAULT NULL,
  `ket` varchar(255) DEFAULT NULL,
  `urut_brg` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`urut_brg`,`id_brg_ijin_sita`) USING BTREE,
  KEY `tbl_brg_ijin_sita_ibfk_1` (`id_ijin_sita`) USING BTREE,
  CONSTRAINT `tbl_brg_ijin_sita_ibfk_1` FOREIGN KEY (`id_ijin_sita`) REFERENCES `tbl_ijinsita` (`id_ijin_sita`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tbl_brg_ijin_sita
-- ----------------------------
INSERT INTO `tbl_brg_ijin_sita` VALUES ('7V3S4I81kiNj5WusBnGgYRfzU', 'n8duO576y9ZjEYoHPeclaUwbB', 'NARKOTIKA YANG DIDUGA JENIS HEROIN', '1000', 'AMPAH', 'BRIPTU RYAN RAJAB SHOBARRY', 'AMAT', '-', '2');
INSERT INTO `tbl_brg_ijin_sita` VALUES ('Mfk0Id46Rlph8am15KjtNTwHi', 'iZV03jCb7ncIMAPX1uvfptm8D', 'HP', '1', 'TAMIANG LAYANG', 'PURWANTO', 'JEKY', '-', '3');
INSERT INTO `tbl_brg_ijin_sita` VALUES ('SKkPp8xciaswf7F4rQ2X5b0Um', 'nRFbrUVg7kE8Ixe21MoNBPhpG', 'motor', '1', 'tampa', 'jawdak', 'gege', '1 (satu) buah sepeda motor nosin/noka 5754775/56556356', '4');
INSERT INTO `tbl_brg_ijin_sita` VALUES ('adgo6Mqb1ZPsSDLCOzKUNtl8j', 'knxNRrcT0hICWGMz2jtPae65O', 'RRGDG', '33', 'MAWANI', 'JEKY', 'JEKY', 'DSFGH', '5');
INSERT INTO `tbl_brg_ijin_sita` VALUES ('jqOBNZnhTUsAoktJDV5Y2ga9u', 'knxNRrcT0hICWGMz2jtPae65O', 'DADGADF', '3', 'MAWANI', 'JEKY', 'JEKY', 'DFGDRG', '6');
INSERT INTO `tbl_brg_ijin_sita` VALUES ('bhRnJKuA63GW4ZVSg2UPcdo0M', 'Al563mx9Bh1TW8ytLIbkZwXVp', 'motor', '1', 'Hayaping', 'Briptu Roy Dianto', 'Indre', '1 unit motor dengan merk yamaha', '7');
INSERT INTO `tbl_brg_ijin_sita` VALUES ('oXhCZdSFJNzRlPfEW4IM5TvaG', 'nRFbrUVg7kE8Ixe21MoNBPhpG', 'handphone', '2', 'tampa', 'jawdak', 'gege', '2 (dua) buah Handphone merk oppo', '8');
INSERT INTO `tbl_brg_ijin_sita` VALUES ('i1KXNTGSDVnP8razRdEIO0j5g', 'AhaFIpwdlTnqSvmrRBJXi8Gu4', 'PAKAIAN', '4', 'BAMBULUNG', 'SUPARJO', 'PAK HAJI', '1 BAJU BIRU', '9');
INSERT INTO `tbl_brg_ijin_sita` VALUES ('kCWYq6avy97DtwFULN5O1QJTR', '8IoCHKwUB04Z2qzhJenLFRDya', 'Motor', '2', 'Benua lima', 'Payung', 'Roy', 'Disita', '10');
INSERT INTO `tbl_brg_ijin_sita` VALUES ('9TpLMlJNa4BKfxvz60eA8UHCq', '8IoCHKwUB04Z2qzhJenLFRDya', 'Mobil', '1', 'Benua lima', 'Payung', 'Roy', 'Disita', '11');
INSERT INTO `tbl_brg_ijin_sita` VALUES ('ns7UxDAFIWym4BPXoTpdLHjgh', 'L1HrGOwVB05zkc9NfolYApDCZ', 'motor', '1', 'Dambung', 'AIPDA MAHMUDI', 'MUIS', '-', '12');
INSERT INTO `tbl_brg_ijin_sita` VALUES ('nukaUYdP1fHs0E6xArRbytmZJ', '2pgrUKw6NDv7CX1j385ftebsL', 'RANMOR RODA 4', '1', 'DESA TAMPA', 'BRIPTU ARUL', 'AMAT', 'MOBIL TOYOTA AVANZA WARNA MERAH NO.POL. : DA 8980 AA', '13');
INSERT INTO `tbl_brg_ijin_sita` VALUES ('GRgBqLKXTfEOD3AoP4Qb0WNMt', 'L1HrGOwVB05zkc9NfolYApDCZ', 'Mobil', '1', 'Ampah', 'AIPDA MAHMUDI', 'KINUY', '-', '14');
INSERT INTO `tbl_brg_ijin_sita` VALUES ('bH6gfUQluJec2LY7hv9PtWBVj', '2pgrUKw6NDv7CX1j385ftebsL', 'RANMOR R2', '1', 'DESA TAMPA', 'BRIPKA ADUL', 'INUR', 'SEPEDA MOTOR SUZUKI GSX 150 WARNA HIJAU NO.POL. : KH 2323 AA', '15');

-- ----------------------------
-- Table structure for `tbl_brg_ijin_sita_p`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_brg_ijin_sita_p`;
CREATE TABLE `tbl_brg_ijin_sita_p` (
  `id_brg_ijin_sita` varchar(25) NOT NULL,
  `id_ijin_sita` varchar(25) DEFAULT NULL,
  `nm_brg` varchar(100) DEFAULT NULL,
  `jml` int(10) DEFAULT NULL,
  `lokasi_sita` varchar(100) DEFAULT NULL,
  `plk_sita` varchar(100) DEFAULT NULL,
  `pemilik` varchar(100) DEFAULT NULL,
  `ket` varchar(255) DEFAULT NULL,
  `urut_brg` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`urut_brg`,`id_brg_ijin_sita`) USING BTREE,
  KEY `tbl_brg_ijin_sita_ibfk_1` (`id_ijin_sita`) USING BTREE,
  CONSTRAINT `tbl_brg_ijin_sita_p_ibfk_1` FOREIGN KEY (`id_ijin_sita`) REFERENCES `tbl_ijinsita_p` (`id_ijin_sita`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tbl_brg_ijin_sita_p
-- ----------------------------
INSERT INTO `tbl_brg_ijin_sita_p` VALUES ('xwjA7olEcDFMnHm5UzYWXkOPC', 'nDY2sOtAPSEpfBk8arRL157ol', 'Mototr', '2', 'Benua lima', 'Payung', 'Roy', 'Disita', '2');

-- ----------------------------
-- Table structure for `tbl_brg_psita`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_brg_psita`;
CREATE TABLE `tbl_brg_psita` (
  `id_brg_psita` varchar(25) NOT NULL,
  `id_psita` varchar(25) DEFAULT NULL,
  `nm_brg` varchar(100) DEFAULT NULL,
  `jml` int(10) DEFAULT NULL,
  `lokasi_sita` varchar(100) DEFAULT NULL,
  `plk_sita` varchar(100) DEFAULT NULL,
  `pemilik` varchar(100) DEFAULT NULL,
  `ket` varchar(255) DEFAULT NULL,
  `urut_brg` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`urut_brg`,`id_brg_psita`) USING BTREE,
  KEY `tbl_brg_ijin_sita_ibfk_1` (`id_psita`) USING BTREE,
  CONSTRAINT `tbl_brg_psita_ibfk_1` FOREIGN KEY (`id_psita`) REFERENCES `tbl_psita` (`id_psita`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tbl_brg_psita
-- ----------------------------
INSERT INTO `tbl_brg_psita` VALUES ('cmy8tNnRKHswfThFWbgCVY2xQ', 'A8lewoatBskNEu6xRPCI7q1bz', 'motor', '1', 'ampah', 'budi', 'jaki', '-', '2');
INSERT INTO `tbl_brg_psita` VALUES ('CNRX0EQdYiJHDxALrztZGfpI3', 'D27FzofhEKXUTMulpAg16tvxb', 'motor', '10', 'Unsum', 'BRIPKA JEKI', 'H. ABDUL', '-', '3');
INSERT INTO `tbl_brg_psita` VALUES ('oLZMWzB53uImbXrQwlFSNqkVd', 'D27FzofhEKXUTMulpAg16tvxb', 'Tongkang', '1', 'Sungai Barito', 'BRIPKA JEKI', 'H. DARBUT', 'dengan No. Lambung G-13KI', '4');
INSERT INTO `tbl_brg_psita` VALUES ('I0eWajd7CVFTklEOcMb3uN8xn', 'A8lewoatBskNEu6xRPCI7q1bz', 'mobil', '2', 'ampah', 'budi', 'jaki', '-', '5');
INSERT INTO `tbl_brg_psita` VALUES ('IxpWmFtR2GlnC91QHhcNku5DL', 'X1BSCE8w20bxdgAUDkVo4Jnpq', 'motor', '1', 'Hayaping', 'Briptu Roy Dianto', 'Indre', '1 Unit Motoe dengan merk yamaha', '6');
INSERT INTO `tbl_brg_psita` VALUES ('FPoarLCzgsSW6JkfZUD03uTt7', 'nbyOkftixeEG1CDvT5hpwojFz', 'motor', '1', 'Hayaping', 'Briptu Roy Dianto', 'Indre', '1 unit motor merk yamaha', '7');

-- ----------------------------
-- Table structure for `tbl_brg_psita_p`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_brg_psita_p`;
CREATE TABLE `tbl_brg_psita_p` (
  `id_brg_psita` varchar(25) NOT NULL,
  `id_psita` varchar(25) DEFAULT NULL,
  `nm_brg` varchar(100) DEFAULT NULL,
  `jml` int(10) DEFAULT NULL,
  `lokasi_sita` varchar(100) DEFAULT NULL,
  `plk_sita` varchar(100) DEFAULT NULL,
  `pemilik` varchar(100) DEFAULT NULL,
  `ket` varchar(255) DEFAULT NULL,
  `urut_brg` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`urut_brg`,`id_brg_psita`) USING BTREE,
  KEY `tbl_brg_ijin_sita_ibfk_1` (`id_psita`) USING BTREE,
  CONSTRAINT `tbl_brg_psita_p_ibfk_1` FOREIGN KEY (`id_psita`) REFERENCES `tbl_psita_p` (`id_psita`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tbl_brg_psita_p
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_ijinsita`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_ijinsita`;
CREATE TABLE `tbl_ijinsita` (
  `id_ijin_sita` varchar(25) DEFAULT NULL,
  `urut_sita` int(11) NOT NULL AUTO_INCREMENT,
  `no_smohon_sita` varchar(100) DEFAULT NULL,
  `id_unit` varchar(16) DEFAULT NULL,
  `edoc_smohon` varchar(255) DEFAULT NULL,
  `edoc_lap_pol_intel` varchar(255) DEFAULT NULL,
  `edoc_penetapan` varchar(255) DEFAULT NULL,
  `edoc_sp` varchar(255) DEFAULT NULL,
  `created_at_sita` timestamp NULL DEFAULT NULL,
  `updated_at_sita` timestamp NULL DEFAULT NULL,
  `create_by_sita` varchar(255) DEFAULT NULL,
  `update_by_sita` varchar(255) DEFAULT NULL,
  `validasi` int(1) DEFAULT '0',
  `verif_date` timestamp NULL DEFAULT NULL,
  `verif_by` varchar(100) DEFAULT NULL,
  `count_brg` bigint(11) DEFAULT '0',
  `count_jml` bigint(11) DEFAULT '0',
  `verif_doc` varchar(255) DEFAULT NULL,
  `edoc_spdp` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`urut_sita`) USING BTREE,
  UNIQUE KEY `id_smohon_gd` (`id_ijin_sita`) USING BTREE,
  KEY `tbl_ijinsita_ibfk_1` (`id_unit`) USING BTREE,
  CONSTRAINT `tbl_ijinsita_ibfk_1` FOREIGN KEY (`id_unit`) REFERENCES `tbl_unit` (`id_unit`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tbl_ijinsita
-- ----------------------------
INSERT INTO `tbl_ijinsita` VALUES ('n8duO576y9ZjEYoHPeclaUwbB', '3', 'B/200/XII/RES.4.2./2020/NARKOBA', 'L52MjJKhp9i78Hfk', 'n8duO576y9ZjEYoHPeclaUwbB_s_mohon.pdf', 'n8duO576y9ZjEYoHPeclaUwbB_s_lap.pdf', 'n8duO576y9ZjEYoHPeclaUwbB_pen_tersangka.pdf', 'n8duO576y9ZjEYoHPeclaUwbB_perintah.pdf', '2020-12-03 09:23:12', null, 'RYAN RAJAB SHOBARRY', null, '2', '2020-12-03 09:42:20', 'PANMUD PIDANA', '1', '1000', 'n8duO576y9ZjEYoHPeclaUwbB_verif_sita.pdf', 'n8duO576y9ZjEYoHPeclaUwbB_spdp.pdf');
INSERT INTO `tbl_ijinsita` VALUES ('iZV03jCb7ncIMAPX1uvfptm8D', '4', 'B/111/XI/2020/RESBARTIM/SATRESKRIM', 'L52MjJKhp9i78Hfk', 'iZV03jCb7ncIMAPX1uvfptm8D_s_mohon.pdf', 'iZV03jCb7ncIMAPX1uvfptm8D_s_lap.pdf', 'iZV03jCb7ncIMAPX1uvfptm8D_pen_tersangka.pdf', 'iZV03jCb7ncIMAPX1uvfptm8D_perintah.pdf', '2020-12-03 09:24:23', '2020-12-03 09:24:51', 'SOFIAN', 'SOFIAN', '2', '2020-12-03 09:42:13', 'PANMUD PIDANA', '1', '1', 'iZV03jCb7ncIMAPX1uvfptm8D_verif_sita.pdf', 'iZV03jCb7ncIMAPX1uvfptm8D_spdp.pdf');
INSERT INTO `tbl_ijinsita` VALUES ('knxNRrcT0hICWGMz2jtPae65O', '5', 'B/23/III/2020/POLSEK', 'Ch1vtVoF9qWrczX7', 'knxNRrcT0hICWGMz2jtPae65O_s_mohon.pdf', 'knxNRrcT0hICWGMz2jtPae65O_s_lap.pdf', 'knxNRrcT0hICWGMz2jtPae65O_pen_tersangka.pdf', 'knxNRrcT0hICWGMz2jtPae65O_perintah.pdf', '2020-12-03 09:24:56', null, 'MARKO SUTRISNO', null, '2', '2020-12-03 09:42:25', 'PANMUD PIDANA', '2', '36', 'knxNRrcT0hICWGMz2jtPae65O_verif_sita.pdf', 'knxNRrcT0hICWGMz2jtPae65O_spdp.pdf');
INSERT INTO `tbl_ijinsita` VALUES ('AhaFIpwdlTnqSvmrRBJXi8Gu4', '6', 'B/10/XII/2020/POLSEK/P.KARAU', 'N0Iq4KbHQRXzGxPg', 'AhaFIpwdlTnqSvmrRBJXi8Gu4_s_mohon.pdf', 'AhaFIpwdlTnqSvmrRBJXi8Gu4_s_lap.pdf', 'AhaFIpwdlTnqSvmrRBJXi8Gu4_pen_tersangka.pdf', 'AhaFIpwdlTnqSvmrRBJXi8Gu4_perintah.pdf', '2020-12-03 09:25:18', null, 'ARIEF RACHMAN S', null, '2', '2020-12-03 09:42:06', 'PANMUD PIDANA', '1', '4', 'AhaFIpwdlTnqSvmrRBJXi8Gu4_verif_sita.pdf', 'AhaFIpwdlTnqSvmrRBJXi8Gu4_spdp.pdf');
INSERT INTO `tbl_ijinsita` VALUES ('nRFbrUVg7kE8Ixe21MoNBPhpG', '7', '090909', 'Xtwh09RQUOZl1Ioz', 'nRFbrUVg7kE8Ixe21MoNBPhpG_s_mohon.pdf', 'nRFbrUVg7kE8Ixe21MoNBPhpG_s_lap.pdf', 'nRFbrUVg7kE8Ixe21MoNBPhpG_pen_tersangka.pdf', 'nRFbrUVg7kE8Ixe21MoNBPhpG_perintah.pdf', '2020-12-03 09:25:45', null, 'JODI SURYATNA', null, '2', '2020-12-03 09:41:44', 'PANMUD PIDANA', '2', '3', 'nRFbrUVg7kE8Ixe21MoNBPhpG_verif_sita.pdf', 'nRFbrUVg7kE8Ixe21MoNBPhpG_spdp.pdf');
INSERT INTO `tbl_ijinsita` VALUES ('Al563mx9Bh1TW8ytLIbkZwXVp', '8', '01', 'rMeiXDVgucN8HOwF', 'Al563mx9Bh1TW8ytLIbkZwXVp_s_mohon.pdf', 'Al563mx9Bh1TW8ytLIbkZwXVp_s_lap.pdf', 'Al563mx9Bh1TW8ytLIbkZwXVp_pen_tersangka.pdf', 'Al563mx9Bh1TW8ytLIbkZwXVp_perintah.pdf', '2020-12-03 09:25:47', null, 'ROY DIANTO', null, '2', '2020-12-03 09:41:38', 'PANMUD PIDANA', '1', '1', 'Al563mx9Bh1TW8ytLIbkZwXVp_verif_sita.pdf', 'Al563mx9Bh1TW8ytLIbkZwXVp_spdp.pdf');
INSERT INTO `tbl_ijinsita` VALUES ('2pgrUKw6NDv7CX1j385ftebsL', '9', 'B/04/VII/2020/RES BARTIM/SATLANTAS', 'L52MjJKhp9i78Hfk', '2pgrUKw6NDv7CX1j385ftebsL_s_mohon.pdf', '2pgrUKw6NDv7CX1j385ftebsL_s_lap.pdf', '2pgrUKw6NDv7CX1j385ftebsL_pen_tersangka.pdf', '2pgrUKw6NDv7CX1j385ftebsL_perintah.pdf', '2020-12-03 09:26:53', '2020-12-03 09:27:29', 'RUDI SURIANSYAH', 'RUDI SURIANSYAH', '2', '2020-12-03 09:41:53', 'PANMUD PIDANA', '2', '2', '2pgrUKw6NDv7CX1j385ftebsL_verif_sita.pdf', '2pgrUKw6NDv7CX1j385ftebsL_spdp.pdf');
INSERT INTO `tbl_ijinsita` VALUES ('8IoCHKwUB04Z2qzhJenLFRDya', '10', '', 'lO5gwIpBEMq3QtvV', '8IoCHKwUB04Z2qzhJenLFRDya_s_mohon.pdf', '8IoCHKwUB04Z2qzhJenLFRDya_s_lap.pdf', '8IoCHKwUB04Z2qzhJenLFRDya_pen_tersangka.pdf', '8IoCHKwUB04Z2qzhJenLFRDya_perintah.pdf', '2020-12-03 09:34:54', null, 'THOMAS', null, '2', '2020-12-03 09:42:31', 'PANMUD PIDANA', '2', '3', '8IoCHKwUB04Z2qzhJenLFRDya_verif_sita.pdf', '8IoCHKwUB04Z2qzhJenLFRDya_spdp.pdf');
INSERT INTO `tbl_ijinsita` VALUES ('L1HrGOwVB05zkc9NfolYApDCZ', '11', 'B/09/I/RES.1.8/2020', 'UeWuNvQGPjH2XozO', 'L1HrGOwVB05zkc9NfolYApDCZ_s_mohon.pdf', 'L1HrGOwVB05zkc9NfolYApDCZ_s_lap.pdf', 'L1HrGOwVB05zkc9NfolYApDCZ_pen_tersangka.pdf', 'L1HrGOwVB05zkc9NfolYApDCZ_perintah.pdf', '2020-12-03 09:36:06', null, 'SIDIK ONGKI W.', null, '2', '2020-12-03 09:41:59', 'PANMUD PIDANA', '2', '2', 'L1HrGOwVB05zkc9NfolYApDCZ_verif_sita.pdf', 'L1HrGOwVB05zkc9NfolYApDCZ_spdp.pdf');

-- ----------------------------
-- Table structure for `tbl_ijinsita_p`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_ijinsita_p`;
CREATE TABLE `tbl_ijinsita_p` (
  `id_ijin_sita` varchar(25) DEFAULT NULL,
  `urut_sita` int(11) NOT NULL AUTO_INCREMENT,
  `no_smohon_sita` varchar(100) DEFAULT NULL,
  `id_unit` varchar(16) DEFAULT NULL,
  `edoc_smohon` varchar(255) DEFAULT NULL,
  `edoc_lap_pol_intel` varchar(255) DEFAULT NULL,
  `edoc_sprint_sidik` varchar(255) DEFAULT NULL,
  `edoc_sprint_sita` varchar(255) DEFAULT NULL,
  `edoc_sp` varchar(255) DEFAULT NULL,
  `created_at_sita` timestamp NULL DEFAULT NULL,
  `updated_at_sita` timestamp NULL DEFAULT NULL,
  `create_by_sita` varchar(255) DEFAULT NULL,
  `update_by_sita` varchar(255) DEFAULT NULL,
  `validasi` int(1) DEFAULT '0',
  `verif_date` timestamp NULL DEFAULT NULL,
  `verif_by` varchar(100) DEFAULT NULL,
  `count_brg` bigint(11) DEFAULT '0',
  `count_jml` bigint(11) DEFAULT '0',
  `verif_doc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`urut_sita`) USING BTREE,
  UNIQUE KEY `id_smohon_gd` (`id_ijin_sita`) USING BTREE,
  KEY `tbl_ijinsita_p_ibfk_1` (`id_unit`) USING BTREE,
  CONSTRAINT `tbl_ijinsita_p_ibfk_1` FOREIGN KEY (`id_unit`) REFERENCES `tbl_unit` (`id_unit`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tbl_ijinsita_p
-- ----------------------------
INSERT INTO `tbl_ijinsita_p` VALUES ('nDY2sOtAPSEpfBk8arRL157ol', '5', '', 'lO5gwIpBEMq3QtvV', 'nDY2sOtAPSEpfBk8arRL157ol_s_mohon.pdf', 'nDY2sOtAPSEpfBk8arRL157ol_s_lap.pdf', 'nDY2sOtAPSEpfBk8arRL157ol_sprint_sidik.pdf', 'nDY2sOtAPSEpfBk8arRL157ol_sprint_sita.pdf', 'nDY2sOtAPSEpfBk8arRL157ol_perintah.pdf', '2020-12-03 09:27:05', null, 'THOMAS', null, '2', '2020-12-28 07:29:49', 'Dede Almustaqim, S.kom', '1', '2', 'nDY2sOtAPSEpfBk8arRL157ol_verif_sita.pdf');

-- ----------------------------
-- Table structure for `tbl_pd`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_pd`;
CREATE TABLE `tbl_pd` (
  `id_smohon_pd` varchar(25) DEFAULT NULL,
  `urut_pd` int(11) NOT NULL AUTO_INCREMENT,
  `no_smohon_pd` varchar(100) DEFAULT NULL,
  `id_unit` varchar(16) DEFAULT NULL,
  `device` varchar(50) DEFAULT NULL,
  `jk_start` date DEFAULT NULL,
  `jk_end` date DEFAULT NULL,
  `lokasi_pd` varchar(255) DEFAULT NULL,
  `edoc_s_mohon` varchar(255) DEFAULT NULL,
  `edoc_lap_pol_intel` varchar(255) DEFAULT NULL,
  `created_at_pd` timestamp NULL DEFAULT NULL,
  `updated_at_pd` timestamp NULL DEFAULT NULL,
  `create_by_pd` varchar(255) DEFAULT NULL,
  `update_by_pd` varchar(255) DEFAULT NULL,
  `validasi` int(1) DEFAULT '0',
  `verif_date` timestamp NULL DEFAULT NULL,
  `verif_by` varchar(100) DEFAULT NULL,
  `verif_doc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`urut_pd`) USING BTREE,
  UNIQUE KEY `id_smohon_gd` (`id_smohon_pd`) USING BTREE,
  KEY `tbl_pd_ibfk_1` (`id_unit`) USING BTREE,
  CONSTRAINT `tbl_pd_ibfk_1` FOREIGN KEY (`id_unit`) REFERENCES `tbl_unit` (`id_unit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tbl_pd
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_penahanan`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_penahanan`;
CREATE TABLE `tbl_penahanan` (
  `id_penahanan` varchar(25) DEFAULT NULL,
  `urut_penahanan` int(11) NOT NULL AUTO_INCREMENT,
  `id_unit` varchar(16) DEFAULT NULL,
  `no_smohon_ph` varchar(100) DEFAULT NULL,
  `edoc_permohonan_ph` varchar(255) DEFAULT NULL,
  `edoc_lap_pol_intel` varchar(255) DEFAULT NULL,
  `edoc_penetapan_ter` varchar(255) DEFAULT NULL,
  `edoc_spdp` varchar(255) DEFAULT NULL,
  `created_at_ph` timestamp NULL DEFAULT NULL,
  `updated_at_ph` timestamp NULL DEFAULT NULL,
  `create_by_ph` varchar(255) DEFAULT NULL,
  `update_by_ph` varchar(255) DEFAULT NULL,
  `validasi` int(1) DEFAULT '0',
  `verif_date` timestamp NULL DEFAULT NULL,
  `verif_by` varchar(100) DEFAULT NULL,
  `jns_ph` varchar(100) DEFAULT NULL,
  `nm_ph` varchar(255) DEFAULT NULL,
  `nik_ph` varchar(50) DEFAULT NULL,
  `t_lahir_ph` varchar(100) DEFAULT NULL,
  `tgl_lahir_ph` date DEFAULT NULL,
  `jk_ph` enum('Pria','Wanita') DEFAULT NULL,
  `alamat_ph` varchar(255) DEFAULT NULL,
  `agama_ph` varchar(50) DEFAULT NULL,
  `pekerjaan_ph` varchar(100) DEFAULT NULL,
  `kebangsaan_ph` varchar(100) DEFAULT NULL,
  `riwayat` int(11) DEFAULT '0',
  `edoc_r1` varchar(255) DEFAULT NULL,
  `edoc_r2` varchar(255) DEFAULT NULL,
  `verif_doc` varchar(255) DEFAULT NULL,
  `edoc_resume` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`urut_penahanan`) USING BTREE,
  UNIQUE KEY `id_smohon_gd` (`id_penahanan`) USING BTREE,
  KEY `tbl_penahanan_ibfk_1` (`id_unit`) USING BTREE,
  CONSTRAINT `tbl_penahanan_ibfk_1` FOREIGN KEY (`id_unit`) REFERENCES `tbl_unit` (`id_unit`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tbl_penahanan
-- ----------------------------
INSERT INTO `tbl_penahanan` VALUES ('WhZeyUrVfgpPkRzQN0DtXwJST', '9', 'Xtwh09RQUOZl1Ioz', '7676767', 'WhZeyUrVfgpPkRzQN0DtXwJST_s_mohon.pdf', 'WhZeyUrVfgpPkRzQN0DtXwJST_s_lap.pdf', 'WhZeyUrVfgpPkRzQN0DtXwJST_pen_tersangka.pdf', 'WhZeyUrVfgpPkRzQN0DtXwJST_spdp.pdf', '2020-12-01 10:10:06', '2020-12-01 10:11:53', 'DENI', 'PANMUD PIDANA', '0', null, 'Dede Almustaqim, S.kom', 'Rutan', 'ugun', '1111111111111111', 'tami', '1964-10-18', 'Pria', 'nansuari', 'Islam', 'Islam', 'WNI', '1', 'WhZeyUrVfgpPkRzQN0DtXwJST_riwayat1.pdf', 'WhZeyUrVfgpPkRzQN0DtXwJST_riwayat2.pdf', null, 'WhZeyUrVfgpPkRzQN0DtXwJST_spdp.pdf');
INSERT INTO `tbl_penahanan` VALUES ('0os4GjZrc7zEd1CkxVtXOu6va', '10', 'Xtwh09RQUOZl1Ioz', '09/XI/2020', '0os4GjZrc7zEd1CkxVtXOu6va_s_mohon.pdf', '0os4GjZrc7zEd1CkxVtXOu6va_s_lap.pdf', '0os4GjZrc7zEd1CkxVtXOu6va_pen_tersangka.pdf', '0os4GjZrc7zEd1CkxVtXOu6va_spdp.pdf', '2020-12-03 09:50:27', null, 'JODI SURYATNA', null, '0', null, null, 'Rutan', 'ALI', '9090798787', 'DAMBUNG', '0000-00-00', 'Pria', 'DAMBUNG', 'Lain-lain', 'Lain-lain', 'WNI', '1', '0os4GjZrc7zEd1CkxVtXOu6va_riwayat1.pdf', '0os4GjZrc7zEd1CkxVtXOu6va_riwayat2.pdf', null, '0os4GjZrc7zEd1CkxVtXOu6va_spdp.pdf');
INSERT INTO `tbl_penahanan` VALUES ('OI30s1WgeE2HYKUJGN7obdPfR', '11', 'd15Q6sy8NgcULHxi', '6767', 'OI30s1WgeE2HYKUJGN7obdPfR_s_mohon.pdf', 'OI30s1WgeE2HYKUJGN7obdPfR_s_lap.pdf', 'OI30s1WgeE2HYKUJGN7obdPfR_pen_tersangka.pdf', 'OI30s1WgeE2HYKUJGN7obdPfR_spdp.pdf', '2020-12-03 09:51:30', null, 'aaaaaaaaaaaa', null, '0', null, null, 'Rutan', 'rudi', '-', 'hhh', '1963-10-14', 'Pria', 'ampah', 'Kristen', 'Kristen', 'WNI', '1', 'OI30s1WgeE2HYKUJGN7obdPfR_riwayat1.pdf', 'OI30s1WgeE2HYKUJGN7obdPfR_riwayat2.pdf', null, 'OI30s1WgeE2HYKUJGN7obdPfR_spdp.pdf');
INSERT INTO `tbl_penahanan` VALUES ('0hNPqTLaA9J7mus6QO8GDvIp2', '12', 'Ch1vtVoF9qWrczX7', 'B/23/III/2020', '0hNPqTLaA9J7mus6QO8GDvIp2_s_mohon.pdf', '0hNPqTLaA9J7mus6QO8GDvIp2_s_lap.pdf', '0hNPqTLaA9J7mus6QO8GDvIp2_pen_tersangka.pdf', '0hNPqTLaA9J7mus6QO8GDvIp2_spdp.pdf', '2020-12-03 09:52:33', null, 'MARKO SUTRISNO', null, '0', null, null, 'Rutan', 'JEKY', '3462476748757', 'MAWANI', '1961-08-16', 'Pria', 'MAWANI', 'Lain-lain', 'Lain-lain', 'WNI', '0', null, null, null, '0hNPqTLaA9J7mus6QO8GDvIp2_spdp.pdf');
INSERT INTO `tbl_penahanan` VALUES ('UMjyq2NhRT3nuCilzKtSfZcg7', '13', 'UeWuNvQGPjH2XozO', 'B/15/I/RES.1.8/2020', 'UMjyq2NhRT3nuCilzKtSfZcg7_s_mohon.pdf', 'UMjyq2NhRT3nuCilzKtSfZcg7_s_lap.pdf', 'UMjyq2NhRT3nuCilzKtSfZcg7_pen_tersangka.pdf', 'UMjyq2NhRT3nuCilzKtSfZcg7_spdp.pdf', '2020-12-03 09:52:34', null, 'SIDIK ONGKI W.', null, '0', null, null, 'Rutan', 'JAKI', '-', 'Dambung', '1994-12-13', 'Wanita', '', 'Budha', 'Budha', 'WNI', '0', null, null, null, 'UMjyq2NhRT3nuCilzKtSfZcg7_spdp.pdf');
INSERT INTO `tbl_penahanan` VALUES ('OVB8Gw9m0Pihj6FsReYfUlIkc', '14', 'L52MjJKhp9i78Hfk', 'B/29/XI/2020/RES', 'OVB8Gw9m0Pihj6FsReYfUlIkc_s_mohon.pdf', 'OVB8Gw9m0Pihj6FsReYfUlIkc_s_lap.pdf', 'OVB8Gw9m0Pihj6FsReYfUlIkc_pen_tersangka.pdf', 'OVB8Gw9m0Pihj6FsReYfUlIkc_spdp.pdf', '2020-12-03 09:52:44', null, 'SOFIAN', null, '0', null, null, 'Rutan', 'JEKY', '-', 'SAMPIT', '1965-12-15', 'Pria', 'AMPAH', 'Lain-lain', 'Lain-lain', 'WNI', '1', 'OVB8Gw9m0Pihj6FsReYfUlIkc_riwayat1.pdf', 'OVB8Gw9m0Pihj6FsReYfUlIkc_riwayat2.pdf', null, 'OVB8Gw9m0Pihj6FsReYfUlIkc_spdp.pdf');
INSERT INTO `tbl_penahanan` VALUES ('oCwsU1PaKGL570ieyAOdS2RE8', '15', 'N0Iq4KbHQRXzGxPg', 'B/10/XII/2020/POLSEK/P.KARAU', 'oCwsU1PaKGL570ieyAOdS2RE8_s_mohon.pdf', 'oCwsU1PaKGL570ieyAOdS2RE8_s_lap.pdf', 'oCwsU1PaKGL570ieyAOdS2RE8_pen_tersangka.pdf', 'oCwsU1PaKGL570ieyAOdS2RE8_spdp.pdf', '2020-12-03 09:52:45', null, 'ARIEF RACHMAN S', null, '0', null, null, 'Rutan', 'JEKI', '-', 'PALANGKARAYA', '2002-02-20', 'Pria', 'AMPAH', 'Islam', 'Islam', 'WNI', '1', 'oCwsU1PaKGL570ieyAOdS2RE8_riwayat1.pdf', 'oCwsU1PaKGL570ieyAOdS2RE8_riwayat2.pdf', null, 'oCwsU1PaKGL570ieyAOdS2RE8_spdp.pdf');
INSERT INTO `tbl_penahanan` VALUES ('AeBvoR3ODMrnpJXxEqSbHy7Y9', '16', 'lO5gwIpBEMq3QtvV', '1335', 'AeBvoR3ODMrnpJXxEqSbHy7Y9_s_mohon.pdf', 'AeBvoR3ODMrnpJXxEqSbHy7Y9_s_lap.pdf', 'AeBvoR3ODMrnpJXxEqSbHy7Y9_pen_tersangka.pdf', 'AeBvoR3ODMrnpJXxEqSbHy7Y9_spdp.pdf', '2020-12-03 09:52:58', null, 'THOMAS', null, '0', null, null, 'Rutan', 'Roy', '', 'Taniran', '1987-09-06', 'Pria', 'Benua lima', 'Islam', 'Islam', 'WNI', '1', 'AeBvoR3ODMrnpJXxEqSbHy7Y9_riwayat1.pdf', 'AeBvoR3ODMrnpJXxEqSbHy7Y9_riwayat2.pdf', null, 'AeBvoR3ODMrnpJXxEqSbHy7Y9_spdp.pdf');
INSERT INTO `tbl_penahanan` VALUES ('zUakCTPuq2SFBR9Q8GXrO04wn', '17', 'L52MjJKhp9i78Hfk', 'B/100/I/RES.4.2./I/2020/NARKOBA', 'zUakCTPuq2SFBR9Q8GXrO04wn_s_mohon.pdf', 'zUakCTPuq2SFBR9Q8GXrO04wn_s_lap.pdf', 'zUakCTPuq2SFBR9Q8GXrO04wn_pen_tersangka.pdf', 'zUakCTPuq2SFBR9Q8GXrO04wn_spdp.pdf', '2020-12-03 09:52:58', null, 'RYAN RAJAB SHOBARRY', null, '0', null, null, 'Rutan', 'Amat', '62132309870003', 'Ampah', '1987-12-03', 'Pria', 'Ampah', 'Islam', 'Islam', 'WNI', '0', null, null, null, 'zUakCTPuq2SFBR9Q8GXrO04wn_spdp.pdf');
INSERT INTO `tbl_penahanan` VALUES ('TL0UEVm9vwsOYzR5pDBjuiogq', '18', 'L52MjJKhp9i78Hfk', 'B/06/VII/2020/RES BARTIM/SATLANTAS', 'TL0UEVm9vwsOYzR5pDBjuiogq_s_mohon.pdf', 'TL0UEVm9vwsOYzR5pDBjuiogq_s_lap.pdf', 'TL0UEVm9vwsOYzR5pDBjuiogq_pen_tersangka.pdf', 'TL0UEVm9vwsOYzR5pDBjuiogq_spdp.pdf', '2020-12-03 09:53:12', null, 'RUDI SURIANSYAH', null, '0', null, null, 'Rutan', 'JEKI PURWANTO', '.', 'AMPAH', '1984-12-16', 'Pria', 'AMPAH KOTA RT 3 KEC. DUSUN TENGAH KAB. BARTIM PROV. KALTENG', 'Islam', 'Islam', 'WNI', '1', 'TL0UEVm9vwsOYzR5pDBjuiogq_riwayat1.pdf', 'TL0UEVm9vwsOYzR5pDBjuiogq_riwayat2.pdf', null, 'TL0UEVm9vwsOYzR5pDBjuiogq_spdp.pdf');
INSERT INTO `tbl_penahanan` VALUES ('yoxEhrjVvqJDn9PUF4Q2N8I67', '19', 'lnAyrwUCb03JM1qW', '', 'yoxEhrjVvqJDn9PUF4Q2N8I67_s_mohon.pdf', 'yoxEhrjVvqJDn9PUF4Q2N8I67_s_lap.pdf', 'yoxEhrjVvqJDn9PUF4Q2N8I67_pen_tersangka.pdf', 'yoxEhrjVvqJDn9PUF4Q2N8I67_spdp.pdf', '2020-12-03 09:55:48', null, 'MUHAMMAD_NOOR', null, '0', null, null, 'Rutan', 'aaaaaa', 'aaaa', 'aaa', '1999-03-05', 'Wanita', 'aaa', 'Kristen', 'Kristen', 'WNI', '0', null, null, null, 'yoxEhrjVvqJDn9PUF4Q2N8I67_spdp.pdf');
INSERT INTO `tbl_penahanan` VALUES ('JHuieKsbkj0pB612OQSvWoRMX', '20', 'rMeiXDVgucN8HOwF', '01', 'JHuieKsbkj0pB612OQSvWoRMX_s_mohon.pdf', 'JHuieKsbkj0pB612OQSvWoRMX_s_lap.pdf', 'JHuieKsbkj0pB612OQSvWoRMX_pen_tersangka.pdf', 'JHuieKsbkj0pB612OQSvWoRMX_spdp.pdf', '2020-12-03 09:56:21', null, 'ROY DIANTO', null, '0', null, null, 'Rutan', 'indre', '-', 'tamiang layang', '1980-04-02', 'Pria', 'hayaping', 'Islam', 'Islam', 'WNI', '1', 'JHuieKsbkj0pB612OQSvWoRMX_riwayat1.pdf', 'JHuieKsbkj0pB612OQSvWoRMX_riwayat2.pdf', null, 'JHuieKsbkj0pB612OQSvWoRMX_spdp.pdf');

-- ----------------------------
-- Table structure for `tbl_penahanan_p`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_penahanan_p`;
CREATE TABLE `tbl_penahanan_p` (
  `id_penahanan` varchar(25) DEFAULT NULL,
  `urut_penahanan` int(11) NOT NULL AUTO_INCREMENT,
  `id_unit` varchar(16) DEFAULT NULL,
  `no_smohon_ph` varchar(100) DEFAULT NULL,
  `edoc_permohonan_ph` varchar(255) DEFAULT NULL,
  `edoc_lap_pol_intel` varchar(255) DEFAULT NULL,
  `edoc_penetapan_ter` varchar(255) DEFAULT NULL,
  `edoc_spdp` varchar(255) DEFAULT NULL,
  `created_at_ph` timestamp NULL DEFAULT NULL,
  `updated_at_ph` timestamp NULL DEFAULT NULL,
  `create_by_ph` varchar(255) DEFAULT NULL,
  `update_by_ph` varchar(255) DEFAULT NULL,
  `validasi` int(1) DEFAULT '0',
  `verif_date` timestamp NULL DEFAULT NULL,
  `verif_by` varchar(100) DEFAULT NULL,
  `jns_ph` varchar(100) DEFAULT NULL,
  `nm_ph` varchar(255) DEFAULT NULL,
  `nik_ph` varchar(50) DEFAULT NULL,
  `t_lahir_ph` varchar(100) DEFAULT NULL,
  `tgl_lahir_ph` date DEFAULT NULL,
  `jk_ph` enum('Pria','Wanita') DEFAULT NULL,
  `alamat_ph` varchar(255) DEFAULT NULL,
  `agama_ph` varchar(50) DEFAULT NULL,
  `pekerjaan_ph` varchar(100) DEFAULT NULL,
  `kebangsaan_ph` varchar(100) DEFAULT NULL,
  `riwayat` int(11) DEFAULT '0',
  `edoc_r1` varchar(255) DEFAULT NULL,
  `edoc_r2` varchar(255) DEFAULT NULL,
  `verif_doc` varchar(255) DEFAULT NULL,
  `edoc_resume` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`urut_penahanan`) USING BTREE,
  UNIQUE KEY `id_smohon_gd` (`id_penahanan`) USING BTREE,
  KEY `tbl_penahanan_ibfk_1` (`id_unit`) USING BTREE,
  CONSTRAINT `tbl_penahanan_p_ibfk_1` FOREIGN KEY (`id_unit`) REFERENCES `tbl_unit` (`id_unit`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tbl_penahanan_p
-- ----------------------------
INSERT INTO `tbl_penahanan_p` VALUES ('HAbVCXRjGFDN0uSf6hQMz48og', '18', 'd15Q6sy8NgcULHxi', '677686', 'HAbVCXRjGFDN0uSf6hQMz48og_s_mohon.pdf', null, null, null, '2020-12-03 10:08:15', null, 'aaaaaaaaaaaa', null, '0', null, null, 'Rumah', 'tyo', '7878787777777777', '', '1960-11-11', 'Pria', 'ampah', 'Islam', 'Islam', 'WNI', '1', null, 'HAbVCXRjGFDN0uSf6hQMz48og_riwayat2.pdf', null, null);
INSERT INTO `tbl_penahanan_p` VALUES ('AmG2ZknL9q7HjYC5T1BMOQRfI', '19', 'lnAyrwUCb03JM1qW', '22222', 'AmG2ZknL9q7HjYC5T1BMOQRfI_s_mohon.pdf', null, null, null, '2020-12-03 10:08:43', null, 'MUHAMMAD_NOOR', null, '0', null, null, 'Rutan', '2122223', '22222', '2222', '1968-09-17', 'Pria', 'wwww', 'Islam', 'Islam', 'WNI', '0', null, null, null, null);

-- ----------------------------
-- Table structure for `tbl_penuntutan`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_penuntutan`;
CREATE TABLE `tbl_penuntutan` (
  `id_pn` varchar(25) DEFAULT NULL,
  `urut_pn` int(11) NOT NULL AUTO_INCREMENT,
  `no_bab` varchar(100) DEFAULT NULL,
  `id_unit` varchar(16) DEFAULT NULL,
  `no_pelimpahan` varchar(100) DEFAULT NULL,
  `no_srt_dakwaan` varchar(100) DEFAULT NULL,
  `edoc_pelimpahan` varchar(255) DEFAULT NULL,
  `edoc_dakwaan` varchar(255) DEFAULT NULL,
  `created_at_pn` timestamp NULL DEFAULT NULL,
  `updated_at_pn` timestamp NULL DEFAULT NULL,
  `create_by_pn` varchar(255) DEFAULT NULL,
  `update_by_pn` varchar(255) DEFAULT NULL,
  `validasi` int(1) DEFAULT '0',
  `verif_date` timestamp NULL DEFAULT NULL,
  `verif_by` varchar(100) DEFAULT NULL,
  `count_tdk` bigint(11) DEFAULT '0',
  `verif_doc` varchar(255) DEFAULT NULL,
  `no_pt` varchar(255) DEFAULT NULL,
  `edoc_tuntutan` varchar(255) DEFAULT NULL,
  `terdakwa1` varchar(255) DEFAULT NULL,
  `no_srt_tuntutan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`urut_pn`) USING BTREE,
  UNIQUE KEY `id_smohon_gd` (`id_pn`) USING BTREE,
  KEY `tbl_ijinsita_ibfk_1` (`id_unit`) USING BTREE,
  CONSTRAINT `tbl_penuntutan_ibfk_1` FOREIGN KEY (`id_unit`) REFERENCES `tbl_unit` (`id_unit`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tbl_penuntutan
-- ----------------------------
INSERT INTO `tbl_penuntutan` VALUES ('N0h3MLaiV7WTbd8YxgZu4eBfj', '4', '11111111', 'd15Q6sy8NgcULHxi', '11111111111111', '111111111111', 'N0h3MLaiV7WTbd8YxgZu4eBfj_pelimpahan.pdf', 'N0h3MLaiV7WTbd8YxgZu4eBfjdakwaan.doc', '2021-01-05 04:15:49', null, 'Kejaksaan', null, '1', '2021-01-06 10:08:15', 'Dede Almustaqim, S.kom', '1', null, null, null, 'asasasas', null);
INSERT INTO `tbl_penuntutan` VALUES ('FZzNoX85GqBLt6IU9j7xR4VAy', '5', 'asas', 'lO5gwIpBEMq3QtvV', 'asas', 'aasas', 'FZzNoX85GqBLt6IU9j7xR4VAy_pelimpahan.pdf', 'FZzNoX85GqBLt6IU9j7xR4VAydakwaan.docx', '2021-01-06 08:20:44', null, 'Kejaksaan', null, '1', '2021-01-06 08:21:16', 'Dede Almustaqim, S.kom', '0', null, null, null, null, null);
INSERT INTO `tbl_penuntutan` VALUES ('naumUEqkwDiCAfpyIgS6hbGlN', '6', 'asdas', 'lO5gwIpBEMq3QtvV', 'asas', 'asas', 'naumUEqkwDiCAfpyIgS6hbGlN_pelimpahan.pdf', 'naumUEqkwDiCAfpyIgS6hbGlNdakwaan.doc', '2021-01-06 09:34:09', null, 'Muhammad Noor', null, '0', null, null, '2', null, null, null, null, null);

-- ----------------------------
-- Table structure for `tbl_penyelidikan`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_penyelidikan`;
CREATE TABLE `tbl_penyelidikan` (
  `id_smohon_gd` varchar(25) DEFAULT NULL,
  `urut_gd` int(11) NOT NULL AUTO_INCREMENT,
  `no_smohon_gd` varchar(100) DEFAULT NULL,
  `id_unit` varchar(16) DEFAULT NULL,
  `jns_gd` enum('Bangunan','Badan') DEFAULT NULL,
  `lok_gd` varchar(100) DEFAULT NULL,
  `pemilik_lok_gd` varchar(100) DEFAULT NULL,
  `edoc_s_mohon` varchar(255) DEFAULT NULL,
  `edoc_lap_pol_intel` varchar(255) DEFAULT NULL,
  `created_at_gd` timestamp NULL DEFAULT NULL,
  `updated_at_gd` timestamp NULL DEFAULT NULL,
  `create_by_gd` varchar(255) DEFAULT NULL,
  `update_by_gd` varchar(255) DEFAULT NULL,
  `validasi` int(1) DEFAULT '0',
  `verif_date` timestamp NULL DEFAULT NULL,
  `verif_by` varchar(100) DEFAULT NULL,
  `verif_doc` varchar(255) DEFAULT NULL,
  `edoc_sprint` varchar(255) DEFAULT NULL,
  `edoc_spg` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`urut_gd`) USING BTREE,
  UNIQUE KEY `id_smohon_gd` (`id_smohon_gd`) USING BTREE,
  KEY `tbl_penyelidikan_ibfk_1` (`id_unit`) USING BTREE,
  CONSTRAINT `tbl_penyelidikan_ibfk_1` FOREIGN KEY (`id_unit`) REFERENCES `tbl_unit` (`id_unit`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tbl_penyelidikan
-- ----------------------------
INSERT INTO `tbl_penyelidikan` VALUES ('ZFNbufnhaLrE2CiT3vHPJoRkl', '16', '333', 'd15Q6sy8NgcULHxi', 'Bangunan', 'tamiang', 'wati', 'ZFNbufnhaLrE2CiT3vHPJoRkl_s_mohon.pdf', 'ZFNbufnhaLrE2CiT3vHPJoRkl_s_lap.pdf', '2020-12-03 08:42:58', '2020-12-03 08:48:02', 'aaaaaaaaaaaa', 'aaaaaaaaaaaa', '2', '2020-12-03 08:52:37', 'PANMUD PIDANA', 'ZFNbufnhaLrE2CiT3vHPJoRkl_verif_gd.pdf', 'ZFNbufnhaLrE2CiT3vHPJoRkl_sprint.pdf', 'ZFNbufnhaLrE2CiT3vHPJoRkl_spg.pdf');
INSERT INTO `tbl_penyelidikan` VALUES ('oL4DbJ0jsSdXgVQqPyfC62M5m', '18', 'B/01/VII/2020/RES BARTIM', 'L52MjJKhp9i78Hfk', 'Badan', 'DESA TAMPA', 'HAMSAN', 'oL4DbJ0jsSdXgVQqPyfC62M5m_s_mohon.pdf', 'oL4DbJ0jsSdXgVQqPyfC62M5m_s_lap.pdf', '2020-12-03 08:43:18', '2020-12-03 08:46:03', 'RUDI SURIANSYAH', 'RUDI SURIANSYAH', '2', '2020-12-03 08:52:42', 'PANMUD PIDANA', 'oL4DbJ0jsSdXgVQqPyfC62M5m_verif_gd.pdf', 'oL4DbJ0jsSdXgVQqPyfC62M5m_sprint.pdf', 'oL4DbJ0jsSdXgVQqPyfC62M5m_spg.pdf');
INSERT INTO `tbl_penyelidikan` VALUES ('Ycm8oD0pHNZ1CJQbwzuehjLvn', '19', 'B/23/III/2020/polsek', 'Ch1vtVoF9qWrczX7', 'Bangunan', 'desa mawani', 'jeky', 'Ycm8oD0pHNZ1CJQbwzuehjLvn_s_mohon.pdf', 'Ycm8oD0pHNZ1CJQbwzuehjLvn_s_lap.pdf', '2020-12-03 08:43:21', null, 'MARKO SUTRISNO', null, '2', '2020-12-03 08:52:58', 'PANMUD PIDANA', 'Ycm8oD0pHNZ1CJQbwzuehjLvn_verif_gd.pdf', 'Ycm8oD0pHNZ1CJQbwzuehjLvn_sprint.pdf', 'Ycm8oD0pHNZ1CJQbwzuehjLvn_spg.pdf');
INSERT INTO `tbl_penyelidikan` VALUES ('67DbiHfQ2OueZvEV0X3d1x5sF', '20', '08/XI/2020/POLSEK DUSTIM', 'Xtwh09RQUOZl1Ioz', 'Bangunan', 'Tamiang Layang', 'gigi', '67DbiHfQ2OueZvEV0X3d1x5sF_s_mohon.pdf', '67DbiHfQ2OueZvEV0X3d1x5sF_s_lap.pdf', '2020-12-03 08:43:36', '2020-12-03 08:48:09', 'JODI SURYATNA', 'JODI SURYATNA', '2', '2020-12-03 08:52:23', 'PANMUD PIDANA', '67DbiHfQ2OueZvEV0X3d1x5sF_verif_gd.pdf', '67DbiHfQ2OueZvEV0X3d1x5sF_sprint.pdf', '67DbiHfQ2OueZvEV0X3d1x5sF_spg.pdf');
INSERT INTO `tbl_penyelidikan` VALUES ('FiaCM1hzgE3N7jpWVDeqRbro9', '21', 'B/10/XII/2020/POLSEKP.KARAU', 'N0Iq4KbHQRXzGxPg', 'Bangunan', 'BAMBULUNG', 'PAK HAJI', 'FiaCM1hzgE3N7jpWVDeqRbro9_s_mohon.pdf', 'FiaCM1hzgE3N7jpWVDeqRbro9_s_lap.pdf', '2020-12-03 08:44:02', null, 'ARIEF RACHMAN S', null, '2', '2020-12-03 08:52:48', 'PANMUD PIDANA', 'FiaCM1hzgE3N7jpWVDeqRbro9_verif_gd.pdf', 'FiaCM1hzgE3N7jpWVDeqRbro9_sprint.pdf', 'FiaCM1hzgE3N7jpWVDeqRbro9_spg.pdf');
INSERT INTO `tbl_penyelidikan` VALUES ('mJwZfrG7zDk1idyeBHTsOaCvX', '22', 'B/23/XII/RES.1.8/2020', 'UeWuNvQGPjH2XozO', 'Badan', 'Ampah Kota', 'H. JEKI', 'mJwZfrG7zDk1idyeBHTsOaCvX_s_mohon.pdf', 'mJwZfrG7zDk1idyeBHTsOaCvX_s_lap.pdf', '2020-12-03 08:44:04', null, 'SIDIK ONGKI W.', null, '2', '2020-12-03 08:53:04', 'PANMUD PIDANA', 'mJwZfrG7zDk1idyeBHTsOaCvX_verif_gd.pdf', 'mJwZfrG7zDk1idyeBHTsOaCvX_sprint.pdf', 'mJwZfrG7zDk1idyeBHTsOaCvX_spg.pdf');
INSERT INTO `tbl_penyelidikan` VALUES ('S32NgzvJL9Wl5RErTsXtGZiY0', '23', '01', 'rMeiXDVgucN8HOwF', 'Badan', 'hayaping', 'indre', 'S32NgzvJL9Wl5RErTsXtGZiY0_s_mohon.pdf', 'S32NgzvJL9Wl5RErTsXtGZiY0_s_lap.pdf', '2020-12-03 08:44:12', '2020-12-03 08:46:52', 'ROY DIANTO', 'ROY DIANTO', '2', '2020-12-03 08:52:16', 'PANMUD PIDANA', 'S32NgzvJL9Wl5RErTsXtGZiY0_verif_gd.pdf', 'S32NgzvJL9Wl5RErTsXtGZiY0_sprint.pdf', 'S32NgzvJL9Wl5RErTsXtGZiY0_spg.pdf');
INSERT INTO `tbl_penyelidikan` VALUES ('eHsoJpdL9nwDNxvqPFtb01f5R', '24', 'R/100/X/2020', 'L52MjJKhp9i78Hfk', 'Badan', 'Tamiang Layang', 'Amat', 'eHsoJpdL9nwDNxvqPFtb01f5R_s_mohon.pdf', 'eHsoJpdL9nwDNxvqPFtb01f5R_s_lap.pdf', '2020-12-03 08:44:58', null, 'RYAN RAJAB SHOBARRY', null, '2', '2020-12-03 08:53:09', 'PANMUD PIDANA', 'eHsoJpdL9nwDNxvqPFtb01f5R_verif_gd.pdf', 'eHsoJpdL9nwDNxvqPFtb01f5R_sprint.pdf', 'eHsoJpdL9nwDNxvqPFtb01f5R_spg.pdf');
INSERT INTO `tbl_penyelidikan` VALUES ('YQZ2aUqhofbBsyWKSjiwnNOgA', '25', '132344', 'lO5gwIpBEMq3QtvV', 'Bangunan', 'Benua lima', 'Benua lima', 'YQZ2aUqhofbBsyWKSjiwnNOgA_s_mohon.pdf', 'YQZ2aUqhofbBsyWKSjiwnNOgA_s_lap.pdf', '2020-12-03 08:50:59', null, 'THOMAS', null, '2', '2020-12-03 08:52:29', 'PANMUD PIDANA', 'YQZ2aUqhofbBsyWKSjiwnNOgA_verif_gd.pdf', 'YQZ2aUqhofbBsyWKSjiwnNOgA_sprint.pdf', 'YQZ2aUqhofbBsyWKSjiwnNOgA_spg.pdf');

-- ----------------------------
-- Table structure for `tbl_penyidikan`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_penyidikan`;
CREATE TABLE `tbl_penyidikan` (
  `id_py` varchar(25) DEFAULT NULL,
  `urut_py` int(11) NOT NULL AUTO_INCREMENT,
  `no_smohon_py` varchar(100) DEFAULT NULL,
  `id_unit` varchar(16) DEFAULT NULL,
  `jns_py` enum('Bangunan','Badan') DEFAULT NULL,
  `lok_py` varchar(100) DEFAULT NULL,
  `pemilik_lok_py` varchar(100) DEFAULT NULL,
  `edoc_s_mohon` varchar(255) DEFAULT NULL,
  `edoc_lap_pol_intel` varchar(255) DEFAULT NULL,
  `edoc_penetapan` varchar(255) DEFAULT NULL,
  `edoc_spdp` varchar(255) DEFAULT NULL,
  `created_at_py` timestamp NULL DEFAULT NULL,
  `updated_at_py` timestamp NULL DEFAULT NULL,
  `create_by_py` varchar(255) DEFAULT NULL,
  `update_by_py` varchar(255) DEFAULT NULL,
  `nik_py` varchar(16) DEFAULT NULL,
  `nm_py` varchar(255) DEFAULT NULL,
  `t_lahir_py` varchar(50) DEFAULT NULL,
  `tgl_lahir_py` date DEFAULT NULL,
  `jk_py` enum('Pria','Wanita') DEFAULT NULL,
  `alamat_py` varchar(255) DEFAULT NULL,
  `agama_py` varchar(50) DEFAULT NULL,
  `pekerjaan_py` varchar(100) DEFAULT NULL,
  `kebangsaan_py` varchar(100) DEFAULT NULL,
  `validasi` int(1) DEFAULT '0',
  `verif_date` timestamp NULL DEFAULT NULL,
  `verif_by` varchar(100) DEFAULT NULL,
  `verif_doc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`urut_py`) USING BTREE,
  UNIQUE KEY `id_smohon_gd` (`id_py`) USING BTREE,
  KEY `tbl_penyidikan_ibfk_1` (`id_unit`) USING BTREE,
  CONSTRAINT `tbl_penyidikan_ibfk_1` FOREIGN KEY (`id_unit`) REFERENCES `tbl_unit` (`id_unit`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tbl_penyidikan
-- ----------------------------
INSERT INTO `tbl_penyidikan` VALUES ('8xKCXYzdRG0ZUnspjmwHOucbo', '4', 'B/01/XI/2020/BARTIM/RESBARTIM', 'L52MjJKhp9i78Hfk', 'Badan', 'Tamiang Layang', 'JEKY', '8xKCXYzdRG0ZUnspjmwHOucbo_s_mohon.pdf', '8xKCXYzdRG0ZUnspjmwHOucbo_s_lap.pdf', '8xKCXYzdRG0ZUnspjmwHOucbo_pen_tersangka.pdf', '8xKCXYzdRG0ZUnspjmwHOucbo_spdp.pdf', '2020-12-03 08:57:05', null, 'SOFIAN', null, '-', '-', 'SAMPIT', '1983-08-14', 'Pria', 'AMPAH', 'Islam', 'HONOR', 'WNI', '2', '2020-12-03 09:09:22', 'PANMUD PIDANA', '8xKCXYzdRG0ZUnspjmwHOucbo_verif_py.pdf');
INSERT INTO `tbl_penyidikan` VALUES ('62gObilV4afBADIY0vWeHM81x', '5', 'B/100/XII/RES.4.2./2020/NARKOBA', 'L52MjJKhp9i78Hfk', 'Badan', 'Ampah', 'Amat', '62gObilV4afBADIY0vWeHM81x_s_mohon.pdf', '62gObilV4afBADIY0vWeHM81x_s_lap.pdf', '62gObilV4afBADIY0vWeHM81x_pen_tersangka.pdf', '62gObilV4afBADIY0vWeHM81x_spdp.pdf', '2020-12-03 08:57:33', null, 'RYAN RAJAB SHOBARRY', null, '6212555568990001', '6212555568990001', 'Ampah', '1988-12-03', 'Pria', 'Ampah', 'Islam', 'Swasta', 'WNI', '2', '2020-12-03 09:09:34', 'PANMUD PIDANA', '62gObilV4afBADIY0vWeHM81x_verif_py.pdf');
INSERT INTO `tbl_penyidikan` VALUES ('b9I2Py0N3SXcDVGYlgBCvLwUt', '6', 'B/10/XII/2020/POLSWK/P.KARAU', 'N0Iq4KbHQRXzGxPg', 'Bangunan', 'BAMBULUNG', 'PAK HAJI', 'b9I2Py0N3SXcDVGYlgBCvLwUt_s_mohon.pdf', 'b9I2Py0N3SXcDVGYlgBCvLwUt_s_lap.pdf', 'b9I2Py0N3SXcDVGYlgBCvLwUt_pen_tersangka.pdf', 'b9I2Py0N3SXcDVGYlgBCvLwUt_spdp.pdf', '2020-12-03 08:58:15', null, 'ARIEF RACHMAN S', null, '-', '-', 'PALANGKA RAYA', '2002-02-20', 'Pria', 'AMPAH', 'Islam', 'SWASTA', 'WNI', '2', '2020-12-03 09:09:27', 'PANMUD PIDANA', 'b9I2Py0N3SXcDVGYlgBCvLwUt_verif_py.pdf');
INSERT INTO `tbl_penyidikan` VALUES ('kCRGDSbYvMehVuX9wcpg6a4oq', '7', '555555', 'd15Q6sy8NgcULHxi', 'Bangunan', 'tamiang', 'wandi', 'kCRGDSbYvMehVuX9wcpg6a4oq_s_mohon.pdf', 'kCRGDSbYvMehVuX9wcpg6a4oq_s_lap.pdf', 'kCRGDSbYvMehVuX9wcpg6a4oq_pen_tersangka.pdf', 'kCRGDSbYvMehVuX9wcpg6a4oq_spdp.pdf', '2020-12-03 08:59:01', null, 'aaaaaaaaaaaa', null, '-', '-', 'tamiang', '1960-09-11', 'Pria', 'hhhhh', 'Islam', 'petani', 'WNI', '2', '2020-12-03 09:09:15', 'PANMUD PIDANA', 'kCRGDSbYvMehVuX9wcpg6a4oq_verif_py.pdf');
INSERT INTO `tbl_penyidikan` VALUES ('LhbUqMTjmu2y0QPvR9G1ies7J', '8', 'B/23/III/2020/POLSEK', 'Ch1vtVoF9qWrczX7', 'Bangunan', 'DESA MAWANI', 'JEKY', 'LhbUqMTjmu2y0QPvR9G1ies7J_s_mohon.pdf', 'LhbUqMTjmu2y0QPvR9G1ies7J_s_lap.pdf', 'LhbUqMTjmu2y0QPvR9G1ies7J_pen_tersangka.pdf', 'LhbUqMTjmu2y0QPvR9G1ies7J_spdp.pdf', '2020-12-03 08:59:18', null, 'MARKO SUTRISNO', null, '-', '-', 'MAWANI', '1971-11-12', 'Pria', 'DESA MAWANI', 'Lain-lain', '', 'WNI', '2', '2020-12-03 09:09:44', 'PANMUD PIDANA', 'LhbUqMTjmu2y0QPvR9G1ies7J_verif_py.pdf');
INSERT INTO `tbl_penyidikan` VALUES ('TIVdNgxGa1JjY7UfBHLM5oAZ9', '9', '01', 'rMeiXDVgucN8HOwF', 'Badan', 'Hayaping', 'Indre', 'TIVdNgxGa1JjY7UfBHLM5oAZ9_s_mohon.pdf', 'TIVdNgxGa1JjY7UfBHLM5oAZ9_s_lap.pdf', 'TIVdNgxGa1JjY7UfBHLM5oAZ9_pen_tersangka.pdf', 'TIVdNgxGa1JjY7UfBHLM5oAZ9_spdp.pdf', '2020-12-03 08:59:34', null, 'ROY DIANTO', null, '-', '-', 'tamiang layang', '1981-02-01', 'Pria', 'Hayaping', 'Islam', '', 'WNI', '2', '2020-12-03 09:08:56', 'PANMUD PIDANA', 'TIVdNgxGa1JjY7UfBHLM5oAZ9_verif_py.pdf');
INSERT INTO `tbl_penyidikan` VALUES ('MNGBYfRw0IDxPJmS3UA7Tpbiz', '10', '0909', 'Xtwh09RQUOZl1Ioz', 'Bangunan', 'tamiang layang', 'gigi', 'MNGBYfRw0IDxPJmS3UA7Tpbiz_s_mohon.pdf', 'MNGBYfRw0IDxPJmS3UA7Tpbiz_s_lap.pdf', 'MNGBYfRw0IDxPJmS3UA7Tpbiz_pen_tersangka.pdf', 'MNGBYfRw0IDxPJmS3UA7Tpbiz_spdp.pdf', '2020-12-03 08:59:51', null, 'JODI SURYATNA', null, '+62', '+62', 'dambung', '0000-00-00', 'Wanita', 'tamiang layang', 'Lain-lain', '', 'WNI', '2', '2020-12-03 09:09:02', 'PANMUD PIDANA', 'MNGBYfRw0IDxPJmS3UA7Tpbiz_verif_py.pdf');
INSERT INTO `tbl_penyidikan` VALUES ('7OuiSNxQlbI9e5j2zhs0PaJ1M', '11', '24456', 'lO5gwIpBEMq3QtvV', 'Bangunan', 'Ampah', 'Roy', '7OuiSNxQlbI9e5j2zhs0PaJ1M_s_mohon.pdf', '7OuiSNxQlbI9e5j2zhs0PaJ1M_s_lap.pdf', '7OuiSNxQlbI9e5j2zhs0PaJ1M_pen_tersangka.pdf', '7OuiSNxQlbI9e5j2zhs0PaJ1M_spdp.pdf', '2020-12-03 09:00:14', null, 'THOMAS', null, '', '', 'Ampah ', '1980-08-03', 'Pria', 'Ampah', 'Islam', 'Tani', 'WNI', '2', '2020-12-03 09:09:08', 'PANMUD PIDANA', '7OuiSNxQlbI9e5j2zhs0PaJ1M_verif_py.pdf');
INSERT INTO `tbl_penyidikan` VALUES ('a2CJVH3md1KvEROt0IfUlL7u6', '12', 'B/123/I?RES.1.8/2020', 'UeWuNvQGPjH2XozO', 'Badan', 'Putai', 'H.BASNAH', 'a2CJVH3md1KvEROt0IfUlL7u6_s_mohon.pdf', 'a2CJVH3md1KvEROt0IfUlL7u6_s_lap.pdf', 'a2CJVH3md1KvEROt0IfUlL7u6_pen_tersangka.pdf', 'a2CJVH3md1KvEROt0IfUlL7u6_spdp.pdf', '2020-12-03 09:01:02', null, 'SIDIK ONGKI W.', null, '-', '-', 'Dambung', '1983-01-01', 'Pria', 'Dambung Raya Kec. Dusun Tengah Kab. Bartim Prov. Kalteng', 'Budha', 'Astronot', 'WNA', '2', '2020-12-03 09:09:39', 'PANMUD PIDANA', 'a2CJVH3md1KvEROt0IfUlL7u6_verif_py.pdf');

-- ----------------------------
-- Table structure for `tbl_psita`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_psita`;
CREATE TABLE `tbl_psita` (
  `id_psita` varchar(25) DEFAULT NULL,
  `urut_psita` int(11) NOT NULL AUTO_INCREMENT,
  `id_unit` varchar(16) DEFAULT NULL,
  `no_smohon_psita` varchar(100) DEFAULT NULL,
  `edoc_smohon` varchar(255) DEFAULT NULL,
  `edoc_lap_pol_intel` varchar(255) DEFAULT NULL,
  `edoc_penetapan` varchar(255) DEFAULT NULL,
  `edoc_spdp` varchar(255) DEFAULT NULL,
  `edoc_p_sita` varchar(255) DEFAULT NULL,
  `edoc_ba` varchar(255) DEFAULT NULL,
  `edoc_ttbs` varchar(255) DEFAULT NULL,
  `edoc_sprindik` varchar(255) DEFAULT NULL,
  `created_at_psita` timestamp NULL DEFAULT NULL,
  `updated_at_psita` timestamp NULL DEFAULT NULL,
  `create_by_psita` varchar(255) DEFAULT NULL,
  `update_by_psita` varchar(255) DEFAULT NULL,
  `validasi` int(1) DEFAULT '0',
  `verif_date` timestamp NULL DEFAULT NULL,
  `verif_by` varchar(100) DEFAULT NULL,
  `count_brg` bigint(11) DEFAULT '0',
  `count_jml` bigint(11) DEFAULT '0',
  `verif_doc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`urut_psita`) USING BTREE,
  UNIQUE KEY `id_smohon_gd` (`id_psita`) USING BTREE,
  KEY `tbl_psita_ibfk_1` (`id_unit`) USING BTREE,
  CONSTRAINT `tbl_psita_ibfk_1` FOREIGN KEY (`id_unit`) REFERENCES `tbl_unit` (`id_unit`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tbl_psita
-- ----------------------------
INSERT INTO `tbl_psita` VALUES ('A8lewoatBskNEu6xRPCI7q1bz', '3', 'd15Q6sy8NgcULHxi', '5555', 'A8lewoatBskNEu6xRPCI7q1bz_s_mohon.pdf', 'A8lewoatBskNEu6xRPCI7q1bz_s_lap.pdf', 'A8lewoatBskNEu6xRPCI7q1bz_pen_tersangka.pdf', 'A8lewoatBskNEu6xRPCI7q1bz_spdp.pdf', 'A8lewoatBskNEu6xRPCI7q1bz_perintah.pdf', 'A8lewoatBskNEu6xRPCI7q1bz_ba.pdf', 'A8lewoatBskNEu6xRPCI7q1bz_ttba.pdf', 'A8lewoatBskNEu6xRPCI7q1bz_sprindik.pdf', '2020-12-03 09:25:03', null, 'aaaaaaaaaaaa', null, '2', '2020-12-03 09:45:20', 'PANMUD PIDANA', '2', '3', 'A8lewoatBskNEu6xRPCI7q1bz_verif_pst.pdf');
INSERT INTO `tbl_psita` VALUES ('D27FzofhEKXUTMulpAg16tvxb', '4', 'UeWuNvQGPjH2XozO', 'B/14/I/RES.1.8/2021', 'D27FzofhEKXUTMulpAg16tvxb_s_mohon.pdf', 'D27FzofhEKXUTMulpAg16tvxb_s_lap.pdf', 'D27FzofhEKXUTMulpAg16tvxb_pen_tersangka.pdf', 'D27FzofhEKXUTMulpAg16tvxb_spdp.pdf', 'D27FzofhEKXUTMulpAg16tvxb_perintah.pdf', 'D27FzofhEKXUTMulpAg16tvxb_ba.pdf', 'D27FzofhEKXUTMulpAg16tvxb_ttba.pdf', 'D27FzofhEKXUTMulpAg16tvxb_sprindik.pdf', '2020-12-03 09:26:58', null, 'SIDIK ONGKI W.', null, '2', '2020-12-03 09:45:43', 'PANMUD PIDANA', '2', '11', 'D27FzofhEKXUTMulpAg16tvxb_verif_pst.pdf');
INSERT INTO `tbl_psita` VALUES ('X1BSCE8w20bxdgAUDkVo4Jnpq', '5', 'rMeiXDVgucN8HOwF', '01', 'X1BSCE8w20bxdgAUDkVo4Jnpq_s_mohon.pdf', 'X1BSCE8w20bxdgAUDkVo4Jnpq_s_lap.pdf', 'X1BSCE8w20bxdgAUDkVo4Jnpq_pen_tersangka.pdf', 'X1BSCE8w20bxdgAUDkVo4Jnpq_spdp.pdf', 'X1BSCE8w20bxdgAUDkVo4Jnpq_perintah.pdf', 'X1BSCE8w20bxdgAUDkVo4Jnpq_ba.pdf', 'X1BSCE8w20bxdgAUDkVo4Jnpq_ttba.pdf', 'X1BSCE8w20bxdgAUDkVo4Jnpq_sprindik.pdf', '2020-12-03 09:45:45', null, 'ROY DIANTO', null, '0', null, null, '1', '1', null);
INSERT INTO `tbl_psita` VALUES ('bWsotASgf9MixerkvF0Q4UNyO', '6', 'Xtwh09RQUOZl1Ioz', '09/XI/2020/SEK DUSTIM', 'bWsotASgf9MixerkvF0Q4UNyO_s_mohon.pdf', 'bWsotASgf9MixerkvF0Q4UNyO_s_lap.pdf', 'bWsotASgf9MixerkvF0Q4UNyO_pen_tersangka.pdf', 'bWsotASgf9MixerkvF0Q4UNyO_spdp.pdf', 'bWsotASgf9MixerkvF0Q4UNyO_perintah.pdf', 'bWsotASgf9MixerkvF0Q4UNyO_ba.pdf', 'bWsotASgf9MixerkvF0Q4UNyO_ttba.pdf', 'bWsotASgf9MixerkvF0Q4UNyO_sprindik.pdf', '2020-12-03 09:45:55', null, 'JODI SURYATNA', null, '0', null, null, '0', '0', null);
INSERT INTO `tbl_psita` VALUES ('7ErGaOI4kcNsRW9iFqp8TjXvS', '7', 'L52MjJKhp9i78Hfk', 'B/05/VII/2020/RES BARTIM/SATLANTAS', '7ErGaOI4kcNsRW9iFqp8TjXvS_s_mohon.pdf', '7ErGaOI4kcNsRW9iFqp8TjXvS_s_lap.pdf', '7ErGaOI4kcNsRW9iFqp8TjXvS_pen_tersangka.pdf', '7ErGaOI4kcNsRW9iFqp8TjXvS_spdp.pdf', '7ErGaOI4kcNsRW9iFqp8TjXvS_perintah.pdf', '7ErGaOI4kcNsRW9iFqp8TjXvS_ba.pdf', '7ErGaOI4kcNsRW9iFqp8TjXvS_ttba.pdf', '7ErGaOI4kcNsRW9iFqp8TjXvS_sprindik.pdf', '2020-12-03 09:48:30', null, 'RUDI SURIANSYAH', null, '0', null, null, '0', '0', null);
INSERT INTO `tbl_psita` VALUES ('ECDxS1OpK38erbtwkWJlPI7uc', '8', 'N0Iq4KbHQRXzGxPg', 'B/10/XII/2020/POLSEK/P.KARAU', 'ECDxS1OpK38erbtwkWJlPI7uc_s_mohon.pdf', 'ECDxS1OpK38erbtwkWJlPI7uc_s_lap.pdf', 'ECDxS1OpK38erbtwkWJlPI7uc_pen_tersangka.pdf', 'ECDxS1OpK38erbtwkWJlPI7uc_spdp.pdf', 'ECDxS1OpK38erbtwkWJlPI7uc_perintah.pdf', 'ECDxS1OpK38erbtwkWJlPI7uc_ba.pdf', 'ECDxS1OpK38erbtwkWJlPI7uc_ttba.pdf', 'ECDxS1OpK38erbtwkWJlPI7uc_sprindik.pdf', '2020-12-03 09:49:52', null, 'ARIEF RACHMAN S', null, '0', null, null, '0', '0', null);
INSERT INTO `tbl_psita` VALUES ('nbyOkftixeEG1CDvT5hpwojFz', '9', 'rMeiXDVgucN8HOwF', '01', 'nbyOkftixeEG1CDvT5hpwojFz_s_mohon.pdf', 'nbyOkftixeEG1CDvT5hpwojFz_s_lap.pdf', 'nbyOkftixeEG1CDvT5hpwojFz_pen_tersangka.pdf', 'nbyOkftixeEG1CDvT5hpwojFz_spdp.pdf', 'nbyOkftixeEG1CDvT5hpwojFz_perintah.pdf', 'nbyOkftixeEG1CDvT5hpwojFz_ba.pdf', 'nbyOkftixeEG1CDvT5hpwojFz_ttba.pdf', 'nbyOkftixeEG1CDvT5hpwojFz_sprindik.pdf', '2020-12-03 09:50:12', null, 'ROY DIANTO', null, '0', null, null, '1', '1', null);

-- ----------------------------
-- Table structure for `tbl_psita_p`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_psita_p`;
CREATE TABLE `tbl_psita_p` (
  `id_psita` varchar(25) DEFAULT NULL,
  `urut_psita` int(11) NOT NULL AUTO_INCREMENT,
  `id_unit` varchar(16) DEFAULT NULL,
  `no_smohon_psita` varchar(100) DEFAULT NULL,
  `edoc_smohon` varchar(255) DEFAULT NULL,
  `edoc_lap_pol_intel` varchar(255) DEFAULT NULL,
  `edoc_penetapan` varchar(255) DEFAULT NULL,
  `edoc_spdp` varchar(255) DEFAULT NULL,
  `edoc_p_sita` varchar(255) DEFAULT NULL,
  `edoc_ba` varchar(255) DEFAULT NULL,
  `edoc_ttbs` varchar(255) DEFAULT NULL,
  `edoc_sprindik` varchar(255) DEFAULT NULL,
  `created_at_psita` timestamp NULL DEFAULT NULL,
  `updated_at_psita` timestamp NULL DEFAULT NULL,
  `create_by_psita` varchar(255) DEFAULT NULL,
  `update_by_psita` varchar(255) DEFAULT NULL,
  `validasi` int(1) DEFAULT '0',
  `verif_date` timestamp NULL DEFAULT NULL,
  `verif_by` varchar(100) DEFAULT NULL,
  `count_brg` bigint(11) DEFAULT '0',
  `count_jml` bigint(11) DEFAULT '0',
  `verif_doc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`urut_psita`) USING BTREE,
  UNIQUE KEY `id_smohon_gd` (`id_psita`) USING BTREE,
  KEY `tbl_psita_p_ibfk_1` (`id_unit`) USING BTREE,
  CONSTRAINT `tbl_psita_p_ibfk_1` FOREIGN KEY (`id_unit`) REFERENCES `tbl_unit` (`id_unit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tbl_psita_p
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_tdw`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_tdw`;
CREATE TABLE `tbl_tdw` (
  `id_tdw` varchar(25) NOT NULL,
  `id_pn` varchar(25) NOT NULL,
  `nm_tdw` varchar(100) DEFAULT NULL,
  `nik_tdw` varchar(16) DEFAULT NULL,
  `t_lahir_tdw` varchar(100) DEFAULT NULL,
  `tgl_lahir_tdw` varchar(100) DEFAULT NULL,
  `agama_tdw` varchar(100) DEFAULT NULL,
  `pekerjaan_tdw` varchar(255) DEFAULT NULL,
  `urut_tdw` int(11) NOT NULL AUTO_INCREMENT,
  `kebangsaan_tdw` varchar(100) DEFAULT NULL,
  `jk_tdw` varchar(50) DEFAULT NULL,
  `alamat_tdw` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`urut_tdw`,`id_tdw`) USING BTREE,
  KEY `tbl_brg_ijin_sita_ibfk_1` (`id_pn`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tbl_tdw
-- ----------------------------
INSERT INTO `tbl_tdw` VALUES ('hMnbHdwCTSNYEjy4ZOvVgBtIf', 'uDpJe2S6o3Hzn57ZBhGmwKWj0', 'sdsdsd', 'sdsd', 'sdsd', '1957-8-8', 'Budha', 'sdsd', '15', 'WNI', 'Pria', 'sdsd');
INSERT INTO `tbl_tdw` VALUES ('6ZhHvub4Acm2U5pGjMKFT3Wt7', 'uDpJe2S6o3Hzn57ZBhGmwKWj0', 'sdsdsdssssssssss', 'sdsd', 'sdsd', '1957-8-8', 'Budha', 'sdsd', '16', 'WNI', 'Pria', 'sdsd');
INSERT INTO `tbl_tdw` VALUES ('wW9bchg1FsOS7q0xy2kIK4QVi', 'N0h3MLaiV7WTbd8YxgZu4eBfj', 'asasasas', '2121212', 'asas', '1964-9-14', 'Kristen', 'asas', '17', 'WNI', 'Wanita', 'asasas');
INSERT INTO `tbl_tdw` VALUES ('iSHpf5znCy3mxURE06FDL7WJ1', 'naumUEqkwDiCAfpyIgS6hbGlN', 'asasas', '2121', 'saasas', '1964-10-15', 'Islam', 'asas', '18', 'WNI', 'Pria', 'asas');
INSERT INTO `tbl_tdw` VALUES ('VEuqDytoXve0FM5fOSG3hwAQI', 'naumUEqkwDiCAfpyIgS6hbGlN', 'asasasas', 'asas', 'saasas', '1966-11-14', 'Islam', 'asas', '19', 'WNI', 'Wanita', 'asasas');

-- ----------------------------
-- Table structure for `tbl_unit`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_unit`;
CREATE TABLE `tbl_unit` (
  `id_unit` varchar(16) DEFAULT NULL,
  `nm_unit` varchar(255) DEFAULT NULL,
  `nm_pimpinan` varchar(255) DEFAULT NULL,
  `nrp_nip` decimal(50,0) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `id_unit` (`id_unit`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tbl_unit
-- ----------------------------
INSERT INTO `tbl_unit` VALUES ('lO5gwIpBEMq3QtvV', 'POLSEK BENUA LIMA', 'SAMUDI', '72080739', '2020-12-01 08:34:17', '2020-12-03 07:50:50');
INSERT INTO `tbl_unit` VALUES ('UeWuNvQGPjH2XozO', 'POLSEK DUSUN TENGAH', 'NURHERIYANTO HIDAYAT, S.H, MSi', '78070043', '2020-12-01 08:40:10', '2020-12-03 07:33:56');
INSERT INTO `tbl_unit` VALUES ('Xtwh09RQUOZl1Ioz', 'POLSEK_DUSUN TIMUR', 'FERY ENDRO.P.S.,S.E', '75040199', '2020-12-01 09:09:23', '2020-12-03 07:51:19');
INSERT INTO `tbl_unit` VALUES ('N0Iq4KbHQRXzGxPg', 'POLSEK PEMATANG KARAU', 'ROCHMAN HAKIM, S.H', '79031118', '2020-12-03 07:36:12', null);
INSERT INTO `tbl_unit` VALUES ('Ch1vtVoF9qWrczX7', 'POLSEK PATANGKEP TUTUI', 'UNTUNG BASUKI, S.H', '75040679', '2020-12-03 07:40:41', null);
INSERT INTO `tbl_unit` VALUES ('L52MjJKhp9i78Hfk', 'POLRES BARITO TIMUR', 'AKBP Afandi Eka Putra, S.H., S.I.K.,M.PICT', '80020966', '2020-12-03 07:42:27', '2020-12-03 07:48:11');
INSERT INTO `tbl_unit` VALUES ('rMeiXDVgucN8HOwF', 'POLSEK AWANG', 'DEBBY SOESILO', '78050366', '2020-12-03 07:52:11', null);
INSERT INTO `tbl_unit` VALUES ('lnAyrwUCb03JM1qW', 'KEJAKSAAN NEGERI BARITO TIMUR', 'ROY ROVALINO HERUDIANSYAH', '60277225', '2020-12-03 07:54:05', '2020-12-03 08:00:29');
INSERT INTO `tbl_unit` VALUES ('d15Q6sy8NgcULHxi', 'POLSEK CONTOH', 'asaaaaa', '111111111111111111', '2020-12-03 08:31:02', null);

-- ----------------------------
-- Table structure for `tbl_user`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `id_user` varchar(25) NOT NULL,
  `id_akses` int(11) DEFAULT NULL,
  `id_unit` varchar(16) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `nrp_nip` varchar(25) DEFAULT NULL,
  `urut_user` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`urut_user`,`id_user`),
  KEY `username` (`username`) USING BTREE,
  KEY `id_akses` (`id_akses`) USING BTREE,
  KEY `id_unit` (`id_unit`) USING BTREE,
  CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`id_akses`) REFERENCES `tbl_akses` (`id_akses`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_user_ibfk_2` FOREIGN KEY (`id_unit`) REFERENCES `tbl_unit` (`id_unit`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES ('1aPXE79ruJlMO2hkynd0HfWGm', '4', 'rMeiXDVgucN8HOwF', 'POLSEK_AWANG', '5458f1c251f135e5e6089f890b4325c1', 'ROY DIANTO', 'AWANG@GMAIL.COM', '2020-12-03 07:53:09', null, '2020-12-03 08:08:21', '95060137', '1');
INSERT INTO `tbl_user` VALUES ('2b53v7MxsRSNPA49Uogn0WHqQ', '4', 'L52MjJKhp9i78Hfk', 'RYAN_RAJAB', '2641de86361386a8d052734162fe3b7e', 'RYAN RAJAB SHOBARRY', 'ryan@live.com', '2020-12-03 07:45:24', null, '2020-12-03 08:19:47', '94120553', '2');
INSERT INTO `tbl_user` VALUES ('7DfhreVPCubKkjRHWUl2s1dE4', '4', 'lO5gwIpBEMq3QtvV', 'THOMAS', '98b3ab1568e5d4b0689e44bf8ace12ce', 'THOMAS', 'thomas@live.com', '2020-12-03 07:47:23', null, '2020-12-03 08:26:00', '92080595', '3');
INSERT INTO `tbl_user` VALUES ('GeIB7v9oYDuwjRn02AglMPUSF', '4', 'L52MjJKhp9i78Hfk', 'RUDI_SURIANSYAH', 'c30c2123106a3f3d66993fe7f56d29b8', 'RUDI SURIANSYAH', 'rudi@live.com', '2020-12-03 07:50:32', null, '2020-12-03 09:21:21', '85080102', '4');
INSERT INTO `tbl_user` VALUES ('JI8ispfj3VxEKaLGBMwmoPbOA', '4', 'lnAyrwUCb03JM1qW', 'MUHAMMAD_NOOR', '500cbe7f572b0a355f6493df46783522', 'MUHAMMAD_NOOR', 'muhammadnoor@live.com', '2020-12-03 07:57:14', null, '2020-12-03 09:46:23', '60277725', '5');
INSERT INTO `tbl_user` VALUES ('oZSO8mrU0wR1YHhKlvuTNfzBM', '4', 'Ch1vtVoF9qWrczX7', 'POLSEK_PTUTUI', '4b4453c6c0590b7f335724fff812ed82', 'MARKO SUTRISNO', 'PTUTUI@GMAIL.COM', '2020-12-03 07:43:19', null, '2020-12-03 08:21:03', '87070586', '6');
INSERT INTO `tbl_user` VALUES ('P6SQwmTXLRjtfKN4JHyzodp1n', '4', 'N0Iq4KbHQRXzGxPg', 'POLSEK_PKARAU', 'f9a7cd3ef4247c201c0944225b7327ad', 'ARIEF RACHMAN S', 'polsek@polsek.com', '2020-12-03 07:39:16', null, '2020-12-03 08:07:07', '96040329', '7');
INSERT INTO `tbl_user` VALUES ('PSEHLNcGnOKyQ7iwvfmjk0UeD', '4', 'L52MjJKhp9i78Hfk', 'SOFIAN', '5d3102f1f01be9fb3fd3847c1d3d5797', 'SOFIAN', 'sofian@live.com', '2020-12-03 07:44:08', null, '2020-12-03 08:07:14', '88010327', '8');
INSERT INTO `tbl_user` VALUES ('ucSqYQfv5EyJd47pNrVktCMZA', '4', 'd15Q6sy8NgcULHxi', 'polsek_contoh', 'e1ca7d340a9cbf27ad5d4a58deae4e3e', 'aaaaaaaaaaaa', 'aaa@aaa.com', '2020-12-03 08:31:24', null, '2020-12-03 08:41:58', '111111111111111111', '9');
INSERT INTO `tbl_user` VALUES ('yS2T9LmbUKva3lpX4wgVOkiPQ', '4', 'Xtwh09RQUOZl1Ioz', 'POLSEK_DUSTIM', 'e1ca7d340a9cbf27ad5d4a58deae4e3e', 'JODI SURYATNA', 'DUSTIM@GMAIL.COM', '2020-12-03 07:46:55', null, '2020-12-03 08:07:51', '93050343', '10');
INSERT INTO `tbl_user` VALUES ('ySZE3QmHCge0sYhfkpax2WKGu', '4', 'UeWuNvQGPjH2XozO', 'DUSTENG', 'd11df2ec4e394862a9fb530a60e49694', 'SIDIK ONGKI W.', 'polsek.dusteng@gmail.com', '2020-12-03 07:34:59', null, '2020-12-03 09:43:36', '92100707', '11');
DROP TRIGGER IF EXISTS `count_brg`;
DELIMITER ;;
CREATE TRIGGER `count_brg` AFTER INSERT ON `tbl_brg_ijin_sita` FOR EACH ROW BEGIN
update tbl_ijinsita set count_brg = count_brg + 1, count_jml = count_jml + New.jml
WHERE id_ijin_sita = New.id_ijin_sita;
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `count_del`;
DELIMITER ;;
CREATE TRIGGER `count_del` AFTER DELETE ON `tbl_brg_ijin_sita` FOR EACH ROW BEGIN
update tbl_ijinsita set count_brg = count_brg-1, count_jml = count_jml - Old.jml
WHERE id_ijin_sita = Old.id_ijin_sita;
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `count_brg_copy2`;
DELIMITER ;;
CREATE TRIGGER `count_brg_copy2` AFTER INSERT ON `tbl_brg_ijin_sita_p` FOR EACH ROW BEGIN
update tbl_ijinsita_p set count_brg = count_brg + 1, count_jml = count_jml + New.jml
WHERE id_ijin_sita = New.id_ijin_sita;
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `count_del_copy2`;
DELIMITER ;;
CREATE TRIGGER `count_del_copy2` AFTER DELETE ON `tbl_brg_ijin_sita_p` FOR EACH ROW BEGIN
update tbl_ijinsita_p set count_brg = count_brg-1, count_jml = count_jml - Old.jml
WHERE id_ijin_sita = Old.id_ijin_sita;
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `count_brg_copy1`;
DELIMITER ;;
CREATE TRIGGER `count_brg_copy1` AFTER INSERT ON `tbl_brg_psita` FOR EACH ROW BEGIN
update tbl_psita set count_brg = count_brg + 1, count_jml = count_jml + New.jml
WHERE id_psita = New.id_psita;
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `count_del_copy1`;
DELIMITER ;;
CREATE TRIGGER `count_del_copy1` AFTER DELETE ON `tbl_brg_psita` FOR EACH ROW BEGIN
update tbl_psita set count_brg = count_brg-1, count_jml = count_jml - Old.jml
WHERE id_psita = Old.id_psita;
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `count_brg_copy1_copy1`;
DELIMITER ;;
CREATE TRIGGER `count_brg_copy1_copy1` AFTER INSERT ON `tbl_brg_psita_p` FOR EACH ROW BEGIN
update tbl_psita_p set count_brg = count_brg + 1, count_jml = count_jml + New.jml
WHERE id_psita = New.id_psita;
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `count_del_copy1_copy1`;
DELIMITER ;;
CREATE TRIGGER `count_del_copy1_copy1` AFTER DELETE ON `tbl_brg_psita_p` FOR EACH ROW BEGIN
update tbl_psita_p set count_brg = count_brg-1, count_jml = count_jml - Old.jml
WHERE id_psita = Old.id_psita;
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `count_brg_copy3`;
DELIMITER ;;
CREATE TRIGGER `count_brg_copy3` AFTER INSERT ON `tbl_tdw` FOR EACH ROW BEGIN
update tbl_penuntutan set count_tdk = count_tdk + 1
WHERE id_pn = New.id_pn;
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `count_del_copy3`;
DELIMITER ;;
CREATE TRIGGER `count_del_copy3` AFTER DELETE ON `tbl_tdw` FOR EACH ROW BEGIN
update tbl_penuntutan set count_tdk = count_tdk-1
WHERE id_pn = Old.id_pn;
END
;;
DELIMITER ;
