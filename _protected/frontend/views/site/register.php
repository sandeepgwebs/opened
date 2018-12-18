<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\widgets\Alert;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = Yii::t('app', 'Login');
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
            <div class="col-md-6">
                <h2 class="section-heading text-center">Already registered to <?=Yii::$app->name?></h2>
                <div class="col-lg-12 well bs-component">

                    <p><?= Yii::t('app', 'Please fill out the following fields to login:') ?></p>

                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                    <?php //-- use email or username field depending on model scenario --// ?>
                    <?php if ($user->scenario === 'lwe'): ?>
                        <?= $form->field($user, 'email') ?>
                    <?php else: ?>
                        <?= $form->field($user, 'username') ?>
                    <?php endif ?>

                    <?= $form->field($user, 'password')->passwordInput() ?>

                    <div style="color:#999;margin:1em 0">
                        <?= Yii::t('app', 'If you forgot your password you can') ?>
                        <?= Html::a(Yii::t('app', 'reset it'), ['site/request-password-reset']) ?>.
                    </div>

                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('app', 'Login'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
            <div class="col-md-6">
                <h2 class="section-heading text-center">Register to <?=Yii::$app->name?></h2>
                <div class="col-lg-12 well bs-component">

                    <p><?= Yii::t('app', 'Please fill out the following fields to login:') ?></p>

                    <?php $form = ActiveForm::begin(['id' => 'form-signup', 'options' => ['enctype' => 'multipart/form-data']]); ?>

                    <?= $form->field($model, 'fname') ?>
                    <?= $form->field($model, 'lname') ?>
                    <?= $form->field($model, 'phone') ?>
                    <?= $form->field($model, 'email') ?>
                    <?= $form->field($model, 'country')->dropDownList(

                        $model->countries,

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


                    <?= $form->field($model, 'state')->dropDownList(

                        $model->states,

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



                    <?= $form->field($model, 'city')->dropDownList(

                        (array()),

                        [

                            'prompt'=>'- Select City -',

                            'class'=>'form-control select2',

                            'id'=>'city',

                        ]

                    )

                    ?>
                    <?= $form->field($model, 'password')->passwordInput() ?>
                    <?= $form->field($model, 'repassword')->passwordInput() ?>

                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('app', 'Create'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
