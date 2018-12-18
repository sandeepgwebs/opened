<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\widgets\Alert;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = Yii::t('app', 'Add comment to accept paper');
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
	<div class="container custom-col">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h2 class="section-heading text-center">Add Comment for Paper Acceptance</h2>
				<div class="col-lg-12 well bs-component">

					<?php $form = ActiveForm::begin(); ?>

					<?= $form->field($model, 'comment')->textarea(['rows' => 6])->label('The reason for acceptance of paper(if any).') ?>
					<div class="form-group">
						<?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
					</div>

					<?php ActiveForm::end(); ?>
					
				</div>
            </div>			
        </div>
    </div>
</section>
