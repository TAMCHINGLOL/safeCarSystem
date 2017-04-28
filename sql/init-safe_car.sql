/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : safe_car

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2017-04-20 15:14:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for bank_pay_message
-- ----------------------------
DROP TABLE IF EXISTS `bank_pay_message`;
CREATE TABLE `bank_pay_message` (
  `id` int(11) NOT NULL,
  `uid` varchar(255) DEFAULT NULL,
  `password` int(6) DEFAULT NULL,
  `bank_card` varchar(255) DEFAULT NULL,
  `id_card` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `industry_sn` varchar(255) DEFAULT NULL,
  `legal_person` varchar(255) DEFAULT NULL,
  `legal_id_card` varchar(255) DEFAULT NULL,
  `is_personal` tinyint(4) DEFAULT '1' COMMENT '是否为个人银行，默认为1否，2表示为企业银行',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for safe_car_action
-- ----------------------------
DROP TABLE IF EXISTS `safe_car_action`;
CREATE TABLE `safe_car_action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action_code` varchar(255) DEFAULT NULL,
  `action_name` varchar(255) DEFAULT NULL,
  `action_tag` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for safe_car_address
-- ----------------------------
DROP TABLE IF EXISTS `safe_car_address`;
CREATE TABLE `safe_car_address` (
  `region_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `region_name` varchar(120) NOT NULL DEFAULT '',
  `region_type` tinyint(1) NOT NULL DEFAULT '2',
  `agency_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `coun_id` int(11) DEFAULT '0' COMMENT 'ERP区县ID',
  `area_code` varchar(4) DEFAULT '0' COMMENT '手机所在区号',
  PRIMARY KEY (`region_id`),
  KEY `parent_id` (`parent_id`) USING BTREE,
  KEY `region_type` (`region_type`) USING BTREE,
  KEY `agency_id` (`agency_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4108 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for safe_car_admin
-- ----------------------------
DROP TABLE IF EXISTS `safe_car_admin`;
CREATE TABLE `safe_car_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `real_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `uid` varchar(255) DEFAULT NULL,
  `id_card` varchar(255) DEFAULT NULL,
  `header` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `action_list` varchar(255) DEFAULT NULL COMMENT '权限列表',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for safe_car_message
-- ----------------------------
DROP TABLE IF EXISTS `safe_car_message`;
CREATE TABLE `safe_car_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) NOT NULL,
  `car_sn` varchar(255) NOT NULL COMMENT '车辆编号',
  `phone` varchar(255) DEFAULT NULL,
  `plate_num` varchar(255) DEFAULT NULL COMMENT '车牌号码',
  `frame_num` varchar(255) DEFAULT NULL COMMENT '车架号',
  `engine_num` varchar(255) DEFAULT NULL COMMENT '发动机号',
  `buy_address` varchar(255) DEFAULT NULL COMMENT '购买地址',
  `type` varchar(255) DEFAULT NULL COMMENT '车型(大小之分)',
  `brand` varchar(255) DEFAULT NULL COMMENT '品牌(宝马)',
  `reg_time` varchar(255) DEFAULT NULL COMMENT '驾驶证注册时间',
  `flicense` varchar(255) DEFAULT NULL COMMENT '驾驶证正面照',
  `blicense` varchar(255) DEFAULT NULL COMMENT '驾驶证反面照',
  `model` varchar(255) DEFAULT NULL COMMENT '型号',
  `pattern` varchar(255) DEFAULT NULL COMMENT '款式',
  `is_insure` tinyint(4) DEFAULT '1' COMMENT '是否投保(默认1未投保，2为投保在线，3投保过期)',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for safe_car_policy_base
-- ----------------------------
DROP TABLE IF EXISTS `safe_car_policy_base`;
CREATE TABLE `safe_car_policy_base` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) NOT NULL COMMENT '车主uid',
  `base_sn` varchar(255) NOT NULL COMMENT '保险单号',
  `dealer_uid` varchar(255) DEFAULT '' COMMENT '经办人(主管)uid',
  `car_sn` varchar(255) DEFAULT NULL COMMENT '车辆编号',
  `type_sn` varchar(255) DEFAULT NULL COMMENT '保险种类编号',
  `rel_price` double DEFAULT NULL COMMENT '实际购买的价格',
  `payed` double DEFAULT NULL COMMENT '实际已经支付金额',
  `start_time` varchar(255) DEFAULT NULL COMMENT '购买时间',
  `end_time` varchar(255) DEFAULT NULL COMMENT '到期时间',
  `is_insure` tinyint(4) DEFAULT '3' COMMENT '是否确认购买(默认为1未购买,2分期购买,3已购买完整)',
  `is_buyed` tinyint(4) DEFAULT '1' COMMENT '是否购买过(默认1否，2是)',
  `type_list` varchar(255) DEFAULT NULL COMMENT '投保种类列表(一份保险可以同时存在人身保险/车险/财务保险)',
  `is_expire` tinyint(4) DEFAULT '1' COMMENT '是否已过期(默认为1未过期，2已经过期)',
  `is_sign` tinyint(4) DEFAULT '2' COMMENT '保险公司是否签章(默认1未签章,2已经盖章)',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for safe_car_policy_type
-- ----------------------------
DROP TABLE IF EXISTS `safe_car_policy_type`;
CREATE TABLE `safe_car_policy_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_sn` varchar(255) DEFAULT NULL COMMENT '保单种类编号',
  `name` varchar(255) DEFAULT NULL COMMENT '类型名称(如车辆定损)',
  `code` varchar(255) DEFAULT NULL,
  `header` double DEFAULT NULL COMMENT '头部全额(如人伤定损赔款*百分比)',
  `body` double DEFAULT NULL,
  `footer` double DEFAULT NULL,
  `other` double DEFAULT NULL COMMENT '补贴金额',
  `agree_id` int(11) DEFAULT NULL COMMENT '绑定对应的协议id',
  `remark` varchar(0) DEFAULT NULL COMMENT '关键性的备注提示',
  `favourable` varchar(255) DEFAULT NULL COMMENT '优惠/折扣',
  `price` double DEFAULT NULL,
  `start_time` varchar(255) DEFAULT NULL,
  `end_time` varchar(255) DEFAULT NULL COMMENT '活动结束时间',
  `is_validated` tinyint(4) DEFAULT '1' COMMENT '是否禁用 默认1否 ，2是',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for safe_car_role
-- ----------------------------
DROP TABLE IF EXISTS `safe_car_role`;
CREATE TABLE `safe_car_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) DEFAULT NULL,
  `auth_list` varchar(255) DEFAULT NULL,
  `role_code` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL COMMENT '角色描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for safe_car_settle_inspect
-- ----------------------------
DROP TABLE IF EXISTS `safe_car_settle_inspect`;
CREATE TABLE `safe_car_settle_inspect` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) DEFAULT NULL,
  `inspect_sn` varchar(255) DEFAULT NULL,
  `car_sn` varchar(255) DEFAULT NULL,
  `policy_sn` varchar(255) DEFAULT NULL,
  `type_sn` varchar(255) DEFAULT NULL,
  `happen_time` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `header_img_list` varchar(255) DEFAULT NULL COMMENT '车头所有图片路径拼接',
  `body_img_list` varchar(255) DEFAULT NULL COMMENT '车身所有图片路径拼接',
  `footer_img_list` varchar(255) DEFAULT NULL COMMENT '车尾所有图片路径拼接',
  `other_img_list` varchar(255) DEFAULT NULL COMMENT '其他细节图片路径拼接',
  `base_img` varchar(255) DEFAULT NULL COMMENT '车主签名基本附件',
  `custom_uid` varchar(255) DEFAULT NULL,
  `custom_remark` varchar(255) DEFAULT NULL,
  `inspect_uid` varchar(255) DEFAULT NULL,
  `inspect_remark` varchar(255) DEFAULT NULL,
  `start_time` varchar(255) DEFAULT NULL COMMENT '出勤时间',
  `end_time` varchar(255) DEFAULT NULL COMMENT '结束时间',
  `status` tinyint(4) DEFAULT '8' COMMENT '处理状态默认1未处理(告知勘察人员)，2进行中(勘察人员出勤中)，3待审核(待财务初级审核)，4审核不通过(客服需确认)，5审核不通过(勘察人员需确认)，6已审核(财务人审核通过)，7审核不通过，客服联系车主填写完整资料,8未调度,9待确认,10结案',
  `remark` varchar(255) DEFAULT NULL COMMENT '用于财务/主管审核不通过留下的备注',
  `finance_uid` varchar(255) DEFAULT NULL COMMENT '财务人员',
  `dealer_uid` varchar(255) DEFAULT NULL COMMENT '主管人员UID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for safe_car_settle_pay
-- ----------------------------
DROP TABLE IF EXISTS `safe_car_settle_pay`;
CREATE TABLE `safe_car_settle_pay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) DEFAULT NULL,
  `pay_sn` varchar(255) DEFAULT NULL,
  `dealer_uid` varchar(255) DEFAULT NULL,
  `finance_uid` varchar(255) DEFAULT NULL,
  `record_sn` varchar(255) DEFAULT NULL,
  `pay_type` varchar(255) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `create_time` varchar(255) DEFAULT NULL,
  `is_pay` tinyint(4) DEFAULT '1' COMMENT '是否支付(默认1为未支付,2为银行处理中,3为已完成支付)',
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for safe_car_settle_record
-- ----------------------------
DROP TABLE IF EXISTS `safe_car_settle_record`;
CREATE TABLE `safe_car_settle_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) DEFAULT NULL,
  `record_sn` varchar(255) DEFAULT NULL,
  `inspect_sn` varchar(255) DEFAULT NULL,
  `car_sn` varchar(255) DEFAULT NULL,
  `policy_sn` varchar(255) DEFAULT NULL,
  `type_sn` varchar(255) DEFAULT NULL,
  `add_time` varchar(255) DEFAULT NULL COMMENT '事故发生时间',
  `address` varchar(255) DEFAULT NULL COMMENT '事故发生地址',
  `create_time` varchar(255) DEFAULT NULL COMMENT '创建理赔单时间',
  `amount` double DEFAULT NULL COMMENT '理赔总金额',
  `payed` double DEFAULT NULL COMMENT '实际已支付金额',
  `dealer_uid` varchar(255) DEFAULT NULL COMMENT '主管uid（设置该字段是因为主管有可能是多个）',
  `finance_uid` varchar(255) DEFAULT NULL,
  `is_pass` tinyint(4) DEFAULT '1' COMMENT '审核是否通过 默认1待审核,2审核不通过(理赔金额不符合规定，需财务人员再次确认),3审核通过',
  `deal_remark` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for safe_car_sub_user
-- ----------------------------
DROP TABLE IF EXISTS `safe_car_sub_user`;
CREATE TABLE `safe_car_sub_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL COMMENT '员工编号',
  `password` varchar(255) DEFAULT NULL,
  `id_card` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `header` varchar(255) DEFAULT NULL,
  `real_name` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `reg_time` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `action_list` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `is_online` tinyint(4) DEFAULT '1' COMMENT '在线状态(默认1下班，2闲置，3出勤，4事假)',
  `is_validated` tinyint(11) DEFAULT '1' COMMENT '是否被禁用默认1为否，2为是',
  `open_uid` varchar(255) DEFAULT NULL COMMENT '第三方授权用户id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for safe_car_user
-- ----------------------------
DROP TABLE IF EXISTS `safe_car_user`;
CREATE TABLE `safe_car_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `reg_time` varchar(255) DEFAULT NULL,
  `id_card` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `header` varchar(255) DEFAULT NULL,
  `real_name` varchar(255) DEFAULT NULL,
  `pay_password` varchar(255) DEFAULT NULL,
  `is_validated` tinyint(4) DEFAULT '1' COMMENT '是否禁用 默认1否，2是',
  `open_uid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
