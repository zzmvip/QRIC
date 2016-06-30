<?php
namespace Home\Controller;

class ArticleController extends HomeController {
	protected function _initialize(){
        parent::_initialize();
    }
    public function lists(){
		$enname = I('name');
		$articleclass = M('Article_class')->where(array('enname'=>$enname))->find();
		if($articleclass['hide'] == '0' || $articleclass['type'] == '1'){
			$this->error('栏目不存在或已禁用');
		}
		//最新文章10条
		$newlist = M('Article')->order('id asc')->limit('10')->select();
		$this->assign('newlist',$newlist);
		if($articleclass['ultimate'] == '1'){//终极栏目
			///列表
			$count      = M('Article')->where(array('catid'=>$articleclass['id']))->count();
			// 查询满足要求的总记录数
			$Page       = new \Think\Page($count,10);
			// 实例化分页类 传入总记录数和每页显示的记录数(25)
			$show       = $Page->show();
			// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
			$list = M('Article')->where(array('catid'=>$articleclass['id']))->order('sort asc,id asc')->limit($Page->firstRow.','.$Page->listRows)->select();

			$tmp = $articleclass['list_template'];
		}else{
			$aclass = M('Article_class')->where(array('pid'=>$articleclass['id']))->select();
			foreach($aclass as $val){
				$cid .= $val['id'].',';
			}
			$where['catid'] = array('between',$cid);
			///列表
			$count      = M('Article')->where($where)->count();
			// 查询满足要求的总记录数
			$Page       = new \Think\Page($count,10);
			// 实例化分页类 传入总记录数和每页显示的记录数(25)
			$show       = $Page->show();
			// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
			$list = M('Article')->where($where)->order('sort asc,id asc')->limit($Page->firstRow.','.$Page->listRows)->select();

			$tmp = $articleclass['category_template'];
		}

		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		
		$template = explode('.',$tmp);
        $this->display($template['0']);
    }
	public function zx(){
		//最新文章10条
		$newlist = M('Article')->order('id asc')->limit('10')->select();
		$this->assign('newlist',$newlist);

		///列表
		$count      = M('Article')->count();
		// 查询满足要求的总记录数
		$Page       = new \Think\Page($count,10);
		// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show       = $Page->show();
		// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = M('Article')->order('id asc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display('list_zx');
	}
	public function show($id){
		//最新文章10条
		$newlist = M('Article')->order('id asc')->limit('10')->select();
		$this->assign('newlist',$newlist);


		$info = M('Article')->field(true)->find($id);
		$info2 = M('Article_common')->where(array('id'=>$id))->find();
		if(D('Admin/Field')->table_existss('article_class_'.$info['catid'])){
			$info3 = M('Article_class_'.$info['catid'])->where(array('id'=>$id))->find();
		}
		if(!empty($info2)) $info = array_merge($info, $info2); 
		if(!empty($info3)) $info = array_merge($info, $info3); 
		if(!empty($info2) && !empty($info3)) $info = array_merge($info, $info2, $info3); 
		$map['tablename'] =   array('in','article,article_common,article_class_'.$info['catid']);
		$map['hide'] =   '1';
		$list       =   M("Field")->where($map)->field(true)->order('sort asc,id asc')->select();
		$info['posid'] = json_decode($info['posid'],true);

		$info_field = M("Article_class")->where(array('id'=>$info['catid']))->find();
		
		$info['sh'] = $info_field['status'];

		$articleclass = M('Article_class')->where(array('id'=>$info['catid']))->find();
		$template = explode('.',$articleclass['show_template']);
		$this->assign('info',$info);

		M('Article')->where(array('id'=>$id))->setInc("click",1);
		$this->display($template['0']);
	}
	public function search(){
		$text=I('post.search-text');
		
	 $Article = M('Article'); // 实例化Article对象
		$data['title']=array('like','%'.$text.'%');
        $info=$Article->where($data)->select(); 
		$this->assign('text',$text);
			
		$this->assign('info',$info);					
		$this->display();
	}
	public function attention(){
		if(!is_login()){
			 $info['info'] = '用户未登录';
		}else{
			$data['uid']=session('member_auth.uid');	
			$data['id']=$_POST['aid'];
			$Attention = M("Attention"); // 实例化Attention对象
			$list=$Attention->where($data)->find();
			if(empty($list)){
				$id = $Attention->data($data)->add();
				if($id){
					$info['info'] = '关注成功';
					$info['status'] = '1';
				}else{
					$info['info'] = '未知错误';
				}
			}else{
				if($Attention->where($data)->delete()){
					$info['info'] = '取消关注成功';
					$info['status'] = '0';
				}else{
					$info['info'] = '未知错误';
				}
			}
		}
		echo json_encode($info);
	}
}