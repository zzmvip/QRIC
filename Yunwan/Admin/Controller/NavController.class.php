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
 * 导航管理控制器
 * @authorzzm<648504250@qq.com>
 */
class NavController extends AdminController {
	public function lists(){
		if(!is_administrator()){
			$where['cityen'] = session('admin_auth.cityen');
		}
		$list = M('Nav')->where($where)->order('sort asc')->select();
		int_to_string($list,
			array('status'=>array(1=>'显示',0=>'隐藏')
			)
		);
		$this->assign('list',$list);
		$this->display();
	}
	/**
     * 导航列表列表
     * @authorzzm<648504250@qq.com>
     */
    public function add(){
		$City=M('City');
		$lists = $City->select();
		$this->assign('lists',$lists);
		if(IS_POST){
			$data = I('post.');
			if(!is_administrator()){
						$data['cityen']=session('admin_auth.cityen');
								}
			if(M('Nav')->data($data)->add()){
				$this->success('添加成功');    
			}else{
				$this->error('添加失败');    
			}
		}else{
			$this->display('edit');
		}
    }
	/**
     * 编辑内容
     * 
     */
	public function edit($id = 0){
		$City=M('City');
		$lists = $City->select();
		$this->assign('lists',$lists);
		
		if(IS_POST){
			$data = I('post.');
			if(!is_administrator()){
						$data['cityen']=session('admin_auth.cityen');
								}
			if(M('Nav')->where(array('id'=>I('post.id')))->save($data)){
				$this->success('编辑成功');    
			}else{
				$this->error('编辑失败');    
			}
		
		}else{
			$info = M('Nav')->where(array('id'=>I('get.id')))->find();
			$this->assign('info',$info);
			$this->display();
		}
    }
	/**
     * 删除内容
     * 
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
		$Points = D('Home/PointsLog');
			
		foreach($id as $val){
			$where['id'] = $val;
			$where['addtype'] = '2';
			$ar = M('nav')->where($where)->select();
			foreach($ar as $v){
				if($v['uid']){
					$Points->points_add($v['uid'],C('POINTS_ADD_ARTICLE'),'del','文章被删除，文章ID'.$v['id'],'articledel',UID);
				}
			}
		}
		
        if(M('Nav')->where($map)->delete()){
			
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