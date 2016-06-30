<?php
namespace Home\Controller;

class MemberController extends HomeController {
	protected function _initialize(){
        parent::_initialize();
    }
	/* 用户中心首页 */
	public function index(){
		if ( !is_login() ) {
			$this->error( '您还没有登陆',U('Member/login') );
		}
		$this->display();
	}
	/* 修改资料 */
	public function modify(){
		if ( !is_login() ) {
			$this->error( '您还没有登陆',U('Member/login') );
		}
		$uid = session('member_auth.uid');
		if(IS_POST){
			$data = $_POST;
			M('Member')->where(array('uid'=>$uid))->save($data);
			$this->success( '资料修改成功',U('Member/modify') );
		}else{
			$userinfo = M('Member')->where(array('uid'=>$uid))->find();
			$this->assign('userinfo',$userinfo);
			$this->display();
		}
	}
	/**
     * 修改密码提交
     */
    public function profile(){
		if ( !is_login() ) {
			$this->error( '您还没有登陆',U('Member/login') );
		}
        if ( IS_POST ) {
            //获取参数
            $uid        =   session('member_auth.uid');
            $password   =   I('post.old');
            $repassword = I('post.repassword');
            $data['password'] = I('post.password');
            empty($password) && $this->error('请输入原密码');
            empty($data['password']) && $this->error('请输入新密码');
            empty($repassword) && $this->error('请输入确认密码');

            if($data['password'] !== $repassword){
                $this->error('您输入的新密码与确认密码不一致');
            }
			$data2['password'] = yunwan_user_md5($data['password']);

            if(M('Member')->where(array('uid'=>$uid))->save($data2)){
                $this->success('修改密码成功！');
            }else{
                $this->error('修改密码失败！');
            }
        }else{
            $this->display();
        }
    }
	/* 用户头像 */
	public function userphoto(){
		if ( !is_login() ) {
			$this->error( '您还没有登陆',U('Member/login') );
		}
		$url = C('MEMBER_UPLOAD.rootPath');
		$uid = session('member_auth.uid');
		$this->assign('url',$url);
		$this->assign('uid',$uid);
		$this->display();
	}
	//头像上传
	public function userphotoup(){
		 /* 返回标准数据 */

        /* 调用文件上传组件上传文件 */
        $File = D('File');
        $info = $File->upload(
            $_FILES,
            C('MEMBER_UPLOAD')
        ); //TODO:上传到远程服务器

        /* 记录图片信息 */
        if($info){
            $return = $info;
        } else {
            $return   = $File->getError();
        }

        /* 返回JSON数据 */
        $this->ajaxReturn($return);
		  
	}
	//头像裁剪
	public function userphotoinsert(){
		if ( !is_login() ) {
			$this->error( '您还没有登陆',U('Member/login') );
		}
		
		if(isset($_POST["submit"])){		
			$tname  = $_POST['img'];
			if(!file_exists(C('MEMBER_UPLOAD.rootPath').$tname)){
				$this->error( '头像修改失败',U('Member/userphoto'));
			}
			$x = (int)$_POST['x'];
			$y = (int)$_POST['y'];
			$w = (int)$_POST['w'];
			$h = (int)$_POST['h'];
			$point = array("x"=>$x,"y"=>$y,"w"=>$w,"h"=>$h);
			$File = D('File');
			$File->thumbs(160,160,false,C('MEMBER_UPLOAD.rootPath').$tname,$point);
			$File->thumbs(80,80,false,C('MEMBER_UPLOAD.rootPath').$tname,$point);
			$File->thumbs(30,30,false,C('MEMBER_UPLOAD.rootPath').$tname,$point);	
			$uid = session('member_auth.uid');
			$data['pic'] = $tname;
			M('Member')->where(array('uid'=>$uid))->save($data);
			$this->success( '头像修改成功',U('Member/userphoto') );
			
		}
	}
	public function articlelist(){
		if ( !is_login() ) {
			$this->error( '您还没有登陆',U('Member/login') );
		}
		$uid        =   session('member_auth.uid');
		$list  = M('Article')->where(array('uid'=>$uid))->select();
		$this->assign('list',$list);
		$this->assign('catid',I('get.id'));
		$this->display();
	}
	public function articleadd(){
		if ( !is_login() ) {
			$this->error( '您还没有登陆',U('Member/login') );
		}
		$uid = session('member_auth.uid');
		if(IS_POST){
			$catid = I('post.catid');
			$map['tablename'] =   array('in','article,article_common,article_class_'.$catid);
			$map['hide'] =   '1';
			$map['status'] =   '1';
			$list       =   M("Field")->where($map)->field(true)->order('sort asc,id asc')->select();
			$upload = new \Think\Upload(C('ARTICLE_UPLOAD'));
			foreach($list as $val){
				//if($val['formtype']!=='image')	$data[$val['field']] = I($val['field']);
				if($val['formtype']=='image'){
					$info   =   $upload->upload();
					foreach($info as $file){
						$data[$val['field']] = $file['savepath'].$file['savename'];
					}
				} 
				//保存分表
				if($val['tablename']=='article'){
					$data[$val['field']] = I('post.'.$val['field']);
				}elseif($val['tablename']=='article_common'){
					$data_common[$val['field']] = I('post.'.$val['field']);
				}elseif($val['tablename']=='article_class_'.$catid){
					$data_class[$val['field']] = I('post.'.$val['field']);
				}else{
					$data[$val['field']] = I('post.'.$val['field']);
				}
			}
			$aclassinfo = M('Article_class')->where(array('id'=>$catid))->find();
			if($aclassinfo['status']=='1'){
				$data['status'] = '0';
			}else{
				$data['status'] = '1';
			}
			$data['uid'] = $uid;
			$data['catid'] = $catid;
			$data['addtype'] = '2';
			$data['updatetime'] = time();
			if($id = M('Article')->data($data)->add()){
				if(!empty($data_common)){
					$data_common['id'] = $id;
					M('Article_common')->data($data_common)->add();
				}
				if(!empty($data_class)){
					$data_class['id'] = $id;
					M('Article_class_'.I('post.catid'))->data($data_class)->add();
				}
				$Points = D('PointsLog');
				$Points->points_add($uid,C('POINTS_ADD_ARTICLE'),'add','发表文章，文章ID'.$id,'articleadd');

				$this->success('提交成功', U('Member/articlelist'));
			}else{
				$this->error('提交失败');
			}
		}else{
			$this->assign('info',array('catid'=>I('id')));
			$map['tablename'] =   array('in','article,article_common,article_class_'.I('id'));
			$map['hide'] =   '1';
			$map['status'] =   '1';
			$list       =   M("Field")->where($map)->field(true)->order('sort asc,id asc')->select();
			$this->assign('list',$list);
			$this->assign('catid',I('get.id'));
			$this->assign('info',array('catid'=>I('id')));
			$this->display();
		}
	}
	/**
     * 编辑内容
     * @author 劉尐备丶<lxb9812@vip.qq.com>
     */
    public function articleedit($id = 0){
		if(IS_POST){
			$map['tablename'] =   array('in','article,article_common,article_class_'.I('post.catid'));
			$map['hide'] =   '1';
			$map['status'] =   '1';
			$list       =   M("Field")->where($map)->field(true)->order('sort asc,id asc')->select();
			$upload = new \Think\Upload(C('ARTICLE_UPLOAD'));
			foreach($list as $val){
				//if($val['formtype']!=='image')	$data[$val['field']] = I($val['field']);
				if($val['formtype']=='image'){
					$info   =   $upload->upload();
					foreach($info as $file){
						$data[$val['field']] = $file['savepath'].$file['savename'];
					}
				} 
				//保存分表
				if($val['tablename']=='article'){
					$data[$val['field']] = I('post.'.$val['field']);
				}elseif($val['tablename']=='article_common'){
					$data_common[$val['field']] = I('post.'.$val['field']);
				}elseif($val['tablename']=='article_class_'.I('post.catid')){
					$data_class[$val['field']] = I('post.'.$val['field']);
				}else{
					$data[$val['field']] = I('post.'.$val['field']);
				}
			}
			//$data['uid'] = UID;
			$aclassinfo = M('Article_class')->where(array('id'=>$catid))->find();
			if($aclassinfo['status']=='1'){
				$data['status'] = '0';
			}else{
				$data['status'] = '1';
			}
			$data['catid'] = I('post.catid');
			$data['updatetime'] = time();
			if(M('Article')->where(array('id'=>$id))->save($data)!== false){
				if(!empty($data_common)){
					$data_common['id'] = $id;
					M('Article_common')->data($data_common)->add();
				}
				if(!empty($data_class)){
					$data_class['id'] = $id;
					M('Article_class_'.I('post.catid'))->data($data_class)->add();
				}
				$this->success('更新成功', U('Member/articlelist'));
			}else{
				$this->error('更新失败');
			}
		
		}else{
			$info = M('Article')->field(true)->find($id);
			$info2 = M('Article_common')->where(array('id'=>$id))->find();
			$info3 = M('Article_class_'.$info['catid'])->where(array('id'=>$id))->find();
			if(!empty($info2)) $info = array_merge($info, $info2); 
			if(!empty($info3)) $info = array_merge($info, $info3); 
			if(!empty($info2) && !empty($info3)) $info = array_merge($info, $info2, $info3); 
			$map['tablename'] =   array('in','article,article_common,article_class_'.$info['catid']);
			$map['hide'] =   '1';
			$map['status'] =   '1';
			$list       =   M("Field")->where($map)->field(true)->order('sort asc,id asc')->select();
			$this->assign('info',$info);
			$this->assign('list',$list);
			$this->display('articleadd');
		}
    }
    public function register($username = '', $password = '', $repassword = '',$email = '',$mobile = ''){
		if (is_login() ) {
			$this->success( '已经登录',U('Index/index') );
			exit;
		}
		if(!C('IS_MEMBER_REG')) {
			//$this->error( '系统已关闭会员注册功能，如有疑问请联系网站管理员。',U('Index/index') );
			$datas['info'] = '系统已关闭会员注册功能，如有疑问请联系网站管理员。';
			$datas['status'] = 'n';
			echo json_encode($datas);
			exit;
		}
		if(IS_POST){
			$ip = get_client_ip();
			$regwhere['regip'] = $ip;
			$sta_time = time()-60*60*24;
			$end_time = time();
			$regwhere['regtimes'] = array(array('EGT',$sta_time),array('ELT',$end_time,'AND'));
			$regcount = M('Member')->where($regwhere)->count();
			if($regcount >= C('MEMBER_REG_NUM') && C('MEMBER_REG_NUM') > 0){
				//$this->error('注册已达到今日上限');
				$datas['info'] = '注册已达到今日上限';
				$datas['status'] = 'n';
				echo json_encode($datas);
				exit;
			}
			/* 检测密码 */
			if($password != $repassword){
				//$this->error('密码和重复密码不一致！');
				$datas['info'] = '密码和重复密码不一致！';
				$datas['status'] = 'n';
				echo json_encode($datas);
				exit;
			}
			if(!_checkmobile($mobile)){
				//$this->error('手机格式不正确');
				$datas['info'] = '手机格式不正确';
				$datas['status'] = 'n';
				echo json_encode($datas);
				exit;
			}
			if(!_checkemail($email)){
				//$this->error('邮箱格式不正确');
				$datas['info'] = '邮箱格式不正确';
				$datas['status'] = 'n';
				echo json_encode($datas);
				exit;
			}
			$data['moduleid'] = C('MEMBER_REG_DEFAULT_MODULE');
			$data['username'] = $username;
			$data['password'] = yunwan_user_md5($password);
			$data['email'] = $email;
			$data['mobile'] = $mobile;
			$data['regtimes'] = time();
			$data['regip'] = $ip;
			if($uid = M('Member')->data($data)->add()){
				$Points = D('PointsLog');
				$Points->points_add($uid,C('POINTS_REG'),'add','会员注册','register');
				$data2['info'] = '注册成功';
				$data2['status'] = 'y';
				//$data2['url'] = U('Index/index');
				echo json_encode($data2);
			}
		}else{
			$this->display();
		}
    }
	public function login($log = '', $pwd = ''){
		if(IS_POST){
			if($log==''){
				$data['info'] = '用户名不能为空';
				$data['status'] = 'n';
				echo json_encode($data);
			}
			if($pwd==''){
				$data['info'] = '密码不能为空';
				$data['status'] = 'n';
				echo json_encode($data);
			}
			$map['username'] = $log;
			$map['email'] = $log;
			$map['mobile'] = $log;
			$map['_logic'] = 'OR';
			$info = M('Member')->where($map)->find();
			if(!empty($info)){
				if(yunwan_user_md5($pwd) != $info['password']){
					$data['info'] = '密码错误';
					$data['status'] = 'n';
					echo json_encode($data);
				}
				$Points = D('PointsLog');
				if($Points->is_points($info['uid'],'login')){
					$Points->points_add($info['uid'],C('POINTS_LOGIN'),'add','会员登陆','login');
				}
				 /* 更新登录信息 */
				$data = array(
					'uid'             => $info['uid'],
					'login'           => array('exp', '`login`+1'),
					'last_login_time' => NOW_TIME,
					'last_login_ip'   => get_client_ip(),
				);
				M('Member')->save($data);
				$auth = array(
					'uid'             => $info['uid'],
					'username'        => $info['username'],
					'moduleid'        => $info['moduleid'],
					'last_login_time' => $user['last_login_time'],
					'last_login_ip' => $user['last_login_ip'],
				);
				session('member_auth', $auth);
				session('member_auth_sign', data_auth_sign($auth));
				$data['info'] = '登录成功！';
				$data['status'] = 'y';
				echo json_encode($data);
			}else{
				$data['info'] = '用户不存在';
				$data['status'] = 'n';
				echo json_encode($data);
			}
		}else{			
			$this->display();
		}
	}
	public function logout(){
		if(is_login()){
			session('member_auth', null);
			session('member_auth_sign', null);
			header("location:".U('Index/index'));
			//$this->success('退出成功！', U('User/login'));
		} else {
			$this->redirect('Index/index');
		}
	}
	public function ajax(){
		$type = I('post.name');
		$param = I('post.param');
		if($type=='username'){
			$where['username'] = $param; 
		}
		if($type=='email'){
			$where['email'] = $param; 
		}
		if($type=='mobile'){
			$where['mobile'] = $param; 
		}
		$member = M('Member')->where($where)->find();
		if(!$member){
			echo 'y';
		}else{
			if($type=='username'){
				echo '用户名已存在';
			}
			if($type=='email'){
				echo '邮箱已存在';
			}
			if($type=='mobile'){
				echo '手机已存在';
			}
		}
	}
	/**
     * 收藏内容
     * @author 劉尐备丶<lxb9812@vip.qq.com>
     */
	public function shoucang(){
		   $data['uid'] =   session('member_auth.uid');
		$Attention=M('Attention');
		$lists = $Attention->where($data)->select();
		foreach ($lists as $value) {
			
			$arr['id']=$value['id'];
		    $Article =   M('Article');
			$list[$value['id']]= $Article->where($arr)->find();
			} 
			$this->assign('list',$list);
		    $this->display();
	}
	/**
     * 订单内容
     * @author 劉尐备丶<lxb9812@vip.qq.com>
     */
	public function dd(){
			$data['uid'] =   session('member_auth.uid');
			$Order=M('Order');
			$list = $Order->where($data)->select();
			int_to_string($list,
				array(
				'order_state'=>array(0=>'订单取消',10=>'未付款',20=>'已付款',30=>'已发货',40=>'已收货'),
				)
			);
			$this->assign('list',$list);
			$this->display();
	}
	/**
     * 收货
     * @author 劉尐备丶<lxb9812@vip.qq.com>
     */
	public function goods(){
			$data['order_state']=40;
			$Order=M('Order');
			$id=I('get.id');
			if($Order->where("id=$id")->save($data)){
				$this->success('您已收货，欢迎下次购物');
			}
	}
					/**
     * 删除订单
     * @author 劉尐备丶<lxb9812@vip.qq.com>
     */
	public function del(){
		$id=I('get.id');
		$Order=M('Order');
		if($Order->where("id=$id")->delete()){
			$this->success('删除成功');
		}
	
	}
	/**
     * 积分管理 明细
     * @author 劉尐备丶<lxb9812@vip.qq.com>
     */
	public function integral(){
		$id =   session('member_auth.uid');
		$list = M('PointsLog')->where("pl_memberid=$id")->order('pl_id desc')->select();
		
		
		int_to_string($list,
			array('pl_stage'=>array('login'=>'会员登录','register'=>'注册','articleadd'=>'发表文章','articledel'=>'删除文章','point'=>'购买产品')
			)
		);
		$this->assign('list',$list);
		$this->display();
	}
	 
	
}