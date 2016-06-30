<?php
namespace Home\Controller;

class ShopController extends HomeController {
	/**
     * 商品
     * @author 劉尐备丶<lxb9812@vip.qq.com>
     */
    public function index(){
		$Product = M('Product');
		$list = $Product->order('id desc')->where('posid=1')->select();
		$this->assign('list',$list);
		$lists = $Product->order('id desc')->where('cid=20')->select();
		$this->assign('lists',$lists);
		$pro = $Product->order('id desc')->where('cid=20 AND posid=1')->select();
		$this->assign('pro',$pro);
        $this->display();
}
/**
     * 商品详细
     * @author 劉尐备丶<lxb9812@vip.qq.com>
     */
public function show($id){
	$Product = M("Product"); // 实例化User对象
	$data['id']=$id;
	$info = $Product->where($data)->find();

	$list = $Product->select();
	
	$info['pic']=json_decode($info['picture']);
	
    $this->assign('info',$info);
	$this->assign('list',$list);
	$this->display();
}
/**
     * 购物车
     * @author 劉尐备丶<lxb9812@vip.qq.com>
     */
public function cart(){
   	$data['number']=I('post.number');
	$number=I('post.number');
	$data['pid']=I('get.id');
	$id=I('get.id');
	$data['uid']=session('member_auth.uid');
	$uid=session('member_auth.uid');
    $Cart = M("Cart");
	$Product = M("Product"); // 实例化Product对象
    if($uid==null){
		$this->error('用户未登录');
	}else{
		if(!empty($id)){
			$rt=$Cart->where("uid=$uid AND pid=$id")->select();
			if($rt!=null){
				$cr = $Cart->where("uid=$uid AND pid=$id")->setInc('number',$number);
				if($cr){
					$this->success('添加购物车成功');
				}
			}else{
				$id=$Cart->data($data)->add();
				if($id){
					$this->success('添加 购物车成功');
				}
			}
		}
		$car=$Cart->where("uid=$uid")->select();
		
		foreach($car as  $key=>$r){
			$list[$key] = $Product->where("id=$r[pid]")->find();
			$list[$key]["number"]=$r["number"];
			$list[$key]['total']=$r["number"]*$list[$key]["integral"];
			$total = $total+$list[$key]['total'];
			$number=$number+$r['number'];
			session('total',$total);  //设置session
		}
	
  
	}
	$this->assign('number',$number);
	$this->assign('total',$total);
	$this->assign('list',$list);
	$this->display();
}
/**
     * 购物车删除
     * @author 劉尐备丶<lxb9812@vip.qq.com>
     */
	 public function del(){
		 $Cart = M("Cart");
		 $id=I('get.id');
		 
		 $del=$Cart->where("pid=$id")->delete(); 
		  if($del){
			  $this->success('删除成功');
		  }
		   $Address = M("Address");
		 $ids=I('get.id');
		 $dels=$Address->where("id=$ids")->delete(); 
		  if($dels){
			  $this->success('删除成功');
		  }
	 }
	 /**
     * 结算
     * @author 劉尐备丶<lxb9812@vip.qq.com>
     */
	 	 public function news(){
			$uid=session('member_auth.uid');
		    if($uid==null){
			$this->error('用户未登录',U("Shop/index"));
			}else{
		   $Address = M("Address"); // 实例化User对象
		   $list = $Address->select();
             $total= session('total');  			   
			$this->assign('list',$list);
			} 
			$this->assign('total',$total);
			$this->display();
	 }
	  /**
     * 地址
     * @author 劉尐备丶<lxb9812@vip.qq.com>
     */
	 	 public function address(){
			 $uid=session('member_auth.uid');
		      if($uid==null){
			$this->error('用户未登录',U("Shop/index"));
			}else{
			  $data=$_POST;
			 $data['address']=$_POST['area_info'];
			 $Address = M("Address"); // 实例化User对象
	        if(empty($data['name'])){
			   $this->error('姓名不能为空');
			 }if(empty($data['phone'])){
				 $this->error('手机号码不能为空');
			 }if(empty($data['address'])){
				 $this->error('收货地址不能为空');
			 }else{
				$add= $Address->add($data);
				if($add){
					$this->success('新增成功');
						}
				 }
			}
			$this->display('news');
	 
	 }
	 /**
     * 积分
     * @author 劉尐备丶<lxb9812@vip.qq.com>
     */
	public function point(){
		$uid=session('member_auth.uid');
		if($uid==null){
			$this->error('用户未登录',U("Shop/index"));
			}else{
		$Cart = M("Cart");
		$Member = M("Member"); 
		$Order = M("Order"); 
		$total=session('total');
		$data['order_state']=10;
		$data['address_id']=$_POST['as'];
		$data['add_time']=time();
		$data['buyer_id']=$uid;
		$data['order_sn']=$this->makeOrderSn($data['address_id']);
		$a=$data["order_sn"];
		$data['goods_amount']=$total;
		
		$points=$Member->where("uid=$uid" )->find();
		
		if(empty($data['address_id'])){
			$this->error('请选择收货地址');
		}
		$list=$Order->where("buyer_id=$uid and order_state='10'" )->select();
		
		
			$count=count($list);
			if($count<=1){
			if($Order->data($data)->add()){
			
			$b=$Order->where("buyer_id=$uid " )->select();
			
		  $Cart->where("uid=$uid")->delete();
					  
		  $this->redirect("Shop/sets/id/$a");
		 }
	     }else{
			 $this->error('您还有订单为处理，请先处理');
		 }
	}
	} 
	 
	 
	 /**
	 * 订单编号生成规则，n(两位随机 + 从2000-01-01 00:00:00 到现在的秒数+微秒+会员ID%1000)
	 * 长度 =2位 + 10位 + 3位 + 3位  = 18位
	 * 1000个会员同一微秒提订单，重复机率为1/100
	 * @return string
	 */
	public function makeOrderSn($member_id) {
		return mt_rand(10,99)
			  . sprintf('%010d',time() - 946656000)
			  . sprintf('%03d', (float) microtime() * 1000)
			  . sprintf('%03d', (int) $member_id % 1000);
	}
					
					
	public function sets() {
		$id=session('member_auth.uid');
		if($id==null){
		$this->error('用户未登录',U("Shop/index"));
	}else{
		  
		  $uid=$_GET['id'];
		 
		  $Order = M("Order"); 
		  $Address = M("Address");
		  $Member = M("Member");
		  $points=$Member->where("uid=$id" )->find();
		  $info=$Order->where("order_sn=$uid" )->find();
		  $id=$info['address_id'];
		  $add=$Address->where("id=$id" )->find();
		  
		  $add['total']=$info['goods_amount'];
		  $add['did']=$info['order_id'];
	}
		  $this->assign('points',$points);
		  $this->assign('info',$info);
		  $this->assign('add',$add);
		  $this->display();
		}
	public function pay() {
		
		$order_sn=I("post.order_sn");
		
		$uid=session('member_auth.uid');
		$total=session('total');
		$Member = M("Member");
		$Order = M("Order"); 					  
		$points=$Member->where("uid=$uid" )->find();
		
				 
		if($uid==null){
			$this->error('用户未登录',U("Shop/index"));
		}else{
				  
				 
				if($points['points']>$total){
					if($Member->where("uid=$uid")->setDec('points',$total)){
						if($Order->where("buyer_id = $uid and order_sn = order_sn")->setField('order_state',20)){
						$Points = D('PointsLog');
						$Points->points_add($uid,$total,'del','购买产品,产品ID：','point');
						
						
						$this->success('购买成功',U('Shop/index'));
						}
				}
				}else{	
					$this->error('积分不足，无法购买');
				}
		}
	}		
		
	/**
public function pay() {
		
		$order_sn=I("post.order_sn");
		$uid=session('member_auth.uid');
		 $Order = M("Order"); 
		$Member = M("Member");
		$total=session('total');
		 $points=$Member->where("uid=$uid" )->find();
		if($uid==null){
			$this->error('用户未登录',U("Shop/index"));
		}else{
			if($points['password']==md5($_POST['password'])){
				  if($points['points']>$total){
					if($Member->where("uid=$uid")->setDec('points',$total)){
						if($Order->where("buyer_id=$uid and order_sn=order_sn")->setField('order_state',20)){
						$Points = D('PointsLog');
						$Points->points_add($uid,$total,'del','购买产品,产品ID：','point');
						$this->success('购买成功',U('Shop/index'));
						}
				}
				}else{	
					$this->error('积分不足，无法购买');
				}
				}else{
					$this->error('密码不正确');
				}
		}
	}
**/		 
}