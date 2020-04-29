<?php

namespace app\index\controller;

use app\admin\Auth;
use core\lib\Template;

class Index
{
    public function index()
    {
        $config = get_config();
        Template::set("template/{$config['template_admin']}/");
        require Template::load('main.php');
    }
}
