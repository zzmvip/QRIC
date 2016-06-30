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
 * 会员模型控制器
 * @authorzzm<648504250@qq.com>
 */
class MemberModuleController extends AdminController {
	/**
     * 模型列表
     * @authorzzm<648504250@qq.com>
     */
    public function lists(){
        $list       =   M("Member_module")->field(true)->order('id asc')->select();
		int_to_string($list,array('email_auth'=>array(1=>'开启',0=>'关闭'),'mobile_auth'=>array(1=>'开启',0=>'关闭'),'user_auth'=>array(1=>'开启',0=>'关闭'),'status'=>array(1=>'启用',0=>'禁用')));
        $this->assign('list',$list);
        $this->display();
    }
	/**
     * 添加模型
     * @authorzzm<648504250@qq.com>
     */
    public function add(){
		if(IS_POST){
			$data = I('post.');
			if(M('Member_module')->data($data)->add()){
				$this->success('新增成功');
			}else{
				$this->error('新增失败');
			}
		
		}else{
			$this->display('edit');
		}
    }
	/**
     * 编辑模型
     * @authorzzm<648504250@qq.com>
     */
    public function edit($id = 0){
		if(IS_POST){
			$data = I('post.');
			if(M('Member_module')->where(array('id'=>$id))->save($data)!== false){
				$this->success('更新成功');
			}else{
				$this->error('更新失败');
			}
		
		}else{
			$info = M('Member_module')->field(true)->find($id);
			$this->assign('info',$info);
			$this->display('edit');
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
        $map = array('id' => array('in', $id) );
        if(M('Member_module')->where($map)->delete()){
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
     * AJAX快捷编辑
     * @authorzzm<648504250@qq.com>
     */
    public function ajax(){
		$Member_module = D('Member_module');
		$branch = I('get.branch');
		switch ($branch){
			case "name":
			  $data['name'] = I('get.value');
			  break;
			default:
		}
		$data['id'] = I('get.id');
		if($data){
			if($Member_module->save($data)!== false){
				$state['result'] = true;
				echo json_encode($state);
			} else {
				$state['result'] = false;
				echo json_encode($state);
			}
		} else {
			$this->error($Member_module->getError());
		}
    }
}