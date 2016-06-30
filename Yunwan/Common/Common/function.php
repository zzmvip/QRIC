<?php
/**
 * 云湾信科
 *
 * @Author     劉尐备丶<lxb9812@vip.qq.com>
 * @Copyright  Copyright (c) 2013-2016 YunWanXinKe Inc. (http://www.yunwanxinke.com)
 * @Link       http://www.yunwanxinke.com/
 */

/**
 * 系统公共库文件
 * 主要定义系统公共函数库lxb9812@vip.qq.com
 */
const CPURL = '';
const YUNWAN_APPNAME    = 'QRIC商城系统';  //产品名称
const YUNWAN_BUILD    = '20160630';  //产品流水号
const YUNWAN_VERSION    = '0.1.0';//产品版本号
cp();
/**
 * 时间戳格式化
 * @param int $time
 * @return string 完整的时间显示
 * @author     劉尐备丶<lxb9812@vip.qq.com>
 */
function time_format($time = NULL,$format='Y-m-d H:i:s'){
    $time = $time === NULL ? NOW_TIME : intval($time);
    return date($format, $time);
}
/**
 * 字符串截取，支持中文和其他编码
 * @static
 * @access public
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $charset 编码格式
 * @param string $suffix 截断显示字符
 * @return string
 */
function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true) {
    if(function_exists("mb_substr"))
        $slice = mb_substr($str, $start, $length, $charset);
    elseif(function_exists('iconv_substr')) {
        $slice = iconv_substr($str,$start,$length,$charset);
        if(false === $slice) {
            $slice = '';
        }
    }else{
        $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("",array_slice($match[0], $start, $length));
    }
	if(mb_strlen($str)/3 > $length){
		return $suffix ? $slice.'...' : $slice;
	}else{
		return $slice;
	}
    
}
/**
 * 调用广告
 
 */
function Advs($id,$label,$class){
	
	$where['id'] = $id;
	$where['status']=1;
	$list = M('Advertising')->where($where)->find();
	if(!empty($list)){
		$search['position']=$id;
		$search['status']=1;
		$search['cityen']= session('cityen');
		switch ($list['type']) {
		    case "0"://单图
				$lists = M('Advs')->where($search)->find();
				$img = '<a href="'.$list['link'].'"><img style="height:'.$list['height'].';width:100%" src="'.C('ADVS_UPLOAD.rootPath').$lists['advspic'].'"></a>';
			break;
			case "1"://多图随机
				$lists = M('Advs')->where($search)->select();
				$lists=array_rand($lists,1);
				$img = '<a href="'.$list['link'].'"><img style="height:'.$list['height'].'" src="'.C('ADVS_UPLOAD.rootPath').$lists['advspic'].'"></a>';
				
			break;
			case "2"://幻灯
				$advarr = M('Advs')->where($search)->select();
				$img = '<div class="banner ad_'.$id.' w pr" style="height:'.$list['height'].'">'."\n\r";
				$img .= '<ul class="banner-pic  ad_pic_'.$id.'">'."\n\r";
				foreach($advarr as $key=>$val){
					///$img[$key]['advspic'] = C('ADVS_UPLOAD.rootPath').$val['advspic'];
					$img .= '<li style="background-image:url('.C('ADVS_UPLOAD.rootPath').$val[advspic].');background-size:cover;backgroun-position:center center;background-repeat:no-repeat;height:'.$list['height'].'"><a style="height:'.$list['height'].'" href="'.$val['link'].'"></a></li>'."\n\r";
				}	
				$img .= '</ul>'."\n\r";
				
				$img .= '<div class="slider-page">'."\n\r";
				$img .= '	<a class="prev" href="javascript:void(0)">&lt;</a>'."\n\r";
				$img .= '	<a class="next" href="javascript:void(0)">&gt;</a>'."\n\r";
				$img .= '</div>'."\n\r";
				$img .= '<div class="num">'."\n\r";
				$img .= '	<ul></ul>'."\n\r";
				$img .= '</div>'."\n\r";
				$img .= '<script>'."\n\r";
					$img .= '$(".ad_'.$id.'").hover(function(){'."\n\r";
					$img .= '	$(this).find(".prev,.next").fadeTo("show",0.1);'."\n\r";
					$img .= '},function(){'."\n\r";
					$img .= '	$(this).find(".prev,.next").hide();'."\n\r";
					$img .= '})'."\n\r";
					$img .= '$(".prev,.next").hover(function(){'."\n\r";
					$img .= '	$(this).fadeTo("show",0.7);'."\n\r";
					$img .= '},function(){'."\n\r";
					$img .= '	$(this).fadeTo("show",0.1);'."\n\r";
					$img .= '})'."\n\r";
					$img .= '$(".ad_'.$id.'").slide({titCell:".num ul" ,mainCell:".ad_pic_'.$id.'",autoPage:true,effect:"fold",autoPlay:true,trigger:"click"});'."\n\r";
				$img .= '</script>'."\n\r";
				$img .= '</div>'."\n\r";
			break;
			 case "3"://文字广告
				$advarr = M('Advs')->where($search)->select();
				foreach($advarr as $key=>$val){
					$img .= "<".$label." class='".$class."'>";
					$img .= "<a href='".$val['link']."'>".$val['title']."</a>";
					$img .= "</".$label.">";
					
				}
		}
	}else{
		return false;
	}
	if(!empty($img)){
		return $img;
	}else{
		return false;
		
	}
}

	
		
	



