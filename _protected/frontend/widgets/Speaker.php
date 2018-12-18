<?php
namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use common\models\Speakers;

class Speaker extends Widget
{
	public function run()
	{
        $speaker = Speakers::findAll(['status' => 1]);
		return $this->render('speakers', 
		[
            'model'  => $speaker,
        ]);
		
	}
}