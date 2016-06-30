

<?php
/**
 * 云湾信科
 *
 * @Author     劉尐备丶<lxb9812@vip.qq.com>
 * @Copyright  Copyright (c) 2013-2016 YunWanXinKe Inc. (http://www.yunwanxinke.com)
 * @Link       http://www.yunwanxinke.com/
 */
namespace Admin\Controller;
use Admin\Model\NavFieldModel;
/**
 * 内容字段控制器
 * @author 劉尐备丶<lxb9812@vip.qq.com>
 */
class NavFieldController extends AdminController {
	/**
     * 编辑公共字段
     * @author 劉尐备丶<lxb9812@vip.qq.com>
     */
	 
    public function edit($id){
		if(IS_POST){
			$navfield = D('Field');
			$data = I('post.');	
			if($data){
				if(I('post.type')==1){
					$navfield->where(array('id'=>$id))->save($data);
					$this->success('编辑成功');
				}else{
					if($navfield->editField($data)){
						$navfield->where(array('id'=>$id))->save($data);
						$this->success('编辑成功');
					}else{
						$this->error('字段编辑失败');
					}
				}
			}
		}else{
			$info       =   M("Nav")->where(array('id'=>$id))->find();
			$this->assign('info',$info);
			$this->display();
		}
    }
	/**
     * 删除内容
     * @author 劉尐备丶<lxb9812@vip.qq.com>
     */
    public function del(){
		$id = explode(',',I('id',0));
        $id = array_unique((array)$id);
		
        if ( empty($id) ) {
			$data['msg'] = '请选择要操作的数据';
			$data['status'] = 0;
			echo json_encode($data);
        }
		$articlefield = D('Field');
		if($articlefield->deleteField($id)){
			$map = array('id' => array('in', $id) );
			if($articlefield->where($map)->delete()){
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
	
}