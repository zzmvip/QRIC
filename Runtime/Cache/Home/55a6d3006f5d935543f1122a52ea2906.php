<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=Edge，chrome=1"/>
<title><?php echo ($seo_title); ?></title>
<meta name="keywords" content="武汉广告,广告,广告网,广告价格,媒体资源,广告代理公司,广告部,广告门户" />
<meta name="description" content="广告搜搜（www.adsousou.com）是华中地区首个广告传媒行业在线网站，主要服务对象为广告传媒企业，媒体主、广告主、自媒体个人及其相关的广告从业人员，率先在华中地区倡导媒体资源整合和自媒体发布平台，搭建广告主、广告商和服务商的在线沟通平台。" />
<link rel="stylesheet" type="text/css" href="/Static/Home/css/common.css" charset="utf-8" media="all">
<link rel="stylesheet" type="text/css" href="/Static/Home/css/iconfont.css" charset="utf-8" media="all">
<script src="/Static/public/js/jquery-v1.8.3.min.js"></script>
<script src="/Static/public/js/jquery.cookie.js" type="text/javascript"></script>
<script src="/Static/Home/js/jquery.superslide.2.1.1.js"></script>
<script src="/Static/Home/js/jquery.lazyload.min.js"></script>
<script src="/Static/Home/js/layer/layer.js"></script>
<script>
var COOKIE_PRE = 'ad_';
var SITEURL = "<?php echo C('WEB_PATH');?>"
$(function() {
	$(".lazy").lazyload();
});
</script>

</head>
<body>
	<!-- 头部 -->
	<!-- 网站顶部 STR -->
<link href="/Static/Home/css/city.css" type="text/css" rel="stylesheet" />
<div class="ad_top w">
    <div class="wrapper">
	    <ul class="fl">
			<?php if(is_login()): ?><li><a href="<?php echo U('Member/index');?>"><?php echo get_username();?></a></li>
			<li class="dline dline-v6"></li>
			<li><a href="<?php echo U('Member/logout');?>">退出</a></li>
			<?php else: ?>
		    <li><a href="<?php echo U('Member/login');?>" class="">登录</a></li>
			<li class="dline dline-v6"></li>
			<li><a href="<?php echo U('Member/register');?>">注册</a></li><?php endif; ?>
		</ul>
		<ul class="fr">
			<li><a href="#">帮助中心</a></li>
			<li class="dline dline-v6"></li>
			<li><a href="#" class="font-yellow">客服电话：400-888-5188</a></li>
		</ul>
		
		<ul class="fr" style="margin-right: 12px;">
			 
			<li class="i1"><?php echo ($infos["name"]); ?> </li>
			<li class="dline dline-v6"></li>
			<li class="i2" id="changeCity">切换城市</li>
		</ul>
	</div>
</div>
<div class="selcity" id="allCity" style="display:none;">
	<table>
		<tbody>
			<tr><?php if(is_array($city)): $i = 0; $__LIST__ = $city;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><td>
				<a  href='<?php echo U("Index/city/cityen/$vo[english]");?>'><?php echo ($vo["name"]); ?></a></td><?php endforeach; endif; else: echo "" ;endif; ?>
			</tr>
			
			
			
		</tbody>
	</table>
	<div class="none"><a id="foldin" href="javascript:;">收起</a></div>
</div>
<div class="header wrapper">
    <h1 class="logo fl"><a href="<?php echo C('WEB_PATH');?>"><img src="/Static/Home/images/logo.png"></a></h1>
	<div class="search fl">
	    <form action="<?php echo U('Article/search');?>" method="post">
		    <input type="text" class="search-text" name='search-text'  placeholder="请输入搜索关键字" x-webkit-speech="" value="<?php echo ($text); ?>" autocomplete="off" >
			<input type="submit" class="search-submit" value="搜索">
		</form>
	</div>
	<a class="fabu pa openlogin" href="#"><i class="iconfont mr5"></i>发布需求</a>
</div>
<!-- 网站顶部 END -->

