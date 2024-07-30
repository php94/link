<?php

declare(strict_types=1);

namespace App\Php94\Link\Http\Url;

use App\Php94\Admin\Http\Common;
use PHP94\Facade\Db;
use PHP94\Form\Field\Hidden;
use PHP94\Form\Field\Text;
use PHP94\Form\Form;
use PHP94\Help\Request;
use PHP94\Help\Response;

class Update extends Common
{
    public function get()
    {
        $url = Db::get('php94_link_url', '*', [
            'id' => Request::get('id'),
        ]);
        $form = new Form('编辑链接');
        $form->addItem(
            new Hidden('id', $url['id']),
            (new Text('链接KEY', 'key', $url['key']))->setReadonly(true),
            new Text('链接地址', 'url', $url['url']),
            new Text('备注', 'tips', $url['tips'])
        );
        return $form;
    }

    public function post()
    {
        $url = Db::get('php94_link_url', '*', [
            'id' => Request::post('id'),
        ]);

        $update = array_intersect_key(Request::post(), [
            'url' => '',
            'tips' => '',
        ]);

        Db::update('php94_link_url', $update, [
            'id' => $url['id'],
        ]);

        return Response::success('操作成功！');
    }
}
