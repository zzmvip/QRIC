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
 * 字段管理模型
 * @author     劉尐备丶<lxb9812@vip.qq.com>
 */

class FieldModel extends Model {

    protected $_validate = array(
        array('field','require','字段名必须填写'), 
        array('name','require','字段别名必须填写'), 
        array('formtype','require','字段类型必须选择'), 
    );

    /* 自动完成规则 */
    protected $_auto = array(
        array('field', 'htmlspecialchars', self::MODEL_BOTH, 'function'),
        array('name', 'htmlspecialchars', self::MODEL_BOTH, 'function'),
    );
	/**
     * 添加字段
     * @author     劉尐备丶<lxb9812@vip.qq.com>
     */
	public function addField($data){
		if (!$this->table_exists($data['tablename'])) {
            $sql = 'CREATE TABLE `'.C("DB_PREFIX").$data['tablename'].'` (`id`  int(10) NULL ,`'.$data['field'].'`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT "'.$data['name'].'" ) DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;';
        }else{
			if(!$this->field_exists($data['tablename'],$data['field'])){
				$sql = 'ALTER TABLE `'.C("DB_PREFIX").$data['tablename'].'` ADD COLUMN `'.$data['field'].'`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT "'.$data['name'].'";';
			}else{
				return false;
			}
		}
		if (false === $this->execute($sql)) {
			return false;
		}else{
			return true;
		}
	}
	/**
     * 检查表是否存在 
     * $table 不带表前缀
     */
    public function table_existss($table) {
        $tables = $this->list_tables();
        return in_array(C("DB_PREFIX") . $table, $tables) ? true : false;
    }
	/**
     * 编辑字段
     * @author     劉尐备丶<lxb9812@vip.qq.com>
     */
	public function editField($data){
		if ($this->table_exists($data['tablename'])) {
			if(!$this->field_exists($data['tablename'],$data['field'])){
				$sql = 'ALTER TABLE `'.C("DB_PREFIX").$data['tablename'].'` CHANGE COLUMN `'.$data['field_old'].'` `'.$data['field'].'`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT "'.$data['name'].'" FIRST ;';
			}else{
				return false;
			}
		}
		if (false === $this->execute($sql)) {
			return false;
		}else{
			return true;
		}
	}
	/**
     * 删除字段
     * @author     劉尐备丶<lxb9812@vip.qq.com>
     */
    public function deleteField($id) {
		foreach($id as $v){
			//原字段信息
			$info = $this->where(array("id" => $v))->find();
			if (empty($info)) {
				$this->error = '该字段不存在！';
				return false;
			}
			//数据表
			$tablename = $info['tablename'];
			$field = $info['field'];
			if (!$this->table_exists($tablename)) {
				$this->error = '数据表不存在！';
				return false;
			}
			//判断是否允许删除
			if ($info['type'] == '1') {
				$this->error = '系统字段不允许被删除！';
				return false;
			}
			$sql .= "ALTER TABLE `".C("DB_PREFIX").$tablename."` DROP `".$field."`;";
		}
		if (false === $this->execute($sql)) {
			return false;
		}else{
			return true;
		}
    }

}