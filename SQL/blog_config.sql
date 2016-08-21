/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2016-08-22 00:27:24
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for blog_config
-- ----------------------------
DROP TABLE IF EXISTS `blog_config`;
CREATE TABLE `blog_config` (
  `conf_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `conf_title` varchar(50) NOT NULL DEFAULT '' COMMENT '//标题',
  `conf_name` varchar(50) NOT NULL DEFAULT '' COMMENT '//变量名',
  `conf_content` text COMMENT '//变量值',
  `conf_order` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '//排序',
  `conf_tips` varchar(255) NOT NULL DEFAULT '' COMMENT '//描述(解释)',
  `field_type` varchar(50) NOT NULL DEFAULT '' COMMENT '//类型',
  `field_value` varchar(255) NOT NULL DEFAULT '' COMMENT '//类型值',
  PRIMARY KEY (`conf_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
