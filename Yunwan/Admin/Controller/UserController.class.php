<?php
/**
 * QRIC
 *
 * @Author    zzm<648504250@qq.com>
 * @Copyright  Copyright (c) 2013-2016 YunWanXinKe Inc. (http://www.yunwanxinke.com)
 * @Link       http://www.yunwanxinke.com/
 */
namespace Admin\Controller;
use Admin\Model\AuthGroupModel;

/**
 * 管理用户控制器
 * @authorzzm<648504250@qq.com>
 */
class UserController extends AdminController {
	/**
     * 管理员列表
     * @authorzzm<648504250@qq.com>
     */
    public function index(){
		$this->redirect('User/adminlist');
    }
    public function adminlist(){
		$list = $this->lists('Admin','','uid asc');
		int_to_string($list,array('status'=>array(1=>'启用',0=>'禁用')));
		$this->assign('_list',$list);
		$this->display();
    }
	/**
     * 新增管理员
     * @authorzzm<648504250@qq.com>
     */
    public function adminadd($username = '', $password = '', $rpassword = '', $group_id = '', $status = ''){
		if(IS_POST){
			$Admin = D('admin');
			empty($username) && $this->error('请输入用户名');
            /* 检测密码 */
            if($password != $rpassword){
                $this->error('密码和重复密码不一致！');
            }
			empty($group_id) && $this->error('请选择用户组');
            /* 注册用户 */
			$data['username'] = $username;
			$data['password'] = yunwan_user_md5($password);
			$data['status'] = $status;
            $uid = $Admin->data($data)->add();
            if($uid){ //注册成功
				$data2['uid'] = $uid;
				$data2['group_id'] = $group_id;
				M('auth_group_access')->data($data2)->add();
                $this->success('用户添加成功！');
            } else { //注册失败，显示错误信息
                $this->success('用户添加失败！');
            }
        } else {
			$auth_group = M('AuthGroup')->where( array('status'=>array('egt','0'),'module'=>'admin','type'=>AuthGroupModel::TYPE_ADMIN) )
                                    ->select();
			$this->assign( 'auth_group', $auth_group );
			$this->display('adminedit');
		}
    }
	/**
     * 编辑管理员
     * @authorzzm<648504250@qq.com>
     */
    public function adminedit($uid){
		$Admin = D('admin');
		if(IS_POST){
			if($uid==C('USER_ADMINISTRATOR')) $this->error('超级管理员禁止编辑');
			$username = I('post.username');
			$password = I('post.password');
			$rpassword = I('post.rpassword');
			$group_id = I('post.group_id');
			$status = I('post.status');
			empty($username) && $this->error('请输入用户名');
			/* 检测密码 */
            if($password != $rpassword){
                $this->error('密码和重复密码不一致！');
            }
			empty($group_id) && $this->error('请选择用户组');
			$data['username'] = $username;
			if(!empty($password)) $data['password'] = yunwan_user_md5($password);
			$data['status'] = I('post.status');
            if($Admin->where(array('uid'=>$uid))->save($data)){ //更新成功
				$data2['group_id'] = $group_id;
				M('auth_group_access')->where(array('uid'=>$uid))->save($data2);
                $this->success('用户更新成功！');
            } else { //注册失败，显示错误信息
                $this->success('用户更新失败！');
            }
		} else {
			$admininfo = $Admin->where(array('uid'=>$uid))->find();
			$this->assign('this_admin', $admininfo);
			$auth_group = M('AuthGroup')->where( array('status'=>array('egt','0'),'module'=>'admin','type'=>AuthGroupModel::TYPE_ADMIN) )
                                    ->select();
			$this->assign( 'auth_group', $auth_group );
			$this->display();
		}
    }
	/**
     * 删除管理员
     * @authorzzm<648504250@qq.com>
     */
    public function admindel(){
		//超级管理员禁止删除  待完善
		$id = explode(',',I('id',0));
        $id = array_unique((array)$id);
        if ( empty($id) ) {
			$data['msg'] = '请选择要操作的数据';
			$data['status'] = 0;
			echo json_encode($data);
        }
        $map = array('uid' => array('in', $id) );
        if(M('admin')->where($map)->delete()){
			M('auth_group_access')->where($map)->delete();
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
     * 管理员修改密码
     * @authorzzm<648504250@qq.com>
     */
    public function modifypw(){
		if(IS_POST){
			//获取参数
			$password   =   I('post.old_pw');
			empty($password) && $this->error('请输入原密码');
			$data['password'] = I('post.new_pw');
			empty($data['password']) && $this->error('请输入新密码');
			$repassword = I('post.new_pw2');
			empty($repassword) && $this->error('请输入确认密码');
			if($data['password'] !== $repassword){
				$this->error('您输入的新密码与确认密码不一致');
			}
			$data2['password'] = yunwan_user_md5($data['password']);
			$status = M('admin')->where(array('uid'=>UID))->save($data2);
			if(false === $status){
				$this->error($res['info']);
			}else{
				D('Admin')->logout();
				session('[destroy]');
				$this->success('修改密码成功，请重新登录！');
			}
		}else{
			$this->display();
		}
    }
	/**
     * AJAX
     * @authorzzm<648504250@qq.com>
     */
    public function ajax(){
		$Admin = D('Admin');
		$branch = I('get.branch');
		switch ($branch){
			case "check_admin_name":
			  $where['username'] = I('get.username');
			  if(I('get.id')) $where['uid']  = array('neq',I('get.id'));
			  break;
			default:
		}
		if(I('get.where')){
			$gname = $Admin->where($where)->find();
			if($gname){
				echo 'false';
			} else {
				echo 'true';
			}
		}
    }
	
	/**
     * 修改头像
     * @authorzzm<648504250@qq.com>
     */
    public function avatar(){
		//TODO: 待完善，目前返回测试数据
		$data['msg'] = '删除失败！';
		$data['status'] = 1;
		echo json_encode($data);
    }
	/**
     * 裁剪头像
     * @authorzzm<648504250@qq.com>
     */
	public function avatar_cut(){
		//TODO: 待完善
		$this->display();
	}
	/**
	 * 常用操作
	 * @authorzzm<648504250@qq.com>
	 */
	public function common_operations($value){
		$uid = session('admin_auth.uid');
		$userquicklink = M('admin')->where(array('uid'=>$uid))->field('quicklink')->find();
		if(!empty($userquicklink['quicklink'])){
			$quicklinkarray = explode(',',$userquicklink['quicklink']);
			if(in_array($value,$quicklinkarray)){
				unset($quicklinkarray[array_search($value,$quicklinkarray)]);
				$data['quicklink'] = implode(',',$quicklinkarray);
			}else{
				$data['quicklink'] = $userquicklink['quicklink'].','.$value;
			}
		}else{
			$data['quicklink'] = $value;
		}
		M('admin')->where(array('uid'=>$uid))->save($data);
		$this->success('保存成功');
	}
}