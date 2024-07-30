<?php

declare(strict_types=1);

namespace App\Php94\Link\Http\Url;

use App\Php94\Admin\Http\Common;
use PHP94\Facade\Db;
use PHP94\Form\Field\Text;
use PHP94\Form\Form;
use PHP94\Help\Request;
use PHP94\Help\Response;

class Create extends Common
{
    public function get()
    {
        $form = new Form('添加链接');
        $form->addItem(
            new Text('链接ID', 'key', $this->getRandStr(8)),
            new Text('链接地址', 'url'),
            new Text('备注', 'tips'),
        );
        return $form;
    }

    public function post()
    {
        Db::insert('php94_link_url', [
            'key' => Request::post('key'),
            'url' => Request::post('url'),
            'tips' => Request::post('tips'),
        ]);
        return Response::success('操作成功！');
    }

    private function getRandStr($length)
    {
        $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $len = strlen($str) - 1;
        $randstr = '';
        for ($i = 0; $i < $length; $i++) {
            $num = mt_rand(0, $len);
            $randstr .= $str[$num];
        }
        return $randstr;
    }
}
