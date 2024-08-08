<?php

use PHP94\Package;

return [
    'install' => function () {
        $sql = <<<'str'
DROP TABLE IF EXISTS `prefix_php94_link_log`;
CREATE TABLE `prefix_php94_link_log` (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `url_id` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '链接id',
    `year` SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0',
    `month` TINYINT(3) UNSIGNED NOT NULL DEFAULT '0',
    `day` TINYINT(3) UNSIGNED NOT NULL DEFAULT '0',
    `time` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '时间',
    `url` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '跳转地址' COLLATE 'utf8mb4_general_ci',
    `remote_addr` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'remote_addr' COLLATE 'utf8mb4_general_ci',
    `http_user_agent` TEXT(65535) NOT NULL COMMENT 'http_user_agent' COLLATE 'utf8mb4_general_ci',
    `http_referer` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'http_referer' COLLATE 'utf8mb4_general_ci',
    PRIMARY KEY (`id`) USING BTREE
) COMMENT = '跳转日志' COLLATE = 'utf8mb4_general_ci' ENGINE = InnoDB ROW_FORMAT = DYNAMIC AUTO_INCREMENT = 1;
DROP TABLE IF EXISTS `prefix_php94_link_url`;
CREATE TABLE `prefix_php94_link_url` (
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `key` char(8) NOT NULL DEFAULT '' COMMENT '链接key' COLLATE 'utf8mb4_general_ci',
    `url` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '跳转地址' COLLATE 'utf8mb4_general_ci',
    `tips` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '备注' COLLATE 'utf8mb4_general_ci',
    PRIMARY KEY (`id`) USING BTREE
) COMMENT = '链接地址' COLLATE = 'utf8mb4_general_ci' ENGINE = InnoDB ROW_FORMAT = DYNAMIC AUTO_INCREMENT = 1;
str;
        Package::execSql($sql);
    },
    'unInstall' => function () {
        $sql = <<<'str'
DROP TABLE IF EXISTS `prefix_php94_link_log`;
DROP TABLE IF EXISTS `prefix_php94_link_url`;
str;
        Package::execSql($sql);
    },
];
