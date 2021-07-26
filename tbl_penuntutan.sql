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

 Date: 05/01/2021 10:05:26
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_penuntutan
-- ----------------------------
DROP TABLE IF EXISTS `tbl_penuntutan`;
CREATE TABLE `tbl_penuntutan`  (
  `id_pn` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `urut_pn` int(11) NOT NULL AUTO_INCREMENT,
  `no_bab` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_unit` varchar(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `no_pelimpahan` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `no_srt_dakwaan` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `edoc_pelimpahan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `edoc_dakwaan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at_pn` timestamp(0) NULL DEFAULT NULL,
  `updated_at_pn` timestamp(0) NULL DEFAULT NULL,
  `create_by_pn` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `update_by_pn` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `validasi` int(1) NULL DEFAULT 0,
  `verif_date` timestamp(0) NULL DEFAULT NULL,
  `verif_by` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `count_tdk` bigint(11) NULL DEFAULT 0,
  `verif_doc` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `no_pt` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `edoc_tuntutan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `terdakwa1` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `no_srt_tuntutan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`urut_pn`) USING BTREE,
  UNIQUE INDEX `id_smohon_gd`(`id_pn`) USING BTREE,
  INDEX `tbl_ijinsita_ibfk_1`(`id_unit`) USING BTREE,
  CONSTRAINT `tbl_penuntutan_ibfk_1` FOREIGN KEY (`id_unit`) REFERENCES `tbl_unit` (`id_unit`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_penuntutan
-- ----------------------------
INSERT INTO `tbl_penuntutan` VALUES ('uDpJe2S6o3Hzn57ZBhGmwKWj0', 2, 'sdsd', 'lO5gwIpBEMq3QtvV', 'sdsd', 'sdsd', 'uDpJe2S6o3Hzn57ZBhGmwKWj0_pelimpahan.pdf', 'uDpJe2S6o3Hzn57ZBhGmwKWj0dakwaan.docx', '2021-01-04 04:00:50', NULL, 'KEJAKSAAN', NULL, 0, NULL, NULL, 2, NULL, NULL, NULL, 'sdsdsdssssssssss', NULL);
INSERT INTO `tbl_penuntutan` VALUES ('9FrRK3t5mWfpHnhzysBQa6A0Y', 3, 'dfdf', 'lO5gwIpBEMq3QtvV', 'dfdf', 'dfdff', '9FrRK3t5mWfpHnhzysBQa6A0Y_pelimpahan.pdf', '9FrRK3t5mWfpHnhzysBQa6A0Ydakwaan.docx', '2021-01-04 06:29:26', NULL, 'KEJAKSAAN', NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
