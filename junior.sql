/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50719
Source Host           : localhost:3306
Source Database       : junior

Target Server Type    : MYSQL
Target Server Version : 50719
File Encoding         : 65001

Date: 2018-03-22 21:13:32
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `status` int(2) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'a@gmail.com', '0');
INSERT INTO `users` VALUES ('2', 'b@gmail.com', '0');
INSERT INTO `users` VALUES ('3', 'c@gmail.com', '2');
INSERT INTO `users` VALUES ('4', 'c@gmail.com', '1');
INSERT INTO `users` VALUES ('5', 'e@gmail.com', '3');
INSERT INTO `users` VALUES ('6', 'f@gmail.com', '33');
INSERT INTO `users` VALUES ('7', 'ru@gmai.com', '3');
INSERT INTO `users` VALUES ('8', 'a.belenkiy@urancompany.com', '1');
SET FOREIGN_KEY_CHECKS=1;