/**
 * 数据签名认证
 * @param  array  $data 被认证的数据
 * @return string       签名
 * @author     劉尐备丶<lxb9812@vip.qq.com>
 */
function data_auth_sign($data) {
    //数据类型检测
    if(!is_array($data)){
        $data = (array)$data;
    }
    ksort($data); //排序
    $code = http_build_query($data); //url编码并生成query字符串
    $sign = sha1($code); //生成签名
    return $sign;
}
/**
 * 构建form表单
 * @author     劉尐备丶<lxb9812@vip.qq.com>
 */
function form_input($formtype,$field,$value) {
	switch ($formtype){
		case "text":
		  $input = '<input type="text" value="'.$value.'" name="'.$field.'" id="'.$field.'" class="input-txt">';
		  break;
		case "password":
		  $input = '<input type="password" value="'.$value.'" name="'.$field.'" id="'.$field.'" class="input-txt">';
		  break;
		case "textarea":
		  $input = '<textarea name="'.$field.'" rows="6" class="tarea" id="'.$field.'">'.$value.'</textarea>';
		  break;
		case "editor":
		  $input = editorforadmin($field,$value);
		  break;
		case "image":
		  $input  = '<div class="input-file-show">';
		if($value){
		  $input .=   '<span class="show">';
		  $input .=     '<a class="nyroModal" rel="gal" href="'.C('ARTICLE_UPLOAD.rootPath').$value.'"> <i class="fa fa-picture-o" onMouseOver="toolTip(\'<img src='.C('ARTICLE_UPLOAD.rootPath').$value.'>\')" onMouseOut="toolTip()"/></i> </a>';
		  $input .=   '</span>';
		}
		  $input .=   '<span class="type-file-box">';
		  $input .=     '<input type="text" name="textfield" id="textfield'.$field.'" class="type-file-text" />';
		  $input .=     '<input type="button" name="button" id="button'.$field.'" value="选择上传..." class="type-file-button" />';
		  $input .=     '<input class="type-file-file" id="'.$field.'" name="'.$field.'" type="file" size="30" hidefocus="true" nc_type="change_'.$field.'" title="点击前方预览图可查看大图，点击按钮选择文件并提交表单后上传生效">';
		  $input .=   '</span>';
		  $input .= '</div>';
		  break;
		case "number":
		  $value = $value ? $value : 0;
		  $input = '<input type="text" value="'.$value.'" name="'.$field.'" id="'.$field.'" class="input-txt">';
		  break;
		case "open":
		  $input = '';//待完善
		  break;
		case "datetime":
		  $input = '';//待完善
		  break;
		case "map":
		   $input.='<link rel="stylesheet" href="'.C('TMPL_PARSE_STRING.__JS__').'/ui-dialog.css">';
		   $input.='<script type="text/javascript" src="'.C('TMPL_PARSE_STRING.__JS__').'/dialog-min.js"></script>';
		   $input.='<script type="text/javascript" src="'.C('TMPL_PARSE_STRING.__JS__').'/dialog-plus-min.js"></script>';
		   $input.='<script type="text/javascript" src="'.C('TMPL_PARSE_STRING.__JS__').'/dw.js"></script>';
		   $input.="<div class='controls' style='background: aliceblue;padding: 10px;'>";
		   $input.= "<style>
        .search-result {
            width: 239px;
            max-height: 565px;
            overflow-y: auto;
        }

        .tangram-suggestion-main {
            z-index: 9999;
        }
    </style>";
	
		   $input .= '<input type="map" value="'.$value.'" name="'.$field.' qq" id="'.$field.'_input_qq" class="input-txt text input-large">';
		   $input.=' <a id="map_box_qq_a">定位 </a>';
		   $input.='</div>';
		 
		  break;
		default:
	}
    return $input;
}
/**
 * 后台编辑器
 * @author     劉尐备丶<lxb9812@vip.qq.com>
 */
