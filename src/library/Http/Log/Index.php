<?php

declare(strict_types=1);

namespace App\Php94\Link\Http\Log;

use App\Php94\Admin\Http\Common;
use PHP94\Facade\Db;
use PHP94\Facade\Template;
use PHP94\Help\Request;

class Index extends Common
{
    public function get()
    {
        $data = [];
        $where = [];
        $where['ORDER'] = [
            'id' => 'DESC',
        ];

        if ($url_id = Request::get('url_id')) {
            $where['url_id'] = $url_id;
        }
        if ($remote_addr = Request::get('remote_addr')) {
            $where['remote_addr'] = $remote_addr;
        }

        $data['total'] = Db::count('php94_link_log', $where);

        $data['page'] = Request::get('page', 1) ?: 1;
        $data['size'] = Request::get('size', 20) ?: 20;
        $data['pages'] = ceil($data['total'] / $data['size']) ?: 1;
        $where['LIMIT'] = [($data['page'] - 1) * $data['size'], $data['size']];

        $logs = Db::select('php94_link_log', '*', $where);

        foreach ($logs as &$value) {
            $value['urlx'] = Db::get('php94_link_url', '*', [
                'id' => $value['url_id']
            ]);
        }
        $data['datas'] = $logs;

        return Template::render('log/index@php94/link', $data);
    }
}
