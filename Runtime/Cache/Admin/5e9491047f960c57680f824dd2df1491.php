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
        <h3>会员公共字段管理</h3>
        <h5>此处新增的是会员的公共字段，如需指定会员模型添加字段，请至会员模型，对应模型，添加扩展字段</h5>
      </div>
    </div>
  </div>
  <div class="explanation" id="explanation">
    <div class="title" id="checkZoom"><i class="fa fa-lightbulb-o"></i>
      <h4 title="提示相关设置操作时应注意的要点">操作提示</h4>
      <span id="explanationZoom" title="收起提示"></span>
    </div>
    <ul>
      <li><a>管理会员公共字段</a></li>
    </ul>
  </div>
  <form method='post'>
    <table class="flex-table">
      <thead>
        <tr>
          <th width="24" align="center" class="sign"><i class="ico-check"></i></th>
          <th width="150" class="handle" align="center">操作</th>
          <th width="60" align="center">排序</th>
		  <th width="100" align="center">字段名</th>
          <th width="150" align="left">别名</th>
		  <th width="80" align="left">字段类型</th>
          <th width="40" align="left">必填</th>
          <th width="80" align="center">是否启用</th>
          <th width="80" align="center">允许修改</th>
          <th width="80" align="center">类型</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
	  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr data-id="<?php echo ($vo["id"]); ?>">
          <td class="sign"><i class="ico-check"></i></td>
          <td class="handle">
		  <?php if($vo["type"] == '1' ): ?><a href='<?php echo U("MemberField/edit/id/$vo[id]");?>' class="btn blue"><i class="fa fa-pencil-square-o"></i>编辑</a>
		  <?php else: ?>
			  <a onclick="fg_del(<?php echo ($vo["id"]); ?>)" href="javascript:void(0);" class="btn red"><i class="fa fa-trash-o"></i>删除</a>
			  <a href='<?php echo U("MemberField/edit/id/$vo[id]");?>' class="btn blue"><i class="fa fa-pencil-square-o"></i>编辑</a><?php endif; ?>
          </td>
          <td class="sort"><span title="可编辑" column_id="<?php echo ($vo["id"]); ?>" fieldname="sort" nc_type="inline_edit" class="editable "><?php echo ($vo["sort"]); ?></span></td>
          <td><?php echo ($vo["field"]); ?></td>
          <td class="class"><span title="可编辑"  column_id="<?php echo ($vo["id"]); ?>" fieldname="name" nc_type="inline_edit" class="editable "><?php echo ($vo["name"]); ?></span></td>
          <td class="class"><?php echo ($vo["formtype_text"]); ?></td>
          <td>
		    <span <?php if($vo["must"] == 1 ): ?>class="yes"<?php else: ?>class="no"<?php endif; ?>><i <?php if($vo["must"] == 1 ): ?>class="fa fa-check-circle"<?php else: ?>class="fa fa-ban"<?php endif; ?>></i><?php echo ($vo["must_text"]); ?></span>
		  </td>
          <td>
			<span <?php if($vo["hide"] == 1 ): ?>class="yes"<?php else: ?>class="no"<?php endif; ?>><i <?php if($vo["hide"] == 1 ): ?>class="fa fa-check-circle"<?php else: ?>class="fa fa-ban"<?php endif; ?>></i><?php echo ($vo["hide_text"]); ?></span>
		  </td>
          <td><span <?php if($vo["status"] == 1 ): ?>class="yes"<?php else: ?>class="no"<?php endif; ?>><i <?php if($vo["status"] == 1 ): ?>class="fa fa-check-circle"<?php else: ?>class="fa fa-ban"<?php endif; ?>></i><?php echo ($vo["status_text"]); ?></span></td>

          <td><span <?php if($vo["type"] == 1 ): ?>class="no"<?php else: ?>class="yes"<?php endif; ?>><?php echo ($vo["type_text"]); ?></span></td>
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
        title: '会员公共字段',// 表格标题
        reload: false,// 不使用刷新
        columnControl: false,// 不使用列控制
        buttons : [
                   {display: '<i class="fa fa-plus"></i>新增数据', name : 'add', bclass : 'add', onpress : fg_operation }
               ]
    });

    $('span[nc_type="inline_edit"]').inline_edit({a: 'MemberField',c: 'ajax'});
});

function fg_operation(name, bDiv) {
    if (name == 'add') {
        window.location.href = '<?php echo U("MemberField/add/id/$id");?>';
    } else if (name == 'del') {
        if ($('.trSelected', bDiv).length == 0) {
            showError('请选择要操作的数据项！');
        }
        var itemids = new Array();
        $('.trSelected', bDiv).each(function(i){
            itemids[i] = $(this).attr('data-id');
        });
        fg_del(itemids);
    }
}
function fg_del(ids) {
    if (typeof ids == 'number') {
        var ids = new Array(ids.toString());
    };
    id = ids.join(',');
    if(confirm('删除后将不能恢复，确认删除这项吗？')){
        $.getJSON('<?php echo U("MemberField/del");?>', {id:id}, function(data){
            if (data.state) {
                location.reload();
            } else {
                showError(data.msg)
            }
        });
    }
}
</script>

<div id="goTop"> <a href="JavaScript:void(0);" id="btntop"><i class="fa fa-angle-up"></i></a><a href="JavaScript:void(0);" id="btnbottom"><i class="fa fa-angle-down"></i></a></div>
</body>
</html>