/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50539
Source Host           : localhost:3306
Source Database       : kuraudo

Target Server Type    : MYSQL
Target Server Version : 50539
File Encoding         : 65001

Date: 2015-05-31 23:06:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `file_downloads`
-- ----------------------------
DROP TABLE IF EXISTS `file_downloads`;
CREATE TABLE `file_downloads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vfile_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `date_` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of file_downloads
-- ----------------------------
INSERT INTO `file_downloads` VALUES ('1', '0', '8', '2015-05-29 16:19:14');
INSERT INTO `file_downloads` VALUES ('2', '0', '8', '2015-05-29 16:19:39');
INSERT INTO `file_downloads` VALUES ('3', '1', '8', '2015-05-30 16:21:13');
INSERT INTO `file_downloads` VALUES ('4', '1', '8', '2015-05-30 16:21:26');
INSERT INTO `file_downloads` VALUES ('5', '0', '8', '2015-05-30 16:23:50');
INSERT INTO `file_downloads` VALUES ('6', '72', '8', '2015-05-30 16:59:23');
INSERT INTO `file_downloads` VALUES ('7', '71', '8', '2015-05-31 16:59:36');
INSERT INTO `file_downloads` VALUES ('8', '73', '8', '2015-05-31 17:01:37');
INSERT INTO `file_downloads` VALUES ('9', '71', '8', '2015-05-31 17:01:49');
INSERT INTO `file_downloads` VALUES ('10', '74', '8', '2015-05-31 18:27:14');
INSERT INTO `file_downloads` VALUES ('11', '75', '8', '2015-05-31 18:55:05');
INSERT INTO `file_downloads` VALUES ('12', '77', '10', '2015-05-31 22:06:25');
INSERT INTO `file_downloads` VALUES ('13', '78', '10', '2015-05-31 22:07:29');
INSERT INTO `file_downloads` VALUES ('14', '79', '10', '2015-05-31 23:04:19');

-- ----------------------------
-- Table structure for `file_uploads`
-- ----------------------------
DROP TABLE IF EXISTS `file_uploads`;
CREATE TABLE `file_uploads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vfile_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `date` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of file_uploads
-- ----------------------------
INSERT INTO `file_uploads` VALUES ('1', '73', '8', '2015');
INSERT INTO `file_uploads` VALUES ('2', '74', '8', '2015');
INSERT INTO `file_uploads` VALUES ('3', '75', '9', '2015');
INSERT INTO `file_uploads` VALUES ('4', '76', '10', '2015');
INSERT INTO `file_uploads` VALUES ('5', '77', '10', '2015');
INSERT INTO `file_uploads` VALUES ('6', '78', '10', '2015');
INSERT INTO `file_uploads` VALUES ('7', '79', '10', '2015');

