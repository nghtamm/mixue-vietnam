/*
 Navicat Premium Dump SQL

 Source Server         : MySQL@localhost
 Source Server Type    : MySQL
 Source Server Version : 80300 (8.3.0)
 Source Host           : localhost:3306
 Source Schema         : mixue

 Target Server Type    : MySQL
 Target Server Version : 80300 (8.3.0)
 File Encoding         : 65001

 Date: 22/06/2024 19:10:06
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for DailyOrderCount
-- ----------------------------
DROP TABLE IF EXISTS `DailyOrderCount`;
CREATE TABLE `DailyOrderCount`  (
  `date` datetime NOT NULL,
  `order_count` int NULL DEFAULT 0,
  `restaurant_id` int NULL DEFAULT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 43 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of DailyOrderCount
-- ----------------------------
INSERT INTO `DailyOrderCount` VALUES ('2024-02-18 00:00:00', 46, 1, 24);
INSERT INTO `DailyOrderCount` VALUES ('2024-02-18 00:00:00', 1, 3, 25);
INSERT INTO `DailyOrderCount` VALUES ('2024-02-19 00:00:00', 12, 1, 26);
INSERT INTO `DailyOrderCount` VALUES ('2024-02-20 00:00:00', 1, 2, 27);
INSERT INTO `DailyOrderCount` VALUES ('2024-02-20 00:00:00', 4, 1, 28);
INSERT INTO `DailyOrderCount` VALUES ('2024-02-21 00:00:00', 5, 1, 29);
INSERT INTO `DailyOrderCount` VALUES ('2024-02-22 00:00:00', 1, 1, 30);
INSERT INTO `DailyOrderCount` VALUES ('2024-02-23 00:00:00', 5, 1, 31);
INSERT INTO `DailyOrderCount` VALUES ('2024-02-24 00:00:00', 6, 1, 32);
INSERT INTO `DailyOrderCount` VALUES ('2024-02-24 00:00:00', 1, 3, 33);
INSERT INTO `DailyOrderCount` VALUES ('2024-02-25 00:00:00', 9, 1, 34);
INSERT INTO `DailyOrderCount` VALUES ('2024-02-26 00:00:00', 2, 1, 35);
INSERT INTO `DailyOrderCount` VALUES ('2024-03-02 00:00:00', 1, 2, 36);
INSERT INTO `DailyOrderCount` VALUES ('2024-03-02 00:00:00', 1, 1, 37);
INSERT INTO `DailyOrderCount` VALUES ('2024-05-10 00:00:00', 1, 1, 38);
INSERT INTO `DailyOrderCount` VALUES ('2024-06-16 00:00:00', 22, 1, 39);
INSERT INTO `DailyOrderCount` VALUES ('2024-06-17 00:00:00', 39, 1, 40);
INSERT INTO `DailyOrderCount` VALUES ('2024-06-19 00:00:00', 3, 1, 41);
INSERT INTO `DailyOrderCount` VALUES ('2024-06-20 00:00:00', 15, 1, 42);

-- ----------------------------
-- Table structure for OrderDetail
-- ----------------------------
DROP TABLE IF EXISTS `OrderDetail`;
CREATE TABLE `OrderDetail`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NULL DEFAULT NULL,
  `product_id` int NULL DEFAULT NULL,
  `quantity` int NULL DEFAULT NULL,
  `price` decimal(10, 0) NULL DEFAULT NULL,
  `sugar_id` int NULL DEFAULT NULL,
  `ice_id` int NULL DEFAULT NULL,
  `product_total` decimal(10, 0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `order_id`(`order_id` ASC) USING BTREE,
  INDEX `product_id`(`product_id` ASC) USING BTREE,
  INDEX `sugar_id`(`sugar_id` ASC) USING BTREE,
  INDEX `ice_id`(`ice_id` ASC) USING BTREE,
  CONSTRAINT `OrderDetail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `Orders` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `OrderDetail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `OrderDetail_ibfk_3` FOREIGN KEY (`sugar_id`) REFERENCES `sugarOption` (`sugar_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `OrderDetail_ibfk_4` FOREIGN KEY (`ice_id`) REFERENCES `iceOption` (`ice_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 552 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of OrderDetail
-- ----------------------------
INSERT INTO `OrderDetail` VALUES (328, 292, 250, 2, 25000, 3, 3, 50000);
INSERT INTO `OrderDetail` VALUES (329, 293, 250, 2, 25000, 3, 3, 50000);
INSERT INTO `OrderDetail` VALUES (330, 294, 250, 2, 25000, 3, 3, 50000);
INSERT INTO `OrderDetail` VALUES (331, 295, 250, 2, 25000, 3, 3, 50000);
INSERT INTO `OrderDetail` VALUES (332, 296, 250, 2, 25000, 3, 3, 50000);
INSERT INTO `OrderDetail` VALUES (333, 297, 223, 3, 25000, 3, 3, 75000);
INSERT INTO `OrderDetail` VALUES (334, 298, 250, 2, 25000, 3, 3, 50000);
INSERT INTO `OrderDetail` VALUES (335, 299, 250, 2, 25000, 3, 3, 50000);
INSERT INTO `OrderDetail` VALUES (336, 300, 250, 2, 25000, 3, 3, 50000);
INSERT INTO `OrderDetail` VALUES (337, 301, 250, 2, 25000, 3, 3, 50000);
INSERT INTO `OrderDetail` VALUES (338, 302, 250, 2, 25000, 3, 3, 50000);
INSERT INTO `OrderDetail` VALUES (339, 303, 250, 2, 25000, 3, 3, 50000);
INSERT INTO `OrderDetail` VALUES (340, 304, 250, 2, 25000, 3, 3, 50000);
INSERT INTO `OrderDetail` VALUES (341, 305, 249, 3, 25000, 3, 3, 75000);
INSERT INTO `OrderDetail` VALUES (342, 306, 271, 2, 25000, 3, 3, 50000);
INSERT INTO `OrderDetail` VALUES (343, 307, 271, 2, 25000, 3, 3, 50000);
INSERT INTO `OrderDetail` VALUES (344, 308, 250, 2, 25000, 3, 3, 50000);
INSERT INTO `OrderDetail` VALUES (345, 309, 249, 2, 25000, 3, 3, 50000);
INSERT INTO `OrderDetail` VALUES (346, 310, 203, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (347, 310, 199, 1, 22000, 2, 2, 22000);
INSERT INTO `OrderDetail` VALUES (348, 310, 203, 1, 25000, 2, 2, 25000);
INSERT INTO `OrderDetail` VALUES (349, 311, 250, 2, 25000, 3, 3, 50000);
INSERT INTO `OrderDetail` VALUES (350, 312, 250, 2, 25000, 3, 3, 50000);
INSERT INTO `OrderDetail` VALUES (468, 361, 249, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (469, 361, 277, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (470, 361, 274, 1, 22000, 3, 3, 22000);
INSERT INTO `OrderDetail` VALUES (471, 361, 270, 1, 17000, 3, 3, 17000);
INSERT INTO `OrderDetail` VALUES (472, 362, 278, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (473, 362, 271, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (474, 362, 273, 1, 22000, 3, 3, 22000);
INSERT INTO `OrderDetail` VALUES (475, 363, 253, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (476, 363, 249, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (477, 364, 251, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (478, 364, 249, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (479, 364, 278, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (480, 365, 251, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (481, 365, 249, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (482, 365, 250, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (483, 365, 253, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (484, 366, 251, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (485, 366, 249, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (486, 366, 256, 1, 15000, 3, 3, 15000);
INSERT INTO `OrderDetail` VALUES (487, 367, 253, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (488, 367, 249, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (489, 368, 257, 1, 15000, 3, 3, 15000);
INSERT INTO `OrderDetail` VALUES (490, 368, 259, 1, 22000, 3, 3, 22000);
INSERT INTO `OrderDetail` VALUES (491, 369, 253, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (492, 369, 249, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (493, 369, 269, 1, 15000, 3, 3, 15000);
INSERT INTO `OrderDetail` VALUES (494, 369, 274, 1, 22000, 3, 3, 22000);
INSERT INTO `OrderDetail` VALUES (495, 369, 260, 1, 20000, 3, 3, 20000);
INSERT INTO `OrderDetail` VALUES (496, 369, 259, 1, 22000, 3, 3, 22000);
INSERT INTO `OrderDetail` VALUES (497, 370, 253, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (498, 370, 251, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (499, 371, 249, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (500, 371, 253, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (501, 372, 251, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (502, 372, 249, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (503, 372, 250, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (504, 373, 249, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (505, 373, 251, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (506, 373, 253, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (507, 374, 277, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (508, 374, 271, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (509, 374, 269, 1, 15000, 3, 3, 15000);
INSERT INTO `OrderDetail` VALUES (510, 375, 277, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (511, 375, 271, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (512, 375, 269, 1, 15000, 3, 3, 15000);
INSERT INTO `OrderDetail` VALUES (513, 376, 277, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (514, 376, 271, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (515, 376, 269, 1, 15000, 3, 3, 15000);
INSERT INTO `OrderDetail` VALUES (516, 377, 250, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (517, 377, 251, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (518, 378, 251, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (519, 378, 271, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (520, 378, 273, 1, 22000, 3, 3, 22000);
INSERT INTO `OrderDetail` VALUES (521, 378, 269, 1, 15000, 3, 3, 15000);
INSERT INTO `OrderDetail` VALUES (522, 379, 249, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (523, 379, 251, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (524, 380, 249, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (525, 380, 251, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (526, 381, 251, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (527, 381, 249, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (528, 382, 249, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (529, 382, 251, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (530, 383, 250, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (531, 383, 251, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (532, 384, 249, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (533, 384, 253, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (534, 384, 269, 1, 15000, 3, 3, 15000);
INSERT INTO `OrderDetail` VALUES (535, 385, 249, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (536, 385, 253, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (537, 386, 250, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (538, 386, 251, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (539, 387, 278, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (540, 387, 271, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (541, 388, 253, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (542, 388, 249, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (543, 388, 278, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (544, 389, 251, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (545, 389, 249, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (546, 389, 253, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (547, 390, 249, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (548, 390, 251, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (549, 390, 250, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (550, 391, 250, 1, 25000, 3, 3, 25000);
INSERT INTO `OrderDetail` VALUES (551, 391, 251, 1, 25000, 3, 3, 25000);

-- ----------------------------
-- Table structure for Orders
-- ----------------------------
DROP TABLE IF EXISTS `Orders`;
CREATE TABLE `Orders`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` char(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `total_price` decimal(10, 0) NULL DEFAULT NULL,
  `shipping_id` int NULL DEFAULT NULL,
  `restaurant_id` int NULL DEFAULT NULL,
  `user_note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `bill_status` enum('Đang chờ xử lí','Đã nhận đơn','Hoàn thành đơn','Hủy đơn hàng') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `payment_status` enum('Đang chờ thanh toán','Đã thanh toán') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `order_payment` tinyint(1) NULL DEFAULT 0,
  `order_gift` tinyint(1) NULL DEFAULT 0,
  `order_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `order_phone` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `order_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `is_asap` tinyint(1) NULL DEFAULT 0,
  `scheduled_delivery_time` time NULL DEFAULT NULL,
  `daily_order_number` int NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `telegram_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `quantity` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `shipping_id`(`shipping_id` ASC) USING BTREE,
  INDEX `user_id`(`user_id` ASC) USING BTREE,
  INDEX `restaurant_id`(`restaurant_id` ASC) USING BTREE,
  INDEX `telegram_id`(`telegram_id` ASC) USING BTREE,
  CONSTRAINT `Orders_ibfk_1` FOREIGN KEY (`shipping_id`) REFERENCES `Shipping` (`shipping_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `Orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `Orders_ibfk_3` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`restaurant_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `Orders_ibfk_4` FOREIGN KEY (`telegram_id`) REFERENCES `Staff` (`telegram_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 392 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of Orders
-- ----------------------------
INSERT INTO `Orders` VALUES (292, 'b9f51ebd-6e60-4a15-95d0-73f796b3e187', 60000, 2, 1, NULL, 'Đã nhận đơn', 'Đang chờ thanh toán', 0, 0, 'Hoài Nam', '0964061319', '78 duy tân', 1, NULL, 1, '2024-02-24 16:49:56', '2024-02-24 16:55:17', '1692843965', 2);
INSERT INTO `Orders` VALUES (293, 'b9f51ebd-6e60-4a15-95d0-73f796b3e187', 60000, 2, 1, NULL, 'Đã nhận đơn', 'Đang chờ thanh toán', 0, 0, 'Hoài Nam', '0964061319', '78 duy tân', 1, NULL, 2, '2024-02-24 22:18:42', '2024-02-24 22:19:20', '1692843965', 2);
INSERT INTO `Orders` VALUES (294, 'b9f51ebd-6e60-4a15-95d0-73f796b3e187', 60000, 2, 1, NULL, 'Đã nhận đơn', 'Đang chờ thanh toán', 0, 0, 'Hoài Nam', '0964061319', '78 duy tân', 1, NULL, 3, '2024-02-24 23:01:00', '2024-02-24 23:25:20', '1692843965', 2);
INSERT INTO `Orders` VALUES (295, 'b9f51ebd-6e60-4a15-95d0-73f796b3e187', 60000, 2, 1, NULL, 'Hủy đơn hàng', 'Đang chờ thanh toán', 0, 0, 'Hoài Nam', '0964061319', '78 duy tân', 1, NULL, 4, '2024-02-24 23:01:43', '2024-02-24 23:11:48', NULL, 2);
INSERT INTO `Orders` VALUES (296, 'b9f51ebd-6e60-4a15-95d0-73f796b3e187', 60000, 2, 1, NULL, 'Đã nhận đơn', 'Đang chờ thanh toán', 0, 0, 'Hoài Nam', '0964061319', '78 duy tân', 2, '00:15:00', 5, '2024-02-24 23:37:55', '2024-02-24 23:38:15', '1692843965', 2);
INSERT INTO `Orders` VALUES (297, 'b9f51ebd-6e60-4a15-95d0-73f796b3e187', 275000, NULL, 3, NULL, 'Đã nhận đơn', 'Đang chờ thanh toán', 0, 0, 'Hoài Nam', '0964061319', '78 duy tân', 1, NULL, 1, '2024-02-24 23:40:42', '2024-02-24 23:41:02', '1692843965', 3);
INSERT INTO `Orders` VALUES (298, 'b9f51ebd-6e60-4a15-95d0-73f796b3e187', 60000, 2, 1, NULL, 'Hủy đơn hàng', 'Đang chờ thanh toán', 0, 0, 'Hoài Nam', '0964061319', '78 duy tân', 1, NULL, 6, '2024-02-24 23:51:07', '2024-02-25 00:01:07', NULL, 2);
INSERT INTO `Orders` VALUES (299, 'b9f51ebd-6e60-4a15-95d0-73f796b3e187', 60000, 2, 1, NULL, 'Hủy đơn hàng', 'Đang chờ thanh toán', 0, 0, 'Hoài Nam', '0964061319', '78 duy tân', 1, NULL, 1, '2024-02-25 00:08:28', '2024-02-25 00:18:30', NULL, 2);
INSERT INTO `Orders` VALUES (300, 'b9f51ebd-6e60-4a15-95d0-73f796b3e187', 60000, 2, 1, NULL, 'Hủy đơn hàng', 'Đang chờ thanh toán', 0, 0, 'Hoài Nam', '0964061319', '78 duy tân', 1, NULL, 2, '2024-02-25 00:09:07', '2024-02-25 00:10:24', '1692843965', 2);
INSERT INTO `Orders` VALUES (301, 'b9f51ebd-6e60-4a15-95d0-73f796b3e187', 60000, 2, 1, NULL, 'Đã nhận đơn', 'Đang chờ thanh toán', 0, 0, 'Hoài Nam', '0964061319', '78 duy tân', 1, NULL, 3, '2024-02-25 00:48:03', '2024-02-25 00:49:30', '1692843965', 2);
INSERT INTO `Orders` VALUES (302, 'b9f51ebd-6e60-4a15-95d0-73f796b3e187', 60000, 2, 1, NULL, 'Hủy đơn hàng', 'Đang chờ thanh toán', 0, 0, 'Hoài Nam', '0964061319', '78 duy tân', 1, NULL, 4, '2024-02-25 00:49:16', '2024-02-25 00:59:17', NULL, 2);
INSERT INTO `Orders` VALUES (303, 'b9f51ebd-6e60-4a15-95d0-73f796b3e187', 60000, 2, 1, NULL, 'Hủy đơn hàng', 'Đang chờ thanh toán', 0, 0, 'Hoài Nam', '0964061319', '78 duy tân', 1, NULL, 5, '2024-02-25 13:33:01', '2024-02-25 13:43:03', NULL, 2);
INSERT INTO `Orders` VALUES (304, 'b9f51ebd-6e60-4a15-95d0-73f796b3e187', 60000, 2, 1, NULL, 'Hủy đơn hàng', 'Đang chờ thanh toán', 1, 0, 'Hoài Nam', '0964061319', '78 duy tân', 1, NULL, 6, '2024-02-25 13:45:48', '2024-02-25 13:55:51', NULL, 2);
INSERT INTO `Orders` VALUES (305, 'b9f51ebd-6e60-4a15-95d0-73f796b3e187', 85000, 2, 1, NULL, 'Hủy đơn hàng', 'Đang chờ thanh toán', 0, 0, 'Hoài Nam', '0964061319', '78 duy tân', 2, '16:00:00', 7, '2024-02-25 13:46:08', '2024-02-25 13:56:09', NULL, 3);
INSERT INTO `Orders` VALUES (306, 'b9f51ebd-6e60-4a15-95d0-73f796b3e187', 60000, 2, 1, NULL, 'Đã nhận đơn', 'Đang chờ thanh toán', 0, 0, 'Hoài Nam', '0964061319', '78 duy tân', 2, '15:30:00', 8, '2024-02-25 13:46:28', '2024-02-25 13:51:07', '1692843965', 2);
INSERT INTO `Orders` VALUES (307, 'b9f51ebd-6e60-4a15-95d0-73f796b3e187', 60000, 2, 1, NULL, 'Hủy đơn hàng', 'Đang chờ thanh toán', 0, 0, 'Hoài Nam', '0964061319', '78 duy tân', 1, NULL, 9, '2024-02-25 13:47:47', '2024-02-25 13:57:48', NULL, 2);
INSERT INTO `Orders` VALUES (308, 'b9f51ebd-6e60-4a15-95d0-73f796b3e187', 60000, 2, 1, NULL, 'Hủy đơn hàng', 'Đang chờ thanh toán', 0, 0, 'Hoài Nam', '0964061319', '78 duy tân', 1, NULL, 1, '2024-02-26 14:53:04', '2024-02-26 15:03:06', NULL, 2);
INSERT INTO `Orders` VALUES (309, 'b9f51ebd-6e60-4a15-95d0-73f796b3e187', 60000, 2, 1, NULL, 'Hủy đơn hàng', 'Đang chờ thanh toán', 0, 0, 'Hoài Nam', '0964061319', '78 duy tân', 1, NULL, 2, '2024-02-26 22:06:09', '2024-02-26 22:16:11', NULL, 2);
INSERT INTO `Orders` VALUES (310, '10084b01-1375-4be8-8415-ac3d5ca9d8f0', 97000, 6, 2, 'Ngã tư Tân Dân (30 đường, 30 đá)', 'Hoàn thành đơn', 'Đang chờ thanh toán', 0, 0, 'Phương Anh', '0947484338', 'Tân Dân, An Lão, Hải Phòng, Việt Nam', 1, NULL, 1, '2024-03-02 16:29:31', '2024-03-02 16:39:31', NULL, 3);
INSERT INTO `Orders` VALUES (311, 'b9f51ebd-6e60-4a15-95d0-73f796b3e187', 60000, 2, 1, NULL, 'Hủy đơn hàng', 'Đang chờ thanh toán', 0, 0, 'Hoài Nam', '0964061319', '78 duy tân', 1, NULL, 1, '2024-03-02 20:43:20', '2024-03-02 20:53:21', NULL, 2);
INSERT INTO `Orders` VALUES (312, 'b9f51ebd-6e60-4a15-95d0-73f796b3e187', 60000, 2, 1, NULL, 'Đang chờ xử lí', 'Đang chờ thanh toán', 0, 0, 'Hoài Nam', '0964061319', '78 duy tân', 1, NULL, 1, '2024-05-10 21:14:25', '2024-05-10 21:14:25', NULL, 2);
INSERT INTO `Orders` VALUES (361, '5394bc7c-0f0e-4060-874f-203c109ce879', 89000, NULL, 1, NULL, 'Hủy đơn hàng', 'Đang chờ thanh toán', 0, 0, 'Nguyễn Hoàng Tâm', '0986229806', '25 Ngõ 211 Phố Khương Trung, Khuong Trung, Thanh Xuân, Hanoi, Vietnam', 1, NULL, 27, '2024-06-17 04:02:04', '2024-06-17 04:12:07', NULL, 4);
INSERT INTO `Orders` VALUES (362, '5394bc7c-0f0e-4060-874f-203c109ce879', 72000, NULL, 1, NULL, 'Hủy đơn hàng', 'Đang chờ thanh toán', 0, 0, 'Nguyễn Hoàng Tâm', '0986229806', '25 Ngõ 211 Phố Khương Trung, Khuong Trung, Thanh Xuân, Hanoi, Vietnam', 1, NULL, 28, '2024-06-17 04:10:50', '2024-06-17 04:20:54', NULL, 3);
INSERT INTO `Orders` VALUES (363, '5394bc7c-0f0e-4060-874f-203c109ce879', 50000, NULL, 1, NULL, 'Hủy đơn hàng', 'Đang chờ thanh toán', 0, 0, 'Nguyễn Hoàng Tâm', '0986229806', '25 Ngõ 211 Phố Khương Trung, Khuong Trung, Thanh Xuân, Hanoi, Vietnam', 1, NULL, 29, '2024-06-17 04:18:58', '2024-06-17 04:29:01', NULL, 2);
INSERT INTO `Orders` VALUES (364, '5394bc7c-0f0e-4060-874f-203c109ce879', 75000, NULL, 1, NULL, 'Hủy đơn hàng', 'Đang chờ thanh toán', 0, 0, 'Nguyễn Hoàng Tâm', '0986229806', '25 Ngõ 211 Phố Khương Trung, Khuong Trung, Thanh Xuân, Hanoi, Vietnam', 1, NULL, 30, '2024-06-17 04:22:33', '2024-06-17 04:32:36', NULL, 3);
INSERT INTO `Orders` VALUES (365, '5394bc7c-0f0e-4060-874f-203c109ce879', 100000, NULL, 1, NULL, 'Hủy đơn hàng', 'Đang chờ thanh toán', 0, 0, 'Nguyễn Hoàng Tâm', '0986229806', '25 Ngõ 211 Phố Khương Trung, Khuong Trung, Thanh Xuân, Hanoi, Vietnam', 1, NULL, 31, '2024-06-17 04:59:39', '2024-06-17 05:09:43', NULL, 4);
INSERT INTO `Orders` VALUES (366, '5394bc7c-0f0e-4060-874f-203c109ce879', 65000, NULL, 1, NULL, 'Hủy đơn hàng', 'Đang chờ thanh toán', 0, 0, 'Nguyễn Hoàng Tâm', '0986229806', '25 Ngõ 211 Phố Khương Trung, Khuong Trung, Thanh Xuân, Hanoi, Vietnam', 1, NULL, 32, '2024-06-17 05:08:22', '2024-06-17 05:18:26', NULL, 3);
INSERT INTO `Orders` VALUES (367, '5394bc7c-0f0e-4060-874f-203c109ce879', 50000, NULL, 1, NULL, 'Hủy đơn hàng', 'Đang chờ thanh toán', 0, 0, 'Nguyễn Hoàng Tâm', '0986229806', '25 Ngõ 211 Phố Khương Trung, Khuong Trung, Thanh Xuân, Hanoi, Vietnam', 1, NULL, 33, '2024-06-17 05:14:47', '2024-06-17 05:24:50', NULL, 2);
INSERT INTO `Orders` VALUES (368, '5394bc7c-0f0e-4060-874f-203c109ce879', 37000, NULL, 1, NULL, 'Hủy đơn hàng', 'Đang chờ thanh toán', 0, 0, 'Nguyễn Hoàng Tâm', '0986229806', '25 Ngõ 211 Phố Khương Trung, Khuong Trung, Thanh Xuân, Hanoi, Vietnam', 1, NULL, 34, '2024-06-17 05:40:24', '2024-06-17 05:50:27', NULL, 2);
INSERT INTO `Orders` VALUES (369, '5394bc7c-0f0e-4060-874f-203c109ce879', 129000, NULL, 1, NULL, 'Hủy đơn hàng', 'Đang chờ thanh toán', 0, 0, 'Nguyễn Hoàng Tâm', '0986229806', '25 Ngõ 211 Phố Khương Trung, Khuong Trung, Thanh Xuân, Hanoi, Vietnam', 1, NULL, 35, '2024-06-17 05:47:48', '2024-06-17 05:57:55', NULL, 6);
INSERT INTO `Orders` VALUES (370, '5394bc7c-0f0e-4060-874f-203c109ce879', 100000, 11, 1, NULL, 'Hủy đơn hàng', 'Đang chờ thanh toán', 0, 0, 'Nguyễn Hoàng Tâm', '0986229806', '25 Ngõ 211 Phố Khương Trung, Khuong Trung, Thanh Xuân, Hanoi, Vietnam', 1, NULL, 36, '2024-06-17 07:23:33', '2024-06-17 07:23:39', NULL, 2);
INSERT INTO `Orders` VALUES (371, '5394bc7c-0f0e-4060-874f-203c109ce879', 100000, 11, 1, NULL, 'Hủy đơn hàng', 'Đang chờ thanh toán', 0, 0, 'Nguyễn Hoàng Tâm', '0986229806', '25 Ngõ 211 Phố Khương Trung, Khuong Trung, Thanh Xuân, Hanoi, Vietnam', 1, NULL, 37, '2024-06-17 07:25:35', '2024-06-17 07:35:39', NULL, 2);
INSERT INTO `Orders` VALUES (372, '5394bc7c-0f0e-4060-874f-203c109ce879', 75000, NULL, 1, NULL, 'Hủy đơn hàng', 'Đã thanh toán', 1, 0, 'Nguyễn Hoàng Tâm', '0986229806', '25 Ngõ 211 Phố Khương Trung, Khuong Trung, Thanh Xuân, Hanoi, Vietnam', 1, NULL, 38, '2024-06-17 08:06:31', '2024-06-17 08:16:59', NULL, 3);
INSERT INTO `Orders` VALUES (373, '5394bc7c-0f0e-4060-874f-203c109ce879', 75000, NULL, 1, NULL, 'Hủy đơn hàng', 'Đã thanh toán', 1, 0, 'Nguyễn Hoàng Tâm', '0986229806', '25 Ngõ 211 Phố Khương Trung, Khuong Trung, Thanh Xuân, Hanoi, Vietnam', 1, NULL, 39, '2024-06-17 08:22:33', '2024-06-17 08:33:07', NULL, 3);
INSERT INTO `Orders` VALUES (374, '5394bc7c-0f0e-4060-874f-203c109ce879', 65000, NULL, 1, NULL, 'Đang chờ xử lí', 'Đang chờ thanh toán', 1, 0, 'Nguyễn Hoàng Tâm', '0986229806', '25 Ngõ 211 Phố Khương Trung, Khuong Trung, Thanh Xuân, Hanoi, Vietnam', 1, NULL, 1, '2024-06-19 23:41:34', '2024-06-19 23:41:36', NULL, 3);
INSERT INTO `Orders` VALUES (375, '5394bc7c-0f0e-4060-874f-203c109ce879', 65000, NULL, 1, NULL, 'Đang chờ xử lí', 'Đang chờ thanh toán', 1, 0, 'Nguyễn Hoàng Tâm', '0986229806', '25 Ngõ 211 Phố Khương Trung, Khuong Trung, Thanh Xuân, Hanoi, Vietnam', 2, '00:15:00', 2, '2024-06-19 23:43:38', '2024-06-19 23:43:40', NULL, 3);
INSERT INTO `Orders` VALUES (376, '5394bc7c-0f0e-4060-874f-203c109ce879', 65000, NULL, 1, NULL, 'Hủy đơn hàng', 'Đang chờ thanh toán', 0, 0, 'Nguyễn Hoàng Tâm', '0986229806', '25 Ngõ 211 Phố Khương Trung, Khuong Trung, Thanh Xuân, Hanoi, Vietnam', 2, '02:00:00', 3, '2024-06-19 23:45:02', '2024-06-19 23:55:06', NULL, 3);
INSERT INTO `Orders` VALUES (377, '5394bc7c-0f0e-4060-874f-203c109ce879', 50000, NULL, 1, NULL, 'Hủy đơn hàng', 'Đang chờ thanh toán', 0, 0, 'Nguyễn Hoàng Tâm', '0986229806', '25 Ngõ 211 Phố Khương Trung, Khuong Trung, Thanh Xuân, Hanoi, Vietnam', 1, NULL, 1, '2024-06-20 00:25:27', '2024-06-20 00:35:32', NULL, 2);
INSERT INTO `Orders` VALUES (378, '5394bc7c-0f0e-4060-874f-203c109ce879', 87000, NULL, 1, NULL, 'Hủy đơn hàng', 'Đang chờ thanh toán', 0, 0, 'Nguyễn Hoàng Tâm', '0986229806', '25 Ngõ 211 Phố Khương Trung, Khuong Trung, Thanh Xuân, Hanoi, Vietnam', 2, '20:45:00', 2, '2024-06-20 19:25:08', '2024-06-20 19:35:14', NULL, 4);
INSERT INTO `Orders` VALUES (379, '5394bc7c-0f0e-4060-874f-203c109ce879', 50000, NULL, 1, NULL, 'Hủy đơn hàng', 'Đang chờ thanh toán', 0, 0, 'Nguyễn Hoàng Tâm', '0986229806', '25 Ngõ 211 Phố Khương Trung, Khuong Trung, Thanh Xuân, Hanoi, Vietnam', 2, '20:30:00', 3, '2024-06-20 19:28:51', '2024-06-20 19:38:54', NULL, 2);
INSERT INTO `Orders` VALUES (380, '5394bc7c-0f0e-4060-874f-203c109ce879', 50000, NULL, 1, NULL, 'Hủy đơn hàng', 'Đang chờ thanh toán', 0, 0, 'Nguyễn Hoàng Tâm', '0986229806', '25 Ngõ 211 Phố Khương Trung, Khuong Trung, Thanh Xuân, Hanoi, Vietnam', 2, '21:30:00', 4, '2024-06-20 19:33:12', '2024-06-20 19:43:15', NULL, 2);
INSERT INTO `Orders` VALUES (381, '5394bc7c-0f0e-4060-874f-203c109ce879', 50000, NULL, 1, NULL, 'Hủy đơn hàng', 'Đang chờ thanh toán', 0, 0, 'Nguyễn Hoàng Tâm', '0986229806', '25 Ngõ 211 Phố Khương Trung, Khuong Trung, Thanh Xuân, Hanoi, Vietnam', 2, '21:15:00', 5, '2024-06-20 19:35:39', '2024-06-20 19:45:43', NULL, 2);
INSERT INTO `Orders` VALUES (382, '5394bc7c-0f0e-4060-874f-203c109ce879', 50000, NULL, 1, NULL, 'Hủy đơn hàng', 'Đang chờ thanh toán', 0, 0, 'Nguyễn Hoàng Tâm', '0986229806', '25 Ngõ 211 Phố Khương Trung, Khuong Trung, Thanh Xuân, Hanoi, Vietnam', 1, NULL, 6, '2024-06-20 19:39:23', '2024-06-20 19:49:27', NULL, 2);
INSERT INTO `Orders` VALUES (383, '5394bc7c-0f0e-4060-874f-203c109ce879', 50000, NULL, 1, NULL, 'Hủy đơn hàng', 'Đang chờ thanh toán', 0, 0, 'Nguyễn Hoàng Tâm', '0986229806', '25 Ngõ 211 Phố Khương Trung, Khuong Trung, Thanh Xuân, Hanoi, Vietnam', 1, NULL, 7, '2024-06-20 19:42:49', '2024-06-20 19:52:51', NULL, 2);
INSERT INTO `Orders` VALUES (384, '5394bc7c-0f0e-4060-874f-203c109ce879', 65000, NULL, 1, NULL, 'Hủy đơn hàng', 'Đang chờ thanh toán', 0, 0, 'Nguyễn Hoàng Tâm', '0986229806', '25 Ngõ 211 Phố Khương Trung, Khuong Trung, Thanh Xuân, Hanoi, Vietnam', 1, NULL, 8, '2024-06-20 19:48:24', '2024-06-20 19:58:27', NULL, 3);
INSERT INTO `Orders` VALUES (385, '5394bc7c-0f0e-4060-874f-203c109ce879', 50000, NULL, 1, NULL, 'Hủy đơn hàng', 'Đang chờ thanh toán', 0, 0, 'Nguyễn Hoàng Tâm', '0986229806', '25 Ngõ 211 Phố Khương Trung, Khuong Trung, Thanh Xuân, Hanoi, Vietnam', 1, NULL, 9, '2024-06-20 19:52:12', '2024-06-20 20:02:14', NULL, 2);
INSERT INTO `Orders` VALUES (386, '5394bc7c-0f0e-4060-874f-203c109ce879', 50000, NULL, 1, NULL, 'Hủy đơn hàng', 'Đang chờ thanh toán', 0, 0, 'Nguyễn Hoàng Tâm', '0986229806', '25 Ngõ 211 Phố Khương Trung, Khuong Trung, Thanh Xuân, Hanoi, Vietnam', 1, NULL, 10, '2024-06-20 19:54:53', '2024-06-20 20:04:57', NULL, 2);
INSERT INTO `Orders` VALUES (387, '5394bc7c-0f0e-4060-874f-203c109ce879', 50000, NULL, 1, NULL, 'Hủy đơn hàng', 'Đang chờ thanh toán', 0, 0, 'Nguyễn Hoàng Tâm', '0986229806', '25 Ngõ 211 Phố Khương Trung, Khuong Trung, Thanh Xuân, Hanoi, Vietnam', 1, NULL, 11, '2024-06-20 20:10:05', '2024-06-20 20:31:44', NULL, 2);
INSERT INTO `Orders` VALUES (388, '5394bc7c-0f0e-4060-874f-203c109ce879', 75000, NULL, 1, NULL, 'Hủy đơn hàng', 'Đang chờ thanh toán', 0, 0, 'Nguyễn Hoàng Tâm', '0986229806', '25 Ngõ 211 Phố Khương Trung, Khuong Trung, Thanh Xuân, Hanoi, Vietnam', 1, NULL, 12, '2024-06-20 20:11:51', '2024-06-20 20:31:45', NULL, 3);
INSERT INTO `Orders` VALUES (389, '5394bc7c-0f0e-4060-874f-203c109ce879', 75000, NULL, 1, NULL, 'Hủy đơn hàng', 'Đang chờ thanh toán', 0, 0, 'Nguyễn Hoàng Tâm', '0986229806', '25 Ngõ 211 Phố Khương Trung, Khuong Trung, Thanh Xuân, Hanoi, Vietnam', 1, NULL, 13, '2024-06-20 20:34:24', '2024-06-20 20:44:28', NULL, 3);
INSERT INTO `Orders` VALUES (390, '5394bc7c-0f0e-4060-874f-203c109ce879', 75000, NULL, 1, NULL, 'Hủy đơn hàng', 'Đã thanh toán', 1, 0, 'Nguyễn Hoàng Tâm', '0986229806', '25 Ngõ 211 Phố Khương Trung, Khuong Trung, Thanh Xuân, Hanoi, Vietnam', 2, '22:00:00', 14, '2024-06-20 20:35:35', '2024-06-20 20:46:53', NULL, 3);
INSERT INTO `Orders` VALUES (391, '5394bc7c-0f0e-4060-874f-203c109ce879', 50000, NULL, 1, NULL, 'Hủy đơn hàng', 'Đang chờ thanh toán', 0, 0, 'Nguyễn Hoàng Tâm', '0986229806', '25 Ngõ 211 Phố Khương Trung, Khuong Trung, Thanh Xuân, Hanoi, Vietnam', 1, NULL, 15, '2024-06-20 21:52:52', '2024-06-20 22:02:56', NULL, 2);

-- ----------------------------
-- Table structure for Role
-- ----------------------------
DROP TABLE IF EXISTS `Role`;
CREATE TABLE `Role`  (
  `role_id` int NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`role_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of Role
-- ----------------------------
INSERT INTO `Role` VALUES (1, 'Người dùng');
INSERT INTO `Role` VALUES (2, 'Cửa hàng');
INSERT INTO `Role` VALUES (3, 'Admin');

-- ----------------------------
-- Table structure for Shipping
-- ----------------------------
DROP TABLE IF EXISTS `Shipping`;
CREATE TABLE `Shipping`  (
  `shipping_id` int NOT NULL AUTO_INCREMENT,
  `min_distance` decimal(10, 0) NOT NULL,
  `max_distance` decimal(10, 0) NOT NULL,
  `shipping_fee` decimal(10, 0) NOT NULL,
  PRIMARY KEY (`shipping_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of Shipping
-- ----------------------------
INSERT INTO `Shipping` VALUES (1, 0, 1, 0);
INSERT INTO `Shipping` VALUES (2, 1, 2, 10000);
INSERT INTO `Shipping` VALUES (4, 2, 3, 15000);
INSERT INTO `Shipping` VALUES (5, 3, 4, 20000);
INSERT INTO `Shipping` VALUES (6, 4, 5, 25000);
INSERT INTO `Shipping` VALUES (7, 5, 6, 30000);
INSERT INTO `Shipping` VALUES (8, 6, 7, 35000);
INSERT INTO `Shipping` VALUES (9, 7, 8, 40000);
INSERT INTO `Shipping` VALUES (10, 8, 9, 45000);
INSERT INTO `Shipping` VALUES (11, 9, 10, 50000);

-- ----------------------------
-- Table structure for Staff
-- ----------------------------
DROP TABLE IF EXISTS `Staff`;
CREATE TABLE `Staff`  (
  `telegram_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `phone` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `restaurant_id` int NOT NULL,
  PRIMARY KEY (`telegram_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of Staff
-- ----------------------------
INSERT INTO `Staff` VALUES ('1692843965', 'Nguyễn Hoài Nam', '0964061319', 1);
INSERT INTO `Staff` VALUES ('1723292091', 'Lương Ngọc Tuấn', '0123456789', 1);
INSERT INTO `Staff` VALUES ('7467504095', 'Nguyễn Hoàng Tâm', '0986229806', 1);

-- ----------------------------
-- Table structure for User
-- ----------------------------
DROP TABLE IF EXISTS `User`;
CREATE TABLE `User`  (
  `user_id` char(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_gender` enum('male','female') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user_address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `user_phone` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `user_password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `role_id` int NULL DEFAULT NULL,
  `user_status` tinyint(1) NULL DEFAULT 1,
  `remember_token` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `otp_code` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE,
  INDEX `role_id`(`role_id` ASC) USING BTREE,
  CONSTRAINT `User_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `Role` (`role_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of User
-- ----------------------------
INSERT INTO `User` VALUES ('5394bc7c-0f0e-4060-874f-203c109ce879', 'Nguyễn Hoàng Tâm', 'male', '25 Ngõ 211 Phố Khương Trung, Khuong Trung, Thanh Xuân, Hanoi, Vietnam', 'tachibanakanade2003@gmail.com', 1, '0986229806', '$2y$12$gax6JpcsXZHlrH5Ve1ymBeIS2ZNukVnPxx2J0pfvIqi2o108nVdgS', 1, 1, 'HVt9BN6Vf8cpDJiDDE9a9zo2gHe1UA74RW3iUmTzIKbj96o5VSN9KjhrSKSm', '654877', '2024-06-17 03:18:33', '2024-06-20 21:54:11');
INSERT INTO `User` VALUES ('80a00e2d-402e-441e-bc9c-81e32ce5a54a', 'Huy Phước', 'female', 'an đồng', 'hoainam2002vn@gmail.com', 0, '0964061319', '$2y$12$bJ2DkmlOazJ8Hjn43dQXSOplDhSjQ9A2fRAcqVImS8Bup5SUWzZ.O', 1, 1, 'twdb1fthoFFnd2GSdo0IU6s3yy7TiShqAQFRlIJLApus9NHRrrTjwGx7RxgV', '174523', NULL, '2024-06-14 11:56:53');
INSERT INTO `User` VALUES ('819ab35e-c6e7-4f60-9998-40fc573b372e', 'Nguyễn Hoàng Tâm', 'male', '25 Ngõ 211 Phố Khương Trung, Khuong Trung, Thanh Xuân, Hanoi, Vietnam', 'nghtamm2003@gmail.com', 0, '0986229806', '$2y$12$017TsDMT3PufdcTI3YaeJuB1YacISnvmU3f.kBx2.2.IoVOmq8WB2', 1, 1, 'UfKo3p5XBFwDkYfGPJTJ3crsE1NgAcCVpqBfMuS32Fq3yKd5t0FReAGjXCW7', '154625', '2024-06-19 12:32:03', '2024-06-19 12:32:20');

-- ----------------------------
-- Table structure for admin_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_menu`;
CREATE TABLE `admin_menu`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int NOT NULL DEFAULT 0,
  `order` int NOT NULL DEFAULT 0,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `uri` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `permission` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_menu
-- ----------------------------
INSERT INTO `admin_menu` VALUES (1, 0, 1, 'Dashboard', 'fa-bar-chart', '/', NULL, NULL, NULL);
INSERT INTO `admin_menu` VALUES (2, 0, 2, 'Admin', 'fa-tasks', '', NULL, NULL, NULL);
INSERT INTO `admin_menu` VALUES (3, 2, 3, 'Users', 'fa-users', 'auth/users', NULL, NULL, NULL);
INSERT INTO `admin_menu` VALUES (4, 2, 4, 'Roles', 'fa-user', 'auth/roles', NULL, NULL, NULL);
INSERT INTO `admin_menu` VALUES (5, 2, 5, 'Permission', 'fa-ban', 'auth/permissions', NULL, NULL, NULL);
INSERT INTO `admin_menu` VALUES (6, 2, 6, 'Menu', 'fa-bars', 'auth/menu', NULL, NULL, NULL);
INSERT INTO `admin_menu` VALUES (7, 2, 7, 'Operation log', 'fa-history', 'auth/logs', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for admin_operation_log
-- ----------------------------
DROP TABLE IF EXISTS `admin_operation_log`;
CREATE TABLE `admin_operation_log`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `input` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `admin_operation_log_user_id_index`(`user_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_operation_log
-- ----------------------------
INSERT INTO `admin_operation_log` VALUES (1, 1, 'admin', 'GET', '127.0.0.1', '[]', '2024-06-17 15:57:39', '2024-06-17 15:57:39');
INSERT INTO `admin_operation_log` VALUES (2, 1, 'admin/auth/users', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2024-06-17 15:58:34', '2024-06-17 15:58:34');
INSERT INTO `admin_operation_log` VALUES (3, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2024-06-17 15:58:51', '2024-06-17 15:58:51');
INSERT INTO `admin_operation_log` VALUES (4, 1, 'admin/products', 'GET', '127.0.0.1', '[]', '2024-06-17 16:00:24', '2024-06-17 16:00:24');
INSERT INTO `admin_operation_log` VALUES (5, 1, 'admin/products', 'GET', '127.0.0.1', '{\"page\":\"2\",\"_pjax\":\"#pjax-container\"}', '2024-06-17 16:01:31', '2024-06-17 16:01:31');
INSERT INTO `admin_operation_log` VALUES (6, 1, 'admin', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2024-06-17 16:04:10', '2024-06-17 16:04:10');
INSERT INTO `admin_operation_log` VALUES (7, 1, 'admin', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2024-06-17 16:04:27', '2024-06-17 16:04:27');
INSERT INTO `admin_operation_log` VALUES (8, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2024-06-17 16:04:40', '2024-06-17 16:04:40');
INSERT INTO `admin_operation_log` VALUES (9, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2024-06-17 16:06:27', '2024-06-17 16:06:27');

-- ----------------------------
-- Table structure for admin_permissions
-- ----------------------------
DROP TABLE IF EXISTS `admin_permissions`;
CREATE TABLE `admin_permissions`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `http_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `http_path` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `admin_permissions_name_unique`(`name` ASC) USING BTREE,
  UNIQUE INDEX `admin_permissions_slug_unique`(`slug` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_permissions
-- ----------------------------
INSERT INTO `admin_permissions` VALUES (1, 'All permission', '*', '', '*', NULL, NULL);
INSERT INTO `admin_permissions` VALUES (2, 'Dashboard', 'dashboard', 'GET', '/', NULL, NULL);
INSERT INTO `admin_permissions` VALUES (3, 'Login', 'auth.login', '', '/auth/login\r\n/auth/logout', NULL, NULL);
INSERT INTO `admin_permissions` VALUES (4, 'User setting', 'auth.setting', 'GET,PUT', '/auth/setting', NULL, NULL);
INSERT INTO `admin_permissions` VALUES (5, 'Auth management', 'auth.management', '', '/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs', NULL, NULL);

-- ----------------------------
-- Table structure for admin_role_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_menu`;
CREATE TABLE `admin_role_menu`  (
  `role_id` int NOT NULL,
  `menu_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  INDEX `admin_role_menu_role_id_menu_id_index`(`role_id` ASC, `menu_id` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_role_menu
-- ----------------------------
INSERT INTO `admin_role_menu` VALUES (1, 2, NULL, NULL);

-- ----------------------------
-- Table structure for admin_role_permissions
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_permissions`;
CREATE TABLE `admin_role_permissions`  (
  `role_id` int NOT NULL,
  `permission_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  INDEX `admin_role_permissions_role_id_permission_id_index`(`role_id` ASC, `permission_id` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_role_permissions
-- ----------------------------
INSERT INTO `admin_role_permissions` VALUES (1, 1, NULL, NULL);

-- ----------------------------
-- Table structure for admin_role_users
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_users`;
CREATE TABLE `admin_role_users`  (
  `role_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  INDEX `admin_role_users_role_id_user_id_index`(`role_id` ASC, `user_id` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_role_users
-- ----------------------------
INSERT INTO `admin_role_users` VALUES (1, 1, NULL, NULL);

-- ----------------------------
-- Table structure for admin_roles
-- ----------------------------
DROP TABLE IF EXISTS `admin_roles`;
CREATE TABLE `admin_roles`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `admin_roles_name_unique`(`name` ASC) USING BTREE,
  UNIQUE INDEX `admin_roles_slug_unique`(`slug` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_roles
-- ----------------------------
INSERT INTO `admin_roles` VALUES (1, 'Administrator', 'administrator', '2024-06-17 15:54:18', '2024-06-17 15:54:18');

-- ----------------------------
-- Table structure for admin_user_permissions
-- ----------------------------
DROP TABLE IF EXISTS `admin_user_permissions`;
CREATE TABLE `admin_user_permissions`  (
  `user_id` int NOT NULL,
  `permission_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  INDEX `admin_user_permissions_user_id_permission_id_index`(`user_id` ASC, `permission_id` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_user_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for admin_users
-- ----------------------------
DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(190) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `admin_users_username_unique`(`username` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_users
-- ----------------------------
INSERT INTO `admin_users` VALUES (1, 'admin', '$2y$12$okHW24d1WZLim/ZlyJkik.Iv7TVc3t6k9RmpnU9oh7K4VEGEHpklW', 'Administrator', NULL, 'tPhNJOhwTYXh3vwnDiOENQEReZv6TAjqwXAHRuL9grOoKGBL1A7qD2HMvDv4', '2024-06-17 15:54:18', '2024-06-17 15:54:18');

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category`  (
  `category_id` int NOT NULL,
  `category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`category_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES (1, 'Dòng kem');
INSERT INTO `category` VALUES (2, 'Dòng Trà hoa quả');
INSERT INTO `category` VALUES (3, 'Dòng Trà Sữa');
INSERT INTO `category` VALUES (4, 'Dòng Cafe');

-- ----------------------------
-- Table structure for iceOption
-- ----------------------------
DROP TABLE IF EXISTS `iceOption`;
CREATE TABLE `iceOption`  (
  `ice_id` int NOT NULL,
  `ice_option` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`ice_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of iceOption
-- ----------------------------
INSERT INTO `iceOption` VALUES (1, 'Không đá');
INSERT INTO `iceOption` VALUES (2, 'Ít đá');
INSERT INTO `iceOption` VALUES (3, 'Bình thường');
INSERT INTO `iceOption` VALUES (4, 'Nhiều đá');

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED NULL DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `jobs_queue_index`(`queue` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 88 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jobs
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2016_01_04_173148_create_admin_tables', 1);
INSERT INTO `migrations` VALUES (3, '2024_06_17_070308_create_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 2);

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token` ASC) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type` ASC, `tokenable_id` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` int NOT NULL,
  `category_id` int NOT NULL,
  `product_status` tinyint(1) NULL DEFAULT 1,
  `restaurant_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`product_id`) USING BTREE,
  INDEX `fk_product_category`(`category_id` ASC) USING BTREE,
  INDEX `fk_product_restaurant`(`restaurant_id` ASC) USING BTREE,
  CONSTRAINT `fk_product_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_product_restaurant` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`restaurant_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 279 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (189, 'Kem Hộp Dâu Tây', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-supper-sundae-dau-tay-0-1680061286?w=640&type=o', 25000, 1, 1, 2);
INSERT INTO `products` VALUES (190, 'Kem Hộp Trân Châu', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-super-sundae-tran-chau-duong-den-0-1680061319?w=640&type=o', 25000, 1, 1, 2);
INSERT INTO `products` VALUES (191, 'Kem Hộp Xoài', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-super-sundae-xoai-0-1680061529?w=200&type=o', 25000, 1, 1, 2);
INSERT INTO `products` VALUES (192, 'Trà Kem Bốn Mùa', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-tra-kem-bon-mua-0-1680061473?w=640&type=o', 20000, 2, 1, 2);
INSERT INTO `products` VALUES (193, 'Kem Hộp Socola', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://mixuediemdien.com/wp-content/uploads/2023/07/Super-Sundae-Socola-768x768.jpg', 25000, 1, 1, 2);
INSERT INTO `products` VALUES (194, 'Kem Hộp Lô Hội', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-super-sundae-lo-hoi-0-1680061342?w=640&type=o', 25000, 1, 1, 2);
INSERT INTO `products` VALUES (195, 'Hồng Trà Kem', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://mixuediemdien.com/wp-content/uploads/2023/07/Hong-Tra-Kem.jpg', 25000, 2, 1, 2);
INSERT INTO `products` VALUES (196, 'Nước Chanh Tươi Lạnh', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-nuoc-chanh-tuoi-lanh-0-1680061889?w=640&type=o', 15000, 2, 1, 2);
INSERT INTO `products` VALUES (197, 'Hồng Trà Mật Ong', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-hong-tra-mat-ong-0-1680061872?w=640&type=o', 15000, 2, 1, 2);
INSERT INTO `products` VALUES (198, 'Trà Ô Long Bốn Mùa', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-tra-o-long-bon-mua-0-1680061847?w=640&type=o', 15000, 2, 1, 2);
INSERT INTO `products` VALUES (199, 'Trà Đào Bốn Mùa', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-tra-dao-bon-mua-0-1680061910?w=640&type=o', 22000, 2, 1, 2);
INSERT INTO `products` VALUES (200, 'Trà Đào Tứ Kỳ Xuân', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-tra-dao-tu-ky-xuan-0-1680061073?w=640&type=o', 20000, 2, 1, 2);
INSERT INTO `products` VALUES (201, 'Dương Chi Cam Lộ', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://res.cloudinary.com/dorayifqz/image/upload/v1708193253/Mixue/g4m5qazlxgnxh007eohp.png', 30000, 2, 1, 2);
INSERT INTO `products` VALUES (202, 'Trà Sữa Trân Châu Đường Đen', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-tran-chau-duong-den-da-xay-0-1680062054?w=640&type=o', 25000, 3, 1, 2);
INSERT INTO `products` VALUES (203, 'Trà Sữa Nướng', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-tra-sua-nuong-0-1680062144?w=640&type=o', 25000, 3, 1, 2);
INSERT INTO `products` VALUES (204, 'Sữa Kem Lắc Dâu Tây', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-sua-kem-lac-dau-tay-0-1680061995?w=640&type=o', 22000, 2, 1, 2);
INSERT INTO `products` VALUES (205, 'Trà Sữa Bá Vương', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-tra-sua-ba-vuong-0-1680062077?w=640&type=o', 30000, 3, 1, 2);
INSERT INTO `products` VALUES (206, 'Trà Sữa Thạch Dừa', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-tra-sua-thach-dua-0-1680062214?w=640&type=o', 25000, 3, 1, 2);
INSERT INTO `products` VALUES (207, 'Trà Đào Big Size', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-tra-dao-bigsize-0-1680061055?w=640&type=o', 22000, 2, 1, 2);
INSERT INTO `products` VALUES (208, 'Trà Sữa 3Q', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-tra-sua-3q-0-1680062196?w=640&type=o', 25000, 3, 1, 2);
INSERT INTO `products` VALUES (209, 'Hồng Trà Chanh', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-hong-tra-chanh-0-1680061767?w=640&type=o', 15000, 2, 1, 2);
INSERT INTO `products` VALUES (210, 'Trà Chanh Lô Hội', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-tra-chanh-lo-hoi-0-1680061801?w=640&type=o', 17000, 2, 1, 2);
INSERT INTO `products` VALUES (211, 'Sữa Kem Lắc Đào', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://media.be.com.vn/bizops/image/7ff23e23-5dab-11ee-b2af-3ea2e1c5510b/resized_thumbnail_w480_h480', 25000, 1, 1, 2);
INSERT INTO `products` VALUES (212, 'Trà Kem Mâm Xôi', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://d1sag4ddilekf6.cloudfront.net/compressed_webp/items/VNITE2023081306495401715/detail/menueditor_item_af18c18f32a745ac952dfa4c1f009004_1691909274254089200.webp', 25000, 2, 1, 2);
INSERT INTO `products` VALUES (213, 'Trà Mâm Xôi', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://d1sag4ddilekf6.cloudfront.net/compressed_webp/items/VNITE2023081306432029148/detail/menueditor_item_1712ffdd80d6472ca046b5dabdd23f06_1691908826431401664.webp', 22000, 2, 1, 2);
INSERT INTO `products` VALUES (214, 'Trà Ô Long Kiwi', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://d1sag4ddilekf6.cloudfront.net/compressed_webp/items/VNITE2023032910455620437/detail/menueditor_item_ffd35a76b38b41e6a32ea05e735a49f2_1680086746521466950.webp', 22000, 2, 1, 2);
INSERT INTO `products` VALUES (215, 'Sữa Kem Lắc Mâm Xôi', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://d1sag4ddilekf6.cloudfront.net/compressed_webp/items/VNITE2023081306472842015/detail/menueditor_item_1e7970b5ce174f52b9eca984f0ee3c55_1691909155795534012.webp', 25000, 2, 1, 2);
INSERT INTO `products` VALUES (216, 'Tuyết đỉnh kiwi', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://res.cloudinary.com/dorayifqz/image/upload/v1708192757/Mixue/blikgfoqcqzkdxk6cu7m.jpg', 25000, 2, 1, 2);
INSERT INTO `products` VALUES (217, 'Sữa thạch kiwi', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://res.cloudinary.com/dorayifqz/image/upload/v1708581858/Mixue/f0l8h92udj2rn69k4tdk.jpg', 25000, 1, 1, 2);
INSERT INTO `products` VALUES (218, 'Sữa thạch dâu tây', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://res.cloudinary.com/dorayifqz/image/upload/v1708581857/Mixue/gson9zehbdjxex54dnky.jpg', 25000, 2, 1, 2);
INSERT INTO `products` VALUES (219, 'Kem Hộp Dâu Tây', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-supper-sundae-dau-tay-0-1680061286?w=640&type=o', 25000, 1, 1, 3);
INSERT INTO `products` VALUES (220, 'Kem Hộp Trân Châu', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-super-sundae-tran-chau-duong-den-0-1680061319?w=640&type=o', 25000, 1, 1, 3);
INSERT INTO `products` VALUES (221, 'Kem Hộp Xoài', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-super-sundae-xoai-0-1680061529?w=200&type=o', 25000, 1, 1, 3);
INSERT INTO `products` VALUES (222, 'Trà Kem Bốn Mùa', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-tra-kem-bon-mua-0-1680061473?w=640&type=o', 20000, 2, 1, 3);
INSERT INTO `products` VALUES (223, 'Kem Hộp Socola', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://mixuediemdien.com/wp-content/uploads/2023/07/Super-Sundae-Socola-768x768.jpg', 25000, 1, 1, 3);
INSERT INTO `products` VALUES (224, 'Kem Hộp Lô Hội', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-super-sundae-lo-hoi-0-1680061342?w=640&type=o', 25000, 1, 1, 3);
INSERT INTO `products` VALUES (225, 'Hồng Trà Kem', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://mixuediemdien.com/wp-content/uploads/2023/07/Hong-Tra-Kem.jpg', 25000, 2, 1, 3);
INSERT INTO `products` VALUES (226, 'Nước Chanh Tươi Lạnh', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-nuoc-chanh-tuoi-lanh-0-1680061889?w=640&type=o', 15000, 2, 1, 3);
INSERT INTO `products` VALUES (227, 'Hồng Trà Mật Ong', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-hong-tra-mat-ong-0-1680061872?w=640&type=o', 15000, 2, 1, 3);
INSERT INTO `products` VALUES (228, 'Trà Ô Long Bốn Mùa', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-tra-o-long-bon-mua-0-1680061847?w=640&type=o', 15000, 2, 1, 3);
INSERT INTO `products` VALUES (229, 'Trà Đào Bốn Mùa', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-tra-dao-bon-mua-0-1680061910?w=640&type=o', 22000, 2, 1, 3);
INSERT INTO `products` VALUES (230, 'Trà Đào Tứ Kỳ Xuân', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-tra-dao-tu-ky-xuan-0-1680061073?w=640&type=o', 20000, 2, 1, 3);
INSERT INTO `products` VALUES (231, 'Dương Chi Cam Lộ', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://res.cloudinary.com/dorayifqz/image/upload/v1708193253/Mixue/g4m5qazlxgnxh007eohp.png', 30000, 2, 1, 3);
INSERT INTO `products` VALUES (232, 'Trà Sữa Trân Châu Đường Đen', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-tran-chau-duong-den-da-xay-0-1680062054?w=640&type=o', 25000, 3, 1, 3);
INSERT INTO `products` VALUES (233, 'Trà Sữa Nướng', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-tra-sua-nuong-0-1680062144?w=640&type=o', 25000, 3, 1, 3);
INSERT INTO `products` VALUES (234, 'Sữa Kem Lắc Dâu Tây', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-sua-kem-lac-dau-tay-0-1680061995?w=640&type=o', 22000, 2, 1, 3);
INSERT INTO `products` VALUES (235, 'Trà Sữa Bá Vương', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-tra-sua-ba-vuong-0-1680062077?w=640&type=o', 30000, 3, 1, 3);
INSERT INTO `products` VALUES (236, 'Trà Sữa Thạch Dừa', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-tra-sua-thach-dua-0-1680062214?w=640&type=o', 25000, 3, 1, 3);
INSERT INTO `products` VALUES (237, 'Trà Đào Big Size', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-tra-dao-bigsize-0-1680061055?w=640&type=o', 22000, 2, 1, 3);
INSERT INTO `products` VALUES (238, 'Trà Sữa 3Q', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-tra-sua-3q-0-1680062196?w=640&type=o', 25000, 3, 1, 3);
INSERT INTO `products` VALUES (239, 'Hồng Trà Chanh', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-hong-tra-chanh-0-1680061767?w=640&type=o', 15000, 2, 1, 3);
INSERT INTO `products` VALUES (240, 'Trà Chanh Lô Hội', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-tra-chanh-lo-hoi-0-1680061801?w=640&type=o', 17000, 2, 1, 3);
INSERT INTO `products` VALUES (241, 'Sữa Kem Lắc Đào', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://media.be.com.vn/bizops/image/7ff23e23-5dab-11ee-b2af-3ea2e1c5510b/resized_thumbnail_w480_h480', 25000, 1, 1, 3);
INSERT INTO `products` VALUES (242, 'Trà Kem Mâm Xôi', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://d1sag4ddilekf6.cloudfront.net/compressed_webp/items/VNITE2023081306495401715/detail/menueditor_item_af18c18f32a745ac952dfa4c1f009004_1691909274254089200.webp', 25000, 2, 1, 3);
INSERT INTO `products` VALUES (243, 'Trà Mâm Xôi', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://d1sag4ddilekf6.cloudfront.net/compressed_webp/items/VNITE2023081306432029148/detail/menueditor_item_1712ffdd80d6472ca046b5dabdd23f06_1691908826431401664.webp', 22000, 2, 1, 3);
INSERT INTO `products` VALUES (244, 'Trà Ô Long Kiwi', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://d1sag4ddilekf6.cloudfront.net/compressed_webp/items/VNITE2023032910455620437/detail/menueditor_item_ffd35a76b38b41e6a32ea05e735a49f2_1680086746521466950.webp', 22000, 2, 1, 3);
INSERT INTO `products` VALUES (245, 'Sữa Kem Lắc Mâm Xôi', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://d1sag4ddilekf6.cloudfront.net/compressed_webp/items/VNITE2023081306472842015/detail/menueditor_item_1e7970b5ce174f52b9eca984f0ee3c55_1691909155795534012.webp', 25000, 2, 1, 3);
INSERT INTO `products` VALUES (246, 'Tuyết đỉnh kiwi', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://res.cloudinary.com/dorayifqz/image/upload/v1708192757/Mixue/blikgfoqcqzkdxk6cu7m.jpg', 25000, 2, 1, 3);
INSERT INTO `products` VALUES (247, 'Sữa thạch kiwi', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://res.cloudinary.com/dorayifqz/image/upload/v1708581858/Mixue/f0l8h92udj2rn69k4tdk.jpg', 25000, 1, 1, 3);
INSERT INTO `products` VALUES (248, 'Sữa thạch dâu tây', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://res.cloudinary.com/dorayifqz/image/upload/v1708581857/Mixue/gson9zehbdjxex54dnky.jpg', 25000, 2, 1, 3);
INSERT INTO `products` VALUES (249, 'Kem Hộp Dâu Tây', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-supper-sundae-dau-tay-0-1680061286?w=640&type=o', 25000, 1, 1, 1);
INSERT INTO `products` VALUES (250, 'Kem Hộp Trân Châu', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-super-sundae-tran-chau-duong-den-0-1680061319?w=640&type=o', 25000, 1, 1, 1);
INSERT INTO `products` VALUES (251, 'Kem Hộp Xoài', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-super-sundae-xoai-0-1680061529?w=200&type=o', 25000, 1, 1, 1);
INSERT INTO `products` VALUES (252, 'Trà Kem Bốn Mùa', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-tra-kem-bon-mua-0-1680061473?w=640&type=o', 20000, 2, 1, 1);
INSERT INTO `products` VALUES (253, 'Kem Hộp Socola', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://mixuediemdien.com/wp-content/uploads/2023/07/Super-Sundae-Socola-768x768.jpg', 25000, 1, 1, 1);
INSERT INTO `products` VALUES (254, 'Kem Hộp Lô Hội', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-super-sundae-lo-hoi-0-1680061342?w=640&type=o', 25000, 1, 1, 1);
INSERT INTO `products` VALUES (255, 'Hồng Trà Kem', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://mixuediemdien.com/wp-content/uploads/2023/07/Hong-Tra-Kem.jpg', 25000, 2, 1, 1);
INSERT INTO `products` VALUES (256, 'Nước Chanh Tươi Lạnh', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-nuoc-chanh-tuoi-lanh-0-1680061889?w=640&type=o', 15000, 2, 1, 1);
INSERT INTO `products` VALUES (257, 'Hồng Trà Mật Ong', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-hong-tra-mat-ong-0-1680061872?w=640&type=o', 15000, 2, 1, 1);
INSERT INTO `products` VALUES (258, 'Trà Ô Long Bốn Mùa', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-tra-o-long-bon-mua-0-1680061847?w=640&type=o', 15000, 2, 1, 1);
INSERT INTO `products` VALUES (259, 'Trà Đào Bốn Mùa', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-tra-dao-bon-mua-0-1680061910?w=640&type=o', 22000, 2, 1, 1);
INSERT INTO `products` VALUES (260, 'Trà Đào Tứ Kỳ Xuân', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-tra-dao-tu-ky-xuan-0-1680061073?w=640&type=o', 20000, 2, 1, 1);
INSERT INTO `products` VALUES (261, 'Dương Chi Cam Lộ', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://res.cloudinary.com/dorayifqz/image/upload/v1708193253/Mixue/g4m5qazlxgnxh007eohp.png', 30000, 2, 1, 1);
INSERT INTO `products` VALUES (262, 'Trà Sữa Trân Châu Đường Đen', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-tran-chau-duong-den-da-xay-0-1680062054?w=640&type=o', 25000, 3, 1, 1);
INSERT INTO `products` VALUES (263, 'Trà Sữa Nướng', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-tra-sua-nuong-0-1680062144?w=640&type=o', 25000, 3, 1, 1);
INSERT INTO `products` VALUES (264, 'Sữa Kem Lắc Dâu Tây', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-sua-kem-lac-dau-tay-0-1680061995?w=640&type=o', 22000, 2, 1, 1);
INSERT INTO `products` VALUES (265, 'Trà Sữa Bá Vương', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-tra-sua-ba-vuong-0-1680062077?w=640&type=o', 30000, 3, 1, 1);
INSERT INTO `products` VALUES (266, 'Trà Sữa Thạch Dừa', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-tra-sua-thach-dua-0-1680062214?w=640&type=o', 25000, 3, 1, 1);
INSERT INTO `products` VALUES (267, 'Trà Đào Big Size', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-tra-dao-bigsize-0-1680061055?w=640&type=o', 22000, 2, 1, 1);
INSERT INTO `products` VALUES (268, 'Trà Sữa 3Q', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-tra-sua-3q-0-1680062196?w=640&type=o', 25000, 3, 1, 1);
INSERT INTO `products` VALUES (269, 'Hồng Trà Chanh', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-hong-tra-chanh-0-1680061767?w=640&type=o', 15000, 2, 1, 1);
INSERT INTO `products` VALUES (270, 'Trà Chanh Lô Hội', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://tea-3.lozi.vn/v1/ship/resized/test-huongg-lam-dong-1637048248725161849-tra-chanh-lo-hoi-0-1680061801?w=640&type=o', 17000, 2, 1, 1);
INSERT INTO `products` VALUES (271, 'Sữa Kem Lắc Đào', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://media.be.com.vn/bizops/image/7ff23e23-5dab-11ee-b2af-3ea2e1c5510b/resized_thumbnail_w480_h480', 25000, 1, 1, 1);
INSERT INTO `products` VALUES (272, 'Trà Kem Mâm Xôi', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://d1sag4ddilekf6.cloudfront.net/compressed_webp/items/VNITE2023081306495401715/detail/menueditor_item_af18c18f32a745ac952dfa4c1f009004_1691909274254089200.webp', 25000, 2, 1, 1);
INSERT INTO `products` VALUES (273, 'Trà Mâm Xôi', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://d1sag4ddilekf6.cloudfront.net/compressed_webp/items/VNITE2023081306432029148/detail/menueditor_item_1712ffdd80d6472ca046b5dabdd23f06_1691908826431401664.webp', 22000, 2, 1, 1);
INSERT INTO `products` VALUES (274, 'Trà Ô Long Kiwi', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://d1sag4ddilekf6.cloudfront.net/compressed_webp/items/VNITE2023032910455620437/detail/menueditor_item_ffd35a76b38b41e6a32ea05e735a49f2_1680086746521466950.webp', 22000, 2, 1, 1);
INSERT INTO `products` VALUES (275, 'Sữa Kem Lắc Mâm Xôi', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://d1sag4ddilekf6.cloudfront.net/compressed_webp/items/VNITE2023081306472842015/detail/menueditor_item_1e7970b5ce174f52b9eca984f0ee3c55_1691909155795534012.webp', 25000, 2, 1, 1);
INSERT INTO `products` VALUES (276, 'Tuyết đỉnh kiwi', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://res.cloudinary.com/dorayifqz/image/upload/v1708192757/Mixue/blikgfoqcqzkdxk6cu7m.jpg', 25000, 2, 1, 1);
INSERT INTO `products` VALUES (277, 'Sữa thạch kiwi', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://res.cloudinary.com/dorayifqz/image/upload/v1708581858/Mixue/f0l8h92udj2rn69k4tdk.jpg', 25000, 1, 1, 1);
INSERT INTO `products` VALUES (278, 'Sữa thạch dâu tây', 'Mát lạnh mùa hè cùng hương  vị kem mixue, đồ uống ngon', 'https://res.cloudinary.com/dorayifqz/image/upload/v1708581857/Mixue/gson9zehbdjxex54dnky.jpg', 25000, 2, 1, 1);

-- ----------------------------
-- Table structure for restaurant
-- ----------------------------
DROP TABLE IF EXISTS `restaurant`;
CREATE TABLE `restaurant`  (
  `restaurant_id` int NOT NULL AUTO_INCREMENT,
  `restaurant_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `restaurant_location` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `restaurant_openTime` time NOT NULL,
  `restaurant_closeTime` time NOT NULL,
  `restaurant_openStatus` tinyint(1) NULL DEFAULT 1,
  `user_id` char(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `restaurant_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tgroup_id` bigint NULL DEFAULT NULL,
  PRIMARY KEY (`restaurant_id`) USING BTREE,
  INDEX `fk_user_id`(`user_id` ASC) USING BTREE,
  CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of restaurant
-- ----------------------------
INSERT INTO `restaurant` VALUES (1, 'Mixue Quán Toan Hải Phòng', 'Bến xe mỹ đình', '00:00:00', '23:55:00', 1, 'b9f51ebd-6e60-4a15-95d0-73f796b3e187', 'https://tea-3.lozi.vn/v1/images/resized/mixue-58-nguyen-gia-tri-quan-binh-thanh-ho-chi-minh-1681098482931423962-eatery-avatar-1681098483?w=200&type=f', -4247893055);
INSERT INTO `restaurant` VALUES (2, 'Mixue An Lão Hải Phòng', 'Mixue An Lão Hải Phòng, Nguyễn Văn Trỗi, An Luận, Thị Trấn An Lão, An Lão, Hải Phòng', '09:00:00', '22:00:00', 1, 'b9f51ebd-6e60-4a15-95d0-73f796b3e187', 'https://tea-3.lozi.vn/v1/images/resized/mixue-58-nguyen-gia-tri-quan-binh-thanh-ho-chi-minh-1681098482931423962-eatery-avatar-1681098483?w=200&type=f', -1002015026173);
INSERT INTO `restaurant` VALUES (3, 'Mixue Vĩnh Bảo Hải Phòng', 'Mixue Vĩnh Bảo Hải Phòng', '00:00:00', '23:50:00', 0, 'b9f51ebd-6e60-4a15-95d0-73f796b3e187', 'https://tea-3.lozi.vn/v1/images/resized/mixue-58-nguyen-gia-tri-quan-binh-thanh-ho-chi-minh-1681098482931423962-eatery-avatar-1681098483?w=200&type=f', -4162581469);

-- ----------------------------
-- Table structure for sugarOption
-- ----------------------------
DROP TABLE IF EXISTS `sugarOption`;
CREATE TABLE `sugarOption`  (
  `sugar_id` int NOT NULL,
  `sugar_option` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`sugar_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of sugarOption
-- ----------------------------
INSERT INTO `sugarOption` VALUES (2, 'Giảm ngọt');
INSERT INTO `sugarOption` VALUES (3, 'Bình thường');
INSERT INTO `sugarOption` VALUES (4, 'Ngọt');

SET FOREIGN_KEY_CHECKS = 1;
