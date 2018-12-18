<?php
namespace frontend\widgets;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use common\models\SliderImages;
class SliderWid extends Widget{
    public function run()	{
        $slides = SliderImages::find()->where(['slider_id' => 1])->orderBy(['image_order'=>SORT_DESC])->all();
        return $this->render('sliderwid', ['slides' =>  $slides,
        ]);	
		
	}
}