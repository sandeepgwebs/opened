<?php

namespace frontend\widgets;



use Yii;

use yii\base\Widget;

use common\models\Downloads;



class Showhome extends Widget

{

	public function run()

	{

        $downloads = Downloads::find()->where(['status'=>1 ,'home_show'=>1])->orderBy(['id' => SORT_DESC])->all();

		return $this->render('showhome', 

		[

            'downloads'  => $downloads,

        ]);

		

	}

}