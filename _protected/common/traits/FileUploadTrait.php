<?php

namespace common\traits;

use Yii;

use yii\base\Model;
use yii\imagine\Image;
use Imagine\Image\Box;
use Imagine\Image\Point;
use Imagine\Image\ImageInterface;
use Imagine\Imagick\Imagine as imagick;
use Imagine\Gd\Imagine as gd;

trait FileUploadTrait
{
	public function uploadFile($file,$name,$main_folder,$size)
    {
		$files =  str_replace(' ','-',$name);
		$uploadPath = Yii::getAlias('@upload') .'/'. $main_folder .'/'. $files;		
		if (!file_exists(Yii::getAlias('@upload') .'/'. $main_folder )) {
				mkdir(Yii::getAlias('@upload').'/'. $main_folder , 0777, true);
		}		if($file->saveAs($uploadPath)){
			return $files;
		}else{
			return false;
		}
    }
}