function editorforadmin($field,$value) {
	$editor = '<textarea name="'.$field.'">'.$value.'</textarea>';
	$editor .= '<link rel="stylesheet" href="'.C('TMPL_PARSE_STRING.__STATIC__').'/kindeditor/default/default.css" />';
	$editor .= '<script charset="utf-8" src="'.C('TMPL_PARSE_STRING.__STATIC__').'/kindeditor/kindeditor-min.js"></script>';
	$editor .= '<script charset="utf-8" src="'.C('TMPL_PARSE_STRING.__STATIC__').'/kindeditor/zh_CN.js"></script>';
	$editor .= '<script type="text/javascript">';
	$editor .= 'var editor_'.$field.';';
	$editor .= 'KindEditor.ready(function(K) {';
	$editor .= 'editor_'.$field.' = K.create(\'textarea[name="'.$field.'"]\', {';
	$editor .= 'allowFileManager : false,';
	$editor .= 'themesPath: K.basePath,';
	$editor .= 'width: "100%",';
	$editor .= 'height: "300",';
	$editor .= 'resizeType: 1,';
	$editor .= 'pasteType : 2,';
	$editor .= 'urlType : "absolute",';
	//$editor .= 'fileManagerJson : \'{:U(\'fileManagerJson\')}\',';
	//$editor .= '//uploadJson : \'{:U(\'uploadJson\')}\' }';
	$editor .= 'uploadJson : \'/admin.php?s=/Article/ke_upimg.html\',';
	$editor .= 'extraFileUploadParams: {';
	$editor .= 'session_id : "'.session_id().'"';
	$editor .= '}';
	$editor .= '});';
	$editor .= '});';

	$editor .= '$(function(){';
					//传统表单提交同步
	$editor .= '$("#submitBtn").click(function(){';
	$editor .= 'editor_'.$field.'.sync();';
	$editor .= '});';
	$editor .= '$("body").mouseover(function(){';
	$editor .= 'editor_'.$field.'.sync();';
	$editor .= '});';
					//ajax提交之前同步
	//$editor .= '$(\'button[type="submit"],#submit,.ajax-post,#autoSave\').click(function(){';
	//$editor .= 'editor_'.$field.'.sync();';
	//$editor .= '});';
	$editor .= '})';
	$editor .= '</script>';
    return $editor;
}


/**
 * 把返回的数据集转换成Tree
 * @param array $list 要转换的数据集
 * @param string $pid parent标记字段
 * @param string $level level标记字段
 * @return array
 * @author     劉尐备丶<lxb9812@vip.qq.com>
 */
