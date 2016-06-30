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
 * 内容栏目模型
 * @author     劉尐备丶<lxb9812@vip.qq.com>
 */

class ArticleClassModel extends Model {

    protected $_validate = array(
        array('title','require','栏目名称必须填写'), 
        array('enname','require','英文名称必须填写'), 
    );

    /* 自动完成规则 */
    protected $_auto = array(
        array('title', 'htmlspecialchars', self::MODEL_BOTH, 'function'),
        array('enname', 'htmlspecialchars', self::MODEL_BOTH, 'function'),
        /*array('hide', '1', self::MODEL_INSERT),*/
    );
	//删除栏目数据表
	public function del_class_table($id){
		$table = '';
		foreach($id as $value){
			if($value){
				$table = 'article_class_'.$value;
				M("Article_field")->where(array('tablename'=>$table))->delete();
				//删除对应数据库 如果存在
				if($this->table_exists($table)){
					$this->drop_table($table);
				}
			}
		}
		
	}

}