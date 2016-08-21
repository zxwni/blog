/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2016-08-22 00:27:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for blog_navs
-- ----------------------------
DROP TABLE IF EXISTS `blog_navs`;
CREATE TABLE `blog_navs` (
  `nav_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nav_name` varchar(50) NOT NULL DEFAULT '' COMMENT '//名称',
  `nav_alias` varchar(50) NOT NULL DEFAULT '' COMMENT '//别名',
  `nav_url` varchar(255) NOT NULL DEFAULT '' COMMENT '//链接',
  `nav_order` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '//排序',
  PRIMARY KEY (`nav_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
