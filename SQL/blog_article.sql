/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2016-08-22 00:27:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for blog_article
-- ----------------------------
DROP TABLE IF EXISTS `blog_article`;
CREATE TABLE `blog_article` (
  `art_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `art_title` varchar(100) NOT NULL DEFAULT '' COMMENT '//文档标题',
  `art_tag` varchar(100) NOT NULL DEFAULT '' COMMENT '//关键词',
  `art_description` varchar(255) NOT NULL DEFAULT '' COMMENT '//文章描述',
  `art_thumb` varchar(255) NOT NULL DEFAULT '' COMMENT '//缩略图',
  `art_content` text NOT NULL COMMENT '//文章内容',
  `art_time` int(11) NOT NULL DEFAULT '0' COMMENT '//发布时间',
  `art_editor` varchar(50) NOT NULL DEFAULT '' COMMENT '//作者',
  `art_view` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '//查看次数',
  `cate_id` int(11) NOT NULL DEFAULT '0' COMMENT '//分类id',
  PRIMARY KEY (`art_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='//文章表';
