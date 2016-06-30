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
        <h3>会员设置</h3>
        <h5>会员设置</h5>
      </div>
    </div>
  </div>
  <div class="explanation" id="explanation">
    <div class="title" id="checkZoom"><i class="fa fa-lightbulb-o"></i>
      <h4 title="提示相关设置操作时应注意的要点">操作提示</h4>
      <span id="explanationZoom" title="收起提示"></span> </div>
    <ul>
      <li>会员配置</li>
    </ul>
  </div>
  <form method="post" name="settingForm" id="settingForm">
    <div class="ncap-form-default">
	  <dl class="row">
        <dt class="tit">是否开启会员注册</dt>
        <dd class="opt">
          <div class="onoff">
            <label for="is_member_reg1" <?php if(C('IS_MEMBER_REG') == 1 ): ?>class="cb-enable selected"<?php else: ?>class="cb-enable "<?php endif; ?>>开启</label>
            <label for="is_member_reg0" <?php if(C('IS_MEMBER_REG') == 0 ): ?>class="cb-disable  selected"<?php else: ?>class="cb-disable "<?php endif; ?>>关闭</label>
            <input id="is_member_reg1" name="config[IS_MEMBER_REG]" <?php if(C('IS_MEMBER_REG') == 1 ): ?>checked="checked"<?php endif; ?> value="1" type="radio">
            <input id="is_member_reg0" name="config[IS_MEMBER_REG]" <?php if(C('IS_MEMBER_REG') == 0 ): ?>checked="checked"<?php endif; ?> value="0" type="radio">
          </div>
          <p class="notic">关闭后前台用户无法注册</p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit"><label for="icp_number">最大会员注册数</label></dt>
        <dd class="opt">
          <input id="member_reg_num" name="config[MEMBER_REG_NUM]" value="<?php echo C('MEMBER_REG_NUM');?>" class="input-txt" type="text">
		  <p class="notic">相同IP同一天内（24小时）最多注册会员数 0为无限制</p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">默认会员注册模型</dt>
        <dd class="opt">
		  <select id="member_reg_default_module" name="config[MEMBER_REG_DEFAULT_MODULE]">
		  <?php if(is_array($member_module_list)): $i = 0; $__LIST__ = $member_module_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
		  </select>
		  <p class="notic">会员注册成功时系统默认分配的会员模型</p>
        </dd>
      </dl>
      <div class="bot"><a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-green" id="submitBtn">确认提交</a></div>
    </div>
  </form>
</div>



<script>
$('#member_reg_default_module').attr('value',"<?php echo C('MEMBER_REG_DEFAULT_MODULE');?>");
$(function(){
    $("#submitBtn").click(function(){
        if($("#settingForm").valid()){
            $("#settingForm").submit();
        }
    });
});
</script>

<div id="goTop"> <a href="JavaScript:void(0);" id="btntop"><i class="fa fa-angle-up"></i></a><a href="JavaScript:void(0);" id="btnbottom"><i class="fa fa-angle-down"></i></a></div>
</body>
</html>