<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use frontend\widgets\Alert; ?>
    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Contact Us</h2>
                    <h3 class="section-subheading text-muted"></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
					<?php $form = ActiveForm::begin(['id' => 'contactForm','options' => ['name' => 'sentMessage',
					'class' => ''
				 ]]); ?>
                        <div class="row">
                            <div class="col-md-3">
								<div class="contact-address">
								    <h4>For any query, Please feel free to contact us:</h4>
								    <?= Yii::$app->params['settings']['contact_data'] ?>
                                </div>
                            </div>

                                <div class="col-md-3 foot-input">
                                    <div class="form-group">
                                        <?= $form->field($model, 'name')->textInput(['placeholder' => 'Your Name *','class' => 'form-control'])->label(false) ?>
                                    </div>

                                    <div class="form-group">
                                        <?= $form->field($model, 'email')->textInput(['placeholder' => 'Your Email *','class' => 'form-control'])->label(false) ?>
                                    </div>

                                    <div class="form-group">
                                        <?= $form->field($model, 'phone')->textInput(['placeholder' => 'Your Phone *','class' => 'form-control'])->label(false) ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?= $form->field($model, 'body')->textArea(['placeholder' => 'Your Message *','class' => 'form-control'])->label(false) ?>
                                    </div>
                                </div>

                        </div>
                            <div class="clearfix"></div>
                            <div class="col-md-12 text-center">
                                <div id="success"></div>
								<?= Html::submitButton(Yii::t('app', 'Send Message'), ['class' => 'btn btn-xl', 'name' => 'contact-button']) ?>
                            </div>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </section>