<!-- 导航 STR -->
<div class="nav w">
    <div class="wrapper">
		<!-- 广告分类 STR -->
		<div class="category fl pr">
			<h3><a href="#"><i class="iconfont mr10">&#xea1a;</i>广告分类</a><i class="iconfont fr mr20">&#xe6f8;</i></h3>
			<div class="all-cate pa">
				<?php if(is_array($articleclass)): $i = 0; $__LIST__ = $articleclass;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["pid"] == 0 ): ?><div class="cate">
					<h2><i class="iconfont"><?php echo ($vo["icon"]); ?></i><a target="_blank" href='<?php echo U("Article/lists/name/$vo[enname]");?>'><?php echo ($vo["title"]); ?></a><i class="r-gt">&gt;</i></h2>
					<div class="hsub-title">
						<?php if(is_array($articleclass)): $i = 0; $__LIST__ = $articleclass;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i; if($vo2["pid"] == $vo["id"] ): ?><a target="_blank" href='<?php echo U("Article/lists/name/$vo2[enname]");?>'><?php echo ($vo2["title"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
					</div>
					<div class="cate2">
						<ul>
							<?php if(is_array($articleclass)): $i = 0; $__LIST__ = $articleclass;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i; if($vo2["pid"] == $vo["id"] ): ?><li><a target="_blank" href='<?php echo U("Article/lists/name/$vo2[enname]");?>'><?php echo ($vo2["title"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</div>
				</div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
<script type="text/javascript">
$(function(){
	
	$("#changeCity").click(function(a){
		$("#allCity").slideDown(300);
		a.stopPropagation();
		$(this).blur()
	});
	
	$("#allCity").click(function(a){
		a.stopPropagation()
	});
	
	$(document).click(function(a){
		a.button!=2&&$("#allCity").slideUp(300)
	});
	
	$("#foldin").click(function(){
		$("#allCity").slideUp(300)
	});
	
});
</script>

		<script>
		$(function () {
			$('.category').hover(
			  function () {
				$(this).addClass("hover");
			  },
			  function () {
				$(this).removeClass("hover");
			  }
			);
			$('.cate').hover(
			  function () {
				$(this).addClass("hover");
			  },
			  function () {
				$(this).removeClass("hover");
			  }
			);
		});
		</script>
		<!-- 广告分类 END -->
		<ul class="nav-ul fl">
		<?php if(is_array($nav_list)): $i = 0; $__LIST__ = $nav_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["name"]); ?></a></li>
			<li class="dline dline-v5"></li><?php endforeach; endif; else: echo "" ;endif; ?>
			
		</ul>
		<!--<div class="banner-right pa"></div>-->
	</div>
</div>
<!-- 导航 END -->
	<!-- /头部 -->
	
	<!-- 主体 -->
	
<link rel="stylesheet" type="text/css" href="/Static/Home/css/index.css" charset="utf-8" media="all">

<script src="/Static/Home/js/jquery.superslide.2.1.1.js" type="text/javascript"></script>


<!-- banner STR -->
<div class="index_banner_box wrapper pr">
<div class="index_banner pa">

</div>
</div>
<!-- banner END -->

<!-- 广告位 STR -->
<div class="wrapper">
    <div class="banner-ad">
	    <ul>
		    <li><div class="ad-default"></div></li>
			<li><div class="ad-default1"></div></li>
			<li class="noborder"><div class="ad-default2"></div></li>
		</ul>
	</div>
</div>
<!-- 广告位 END -->
  <style type="text/css">
      
	
	dl dt a {
    color: #333;
 
    font-size: 18px;
    font-weight: bold;
    text-decoration: none;
}
ul li a{
   color: #333;
	}
	li span {
    color: #8d8d8d;
    float: right;
}
.slideBox{ width:579px;border:1px solid #ddd; height:319px; overflow:hidden; position:relative; }
.slideBox .hd{ height:15px; overflow:hidden; position:absolute; right:5px; bottom:5px; z-index:1; }
.slideBox .hd ul{ overflow:hidden; zoom:1; float:left;  }
.slideBox .hd ul li{ float:left; margin-right:2px;  width:15px; height:15px; line-height:14px; text-align:center; background:#fff; cursor:pointer; }
.slideBox .hd ul li.on{ background:#FD730E; color:#fff; }
.slideBox .bd{ position:relative; height:100%; z-index:0;   }
.slideBox .bd li{ zoom:1; vertical-align:middle; }
.slideBox .bd a{ width:579px; height:319px; display:block;  }  
.slideBox .hd ul li {
    background: #fff none repeat scroll 0 0;
    cursor: pointer;
    float: left;
    height: 15px;
    line-height: 14px;
    margin-right: 2px;
    text-align: center;
    width: 15px;
}

 .slideBox .hd ul li.on {
    background: #fd730e none repeat scroll 0 0;
    color: #fff;
}
.slideBox .bd {
    height: 100%;
    position: relative;
    z-index: 0;
}
.slideBox .bd li {
    vertical-align: middle;
}
.xinwen li{
	width:578px;
	float:left;
	border-bottom:1px dotted #aaa;
	height:30px;
	line-height:30px;
}
.xinwen ul{
	margin-top:20px;
}
.xinwen dd a{
	color:#f00;
}
.zxdt p{
	font-size:20px;
	font-weight:bold;
	margin-top:10px;
	margin-bottom:10px;
	float:left;
}
.zxdt span{
	font-size:14px;
	margin-top:10px;
	margin-bottom:10px;
	float:right;
}
.xgg{margin:12px 0;


}
	}
   </style>

<div style='margin: 0 auto;width: 1200px;'>
<div class="zxdt"><p>最新动态</p><span>更多</span></div>
<div class="clear"></div>
<div style='width:580px;float:left;' id="slideBox" class="slideBox">    
					<div class="hd">
						<ul style="list-style-type:none">
						<?php $where = array(); $where["status"] = 1; $where["_string"] = " thumb!=''"; $where["_string"] = " thumb!='' && FIND_IN_SET(\"2\",posid)"; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,3); $pages = $Page->show(); $lists = M("Article")->order("sort desc,id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $key = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?><li class="on"><?php echo ($key); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>	
						</ul>
					</div>
					<div class="bd">
					
					
						<ul style="list-style-type:none">
							<?php $where = array(); $where["status"] = 1; $where["_string"] = " thumb!=''"; $where["_string"] = " thumb!='' && FIND_IN_SET(\"2\",posid)"; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,3); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
								<a href="<?php echo U("Article/show/id/$vo[id]");?>" style="background-image:url('<?php echo C('ARTICLE_UPLOAD.rootPath'); echo ($vo["thumb"]); ?>');background-size:cover;backgroun-position:center center;background-repeat:no-repeat;" target="_blank"></a>
							</li><?php endforeach; endif; else: echo "" ;endif; ?>
							
							
						</ul>
					</div>
					<!-- 下面是前/后按钮代码，如果不需要删除即可 -->
					<a class="prev" href="javascript:void(0)"></a>
					<a class="next" href="javascript:void(0)"></a>
				</div>				
				
				<script id="jsID" type="text/javascript">
					 var ary = location.href.split("&");
					jQuery(".slideBox").slide( { mainCell:".bd ul", effect:ary[1],autoPlay:true,trigger:ary[3],easing:ary[4],delayTime:ary[5],mouseOverStop:ary[6],pnLoop:ary[7] });
				</script>
				
 		<div style='width:578px;float:left; margin:10px 10px 10px 30px;;' class="xinwen">	
				 <?php $where = array(); $where["status"] = 1; $where["_string"] = " thumb!=''"; $where["_string"] = " thumb!='' && FIND_IN_SET(\"2\",posid)"; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,0); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit("0,1")->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dl class="mb5">
				    <dt class="">
					<h3><a href="<?php echo U("Article/show/id/$vo[id]");?>"><?php echo ($vo["title"]); ?></a></h3>
					</dt>
					<dd><?php echo ($vo["description"]); ?>... <a href="<?php echo U("Article/show/id/$vo[id]");?>" style="text-decoration: none;">详细>></a></dd>
				   </dl><?php endforeach; endif; else: echo "" ;endif; ?>				   
				  <ul >
				  <?php $where = array(); $where["status"] = 1; $where["_string"] = " thumb!=''"; $where["_string"] = " thumb!='' && FIND_IN_SET(\"2\",posid)"; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,0); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit("1,8")->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li ><a class="fl" href="<?php echo U("Article/show/id/$vo[id]");?>">[<?php echo article_add_class($vo['catid']);?>]<?php echo (msubstr(strip_tags($vo["title"]),0,120)); ?></a><span>2015-08-10</span></li><?php endforeach; endif; else: echo "" ;endif; ?>
									
				</ul></div>
</div>

<!-- 网站主体 STR -->
<div class="wrapper main-content">
    <div class="content-1f w mt10">
		<div class="left-1f Js-tab mr10 fl">
			<div class="content-hd hd">
			    <ul>
					<li class="on"><a href="<?php echo U('Article/lists/name/pmgg');?>">平面广告</a></li>
					<li><a href="<?php echo U('Article/lists/name/spgg');?>">视频广告</a></li>
				</ul>
			</div>
			<div class="content-bd bd">
			    <ul>
				<?php $where = array(); $where["catid"] = array("in","1"); $where2["pid"] = array("in","1"); $subcat = M("ArticleClass")->where($where2)->select(); if(!empty($subcat)){ $scatid = ""; foreach($subcat as $key=>$val){ if($val["id"]){ $scatid .= $val["id"]; } if($key+1<count($subcat)){ $scatid .= ","; } } $where["catid"] = array("in",$scatid); } $where["status"] = 1; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,8); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
					    <div class="pic">
						    <a href="<?php echo U("Article/show/id/$vo[id]");?>" class="a-img"><img src="<?php echo C('ARTICLE_UPLOAD.rootPath'); echo ($vo["thumb"]); ?>"  data-original="<?php echo C('ARTICLE_UPLOAD.rootPath');?>" class="lazy"></a>
							<a href="javascript:void(0);"  article_id="<?php echo ($vo['id']); ?>" title="加入关注" class="a-like"><i class="iconfont">&#xe666;</i></a>
						</div>
						<div class="text">
						    <h2><a href="<?php echo U("Article/show/id/$vo[id]");?>">[<?php echo article_add_class($vo['catid']);?>]<?php echo (msubstr(strip_tags($vo["title"]),0,8)); ?></a></h2>
							<span class="desc"><?php echo ($vo["keywords"]); ?></span>
							
							<div class="click-guanzhu">
							    <span class="fl font-grey"><i class="iconfont mr10">&#xe84b;</i><em class="font-yellow mr5"><?php echo ($vo["click"]); ?></em>人浏览</span>
								<span class="fr font-grey"><i class="iconfont mr10">&#xe666;</i><em class="font-yellow mr5 gz"><?php echo gz($vo[id]);?></em>人关注</span>
							</div>
						</div>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
					<div class="clear"></div>
				</ul>
				<ul class="none">
			<?php $where = array(); $where["catid"] = array("in","2"); $where2["pid"] = array("in","2"); $subcat = M("ArticleClass")->where($where2)->select(); if(!empty($subcat)){ $scatid = ""; foreach($subcat as $key=>$val){ if($val["id"]){ $scatid .= $val["id"]; } if($key+1<count($subcat)){ $scatid .= ","; } } $where["catid"] = array("in",$scatid); } $where["status"] = 1; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,8); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
					    <div class="pic">
						    <a href="<?php echo U("Article/show/id/$vo[id]");?>" class="a-img"><img src="<?php echo C('ARTICLE_UPLOAD.rootPath');?>article.jpg"  data-original="<?php echo C('ARTICLE_UPLOAD.rootPath'); echo ($vo["thumb"]); ?>" class="lazy" ></a>
							<a href="javascript:void(0);"  article_id="<?php echo ($vo['id']); ?>" title="加入关注" class="a-like"><i class="iconfont">&#xe666;</i></a>
						</div>
						<div class="text">
						    <h2><a href="<?php echo U("Article/show/id/$vo[id]");?>">[<?php echo article_add_class($vo['catid']);?>]<?php echo (msubstr(strip_tags($vo["title"]),0,8)); ?></a></h2>
							<span class="desc"><?php echo ($vo["keywords"]); ?></span>
							
							<div class="click-guanzhu">
							    <span class="fl font-grey"><i class="iconfont mr10">&#xe84b;</i><em class="font-yellow mr5"><?php echo ($vo["click"]); ?></em>人浏览</span>
								<span class="fr font-grey"><i class="iconfont mr10">&#xe666;</i><em class="font-yellow mr5 gz"><?php echo gz($vo[id]);?></em>人关注</span>
							</div>
						</div>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
					<div class="clear"></div>
				</ul>
				<div class="clear"></div>
			</div>
		</div>
	
		<div class="right-1f fl">
			<div class="content-hd">
			
			</div>

		</div>
		<div class="clear"></div>
	</div>

	<div class="content-2f Js-tab w mt10">
	    <div class="content-hd hd mb10">
			<ul>
				<li class="on"><a href="<?php echo U('Article/lists/name/dtzq');?>">地铁专区</a></li>
				<li><a href="<?php echo U('Article/lists/name/zmtq');?>">自媒体区</a></li>
			</ul>
		</div>
		<div class="content-bd bd">
		<ul>
			<?php $where = array(); $where["catid"] = array("in","3"); $where2["pid"] = array("in","3"); $subcat = M("ArticleClass")->where($where2)->select(); if(!empty($subcat)){ $scatid = ""; foreach($subcat as $key=>$val){ if($val["id"]){ $scatid .= $val["id"]; } if($key+1<count($subcat)){ $scatid .= ","; } } $where["catid"] = array("in",$scatid); } $where["status"] = 1; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,6); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $key = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?><div class="speakConten fl <?php if($key%3 != 0 ): ?>mr15<?php endif; ?>">
					<a href="<?php echo U("Article/show/id/$vo[id]");?>" class="font">
						<i><img src="<?php echo C('ARTICLE_UPLOAD.rootPath');?>article.jpg" class="lazy" data-original="<?php echo C('ARTICLE_UPLOAD.rootPath'); echo ($vo["thumb"]); ?>" width="130px" height="130px"/></i>
						<div class="personCon">
							<div class="title">[<?php echo article_add_class($vo['catid']);?>]<?php echo (msubstr(strip_tags($vo["title"]),0,8)); ?></div>
							<div class="info"><?php echo ($vo["description"]); ?></div>
						</div>
					</a>
						<a href="<?php echo U("Article/show/id/$vo[id]");?>" class="back">
						<i><img src="<?php echo C('ARTICLE_UPLOAD.rootPath');?>article.jpg" class="lazy" data-original="<?php echo C('ARTICLE_UPLOAD.rootPath'); echo ($vo["image"]); ?>" width="130px" height="130px"/></i>
						<div class="personCon">
							<div class="title">[<?php echo article_add_class($vo['catid']);?>]<?php echo (msubstr(strip_tags($vo["title"]),0,8)); ?></div>
							<div class="info"><?php echo ($vo["description"]); ?></div>
						</div>
					</a>
					
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
			<ul class="none">
			<?php $where = array(); $where["catid"] = array("in","4"); $where2["pid"] = array("in","4"); $subcat = M("ArticleClass")->where($where2)->select(); if(!empty($subcat)){ $scatid = ""; foreach($subcat as $key=>$val){ if($val["id"]){ $scatid .= $val["id"]; } if($key+1<count($subcat)){ $scatid .= ","; } } $where["catid"] = array("in",$scatid); } $where["status"] = 1; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,6); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $key = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?><div class="speakConten fl <?php if($key%3 != 0 ): ?>mr15<?php endif; ?>">
					<a href="<?php echo U("Article/show/id/$vo[id]");?>" class="font">
						<i><img src="<?php echo C('ARTICLE_UPLOAD.rootPath');?>article.jpg" class="lazy" data-original="<?php echo C('ARTICLE_UPLOAD.rootPath'); echo ($vo["thumb"]); ?>" width="130px" height="130px"/></i>
						<div class="personCon">
							<div class="title">[<?php echo article_add_class($vo['catid']);?>]<?php echo (msubstr(strip_tags($vo["title"]),0,8)); ?></div>
							<div class="info"><?php echo ($vo["description"]); ?></div>
						</div>
					</a>
						<a href="<?php echo U("Article/show/id/$vo[id]");?>" class="back">
						<i><img src="<?php echo C('ARTICLE_UPLOAD.rootPath');?>article.jpg" class="lazy" data-original="<?php echo C('ARTICLE_UPLOAD.rootPath'); echo ($vo["image"]); ?>" width="130px" height="130px"/></i>
						<div class="personCon">
							<div class="title"><?php echo ($vo["title"]); ?></div>
							<div class="info"><?php echo ($vo["description"]); ?></div>
						</div>
					</a>
					
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
			<div class="clear"></div>
		</div>
		<script>
			$(".speakConten").hover(function(){
				$(this).find(".font").animate({top:'-130px'},100);
				$(this).find(".back").animate({top:'-130px'},100);
			},function(){
				$(this).find(".font").animate({top:'0px'},100);
				$(this).find(".back").animate({top:'130px'},100);
			})
		</script>
		<div class="clear"></div>
	</div>

	<div class="content-3f Js-tab w mt10">
		<div class="content-hd hd">
			<ul>
				<li class="on"><a href="<?php echo U('Article/lists/name/wzmh');?>">网站门户</a></li>
				<li><a href="<?php echo U('Article/lists/name/wlpt');?>">网络平台</a></li>
			</ul>
		</div>
		<div class="content-bd bd">
		<ul>
			<div class="Bulletin fl pb20">
				<div class="bulletinWrap">
					<a href="#">
						<div class="Bulletin_hd">门户网站</div>
					</a>
					
					<?php $where = array(); $where["catid"] = array("in","38"); $where["status"] = 1; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,1); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="carImg"><a href="<?php echo U("Article/show/id/$vo[id]");?>" target="_blank"><img src="<?php echo C('ARTICLE_UPLOAD.rootPath');?>article.jpg" class="lazy" data-original="<?php echo C('ARTICLE_UPLOAD.rootPath'); echo ($vo["thumb"]); ?>" width="257px" height="140px"/></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
					<ul>
					<?php $where = array(); $where["catid"] = array("in","38"); $where2["pid"] = array("in","38"); $subcat = M("ArticleClass")->where($where2)->select(); if(!empty($subcat)){ $scatid = ""; foreach($subcat as $key=>$val){ if($val["id"]){ $scatid .= $val["id"]; } if($key+1<count($subcat)){ $scatid .= ","; } } $where["catid"] = array("in",$scatid); } $where["status"] = 1; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,4); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
							<div class="heidian_a fl"></div>
							<div class="company_a fl"><a href="<?php echo U("Article/show/id/$vo[id]");?>" target="_blank"><?php echo ($vo["title"]); ?></a></div>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
						
					</ul>
				</div>
			</div>

			<div class="Bulletin fl pb20">
				<div class="bulletinWrap">
					<a href="#">
						<div class="Bulletin_hd Bulletin_hd_b">行业网站</div>
					</a>
					<?php $where = array(); $where["catid"] = array("in","39"); $where["status"] = 1; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,1); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="carImg"><a href="<?php echo U("Article/show/id/$vo[id]");?>" target="_blank"><img src="<?php echo C('ARTICLE_UPLOAD.rootPath');?>article.jpg" class="lazy" data-original="<?php echo C('ARTICLE_UPLOAD.rootPath'); echo ($vo["thumb"]); ?>" width="257px" height="140px"/></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
					<ul>
					<?php $where = array(); $where["catid"] = array("in","39"); $where2["pid"] = array("in","39"); $subcat = M("ArticleClass")->where($where2)->select(); if(!empty($subcat)){ $scatid = ""; foreach($subcat as $key=>$val){ if($val["id"]){ $scatid .= $val["id"]; } if($key+1<count($subcat)){ $scatid .= ","; } } $where["catid"] = array("in",$scatid); } $where["status"] = 1; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,4); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
							<div class="heidian_a fl"></div>
							<div class="company_a fl"><a href="<?php echo U("Article/show/id/$vo[id]");?>" target="_blank"><?php echo ($vo["title"]); ?></a></div>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
						
					</ul>
				</div>
			</div>

			<div class="Bulletin fl pb20">
				<div class="bulletinWrap">
					<a href="#">
						<div class="Bulletin_hd Bulletin_hd_c">综合网站</div>
					</a>
					<?php $where = array(); $where["catid"] = array("in","40"); $where["status"] = 1; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,1); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="carImg"><a href="<?php echo U("Article/show/id/$vo[id]");?>" target="_blank"><img src="<?php echo C('ARTICLE_UPLOAD.rootPath');?>article.jpg" class="lazy" data-original="<?php echo C('ARTICLE_UPLOAD.rootPath'); echo ($vo["thumb"]); ?>" width="257px" height="140px"/></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
						<ul>
					<?php $where = array(); $where["catid"] = array("in","40"); $where2["pid"] = array("in","40"); $subcat = M("ArticleClass")->where($where2)->select(); if(!empty($subcat)){ $scatid = ""; foreach($subcat as $key=>$val){ if($val["id"]){ $scatid .= $val["id"]; } if($key+1<count($subcat)){ $scatid .= ","; } } $where["catid"] = array("in",$scatid); } $where["status"] = 1; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,4); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
							<div class="heidian_a fl"></div>
							<div class="company_a fl"><a href="<?php echo U("Article/show/id/$vo[id]");?>" target="_blank"><?php echo ($vo["title"]); ?></a></div>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
						
					</ul>
				</div>
			</div>

			<div class="Bulletin fl pb20 noborder">
				<div class="bulletinWrap">
					<a href="#">
						<div class="Bulletin_hd Bulletin_hd_d">地方站点</div>
					</a>
					<?php $where = array(); $where["catid"] = array("in","41"); $where["status"] = 1; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,1); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="carImg"><a href="<?php echo U("Article/show/id/$vo[id]");?>" target="_blank"><img src="<?php echo C('ARTICLE_UPLOAD.rootPath');?>article.jpg" class="lazy" data-original="<?php echo C('ARTICLE_UPLOAD.rootPath'); echo ($vo["thumb"]); ?>" width="257px" height="140px"/></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
						<ul>
					<?php $where = array(); $where["catid"] = array("in","41"); $where2["pid"] = array("in","41"); $subcat = M("ArticleClass")->where($where2)->select(); if(!empty($subcat)){ $scatid = ""; foreach($subcat as $key=>$val){ if($val["id"]){ $scatid .= $val["id"]; } if($key+1<count($subcat)){ $scatid .= ","; } } $where["catid"] = array("in",$scatid); } $where["status"] = 1; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,4); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
							<div class="heidian_a fl"></div>
							<div class="company_a fl"><a href="<?php echo U("Article/show/id/$vo[id]");?>" target="_blank"><?php echo ($vo["title"]); ?></a></div>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
						
					</ul>
				</div>
			</div>
			<div class="clear"></div>
		</ul>
		<ul class="none">
			<div class="Bulletin fl pb20">
				<div class="bulletinWrap">
					<a href="#">
						<div class="Bulletin_hd">网站建设</div>
					</a>
					<?php $where = array(); $where["catid"] = array("in","43"); $where["status"] = 1; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,1); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="carImg"><a href="<?php echo U("Article/show/id/$vo[id]");?>" target="_blank"><img src="<?php echo C('ARTICLE_UPLOAD.rootPath');?>article.jpg" class="lazy" data-original="<?php echo C('ARTICLE_UPLOAD.rootPath'); echo ($vo["thumb"]); ?>" width="257px" height="140px"/></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
					<ul>
					<?php $where = array(); $where["catid"] = array("in","43"); $where2["pid"] = array("in","43"); $subcat = M("ArticleClass")->where($where2)->select(); if(!empty($subcat)){ $scatid = ""; foreach($subcat as $key=>$val){ if($val["id"]){ $scatid .= $val["id"]; } if($key+1<count($subcat)){ $scatid .= ","; } } $where["catid"] = array("in",$scatid); } $where["status"] = 1; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,4); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
							<div class="heidian_a fl"></div>
							<div class="company_a fl"><a href="<?php echo U("Article/show/id/$vo[id]");?>" target="_blank"><?php echo ($vo["title"]); ?></a></div>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
						
					</ul>
				</div>
			</div>

			<div class="Bulletin fl pb20">
				<div class="bulletinWrap">
					<a href="#">
						<div class="Bulletin_hd Bulletin_hd_b">网站优化</div>
					</a>
					<?php $where = array(); $where["catid"] = array("in","44"); $where["status"] = 1; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,1); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="carImg"><a href="<?php echo U("Article/show/id/$vo[id]");?>" target="_blank"><img src="<?php echo C('ARTICLE_UPLOAD.rootPath');?>article.jpg" class="lazy" data-original="<?php echo C('ARTICLE_UPLOAD.rootPath'); echo ($vo["thumb"]); ?>" width="257px" height="140px"/></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
					<ul>
					<?php $where = array(); $where["catid"] = array("in","44"); $where2["pid"] = array("in","44"); $subcat = M("ArticleClass")->where($where2)->select(); if(!empty($subcat)){ $scatid = ""; foreach($subcat as $key=>$val){ if($val["id"]){ $scatid .= $val["id"]; } if($key+1<count($subcat)){ $scatid .= ","; } } $where["catid"] = array("in",$scatid); } $where["status"] = 1; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,4); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
							<div class="heidian_a fl"></div>
							<div class="company_a fl"><a href="<?php echo U("Article/show/id/$vo[id]");?>" target="_blank"><?php echo ($vo["title"]); ?></a></div>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
						
					</ul>
				</div>
			</div>

			<div class="Bulletin fl pb20">
				<div class="bulletinWrap">
					<a href="#">
						<div class="Bulletin_hd Bulletin_hd_c">网络推广</div>
					</a>
					<?php $where = array(); $where["catid"] = array("in","45"); $where["status"] = 1; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,1); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="carImg"><a href="<?php echo U("Article/show/id/$vo[id]");?>" target="_blank"><img src="<?php echo C('ARTICLE_UPLOAD.rootPath');?>article.jpg" class="lazy" data-original="<?php echo C('ARTICLE_UPLOAD.rootPath'); echo ($vo["thumb"]); ?>" width="257px" height="140px"/></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
					<ul>
					<?php $where = array(); $where["catid"] = array("in","45"); $where2["pid"] = array("in","45"); $subcat = M("ArticleClass")->where($where2)->select(); if(!empty($subcat)){ $scatid = ""; foreach($subcat as $key=>$val){ if($val["id"]){ $scatid .= $val["id"]; } if($key+1<count($subcat)){ $scatid .= ","; } } $where["catid"] = array("in",$scatid); } $where["status"] = 1; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,4); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
							<div class="heidian_a fl"></div>
							<div class="company_a fl"><a href="<?php echo U("Article/show/id/$vo[id]");?>" target="_blank"><?php echo ($vo["title"]); ?></a></div>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
						
					</ul>
				</div>
			</div>

			<div class="Bulletin fl pb20 noborder">
				<div class="bulletinWrap">
					<a href="#">
						<div class="Bulletin_hd Bulletin_hd_d">微网在线</div>
					</a>
					<?php $where = array(); $where["catid"] = array("in","47"); $where["status"] = 1; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,1); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="carImg"><a href="<?php echo U("Article/show/id/$vo[id]");?>" target="_blank"><img src="<?php echo C('ARTICLE_UPLOAD.rootPath');?>article.jpg" class="lazy" data-original="<?php echo C('ARTICLE_UPLOAD.rootPath'); echo ($vo["thumb"]); ?>" width="257px" height="140px"/></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
					<ul>
					<?php $where = array(); $where["catid"] = array("in","47"); $where2["pid"] = array("in","47"); $subcat = M("ArticleClass")->where($where2)->select(); if(!empty($subcat)){ $scatid = ""; foreach($subcat as $key=>$val){ if($val["id"]){ $scatid .= $val["id"]; } if($key+1<count($subcat)){ $scatid .= ","; } } $where["catid"] = array("in",$scatid); } $where["status"] = 1; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,4); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
							<div class="heidian_a fl"></div>
							<div class="company_a fl"><a href="<?php echo U("Article/show/id/$vo[id]");?>" target="_blank"><?php echo ($vo["title"]); ?></a></div>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
						
					</ul>
				</div>
			</div>
			<div class="clear"></div>

		</ul>
			<div class="clear"></div>
		</div>
	</div>

	<div class="content-4f w mt10">
		<div class="left-4f mr10 Js-tab fl">
			<div class="content-hd hd">
				<ul>
					<li class="on"><a href="<?php echo U('Article/lists/name/ggch');?>">公关策划</a></li>
					<li><a href="<?php echo U('Article/lists/name/ggwl');?>">广告物料</a></li>
				</ul>
			</div>
			<div class="content-bd bd">
				<ul>
				
				<?php $where = array(); $where["catid"] = array("in","7"); $where2["pid"] = array("in","7"); $subcat = M("ArticleClass")->where($where2)->select(); if(!empty($subcat)){ $scatid = ""; foreach($subcat as $key=>$val){ if($val["id"]){ $scatid .= $val["id"]; } if($key+1<count($subcat)){ $scatid .= ","; } } $where["catid"] = array("in",$scatid); } $where["status"] = 1; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,8); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
						<div class="pic">
							<a href="<?php echo U("Article/show/id/$vo[id]");?>" class="a-img"><img src="<?php echo C('ARTICLE_UPLOAD.rootPath');?>article.jpg" class="lazy" data-original="<?php echo C('ARTICLE_UPLOAD.rootPath'); echo ($vo["thumb"]); ?>"></a>
							<a href="javascript:void(0);"  article_id="<?php echo ($vo['id']); ?>" class="a-like"><i class="iconfont">&#xe666;</i></a>
						</div>
						<div class="text">
							<h2><a href="<?php echo U("Article/show/id/$vo[id]");?>">[<?php echo article_add_class($vo['catid']);?>]<?php echo (msubstr(strip_tags($vo["title"]),0,8)); ?></a></h2>
							<span class="desc"><?php echo ($vo["keywords"]); ?></span>
							
							<div class="click-guanzhu">
								<span class="fl font-grey"><i class="iconfont mr10">&#xe84b;</i><em class="font-yellow mr5"><?php echo ($vo["click"]); ?></em>人浏览</span>
								<span class="fr font-grey"><i class="iconfont mr10">&#xe666;</i><em class="font-yellow mr5 gz"><?php echo gz($vo[id]);?></em>人关注</span>
							</div>
						</div>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
					
					
					
					
					
					
					<div class="clear"></div>
				</ul>
				<ul>
				<?php $where = array(); $where["catid"] = array("in","8"); $where2["pid"] = array("in","8"); $subcat = M("ArticleClass")->where($where2)->select(); if(!empty($subcat)){ $scatid = ""; foreach($subcat as $key=>$val){ if($val["id"]){ $scatid .= $val["id"]; } if($key+1<count($subcat)){ $scatid .= ","; } } $where["catid"] = array("in",$scatid); } $where["status"] = 1; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,8); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
						<div class="pic">
							<a href="<?php echo U("Article/show/id/$vo[id]");?>" class="a-img"><img src="<?php echo C('ARTICLE_UPLOAD.rootPath');?>article.jpg" class="lazy" data-original="<?php echo C('ARTICLE_UPLOAD.rootPath'); echo ($vo["thumb"]); ?>"></a>
							<a href="javascript:void(0);"  article_id="<?php echo ($vo['id']); ?>" title="加入关注" class="a-like"><i class="iconfont">&#xe666;</i></a>
						</div>
						<div class="text">
							<h2><a href="<?php echo U("Article/show/id/$vo[id]");?>">[<?php echo article_add_class($vo['catid']);?>]<?php echo (msubstr(strip_tags($vo["title"]),0,8)); ?></a></h2>
							<span class="desc"><?php echo ($vo["keywords"]); ?></span>
							
							<div class="click-guanzhu">
								<span class="fl font-grey"><i class="iconfont mr10">&#xe84b;</i><em class="font-yellow mr5"><?php echo ($vo["click"]); ?></em>人浏览</span>
								<span class="fr font-grey"><i class="iconfont mr10">&#xe666;</i><em class="font-yellow mr5 gz"><?php echo gz($vo[id]);?></em>人关注</span>
							</div>
						</div>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
					<div class="clear"></div>
				</ul>
				<div class="clear"></div>
			</div>
		</div>

		<div class="right-4f fl">			
		   
				<ul>
			<li></li>
				</ul>
			
			
		</div>
		<div class="clear"></div>
	</div>

	<div class="content-5f w mt10">
	    <div class="left-5f Js-tab fl mr10">
			<div class="content-hd hd">
				<ul>
					<li class="on"><a href="<?php echo U('Article/lists/name/dsgb');?>">电视广播</a></li>
					<li><a href="<?php echo U('Article/lists/name/bzzz');?>">报纸杂志</a></li>
				</ul>
			</div>
			<div class="content-bd bd">
			<ul>
				<div class="Bulletin fl pb20">
					<div class="bulletinWrap">
						<a href="#">
							<div class="Bulletin_hd">传统电视</div>
						</a>
						<?php $where = array(); $where["catid"] = array("in","63"); $where["status"] = 1; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,1); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="carImg"><a href="<?php echo U("Article/show/id/$vo[id]");?>" target="_blank"><img src="<?php echo C('ARTICLE_UPLOAD.rootPath');?>article.jpg" class="lazy" data-original="<?php echo C('ARTICLE_UPLOAD.rootPath'); echo ($vo["thumb"]); ?>" width="257px" height="140px"/></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
						<ul>
					<?php $where = array(); $where["catid"] = array("in","63"); $where2["pid"] = array("in","63"); $subcat = M("ArticleClass")->where($where2)->select(); if(!empty($subcat)){ $scatid = ""; foreach($subcat as $key=>$val){ if($val["id"]){ $scatid .= $val["id"]; } if($key+1<count($subcat)){ $scatid .= ","; } } $where["catid"] = array("in",$scatid); } $where["status"] = 1; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,4); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
							<div class="heidian_a fl"></div>
							<div class="company_a fl"><a href="<?php echo U("Article/show/id/$vo[id]");?>" target="_blank"><?php echo ($vo["title"]); ?></a></div>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
						
					</ul>
					</div>
				</div>

				<div class="Bulletin fl pb20">
					<div class="bulletinWrap">
						<a href="#">
							<div class="Bulletin_hd Bulletin_hd_b">传统广播</div>
						</a>
						<?php $where = array(); $where["catid"] = array("in","64"); $where["status"] = 1; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,1); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="carImg"><a href="<?php echo U("Article/show/id/$vo[id]");?>" target="_blank"><img src="<?php echo C('ARTICLE_UPLOAD.rootPath');?>article.jpg" class="lazy" data-original="<?php echo C('ARTICLE_UPLOAD.rootPath'); echo ($vo["thumb"]); ?>" width="257px" height="140px"/></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
						<ul>
					<?php $where = array(); $where["catid"] = array("in","64"); $where2["pid"] = array("in","64"); $subcat = M("ArticleClass")->where($where2)->select(); if(!empty($subcat)){ $scatid = ""; foreach($subcat as $key=>$val){ if($val["id"]){ $scatid .= $val["id"]; } if($key+1<count($subcat)){ $scatid .= ","; } } $where["catid"] = array("in",$scatid); } $where["status"] = 1; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,4); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
							<div class="heidian_a fl"></div>
							<div class="company_a fl"><a href="<?php echo U("Article/show/id/$vo[id]");?>" target="_blank"><?php echo ($vo["title"]); ?></a></div>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
						
					</ul>
					</div>
				</div>
				<div class="Bulletin fl pb20">
					<div class="bulletinWrap">
						<a href="#">
							<div class="Bulletin_hd Bulletin_hd_d">有线电视</div>
						</a>
						<?php $where = array(); $where["catid"] = array("in","65"); $where["status"] = 1; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,1); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="carImg"><a href="<?php echo U("Article/show/id/$vo[id]");?>" target="_blank"><img src="<?php echo C('ARTICLE_UPLOAD.rootPath');?>article.jpg" class="lazy" data-original="<?php echo C('ARTICLE_UPLOAD.rootPath'); echo ($vo["thumb"]); ?>" width="257px" height="140px"/></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
					<ul>
					<?php $where = array(); $where["catid"] = array("in","65"); $where2["pid"] = array("in","65"); $subcat = M("ArticleClass")->where($where2)->select(); if(!empty($subcat)){ $scatid = ""; foreach($subcat as $key=>$val){ if($val["id"]){ $scatid .= $val["id"]; } if($key+1<count($subcat)){ $scatid .= ","; } } $where["catid"] = array("in",$scatid); } $where["status"] = 1; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,4); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
							<div class="heidian_a fl"></div>
							<div class="company_a fl"><a href="<?php echo U("Article/show/id/$vo[id]");?>" target="_blank"><?php echo ($vo["title"]); ?></a></div>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
						
					</ul>
					</div>
				</div>
				<div class="Bulletin fl pb20 noborder">
					<div class="bulletinWrap">
						<a href="#">
							<div class="Bulletin_hd Bulletin_hd_c">无线电视</div>
						</a>
						<?php $where = array(); $where["catid"] = array("in","66"); $where["status"] = 1; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,1); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="carImg"><a href="<?php echo U("Article/show/id/$vo[id]");?>" target="_blank"><img src="<?php echo C('ARTICLE_UPLOAD.rootPath');?>article.jpg" class="lazy" data-original="<?php echo C('ARTICLE_UPLOAD.rootPath'); echo ($vo["thumb"]); ?>" width="257px" height="140px"/></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
					<ul>
					<?php $where = array(); $where["catid"] = array("in","66"); $where2["pid"] = array("in","66"); $subcat = M("ArticleClass")->where($where2)->select(); if(!empty($subcat)){ $scatid = ""; foreach($subcat as $key=>$val){ if($val["id"]){ $scatid .= $val["id"]; } if($key+1<count($subcat)){ $scatid .= ","; } } $where["catid"] = array("in",$scatid); } $where["status"] = 1; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,4); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
							<div class="heidian_a fl"></div>
							<div class="company_a fl"><a href="<?php echo U("Article/show/id/$vo[id]");?>" target="_blank"><?php echo ($vo["title"]); ?></a></div>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
						
					</ul>
					</div>
				</div>
				<div class="clear"></div>
			</ul>

			<ul class="none">
				<div class="Bulletin fl pb20 ">
					<div class="bulletinWrap">
						<a href="#">
							<div class="Bulletin_hd Bulletin_hd_c">热销周刊</div>
						</a>
					<?php $where = array(); $where["catid"] = array("in","10"); $where2["pid"] = array("in","10"); $subcat = M("ArticleClass")->where($where2)->select(); if(!empty($subcat)){ $scatid = ""; foreach($subcat as $key=>$val){ if($val["id"]){ $scatid .= $val["id"]; } if($key+1<count($subcat)){ $scatid .= ","; } } $where["catid"] = array("in",$scatid); } $where["status"] = 1; $where["_string"] = " status=1"; $where["_string"] = " status=1 && FIND_IN_SET(\"1\",posid)"; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,1); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="carImg"><a href="<?php echo U("Article/show/id/$vo[id]");?>" target="_blank"><img src="<?php echo C('ARTICLE_UPLOAD.rootPath');?>article.jpg" class="lazy" data-original="<?php echo C('ARTICLE_UPLOAD.rootPath'); echo ($vo["thumb"]); ?>" width="257px" height="140px"/></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
						<ul>
							<?php $where = array(); $where["catid"] = array("in","10"); $where2["pid"] = array("in","10"); $subcat = M("ArticleClass")->where($where2)->select(); if(!empty($subcat)){ $scatid = ""; foreach($subcat as $key=>$val){ if($val["id"]){ $scatid .= $val["id"]; } if($key+1<count($subcat)){ $scatid .= ","; } } $where["catid"] = array("in",$scatid); } $where["status"] = 1; $where["_string"] = " status=1"; $where["_string"] = " status=1 && FIND_IN_SET(\"1\",posid)"; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,4); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
							<div class="heidian_a fl"></div>
							<div class="company_a fl"><a href="<?php echo U("Article/show/id/$vo[id]");?>" target="_blank"><?php echo ($vo["title"]); ?></a></div>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
							
						</ul>
					</div>
				</div>
				<div class="Bulletin fl pb20">
					<div class="bulletinWrap">
						<a href="#">
							<div class="Bulletin_hd">传统报纸</div>
						</a>
						<?php $where = array(); $where["catid"] = array("in","68"); $where["status"] = 1; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,1); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="carImg"><a href="<?php echo U("Article/show/id/$vo[id]");?>" target="_blank"><img src="<?php echo C('ARTICLE_UPLOAD.rootPath');?>article.jpg" class="lazy" data-original="<?php echo C('ARTICLE_UPLOAD.rootPath'); echo ($vo["thumb"]); ?>" width="257px" height="140px"/></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
						<ul>
					<?php $where = array(); $where["catid"] = array("in","68"); $where2["pid"] = array("in","68"); $subcat = M("ArticleClass")->where($where2)->select(); if(!empty($subcat)){ $scatid = ""; foreach($subcat as $key=>$val){ if($val["id"]){ $scatid .= $val["id"]; } if($key+1<count($subcat)){ $scatid .= ","; } } $where["catid"] = array("in",$scatid); } $where["status"] = 1; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,4); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
							<div class="heidian_a fl"></div>
							<div class="company_a fl"><a href="<?php echo U("Article/show/id/$vo[id]");?>" target="_blank"><?php echo ($vo["title"]); ?></a></div>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
						
					</ul>
					</div>
				</div>

				<div class="Bulletin fl pb20">
					<div class="bulletinWrap">
						<a href="#">
							<div class="Bulletin_hd Bulletin_hd_b">DM杂志</div>
						</a>
						<?php $where = array(); $where["catid"] = array("in","69"); $where["status"] = 1; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,1); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="carImg"><a href="<?php echo U("Article/show/id/$vo[id]");?>" target="_blank"><img src="<?php echo C('ARTICLE_UPLOAD.rootPath');?>article.jpg" class="lazy" data-original="<?php echo C('ARTICLE_UPLOAD.rootPath'); echo ($vo["thumb"]); ?>" width="257px" height="140px"/></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
						<ul>
					<?php $where = array(); $where["catid"] = array("in","69"); $where2["pid"] = array("in","69"); $subcat = M("ArticleClass")->where($where2)->select(); if(!empty($subcat)){ $scatid = ""; foreach($subcat as $key=>$val){ if($val["id"]){ $scatid .= $val["id"]; } if($key+1<count($subcat)){ $scatid .= ","; } } $where["catid"] = array("in",$scatid); } $where["status"] = 1; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,4); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
							<div class="heidian_a fl"></div>
							<div class="company_a fl"><a href="<?php echo U("Article/show/id/$vo[id]");?>" target="_blank"><?php echo ($vo["title"]); ?></a></div>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
						
					</ul>
					</div>
				</div>
				<div class="Bulletin fl pb20 noborder">
					<div class="bulletinWrap">
						<a href="#">
							<div class="Bulletin_hd Bulletin_hd_d">DM平面</div>
						</a>
						<?php $where = array(); $where["catid"] = array("in","70"); $where["status"] = 1; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,1); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="carImg"><a href="<?php echo U("Article/show/id/$vo[id]");?>" target="_blank"><img src="<?php echo C('ARTICLE_UPLOAD.rootPath');?>article.jpg" class="lazy" data-original="<?php echo C('ARTICLE_UPLOAD.rootPath'); echo ($vo["thumb"]); ?>" width="257px" height="140px"/></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
						<ul>
					<?php $where = array(); $where["catid"] = array("in","70"); $where2["pid"] = array("in","70"); $subcat = M("ArticleClass")->where($where2)->select(); if(!empty($subcat)){ $scatid = ""; foreach($subcat as $key=>$val){ if($val["id"]){ $scatid .= $val["id"]; } if($key+1<count($subcat)){ $scatid .= ","; } } $where["catid"] = array("in",$scatid); } $where["status"] = 1; $where["cityen"] = ""; $count = M("Article")->where($where)->count(); $Page = new \Think\Page($count,4); $pages = $Page->show(); $lists = M("Article")->order("id desc")->where($where)->limit($Page->firstRow,$Page->listRows)->select(); foreach($lists as $key=>$val){ $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find(); $Model = new \Common\Model\Model(); if($Model->table_exists("article_class_".$val["catid"])){ $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();} if(!empty($info2)) $info2["id"] = $val["id"]; if(!empty($info3)) $info3["id"] = $val["id"]; if(!empty($info2)) $lists[$key] = array_merge($val, $info2); if(!empty($info3)) $lists[$key] = array_merge($val, $info3); if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);} $data = $lists; if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
							<div class="heidian_a fl"></div>
							<div class="company_a fl"><a href="<?php echo U("Article/show/id/$vo[id]");?>" target="_blank"><?php echo ($vo["title"]); ?></a></div>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
						
					</ul>
					</div>
				</div>
			
				<div class="clear"></div>
			</ul>
				<div class="clear"></div>
			</div>
		</div>

		
		<div class="clear"></div>
	</div>

