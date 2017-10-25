/*
Navicat MySQL Data Transfer

Source Server         : herry
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : remindme

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-10-25 16:19:24
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for remind_photos
-- ----------------------------
DROP TABLE IF EXISTS `remind_photos`;
CREATE TABLE `remind_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `remind_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of remind_photos
-- ----------------------------
INSERT INTO `remind_photos` VALUES ('45', '2953', 'joe', 'jow20171025080057.jpg');
INSERT INTO `remind_photos` VALUES ('46', '2952', 'tes', 'jow20171025080443.jpg');
