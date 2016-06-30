<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Model;
use Think\Model;

/**
 * 文件模型
 * 负责文件的下载和上传
 */

class FileModel extends Model{
	/**
	 * 文件模型自动完成
	 * @var array
	 */
	protected $_auto = array(
		array('create_time', NOW_TIME, self::MODEL_INSERT),
	);

	/**
	 * 文件模型字段映射
	 * @var array
	 */
	protected $_map = array(
		'type' => 'mime',
	);

	/**
	 * 文件上传
	 * @param  array  $files   要上传的文件列表（通常是$_FILES数组）
	 * @param  array  $setting 文件上传配置
	 * @param  string $driver  上传驱动名称
	 * @param  array  $config  上传驱动配置
	 * @return array           文件上传成功后的信息
	 */
	public function upload($files, $setting, $driver = 'Local', $config = null){
		/* 上传文件 */
		$setting['callback'] = array($this, 'isFile');
		$Upload = new \Think\Upload($setting, $driver, $config);
		$info   = $Upload->upload($files);

		/* 设置文件保存位置 */
		$this->_auto[] = array('location', 'Ftp' === $driver ? 1 : 0, self::MODEL_INSERT);

		if($info){ //文件上传成功，记录文件信息
			foreach ($info as $key => &$value) {
				/* 已经存在文件记录 */
				if(isset($value['id']) && is_numeric($value['id'])){
					$value['path'] = substr($setting['rootPath'], 1).$value['savepath'].$value['savename'];	//在模板里的url路径
					continue;
				}

				$value['path'] = substr($setting['rootPath'], 1).$value['savepath'].$value['savename'];	//在模板里的url路径
				/* 记录文件信息 */
				/*if($this->create($value) && ($id = $this->add())){
					$value['id'] = $id;
				} else {
					//TODO: 文件上传成功，但是记录文件信息失败，需记录日志
					unset($info[$key]);
				}*/
			}
			return $info; //文件上传成功
		} else {
			$this->error = $Upload->getError();
			return false;
		}
	}

	/**
	 * 下载指定文件
	 * @param  number  $root 文件存储根目录
	 * @param  integer $id   文件ID
	 * @param  string   $args     回调函数参数
	 * @return boolean       false-下载失败，否则输出下载文件
	 */
	public function download($root, $id, $callback = null, $args = null){
		/* 获取下载文件信息 */
		$file = $this->find($id);
		if(!$file){
			$this->error = '不存在该文件！';
			return false;
		}

		/* 下载文件 */
		switch ($file['location']) {
			case 0: //下载本地文件
				$file['rootpath'] = $root;
				return $this->downLocalFile($file, $callback, $args);
			case 1: //TODO: 下载远程FTP文件
				break;
			default:
				$this->error = '不支持的文件存储类型！';
				return false;

		}

	}

	/**
	 * 检测当前上传的文件是否已经存在
	 * @param  array   $file 文件上传数组
	 * @return boolean       文件信息， false - 不存在该文件
	 */
	public function isFile($file){
		if(empty($file['md5'])){
			throw new Exception('缺少参数:md5');
		}
		/* 查找文件 */
		$map = array('md5' => $file['md5']);
		return $this->field(true)->where($map)->find();
	}

