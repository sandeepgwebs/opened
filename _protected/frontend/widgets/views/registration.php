<?php use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use nenad\passwordStrength\PasswordInput;

$js = "// get the form id and set the event
$('form#{$model->formName()}').on('beforeSubmit', function(e) {
    var form = $(this);
    if (form.find('.has-error').length) {
        return false;
    }
    },
    // submit form
    $.ajax({
        url: form.attr('action'),
        type: 'post',
        data: form.serialize(),
        success: function (response) {
            if(response.type == 'success'){
                $('form#{$model->formName()}').trigger('reset');
                $('.form-success').html(response.message);
            }else{
                $.each( response, function( key, value ) {
                    $('#'+key).parent().removeClass('has-success').addClass('has-error');
                    $('#'+key).parent().find('.help-block').html(value);
                });
            }
        }
    });
    return false;

    }).on('submit', function(e){
        e.preventDefault();
    });
";
$this->registerJs($js);?>

<div class="row" id="registerdiv" style="display:none;">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="new-cust"><h4>REGISTERED CUSTOMERS</h4>

            <div class="sign-up"><p>By creating an account with our store, you will be able to move through the checkout
                    process faster, store multiple shipping addresses, view and track your orders in your account and
                    more.</p>
                <button type="button" class="create" id="register_btn">Already an account</button>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="new-cust"><h4>New CUSTOMERS</h4>

            <div class="sign-up"><p>If you don't have account with us, please sign
                    up.</p> <?php $form = ActiveForm::begin(['action' => ['site/signup'], 'id' => $model->formName(), 'enableAjaxValidation' => false,]); ?>
                <div
                    class="email-field">                                <?= $form->field($pro_model, 'fname')->textInput(['class' => 'form-control', 'placeholder' => 'First Name'])->label(false) ?>                                <?= $form->field($pro_model, 'lname')->textInput(['class' => 'form-control', 'placeholder' => 'Last Name'])->label(false) ?>                                <?= $form->field($model, 'email')->textInput(['class' => 'form-control', 'placeholder' => 'Email'])->label(false) ?>                                <?= $form->field($pro_model, 'phone')->textInput(['class' => 'form-control', 'placeholder' => 'Contact no'])->label(false) ?>                                <?= $form->field($model, 'password')->passwordInput(['class' => 'textField form-control', 'placeholder' => 'Password'])->label(false) ?>
                    <div
                        class="forgot-pwd">                                    <?= Html::submitButton('Register', ['class' => 'btn btn-default login', 'name' => 'register-button']) ?>                                </div>
                    <div class="form-success has-success"></div>
                </div> <?php ActiveForm::end(); ?>                    </div>
        </div>
    </div>
</div>