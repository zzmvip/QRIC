<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<title><?php echo C('WEB_SITE_TITLE');?> - <?php echo (YUNWAN_APPNAME); ?>.</title>
<link href="/Static/Admin/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css">
<link href="/Static/Admin/css/index.css" rel="stylesheet" type="text/css">
<link href="/Static/public/font-awesome/font-awesome.min.css" rel="stylesheet">
<script type="text/javascript">
var ADMIN_SITE_URL = '<?php echo C("WEB_PATH");?>/admin.php';
var ADMIN_IMG_URL = '/Static/Admin/images';
var ADMIN_CSS_URL = '/Static/Admin/css';
var ADMIN_JS_URL = '/Static/Admin/js';
var PUBLIC_STATIC_URL = '/Static/public';
var SITEURL = '<?php echo C("WEB_PATH");?>/admin.php';
</script>
<script src="/Static/public/js/jquery-v1.8.3.min.js" type="text/javascript"></script>
<script src="/Static/Admin/js/common.js" type="text/javascript"></script>
<script type="text/javascript" src="/Static/public/js/dialog/dialog.js" id="dialog_js" charset="utf-8"></script>
<script type="text/javascript" src="/Static/Admin/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="/Static/public/js/jquery.cookie.js"></script>
<script type="text/javascript" src="/Static/Admin/js/jquery.bgColorSelector.js"></script>
<script type="text/javascript" src="/Static/Admin/js/admincp.js"></script>
<script type="text/javascript" src="/Static/public/js/ajaxfileupload.js"></script>
<script type="text/javascript" src="/Static/public/js/jquery.Jcrop/jquery.Jcrop.js" id="cssfile2"></script>
<link href="/Static/public/js/jquery.Jcrop/jquery.Jcrop.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="admincp-map ui-widget-content" nctype="map_nav" style="display:none;" id="draggable" >
  <div class="title ui-widget-header" >
    <h3>管理中心全部菜单</h3>
    <h5>切换显示全部管理菜单，通过点击勾选可添加菜单为管理常用操作项，最多添加10个</h5>
    <span><a nctype="map_off" href="JavaScript:void(0);">X</a></span>
  </div>
  <div class="content">
    <ul class="admincp-map-nav">
	  <?php if(is_array($__MENU__["main"])): $i = 0; $__LIST__ = $__MENU__["main"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li><a href="javascript:void(0);" data-param="map-<?php echo ($menu["dataparam"]); ?>"><?php echo ($menu["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
	</ul>
	<?php if(is_array($__MENU__["child"])): foreach($__MENU__["child"] as $key=>$sub_menu): ?><div class="admincp-map-div" data-param="map-<?php echo ($key); ?>">
	  <?php if(is_array($sub_menu)): foreach($sub_menu as $k=>$menus): ?><dl>
	    <dt><?php echo ($k); ?></dt>
		<?php if(is_array($menus)): foreach($menus as $k2=>$menu): if($menu != $sub_menu["group"] ): ?><dd <?php if(in_array($key.'/'.$menu['url'],$quicklink)): ?>class="selected"<?php endif; ?>><a href="javascript:void(0);" data-param="<?php echo ($key); ?>/<?php echo ($menu["url"]); ?>"><?php echo ($menu["title"]); ?></a><i class="fa fa-check-square-o"></i></dd><?php endif; endforeach; endif; ?>
      </dl><?php endforeach; endif; ?>
	</div><?php endforeach; endif; ?>
  </div>
<script>
//固定层移动
$(function(){
	//管理显示与隐藏
	$("#admin-manager-btn").click(function () {
		if ($(".manager-menu").css("display") == "none") {
			$(".manager-menu").css('display', 'block'); 
			$("#admin-manager-btn").attr("title","关闭快捷管理"); 
			$("#admin-manager-btn").removeClass().addClass("arrow-close");
		}
		else {
			$(".manager-menu").css('display', 'none');
			$("#admin-manager-btn").attr("title","显示快捷管理");
			$("#admin-manager-btn").removeClass().addClass("arrow");
		}           
	});
	$("#draggable").draggable({
		handle: "div.title"
	});
	$("div.title").disableSelection()

	$('#_pic').change(uploadChange);
	function uploadChange(){
		var filepatd=$(this).val();
		var extStart=filepatd.lastIndexOf(".");
		var ext=filepatd.substring(extStart,filepatd.lengtd).toUpperCase();		
		if(ext!=".PNG"&&ext!=".GIF"&&ext!=".JPG"&&ext!=".JPEG"){
			alert("file type error");
			$(this).attr('value','');
			return false;
		}
		if ($(this).val() == '') return false;
		ajaxFileUpload();
	}
	function ajaxFileUpload()
	{
		$.ajaxFileUpload
		(
			{
				url:'<?php echo U("User/avatar");?>',
				secureuri:false,
				fileElementId:'_pic',
				dataType: 'json',
				success: function (data, status)
				{
					if (data.status == 1){
						ajax_form('cutpic','裁剪','<?php echo U("User/avatar_cut");?>&x=100&y=100&resize=1&ratio=1&url='+data.url,690);
					}else{
						alert(data.msg);
					}
					$('#_pic').bind('change',uploadChange);
				},
				error: function (data, status, e)
				{
					alert('上传失败');
					$('#_pic').bind('change',uploadChange);
				}
			}
		)
	};
});
//裁剪图片后返回接收函数
function call_back(picname){
    $.getJSON('index.php?act=index&op=save_avatar&avatar=' + picname, function(data){
        if (data) {
            $('img[nctype="admin_avatar"]').attr('src', 'upload/admin/avatar/' + picname);
        }
    });
}
</script> 
</div>
<div class="admincp-header">
  <div class="bgSelector"></div>
  <div id="foldSidebar"><i class="fa fa-outdent " title="展开/收起侧边导航"></i></div>
  <div class="admincp-name">
    <h1><?php echo C('WEB_SITE_TITLE');?></h1>
    <h2><?php echo (YUNWAN_APPNAME); ?></h2>
  </div>
  <div class="nc-module-menu">
    <ul class="nc-row">
	  <?php if(is_array($__MENU__["main"])): $i = 0; $__LIST__ = $__MENU__["main"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li data-param="<?php echo ($menu["dataparam"]); ?>"><a href="javascript:void(0);"><?php echo ($menu["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
  </div>
  <div class="admincp-header-r">
    <div class="manager">
      <dl>
        <dt class="name"><?php echo session('admin_auth.username');?></dt>
		<?php if($vo["uid"] == C('USER_ADMINISTRATOR') ): ?><dd class="group"><?php echo usergroup(session('admin_auth.uid'));?></dd>
		<?php else: ?>
		<dd class="group">系统管理员</dd><?php endif; ?>
      </dl>
      <span class="avatar">
        <input name="_pic" type="file" class="admin-avatar-file" id="_pic" title="设置管理员头像"/>
        <img alt="" nctype="admin_avatar" src="/Static/Admin/images/login/admin.png">
	  </span>
	  <i class="arrow" id="admin-manager-btn" title="显示快捷管理菜单"></i>
      <div class="manager-menu">
        <div class="title">
          <h4>最后登录</h4>
          <a href="javascript:void(0);" onclick='CUR_DIALOG = ajax_form("modifypw", "修改密码", "<?php echo U("User/modifypw");?>");' class="edit-password">修改密码</a>
		</div>
        <div class="login-date">
          <?php echo time_format(session('admin_auth.last_login_time'));?> <span>(IP:<?php echo session('admin_auth.last_login_ip');?>)</span>
		</div>
        <div class="title">
          <h4>常用操作</h4>
          <a href="javascript:void(0)" class="add-menu">添加菜单</a> </div>
          <ul class="nc-row" nctype="quick_link">
			<?php if(is_array($__MENU__["child"])): foreach($__MENU__["child"] as $key=>$sub_menu): if(is_array($sub_menu)): foreach($sub_menu as $k=>$menus): if(is_array($menus)): foreach($menus as $k2=>$menu): if($menu != $sub_menu["group"] ): if(in_array($key.'/'.$menu['url'],$quicklink)): ?><li><a href="javascript:void(0);" onclick="openItem('<?php echo ($key); ?>/<?php echo ($menu["url"]); ?>')"><?php echo ($menu["title"]); ?></a></li><?php endif; endif; endforeach; endif; endforeach; endif; endforeach; endif; ?>
          </ul>
        </div>
    </div>
    <ul class="operate nc-row">
      <!--<li nctype="pending_matters">
	    <a class="toast show-option" href="javascript:void(0);" onclick="$.cookie('commonPendingMatters', 0, {expires : -1});ajax_form('pending_matters', '待处理事项', 'index.php?act=common&op=pending_matters', '480');" title="查看待处理事项">&nbsp;<em>1</em></a>
	  </li>-->
      <li><a class="sitemap show-option" nctype="map_on" href="javascript:void(0);" title="查看全部管理菜单">&nbsp;</a></li>
      <li><a class="style-color show-option" id="trace_show" href="javascript:void(0);" title="给管理中心换个颜色">&nbsp;</a></li>
      <li><a class="homepage show-option" target="_blank" href="index.php?s=Index/index.html" title="新窗口打开首页">&nbsp;</a></li>
      <li><a class="login-out show-option" href="<?php echo U('Public/logout');?>" title="安全退出管理中心">&nbsp;</a></li>
    </ul>
  </div>
  <div class="clear"></div>
</div>
<div class="admincp-container unfold">
  <div class="admincp-container-left">
    <div class="top-border">
	  <span class="nav-side"></span><span class="sub-side"></span>
	</div>
	<?php if(is_array($__MENU__["child"])): foreach($__MENU__["child"] as $key=>$sub_menu): ?><div id="admincpNavTabs_<?php echo ($key); ?>" class="nav-tabs">
	  <?php if(is_array($sub_menu)): foreach($sub_menu as $k=>$menus): ?><dl>
	    <dt><a href="javascript:void(0);"><span class="ico-system-0"></span><h3><?php echo ($k); ?></h3></a></dt>
		<dd class="sub-menu">
		  <ul>
		    <?php if(is_array($menus)): foreach($menus as $k2=>$menu): if($menu != $sub_menu["group"] ): ?><li><a href="javascript:void(0);" data-param="<?php echo ($key); ?>/<?php echo ($menu["url"]); ?>"><?php echo ($menu["title"]); ?></a></li><?php endif; endforeach; endif; ?>
		  </ul>
		</dd>
	  </dl><?php endforeach; endif; ?>
	</div><?php endforeach; endif; ?>
	<div class="about" title="关于QRIC" onclick="ajax_form('about', '', '<?php echo U('Public/aboutus');?>', 640);"><i class="fa fa-copyright"></i><span>QRIC</span></div>
  </div>
  <div class="admincp-container-right">
    <div class="top-border"></div>
    <iframe src="" id="workspace" name="workspace" style="overflow: visible;" frameborder="0" width="100%" height="94%" scrolling="yes" onload="window.parent"></iframe>
  </div>
</div>
</body>
</html>