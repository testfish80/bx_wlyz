<?php

use core\lib\Db;

function get_software_lists()
{
    $con = Db::getInstance();
    return $con->select('software', '', '', '', '', 'id,name');
}

function get_software_card_lists()
{
    $con = Db::getInstance();
    return $con->select('card_type', 'state=1', 'pre_card_type LEFT JOIN pre_software ON pre_card_type.software_id = pre_software.id', 'pre_card_type.software_id', '', 'DISTINCT pre_card_type.software_id as id,pre_software.name');
}

function get_bulletin()
{
//    $contents = @curl_get_contents('http://wlyz.bingxs.com/api/bulletin.php', false, $context);
//    $a = json_decode($contents, TRUE);
//    if ($a) {
//        return $a;
//    }
    return [
        'header' => '
            <div class="alert alert-success" role="alert">
              <strong>欢迎使用</strong> 冰心网络验证
            </div>
        ',
        'msg' => '
            <ul class="list-group list-group-flush">
                <li class="list-group-item">官方QQ群：<a target="_blank" href="//shang.qq.com/wpa/qunwpa?idkey=9a4b7265cefe8573022d5af5bdbc926d56af448a03bf5cdf1bc722772d0a38d9"><img border="0" src="//pub.idqqimg.com/wpa/images/group.png" alt="冰心网络验证官方群" title="冰心网络验证官方群"></a></li>
                <li class="list-group-item">WebApi文档：<a href="http://help.wlyz.bingxs.com/331887" target="_blank">点击查看WebApi文档</a></li>
                <li class="list-group-item">官方网站：<a href="//wlyz.bingxs.com/" target="_blank">点击进入官方网站</a></li>
                <li class="list-group-item">插件下载：<a href="https://www.lanzous.com/b62615/ target="_blank">点击进入插件下载</a></li>
                <li class="list-group-item">授权查询：<a href="http://wlyz.bingxs.com/auth.php" target="_blank">点击进入授权查询</a></li>
            </ul>
        '
    ];
}

function get_current_template()
{
    $a = get_config(array('template_admin', 'template_agent'));
    $con = db::getInstance();
    $admin = $con->select('template', "directory='{$a['template_admin']}'");
    $agent = $con->select('template', "directory='{$a['template_agent']}'");
    return ['admin' => $admin['0'], 'agent' => $agent['0']];
}