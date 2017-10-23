/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50621
Source Host           : 127.0.0.1:3306
Source Database       : remindme

Target Server Type    : MYSQL
Target Server Version : 50621
File Encoding         : 65001

Date: 2017-10-23 11:01:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for companies
-- ----------------------------
DROP TABLE IF EXISTS `companies`;
CREATE TABLE `companies` (
  `id` int(12) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of companies
-- ----------------------------
INSERT INTO `companies` VALUES ('1', 'PT. PRASETIA DWIDHARMA');
INSERT INTO `companies` VALUES ('2', 'PT. TUNAS PRASETIA NUSANTARA');
INSERT INTO `companies` VALUES ('3', 'PT. VERDANCO ENGINEERING');
INSERT INTO `companies` VALUES ('4', 'PT. VERDANCO INDONESIA');
INSERT INTO `companies` VALUES ('5', 'PT. DWIDHARMA MEDIA');
INSERT INTO `companies` VALUES ('6', 'PT. ABDI SARANA MAKMUR');
INSERT INTO `companies` VALUES ('7', 'PT. VERDANCO PRATAMA');

-- ----------------------------
-- Table structure for departemens
-- ----------------------------
DROP TABLE IF EXISTS `departemens`;
CREATE TABLE `departemens` (
  `id` int(12) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of departemens
-- ----------------------------
INSERT INTO `departemens` VALUES ('8', 'MAINTENANCE');
INSERT INTO `departemens` VALUES ('9', 'HRGA');
INSERT INTO `departemens` VALUES ('10', 'LOGISTIK');
INSERT INTO `departemens` VALUES ('11', 'CONSTRUCTION PROJECT');

-- ----------------------------
-- Table structure for items
-- ----------------------------
DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `nremind1` int(11) NOT NULL,
  `nremind2` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of items
-- ----------------------------
INSERT INTO `items` VALUES ('1', 'Service', '30', '15');
INSERT INTO `items` VALUES ('2', 'Perpanjang STNK', '35', '15');
INSERT INTO `items` VALUES ('3', 'Perpanjang KIR', '35', '15');
INSERT INTO `items` VALUES ('4', 'Perpanjang Izin Angkut Barang', '35', '15');
INSERT INTO `items` VALUES ('5', 'Penyewaan Homebase', '35', '15');
INSERT INTO `items` VALUES ('7', 'Insurance', '35', '15');
INSERT INTO `items` VALUES ('9', 'Ganti Aki', '35', '15');
INSERT INTO `items` VALUES ('10', 'Ganti Ban', '35', '15');
INSERT INTO `items` VALUES ('11', 'Izin Tiba', '35', '15');
INSERT INTO `items` VALUES ('12', 'lain-lain', '35', '15');

-- ----------------------------
-- Table structure for objects
-- ----------------------------
DROP TABLE IF EXISTS `objects`;
CREATE TABLE `objects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `PIC` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `type_id` int(11) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `coordinator` varchar(255) DEFAULT NULL,
  `plat` varchar(10) NOT NULL,
  `departemen_id` int(50) DEFAULT NULL,
  `company_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=276 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of objects
-- ----------------------------
INSERT INTO `objects` VALUES ('275', 'a', '', '1', '', '', '', '1', '', '', 'a', null, '1');

-- ----------------------------
-- Table structure for objects_copy
-- ----------------------------
DROP TABLE IF EXISTS `objects_copy`;
CREATE TABLE `objects_copy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `PIC` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `type_id` int(11) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `coordinator` varchar(255) DEFAULT NULL,
  `departemen_id` varchar(50) DEFAULT NULL,
  `plat` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=261 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of objects_copy
-- ----------------------------

-- ----------------------------
-- Table structure for reminds
-- ----------------------------
DROP TABLE IF EXISTS `reminds`;
CREATE TABLE `reminds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deadline` date NOT NULL,
  `next` date NOT NULL,
  `state` varchar(255) NOT NULL,
  `object_id` int(11) NOT NULL,
  `note` text NOT NULL,
  `item_id` int(11) NOT NULL,
  `price_est` float DEFAULT NULL,
  `price_act` float DEFAULT NULL,
  `km_actual` varchar(255) DEFAULT NULL,
  `km_service` varchar(255) DEFAULT NULL,
  `sebelum_service` varchar(255) DEFAULT NULL,
  `tindakan_service` varchar(255) DEFAULT NULL,
  `nama_bengkel` varchar(255) DEFAULT NULL,
  `vendor` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2951 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of reminds
-- ----------------------------

-- ----------------------------
-- Table structure for types
-- ----------------------------
DROP TABLE IF EXISTS `types`;
CREATE TABLE `types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of types
-- ----------------------------
INSERT INTO `types` VALUES ('1', 'Car');
INSERT INTO `types` VALUES ('2', 'MotorCycle');
INSERT INTO `types` VALUES ('4', 'Homebase');
INSERT INTO `types` VALUES ('5', 'Office');
INSERT INTO `types` VALUES ('6', 'Izin Keterangan Tiba');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin', '$2y$10$SRgmQnOQOyEffPFFdNcrXut4lM7Z3hEWyP6UlYyZNMJLRbi8VsZ1K', 'admin', null, null);
