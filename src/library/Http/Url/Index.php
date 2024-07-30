<?php

declare(strict_types=1);

namespace App\Php94\Link\Http\Url;

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
        $data['total'] = Db::count('php94_link_url', $where);

        $data['page'] = Request::get('page', 1) ?: 1;
        $data['size'] = Request::get('size', 20) ?: 20;
        $data['pages'] = ceil($data['total'] / $data['size']) ?: 1;
        $where['LIMIT'] = [($data['page'] - 1) * $data['size'], $data['size']];
        $where['ORDER'] = [
            'id' => 'DESC',
        ];
        $urls = Db::select('php94_link_url', '*', $where);

        foreach ($urls as &$value) {
            $value['click_total'] = Db::count('php94_link_log', [
                'url_id' => $value['id'],
            ]);
            $value['click_today'] = Db::count('php94_link_log', [
                'url_id' => $value['id'],
                'year' => date('Y'),
                'month' => date('m'),
                'day' => date('d'),
            ]);
            $value['click_yesterday'] = Db::count('php94_link_log', [
                'url_id' => $value['id'],
                'year' => date('Y', time() - 86400),
                'month' => date('m', time() - 86400),
                'day' => date('d', time() - 86400),
            ]);
            $value['click_before_yesterday'] = Db::count('php94_link_log', [
                'url_id' => $value['id'],
                'year' => date('Y', time() - 86400 * 2),
                'month' => date('m', time() - 86400 * 2),
                'day' => date('d', time() - 86400 * 2),
            ]);
        }
        $data['datas'] = $urls;

        return Template::render('url/index@php94/link', $data);
    }
}
