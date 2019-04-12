/*
MySQL Backup
Source Server Version: 5.5.40
Source Database: tpcms
Date: 2016/9/30 11:02:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
--  Table structure for `wym_auth`
-- ----------------------------
DROP TABLE IF EXISTS `wym_auth`;
CREATE TABLE `wym_auth` (
  `auth_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '权限ID号',
  `auth_name` varchar(20) NOT NULL DEFAULT '' COMMENT '权限名称',
  `pid` int(10) NOT NULL COMMENT '父级权限的ID号',
  `auth_controller` varchar(32) NOT NULL DEFAULT '' COMMENT '权限对应的控制器名',
  `auth_action` varchar(32) NOT NULL DEFAULT '' COMMENT '权限对应的方法名',
  `auth_id_path` varchar(32) NOT NULL DEFAULT '' COMMENT '权限从父级ID一直到自己ID的路径，如1-2-3',
  `auth_level` int(10) NOT NULL DEFAULT '0' COMMENT '权限级别',
  `auth_status` int(1) NOT NULL DEFAULT '1' COMMENT '是否有效，默认有效',
  PRIMARY KEY (`auth_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='权限表';

-- ----------------------------
--  Table structure for `wym_manager`
-- ----------------------------
DROP TABLE IF EXISTS `wym_manager`;
CREATE TABLE `wym_manager` (
  `mg_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理员ID号',
  `mg_name` varchar(32) NOT NULL DEFAULT '' COMMENT '管理员名称',
  `mg_pwd` varchar(32) NOT NULL DEFAULT '' COMMENT '管理员密码',
  `mg_role_id` int(10) NOT NULL DEFAULT '0' COMMENT '管理员所属角色的ID号',
  `mg_addtime` int(10) NOT NULL DEFAULT '0' COMMENT '添加管理员时间',
  `mg_status` int(1) NOT NULL DEFAULT '1' COMMENT '管理员开启状态 1正常可用 0关闭不可用',
  PRIMARY KEY (`mg_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
--  Table structure for `wym_role`
-- ----------------------------
DROP TABLE IF EXISTS `wym_role`;
CREATE TABLE `wym_role` (
  `role_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '角色的ID号',
  `role_name` varchar(20) NOT NULL DEFAULT '' COMMENT '角色名称',
  `role_info` text COMMENT '角色工作内容描述',
  `role_auth_ids` varchar(128) DEFAULT '' COMMENT '角色拥有的权限的ID号，如1,2,3',
  `role_auth_ca` text COMMENT '角色拥有的权限名称连接，如Index-index,Index-index2',
  `role_status` int(2) DEFAULT '1' COMMENT '角色状态 0被锁定 1正常',
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='角色表';

-- ----------------------------
--  Records 
-- ----------------------------
INSERT INTO `wym_auth` VALUES ('1','系统管理','0','','','1','0','1'), ('11','权限管理','1','Auth','index','1-11','1','1'), ('12','角色管理','1','Role','index','1-12','1','1'), ('13','管理员管理','1','Adminuser','index','1-13','1','1'), ('14','添加权限','11','Auth','add','1-11-14','2','1'), ('15','会员管理','0','','','15','0','1'), ('16','删除权限','11','Auth','delete','1-11-16','2','1'), ('19','添加管理员','13','Adminuser','add','1-13-19','2','1'), ('20','添加角色','12','Role','add','1-12-20','2','1'), ('21','删除角色','12','Role','del','1-12-21','2','1'), ('22','编辑角色','12','Role','edi','1-12-22','2','1'), ('23','编辑管理员','13','Adminuser','edi','1-13-23','2','1'), ('24','删除管理员','13','Adminuser','del','1-13-24','2','1'), ('25','添加会员','15','Users','add','15-25','1','1');
INSERT INTO `wym_manager` VALUES ('1','吴义敏','e10adc3949ba59abbe56e057f20f883e','6','1473303083','1');
INSERT INTO `wym_role` VALUES ('2','超级管理员','一切权限','1,11,14,16,12,20,21,22,13,19,23,24,15','-,Auth-index,Auth-add,Auth-delete,Role-index,Role-add,Role-del,Role-edi,Adminuser-index,Adminuser-add,Adminuser-edi,Adminuser-del,-','1'), ('6','系统研发工程师','权限管理的添加和删除','1,11,14,16','-,Auth-index,Auth-add,Auth-delete','1');
