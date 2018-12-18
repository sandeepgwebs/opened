<?php
namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use common\models\ExamDate;

class Exam extends Widget
{
	public function run()
	{
		$exam =  ExamDate::findAll(['status' => 1]);		
		return $this->render('exam', 
		[
            'model'  => $exam,
        ]);
		
	}
}