<?php
namespace Home\Controller;
use Think\Controller;
class HomeController extends Controller {
	protected function _initialize(){
        /* 读取站点配置 */
        $config = api('Config/lists');
        C($config); //添加配置

        if(!C('SITE_STATUS')){
            exit(C('CLOSED_REASON'));
        }

	}
	/* 用户登录检测 */
	protected function login(){
		/* 用户登录检测 */
		is_login() || $this->error('您还没有登录，请先登录！', U('User/login'));
	}
	public function seo(){
		if(CONTROLLER_NAME=="Index" && ACTION_NAME=="index"){
			$seo_title = C('WEB_SITE_TITLE');
		}elseif(CONTROLLER_NAME=="Article" && ACTION_NAME=="lists"){
			$name = I('get.name');
			$cate = M('ArticleClass')->where(array('enname'=>$name))->find();
			$seo_title = $cate['title'].' - '.C('WEB_SITE_TITLE');
		}elseif(CONTROLLER_NAME=="Article" && ACTION_NAME=="show"){
			$id = I('get.id');
			$article = M('Article')->where(array('id'=>$id))->find();
			$cate = M('ArticleClass')->where(array('id'=>$article['catid']))->find();
			$seo_title = $article['title'].' - '.$cate['title'].' - '.C('WEB_SITE_TITLE');
		}elseif(CONTROLLER_NAME=="Member" && ACTION_NAME=="login"){
			$seo_title = '用户登录 - '.C('WEB_SITE_TITLE');
		}elseif(CONTROLLER_NAME=="Member" && ACTION_NAME=="register"){
			$seo_title = '用户注册 - '.C('WEB_SITE_TITLE');
		}else{
			$seo_title = C('WEB_SITE_TITLE');
		}
		return $seo_title;
	}
}