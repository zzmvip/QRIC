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
    <div class="item-title"><?php if($data["title"] != '' ): ?><a class="back" href='<?php echo U("Nav/index/pid/$data[pid]");?>' title="返回上级分类列表"><i class="fa fa-arrow-circle-o-left"></i></a><?php endif; ?>
      <div class="subject">
        <h3>Q码管理<?php if($data["title"] != '' ): ?>- "<?php echo ($data["title"]); ?>"的下级列表<?php endif; ?></h3>
        <h5>Q码添加修改等操作</h5>
      </div>
    </div>
  </div>
  <div class="explanation" id="explanation">
    <div class="title" id="checkZoom"><i class="fa fa-lightbulb-o"></i>
      <h4 title="提示相关设置操作时应注意的要点">操作提示</h4>
      <span id="explanationZoom" title="收起提示"></span>
    </div>
    <ul>
      <li><a>管理Q码，导入Q码，新增Q码，删除Q码</a></li>
    </ul>
  </div>
  <form method='post'>
    <table class="flex-table">
      <thead>
        <tr>
          <th width="24" align="center" class="sign"><i class="ico-check"></i></th>
          <th width="150" class="handle" align="center">操作</th>
          <th width="60" align="center">排序</th>
          <th width="150" align="left">分类名称</th>
		  <th width="150" align="left">URL</th>
          <th width="80" align="center">隐藏</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
	  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr data-id="<?php echo ($vo["id"]); ?>">
          <td class="sign"><i class="ico-check"></i></td>
          <td class="handle">
            <a class="btn red" href="javascript:void(0);" onclick="fg_del(<?php echo ($vo["id"]); ?>);"><i class="fa fa-trash-o"></i>删除</a>
            <a  class="btn blue" href='<?php echo U("Nav/edit/id/$vo[id]");?>'><i class="fa fa-pencil-square-o"></i>编辑</a>
            </td>
          <td class="sort"><?php echo ($vo["sort"]); ?></td>
          <td class="class"><?php echo ($vo["name"]); ?></td>
          <td class="class"><?php echo ($vo["url"]); ?></td>
          <td><span <?php if($vo["status"] == 1 ): ?>class="yes"<?php else: ?>class="no"<?php endif; ?>><i <?php if($vo["status"] == 1 ): ?>class="fa fa-check-circle"<?php else: ?>class="fa fa-ban"<?php endif; ?>></i><?php echo ($vo["status_text"]); ?></span></td>
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
        title: 'Q码列表',// 表格标题
        reload: false,// 不使用刷新
        columnControl: false,// 不使用列控制
        buttons : [
                   {display: '<i class="fa fa-plus"></i>新增Q码', name : 'add', bclass : 'add', onpress : fg_operation },
                   {display: '<i class="fa fa-plus"></i>导入Q码', name : 'daoru', bclass : 'daoru', onpress : fg_operation },
                   {display: '<i class="fa fa-trash"></i>批量删除', name : 'del', bclass : 'del', title : '将选定行数据批量删除', onpress : fg_operation }
               ]
    });

    $('span[nc_type="inline_edit"]').inline_edit({a: 'Menu',c: 'ajax'});
});

function fg_operation(name, bDiv) {
    if (name == 'add') {
        window.location.href = '<?php echo U("Qcode/add/");?>';
    }
    else if (name == 'daoru') {
        window.location.href = '<?php echo U("Qcode/daoru/");?>';
    }else if (name == 'del') {
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
        $.getJSON('<?php echo U("Nav/del");?>', {id:id}, function(data){
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