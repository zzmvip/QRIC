<?php
namespace Home\Controller;

class IndexController extends HomeController {
	protected function _initialize(){
        parent::_initialize();
    }
    public function index(){

		
        $this->display();
    }
	public function json_area_show($area_id="1"){
		$info = M('Area')->where(array('area_id'=>$area_id))->find();
		if(!empty($info)){
			$area['text'] = $info['area_name'];
		}else{
			$area['text'] = null;
		}
		echo json_encode($area);
	}
	public function json_area(){
		$lists = M('Area')->where(array('area_parent_id'=>0))->select();
		foreach($lists as $key=>$val){
			$list[$val['area_parent_id']][] = array($val['area_id'],$val['area_name']);
			$lists2 = M('Area')->where(array('area_parent_id'=>$val['area_id']))->select();
			foreach($lists2 as $val2){
				$list[$val2['area_parent_id']][] = array($val2['area_id'],$val2['area_name']);
				$lists3 = M('Area')->where(array('area_parent_id'=>$val2['area_id']))->select();
				foreach($lists3 as $val3){
					$list[$val3['area_parent_id']][] = array($val3['area_id'],$val3['area_name']);
				}
			}
		}
		$json_area =  json_encode($list);
		echo I('callback').'('.$json_area.')';
	}
	public function city(){
		session('cityen',I('get.cityen'));
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}
}