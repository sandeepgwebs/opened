<?php
namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use common\models\Sponser;use common\models\SponserCategory;

class Client extends Widget
{
	public function run()
	{
        $model = SponserCategory::findAll(['status'=>1]);			
		return $this->render('client', 
		[
            'model'  => $model,
        ]);
		
	}
}