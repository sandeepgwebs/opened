<?php
use nenad\passwordStrength\PasswordInput;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use frontend\widgets\Alert;
//use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\file\FileInput;
if($model->file != ''){
    $image = "<a href='".Yii::$app->params["baseurl"] . "/uploads/downloads/". $model->file."' target='_blank' >Download</a>";
	
}else{
    $image = "<img src='".Yii::$app->params["baseurl"] . "/uploads/no-image.png".' >';
}

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = Yii::t('app', 'Create a Conference Chair Account');
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

<section id="committees">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h2 class="section-heading text-left">Create Chair Account</h2>
                <?php $form = ActiveForm::begin(['id' => 'form-signup', 'options' => ['enctype' => 'multipart/form-data']]); ?>

                    <?= $form->field($model, 'fname') ?>
                    <?= $form->field($model, 'lname') ?>
                    <?= $form->field($model, 'phone') ?>
                    <?= $form->field($model, 'email') ?>
                    <?= $form->field($model, 'password')->passwordInput() ?>
                    <?= $form->field($model, 'repassword')->passwordInput() ?>
					<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
					 <?= $form->field($model, 'theme')->textarea(['rows' => 6])->hint('The theme should be entered as plain text. Do not use html elements here.') ?>
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
						])->label("Upload File (Propsal for Special Session):");
					?>
                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('app', 'Create'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>
			</div>
        </div>
    </div>

</section>