-- ----------------------------
-- Table structure for `folders`
-- ----------------------------
DROP TABLE IF EXISTS `folders`;
CREATE TABLE `folders` (
  `folder_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `folder_name` text,
  `contained_in` int(11) NOT NULL,
  PRIMARY KEY (`folder_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of folders
-- ----------------------------
INSERT INTO `folders` VALUES ('0', '5', 'home', '-1');
INSERT INTO `folders` VALUES ('1', '5', 'test', '0');
INSERT INTO `folders` VALUES ('2', '5', 'test2', '0');
INSERT INTO `folders` VALUES ('4', '8', 'home', '-1');
INSERT INTO `folders` VALUES ('5', '8', 'Amego', '0');
INSERT INTO `folders` VALUES ('6', '8', 'Bust a rhyme', '4');
INSERT INTO `folders` VALUES ('7', '8', 'Mfundisi', '6');
INSERT INTO `folders` VALUES ('8', '8', 'Bustarhyme', '7');
INSERT INTO `folders` VALUES ('9', '9', 'home', '-1');
INSERT INTO `folders` VALUES ('10', '9', 'Awe mase kind', '9');
INSERT INTO `folders` VALUES ('11', '8', 'test', '4');
INSERT INTO `folders` VALUES ('12', '10', 'home', '-1');
INSERT INTO `folders` VALUES ('13', '11', 'home', '-1');
INSERT INTO `folders` VALUES ('14', '10', 'shoX', '12');

-- ----------------------------
-- Table structure for `logical_files`
-- ----------------------------
DROP TABLE IF EXISTS `logical_files`;
CREATE TABLE `logical_files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `original_file_name` text,
  `original_uploader_id` int(11) DEFAULT NULL,
  `file_hash` text,
  `file_path` text,
  `file_size` bigint(20) DEFAULT NULL,
  `file_type` int(11) DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of logical_files
-- ----------------------------
INSERT INTO `logical_files` VALUES ('0', 'Clouds-moire-vector-material.jpg', '5', '92ed192a5183b4348c9562e484e6d59a1327c6c2', 'uploads\\e39c6bd412a257ed59b5805e313abc55.jpg', '330586', '0', '2015-05-05 15:05:55');
INSERT INTO `logical_files` VALUES ('13', 'Decimhead.jpg', '5', '7d206487972bb6e962c55a3429fa718bc0334818', 'uploads\\a8bedd2d5a202e0e8d0c2f0415f9be18.jpg', '17042', '0', '2015-05-08 12:20:44');
INSERT INTO `logical_files` VALUES ('14', 'lena_color.jpg', '5', 'a3125545350ce0e484cfe70d24802fa49177648b', 'uploads\\4e29842799b2eab04c3342515e4fdec5.jpg', '74665', '0', '2015-05-25 14:30:27');
INSERT INTO `logical_files` VALUES ('15', '482.GIF', '5', 'd711aa9f186c6614a7915f1e1fd741632bda7832', 'uploads\\857ea3491446363786dce2a70e7201cc.GIF', '7298', '0', '2015-05-31 16:37:15');
INSERT INTO `logical_files` VALUES ('16', '26403693-closeup-portrait-of-annoyed-young-man-admonishing-someone-to-stop-doing-something-isolated-on-white-.jpg', '8', 'c57f48c3f150d03a26a523251bdf52cf7ee83e23', 'uploads\\a15a7d55d734cfb8d9e0b03f4047d13f.jpg', '5793', '0', '2015-05-31 16:58:53');
INSERT INTO `logical_files` VALUES ('17', '2a4mgrI.jpg', '8', '8154d0a893822eb3d58a0272ced4c176620bd8ca', 'uploads\\dba849055cf750897fbf4aa9db557b83.jpg', '350957', '0', '2015-05-31 17:00:53');
INSERT INTO `logical_files` VALUES ('18', '1637536.jpg', '8', '4bc5bc15d394a9318f6294893a800fd6cba2e567', 'uploads\\e85055c82330b58646d503908d42abc5.jpg', '1378296', '0', '2015-05-31 18:26:29');
INSERT INTO `logical_files` VALUES ('19', '20959949_s.png', '9', '1f49c0286174734b3e7adac86d756d015dbd0519', 'uploads\\250e42780fb089d09deefcb3c90170c7.png', '70772', '0', '2015-05-31 18:54:51');
INSERT INTO `logical_files` VALUES ('20', '24XuqPl.png', '10', '035f95714cf99a126cdd837a66ac7c458032f771', 'uploads\\088a6845b40cf9ee3c83ac8a19fd3b45.png', '92940', '0', '2015-05-31 22:05:15');
INSERT INTO `logical_files` VALUES ('21', '029.png', '10', 'b63d63a804353769763b791dff35e200a9bb9c80', '../uploads\\c9a09adefa7d9269be4f35f09fde90b2.png', '12306', '0', '2015-05-31 22:06:12');
INSERT INTO `logical_files` VALUES ('22', 'cat.png', '10', '4e46379a8dbd7b8321c67aae3615bd4a2d98bc4a', 'uploads\\752aedc8c5c5fd74aefde00d5747741f.png', '17897', '0', '2015-05-31 22:07:12');
INSERT INTO `logical_files` VALUES ('23', '2000px-Orange_lambda.svg.png', '10', 'c2d00a1aa3ce7cecb780f3bc31371c828967a700', 'uploads\\d1492d9846740254ba4f5853763fe71a.png', '72884', '0', '2015-05-31 23:04:10');

-- ----------------------------
-- Table structure for `logins`
-- ----------------------------
DROP TABLE IF EXISTS `logins`;
CREATE TABLE `logins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of logins
-- ----------------------------
INSERT INTO `logins` VALUES ('1', '5', '2015-05-31 16:24:44');
INSERT INTO `logins` VALUES ('2', '8', '2015-05-31 16:48:35');
INSERT INTO `logins` VALUES ('3', '9', '2015-05-31 18:54:15');
INSERT INTO `logins` VALUES ('4', '9', '2015-05-31 19:06:32');
INSERT INTO `logins` VALUES ('5', '8', '2015-05-31 19:13:56');
INSERT INTO `logins` VALUES ('6', '8', '2015-05-31 22:03:16');
INSERT INTO `logins` VALUES ('7', '8', '2015-05-31 22:03:55');
INSERT INTO `logins` VALUES ('8', '10', '2015-05-31 22:05:04');
INSERT INTO `logins` VALUES ('9', '10', '2015-05-31 22:39:25');
INSERT INTO `logins` VALUES ('10', '10', '2015-05-31 23:04:43');

-- ----------------------------
-- Table structure for `permissions`
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `folder_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `owner_` tinyint(4) DEFAULT NULL,
  `read_` tinyint(4) DEFAULT NULL,
  `write_` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`folder_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES ('0', '0', '0', '1', '1');
INSERT INTO `permissions` VALUES ('11', '8', '1', '1', '1');
INSERT INTO `permissions` VALUES ('12', '8', '0', '1', '1');
INSERT INTO `permissions` VALUES ('12', '10', '1', '1', '1');
INSERT INTO `permissions` VALUES ('13', '11', '1', '1', '1');
INSERT INTO `permissions` VALUES ('14', '10', '1', '1', '1');

-- ----------------------------
-- Table structure for `public_folders`
-- ----------------------------
DROP TABLE IF EXISTS `public_folders`;
CREATE TABLE `public_folders` (
  `folder_id` int(11) NOT NULL DEFAULT '0',
  `public` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`folder_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of public_folders
-- ----------------------------
INSERT INTO `public_folders` VALUES ('12', '0');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `username` text,
  `fname` text,
  `lname` text,
  `email` text,
  `password` text,
  `user_plan` int(11) DEFAULT '2',
  `default_folder` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('8', '1gn1t0r', 'Stefan', 'Jacholke', 'stefanjacholke@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1', '4');
INSERT INTO `users` VALUES ('9', '1gn1t0r2', 'Stefan', 'Jacholke', 'stefanjacholke2@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2', '9');
INSERT INTO `users` VALUES ('10', 'rogerw', 'Roger', 'Wessels', 'rogerwessels@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2', '12');

-- ----------------------------
-- Table structure for `user_plans`
-- ----------------------------
DROP TABLE IF EXISTS `user_plans`;
CREATE TABLE `user_plans` (
  `plan_id` int(11) NOT NULL DEFAULT '0',
  `description` text,
  `space_available` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`plan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_plans
-- ----------------------------
INSERT INTO `user_plans` VALUES ('1', 'Test', '10737410');
INSERT INTO `user_plans` VALUES ('2', 'Free User', '1073741824');
INSERT INTO `user_plans` VALUES ('3', 'Premium', '10737418240');
INSERT INTO `user_plans` VALUES ('4', 'Premium Plus', '1099511627776');

-- ----------------------------
-- Table structure for `virtual_files`
-- ----------------------------
DROP TABLE IF EXISTS `virtual_files`;
CREATE TABLE `virtual_files` (
  `vfile_id` int(11) NOT NULL AUTO_INCREMENT,
  `pfile_id` int(11) NOT NULL DEFAULT '0',
  `folder_id` int(11) NOT NULL DEFAULT '0',
  `file_name` text NOT NULL,
  PRIMARY KEY (`vfile_id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of virtual_files
-- ----------------------------
INSERT INTO `virtual_files` VALUES ('1', '0', '2', 'awe.png');
INSERT INTO `virtual_files` VALUES ('70', '15', '0', '482.GIF');
INSERT INTO `virtual_files` VALUES ('72', '16', '4', '26403693-closeup-portrait-of-annoyed-young-man-admonishing-someone-to-stop-doing-something-isolated-on-white-.jpg');
INSERT INTO `virtual_files` VALUES ('73', '17', '4', '2a4mgrI.jpg');
INSERT INTO `virtual_files` VALUES ('74', '18', '8', '1637536.jpg');
INSERT INTO `virtual_files` VALUES ('75', '19', '10', '20959949_s.png');
INSERT INTO `virtual_files` VALUES ('76', '20', '12', 'FunnyPic.png');
INSERT INTO `virtual_files` VALUES ('77', '21', '12', '029.png');
INSERT INTO `virtual_files` VALUES ('79', '23', '14', '2000px-Orange_lambda.svg.png');
