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
    <div class="item-title">
      <div class="subject">
        <h3>清理缓存</h3>
        <h5>清理网站缓存使设置类操作生效</h5>
      </div>
    </div>
  </div>
  <!-- 操作说明 -->
  <div class="explanation" id="explanation">
    <div class="title" id="checkZoom"><i class="fa fa-lightbulb-o"></i>
      <h4 title="提示相关设置操作时应注意的要点">操作提示</h4>
      <span id="explanationZoom" title="收起提示"></span> </div>
    <ul>
      <li>当系统修改设置后，前后台部分内容需及时更新缓存方可显示正常。</li>
    </ul>
  </div>
  <form id="cache_form" method="post">
    <div class="ncap-form-all">
      <dl class="row">
      <dt class="tit"><span>选择要更新的缓存数据</span></dt>
        <dd class="opt nobg nopd nobd nobs">
          <div class="ncap-account-container">
            <h4>
              <input id="cls_full" name="cls_full" value="1" type="checkbox" class="checkbox">
              <label for="cls_full">全部</label>
            </h4>
            <ul class="ncap-account-container-list">
              <li>
                <label>
                  <input type="checkbox" class="checkbox" name="cache[]" value="sitedata" >
                  数据缓存</label>
              </li>
              <li>
                <label>
                  <input type="checkbox" class="checkbox" name="cache[]" value="template" >
                  模板缓存</label>
              </li>
			  <li>
                <label>
                  <input type="checkbox" class="checkbox" name="cache[]" value="logs" >
                  运行日志</label>
              </li>
              <li>
                <label>
                  <input type="checkbox" class="checkbox" name="cache[]" value="admin_menu" >
                  后台菜单</label>
              </li>
            </ul>
          </div>
        </dd>
      </dl>
      <div class="bot"><a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-green" id="submitBtn">确认提交</a></div>
    </div>
  </form>
</div>


<script>
//按钮先执行验证再提交表
$(function(){
	$("#submitBtn").click(function(){
		if($('input[name="cache[]"]:checked').size()>0){
			$("#cache_form").submit();
		}
	});

	$('#cls_full').click(function(){
		$('input[name="cache[]"]').attr('checked',$(this).attr('checked') == 'checked');
	});
});
</script>

<div id="goTop"> <a href="JavaScript:void(0);" id="btntop"><i class="fa fa-angle-up"></i></a><a href="JavaScript:void(0);" id="btnbottom"><i class="fa fa-angle-down"></i></a></div>
</body>
</html>