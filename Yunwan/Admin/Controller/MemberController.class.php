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
 * 会员控制器
 * @authorzzm<648504250@qq.com>
 */
class MemberController extends AdminController {
	/**
     * 会员列表
     * @authorzzm<648504250@qq.com>
     */
    public function lists(){
        $list       =   M("Member")->field(true)->order('uid asc')->select();
        $this->assign('list',$list);
        $this->display();
    }
	/**
     * 添加模型
     * @authorzzm<648504250@qq.com>
     */
    public function add(){
		if(IS_POST){
			$data['name'] = I('post.name');
			if(M('Member_module')->data($data)->add()){
				$this->success('新增成功', U('MemberModule/lists'));
			}else{
				$this->error('新增失败');
			}
		
		}else{
			$this->display();
		}
    }
	/**
     * 编辑模型
     * @authorzzm<648504250@qq.com>
     */
    public function edit($id = 0){
		if(IS_POST){
			$data['name'] = I('post.name');
			if(M('Member_module')->where(array('id'=>$id))->save($data)!== false){
				$this->success('更新成功', U('Article/lists'));
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
     * 会员设置
     * @authorzzm<648504250@qq.com>
     */
	public function setting(){
		if(IS_POST){
			$config = I('config');
			if($config && is_array($config)){
				$Config = M('Config');
				foreach ($config as $name => $value) {
					$map = array('name' => $name);
					$Config->where($map)->setField('value', $value);
				}
			}
			S('DB_CONFIG_DATA',null);
			$this->success('保存成功！');
		}else{
			$member_module_list       =   M("Member_module")->where(array('status'=>1))->field(true)->order('id asc')->select();
			$this->assign('member_module_list',$member_module_list);
			$this->display();
		}
	}
	/**
     * 积分管理 明细
     * @authorzzm<648504250@qq.com>
     */
	public function points(){
		$list = M('PointsLog')->order('pl_id desc')->select();
		int_to_string($list,
			array('pl_stage'=>array('login'=>'会员登录','register'=>'注册','articleadd'=>'发表文章','articledel'=>'删除文章','point'=>'购买产品')
			)
		);
		$this->assign('list',$list);
		$this->display();
	}
	/**
     * 积分规则设置
     * @authorzzm<648504250@qq.com>
     */
	public function points_setting(){
		if(IS_POST){
			$config = I('config');
			if($config && is_array($config)){
				$Config = M('Config');
				foreach ($config as $name => $value) {
					$map = array('name' => $name);
					$Config->where($map)->setField('value', $value);
				}
			}
			S('DB_CONFIG_DATA',null);
			$this->success('保存成功！');
		}else{
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
        $map = array('uid' => array('in', $id) );
        if(M('Member')->where($map)->delete()){
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