/*
 Navicat Premium Data Transfer

 Source Server         : MariaDB
 Source Server Type    : MySQL
 Source Server Version : 100129
 Source Host           : localhost:3306
 Source Schema         : edoc

 Target Server Type    : MySQL
 Target Server Version : 100129
 File Encoding         : 65001

 Date: 11/10/2020 20:35:23
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_penyelidikan
-- ----------------------------
DROP TABLE IF EXISTS `tbl_penyelidikan`;
CREATE TABLE `tbl_penyelidikan`  (
  `id_penyelidikan` varchar(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_ijin_pg` varchar(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jns_srt` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `no_srt` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `edoc_pnyldk` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jns_geledah` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lokasi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pemilik_lok` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_penyelidikan`) USING BTREE,
  INDEX `id_ijin_pg`(`id_ijin_pg`) USING BTREE,
  CONSTRAINT `tbl_penyelidikan_ibfk_1` FOREIGN KEY (`id_ijin_pg`) REFERENCES `tbl_pg` (`id_ijin_pg`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_penyelidikan
-- ----------------------------
INSERT INTO `tbl_penyelidikan` VALUES ('ctWn6PBqk92wu8gb', 'OdPzYHGrw2Z9kgeX', 'LAPORAN POLISI/INTELIJEN', '002/dustim/2020', '2020-10-11 14:18:00', 'OdPzYHGrw2Z9kgeX.pdf', 'Badan', 'asas', 'asas');

-- ----------------------------
-- Table structure for tbl_penyidikan
-- ----------------------------
DROP TABLE IF EXISTS `tbl_penyidikan`;
CREATE TABLE `tbl_penyidikan`  (
  `id_penyidikan` varchar(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_ijin_pg` varchar(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `no_srt_pydk` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jns_srt_pydk` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jns_geledah_pydk` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lokasi_pydk` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pemilik_lok_pydk` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nik_pydk` varchar(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `t_lahir_pydk` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_lahir_pydk` date NULL DEFAULT NULL,
  `j_kelamin_pydk` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `agama_pydk` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pekerjaan_pydk` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kebangsaan_pydk` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `edoc_pydk` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_penyidikan`) USING BTREE,
  INDEX `id_ijin_pg`(`id_ijin_pg`) USING BTREE,
  CONSTRAINT `tbl_penyidikan_ibfk_1` FOREIGN KEY (`id_ijin_pg`) REFERENCES `tbl_pg` (`id_ijin_pg`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_penyidikan
-- ----------------------------
INSERT INTO `tbl_penyidikan` VALUES ('A4Ex8lXgVcGv5K9N', 'DBZSATu5Mz4G2bFi', '001/dustim/2020', 'PERMOHONAN GELEDAH', 'Bangunan', 'asasaaaaaaaaaaa', 'wwwwwwwwwwwwwww', '2222222222222222', '2222222222222222', '2020-10-11', 'Wanita', 'Lainnya', 'aaaaaaaaaaaaa', 'WNI', 'DBZSATu5Mz4G2bFi.pdf', '2020-10-11 14:17:46');

-- ----------------------------
-- Table structure for tbl_pg
-- ----------------------------
DROP TABLE IF EXISTS `tbl_pg`;
CREATE TABLE `tbl_pg`  (
  `id_ijin_pg` varchar(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_unit` varchar(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `no_srt` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `stts_penyelidikan` varchar(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `stts_penyidikan` varchar(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT 0,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_ijin_pg`) USING BTREE,
  INDEX `id_ijin_pg`(`id_ijin_pg`) USING BTREE,
  INDEX `tbl_pg_ibfk_1`(`id_unit`) USING BTREE,
  CONSTRAINT `tbl_pg_ibfk_1` FOREIGN KEY (`id_unit`) REFERENCES `tbl_unit` (`id_unit`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_pg
-- ----------------------------
INSERT INTO `tbl_pg` VALUES ('DBZSATu5Mz4G2bFi', 'A9EFRBUpeosWMzIr', '001/dustim/2020', NULL, '1', 1, '2020-10-11 03:38:00', '2020-10-11 11:48:04');
INSERT INTO `tbl_pg` VALUES ('OdPzYHGrw2Z9kgeX', 'AON3yW8K9V0moBIJ', '002/dusteng/2020', '1', NULL, 1, '2020-10-11 04:02:28', '2020-10-11 11:49:10');

-- ----------------------------
-- Table structure for tbl_unit
-- ----------------------------
DROP TABLE IF EXISTS `tbl_unit`;
CREATE TABLE `tbl_unit`  (
  `id_unit` varchar(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nm_unit` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nm_pimpinan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nrp_nip` decimal(50, 0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `id_unit`(`id_unit`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_unit
-- ----------------------------
INSERT INTO `tbl_unit` VALUES ('A9EFRBUpeosWMzIr', 'POLSEK DUSUN TIMUR', 'Bapak ....', 111111111111111, '2020-10-11 02:53:18', '2020-10-11 11:48:31');
INSERT INTO `tbl_unit` VALUES ('AON3yW8K9V0moBIJ', 'POLSEK DUSUN TENGAH', 'Bapak ...', 22222222222222222222, '2020-10-11 02:55:38', '2020-10-11 11:48:54');

-- ----------------------------
-- Triggers structure for table tbl_penyelidikan
-- ----------------------------
DROP TRIGGER IF EXISTS `stts_penyelidikan`;
delimiter ;;
CREATE TRIGGER `stts_penyelidikan` AFTER INSERT ON `tbl_penyelidikan` FOR EACH ROW BEGIN
update tbl_pg set stts_penyelidikan = 1
WHERE id_ijin_pg = New.id_ijin_pg;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table tbl_penyelidikan
-- ----------------------------
DROP TRIGGER IF EXISTS `stts_penyelidikan_hapus`;
delimiter ;;
CREATE TRIGGER `stts_penyelidikan_hapus` AFTER DELETE ON `tbl_penyelidikan` FOR EACH ROW BEGIN
update tbl_pg set stts_penyelidikan = null
WHERE id_ijin_pg = Old.id_ijin_pg;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table tbl_penyidikan
-- ----------------------------
DROP TRIGGER IF EXISTS `stts_penyidikan`;
delimiter ;;
CREATE TRIGGER `stts_penyidikan` AFTER INSERT ON `tbl_penyidikan` FOR EACH ROW BEGIN
update tbl_pg set stts_penyidikan = 1
WHERE id_ijin_pg = New.id_ijin_pg;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table tbl_penyidikan
-- ----------------------------
DROP TRIGGER IF EXISTS `stts_penyidikan_del`;
delimiter ;;
CREATE TRIGGER `stts_penyidikan_del` AFTER DELETE ON `tbl_penyidikan` FOR EACH ROW BEGIN
update tbl_pg set stts_penyidikan = null
WHERE id_ijin_pg = Old.id_ijin_pg;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
