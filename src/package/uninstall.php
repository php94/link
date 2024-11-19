<?php

use PHP94\Package;

$sql = <<<'str'
DROP TABLE IF EXISTS `prefix_php94_link_url`;
str;

Package::execSql($sql);
