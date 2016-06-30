<?php
/**
 * 云湾信科
 *
 * @Author     劉尐备丶<lxb9812@vip.qq.com>
 * @Copyright  Copyright (c) 2013-2016 YunWanXinKe Inc. (http://www.yunwanxinke.com)
 * @Link       http://www.yunwanxinke.com/
 */

return array(
	/* 主题设置 */
    'DEFAULT_THEME' =>  'Default',  // 默认模板主题名称

	 /* 模板相关配置 */
    'TMPL_PARSE_STRING' => array(
		'__STATIC__'    => __ROOT__ . '/Static/public',
        '__IMG__'    => __ROOT__ . '/Static/' . MODULE_NAME . '/images',
        '__CSS__'    => __ROOT__ . '/Static/' . MODULE_NAME . '/css',
        '__JS__'     => __ROOT__ . '/Static/' . MODULE_NAME . '/js',
    ),
	/* URL设置 */
	'URL_ROUTER_ON'   => true, // 开启路由
	
	/* 后台错误页面模板 */
    'TMPL_ACTION_ERROR'     =>  MODULE_PATH.'View/Default/Public/error.html', // 默认错误跳转对应的模板文件
    'TMPL_ACTION_SUCCESS'   =>  MODULE_PATH.'View/Default/Public/error.html', // 默认成功跳转对应的模板文件
    'TMPL_EXCEPTION_FILE'   =>  MODULE_PATH.'View/Default/Public/exception.html',// 异常页面的模板文件	
	
    /* SESSION 和 COOKIE 配置 */
    'SESSION_PREFIX' => 'yunwan_home', //session前缀
    'COOKIE_PREFIX'  => 'yunwan_home_', // Cookie前缀 避免冲突
);