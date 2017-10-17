/*
Navicat MySQL Data Transfer

Source Server         : link
Source Server Version : 50538
Source Host           : localhost:3306
Source Database       : seltdb

Target Server Type    : MYSQL
Target Server Version : 50538
File Encoding         : 65001

Date: 2016-11-02 20:58:04
*/

SET FOREIGN_KEY_CHECKS=0;

DROP database if EXISTS `seltdb`;
CREATE DATABASE `seltdb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `seltdb`;
-- ----------------------------
-- Table structure for selt_config
-- ----------------------------
DROP TABLE IF EXISTS `selt_config`;
CREATE TABLE `selt_config` (
  `con_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `con_key` varchar(16) NOT NULL COMMENT '配置变量',
  `con_value` varchar(16) NOT NULL COMMENT '配置变量值',
  `con_inst` varchar(300) NOT NULL COMMENT '参数功能说明',
  PRIMARY KEY (`con_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='系统配置参数表';

-- ----------------------------
-- Records of selt_config
-- ----------------------------
INSERT INTO `selt_config` VALUES ('1', 'cfg_numofpage', '200', '设置每页显示记录条数');
INSERT INTO `selt_config` VALUES ('2', 'cfg_qq', '383040202', 'QQ');
INSERT INTO `selt_config` VALUES ('3', 'cfg_phone', '18679958857', '手机');
INSERT INTO `selt_config` VALUES ('4', 'cfg_info', '简要说明', '1.第一个人选题完成后，第二个人需要接着选题必须将浏览器关闭后才能继续。\r\n2.该系统刚上线运行，难免有开发及测试阶段没有发现的问题。\r\n3.如果出现了问题，那让我们一起解决问题，电话或QQ联系。\r\n4.如在线解决不了的，可以线下再统一解决，不要慌。\r\n5.电话或QQ时，直入主题，说明问题所在，不说与问题无关的事。\r\n6.最后祝大家顺利毕业，找到自己满意的工作，调整心态，开开心心地享受大四的美好时光。');

-- ----------------------------
-- Table structure for selt_ctitle
-- ----------------------------
DROP TABLE IF EXISTS `selt_ctitle`;
CREATE TABLE `selt_ctitle` (
  `c_Id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `c_Num` int(11) NOT NULL COMMENT '题目序号',
  `c_Tutor` varchar(8) NOT NULL COMMENT '导师姓名',
  `c_Title` varchar(50) NOT NULL COMMENT '题目',
  `c_People` int(11) NOT NULL DEFAULT '1' COMMENT '允许选题人数',
  `c_Left` int(11) NOT NULL DEFAULT '1' COMMENT '所剩人数',
  `c_Class` varchar(5) NOT NULL COMMENT '题目类别，只允许“计算机类”和“电子类',
  PRIMARY KEY (`c_Id`)
) ENGINE=MyISAM AUTO_INCREMENT=1869 DEFAULT CHARSET=utf8 COMMENT='题库';

-- ----------------------------
-- Records of selt_ctitle
-- ----------------------------

-- ----------------------------
-- Table structure for selt_result
-- ----------------------------
DROP TABLE IF EXISTS `selt_result`;
CREATE TABLE `selt_result` (
  `r_Id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `s_Id` int(11) NOT NULL COMMENT '学生id',
  `c_Id` int(11) NOT NULL COMMENT '题目id',
  `r_Order` datetime NOT NULL COMMENT '选题时间',
  PRIMARY KEY (`r_Id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='选题结果表';

-- ----------------------------
-- Records of selt_result
-- ----------------------------

-- ----------------------------
-- Table structure for selt_sinfo
-- ----------------------------
DROP TABLE IF EXISTS `selt_sinfo`;
CREATE TABLE `selt_sinfo` (
  `s_Id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `s_Num` varchar(14) NOT NULL COMMENT '学号',
  `s_Name` varchar(10) NOT NULL COMMENT '姓名',
  `s_Pwd` varchar(32) DEFAULT NULL COMMENT '密码',
  `s_Sex` varchar(1) DEFAULT NULL COMMENT '性别',
  `s_SC` int(11) DEFAULT NULL COMMENT '专业id',
  `s_Phone` varchar(25) DEFAULT NULL COMMENT '电话',
  `s_Email` varchar(30) DEFAULT NULL COMMENT '邮箱',
  `s_Datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`s_Id`)
) ENGINE=MyISAM AUTO_INCREMENT=2706 DEFAULT CHARSET=utf8 COMMENT='学生信息';

-- ----------------------------
-- Records of selt_sinfo
-- ----------------------------

-- ----------------------------
-- Table structure for selt_specility
-- ----------------------------
DROP TABLE IF EXISTS `selt_specility`;
CREATE TABLE `selt_specility` (
  `sp_Id` int(11) NOT NULL AUTO_INCREMENT,
  `sp_Name` varchar(20) NOT NULL,
  `sp_Classes` varchar(4) NOT NULL,
  PRIMARY KEY (`sp_Id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COMMENT='专业表';

-- ----------------------------
-- Records of selt_specility
-- ----------------------------

-- ----------------------------
-- Table structure for selt_time
-- ----------------------------
DROP TABLE IF EXISTS `selt_time`;
CREATE TABLE `selt_time` (
  `t_Id` int(11) NOT NULL AUTO_INCREMENT,
  `t_startTime` varchar(16) NOT NULL,
  `t_endTime` varchar(16) NOT NULL,
  PRIMARY KEY (`t_Id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='选题时间表';

-- ----------------------------
-- Records of selt_time
-- ----------------------------
INSERT INTO `selt_time` VALUES ('5', '2016/09/24 23:17', '2016/11/19 08:00');

-- ----------------------------
-- Table structure for selt_umanager
-- ----------------------------
DROP TABLE IF EXISTS `selt_umanager`;
CREATE TABLE `selt_umanager` (
  `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `uname` varchar(16) NOT NULL COMMENT '用户名',
  `upwd` varchar(32) NOT NULL COMMENT '用户密码',
  `uright` int(11) NOT NULL COMMENT '用户权限',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of selt_umanager
-- ----------------------------
INSERT INTO `selt_umanager` VALUES ('16', 'admin', '6a204bd89f3c8348afd5c77c717a097a', '0');
INSERT INTO `selt_umanager` VALUES ('19', 'dxfy0015', '6a204bd89f3c8348afd5c77c717a097a', '0');
