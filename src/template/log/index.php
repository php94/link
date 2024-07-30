{include common/header@php94/admin}
<div class="my-4">
    <div class="h1">跳转记录</div>
</div>
<div class="my-3"></div>
<div class="table-responsive">
    <table class="table table-bordered d-table-cell">
        <thead>
            <tr>
                <th>KEY</th>
                <th>时间</th>
                <th>IP</th>
                <th>UA</th>
                <th>来源</th>
                <th>跳转地址</th>
            </tr>
        </thead>
        <tbody>
            {foreach $datas as $vo}
            <tr>
                <td>
                    <code>{$vo['urlx']['key']}</code>
                </td>
                <td>{:date('Y-m-d H:i:s', $vo['time'])}</td>
                <td>
                    <code>{$vo.remote_addr}</code>
                </td>
                <td>
                    <code>{$vo.http_user_agent}</code>
                </td>
                <td>
                    <code>{$vo.http_referer}</code>
                </td>
                <td>
                    <code>{$vo.url}</code>
                </td>
            </tr>
            {/foreach}
        </tbody>
    </table>
</div>
<div class="d-flex align-items-center flex-wrap gap-1 my-3">
    <a class="btn btn-primary {$page>1?'':'disabled'}" href="{echo $router->build('/php94/link/log/index', array_merge($_GET, ['page'=>1]))}">首页</a>
    <a class="btn btn-primary {$page>1?'':'disabled'}" href="{echo $router->build('/php94/link/log/index', array_merge($_GET, ['page'=>max($page-1, 1)]))}">上一页</a>
    <div class="d-flex align-items-center gap-1">
        <input class="form-control" type="number" name="page" min="1" max="{$pages}" value="{$page}" onchange="location.href=this.dataset.url.replace('__PAGE__', this.value)" data-url="{echo $router->build('/php94/link/log/index', array_merge($_GET, ['page'=>'__PAGE__']))}">
        <span>/{$pages}</span>
    </div>
    <a class="btn btn-primary {$page<$pages?'':'disabled'}" href="{echo $router->build('/php94/link/log/index', array_merge($_GET, ['page'=>min($page+1, $pages)]))}">下一页</a>
    <a class="btn btn-primary {$page<$pages?'':'disabled'}" href="{echo $router->build('/php94/link/log/index', array_merge($_GET, ['page'=>$pages]))}">末页</a>
    <div>共{$total}条</div>
</div>
{include common/footer@php94/admin}