</div>
<!-- 网站主体 END -->
<script>
jQuery(".Js-tab").slide({delayTime:0 });
</script>

	<!-- /主体 -->

	<!-- 底部 -->
	<div class="footer w  pt20 pb20">
    <div class="wrapper">
	    <dl class="footer-nav">
			<dt>新手上路</dt>
			<dd><a target="_blank" href="#">会员注册</a></dd>
			<dd><a target="_blank" href="#">会员登录</a></dd>
			<dd><a target="_blank" href="#">如何成为企业会员</a></dd>
			<dd><a target="_blank" href="#">如何发布需求</a></dd>		
		</dl>
		<dl class="footer-nav">
			<dt>帮助信息</dt>
			<dd><a target="_blank" href="#">操作方法</a></dd>
			<dd><a target="_blank" href="#">关于我们</a></dd>
			<dd><a target="_blank" href="#">联系我们</a></dd>
			<dd><a target="_blank" href="#">加入我们</a></dd>
		</dl>
		<dl class="footer-nav">
			<dt>服务项目</dt>
			<dd><a target="_blank" href="#">平面广告</a></dd>
			<dd><a target="_blank" href="#">视频广告</a></dd>
			<dd><a target="_blank" href="#">漫画制作</a></dd>
			<dd><a target="_blank" href="#">电视广播</a></dd>
		</dl>
		<dl class="item-app">
			<dt>广告搜搜</dt>
			<dd>
				<!--<a href="#" target="_blank" title="广告搜搜">
					<img src="/Static/Home/images/logo.png" alt="广告搜搜">
				</a>-->
				<p>广告搜搜致力于打造全国最大<br>的广告商和服务商在线沟通平台</p>
			</dd>
		</dl>
		<dl class="item-contact">
			<dt>400-888-5188</dt>
			<dd class="item-time">周一至周日9:00 - 23:00</dd>
			<dd class="item-chat">
				<a target="_blank" href="#">
					<i class="ui-ico-cs-h">联系在线客服</i>
				</a>
			</dd>
		</dl>
		<div class="clear"></div>
	</div>
