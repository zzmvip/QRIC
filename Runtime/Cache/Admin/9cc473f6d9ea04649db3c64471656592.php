<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta charset="UTF-8">
<title>系统提示 - Powered by 广告搜搜.</title>
<link href="/Static/Admin/css/index.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="msgpage">
  <div class="msgbox">
    <div class="pic"></div>
		<div class="con">
		<?php if(isset($message)) {?>
		<?php echo($message); ?>
		<?php }else{?>
		<?php echo($error); ?>
		<?php }?>
		</div>
        <div class="scon">页面如不能自动跳转，选择手动操作...</div>
		<div class="button">
            <a href="<?php echo($jumpUrl); ?>" class="ncap-btn">返回上一页</a> 
			<script type="text/javascript"> window.setTimeout("javascript:location.href='<?php echo($jumpUrl); ?>'", 2000); </script>
          </div>
        <div class="powerby">Powered By 广告搜搜</div>
  </div>
</div>
</body>
</html>