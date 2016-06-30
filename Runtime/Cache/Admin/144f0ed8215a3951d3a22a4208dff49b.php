<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<link href="/Static/Admin/css/index.css" rel="stylesheet" type="text/css">
<link href="/Static/public/font-awesome/font-awesome.min.css" rel="stylesheet">
<link href="/Static/Admin/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css">
<link href="/Static/public/js/perfect-scrollbar.min.css" rel="stylesheet" type="text/css"/>
<style type="text/css">html, body { overflow: visible;}</style>
<script type="text/javascript">
SITEURL = '<?php echo C("WEB_PATH");?>';
LOADING_IMAGE = "/Static/Admin/images/loading.gif";
var PUBLIC_STATIC_URL = '/Static/public';
</script>
<script src="/Static/public/js/jquery-v1.8.3.min.js" type="text/javascript"></script>
<script type="text/javascript" src="/Static/Admin/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="/Static/Admin/js/jquery-ui/i18n/zh-CN.js"></script>
<script type="text/javascript" src="/Static/Admin/js/admin.js"></script>
<script type="text/javascript" src="/Static/public/js/dialog/dialog.js" id="dialog_js"></script>
<script type="text/javascript" src="/Static/Admin/js/flexigrid.js"></script>
<script type="text/javascript" src="/Static/public/js/jquery.validation.min.js"></script>
<script src="/Static/Admin/js/common.js" type="text/javascript"></script>
<script type="text/javascript" src="/Static/public/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="/Static/public/js/jquery.mousewheel.js"></script>

</head>
<body style="background-color: #FFF; overflow: auto;">
<script type="text/javascript" src="/Static/Admin/js/jquery.picTip.js"></script>
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title"><a class="back" href='<?php echo U("Nav/lists");?>' title="返回内容列表"><i class="fa fa-arrow-circle-o-left"></i></a>
      <div class="subject">
        <h3>导航管理 - 新增/更新</h3>
      </div>
    </div>
  </div>
  <form id="Nav_form" enctype="multipart/form-data" method="post">
    <div class="ncap-form-default">
      <dl class="row">
	  
        <dt class="tit">
          <label for="field"><em>*</em>分类名称</label>
        </dt>
        <dd class="opt">
          <input type="text" class="input-txt" id="name" name="name" value="<?php echo ($info["name"]); ?>">
          <span class="err"></span>
          <p class="notic"></p>
        </dd>
		
		<dt class="tit">
          <label for="field"><em>*</em>URL</label>
        </dt>
		<dd class="opt">
          <input type="text" class="input-txt" id="url" name="url" value="<?php echo ($info["url"]); ?>">
          <span class="err"></span>
          <p class="notic"></p>
        </dd>
		
		<dt class="tit">
          <label for="field"><em>*</em>排序</label>
        </dt>
		<dd class="opt">
          <input type="text" class="input-txt" id="sort" name="sort" value="<?php echo ($info["sort"]); ?>">
          <span class="err"></span>
          <p class="notic"></p>
        </dd>
		
		 <dl class="row">
		 <dt class="tit">
          <label for="field"><em>*</em>状态</label>
        </dt>
		<dd class="opt">
          <div class="onoff">
            <label for="status1" <?php if($info["status"] == 1 ): ?>class="cb-enable selected"<?php else: ?>class="cb-enable "<?php endif; ?>>显示</label>
            <label for="status0" <?php if($info["status"] == 0 ): ?>class="cb-disable  selected"<?php else: ?>class="cb-disable "<?php endif; ?>>隐藏</label>
            <input id="status1" name="status" <?php if($info["status"] == 1 ): ?>checked="checked"<?php endif; ?> value="1" type="radio">
            <input id="status0" name="status" <?php if($info["status"] == 0 ): ?>checked="checked"<?php endif; ?> value="0" type="radio">
          </div>
        </dd>
		</dl>
      <div class="bot">
	  <input type="hidden" name="id" value="<?php echo ((isset($info["id"]) && ($info["id"] !== ""))?($info["id"]):''); ?>">
	  <input type="hidden" name="pid" value="<?php echo ($info["pid"]); ?>">
	  <a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-green" id="submitBtn">确认提交</a>
	  </div>
    </div>
  </form>
</div>


<script type="text/javascript" src="/Static/public/js/jquery.nyroModal.js"></script> 
<script type="text/javascript">


//按钮先执行验证再提交表单    
$("#submitBtn").click(function(){
	if($("#Nav_form").valid()){
		$("#Nav_form").submit();
	}
});

$(function(){
	
	//表单验证	
	$('#Nav_form').validate({
        errorPlacement: function(error, element){
			var error_td = element.parent('dd').children('span.err');
            error_td.append(error);
        },
        rules : {
			
        },
        messages : {
			
        }
    });
});
</script>

<div id="goTop"> <a href="JavaScript:void(0);" id="btntop"><i class="fa fa-angle-up"></i></a><a href="JavaScript:void(0);" id="btnbottom"><i class="fa fa-angle-down"></i></a></div>
</body>
</html>