	/**
	 * 下载本地文件
	 * @param  array    $file     文件信息数组
	 * @param  callable $callback 下载回调函数，一般用于增加下载次数
	 * @param  string   $args     回调函数参数
	 * @return boolean            下载失败返回false
	 */
	private function downLocalFile($file, $callback = null, $args = null){
		if(is_file($file['rootpath'].$file['savepath'].$file['savename'])){
			/* 调用回调函数新增下载数 */
			is_callable($callback) && call_user_func($callback, $args);

			/* 执行下载 */ //TODO: 大文件断点续传
			header("Content-Description: File Transfer");
			header('Content-type: ' . $file['type']);
			header('Content-Length:' . $file['size']);
			if (preg_match('/MSIE/', $_SERVER['HTTP_USER_AGENT'])) { //for IE
				header('Content-Disposition: attachment; filename="' . rawurlencode($file['name']) . '"');
			} else {
				header('Content-Disposition: attachment; filename="' . $file['name'] . '"');
			}
			readfile($file['rootpath'].$file['savepath'].$file['savename']);
			exit;
		} else {
			$this->error = '文件已被删除！';
			return false;
		}
	}
	//生成图片的缩略图，30*30,50*50,100*100
	//是否覆盖 0不覆盖 ，1覆盖
	//$path 外部指定文件
	public function thumbs($width=null,$height=null,$fugai=false,$path=null,$point=null){

		if(empty($width))$width=50;
		if(empty($height))$height=50;
		$width = intval($width);
		$height = intval($height);

		if(!file_exists($path)){
			return false;
		}
	
		$imgSize = GetImageSize($path);
		$houzhui = explode('.',$path);
		$houzhui = array_pop($houzhui);
        $imgType = $imgSize[2];
		
		if(!is_array($point)){
			$point = array("x"=>0,"y"=>0,"w"=>$imgSize[0],"h"=>$imgSize[1]);
		}

         switch ($imgType)
        {
            case 1:
                $srcImg = @ImageCreateFromGIF($path);
                break;
            case 2:
                $srcImg = @ImageCreateFromJpeg($path);
                break;
            case 3:
                $srcImg = @ImageCreateFromPNG($path);
                break;
			case 6:
				$srcImg = self::ImageCreateFromBMP($path);
                break;
			default:				
			;
        }
		
		//缩略图片资源
		$targetImg=ImageCreateTrueColor($width,$height);
		$white = ImageColorAllocate($targetImg, 255,255,255);        
		imagefill($targetImg,0,0,$white); // 从左上角开始填充背景
		ImageCopyResampled($targetImg,$srcImg,0,0,$point['x'],$point['y'],$width,$height,$point['w'],$point['h']);//缩放
		if($fugai){
			$tag_name = '';			
		}else{
			$tag_name = '_'.$width.$height.'.'.$houzhui;		
		}
		
		switch ($imgType) {
                case 1:
                    ImageGIF($targetImg,$path.$tag_name);
                    break;
                case 2:
                    ImageJpeg($targetImg,$path.$tag_name);
                    break;
                case 3:
                    ImagePNG($targetImg,$path.$tag_name);
                    break;
				default:
					ImageJpeg($targetImg,$path.$tag_name);
                    break;
				;
        }
            ImageDestroy($srcImg);
            ImageDestroy($targetImg);
		
		
		return $houzhui;	
		
	}
	//BMP图片解析
	static private function ImageCreateFromBMP($filename=null){
		if (!$f1 = fopen( $filename, "rb" ))
			return FALSE;
		
		$FILE = unpack( "vfile_type/Vfile_size/Vreserved/Vbitmap_offset", fread( $f1, 14 ) );
		if ( $FILE['file_type'] != 19778 )
			return FALSE;
		
		$BMP = unpack( 'Vheader_size/Vwidth/Vheight/vplanes/vbits_per_pixel' . '/Vcompression/Vsize_bitmap/Vhoriz_resolution' . '/Vvert_resolution/Vcolors_used/Vcolors_important', fread( $f1, 40 ) );
		$BMP['colors'] = pow( 2, $BMP['bits_per_pixel'] );
		if ( $BMP['size_bitmap'] == 0 )
			$BMP['size_bitmap'] = $FILE['file_size'] - $FILE['bitmap_offset'];
		$BMP['bytes_per_pixel'] = $BMP['bits_per_pixel'] / 8;
		$BMP['bytes_per_pixel2'] = ceil( $BMP['bytes_per_pixel'] );
		$BMP['decal'] = ($BMP['width'] * $BMP['bytes_per_pixel'] / 4);
		$BMP['decal'] -= floor( $BMP['width'] * $BMP['bytes_per_pixel'] / 4 );
		$BMP['decal'] = 4 - (4 * $BMP['decal']);
		if ( $BMP['decal'] == 4 )
			$BMP['decal'] = 0;
		
		$PALETTE = array();
		if ( $BMP['colors'] < 16777216 ){
			$PALETTE = unpack('V'.$BMP['colors'],fread( $f1,$BMP['colors'] * 4 ) );
		}
		
		$IMG = fread( $f1, $BMP['size_bitmap'] );
		$VIDE = chr(0);
		
		$res = imagecreatetruecolor( $BMP['width'], $BMP['height'] );
		$P = 0;
		$Y = $BMP['height'] - 1;
		while( $Y >= 0 ){
			$X = 0;
			while( $X < $BMP['width'] ){
				if ( $BMP['bits_per_pixel'] == 32 ){
					$COLOR = unpack( "V", substr( $IMG,$P,3));
					$B = ord(substr($IMG, $P,1));
					$G = ord(substr($IMG, $P+1,1));
					$R = ord(substr($IMG, $P+2,1));
					$color = imagecolorexact( $res, $R, $G, $B );
					if ( $color == -1 )
						$color = imagecolorallocate( $res, $R, $G, $B );
					$COLOR[0] = $R*256*256+$G*256+$B;
					$COLOR[1] = $color;
				}elseif ( $BMP['bits_per_pixel'] == 24 )
					$COLOR = unpack( "V", substr( $IMG, $P, 3 ) . $VIDE );
				elseif ( $BMP['bits_per_pixel'] == 16 ){
					$COLOR = unpack( "n", substr( $IMG, $P, 2 ) );
					$COLOR[1] = $PALETTE[$COLOR[1] + 1];
				}elseif ( $BMP['bits_per_pixel'] == 8 ){
					$COLOR = unpack( "n", $VIDE . substr( $IMG, $P, 1 ) );
					$COLOR[1] = $PALETTE[$COLOR[1] + 1];
				}elseif ( $BMP['bits_per_pixel'] == 4 ){
					$COLOR = unpack("n",$VIDE . substr($IMG, floor( $P ),1));
					if ( ($P * 2) % 2 == 0 )
						$COLOR[1] = ($COLOR[1] >> 4);
					else
						$COLOR[1] = ($COLOR[1] & 0x0F);
					$COLOR[1] = $PALETTE[$COLOR[1] + 1];
				}elseif ( $BMP['bits_per_pixel'] == 1 ){
					$COLOR = unpack( "n", $VIDE . substr( $IMG, floor( $P ), 1 ) );
					if ( ($P * 8) % 8 == 0 )
						$COLOR[1] = $COLOR[1] >> 7;
					elseif ( ($P * 8) % 8 == 1 )
						$COLOR[1] = ($COLOR[1] & 0x40) >> 6;
					elseif ( ($P * 8) % 8 == 2 )
						$COLOR[1] = ($COLOR[1] & 0x20) >> 5;
					elseif ( ($P * 8) % 8 == 3 )
						$COLOR[1] = ($COLOR[1] & 0x10) >> 4;
					elseif ( ($P * 8) % 8 == 4 )
						$COLOR[1] = ($COLOR[1] & 0x8) >> 3;
					elseif ( ($P * 8) % 8 == 5 )
						$COLOR[1] = ($COLOR[1] & 0x4) >> 2;
					elseif ( ($P * 8) % 8 == 6 )
						$COLOR[1] = ($COLOR[1] & 0x2) >> 1;
					elseif ( ($P * 8) % 8 == 7 )
						$COLOR[1] = ($COLOR[1] & 0x1);
					$COLOR[1] = $PALETTE[$COLOR[1] + 1];
				}else
					return FALSE;
				imagesetpixel( $res, $X, $Y, $COLOR[1]);
				$X++;
				$P+= $BMP['bytes_per_pixel'];
			}
			$Y--;
			$P+= $BMP['decal'];
		}
		fclose($f1);		
		return $res;
	}

}
