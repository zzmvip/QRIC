<?php
/**
 * QRIC
 *
 * @Author    zzm<648504250@qq.com>
 * @Copyright  Copyright (c) 2013-2016 YunWanXinKe Inc. (http://www.yunwanxinke.com)
 * @Link       http://www.yunwanxinke.com/
 */
namespace Admin\Controller;
use Admin\Model\MemberFieldModel;
/**
 * 会员字段控制器
 * @authorzzm<648504250@qq.com>
 */
class MemberFieldController extends AdminController {
	/**
     * 公共字段列表
     * @authorzzm<648504250@qq.com>
     */
    public function index(){
		$this->redirect('MemberField/lists');
    }
	/**
     * 公共字段列表
     * @authorzzm<648504250@qq.com>
     */
    public function lists($id=''){
		$all_menu   =   M('Field')->getField('id,field');
		if($id){
			$map['tablename'] =   'member_module_'.$id;
		}else{
			$map['tablename'] =   array('in','member,member_common');
		}
        $list       =   M("Field")->where($map)->field(true)->order('sort asc,id asc')->select();
        int_to_string($list,
			array(
			'formtype'=>array('text'=>'单行文本','password'=>'密码框','textarea'=>'多行文本','editor'=>'编辑器','number'=>'数字','open'=>'开关选项','datetime'=>'日期和时间','map'=>'地图','image'=>'图片'),
			'must'=>array(1=>'是',0=>'否'),
			'hide'=>array(1=>'启用',0=>'禁用'),
			'status'=>array(1=>'允许',0=>'不允许'),
			'type'=>array(1=>'系统内置',0=>'用户添加')
			)
		);
        $this->assign('list',$list);
		$this->assign('id',$id);
        $this->display();
    }
	/**
     * 添加公共字段
     * @authorzzm<648504250@qq.com>
     */
    public function add($id=''){
		if(IS_POST){
			$memberfield = D('Field');
			$data = $memberfield->create();
			if($data){
				if($memberfield->addField($data)){
					$memberfield->data($data)->add();
					$this->success('添加成功');
				}else{
					$this->error('字段添加失败');
				}
			}
		}else{
			$this->assign('id',$id);
			$this->display('edit');
		}
    }
	/**
     * 编辑公共字段
     * @authorzzm<648504250@qq.com>
     */
    public function edit($id){
		if(IS_POST){
			$memberfield = D('Field');
			$data = I('post.');	
			if($data){
				if(I('post.type')==1){
					$memberfield->where(array('id'=>$id))->save($data);
					$this->success('编辑成功');
				}else{
					if($memberfield->editField($data)){
						$memberfield->where(array('id'=>$id))->save($data);
						$this->success('编辑成功');
					}else{
						$this->error('字段编辑失败');
					}
				}
			}
		}else{
			$info       =   M("Field")->where(array('id'=>$id))->find();
			$this->assign('info',$info);
			$this->display();
		}
    }
	/**
     * 删除内容
     * @authorzzm<648504250@qq.com>
     */
    public function del(){
		$id = explode(',',I('id',0));
        $id = array_unique((array)$id);
		
        if ( empty($id) ) {
			$data['msg'] = '请选择要操作的数据';
			$data['status'] = 0;
			echo json_encode($data);
        }
		$memberfield = D('Field');
		if($memberfield->deleteField($id)){
			$map = array('id' => array('in', $id) );
			if($memberfield->where($map)->delete()){
				$data['msg'] = '删除成功';
				$data['state'] = 1;
				echo json_encode($data);
			} else {
				$data['msg'] = '删除失败！';
				$data['state'] = 0;
				echo json_encode($data);
			}
		}
    }
	/**
     * AJAX快捷编辑
     * @authorzzm<648504250@qq.com>
     */
    public function ajax(){
		$Memberfield = D('Field');
		$branch = I('get.branch');
		switch ($branch){
			case "sort":
			  $data['sort'] = I('get.value');
			  break;
			case "name":
			  $data['name'] = I('get.value');
			  break;
			case "check_field":
			  $where['field'] = I('get.field');
			  if(I('get.id')) $where['id']  = array('neq',I('get.id'));
			  break;
			default:
		}
		if(I('get.where')){
			$field = $Memberfield->where($where)->find();
			if($field){
				echo 'false';
			} else {
				echo 'true';
			}
		}else{
			$data['id'] = I('get.id');
			if($data){
				if($Memberfield->save($data)!== false){
					$state['result'] = true;
					echo json_encode($state);
				} else {
					$state['result'] = false;
					echo json_encode($state);
				}
			} else {
				$this->error($Memberfield->getError());
			}
		}
    }
}