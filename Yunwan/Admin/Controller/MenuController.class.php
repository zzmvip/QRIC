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
 * 后台菜单控制器
 * @authorzzm<648504250@qq.com>
 */
class MenuController extends AdminController {
	/**
     * 后台菜单列表
     * @authorzzm<648504250@qq.com>
     */
    public function index(){
		$pid  = I('get.pid',0);
        if($pid){
            $data = M('Menu')->where("id={$pid}")->field(true)->find();
            $this->assign('data',$data);
        }
        $all_menu   =   M('Menu')->getField('id,title');
        $map['pid'] =   $pid;
        $list       =   M("Menu")->where($map)->field(true)->order('sort asc,id asc')->select();
        int_to_string($list,array('hide'=>array(1=>'显示',0=>'隐藏')));
        if($list) {
            foreach($list as &$key){
                if($key['pid']){
                    $key['up_title'] = $all_menu[$key['pid']];
                }
            }
            $this->assign('list',$list);
        }
        // 记录当前列表页的cookie
        Cookie('__forward__',$_SERVER['REQUEST_URI']);
        $this->display();
    }
	/**
     * 新增菜单
     * @authorzzm<648504250@qq.com>
     */
    public function add(){
        if(IS_POST){
            $Menu = D('Menu');
            $data = $Menu->create();
            if($data){
                $id = $Menu->add();
                if($id){
                    session('ADMIN_MENU_LIST',null);
                    $this->success('新增成功', Cookie('__forward__'));
                } else {
                    $this->error('新增失败');
                }
            } else {
                $this->error($Menu->getError());
            }
        } else {
            $this->assign('info',array('pid'=>I('pid')));
            $menus = M('Menu')->field(true)->select();
            $menus = D('Common/Tree')->toFormatTree($menus);
            $menus = array_merge(array(0=>array('id'=>0,'title_show'=>'顶级菜单')), $menus);
            $this->assign('Menus', $menus);
            $this->display('edit');
        }
    }
	/**
     * 编辑配置
     * @authorzzm<648504250@qq.com>
     */
    public function edit($id = 0){
        if(IS_POST){
            $Menu = D('Menu');
            $data = $Menu->create();
            if($data){
                if($Menu->save()!== false){
                    session('ADMIN_MENU_LIST',null);
                    $this->success('更新成功', Cookie('__forward__'));
                } else {
                    $this->error('更新失败');
                }
            } else {
                $this->error($Menu->getError());
            }
        } else {
            $info = array();
            /* 获取数据 */
            $info = M('Menu')->field(true)->find($id);
            $menus = M('Menu')->field(true)->select();
            $menus = D('Common/Tree')->toFormatTree($menus);
            $menus = array_merge(array(0=>array('id'=>0,'title_show'=>'顶级菜单')), $menus);
            $this->assign('Menus', $menus);
            if(false === $info){
                $this->error('获取后台菜单信息错误');
            }
            $this->assign('info', $info);
            $this->display();
        }
    }
	/**
     * 删除后台菜单
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
        if(M('Menu')->where($map)->delete()){
			$where = array('pid' => array('in', $id) );
			M('Menu')->where($where)->delete();
            session('ADMIN_MENU_LIST',null);
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
		$Menu = D('Menu');
		$branch = I('get.branch');
		switch ($branch){
			case "sort":
			  $data['sort'] = I('get.value');
			  break;
			case "title":
			  $data['title'] = I('get.value');
			  break;
			case "url":
			  $data['url'] = I('get.value');
			  break;
			default:
		}
		$data['id'] = I('get.id');
		if($data){
			if($Menu->save($data)!== false){
				session('ADMIN_MENU_LIST',null);
				$state['result'] = true;
				echo json_encode($state);
			} else {
				$state['result'] = false;
				echo json_encode($state);
			}
		} else {
			$this->error($Menu->getError());
		}
    }
}