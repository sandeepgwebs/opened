<?php
namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use common\models\Testimonial;


class TestimonialForm extends Widget
{
    public function run()
    {
        $testmodel = new Testimonial();
        return $this->render('tetimonial',['model'=> $testmodel ] );
    }
}