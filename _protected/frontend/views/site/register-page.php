<?php
$this->title = ($model->meta_title ? $model->meta_title : $model->name);

use frontend\widgets\Alert;
use frontend\widgets\Calculatefee;
use frontend\widgets\Exam;
use frontend\widgets\Speaker;
use frontend\widgets\Showhome;
use frontend\assets\AppAsset;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\View;
$this->registerJs("var baseurl = ".json_encode(Yii::$app->request->baseUrl).";var url = ".json_encode( Url::to('')).";", View::POS_END);
$this->registerJsFile(Yii::$app->view->theme->baseUrl.'/js/calculate.js', ['depends' => [AppAsset::className()]]);
$this->registerJs("$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').focus()
});", View::POS_END);
?>
    <header class="sub-page-head">
        <div class="container-fluid">
            <div class="intro-text">
				<h3><!--?= $model->name ?--></h3>
            </div>
        </div>
    </header>
	<?= Showhome::widget() ?>
	<section id="about">
		<div class="container custom-con">
			<div class="row">
				<div class="col-lg-12 text-center" style="overflow-x:auto;">
				<?= Alert::widget() ?>
				<?= $model->description ?>
				</div>
			</div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <?= Html::a('Calculate Registration Fee', null, ['style' => 'color:#fff;', 'class' => 'btn btn-primary btn-lg','data-toggle' => 'modal', 'data-target' => '#myModal']) ?>
                </div>
                <div class="col-lg-12 text-center">
                    <h3>The modes of payment are as follows:</h3>
                </div>
            </div>
			<div class="paymentm">
		<div class="row">
			<div class="col-md-6">
			<div class="col-md-12">
				<div class="pay-box1">
					<span> 1 </span>
				</div>
				<h2> Wire Transfer </h2>
				<p> <b>A/C Name:</b> Saurabh Pandit </p>
				<p> <b>Bank Account Number:</b> 5859745229</p>
				<p> <b>Account Type:</b> SB</p>
				<p> <b>Branch Name:</b> Citibank</p>
				<p> <b>Branch Code: </b> 000002</p>
				<p> <b>IFSC Code: </b> CITI0000002 (5th character is zero)</p>
				<p> <b>MICR Code: </b> 110037002</p>
				<p> <b>Branch address:</b> JEEVAN BHARTI BUILDING, 124, CONNAUGHT CIRCUS, NEW DELHI - 110001</p>
				<?= Html::a('Register and Upload Pay Slip', ['site/register', 'id' => 1], ['class' => 'paymenta1']) ?>
			</div>
			</div>
			<!--div class="col-md-4">
			<div class="col-md-12">
				<div class="pay-box2">
					<span> 2 </span>
				</div>
				<h2>Payment with Paypal </h2>
				<p><b>(Except Indian Authors/Attendees)</b></p>
				<p>Authors/Attendees (Except Indian Authors/Attendees) can also make payment through Paypal.</p>
				<?= Html::a('Register And Pay', ['site/register', 'id' => 2], ['class' => 'paymenta2']) ?>
			</div>
			</div-->
			<div class="col-md-6">
			<div class="col-md-12">
				<div class="pay-box3">
					<span> 3 </span>
				</div>
				<h2>Payment with Payumoney</h2>
				<p><b>(Only Indian Authors/Attendees)</b></p>
				<p>Authors/Attendees (Only Indian Authors/Attendees) can also make payment through Pay U Money. They have to login with their PayU Money account or by creating a new account they can make payment via Net Banking/ Debit Card/ Credit Card</p>
				<!-- a href="https://www.payumoney.com/paybypayumoney/#/9C696A2A2F70C8380F12759BEFDFEB85"><img src="<?= Yii::$app->params['baseurl'] ?>/uploads/settings/main/payumoney-logo.png" ><a-->
				<?= Html::a('Register And Pay', ['site/register', 'id' => 3], ['class' => 'paymenta3']) ?>
			</div>
			</div>
		</div>
	</div>
		</div>
		
	</section>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Calculate Registration Fee</h4>
			</div>
			<div class="modal-body">
                <?= Calculatefee::widget() ?>
			</div>
			<div class="modal-footer" style="text-align: left;">
                <h4 class="modal-title" id="myModalLabel">Calculated Fee: <span id="feecal" style="color:#f00"></span></h4>
			</div>
		</div>
	</div>
</div>