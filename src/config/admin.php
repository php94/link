<?php

use App\Php94\Link\Http\Log\Index as LogIndex;
use App\Php94\Link\Http\Url\Index;

return [
    'menus' => [[
        'title' => '链接管理',
        'node' => Index::class,
    ], [
        'title' => '跳转记录',
        'node' => LogIndex::class,
    ]],
    'widgets' => [],
];
