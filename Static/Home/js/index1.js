+function(t,n,e){function i(){n.ajax({url:"http://c.open.163.com/open/count.do",scriptCharset:"utf-8",dataType:"jsonp",jsonp:"callback"}).done(function(t){n("#j-special").text("�?"+t.sc+"篇策�?"),n("#j-coursera").text("�?"+t.cc+"门课�?")}),n(".j-recstop").click(function(t){t.stopPropagation()})}function o(){d.switchSlide({pevBtn:"#j-xbtj-switch-pevbtn",nextBtn:"#j-xbtj-switch-nextbtn",container:"#j-xbtj-switch-container",wrap:[{itemWidth:195,containerWidth:960,scrollCount:5,baseleft:-7},{itemWidth:200,containerWidth:1180,scrollCount:6,baseleft:-10}]})}function c(){var e=function(t){if(t.result){for(var e=n("#j-guess-tmp").val(),i=0;6>i;i++){var o=t.result[i].iteminfo;o&&(o.url=o.url.replace(/(^\s*)|(\s*$)/g,""),o.url+=o.url.indexOf("?")>0?"&recomend=1":"?recomend=1",o.imgurl?-1==o.imgurl.indexOf("http://imgsize.ph.126.net/?enlarge=true&imgurl")&&(o.imgurl="http://imgsize.ph.126.net/?enlarge=true&imgurl="+o.imgurl.replace(/(^\s*)|(\s*$)/g,"")+"_180x100x1x95.jpg"):o.imgurl="http://s2.open.126.net/ocb/res/img/default.jpg")}var c=n.tmpl(e,t.result);c.eq(5).addClass("g-hide"),n("#j-guessRow").html(c)}},i=function(){p._utracker(),n.ajax({url:"http://c.open.163.com/opensg/opensg.do",data:{uuid:n.cookie("__oc_uuid"),ursid:t.openCourse.util.isLogin()||"",count:6},scriptCharset:"utf-8",dataType:"jsonp",jsonp:"callback"}).done(e)};i(),n("#j-guessBtn").click(function(){i()})}function a(){var t=n("#j-xtx-btn"),e=n("#j-xtx-dialog"),i=e.find(".j-close");t.click(function(){o()}),i.click(function(){n.unblockUI()});var o=function(){n.blockUI({message:e,blockMsgClass:"u-xtx-dialog"})}}function r(){n.ajax({url:"http://c.open.163.com/pack/notify.do",scriptCharset:"utf-8",dataType:"jsonp",jsonp:"callback"}).done(function(t){t&&t.notify&&s(t.notify)})}function s(t){var e=(new Date).getTime();if(e>=t.sendTime&&e<t.endTime&&t.status==j){f=t.id;var i=n.cookie("open_package_push_"+f);if(i)return;var o=n("#j-package-dialog");o.find(".j-close").on("click",function(){n.unblockUI(),l()}),o.find(".j-look").on("click",l),o.find(".j-look").attr("href",t.url),o.find(".j-tit").text(t.tag),o.find(".j-bg").attr("src",t.picUrl),o.find(".j-morelink").attr("href",t.extraUrl),n.blockUI({message:o,blockMsgClass:"u-packdialog"})}}function l(){n.cookie("open_package_push_"+f,"true",{expires:365,domain:".163.com",path:"/"})}function u(){d.switchSlide({pevBtn:"#j-package-switch-pevbtn",nextBtn:"#j-package-switch-nextbtn",container:"#j-package-switch-container",wrap:[{itemWidth:240,containerWidth:960,scrollCount:4,baseleft:0},{itemWidth:295,containerWidth:1180,scrollCount:4,baseleft:0}]})}var p=e.ns("util"),d=e.ns("ui");n.blockUI.defaults.css={},t.returnCount=function(t){t&&(n("#j-ted").text("�?"+t.TED+"门课�?"),n("#j-khan").text("�?"+t["可汗学院"]+"门课�?"),n("#j-china").text("�?"+t["中国大学视频公开�?"]+"门课�?"),n("#j-world").text("�?"+t["国际名校公开�?"]+"门课�?"),n("#j-bbc").text("�?"+t.BBC+"门课�?"),n("#j-yanj").text("�?"+t["演讲"]+"门课�?"))};var f,j=1;a(),o(),i(),c(),r(),u()}(window,window.jQuery,window.openCourse||{});