
<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
$user_id = \Yii::$app->user->identity->id;

$this->registerJs("
	$(document).ready(function(){
		$('.request').click(function(){
			var val = $(this).attr('id');	
			$('#order_id').val('');
			$('#refund_msg').val('');
			$('#refund_type').val('');
			$('#order_id').val(val);
			$('.loading_gif').show();
			$('.test_div').show();
		});
		$('.loading_gif').click(function(){
			$('.loading_gif').hide();
			$('.test_div').hide();
		});
		$('#request-button').click(function(){
			var msg = $('#refund_msg').val();
			var ret_type = $('#refund_type').val();
			if(ret_type == '' ){
				$('#help-block1').empty();
				$('#help-block1').append('<b>Please Select Return Type</b>');
				return false;
			}else{
				$('#help-block1').empty();
			}
			if(msg == '' ){
				$('#help-block').empty();
				$('#help-block').append('<b>Message Can Not be Empty</b>');
				return false;
			}else{
				$('#help-block').empty();
			}
		});
	});
"
);

?>
<div class="loading_gif" style="display:none;"></div>
<div class="test_div" style="display:none;">
	<div class="testimonial-form">
		
		<form method="post" action="<?= Url::to(['account/return-request']) ?>" id="request">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="form-group field-testimonial-descr required">
					<select style="width: 100%;max-width: 100%;" name="refund_type" id="refund_type">
					<option value="">...Choose Return Type...</option>
					<option value="1">Exchange</option>
					<option value="2">Return</option>
					</select>
					<div class="help-block" id='help-block1'></div>
				</div>
				<div class="form-group field-testimonial-descr required ">
					<textarea id="refund_msg" name="msg" class="form-control"  placeholder="Return Message"></textarea>
					<div class="help-block" id='help-block'></div>
				</div>		
			</div>
			<input type="hidden" name="id" id="order_id" value="" >
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="send-msg">
					<button type="submit" class="btn btn-default" name="request-button" id="request-button">Submit</button>
				</div>
			</div>
		</form>
		<div class="success"></div>
	</div>
</div>
<!-- account dashboard -->
     <section class="dashboard-user">
       <div class="container-fluid craftsmanship-area">
         <div class="user-dashboard">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                 <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="dashboard-list">
                <h4>Account</h4>
                    <ul class="acc-dash">
						<li><a href="<?= Url::to(['account/index']) ?>" >Account Dashboard</a></li>
						<li><a href="<?= Url::to(['account/orders']) ?>" class='active'>Orders Detail</a></li>
						<li><a href="<?= Url::to(['account/mywishlist']) ?>" >My Wishlist</a></li>
					</ul>
                </div>
            </div>
                </div>
            </div>
            <!-- end of left part of account list-->
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                 <div class="account-detail record-pro">
                    <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="hello-user">
                            <h4>Order History</h4>
                            <p>Here are the orders you have placed since the creation of your account.</p>
                            </div>
                            <div class="order-history">
                            <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>Order</th>
                                    <th>Date</th>
                                    <th>Total Price</th>
                                    <th>Payment Method</th>
                                    <th>Payment Status</th>
                                    <th>Order Status</th>
                                    <th>Details</th>
                                    <th>Action</th>
                                    
                                  </tr>
                                </thead>
                                <tbody>
								<?php if($model){
										$i=1;
										foreach($model as $models){
										?>
										<tr>
											<td>#<?= $models->id ?></td>
											<td><?= Yii::$app->formatter->asDate( $models->created_at,'php:d/m/Y');?></td>
											<td><?= $models->price_total ?></td>
											<td><?= $models->paymentMethod->method ?></td>
											<td> 
											<?php if($models->payment_status == 1){ 
												echo 'Paid' ; 
											}else{
												echo 'Pending' ; 
											}
											
											?></td>
											<td> 
											 <?php if($models->status == 1){ echo'Complete' ; } ?>
											 <?php if($models->status == 2){ echo'Closed' ; } ?>
											 <?php if($models->status == 3){ echo'New Order' ; } ?>
											 <?php if($models->status == 4){ echo'Processed' ; } ?>
											 <?php if($models->status == 7){ echo'Shipped' ; } ?>
											 <?php if($models->status == 9){ echo'Returned' ; } ?>
											 <?php if($models->status == 10){ echo'Canceled' ; } ?>
											 <?php if($models->status == 11){ echo'Exchanged' ; } ?>
												
											</td>

											<td> <a href="<?= Url::to(['account/order','id' => $models->id]) ?>">Check Order</a></td>
											<td>  
												<?php
												if( ($models->status == 7 || $models->status == 1)){
													$comments = $comment->find()->where(['order_id' => $models->id])->orderBy(['updated_at' => SORT_DESC,])->one();
													$date1Timestamp = $models->updated_at;
													//Convert it into a timestamp.
													$then = time();
													$difference = $then - $date1Timestamp;
													$days = floor($difference / (60*60*24) );
													if($days <= Yii::$app->params['settings']['refund_day']){
														if ($models->is_refunded == 3) {
															echo  "<b>Request In Progress</b>";
														} else if ($models->is_refunded == 1) {
															echo "<b>Returned</b>";
														} else if ($models->is_refunded == 4) {
															echo "<b>Exchanged</b>";
														} else if ($models->is_refunded == 0) {
															echo "<span class = 'btn btn-danger request' id='".$models->id."'>Request For Return</span>";
														} else {
															echo "<b>No Refund Applicable</b>";
														}
													} else {
														echo "<b>No Refund Applicable</b>";
													}
												}else if($models->status == 9 || $models->status == 11){
													if ($models->is_refunded == 3) {
														echo  "<b>Request In Progress</b>";
													} else if ($models->is_refunded == 1) {
														echo "<b>Returned</b>";
													} else if ($models->is_refunded == 4) {
														echo "<b>Exchanged</b>";
													} else if ($models->is_refunded == 0) {
														echo "<span class = 'btn btn-danger request' id='".$models->id."'>Request For Return</span>";
													} else {
														echo "<b>No Refund Applicable</b>";
													}
												}											
												else if(!$models->payment_status && $models->paymentMethod->method != 'Cash on Delivery'){ ?>
														<a href="<?= Url::to(['account/payment-request','id' => $models->id]) ?>">Complete Payment</a>
													<?php 
													}else{
													?>
														<a href="javascript:void(0)">No action available</a>
													<?php
													
												} ?>
											</td>											
										</tr>
									<?php $i++; }
									}else{ ?>
										<tr>
											<td colspan='8'><h4> No applications submitted by you.</h4></td>
										</tr>
								   <?php } ?>
                                 
                                </tbody>
                            </table>
                            </div>
                            </div>
                    </div>
                </div>
                    
            </div>
            </div>
            <!-- end of right part of account detail-->
        </div>
    </div>
       </div>
     </section>
<!-- account dashboard end -->

<style>
.test_div .box{
	background:none;
	padding:45px 20px 0;
}
.test_div {
    position: fixed;
    width: 40%;
    z-index: 9999999;
    left: 30%;
	top:10%;
    padding: 0;
    border: 10px solid #eee;
    border-radius: 5px;
    min-width: 300px;
}
.file-actions {
    display: none;
}
.testimonial-form {
    width: 100%;
    position: relative;
    padding: 45px 20px 0;
    background: #fff;
    border: 0;
    overflow-y: auto;
    margin: 0;
}
span#test_btn {
    width: 100%;
    margin: 0px 0 15px 0;
}
.test_div .file-preview-frame {
    height: 100px;
}
</style>


            
			