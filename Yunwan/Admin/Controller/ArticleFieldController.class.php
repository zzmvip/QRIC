<?php
/**
 * QRIC
 *
 * @Author    zzm<648504250@qq.com>
 * @Copyright  Copyright (c) 2013-2016 YunWanXinKe Inc. (http://www.yunwanxinke.com)
 * @Link       http://www.yunwanxinke.com/
 */
namespace Admin\Controller;
use Admin\Model\ArticleFieldModel;
/**
 * 内容字段控制器
 * @authorzzm<648504250@qq.com>
 */
class ArticleFieldController extends AdminController {
	/**
     * 公共字段列表
     * @authorzzm<648504250@qq.com>
     */
    public function index(){
		$this->redirect('ArticleField/lists');
    }
	/**
     * 公共字段列表
     * @authorzzm<648504250@qq.com>
     */
    public function lists($catid=''){
		$all_menu   =   M('Field')->getField('id,field');
		if($catid){
			$map['tablename'] =   'article_class_'.$catid;
		}else{
			$map['tablename'] =   array('in','article,article_common');
		}
        $list       =   M("Field")->where($map)->field(true)->order('sort asc,id asc')->select();
        int_to_string($list,
			array(
			'formtype'=>array('text'=>'单行文本','password'=>'密码框','textarea'=>'多行文本','editor'=>'编辑器','number'=>'数字','open'=>'开关选项','datetime'=>'日期和时间','map'=>'地图','image'=>'图片'),
			'must'=>array(1=>'是',0=>'否'),
			'hide'=>array(1=>'启用',0=>'禁用'),
			'status'=>array(1=>'允许',0=>'不允许'),
			'page'=>array(1=>'支持',0=>'不支持'),
			'type'=>array(1=>'系统内置',0=>'用户添加')
			)
		);
        $this->assign('list',$list);
		$this->assign('catid',$catid);
        $this->display();
    }
	/**
     * 添加公共字段
     * @authorzzm<648504250@qq.com>
     */
    public function add($catid=''){
		if(IS_POST){
			$articlefield = D('Field');
			$data = $articlefield->create();
			if($data){
				if($articlefield->addField($data)){
					$articlefield->data($data)->add();
					$this->success('添加成功');
				}else{
					$this->error('字段添加失败');
				}
			}
		}else{
			$this->assign('catid',$catid);
			$this->display('edit');
		}
    }
	/**
     * 编辑公共字段
     * @authorzzm<648504250@qq.com>
     */
    public function edit($id){
		if(IS_POST){
			$articlefield = D('Field');
			$data = I('post.');	
			if($data){
				if(I('post.type')==1){
					$articlefield->where(array('id'=>$id))->save($data);
					$this->success('编辑成功');
				}else{
					if($articlefield->editField($data)){
						$articlefield->where(array('id'=>$id))->save($data);
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
	/**
     * AJAX快捷编辑
     * @authorzzm<648504250@qq.com>
     */
    public function ajax(){
		$Articlefield = D('Field');
		$branch = I('get.branch');
		switch ($branch){
			case "sort":
			  $data['sort'] = I('get.value');
			  break;
			case "name":
			  $data['name'] = I('get.value');
			  break;
			case "check_field":
			  $id=I('get.id');
			  $where['tablename'] = "article_class_".$id;
			  $where['field'] = I('get.field');
			  if(I('get.id')) $where['id']  = array('neq',I('get.id'));
			  break;
			default:
		}
		if(I('get.where')){
			$field = $Articlefield->where($where)->find();
			if($field){
				echo 'false';
			} else {
				echo 'true';
			}
		}else{
			$data['id'] = I('get.id');
			if($data){
				if($Articlefield->save($data)!== false){
					$state['result'] = true;
					echo json_encode($state);
				} else {
					$state['result'] = false;
					echo json_encode($state);
				}
			} else {
				$this->error($Articlefield->getError());
			}
		}
    }
}