</div>
<div class="footer-copyright wrapper">
    <div class="footer-sitelink">
		<a href="#" target="_blank">关于我们</a>
		<span class="dline dline-v6"></span>
		<a href="#" target="_blank">联系方式</a>
		<span class="dline dline-v6"></span>
		<a href="#" target="_blank">广告服务</a>
		<span class="dline dline-v6"></span>
		<a href="#" target="_blank">新闻中心</a>
		<span class="dline dline-v6"></span>
		<a href="#" target="_blank">网站地图</a>
		<span class="dline dline-v6"></span>
		<a href="#" target="_blank">公司资质</a>
		<span class="dline dline-v6"></span>
		<a href="#" target="_blank">加入我们</a>
	</div>
	<div class="footer-exlink">
		<span class="item-label">友情链接：</span>
		<?php if(is_array($links_list)): $i = 0; $__LIST__ = $links_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a target="_blank" href="<?php echo ($vo["link"]); ?>"><?php echo ($vo["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
		
	</div>
	<p class="font-gray copyright mt10">
		Copyright 2005-2015  武汉行友广告有限责任公司  版权所有  <a class="font-gray" href="http://www.miitbeian.gov.cn">鄂ICP备14011854-1号</a>  技术支持：<a class="font-gray" href="http://www.yunwanxinke.com">云湾信科</a>
	</p>
	<div class="footer-gov mt10">
		<a href="http://www.whhd.gov.cn/" target="_blank"><img  src="/Static/Home/images/jyxbaxx.gif" alt="经营性网站备案中心"></a>
		<a href="http://www.knet.cn/" target="_blank"><img src="/Static/Home/images/kxwz.gif" alt="可信网站"></a>
		<a href="http://www.szfw.org/" target="_blank"><img src="/Static/Home/images/cxwz.png"></a>
		<a target="_blank" href="http://webscan.360.cn/index/checkwebsite/url/www.adsousou.com"><img border="0" src="http://img.webscan.360.cn/status/pai/hash/0b7ca014d14892d6686ab59c8f59c583"></a>
		<a href="http://jubao.china.cn:13225/reportform.do" target="_blank"><img src="/Static/Home/images/bkjb.png"></a>
	</div>

</div>

<div class="ui-tools-bottom">
	<!--<div class="ui-tools-app">
		<a class="item-tools" href="#" target="_blank">
			<span class="item-ico"><i class="ui-ico ui-ico-mobile"></i></span>
			<span class="item-txt">官方微信</span>
			<div class="ui-poptipnoc ui-poptipnoc-left">
				<div class="ui-poptipnoc-arrow">
					<i></i>
				</div>
				<div class="ui-poptipnoc-bd">
					<div>
						<div class="item-weixin"></div>
						<p>官方微信<br>轻松找人做事</p>
					</div>
				</div>
			</div>
		</a>
	</div>
	<div class="ui-tools-feed">
		<a href="#" class="item-tools " id="j-feedback-btn">
			<span class="item-ico"><i class="ui-ico iconfont">&#xe6d7;</i></span>
			<span class="item-txt">意见反馈</span>
		</a>
	</div>-->
	<div class="ui-tools-gotop">
		<a class="item-tools" href="javascript:;" title="返回顶部" id="j-goTop"><i class="iconfont">&#xea67;</i></a>
	</div>
</div>
<script type="text/javascript">
$(function(){
	showScroll();
	function showScroll(){
		$(window).scroll( function() { 
			var scrollValue=$(window).scrollTop();
			scrollValue > 100 ? $('.ui-tools-gotop').fadeIn():$('.ui-tools-gotop').fadeOut();
		} );	
		$('#j-goTop').click(function(){
			$("html,body").animate({scrollTop:0},200);	
		});	
	}
})
</script>
	<script>
		$(function(){
			$(".a-like").click(function(){
				var aid = $(this).attr('article_id');
				var like = $(this);
				 $.ajax({ type: "POST",
						  dataType: "json",
						  url: "<?php echo U('Article/attention');?>",
						  data: "aid="+aid,
						  success: function(data){
							if(data.status==1){
								var gz = like.parent().next().find('em.gz').html();
								like.parent().next().find('em.gz').html(parseInt(gz)+1);
								like.attr('title','取消关注');
							}else if(data.status==0){
								var gz = like.parent().next().find('em.gz').html();
								like.parent().next().find('em.gz').html(parseInt(gz)-1);
								like.attr('title','加入关注');
							}
							alert(data.info);
						  }
						});
			
			
			});
		});
		
		</script>

	
	<!-- /底部 -->
</body>
</html>