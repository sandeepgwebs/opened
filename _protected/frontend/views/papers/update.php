<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Papers */

$this->title = 'Update Papers: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Papers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="papers-update container" style="margin-top:180px;">

    <h1><?= Html::encode($this->title) ?></h1>
<div class="papers-form">
	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
	
				<h3>Author Information</h3>
	<div class="row authors">
		<div class="col-sm-12">		
			<div class="form-text">
				<p>
				Fill out the form below to enter author(s) details of the papers which are being submitted. At least one author details are mandatory. You can enter multiple authors for single submission.
				<ul>
					<li><b>Email</b> addresses of the authors will be used for communication purpose only.</li>
					<li><b>webpage</b> if entered should be other than the organization webpage.</li>
					<li>If you select the <b>"Corresponding author"</b> field for the author, then he will recieve email messages from the system about this submission.</li>
				</ul>
				</p>
			</div>
		</div>
	</div>
	<h3>Paper Information</h3>
		<div class="row pp">
		<div class="col-xs-12">
		<div class="form-box papers">
		<?= $form->field($model, 'count')->hiddenInput()->label(false) ?>
		
		<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

		<?= $form->field($model, 'abstract')->textarea(['rows' => 6])->hint('The abstract should be entered as plain text. Do not use html elements here.') ?>

		<?= $form->field($model, 'key_words')->textarea(['rows' => 6])->hint('The keywords must be entered comma separated. Enter atleast three keywords to characterize your paper submission.') ?>
		
		<div class="row">
			<div class="col-sm-12 file-info">
				<div class="form-text">
					<div class="form-group">
							<p>The file must be in pdf/doc/docx format</p>
						
					</div>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="form-text"><?php
				if($model->pfile){ ?>
				<div class="form-group field-papers-title required has-success">
					<label class="control-label" for="papers-title">File</label>
					<?= '<a href="'.Yii::$app->params['baseurl'].'/uploads/papers/'.$model->pfile.'" target="_blank" >'.$model->pfile.'</a>'; ?>

					<div class="help-block"></div>
				</div>
					<?php	
					}
					$image = Yii::$app->params['baseurl'] . '/uploads/gal.png';
					// Usage with ActiveForm and model
					echo $form->field($model, 'pfile')->widget(FileInput::classname(), 
					[
						'options' => ['accept' => 'file/*','multiple' => false],    
						'pluginOptions' => [
							'value' => $model->pfile,
							'showCaption' => false,
							'showRemove' => true,
							'showUpload' => false,
							'initialPreview'=>[
								Html::img($image, ['class'=>'file-preview-image', 'alt'=>'', 'title'=>'' ,'style' => ['width' => '150px']]),
							],
						]
					]);
					?>
				</div>
			</div>
			
		</div>
	</div>
	</div>
</div>	
		
	
	


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Submit Papers' : 'Update Papers', ['class' => $model->isNewRecord ? 'btn btn-success subm' : 'btn btn-primary subm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


</div>
