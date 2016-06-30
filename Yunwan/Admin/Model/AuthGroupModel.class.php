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
 * 用户组模型类
 * Class AuthGroupModel
 * @Author     劉尐备丶<lxb9812@vip.qq.com>
 */
class AuthGroupModel extends Model {
    const TYPE_ADMIN                = 1;                   // 管理员用户组类型标识
    const MEMBER                    = 'admin';
    const AUTH_GROUP_ACCESS         = 'auth_group_access'; // 关系表表名
    const AUTH_GROUP                = 'auth_group';        // 用户组表名

    protected $_validate = array(
        array('title','require', '必须设置用户组标题', Model::MUST_VALIDATE ,'regex',Model::MODEL_INSERT),
    );

}

