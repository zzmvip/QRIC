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
 * 后台配置控制器
 * @Author    zzm<648504250@qq.com>
 */
class ConfigController extends AdminController {
	/**
     * 站点设置
     * @Author    zzm<648504250@qq.com>
     */
	public function setting(){
		$this->display();
	}
	/**
     * 邮箱设置
     * @Author    zzm<648504250@qq.com>
     */
	public function email($email_test=''){
		if($email_test){
			$mail = send_mail($email_test,'测试邮件');
			if($mail==true){
				$this->success('发送成功！');
			}else{
				$this->success('保存成功！');
			}
		}else{
			$this->display();
		}
	}

	/**
     * 保存配置
     * @Author    zzm<648504250@qq.com>
     */
    public function save($config){
        if($config && is_array($config)){
            $Config = M('Config');
            foreach ($config as $name => $value) {
                $map = array('name' => $name);
                $Config->where($map)->setField('value', $value);
            }
        }
        S('DB_CONFIG_DATA',null);
        $this->success('保存成功！');
    }

}