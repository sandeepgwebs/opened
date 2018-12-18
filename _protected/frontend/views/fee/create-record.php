<?php

use yii\helpers\Html;
use common\rbac\models\AuthItem;
use frontend\assets\UserAsset;
use nenad\passwordStrength\PasswordInput;
use yii\widgets\ActiveForm;
use frontend\widgets\Alert;
use kartik\file\FileInput;

if($model->file != ''){
    $image = "<a href='".Yii::$app->params["baseurl"] . "/uploads/downloads/". $model->file."' target='_blank' >Download</a>";

}else{
    $image = "<img src='".Yii::$app->params["baseurl"]."/uploads/no-image.png".' >';
}
$this->registerJsFile(Yii::$app->view->theme->baseUrl.'/js/calculator.js', ['depends' => [UserAsset::className()]]);
$this->title = Yii::t('app', 'Complete your registration for payment');

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];

$this->params['breadcrumbs'][] = $this->title;

?>

<header class="sub-page-head">

    <div class="container-fluid">

        <div class="intro-text">

            <h3><!--?= $model->name ?--></h3>

        </div>

    </div>

</header>

<?= Alert::widget() ?>

<section id="fee-form">

    <div class="container">


        <div class="row">

            <div class="col-md-12">
                <h2 class="section-heading text-center"><?=$this->title?></h2>
            </div>
            <div class="col-md-6 col-md-offset-3">


                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

                <?=$form->field($model, 'payment_method')->hiddenInput()->label(false);?>

                <?= $form->field($model, 'qualification')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'institute')->textInput(['maxlength' => true]) ?>

                <?php //$form->field($model, 'user_type')->radioList($model->userTypes)->label('I am:'); ?>
                <?= $form->field($model, 'user_type')->dropDownList(
                    $model->userTypes,
                    [
                        'prompt'=>'- Select author type -',
                        'class'=>'form-control select2',
                    ]
                )->label('I am:');
                ?>

                <?= $form->field($model, 'no_of_papers')->textInput()->label('No. of Pages in The Paper') ?>

                <?php
                // Usage with ActiveForm and model
                echo $form->field($model, 'file')->widget(FileInput::classname(),
                    [
                        'options' => ['accept' => 'file/*','multiple' => false],
                        'pluginOptions' => [
                            'showCaption' => false,
                            'showRemove' => FALSE,
                            'showUpload' => false,
                            'initialPreview'=>$image,
                        ]
                    ])->label('Upload Papers');
                ?>
                <?php
                // Usage with ActiveForm and model
                echo $form->field($model, 'copyright_form')->widget(FileInput::classname(),
                    [
                        'options' => ['accept' => 'file/*','multiple' => false],
                        'pluginOptions' => [
                            'showCaption' => false,
                            'showRemove' => FALSE,
                            'showUpload' => false,
                            'initialPreview'=>$image,
                        ]
                    ])->label('Upload Copyright Form');
                ?>
                <?php
                // Usage with ActiveForm and model
                echo $form->field($model, 'slip')->widget(FileInput::classname(),
                    [
                        'options' => ['accept' => 'file/*','multiple' => false],
                        'pluginOptions' => [
                            'showCaption' => false,
                            'showRemove' => FALSE,
                            'showUpload' => false,
                            'initialPreview'=>$image,
                        ]
                    ])->label('Upload Payment Slip');
                ?>
                <?= $form->field($model, 'currency')->dropDownList(
                    $model->currencies,
                    [
                        'prompt'=>'- Select currency opted -',
                        'class'=>'form-control select2',
                    ]
                )->label('Select currency:');
                ?>
                <?= $form->field($model, 'payment1')->textInput()->label('Amount Paid'); ?>
                <?= $form->field($model, 'paper_no')->textInput()->label('Paper no. of Easychair Submission'); ?>

                <?= $form->field($model, 'journal_id')->radioList($model->journals)->label('I want to publish papers in:'); ?>


                <div class="form-group">
                    <?= Html::submitButton('Register & Upload Payment Slip', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>



            </div>
        </div>
    </div>
</section>

