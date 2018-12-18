<?php
namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use frontend\models\ContactForm;

class Contact extends Widget
{
	public function run()
	{
        $model = new ContactForm();			
		return $this->render('contact', 
		[
            'model'  => $model,
        ]);
		
	}
}