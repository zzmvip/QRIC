<?php
/**
 * QRIC
 *
 * @Author    zzm<648504250@qq.com>
 * @Copyright  Copyright (c) 2013-2016 YunWanXinKe Inc. (http://www.yunwanxinke.com)
 * @Link       http://www.yunwanxinke.com/
 */
namespace Admin\Controller;
use Think\Upload;

/**
 * 内容控制器
 * @authorzzm<648504250@qq.com>
 */
class DiscussController extends AdminController {
	/**
     * 内容列表
     * @authorzzm<648504250@qq.com>
     */
    public function lists(){
		$Cart = M("Cart"); // 实例化Cart对象
		$list = $Cart->select();
		$this->assign('list',$list);
		$this->display();
    }
	/**
     * 内容列表
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
		 if(M('Discuss')->where($map)->delete()){
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