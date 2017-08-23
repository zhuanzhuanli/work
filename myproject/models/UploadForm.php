<?php
namespace app\models;

require_once(dirname(__FILE__).'/../vendor/productai/src/API.php');
use yii\base\Model;
use yii\web\UploadedFile;
use ProductAI;


/**
* UploadForm is the model behind the upload form.
*/
class UploadForm extends Model
{
	/**
	* @var UploadedFile file attribute
	*/
	public $file;

	private $product_ai;
	const  ACCESS_KEY_ID = '0d30d0979a1c9410fe44cc6387b255b7';
	const  SECRET_KEY = 'ef4c95300c780f41986c036c7b166908';
	const  SERVICE_TYPE = 'search';
	const  SERVICE_ID = 'usyq3ic1';

	public function __construct()
    { 
        parent::__construct(); 
		$this->product_ai = new ProductAI\API(self::ACCESS_KEY_ID, self:SECRET_KEY);
		$this->product_ai->curl_opt[CURLOPT_TIMEOUT] = 120;
    }


	/**
	* @return array the validation rules.
	*/

	public function rules()
	{
		return [
			[['file'], 'file', 'extensions' => 'gif, jpg, png',],
		];
	}



	public function upload()
	{

		//文件上传存放的目录
		$dir = "../public/uploads";
		if (!is_dir($dir))
			mkdir($dir,0777,true);
		if ($this->validate()) 
		{
			//文件名
			$fileName = date("Ymd").date("HiiHsHis").$this->file->baseName . "." . $this->file->extension;
			$img = $dir."/". $fileName;
			$this->file->saveAs($img);

			

			// 将大小调整为宽和高不大于800px的图片
			$name = date("Ymd").date("HiiHsHis").$this->file->baseName.'_800';
			if($this->file->extension == 'jpg')
			{
			   $im = imagecreatefromjpeg($img);
			   
			}else if($this->file->extension == 'png')
			{
			   $im = imagecreatefrompng($img);
			   
			}else if($this->file->extension == 'gif')
			{
			   $im = imagecreatefromgif($img);
			   
			}
			$tmp =  $this -> resizeImage($im, 800, 800, $name, $this->file->extension);
			$fileName =$name. "." . $this->file->extension;
			
			//图片serach
			$res = $this -> search($filename)
 
		}
	
		return $res;
	}


	public function search($filename)
	{
		//SearchImageByString
		$result = $product_ai->searchImage($service_type, $service_id, '@'.$filename);
		$res = json_decode($result);
        return $res->results;
	}



   /*
	参数说明：

	$im 图片对象，应用函数之前，需要用imagecreatefromjpeg()读取图片对象，如果PHP环境支持PNG，GIF，也可使用imagecreatefromgif()，imagecreatefrompng()；

	$maxwidth 定义生成图片的最大宽度（单位：像素）

	$maxheight 生成图片的最大高度（单位：像素）

	$name 生成的图片名

	$filetype 最终生成的图片类型（.jpg/.png/.gif）
	*/
	function resizeImage($im,$maxwidth,$maxheight,$name,$filetype)
	{
		$pic_width = imagesx($im);
		$pic_height = imagesy($im);

		if(($maxwidth && $pic_width > $maxwidth) || ($maxheight && $pic_height > $maxheight))
		{
			if($maxwidth && $pic_width>$maxwidth)
			{
				$widthratio = $maxwidth/$pic_width;
				$resizewidth_tag = true;
			}

			if($maxheight && $pic_height>$maxheight)
			{
				$heightratio = $maxheight/$pic_height;
				$resizeheight_tag = true;
			}

			if($resizewidth_tag && $resizeheight_tag)
			{
				if($widthratio<$heightratio)
					$ratio = $widthratio;
				else
					$ratio = $heightratio;
			}

			if($resizewidth_tag && !$resizeheight_tag)
				$ratio = $widthratio;
			if($resizeheight_tag && !$resizewidth_tag)
				$ratio = $heightratio;

			$newwidth = $pic_width * $ratio;
			$newheight = $pic_height * $ratio;

			if(function_exists("imagecopyresampled"))
			{
				$newim = imagecreatetruecolor($newwidth,$newheight);
			   imagecopyresampled($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);
			}
			else
			{
				$newim = imagecreate($newwidth,$newheight);
			   imagecopyresized($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);
			}

			$name = $name.$filetype;
			imagejpeg($newim,$name);
			imagedestroy($newim);
		}
		else
		{
			$name = $name.$filetype;
			imagejpeg($im,$name);
		}
		return $name;
	}



}

