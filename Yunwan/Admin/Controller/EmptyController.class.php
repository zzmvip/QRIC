<?php
/**
 * QRIC
 *
 * @Author    zzm<648504250@qq.com>
 * @Copyright  Copyright (c) 2013-2016 YunWanXinKe Inc. (http://www.yunwanxinke.com)
 * @Link       http://www.yunwanxinke.com/
 */
namespace Admin\Controller;
use Think\Controller;
/**
 * 空控制器
 * @Author    zzm<648504250@qq.com>
 */
class EmptyController extends Controller {
	public function _empty(){
	    $this->display('Public/404');
	}

}