function list_to_tree($list, $pk='id', $pid = 'pid', $child = '_child', $root = 0) {
    // 创建Tree
    $tree = array();
    if(is_array($list)) {
        // 创建基于主键的数组引用
        $refer = array();
        foreach ($list as $key => $data) {
            $refer[$data[$pk]] =& $list[$key];
        }
        foreach ($list as $key => $data) {
            // 判断是否存在parent
            $parentId =  $data[$pid];
            if ($root == $parentId) {
                $tree[] =& $list[$key];
            }else{
                if (isset($refer[$parentId])) {
                    $parent =& $refer[$parentId];
                    $parent[$child][] =& $list[$key];
                }
            }
        }
    }
    return $tree;
}

/**
 * 调用系统的API接口方法（静态方法）
 * api('User/getName','id=5'); 调用公共模块的User接口的getName方法
 * api('Admin/User/getName','id=5');  调用Admin模块的User接口
 * @param  string  $name 格式 [模块名]/接口名/方法名
 * @param  array|string  $vars 参数
 * @author     劉尐备丶<lxb9812@vip.qq.com>
 */
function api($name,$vars=array()){
	
    $array     = explode('/',$name);
    $method    = array_pop($array);
    $classname = array_pop($array);
    $module    = $array? array_pop($array) : 'Common';
    $callback  = $module.'\\Api\\'.$classname.'Api::'.$method;
    if(is_string($vars)) {
        parse_str($vars,$vars);
    }
    return call_user_func_array($callback,$vars);
}
/**
 * 获取用户组名称
 * @return array 数组
 * @author     劉尐备丶<lxb9812@vip.qq.com>
 */
function usergroup($uid){
	$group_access   = M('Auth_group_access')->where(array('uid'=>$uid))->find();
	if($group_access && is_array($group_access)){
		$usergroup = M('Auth_group')->where(array('id'=>$group_access['group_id']))->find();
	}
	return $usergroup['title'];
}
/*手机号码验证*/
function _checkmobile($mobilephone=''){
	if(strlen($mobilephone)!=11){	return false;	}
	if(preg_match("/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|14[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$|17[0-9]{1}[0-9]{8}$/",$mobilephone)){   
		return true;
	}else{   
		return false;
	}
}
	
/*邮箱验证*/
function _checkemail($email=''){
		if(mb_strlen($email)<5){
			return false;
		}
		$res="/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/";
		if(preg_match($res,$email)){
			return true;
		}else{
			return false;
		}
}	
/**
 * 检测验证码
 * @param  integer $id 验证码ID
 * @return boolean     检测结果
 * @author     劉尐备丶<lxb9812@vip.qq.com>
 */
function check_verify($code, $id = 1){
    $verify = new \Think\Verify();
	$verify->__set('seKey','SunYuNet');
    return $verify->check($code, $id);
}
/**
 * 系统非常规MD5加密方法
 * @param  string $str 要加密的字符串
 * @return string 
 * @author     劉尐备丶<lxb9812@vip.qq.com>
 */
function yunwan_user_md5($str, $key = 'SunYuNet'){
	return '' === $str ? '' : md5(sha1($str) . $key);
}
/**
 * 系统邮件发送函数
 * @param string $to 接收邮件者邮箱 
 * @param string $name 接收邮件者名称 
 * @param string $subject 邮件主题 
 * @param string $body 邮件内容 
 * @author     劉尐备丶<lxb9812@vip.qq.com>
 */
function send_mail($to = '', $subject = '', $body = '', $name = ''){ 
	$from_email = C('EMAIL_ID');
	$from_name = C('WEB_SITE_TITLE');
	import('Org.PHPMailer.phpmailer');//从PHPMailer目录导入phpmailer.class.php类文件
	$mail             = new PHPMailer; //实例化PHPMailer
	$mail->CharSet    = 'UTF-8'; //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
	$mail->IsSMTP();  // 设定使用SMTP服务
	$mail->SMTPDebug  = 0;                     // 关闭SMTP调试功能
	$mail->SMTPAuth   = true;                  // 启用 SMTP 验证功能
	$mail->Host       = C('EMAIL_HOST');  // SMTP 服务器
	$mail->Port       = C('EMAIL_PORT');  // SMTP服务器的端口号
	$mail->Username   = C('EMAIL_ID');  // SMTP服务器用户名
	$mail->Password   = C('EMAIL_PASS');  // SMTP服务器密码
	$mail->SetFrom($from_email, $from_name);
	if($to == ''){
		return false;
	}
	if($name == ''){
		$name = C('WEB_SITE_TITLE');//发送者名称为空时，默认使用网站名称
	}
	if($subject == ''){
		$subject = C('WEB_SITE_TITLE');//邮件主题为空时，默认使用网站标题
	}
	if($body == ''){
		$body = C('WEB_SITE_TITLE');//邮件内容为空时，默认使用网站标题
	}
	$mail->Subject    = $subject;
	$mail->MsgHTML($body);//解析
	$mail->AddAddress($to, $name);
	return $mail->Send() ? true : $mail->ErrorInfo;//返回错误信息
}
/**
 * 根据用户ID获取用户名
 * @param  integer $uid 用户ID
 * @return string       用户名
 */
