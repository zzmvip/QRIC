<?php

// +----------------------------------------------------------------------
// |  标签解析库
// +----------------------------------------------------------------------

namespace Common\TagLib;

use Think\Template\TagLib;

class Adsousou extends TagLib {

    // 标签定义
    protected $tags = array(
        //内容标签
        'article' => array('attr' => 'action,num,page,return,where,order,catid,subcat,posid'),
    );


    /**
     * 内容标签 output参数等于1时
     * 标签：<article></article>
     * 作用：内容模型相关标签，可调用栏目，列表等常用信息
     * 用法示例：<article catid="$catid"  order="id DESC" num="4" page="$page"> .. HTML ..</article>
     * 参数说明：
     * 	基本参数
     * 		@page		当前分页号，默认$page，当传入该参数表示启用分页，一个页面只允许有一个page，多个标签使用多个page会造成不可预知的问题。
     * 		@num		每次返回数据量
     * 		@catid		栏目id（必填），列表页，内容页可以使用 $catid 获取当前栏目。
     * 	公用参数：
     * 		@pagefun                      分页函数，默认page
     * 		@pagetp		分页模板，必须是变量传递
     * 		@return		返回值变量名称，默认data
     * 	#当action为lists时，调用栏目信息列表标签
     * 	#用法示例：<article catid="$catid"  order="id DESC" num="4" page="$page"> .. HTML ..</article>
     * 	独有参数：
     * 		@order		排序，例如“id DESC”
     * 		@where		sql语句的where部分 例如：`thumb`!='' AND `status`=99
     * 		@thumb		是否仅必须缩略图，1为调用带缩略图的
     * 		@moreinfo                    是否调用副表数据 1为是
     * +----------------------------------------------------------
     * @access public
      +----------------------------------------------------------
     * @param string $attr 标签属性
     * @param string $content  标签内容
      +----------------------------------------------------------
     * @return string|void
      +----------------------------------------------------------
     */
    public function _article($tag, $content) {
        $tag['catid'] = $catid = $tag['catid'];
        //每页显示总数
        $tag['num'] = $num = (int) $tag['num'];
        //当前分页参数
        $tag['page'] = $page = (isset($tag['page'])) ? ( (substr($tag['page'], 0, 1) == '$') ? $tag['page'] : (int) $tag['page'] ) : 0;
        //分页函数，默认page
        $tag['pagefun'] = $pagefun = empty($tag['pagefun']) ? "page" : trim($tag['pagefun']);
        //数据返回变量
        $tag['return'] = $return = empty($tag['return']) ? "data" : $tag['return'];
		//排序
        $tag['order'] = $order = empty($tag['order']) ? "id desc" : $tag['order'];
		//城市
        //$tag['city'] = $order = empty($tag['city']) ? "id desc" : $tag['city'];

		//拼接php代码
        $parseStr = '<?php';
		if($catid=='catid'){
			$name = I('get.name');
			$class = M('ArticleClass')->where(array('enname'=>$name))->find();
			if(!empty($class)){
				$tag['catid'] = $catid = $class['id'];
			}
		}
		$parseStr .= ' $where = array();';
		if(!empty($tag["catid"])) $parseStr .= ' $where["catid"] = array("in","'.$catid.'");';
		
		
		if($tag["subcat"]==1){
			$parseStr .= ' $where2["pid"] = array("in","'.$catid.'");';
			$parseStr .= ' $subcat = M("ArticleClass")->where($where2)->select();';
			$parseStr .= ' if(!empty($subcat)){';
				$parseStr .= ' $scatid = "";';
				$parseStr .= ' foreach($subcat as $key=>$val){';
					$parseStr .= ' if($val["id"]){';
						$parseStr .= ' $scatid .= $val["id"];';
					$parseStr .= ' }';
					$parseStr .= ' if($key+1<count($subcat)){';
						$parseStr .= ' $scatid .= ",";';
					$parseStr .= ' }';
				$parseStr .= ' }';
				$parseStr .= ' $where["catid"] = array("in",$scatid);';
			$parseStr .= ' }';
		}
		
		$parseStr .= ' $where["status"] = 1;';
		if(!empty($tag["where"])){
			$parseStr .= ' $where["_string"] = " '.$tag["where"].'";';
			/*$parseStr .= ' $w = explode(",","'.$tag["where"].'");';
			$parseStr .= ' foreach($w as $v){';
				$parseStr .= ' if($v){';
					$parseStr .= ' $w2 = explode("!=",$v);';
					
					$parseStr .= ' dump($w2);$where[$w2["0"]] = $w2["1"];';
				$parseStr .= ' }';
			$parseStr .= ' }';*/
		}
		if(!empty($tag["posid"])){
			if(!empty($tag["where"])){
				$parseStr .= ' $where["_string"] = " '.$tag["where"].' && FIND_IN_SET(\"'.$tag["posid"].'\",posid)";';
			}else{
				$parseStr .= ' $where["_string"] = " FIND_IN_SET(\"'.$tag["posid"].'\",posid)";';
			}
		}

		$parseStr .= ' $where["cityen"] = "'.session('cityen').'";';
		$parseStr .= '  ?>';
        //拼接php代码
        $parseStr .= '<?php';
			$parseStr .= ' $count = M("Article")->where($where)->count();';
			$parseStr .= ' $Page = new \Think\Page($count,'.$num.');';
			$parseStr .= ' $pages = $Page->show();';
			
			//$parseStr .= ' $' . $return . '  = M("Article")->order("'.$order.'")->where("'.$where.'")->limit($Page->firstRow,$Page->listRows)->select();';
			if(!empty($tag["limit"])){
				$parseStr .= ' $lists = M("Article")->order("'.$order.'")->where($where)->limit("'.$tag["limit"].'")->select();';
			}else{
				$parseStr .= ' $lists = M("Article")->order("'.$order.'")->where($where)->limit($Page->firstRow,$Page->listRows)->select();';
			}
			//$parseStr .= ' echo M("Article")->getLastSql();';
			$parseStr .= ' foreach($lists as $key=>$val){';
				$parseStr .= ' $info2 = M("Article_common")->where(array("id"=>$val["id"]))->find();';
				$parseStr .= ' $Model = new \Common\Model\Model();';
				$parseStr .= ' if($Model->table_exists("article_class_".$val["catid"])){';
					$parseStr .= ' $info3 = M("Article_class_".$val["catid"])->where(array("id"=>$val["id"]))->find();';
				$parseStr .= '}';
				$parseStr .= ' if(!empty($info2)) $info2["id"] = $val["id"];';
				$parseStr .= ' if(!empty($info3)) $info3["id"] = $val["id"];';
				$parseStr .= ' if(!empty($info2)) $lists[$key] = array_merge($val, $info2);';
				$parseStr .= ' if(!empty($info3)) $lists[$key] = array_merge($val, $info3);';
				$parseStr .= ' if(!empty($info2) && !empty($info3)) $val = array_merge($lists[$key], $info2, $info3);';
				
			$parseStr .= '}';
			$parseStr .= ' $' . $return . '  = $lists;';
			
        $parseStr .= ' ?>';
        //解析模板
        $parseStr .= $this->tpl->parse($content);
        return $parseStr;
    }
}
