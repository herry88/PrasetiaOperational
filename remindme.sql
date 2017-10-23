/*
Navicat MySQL Data Transfer

Source Server         : 192.168.1.155
Source Server Version : 50516
Source Host           : 192.168.1.155:3306
Source Database       : remindme

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2017-10-23 10:03:56
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
-- Table structure for departemens
-- ----------------------------
DROP TABLE IF EXISTS `departemens`;
CREATE TABLE `departemens` (
  `id` int(12) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=275 DEFAULT CHARSET=latin1;

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
-- Table structure for types
-- ----------------------------
DROP TABLE IF EXISTS `types`;
CREATE TABLE `types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
