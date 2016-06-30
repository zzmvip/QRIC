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
 * 内容栏目控制器
 * @author zzm<648504250@qq.com>
 */
class ArticleClassController extends AdminController {
	//模板文件夹
    private $filepath;
    //频道模板路径
    protected $tp_category;
    //列表页模板路径
    protected $tp_list;
    //内容页模板路径
    protected $tp_show;
    //单页模板路径
    protected $tp_page;

    //初始化
    protected function _initialize() {
        //取得当前内容模型模板存放目录
        $this->filepath = TEMPLATE_PATH;
        //取得栏目频道模板列表
        $this->tp_category = str_replace($this->filepath . "Article/", '', glob($this->filepath . 'Article/article*'));
        //取得栏目列表模板列表
        $this->tp_list = str_replace($this->filepath . "Article/", '', glob($this->filepath . 'Article/list*'));
        //取得内容页模板列表
        $this->tp_show = str_replace($this->filepath . "Article/", '', glob($this->filepath . 'Article/show*'));
        //取得单页模板
        $this->tp_page = str_replace($this->filepath . "Page/", '', glob($this->filepath . 'Page/page*'));
    }
	/**
     * 栏目列表
     * @author zzm<648504250@qq.com>
     */
    public function index(){
		
		$pid  = I('get.pid',0);
        if($pid){
            $data = M('Article_class')->where("id={$pid}")->field(true)->find();
			$this->assign('data',$data);
        }
        $all_menu   =   M('Article_class')->getField('id,title');
        $map['pid'] =   $pid;
		
        $list       =   M("Article_class")->where($map)->field(true)->order('sort asc,id asc')->select();
        int_to_string($list,array('type'=>array(1=>'单页',0=>'文章'),'ultimate'=>array(1=>'是',0=>'否'),'hide'=>array(1=>'启用',0=>'禁用'),'display'=>array(1=>'显示',0=>'不显示'),'status'=>array(1=>'需审核',0=>'不审核')));
      
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
     * 栏目列表
     * @author  zzm<648504250@qq.com>
     */
    public function lists(){
		$this->redirect('ArticleClass/index');
    }
	/**
     * 新增栏目
     * @author zzm<648504250@qq.com>
     */
    public function add(){
		

        if(IS_POST){
            $Articleclass = D('Article_class');
            $data = $Articleclass->create();
            if($data){
                $id = $Articleclass->add();
                if($id){
                    $this->success('新增成功', Cookie('__forward__'));
                } else {
                    $this->error('新增失败');
                }
            } else {
                $this->error($Articleclass->getError());
            }
        } else {
            $this->assign('info',array('pid'=>I('pid')));
            $aclass = M('Article_class')->where(array('ultimate'=>'0','hide'=>'1'))->field(true)->select();
            $aclass = D('Common/Tree')->toFormatTree($aclass);
            $aclass = array_merge(array(0=>array('id'=>0,'title_show'=>'顶级栏目')), $aclass);
            $this->assign('aclass', $aclass);
			
			$this->assign("tp_category", $this->tp_category);
            $this->assign("tp_list", $this->tp_list);
            $this->assign("tp_show", $this->tp_show);
            $this->assign("tp_page", $this->tp_page);
            $this->display('edit');
        }
    }
	/**
     * 编辑栏目
     * @author  zzm<648504250@qq.com>
     */
    public function edit($id = 0){
		
        if(IS_POST){
            $Articleclass = D('Article_class');
            $data = $Articleclass->create();
			
            if($data){
                if($Articleclass->save()!== false){
                    $this->success('更新成功', Cookie('__forward__'));
                } else {
                    $this->error('更新失败');
                }
            } else {
                $this->error($Articleclass->getError());
            }
        } else {
            $info = array();
            /* 获取数据 */
            $info = M('Article_class')->field(true)->find($id);
            $aclass = M('Article_class')->field(true)->select();
            $aclass = D('Common/Tree')->toFormatTree($aclass);
            $aclass = array_merge(array(0=>array('id'=>0,'title_show'=>'顶级栏目')), $aclass);
            $this->assign('aclass', $aclass);
            if(false === $info){
                $this->error('获取后台菜单信息错误');
            }
            $this->assign('info', $info);

			$this->assign("tp_category", $this->tp_category);
            $this->assign("tp_list", $this->tp_list);
            $this->assign("tp_show", $this->tp_show);
            $this->assign("tp_page", $this->tp_page);
            $this->display();
        }
    }
	/**
     * 删除栏目
     * @author zzm<648504250@qq.com>
     */
    public function del(){
		$id = explode(',',I('id',0));
        $id = array_unique((array)$id);
		
		
        if ( empty($id) ) {
			$data['msg'] = '请选择要操作的数据';
			$data['status'] = 0;
			echo json_encode($data);
        }
		$Article_class = D('ArticleClass');
		
        $map = array('id' => array('in', $id) );
        if($Article_class->where($map)->delete()){
			$where = array('pid' => array('in', $id) );
			$Article_class->where($where)->delete();
			$Article_class->del_class_table($id);
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
     * @author zzm<648504250@qq.com>
     */
    public function ajax(){
		$Menu = D('Article_class');
		$branch = I('get.branch');
		switch ($branch){
			case "sort":
			  $data['sort'] = I('get.value');
			  break;
			case "title":
			  $data['title'] = I('get.value');
			  break;
			case "enname":
			  $data['enname'] = I('get.value');
			  break;
			case "check_enname":
			  $where['enname'] = I('get.enname');
			  if(I('get.id')) $where['id']  = array('neq',I('get.id'));
			  break;
			default:
		}
		if(I('get.where')){
			$enname = $Menu->where($where)->find();
			if($enname){
				echo 'false';
			} else {
				echo 'true';
			}
		}else{
			$data['id'] = I('get.id');
			if($data){
				if($Menu->save($data)!== false){
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
}