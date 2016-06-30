<?php
/**
 * 云湾信科
 *
 * @Author     劉尐备丶<lxb9812@vip.qq.com>
 * @Copyright  Copyright (c) 2013-2016 YunWanXinKe Inc. (http://www.yunwanxinke.com)
 * @Link       http://www.yunwanxinke.com/
 */

//入口文件

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',true);
define('BIND_MODULE','Home');
//应用目录
define('APP_PATH','./Yunwan/');

//应用运行时目录
define('RUNTIME_PATH','./Runtime/');

//模板存放路径
define('TEMPLATE_PATH', APP_PATH . 'Home/View/Default/');

//框架系统目录
define('YUNWAN_PATH',APP_PATH . 'Core/');

// 引入ThinkPHP入口文件
require YUNWAN_PATH . 'ThinkPHP.php';