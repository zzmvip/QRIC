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
class ArticleController extends AdminController {
	/**
     * 内容列表
     * @authorzzm<648504250@qq.com>
     */
    public function index(){
		$this->redirect('Article/lists');
    }
	/**
     * 内容列表
     * @authorzzm<648504250@qq.com>
     */
    public function lists(){
		$username = I('post.username');
		$classid = I('post.classid');
		$title = I('post.title');
		$add_time_from = I('post.add_time_from');
		$add_time_to = I('post.add_time_to');
		if(!empty($username)){
			$u['username'] = array('like',"%$username%");
			$uinfo = M('Admin')->where($u)->find();
			if(!empty($uinfo)){
				$where['uid'] = $uinfo['uid'];
			}
		} 
		if(!empty($classid)){
			$where['catid'] = $classid;
		} 
		if(!empty($title)){
			$where['title'] = array('like',"%$title%");
		} 
		if(!empty($add_time_from) && !empty($add_time_to)){
			$where['_string'] = " updatetime>=".strtotime(I('add_time_from'))." && updatetime<=".strtotime(I('add_time_to'));
	
		}
		if(!is_administrator()){
			$where['cityen'] = session('admin_auth.cityen');
		}
			
		$count      =  M("Article")->where($where)->count();
		$Page       = new \Think\Page($count,25);
		 $show       = $Page->show();
        $list       =   M("Article")->where($where)->field(true)->order('sort asc,id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		//echo M("Article")->getLastSql();
		int_to_string($list,
			array('status'=>array(1=>'开启',0=>'审核中')
			)
		);
        $this->assign('list',$list);
		$this->assign('page',$show);
		$data = M('Article_class')->where(array('hide'=>'1','type'=>'0'))->field(true)->select();
		$data = D('Common/Tree')->toFormatTree($data,'title');
		$data = array_merge(array(0=>array('id'=>'','title_show'=>'选择分类')), $data);
	
        $this->assign('classdata',$data);
		Cookie('__forward__',$_SERVER['REQUEST_URI']);
        $this->display();
		
    }
	/**
     * 添加内容
     * @authorzzm<648504250@qq.com>
     */
    public function add(){
		$City = M("City"); 
		$list = $City->select();
		$this->assign('lists',$list); 
		if(IS_POST){
			$map['tablename'] =   array('in','article,article_common,article_class_'.I('post.catid'));
			$map['hide'] =   '1';
			$list       =   M("Field")->where($map)->field(true)->order('sort asc,id asc')->select();
			$upload = new \Think\Upload(C('ARTICLE_UPLOAD'));
			foreach($list as $val){
				//if($val['formtype']!=='image')	$data[$val['field']] = I($val['field']);
				if($val['formtype']=='image'){
					if($_SESSION['article_img']!==false){
						$info   =   $upload->upload();
						if($info!==false){
							$_SESSION['article_img'] = $info;
						}
					}
				}
				
				if($val['tablename']=='article'){
					if($val['formtype']=='image'){
						if(!empty($_SESSION['article_img'][$val['field']])){
							$data[$val['field']] = $_SESSION['article_img'][$val['field']]['savepath'].$_SESSION['article_img'][$val['field']]['savename'];
						}
						
					}else{
						$data[$val['field']] = I('post.'.$val['field']);
					}
				}elseif($val['tablename']=='article_common'){
					if($val['formtype']=='image'){
						if(!empty($_SESSION['article_img'][$val['field']])){
							$data_common[$val['field']] = $_SESSION['article_img'][$val['field']]['savepath'].$_SESSION['article_img'][$val['field']]['savename'];
						}
					}else{
						$data_common[$val['field']] = I('post.'.$val['field']);
					}
				}elseif($val['tablename']=='article_class_'.I('post.catid')){
					if($val['formtype']=='image'){
						if(!empty($_SESSION['article_img'][$val['field']])){
							$data_class[$val['field']] = $_SESSION['article_img'][$val['field']]['savepath'].$_SESSION['article_img'][$val['field']]['savename'];
						}
					}else{
						$data_class[$val['field']] = I('post.'.$val['field']);
					}
				}else{
					if($val['formtype']=='image'){
						if(!empty($_SESSION['article_img'][$val['field']])){
							$data[$val['field']] = $_SESSION['article_img'][$val['field']]['savepath'].$_SESSION['article_img'][$val['field']]['savename'];
						}
					}else{
						$data[$val['field']] = I('post.'.$val['field']);
					}
				}
				/*if($val['formtype']=='image'){
					$info   =   $upload->upload();
					if($info){
						foreach($info as $file){
							$data[$val['field']] = $file['savepath'].$file['savename'];
						}
					}
				}*/
			}

			$data['uid'] = UID;
			$data['status'] = '1';
			$data['catid'] = I('post.catid');
			$data['posid'] = implode(',',I('post.posid'));
			$data['updatetime'] = time();
			$data['cityen'] =  session('admin_auth.cityen');
			if($id = M('Article')->data($data)->add()){
				if(!empty($data_common)){
					$data_common['id'] = $id;
					M('Article_common')->data($data_common)->add();
				}
				if(!empty($data_class)){
					$data_class['id'] = $id;
					M('Article_class_'.I('post.catid'))->data($data_class)->add();
				}
				$_SESSION['article_img'] = '';
				$this->success('新增成功', Cookie('__forward__'));
			}else{
				$_SESSION['article_img'] = '';
				$this->error('新增失败');
			}
		
		}else{
			$this->assign('info',array('catid'=>I('id')));
			$map['tablename'] =   array('in','article,article_common,article_class_'.I('id'));
			$map['hide'] =   '1';
			$list       =   M("Field")->where($map)->field(true)->order('sort asc,id asc')->select();
			$this->assign('list',$list);

			$position = M('Position')->select();
			$this->assign('position',$position);
			$this->display('edit');
		}
    }

	/**
     * 编辑内容
     * @authorzzm<648504250@qq.com>
     */
    public function edit($id = 0){
		$City = M("City"); 
		$lists = $City->select();
		$this->assign('lists',$lists);

		if(IS_POST){
			
			$map['tablename'] =   array('in','article,article_common,article_class_'.I('post.catid'));
			$map['hide'] =   '1';
			
			$list       =   M("Field")->where($map)->field(true)->order('sort asc,id asc')->select();
			$upload = new \Think\Upload(C('ARTICLE_UPLOAD'));
			
			foreach($list as $val){
				//if($val['formtype']!=='image')	$data[$val['field']] = I($val['field']);
				//保存分表
				
				if($val['formtype']=='image'){
					if($_SESSION['article_img']!==false){
						$info   =   $upload->upload();
						if($info!==false){
							$_SESSION['article_img'] = $info;
						}
					}
				}
				
				if($val['tablename']=='article'){
					if($val['formtype']=='image'){
						if(!empty($_SESSION['article_img'][$val['field']])){
							$data[$val['field']] = $_SESSION['article_img'][$val['field']]['savepath'].$_SESSION['article_img'][$val['field']]['savename'];
						}
						
					}else{
						$data[$val['field']] = I('post.'.$val['field']);
					}
				}elseif($val['tablename']=='article_common'){
					if($val['formtype']=='image'){
						if(!empty($_SESSION['article_img'][$val['field']])){
							$data_common[$val['field']] = $_SESSION['article_img'][$val['field']]['savepath'].$_SESSION['article_img'][$val['field']]['savename'];
						}
					}else{
						$data_common[$val['field']] = I('post.'.$val['field']);
					}
				}elseif($val['tablename']=='article_class_'.I('post.catid')){
					if($val['formtype']=='image'){
						if(!empty($_SESSION['article_img'][$val['field']])){
							$data_class[$val['field']] = $_SESSION['article_img'][$val['field']]['savepath'].$_SESSION['article_img'][$val['field']]['savename'];
						}
					}else{
						$data_class[$val['field']] = I('post.'.$val['field']);
					}
				}else{
					if($val['formtype']=='image'){
						if(!empty($_SESSION['article_img'][$val['field']])){
							$data[$val['field']] = $_SESSION['article_img'][$val['field']]['savepath'].$_SESSION['article_img'][$val['field']]['savename'];
						}
					}else{
						$data[$val['field']] = I('post.'.$val['field']);
					}
				}
				
				/*if($val['formtype']=='image'){
					
					if($info!==false){
						foreach($info as $file){
							$data[$val['field']] = $file['savepath'].$file['savename'];
						}
					}
				} */
			}
			//$data['uid'] = UID;
			$data['catid'] = I('post.catid');
			$data['posid'] = implode(',',I('post.posid'));
			$data['updatetime'] = time();
			$data['cityen'] = session('admin_auth.cityen');
			if(M('Article')->where(array('id'=>$id))->save($data)!== false){
				if(!empty($data_common)){
					$data_common['id'] = $id;
					$data_common_where['id'] = $id;
					$arcom = M('Article_common')->where($data_common_where)->find();
					if(!empty($arcom)){
						M('Article_common')->where($data_common_where)->save($data_common);
					}else{
						M('Article_common')->data($data_common)->add();
					}
				}
				if(!empty($data_class)){
					$data_class['id'] = $id;
					$data_class_where['id'] = $id;
					$arclass = M('Article_class_'.I('post.catid'))->where($data_class_where)->find();
					if(!empty($arclass)){
						M('Article_class_'.I('post.catid'))->where($data_common_where)->save($data_class);
					}else{
						M('Article_class_'.I('post.catid'))->data($data_class)->add();
					}
				}
				$_SESSION['article_img'] = '';
				$this->success('更新成功', U('Article/lists'));
			}else{
				$_SESSION['article_img'] = '';
				$this->error('更新失败');
			}
		
		}else{
			$info = M('Article')->field(true)->find($id);
			$info2 = M('Article_common')->where(array('id'=>$id))->find();
			if(D('Field')->table_existss('article_class_'.$info['catid'])){
				$info3 = M('Article_class_'.$info['catid'])->where(array('id'=>$id))->find();
			}
			if(!empty($info2)) $info = array_merge($info, $info2); 
			if(!empty($info3)) $info = array_merge($info, $info3); 
			if(!empty($info2) && !empty($info3)) $info = array_merge($info, $info2, $info3); 
			$map['tablename'] =   array('in','article,article_common,article_class_'.$info['catid']);
			$map['hide'] =   '1';
			$list       =   M("Field")->where($map)->field(true)->order('sort asc,id asc')->select();
			$info['posid'] = explode(',',$info['posid']);

			$info_field = M("Article_class")->where(array('id'=>$info['catid']))->find();
			
			$info['sh'] = $info_field['status'];
			
			$this->assign('info',$info);
			$this->assign('list',$list);

			$position = M('Position')->select();
			$this->assign('position',$position);
			$this->display();
		}
    }
	/**
	 * 选择栏目
	 * @authorzzm<648504250@qq.com>
	 */
	public function class_select(){
		$data = M('Article_class')->where(array('pid'=>'0','hide'=>'1','type'=>'0'))->field(true)->select();
		foreach($data as $key=>$val){
			$data[$key]['child'] = M('Article_class')->where(array('pid'=>$val['id'],'hide'=>'1','type'=>'0'))->field(true)->select();
		}
        $this->assign('data',$data);
		$this->display();
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
		$Points = D('Home/PointsLog');
			
		foreach($id as $val){
			$where['id'] = $val;
			$where['addtype'] = '2';
			$ar = M('Article')->where($where)->select();
			foreach($ar as $v){
				if($v['uid']){
					$Points->points_add($v['uid'],C('POINTS_ADD_ARTICLE'),'del','文章被删除，文章ID'.$v['id'],'articledel',UID);
				}
			}
		}
		
        if(M('Article')->where($map)->delete()){
			
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
		$Article = D('Article');
		$branch = I('get.branch');
		switch ($branch){
			case "sort":
			  $data['sort'] = I('get.value');
			  break;
			case "click":
			  $data['click'] = I('get.value');
			  break;
			default:
		}
		$data['id'] = I('get.id');
		if($data){
			if($Article->save($data)!== false){
				$state['result'] = true;
				echo json_encode($state);
			} else {
				$state['result'] = false;
				echo json_encode($state);
			}
		} else {
			$this->error($Article->getError());
		}
    }
	/**
	 * 推荐位列表
	 * @authorzzm<648504250@qq.com>
	 */
	public function position(){
		$list = M('Position')->select();
		$this->assign('_list',$list);
		$this->display();
	}
	/**
	 * 添加推荐位
	 * @authorzzm<648504250@qq.com>
	 */
	public function position_add(){
		if(IS_POST){
			$data = i('post.');
			if(M('Position')->data($data)->add()){
				$this->success('添加成功');    
			}else{
				$this->error('添加失败');    
			}
		}else{
			$this->display();
		}
	}
	/**
	 * 编辑推荐位
	 * @authorzzm<648504250@qq.com>
	 */
	public function position_edit(){
		if(IS_POST){
			$data = i('post.');
			if(M('Position')->where(array('id'=>I('post.id')))->save($data)){
				$this->success('编辑成功');    
			}else{
				$this->error('编辑失败');    
			}
		}else{
			$info = M('Position')->where(array('id'=>I('get.id')))->find();
			$this->assign('info',$info);
			$this->display('position_add');
		}
	}
	/**
	 * 删除推荐位
	 * @authorzzm<648504250@qq.com>
	 */
	public function position_del(){
		$id = explode(',',I('id',0));
        $id = array_unique((array)$id);
		
        if ( empty($id) ) {
			$data['msg'] = '请选择要操作的数据';
			$data['status'] = 0;
			echo json_encode($data);
        }
        $map = array('id' => array('in', $id) );
        if(M('Position')->where($map)->delete()){
			$data['msg'] = '删除成功';
			$data['state'] = 1;
			echo json_encode($data);
        } else {
			$data['msg'] = '删除失败！';
			$data['state'] = 0;
			echo json_encode($data);
        }
	}

	/* 上传图片 */
	public function upload(){
		session('upload_error', null);
		/* 上传配置 */
		$setting = C('EDITOR_UPLOAD');

		/* 调用文件上传组件上传文件 */
		$this->uploader = new Upload($setting, 'Local');
		$info   = $this->uploader->upload($_FILES);
		if($info){
			$url = C('EDITOR_UPLOAD.rootPath').$info['imgFile']['savepath'].$info['imgFile']['savename'];
			$url = str_replace('./', '/', $url);
			$info['fullpath'] = __ROOT__.$url;
		}
		session('upload_error', $this->uploader->getError());
		return $info;
	}

	/* 上传图片 */
	public function uploads(){
		session('upload_error', null);
		/* 上传配置 */
		$setting = C('EDITOR_UPLOAD');

		/* 调用文件上传组件上传文件 */
		$this->uploader = new Upload($setting, 'Local');
		$info   = $this->uploader->upload($_FILES);
		if($info){
			$url = C('EDITOR_UPLOAD.rootPath').$info['imgFile']['savepath'].$info['imgFile']['savename'];
			$url = str_replace('./', '/', $url);
			$info['fullpath'] = __ROOT__.$url;
		}
		session('upload_error', $this->uploader->getError());
		return $info;
	}

	//keditor编辑器上传图片处理
	public function ke_upimg(){
		/* 返回标准数据 */
		$return  = array('error' => 0, 'info' => '上传成功', 'data' => '');
		$img = $this->uploads();
		/* 记录附件信息 */
		if($img){
			$return['url'] = $img['fullpath'];
			unset($return['info'], $return['data']);
		} else {
			$return['error'] = 1;
			$return['message']   = session('upload_error');
		}

		/* 返回JSON数据 */
		exit(json_encode($return));
	}
}