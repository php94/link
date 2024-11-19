<?php

use PHP94\Package;

$sql = <<<'str'
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
