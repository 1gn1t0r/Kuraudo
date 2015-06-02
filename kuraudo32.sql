/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50539
Source Host           : localhost:3306
Source Database       : kuraudo

Target Server Type    : MYSQL
Target Server Version : 50539
File Encoding         : 65001

Date: 2015-06-02 10:02:49
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
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of file_downloads
-- ----------------------------
INSERT INTO `file_downloads` VALUES ('22', '84', '12', '2015-06-01 13:18:24');
INSERT INTO `file_downloads` VALUES ('23', '83', '12', '2015-06-01 13:18:36');
INSERT INTO `file_downloads` VALUES ('24', '84', '12', '2015-06-01 13:19:29');
INSERT INTO `file_downloads` VALUES ('25', '83', '12', '2015-06-01 13:21:51');
INSERT INTO `file_downloads` VALUES ('26', '84', '12', '2015-06-01 13:21:55');
INSERT INTO `file_downloads` VALUES ('27', '83', '12', '2015-06-01 13:22:04');
INSERT INTO `file_downloads` VALUES ('28', '83', '12', '2015-06-01 13:23:12');
INSERT INTO `file_downloads` VALUES ('29', '84', '12', '2015-06-01 13:24:16');
INSERT INTO `file_downloads` VALUES ('30', '83', '12', '2015-06-01 13:24:29');
INSERT INTO `file_downloads` VALUES ('31', '83', '12', '2015-06-01 13:26:11');
INSERT INTO `file_downloads` VALUES ('32', '83', '12', '2015-06-01 13:26:28');
INSERT INTO `file_downloads` VALUES ('33', '84', '12', '2015-06-01 13:27:35');
INSERT INTO `file_downloads` VALUES ('34', '83', '12', '2015-06-01 13:27:42');
INSERT INTO `file_downloads` VALUES ('35', '83', '12', '2015-06-01 13:27:49');
INSERT INTO `file_downloads` VALUES ('36', '84', '12', '2015-06-01 13:27:53');
INSERT INTO `file_downloads` VALUES ('37', '83', '12', '2015-06-01 13:28:57');
INSERT INTO `file_downloads` VALUES ('38', '84', '12', '2015-06-01 13:31:34');
INSERT INTO `file_downloads` VALUES ('39', '84', '12', '2015-06-01 13:31:39');
INSERT INTO `file_downloads` VALUES ('40', '84', '12', '2015-06-01 13:32:16');
INSERT INTO `file_downloads` VALUES ('41', '84', '12', '2015-06-01 13:42:05');
INSERT INTO `file_downloads` VALUES ('42', '84', '12', '2015-06-01 13:42:09');
INSERT INTO `file_downloads` VALUES ('43', '84', '12', '2015-06-01 13:42:46');
INSERT INTO `file_downloads` VALUES ('44', '84', '12', '2015-06-01 13:42:50');
INSERT INTO `file_downloads` VALUES ('45', '86', '12', '2015-06-01 13:43:37');
INSERT INTO `file_downloads` VALUES ('46', '83', '12', '2015-06-01 13:43:44');
INSERT INTO `file_downloads` VALUES ('47', '84', '12', '2015-06-01 13:44:17');
INSERT INTO `file_downloads` VALUES ('48', '83', '12', '2015-06-01 13:44:33');
INSERT INTO `file_downloads` VALUES ('49', '84', '12', '2015-06-01 13:44:44');
INSERT INTO `file_downloads` VALUES ('50', '83', '12', '2015-06-01 13:44:48');
INSERT INTO `file_downloads` VALUES ('51', '84', '12', '2015-06-01 13:45:47');
INSERT INTO `file_downloads` VALUES ('52', '83', '12', '2015-06-01 13:45:51');
INSERT INTO `file_downloads` VALUES ('53', '83', '12', '2015-06-01 13:47:03');
INSERT INTO `file_downloads` VALUES ('54', '84', '12', '2015-06-01 13:47:07');
INSERT INTO `file_downloads` VALUES ('55', '84', '12', '2015-06-01 13:47:27');
INSERT INTO `file_downloads` VALUES ('56', '83', '12', '2015-06-01 13:47:35');
INSERT INTO `file_downloads` VALUES ('57', '83', '12', '2015-06-01 13:47:37');
INSERT INTO `file_downloads` VALUES ('58', '83', '12', '2015-06-01 13:53:06');
INSERT INTO `file_downloads` VALUES ('59', '86', '12', '2015-06-01 13:53:09');
INSERT INTO `file_downloads` VALUES ('60', '82', '12', '2015-06-01 14:16:45');
INSERT INTO `file_downloads` VALUES ('61', '83', '12', '2015-06-02 08:45:23');

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of file_uploads
-- ----------------------------
INSERT INTO `file_uploads` VALUES ('9', '81', '12', '2015');
INSERT INTO `file_uploads` VALUES ('10', '82', '12', '2015');
INSERT INTO `file_uploads` VALUES ('11', '83', '12', '2015');
INSERT INTO `file_uploads` VALUES ('12', '84', '12', '2015');
INSERT INTO `file_uploads` VALUES ('13', '85', '12', '2015');
INSERT INTO `file_uploads` VALUES ('14', '86', '12', '2015');

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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of folders
-- ----------------------------
INSERT INTO `folders` VALUES ('29', '12', 'home', '-1');
INSERT INTO `folders` VALUES ('30', '12', 'Hey', '29');

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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of logical_files
-- ----------------------------
INSERT INTO `logical_files` VALUES ('25', 'track.mp3', '12', '', 'uploads\\fc7c0c6e597e2457076157e5360845ec.mp3', '0', '0', '2015-06-01 12:56:20');
INSERT INTO `logical_files` VALUES ('26', 'arabian_horse.jpg', '12', '16266983e4f9b1dadf4dc536c9fda1a98bae7103', 'uploads\\8f9dd113667e9e2f2e5b7252f35c918a.jpg', '17796', '0', '2015-06-01 13:16:16');
INSERT INTO `logical_files` VALUES ('27', 'crying-eyes_s.jpg', '12', '770f36e4332e549e3eb2044bd5b0ef2ca764c4d2', 'uploads\\a2dea21d849cff564a86bde727dae8b2.jpg', '38314', '0', '2015-06-01 13:18:15');
INSERT INTO `logical_files` VALUES ('28', 'chromeinstall-8u45.exe', '12', 'd03c784265ee08a560985b702c9a7465d40081d0', 'uploads\\5801b80d19c764d54023c8072c5461a5.exe', '562272', '0', '2015-06-01 13:43:25');

