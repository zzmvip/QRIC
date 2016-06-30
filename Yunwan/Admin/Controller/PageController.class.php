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
 * 单页控制器
 * @authorzzm<648504250@qq.com>
 */
class PageController extends AdminController {
	/**
     * 单页列表
     * @authorzzm<648504250@qq.com>
     */
    public function lists(){
        $list = M('Article_class')->where(array('ultimate'=>'1','type'=>'1','hide'=>'1'))->field(true)->select();
		
        $this->assign('list',$list);
        $this->display();
    }

	/**
     * 编辑单页
     * @authorzzm<648504250@qq.com>
     */
    public function edit($id = 0){
		if(IS_POST){
			$pageinfo = M('Article')->field(true)->find($id);
			$map['tablename'] =   array('between','article,article_common');
			$map['hide'] =   '1';
			$map['page'] =   '1';
			$list       =   M("Field")->where($map)->field(true)->order('sort asc,id asc')->select();
			foreach($list as $val){
				if($val['formtype']!=='image')	$data[$val['field']] = I($val['field']);
			}
			$data['catid'] = I('post.catid');
			if($pageinfo && in_array($pageinfo)){
				$data['updatetime'] = time();
				if(M('Article')->where(array('id'=>$id))->save($data)!== false){
					$this->success('更新成功', U('Article/lists'));
				}else{
					$this->error('更新失败');
				}
			}else{
				$data['uid'] = UID;
				$data['updatetime'] = time();
				if(M('Article')->data($data)->add()){
					$this->success('新增成功', U('Article/lists'));
				}else{
					$this->error('新增失败');
				}
			}
		}else{
			$info = M('Article')->field(true)->find($id);
			$map['tablename'] =   array('between','article,article_common');
			$map['hide'] =   '1';
			$map['page'] =   '1';
			$list       =   M("Field")->where($map)->field(true)->order('sort asc,id asc')->select();
			if($pageinfo && in_array($pageinfo)){
				$this->assign('info',$info);
			}else{
				$this->assign('info',array('catid'=>I('id')));
			}
			
			$this->assign('list',$list);
			$this->display('Article/edit');
		}
    }


}