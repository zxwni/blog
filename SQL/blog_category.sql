/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2016-08-22 00:27:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for blog_category
-- ----------------------------
DROP TABLE IF EXISTS `blog_category`;
CREATE TABLE `blog_category` (
  `cate_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(50) NOT NULL DEFAULT '' COMMENT '//分类名称',
  `cate_title` varchar(255) NOT NULL DEFAULT '' COMMENT '//分类说明',
  `cate_keyword` varchar(255) NOT NULL DEFAULT '' COMMENT '//关键词',
  `cate_description` varchar(255) NOT NULL DEFAULT '' COMMENT '//描述',
  `cate_view` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '//查看次数',
  `cate_order` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '//排序',
  `cate_pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '//父级id',
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='//文章分类';