-- ----------------------------
-- Table structure for `logins`
-- ----------------------------
DROP TABLE IF EXISTS `logins`;
CREATE TABLE `logins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

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
INSERT INTO `logins` VALUES ('11', '10', '2015-06-01 09:12:02');
INSERT INTO `logins` VALUES ('12', '10', '2015-06-01 09:27:13');
INSERT INTO `logins` VALUES ('13', '10', '2015-06-01 10:02:46');
INSERT INTO `logins` VALUES ('14', '10', '2015-06-01 10:06:04');
INSERT INTO `logins` VALUES ('15', '8', '2015-06-01 10:29:54');
INSERT INTO `logins` VALUES ('16', '10', '2015-06-01 10:31:42');
INSERT INTO `logins` VALUES ('17', '10', '2015-06-01 12:44:18');
INSERT INTO `logins` VALUES ('18', '8', '2015-06-01 12:48:11');
INSERT INTO `logins` VALUES ('19', '8', '2015-06-01 12:50:47');
INSERT INTO `logins` VALUES ('20', '12', '2015-06-01 12:52:57');
INSERT INTO `logins` VALUES ('21', '12', '2015-06-01 13:16:03');
INSERT INTO `logins` VALUES ('22', '12', '2015-06-02 08:30:27');
INSERT INTO `logins` VALUES ('23', '12', '2015-06-02 08:45:09');

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
INSERT INTO `permissions` VALUES ('29', '12', '1', '1', '1');
INSERT INTO `permissions` VALUES ('30', '12', '1', '1', '1');

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
INSERT INTO `public_folders` VALUES ('29', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('12', '1gn1t0r', 'Stefan', 'Jacholke', 'stefanjacholke@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2', '29');

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
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of virtual_files
-- ----------------------------
INSERT INTO `virtual_files` VALUES ('82', '25', '30', 'track.mp3');
INSERT INTO `virtual_files` VALUES ('83', '26', '30', 'arabian_horse.jpg');
INSERT INTO `virtual_files` VALUES ('84', '27', '29', 'crying-eyes_s.jpg');
INSERT INTO `virtual_files` VALUES ('85', '0', '29', '201889312-Expertise-and-Expert-Performance-pdf.pdf');
INSERT INTO `virtual_files` VALUES ('86', '28', '29', 'chromeinstall-8u45.exe');
