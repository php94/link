{include common/header@php94/admin}
<div class="my-4">
    <div class="h1">链接管理</div>
</div>
<div>
    <a class="btn btn-primary" href="{echo $router->build('/php94/link/url/create')}">添加链接</a>
</div>
<div class="my-4">
    <form id="form_filter" class="row gy-2 gx-3 align-items-center" action="{echo $router->build('/php94/link/url/index')}" method="GET">
        <input type="hidden" name="page" value="1">
        <div class="col-auto">
            <label class="visually-hidden">搜索</label>
            <input type="search" class="form-control" name="q" value="{:$request->get('q')}" placeholder="请输入搜索词" onchange="document.getElementById('form_filter').submit();">
        </div>
    </form>
</div>
<div class="table-responsive my-4">
    <table class="table table-bordered d-table-cell">
        <thead>
            <tr>
                <th class="text-nowrap">KEY</th>
                <th scope="col">今日点击</th>
                <th scope="col">昨日点击</th>
                <th scope="col">前日点击</th>
                <th scope="col">总点击</th>
                <th class="text-nowrap">管理</th>
            </tr>
        </thead>
        <tbody>
            {foreach $datas as $vo}
            <tr>
                <td>
                    <a href="{echo $router->build('/php94/link/jump', ['key'=>$vo['key']])}" target="_blank">{$vo.key}</a>
                </td>
                <td>{$vo.click_today}</td>
                <td>{$vo.click_yesterday}</td>
                <td>{$vo.click_before_yesterday}</td>
                <td>{$vo.click_total}</td>
                <td>
                    <a href="{echo $router->build('/php94/link/url/update', ['id'=>$vo['id']])}">编辑</a>
                    <a href="{echo $router->build('/php94/link/log/index', ['url_id'=>$vo['id']])}">跳转记录</a>
                    <a href="{echo $router->build('/php94/link/url/delete', ['id'=>$vo['id']])}" onclick="return confirm('确定删除吗？删除后不可恢复！');">删除</a>
                </td>
            </tr>
            {/foreach}
        </tbody>
    </table>
</div>
<div class="d-flex align-items-center flex-wrap gap-1 my-3">
    <a class="btn btn-primary {$page>1?'':'disabled'}" href="{echo $router->build('/php94/link/url/index', array_merge($_GET, ['page'=>1]))}">首页</a>
    <a class="btn btn-primary {$page>1?'':'disabled'}" href="{echo $router->build('/php94/link/url/index', array_merge($_GET, ['page'=>max($page-1, 1)]))}">上一页</a>
    <div class="d-flex align-items-center gap-1">
        <input class="form-control" type="number" name="page" min="1" max="{$pages}" value="{$page}" onchange="location.href=this.dataset.url.replace('__PAGE__', this.value)" data-url="{echo $router->build('/php94/link/url/index', array_merge($_GET, ['page'=>'__PAGE__']))}">
        <span>/{$pages}</span>
    </div>
    <a class="btn btn-primary {$page<$pages?'':'disabled'}" href="{echo $router->build('/php94/link/url/index', array_merge($_GET, ['page'=>min($page+1, $pages)]))}">下一页</a>
    <a class="btn btn-primary {$page<$pages?'':'disabled'}" href="{echo $router->build('/php94/link/url/index', array_merge($_GET, ['page'=>$pages]))}">末页</a>
    <div>共{$total}条</div>
</div>
{include common/footer@php94/admin}