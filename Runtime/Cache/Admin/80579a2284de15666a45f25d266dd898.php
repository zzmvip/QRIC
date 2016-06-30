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
        <h3>站点设置</h3>
        <h5>网站全局内容基本选项设置</h5>
      </div>
    </div>
  </div>
  <!-- 操作说明 -->
  <div class="explanation" id="explanation">
    <div class="title" id="checkZoom"><i class="fa fa-lightbulb-o"></i>
      <h4 title="提示相关设置操作时应注意的要点">操作提示</h4>
      <span id="explanationZoom" title="收起提示"></span> </div>
    <ul>
      <li>网站全局基本设置，系统及其他模块相关内容在其各自栏目设置项内进行操作。</li>
    </ul>
  </div>
  <form method="post" action="<?php echo U('Config/save');?>" enctype="multipart/form-data" name="form1">
    <div class="ncap-form-default">
      <dl class="row">
        <dt class="tit">
          <label for="site_name">网站名称</label>
        </dt>
        <dd class="opt">
          <input id="site_name" name="config[WEB_SITE_TITLE]" value="<?php echo C('WEB_SITE_TITLE');?>" class="input-txt" type="text" />
          <p class="notic">网站名称，将显示在前台顶部欢迎信息等位置</p>
        </dd>
      </dl>
	  <dl class="row">
        <dt class="tit">
          <label for="site_url">网站地址</label>
        </dt>
        <dd class="opt">
          <input id="site_url" name="config[WEB_PATH]" value="<?php echo C('WEB_PATH');?>" class="input-txt" type="text" />
          <p class="notic">网站URL，结尾不需要添加以"/"</p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">
          <label for="icp_number">ICP证书号</label>
        </dt>
        <dd class="opt">
          <input id="icp_number" name="config[ICP_NUMBER]" value="<?php echo C('ICP_NUMBER');?>" class="input-txt" type="text" />
          <p class="notic">前台页面底部可以显示 ICP 备案信息，如果网站已备案，在此输入你的备案号，它将显示在前台页面底部，如果没有请留空</p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">
          <label for="statistics_code">第三方流量统计代码</label>
        </dt>
        <dd class="opt">
          <textarea name="config[STATISTICS_CODE]" rows="6" class="tarea" id="statistics_code"><?php echo C('STATISTICS_CODE');?></textarea>
          <p class="notic">前台页面底部可以显示第三方统计</p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">站点状态</dt>
        <dd class="opt">
          <div class="onoff">
            <label for="site_status1" <?php if(C('SITE_STATUS') == 1 ): ?>class="cb-enable selected"<?php else: ?>class="cb-enable "<?php endif; ?>>开启</label>
            <label for="site_status0" <?php if(C('SITE_STATUS') == 0 ): ?>class="cb-disable  selected"<?php else: ?>class="cb-disable "<?php endif; ?>>关闭</label>
            <input id="site_status1" name="config[SITE_STATUS]" <?php if(C('SITE_STATUS') == 1 ): ?>checked="checked"<?php endif; ?> value="1" type="radio">
            <input id="site_status0" name="config[SITE_STATUS]" <?php if(C('SITE_STATUS') == 0 ): ?>checked="checked"<?php endif; ?> value="0" type="radio">
          </div>
          <p class="notic">可暂时将站点关闭，其他人无法访问，但不影响管理员访问后台</p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">
          <label for="closed_reason">关闭原因</label>
        </dt>
        <dd class="opt">
          <textarea name="config[CLOSED_REASON]" rows="6" class="tarea" id="closed_reason" ><?php echo C('CLOSED_REASON');?></textarea>
          <p class="notic">当网站处于关闭状态时，关闭原因将显示在前台</p>
        </dd>
      </dl>
	  <dl class="row">
        <dt class="tit">
          <label for="closed_reason">后台允许访问的IP</label>
        </dt>
        <dd class="opt">
          <textarea name="config[ADMIN_ALLOW_IP]" rows="6" class="tarea" id="closed_reason" ><?php echo C('ADMIN_ALLOW_IP');?></textarea>
          <p class="notic">只允许次IP地址访问后台，多个以","分割</p>
        </dd>
      </dl>
      <div class="bot"><a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-green" onclick="document.form1.submit()">确认提交</a></div>
    </div>
  </form>
</div>


<div id="goTop"> <a href="JavaScript:void(0);" id="btntop"><i class="fa fa-angle-up"></i></a><a href="JavaScript:void(0);" id="btnbottom"><i class="fa fa-angle-down"></i></a></div>
</body>
</html>