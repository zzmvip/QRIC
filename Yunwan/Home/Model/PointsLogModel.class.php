<?php
/**
 * 云湾信科
 *
 * @Author     劉尐备丶<lxb9812@vip.qq.com>
 * @Copyright  Copyright (c) 2013-2016 YunWanXinKe Inc. (http://www.yunwanxinke.com)
 * @Link       http://www.yunwanxinke.com/
 */
namespace Home\Model;
use Common\Model\Model;
/**
 * 积分模型
 * @Author     劉尐备丶<lxb9812@vip.qq.com>
 */

class PointsLogModel extends Model {
    /**
     * 增减会员积分
	 * @Author     劉尐备丶<lxb9812@vip.qq.com>
     */
    public function points_add($uid='',$points='0',$type='add',$info='',$stage='',$adminid=''){
		if($type == 'add'){
			M('Member')->where(array('uid'=>$uid))->setInc("points",$points);
			$data['pl_points']    = $points;
		}
		if($type == 'del'){
			M('Member')->where(array('uid'=>$uid))->setDec("points",$points);
			$data['pl_points']    = '-'.$points;
		}
		$data['pl_memberid']  = $uid;
		$data['pl_adminid'] = $adminid;
		
		$data['pl_addtime']   = time();
		$data['pl_desc']      = $info;
		$data['pl_stage']     = $stage;
        M('Points_log')->data($data)->add();
    }
	/**
     * 判断今日是否已经获得积分
	 * @Author     劉尐备丶<lxb9812@vip.qq.com>
     */
    public function is_points($uid='',$stage=''){
		$sta_time = strtotime(date('Y-m-d',time()));
		$end_time = strtotime(date('Y-m-d',time()))+60*60*24;
		$where['pl_memberid'] = $uid;
		$where['pl_stage']    = $stage;
		$where['pl_addtime']  = array(array('EGT',$sta_time),array('ELT',$end_time,'AND'));
        $p_log = M('Points_log')->where($where)->select();
		if(empty($p_log)){
			return true;
		}else{
			return false;
		}
		
    }


}
