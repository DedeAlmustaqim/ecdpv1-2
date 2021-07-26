/*
 Navicat Premium Data Transfer

 Source Server         : MariaDB
 Source Server Type    : MySQL
 Source Server Version : 100129
 Source Host           : localhost:3306
 Source Schema         : db_ecdp

 Target Server Type    : MySQL
 Target Server Version : 100129
 File Encoding         : 65001

 Date: 05/01/2021 10:05:19
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_tdw
-- ----------------------------
DROP TABLE IF EXISTS `tbl_tdw`;
CREATE TABLE `tbl_tdw`  (
  `id_tdw` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_pn` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nm_tdw` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nik_tdw` varchar(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `t_lahir_tdw` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_lahir_tdw` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `agama_tdw` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pekerjaan_tdw` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `urut_brg` int(11) NOT NULL AUTO_INCREMENT,
  `kebangsaan_tdw` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jk_tdw` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat_tdw` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`urut_brg`, `id_tdw`) USING BTREE,
  INDEX `tbl_brg_ijin_sita_ibfk_1`(`id_pn`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_tdw
-- ----------------------------
INSERT INTO `tbl_tdw` VALUES ('hMnbHdwCTSNYEjy4ZOvVgBtIf', 'uDpJe2S6o3Hzn57ZBhGmwKWj0', 'sdsdsd', 'sdsd', 'sdsd', '1957-8-8', 'Budha', 'sdsd', 15, 'WNI', 'Pria', 'sdsd');
INSERT INTO `tbl_tdw` VALUES ('6ZhHvub4Acm2U5pGjMKFT3Wt7', 'uDpJe2S6o3Hzn57ZBhGmwKWj0', 'sdsdsdssssssssss', 'sdsd', 'sdsd', '1957-8-8', 'Budha', 'sdsd', 16, 'WNI', 'Pria', 'sdsd');

-- ----------------------------
-- Triggers structure for table tbl_tdw
-- ----------------------------
DROP TRIGGER IF EXISTS `count_brg_copy3`;
delimiter ;;
CREATE TRIGGER `count_brg_copy3` AFTER INSERT ON `tbl_tdw` FOR EACH ROW BEGIN
update tbl_penuntutan set count_tdk = count_tdk + 1
WHERE id_pn = New.id_pn;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table tbl_tdw
-- ----------------------------
DROP TRIGGER IF EXISTS `count_del_copy3`;
delimiter ;;
CREATE TRIGGER `count_del_copy3` AFTER DELETE ON `tbl_tdw` FOR EACH ROW BEGIN
update tbl_penuntutan set count_tdk = count_tdk-1
WHERE id_pn = Old.id_pn;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
