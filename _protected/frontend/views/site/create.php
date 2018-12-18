<?php
use yii\helpers\Html;
use common\rbac\models\AuthItem;
use nenad\passwordStrength\PasswordInput;
use yii\widgets\ActiveForm;
use frontend\widgets\Alert;

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $role common\rbac\models\Role */
$this->title = Yii::t('app', 'Complete your registration');
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
<section id="committees">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="section-heading text-left"><?=$this->title?></h2>

                <?php $form = ActiveForm::begin(['id' => 'create-user']); ?>


                <?= $form->field($user, 'fname') ?>
                <?= $form->field($user, 'lname') ?>
                <?= $form->field($user, 'phone') ?>
                <?= $form->field($user, 'country')->dropDownList(
                    $user->countries,
                    [
                        'prompt'=>'- Select Country -',
                        'class'=>'form-control select2',
                        'id'=>'country',
                        'onchange'=> '
						$(".loader").show();
						$.post( "'.Yii::$app->urlManager->createUrl('countries/active-states?id=').'"+$(this).val(), function( data ) {
                                      $( "select#state" ).html( data.states );
                                      $( "select#city" ).html( data.cities );
									  $(".loader").hide();
                                  });'

                    ]
                )
                ?>

                <?= $form->field($user, 'state')->dropDownList(
                    ($user->isNewRecord ? array():$states),
                    [
                        'prompt'=>'- Select State -',
                        'class'=>'form-control select2',
                        'id'=>'state',
                        'onchange'=> '
						$(".loader").show();
						$.post( "'.Yii::$app->urlManager->createUrl('countries/active-cities?id=').'"+$(this).val(), function( data ) {
                                          $( "select#city" ).html( data );
										  $(".loader").hide();
                                        });'

                    ]
                )
                ?>

                <?= $form->field($user, 'usercity')->dropDownList(
                    ($user->isNewRecord ? array():$cities),
                    [
                        'prompt'=>'- Select City -',
                        'class'=>'form-control select2',
                        'id'=>'city',
                    ]
                )
                ?>
                <?= $form->field($user, 'password')->passwordInput() ?>
                <?= $form->field($user, 'repassword')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton($user->isNewRecord ? Yii::t('app', 'Create')
                        : Yii::t('app', 'Update'), ['class' => $user->isNewRecord
                        ? 'btn btn-success' : 'btn btn-primary']) ?>

                    <?= Html::a(Yii::t('app', 'Cancel'), ['user/index'], ['class' => 'btn btn-default']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</section>

