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
 * 类目控制器
 * @authorzzm<648504250@qq.com>
 */
class CategoryController extends AdminController {
	/**
     * 类目列表
     * @authorzzm<648504250@qq.com>
     */
    public function lists(){
		
		if(!is_administrator()){
		$data['cityen']=session('admin_auth.cityen');
		}
		$list = M('Links')->where($data)->select();
		
		int_to_string($list,
			array('status'=>array(1=>'显示',0=>'隐藏')
			)
		);
		$this->assign('list',$list);
        $this->display();
    }
	public function edit($id = 0){
		$City=M('City');
		$lists = $City->select();
		
		$this->assign('lists',$lists);
		if(IS_POST){
			dump($_POST);die;
			$data = i('post.');
			if(M('Links')->where(array('id'=>I('post.id')))->save($data)){
				$this->success('编辑成功');    
			}else{
				$this->error('编辑失败');    
			}
		
		}else{
			$info = M('Links')->where(array('id'=>I('get.id')))->find();
		
			$this->assign('info',$info);
			$this->display('add');
		}
    }
 public function add(){
		$City=M('City');
		$lists = $City->select();
		
		$this->assign('lists',$lists);
	 
		if(IS_POST){
			$data = $_POST;
			$upload = new \Think\Upload(C('LINKS_UPLOAD'));
			$info   =   $upload->upload();
			
			foreach($info as $file){
			$data['picture'] = $file['savepath'].$file['savename'];//保存图片
					}
			
			$data['cityen'] = session('admin_auth.cityen');
		
			
			if(M('Links')->data($data)->add()){
				$this->success('添加成功');    
			}else{
				$this->error('添加失败');    
			}
		}else{
			$this->display('edit');
		}
    }
	 public function del(){
		
		$id = explode(',',I('id',0));
        $id = array_unique((array)$id);
		
        if ( empty($id) ) {
			$data['msg'] = '请选择要操作的数据';
			$data['status'] = 0;
			echo json_encode($data);
        }
        $map = array('id' => array('in', $id) );
		
			
	
		
        if(M('Links')->where($map)->delete()){
			
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