function get_username($uid = 0){
    if(!($uid && is_numeric($uid))){ //获取当前登录用户名
        return session('member_auth.username');
    }
    return $name;
}
/**
 * 根据用户ID获取用户头像
 * @param  integer $uid 用户ID
 * @return string       用户头像
 */
function get_userphoto($uid = 0,$size='8080'){
    static $list;
    if(!($uid && is_numeric($uid))){ //获取当前登录用户名
       $uid = session('user_auth.uid');
    }
    /* 查找用户信息 */
	$info = M('Member')->field('avatar')->find($uid);
	 if($info !== false && $info['avatar'] ){
		$img = img($info['avatar']);
		$pic = $info['avatar'].'_'.$size.'.'.$img;
	} else {
		$pic = 'member.gif';
	}
    
    return C('MEMBER_UPLOAD.rootPath').$pic;
}
/**
 * 根据用户ID发布人名称
 */
function article_add_user($uid = 0,$addtype='1'){
    if($addtype=='1'){
		$userinfo = M('Admin')->where(array('uid'=>$uid))->find();
	}else{
		$userinfo = M('Member')->where(array('uid'=>$uid))->find();
	}
    return $userinfo['username'];
}
/**
 * 根据栏目ID获取文章所属栏目
 */
function article_add_class($catid){
	$articleclass = M('Article_class')->where(array('id'=>$catid))->find();

    return $articleclass['title'];
}
/**
 * 根据栏目ID获取产品所属栏目
 */
function category_add_class($pid){
	if($pid==0) return '顶级分类';
	$categoryclass = M('Category')->where(array('id'=>$pid))->find();
	
    return $categoryclass['name'];
}
/**
 * 根据栏目ID获取产品所属分类
 */
function product_add_class($cid){
	
	$categoryclass = M('Category')->where(array('id'=>$cid))->find();
	
    return $categoryclass['name'];
}
/**
 * 根据栏目ID获取产品所属品牌
 */
function products_add_class($bid){
	
	$categoryclass = M('Brand')->where(array('id'=>$bid))->find();
	
    return $categoryclass['name'];
}
/**
 * 合法性验证
 * @author     劉尐备丶<lxb9812@vip.qq.com>
 */
function cp(){
	if (CPURL == '') return;
	if ($_SERVER['HTTP_HOST'] == 'localhost') return;
	if ($_SERVER['HTTP_HOST'] == '127.0.0.1') return;
	if (strpos(CPURL,'||') !== false){
		$a = explode('||',CPURL);
		foreach ($a as $v) {
			$d = strtolower(stristr($_SERVER['HTTP_HOST'],$v));
			if ($d == strtolower($v)){
				return;
			}else{
				continue;
			}
		}
		header('location: http://www.yunwanxinke.com');exit();
	}else{
		$d = strtolower(stristr($_SERVER['HTTP_HOST'],CPURL));
		if ($d != strtolower(CPURL)){
			header('location: http://www.yunwanxinke.com');exit();
		}
	}
}
/**
 * 关注功能
 * @author     劉尐备丶<lxb9812@vip.qq.com>
 */
function gz($id){
		
		$data['id']=$id;
		$Attention=M('Attention');
		$result = $Attention->where($data)->count();
		
        if($result){
			return $result;
		}else{
			return 0;
		}		
	}