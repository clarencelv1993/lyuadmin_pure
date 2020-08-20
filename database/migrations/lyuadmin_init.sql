/*
 Navicat Premium Data Transfer

 Source Server         : 深圳阿里云
 Source Server Type    : MySQL
 Source Server Version : 80021
 Source Host           : 47.112.226.47:3306
 Source Schema         : lyuadmin_init

 Target Server Type    : MySQL
 Target Server Version : 80021
 File Encoding         : 65001

 Date: 20/08/2020 18:46:35
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `id` bigint(0) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `role_id` bigint(0) NOT NULL COMMENT '角色id',
  `admin_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '管理员用户名',
  `admin_nick_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户昵称',
  `admin_passwd` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '管理员密码',
  `is_enabled` tinyint(1) NOT NULL COMMENT '是否已启用 0：否  1：是',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否已删除',
  `created_at` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT '创建时间',
  `updated_at` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT '更新时间',
  `created_by` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '创建者',
  `updated_by` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '更新者',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES (1, 1, 'garen', '', '$2y$10$U2Y9uwjH0QZyPcfy4gxPlejcP3cGyL7vg3NECJCVqoBjc.FcgZwS2', 0, 0, '2020-08-07 17:29:06', '2020-08-07 17:29:06', 'garen', 'garen');
INSERT INTO `admin` VALUES (2, 2, 'kiki', '', '$2y$10$abhcfQ49TFGiO4XxqLERRukaE/Qn6VcukolocIMwfjxrefEVKJHFy', 1, 0, '2020-08-07 17:29:06', '2020-08-18 10:46:45', 'garen', 'garen');
INSERT INTO `admin` VALUES (3, 3, 'piggy', '', '$2y$10$umyer0BLa.CQllL5w2eOIOJ3oC7BlTZMt947p6xBTjtf/D81JXlne', 1, 0, '2020-08-13 16:55:14', '2020-08-14 15:19:23', 'garen', 'garen');

-- ----------------------------
-- Table structure for main_menu
-- ----------------------------
DROP TABLE IF EXISTS `main_menu`;
CREATE TABLE `main_menu`  (
  `id` bigint(0) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `mm_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '主菜单名称（仅英文-对应控制器）',
  `mm_icon` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '主菜单图标',
  `mm_desc` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '主菜单描述',
  `order` int(0) NOT NULL DEFAULT 0 COMMENT '排序',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否已删除 0：否  1：是',
  `created_by` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '创建者',
  `updated_by` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '更新者',
  `created_at` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT '创建时间',
  `updated_at` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of main_menu
-- ----------------------------
INSERT INTO `main_menu` VALUES (1, 'setting', 'setting', '系统设置', 1, 0, '', 'garen', '2020-08-07 17:28:50', '2020-08-17 22:36:00');

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role`  (
  `id` bigint(0) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `role_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '角色名称',
  `role_desc` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '角色描述',
  `role_permission` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '角色权限',
  `is_enabled` tinyint(1) NOT NULL COMMENT '是否已经启用  0：否  1：是',
  `is_deleted` tinyint(1) NOT NULL COMMENT '是否已经删除  0：否  1：是',
  `created_by` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '创建者',
  `updated_by` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '更新者',
  `created_at` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT '创建时间',
  `updated_at` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `IDX_role_name`(`role_name`) USING BTREE COMMENT '角色名唯一'
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES (1, 'root', '超级   管理员', '[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17]', 1, 0, 'garen', 'garen', '2020-08-14 18:46:22', '2020-08-19 13:17:48');
INSERT INTO `role` VALUES (2, 'admin', '管理员', '[4,5,6,7,9,10,11,12,13,14,16]', 1, 0, 'garen', 'garen', '2020-08-14 18:46:22', '2020-08-17 20:59:08');
INSERT INTO `role` VALUES (3, 'agent', '代理商', '[4,5,6,7,9,10,11,12,13]', 1, 0, 'garen', 'garen', '2020-08-14 18:46:22', '2020-08-18 09:57:22');

-- ----------------------------
-- Table structure for sub_menu
-- ----------------------------
DROP TABLE IF EXISTS `sub_menu`;
CREATE TABLE `sub_menu`  (
  `id` bigint(0) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `mm_id` bigint(0) NOT NULL DEFAULT 0 COMMENT '从属主菜单',
  `sm_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '子菜单名称（仅英文，对应控制器）',
  `sm_desc` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '子菜单描述',
  `order` int(0) NOT NULL DEFAULT 0 COMMENT '排序',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否已删除 0：否  1：是',
  `created_by` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `updated_by` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `created_at` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT '创建时间',
  `updated_at` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sub_menu
-- ----------------------------
INSERT INTO `sub_menu` VALUES (1, 1, 'role', '角色权限', 0, 0, '', 'garen', '2020-08-07 17:30:04', '2020-08-17 22:55:46');
INSERT INTO `sub_menu` VALUES (2, 1, 'main_menu', '主菜单', 0, 0, '', 'garen', '2020-08-07 17:30:04', '2020-08-07 17:30:04');
INSERT INTO `sub_menu` VALUES (3, 1, 'sub_menu', '子菜单', 0, 0, '', 'garen', '2020-08-07 17:30:04', '2020-08-07 17:30:04');

SET FOREIGN_KEY_CHECKS = 1;
