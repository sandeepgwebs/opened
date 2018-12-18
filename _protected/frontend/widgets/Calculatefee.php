<?php

namespace frontend\widgets;



use Yii;
use yii\base\Widget;
use common\models\Fee;



class Calculatefee extends Widget
{ 

	public function run()
	{

        $model = new Fee();

		return $this->render('calculatefee', [
            'model'  => $model,
        ]);
	}

}