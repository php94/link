<?php

use App\Php94\Link\Http\Url\Index as UrlIndex;
use App\Php94\Admin\Model\Menu;

return [
    Menu::class => function (
        Menu $menu
    ) {
        $menu->addMenu('链接管理', UrlIndex::class);
    },
];
