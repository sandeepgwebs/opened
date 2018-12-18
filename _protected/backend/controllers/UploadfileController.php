<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\helpers\Url;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use common\traits\ImageUploadTrait;

class UploadfileController extends BackendController
{
	use ImageUploadTrait;
    public function behaviors()
    {
	    $behaviors = parent::behaviors();
		return $behaviors;
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return "hello";
    }
	public function actionUrl()
    { 
		Yii::$app->controller->enableCsrfValidation = false;
        $uploadedFile = UploadedFile::getInstanceByName('upload'); 
	
        $mime = \yii\helpers\FileHelper::getMimeType($uploadedFile->tempName);
	
        $file = time()."_".$uploadedFile->name;

		$size = Yii::$app->params['folders']['size'];
		$main_folder = "ckeditor";
		

		$allowedImageTypes = array( "image/pjpeg","image/jpeg","image/jpg","image/png","image/x-png","image/gif");
		if (!in_array($mime, $allowedImageTypes))  
		{
			$main_folder = "ckeditor/main";
			$image_name = $this->uploadckFile($uploadedFile,$file,$main_folder);
			$url =  str_replace('/backend','',Url::home(true)).'/uploads/ckeditor/main/'.$image_name;
		    $uploadPath = Yii::$app->params['uploadurl'].'/uploads/ckeditor/main/'.$file;	
		}else{
			$image_name = $this->uploadNewckImage($uploadedFile,$file,$main_folder,$size);
			$url =  str_replace('/backend','',Url::Home(true)).'/uploads/ckeditor/main/'.$image_name;
		    $uploadPath = Yii::$app->params['uploadurl'].'/uploads/ckeditor/'.$file;
		}




        //extensive suitability check before doing anything with the file…
        if ($uploadedFile==null)
        {
           $message = "No file uploaded.";
        }
        else if ($uploadedFile->size == 0)
        {
           $message = "The file is of zero length.";
        }
        else if ($uploadedFile->tempName==null)
        {
           $message = "You may be attempting to hack our server. We're on to you; expect a knock on the door sometime soon.";
        }
		
        $funcNum = $_GET['CKEditorFuncNum'] ;
        echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";        
    }
	public function actionBrowse()
    {

        $this->layout = 'main-browse';

        $dir = Yii::$app->params['uploadurl'].'/uploads/ckeditor/main/';

        $files = glob("$dir*.{jpg,jpe,jpeg,png,gif,ico,pdf,doc,docx}", GLOB_BRACE);


        return $this->render('browse', [
            'files' => $files
        ]);
	}

}
