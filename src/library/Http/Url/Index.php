<?php

declare(strict_types=1);

namespace App\Php94\Link\Http\Url;

use App\Php94\Admin\Http\Common;
use PHP94\Db;
use PHP94\Template;
use PHP94\Request;

class Index extends Common
{
    public function get()
    {
        $data = [];
        $where = [];
        $data['total'] = Db::count('php94_link_url', $where);

        $data['page'] = Request::get('page', 1) ?: 1;
        $data['size'] = Request::get('size', 20) ?: 20;
        $data['pages'] = ceil($data['total'] / $data['size']) ?: 1;
        $where['LIMIT'] = [($data['page'] - 1) * $data['size'], $data['size']];
        $where['ORDER'] = [
            'id' => 'DESC',
        ];
        $data['datas'] = Db::select('php94_link_url', '*', $where);

        return Template::render('url/index@php94/link', $data);
    }
}
