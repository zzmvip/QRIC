<?php
/**
 * QRIC
 *
 * @Author    zzm<648504250@qq.com>
 * @Copyright  Copyright (c) 2013-2016 YunWanXinKe Inc. (http://www.yunwanxinke.com)
 * @Link       http://www.yunwanxinke.com/
 */
namespace Admin\Controller;
/**
 * 后台首页控制器
 * @authorzzm<648504250@qq.com>
 */
class IndexController extends AdminController {
	/**
     * 后台首页
     * @authorzzm<648504250@qq.com>
     */
    public function index(){
        $this->display();
    }
	/**
     * 缓存更新
     * @authorzzm<648504250@qq.com>
     */
	public function cache($cache = array()) {
		if (IS_POST) {
			$Dir = new \Dir();
			foreach($cache as $val){
				switch ($val) {
					case "sitedata":
						$Dir->delDir(RUNTIME_PATH . "Data/");
					break;

					case "template":
						//删除缓存目录下的文件
						$Dir->del(RUNTIME_PATH);
						$Dir->delDir(RUNTIME_PATH . "Cache/");
						$Dir->delDir(RUNTIME_PATH . "Temp/");
                    break;

					case "logs":
						$Dir->delDir(RUNTIME_PATH . "Logs/");
                    break;

					case "admin_menu":
						session('ADMIN_MENU_LIST',null);
                    break;
				}
			}
			$this->success("缓存清理成功！", U('Index/cache'));
		} else {
            $this->display();
        }
	}
}