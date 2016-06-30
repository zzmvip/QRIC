<?php
/**
 * 云湾信科
 *
 * @Author     劉尐备丶<lxb9812@vip.qq.com>
 * @Copyright  Copyright (c) 2013-2016 YunWanXinKe Inc. (http://www.yunwanxinke.com)
 * @Link       http://www.yunwanxinke.com/
 */
namespace Admin\Model;
use Common\Model\Model;

/**
 * 用户模型
 * @author 劉尐备丶<lxb9812@vip.qq.com>
 */

class AdminModel extends Model {

    protected $_validate = array(
        array('username', '1,16', '用户名长度为1-16个字符', self::EXISTS_VALIDATE, 'length'),
        array('username', '', '用户名被占用', self::EXISTS_VALIDATE, 'unique'), //用户名被占用
    );

    /**
     * 登录指定用户
     * @param  string  $username 用户名
	 * @param  string  $password 用户密码
     * @return integer           登录成功-用户ID，登录失败-错误编号
	 * @author 劉尐备丶<lxb9812@vip.qq.com>
     */
    public function login($username, $password){
		$map = array();
		$map['username'] = $username;
		/* 获取用户数据 */
		$user = $this->where($map)->find();
		if(is_array($user) && $user['status']){
			/* 验证用户密码 */
			if(yunwan_user_md5($password) === $user['password']){
				$AuthGroupAccess = M('AuthGroupAccess')->where(array('uid'=>$user['uid']))->find();
				$AuthGroup = M('AuthGroup')->where(array('id'=>$AuthGroupAccess['group_id']))->find();
				$user['cityen'] = $AuthGroup['cityen'];
				$this->autoLogin($user);
				return $user['uid']; //登录成功，返回用户ID
			} else {
				return -2; //密码错误
			}
		} else {
			return -1; //用户不存在或被禁用
		}
    }

    /**
     * 注销当前用户
     * @return void
	 * @author 劉尐备丶<lxb9812@vip.qq.com>
     */
    public function logout(){
        session('admin_auth', null);
        session('admin_auth_sign', null);
    }

    /**
     * 自动登录用户
     * @param  integer $user 用户信息数组
	 * @author 劉尐备丶<lxb9812@vip.qq.com>
     */
    private function autoLogin($user){
        /* 更新登录信息 */
        $data = array(
            'uid'             => $user['uid'],
            'login'           => array('exp', '`login`+1'),
            'last_login_time' => NOW_TIME,
            'last_login_ip'   => get_client_ip(),
        );
        $this->save($data);

        /* 记录登录SESSION和COOKIES */
        $auth = array(
            'uid'             => $user['uid'],
            'username'        => $user['username'],
            'cityen'        => $user['cityen'],
            'last_login_time' => $user['last_login_time'],
            'last_login_ip' => $user['last_login_ip'],
        );

        session('admin_auth', $auth);
        session('admin_auth_sign', data_auth_sign($auth));

    }
}
