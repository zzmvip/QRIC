<?php
/**
 * QRIC
 *
 * @Author    zzm<648504250@qq.com>
 * @Copyright  Copyright (c) 2013-2016 YunWanXinKe Inc. (http://www.yunwanxinke.com)
 * @Link       http://www.yunwanxinke.com/
 */
namespace Admin\Controller;
use Admin\Model\AuthRuleModel;
use Admin\Model\AuthGroupModel;

/**
 * 权限管理控制器
 * Class AuthManagerController
 * @Author    zzm<648504250@qq.com>
 */
class AuthManagerController extends AdminController{

    /**
     * 后台节点配置的url作为规则存入auth_rule
     * 执行新节点的插入,已有节点的更新,无效规则的删除三项任务
     */
    public function updateRules(){
        //需要新增的节点必然位于$nodes
        $nodes    = $this->returnNodes(false);

        $AuthRule = M('AuthRule');
        $map      = array('module'=>'admin','type'=>array('in','1,2'));//status全部取出,以进行更新
        //需要更新和删除的节点必然位于$rules
        $rules    = $AuthRule->where($map)->order('name')->select();

        //构建insert数据
        $data     = array();//保存需要插入和更新的新节点
        foreach ($nodes as $value){
            $temp['name']   = $value['url'];
            $temp['title']  = $value['title'];
			$temp['module'] = 'admin';
            if($value['pid'] >0){
                $temp['type'] = AuthRuleModel::RULE_URL;
            }else{
                $temp['type'] = AuthRuleModel::RULE_MAIN;
            }
            $temp['status']   = 1;
            $data[strtolower($temp['name'].$temp['module'].$temp['type'])] = $temp;//去除重复项
        }

        $update = array();//保存需要更新的节点
        $ids    = array();//保存需要删除的节点的id
        foreach ($rules as $index=>$rule){
            $key = strtolower($rule['name'].$rule['module'].$rule['type']);
            if ( isset($data[$key]) ) {//如果数据库中的规则与配置的节点匹配,说明是需要更新的节点
                $data[$key]['id'] = $rule['id'];//为需要更新的节点补充id值
                $update[] = $data[$key];
                unset($data[$key]);
                unset($rules[$index]);
                unset($rule['condition']);
                $diff[$rule['id']]=$rule;
            }elseif($rule['status']==1){
                $ids[] = $rule['id'];
            }
        }
        if ( count($update) ) {
            foreach ($update as $k=>$row){
                if ( $row!=$diff[$row['id']] ) {
                    $AuthRule->where(array('id'=>$row['id']))->save($row);
                }
            }
        }
        if ( count($ids) ) {
            $AuthRule->where( array( 'id'=>array('IN',implode(',',$ids)) ) )->save(array('status'=>-1));
            //删除规则是否需要从每个用户组的访问授权表中移除该规则?
        }
        if( count($data) ){
            $AuthRule->addAll(array_values($data));
        }
        if ( $AuthRule->getDbError() ) {
            trace('['.__METHOD__.']:'.$AuthRule->getDbError());
            return false;
        }else{
            return true;
        }
    }


    /**
     * 权限管理首页
     */
    public function index(){
		$list = $this->lists('AuthGroup','','id asc');
        $list = int_to_string($list);
        $this->assign( '_list', $list );
        $this->display();
    }

    /**
     * 创建/编辑管理员用户组
     */
    public function createGroup(){
		$this->updateRules();
		$auth_group = M('AuthGroup')->where( array('status'=>array('egt','0'),'module'=>'admin','type'=>AuthGroupModel::TYPE_ADMIN) )
                                    ->getfield('id,title,rules,status,module');
        $node_list   = $this->returnNodes();
        $map         = array('module'=>'admin','type'=>AuthRuleModel::RULE_MAIN,'status'=>1);
        $main_rules  = M('AuthRule')->where($map)->getField('name,id');
        $map         = array('module'=>'admin','type'=>AuthRuleModel::RULE_URL,'status'=>1);
        $child_rules = M('AuthRule')->where($map)->getField('name,id');
		$City = M("City"); // 实例化City对象
		$list = $City->select();
		$this->assign('list', $list);
        $this->assign('main_rules', $main_rules);
        $this->assign('auth_rules', $child_rules);
        $this->assign('node_list',  $node_list);
        $this->assign('auth_group', $auth_group);
        $this->assign('this_group', $auth_group[(int)$_GET['group_id']]);
        $this->display('editgroup');
    }
	/**
     * 管理员用户组数据写入/更新
     */
    public function writeGroup(){
	   if(isset($_POST['rules'])){
            sort($_POST['rules']);
            $_POST['rules']  = implode( ',' , array_unique($_POST['rules']));
        }
        $AuthGroup       =  D('AuthGroup');
        $data = $AuthGroup->create();
		$AuthGroup->cityen = $_POST['cityen'];
        if ( $data ) {
            if ( empty($data['id']) ) {
                $r = $AuthGroup->add();
            }else{
                $r = $AuthGroup->save();
            }
            if($r===false){
                $this->error('操作失败'.$AuthGroup->getError());
            } else{
                $this->success('操作成功!',U('index'));
            }
        }else{
            $this->error('操作失败'.$AuthGroup->getError());
        }
    }
	/**
     * 删除用户组
     * @authorzzm<648504250@qq.com>
     */
    public function delgroup(){
		$id = explode(',',I('id',0));
        $id = array_unique((array)$id);
        if ( empty($id) ) {
			$data['msg'] = '请选择要操作的数据';
			$data['status'] = 0;
			echo json_encode($data);
        }
        $map = array('id' => array('in', $id) );
        if(M('AuthGroup')->where($map)->delete()){
			$data['msg'] = '删除成功';
			$data['state'] = 1;
			echo json_encode($data);
        } else {
			$data['msg'] = '删除失败！';
			$data['state'] = 0;
			echo json_encode($data);
        }
    }
	/**
     * AJAX
     * @authorzzm<648504250@qq.com>
     */
    public function ajax(){
		$AuthGroup = D('AuthGroup');
		$branch = I('get.branch');
		switch ($branch){
			case "check_group_name":
			  $where['title'] = I('get.title');
			  if(I('get.id')) $where['id']  =  array('neq',I('get.id'));
			  if(I('get.module')) $where['module']  = array('neq',I('get.module'));
			  break;
			default:
		}
		if(I('get.where')){
			$gname = $AuthGroup->where($where)->find();
			if($gname){
				echo 'false';
			} else {
				echo 'true';
			}
		}
    }


}
