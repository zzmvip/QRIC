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
        <h3>积分管理</h3>
        <h5>会员积分管理及获取日志</h5>
      </div>
      <ul class="tab-base nc-row">
        <li><a href="<?php echo U('Member/points');?>" class="current">积分明细</a></li>
        <li><a href="<?php echo U('Member/points_setting');?>">规则设置</a></li>
        <li><a href="<?php echo U('Member/addpoints');?>">积分增减</a></li>
      </ul>
    </div>
  </div>
  <!-- 操作说明 -->
  <div class="explanation" id="explanation">
    <div class="title" id="checkZoom"><i class="fa fa-lightbulb-o"></i>
      <h4 title="提示相关设置操作时应注意的要点">操作提示</h4>
      <span id="explanationZoom" title="收起提示"></span> </div>
    <ul>
      <li>积分明细，展示了被操作人员（会员）、操作人员（管理员）、操作积分数（积分值，“-”表示减少，无符号表示增加）、操作时间（添加时间）等信息</li>
    </ul>
  </div>
  <form method='post'>
    <table class="flex-table">
      <thead>
        <tr>
          <th width="24" align="center" class="sign"><i class="ico-check"></i></th>
          <th width="60" align="center">操作</th>
          <th width="60" align="center">日志ID</th>
		  <th width="60" align="center">会员ID</th>
          <th width="80" align="left">会员名称</th>
          <th width="40" align="left">积分</th>
		  <th width="80" align="left">操作阶段</th>
          <th width="80" align="left">操作时间</th>
          <th width="150" align="left">操作描述</th>
          <th width="80" align="left">管理员名称</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
	  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr data-id="<?php echo ($vo["id"]); ?>">
          <td class="sign"><i class="ico-check"></i></td>
          <td>
		  <span>--</span>
          </td>
          <td><?php echo ($vo["pl_id"]); ?></td>
          <td><?php echo ($vo["pl_memberid"]); ?></td>
		  <td><?php echo article_add_user($vo['pl_memberid'],2);?></td>
          <td><?php echo ($vo["pl_points"]); ?></td>
          <td><?php echo ($vo["pl_stage_text"]); ?></td>
          <td><?php echo (date("y-m-d",$vo["pl_addtime"])); ?></td>
		  <td><?php echo ($vo["pl_desc"]); ?></td>
		  <td><?php echo article_add_user($vo['pl_adminid'],1);?></td>
          <td></td>
         </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      </tbody>
    </table>
  </form>
</div>


<script type="text/javascript" src="/Static/Admin/js/jquery.edit.js" charset="utf-8"></script>
<script type="text/javascript">
$(function(){
    $('.flex-table').flexigrid({
        height:'auto',// 高度自动
        usepager: false,// 不翻页
        striped:false,// 不使用斑马线
        resizable: false,// 不调节大小
        title: '积分明细日志列表',// 表格标题
        reload: false,// 不使用刷新
        columnControl: false,// 不使用列控制
        buttons : [
               ]
    });

    $('span[nc_type="inline_edit"]').inline_edit({a: 'Article',c: 'ajax'});
});

</script>

<div id="goTop"> <a href="JavaScript:void(0);" id="btntop"><i class="fa fa-angle-up"></i></a><a href="JavaScript:void(0);" id="btnbottom"><i class="fa fa-angle-down"></i></a></div>
</body>
</html>