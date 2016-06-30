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
 * 配置模型
 * @Author     劉尐备丶<lxb9812@vip.qq.com>
 */

class ConfigModel extends Model {
    /**
     * 获取配置列表
     * @return array 配置数组
	 * @Author     劉尐备丶<lxb9812@vip.qq.com>
     */
    public function lists(){
        $data   = $this->field('name,value')->select();
        
        $config = array();
        if($data && is_array($data)){
            foreach ($data as $value) {
                $config[$value['name']] = $value['value'];
            }
        }
        return $config;
    }


}
