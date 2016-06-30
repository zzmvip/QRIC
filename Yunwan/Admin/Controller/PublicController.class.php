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
 * 后台首页控制器
 * @authorzzm<648504250@qq.com>
 */
class PublicController extends Controller {
	/**
     * 后台用户登录
     * @authorzzm<648504250@qq.com>
     */
    public function login($username = null, $password = null, $verify = null){
        if(IS_POST){
			/* 检测验证码 */
            if(!check_verify($verify)){
                $this->error('验证码输入错误！');
            }
			$Admin = D('Admin');
			$uid = $Admin->login($username,$password);
			if(0 < $uid){ //登录用户
				$this->redirect('Index/index');
			} else { //登录失败
				switch($uid) {
                    case -1: $error = '用户不存在或被禁用！'; break; //系统级别禁用
                    case -2: $error = '密码错误！'; break;
                    default: $error = '未知错误！'; break; 
                }
                $this->error($error);
			}
		} else {
			if(is_login()){
                $this->redirect('Index/index');
            }else{
				 /* 读取数据库中的配置 */
                $config	=	S('DB_CONFIG_DATA');
                if(!$config){
                    $config	=	D('Config')->lists();
                    S('DB_CONFIG_DATA',$config);
                }
                C($config); //添加配置
                $this->display();
            }
		}
    }
	/**
     * 退出登录
     * @authorzzm<648504250@qq.com>
     */
    public function logout(){
        if(is_login()){
            D('Admin')->logout();
            session('[destroy]');
            $this->redirect('login');
        } else {
            $this->redirect('login');
        }
    }
	/**
     * 关于我们
     * @authorzzm<648504250@qq.com>
     */
	public function aboutus(){
        $this->display();
    }
	/**
     * IE6升级提示
     * @authorzzm<648504250@qq.com>
     */
	public function ie6update(){
        $this->display();
    }
	public function verify(){
        $verify = new \Think\Verify();
		$verify->__set('useImgBg',true);
		$verify->__set('seKey','SunYuNet');
		$verify->__set('length','4');
		$verify->__set('fontttf','FetteSteinschrift.ttf');
		$verify->__set('useNoise',false);
        $verify->entry(1);
    }
}

