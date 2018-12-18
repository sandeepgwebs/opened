<?php
namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use common\models\Gallery;

class Gallerywid extends Widget
{
	public $show;
	public function run()
	{
		if($this->show)
			$model = Gallery::find()->where(['status'=>1])->limit($this->show)->all();		
		else
			$model = Gallery::findAll(['status'=>1]);	
			
		return $this->render('gallrywid', 
		[
            'model'  => $model,
        ]);
		
	}
}