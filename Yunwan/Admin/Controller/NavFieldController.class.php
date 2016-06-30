

<?php
/**
 * �����ſ�
 *
 * @Author     ������ؼ<lxb9812@vip.qq.com>
 * @Copyright  Copyright (c) 2013-2016 YunWanXinKe Inc. (http://www.yunwanxinke.com)
 * @Link       http://www.yunwanxinke.com/
 */
namespace Admin\Controller;
use Admin\Model\NavFieldModel;
/**
 * �����ֶο�����
 * @author ������ؼ<lxb9812@vip.qq.com>
 */
class NavFieldController extends AdminController {
	/**
     * �༭�����ֶ�
     * @author ������ؼ<lxb9812@vip.qq.com>
     */
	 
    public function edit($id){
		if(IS_POST){
			$navfield = D('Field');
			$data = I('post.');	
			if($data){
				if(I('post.type')==1){
					$navfield->where(array('id'=>$id))->save($data);
					$this->success('�༭�ɹ�');
				}else{
					if($navfield->editField($data)){
						$navfield->where(array('id'=>$id))->save($data);
						$this->success('�༭�ɹ�');
					}else{
						$this->error('�ֶα༭ʧ��');
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
     * ɾ������
     * @author ������ؼ<lxb9812@vip.qq.com>
     */
    public function del(){
		$id = explode(',',I('id',0));
        $id = array_unique((array)$id);
		
        if ( empty($id) ) {
			$data['msg'] = '��ѡ��Ҫ����������';
			$data['status'] = 0;
			echo json_encode($data);
        }
		$articlefield = D('Field');
		if($articlefield->deleteField($id)){
			$map = array('id' => array('in', $id) );
			if($articlefield->where($map)->delete()){
				$data['msg'] = 'ɾ���ɹ�';
				$data['state'] = 1;
				echo json_encode($data);
			} else {
				$data['msg'] = 'ɾ��ʧ�ܣ�';
				$data['state'] = 0;
				echo json_encode($data);
			}
		}
    }
	
}