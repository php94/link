<?php

declare(strict_types=1);

namespace App\Php94\Link\Http\Url;

use App\Php94\Admin\Http\Common;
use PHP94\Db;
use PHP94\Request;
use PHP94\Response;

class Delete extends Common
{
    public function get()
    {
        Db::delete('php94_link_url', [
            'id' => Request::get('id'),
        ]);
        Db::delete('php94_link_log', [
            'url_id' => Request::get('id'),
        ]);
        return Response::success('操作成功！');
    }
}
