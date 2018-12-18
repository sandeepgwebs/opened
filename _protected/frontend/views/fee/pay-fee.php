<?php
use yii\helpers\Url;
use frontend\widgets\Alert;
use frontend\widgets\Showhome;
// Merchant key here as provided by Payu

$MERCHANT_KEY = "BxGPUBsY";

// Merchant Salt as provided by Payu
$SALT = "AwFvaXTJ8s";

// End point - change to https://secure.payu.in for LIVE mode
$PAYU_BASE_URL = "https://secure.payu.in";

$action = '';

$posted = array();

$posted['phone'] = "0000000000";
$posted['email'] = Yii::$app->user->identity->email;
$posted['firstname'] = Yii::$app->user->identity->profile->fname;
$posted['udf1'] = $model->id;
$posted['furl'] = "http://iresconf.org".Url::to(["fee/payment-failed"]);
$posted['surl'] = "http://iresconf.org".Url::to(["fee/payment-success"]);
$posted['curl'] = "http://iresconf.org".Url::to(["fee/payment-cancelled"]);
$posted['amount'] = $fee;
$posted['productinfo'] =  " Paper submission fee( ".$model->paper_no. " )";
$posted['service_provider'] = "payu_paisa";
$posted['key'] = $MERCHANT_KEY;
$formError = 0;

if(empty($posted['txnid'])) {
    // Generate random transaction id
    $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
    $posted['txnid'] =  $txnid;
} else {
    $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
    if(
        empty($posted['key'])
        || empty($posted['txnid'])
        || empty($posted['amount'])
        || empty($posted['firstname'])
        || empty($posted['email'])
        || empty($posted['phone'])
        || empty($posted['productinfo'])
        || empty($posted['surl'])
        || empty($posted['furl'])
        || empty($posted['service_provider'])
    ) {
        echo"<pre>";print_r($posted);die;
        $formError = 1;
    } else {
        //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
        $hashVarsSeq = explode('|', $hashSequence);
        $hash_string = '';
        foreach($hashVarsSeq as $hash_var) {
            $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
            $hash_string .= '|';
        }

        $hash_string .= $SALT;


        $hash = strtolower(hash('sha512', $hash_string));
        $action = $PAYU_BASE_URL . '/_payment';
    }
} elseif(!empty($posted['hash'])) {
    $hash = $posted['hash'];
    $action = $PAYU_BASE_URL . '/_payment';
}
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
                <span id="Success">
                    <div class="thank-msg"><div class="revert-msg"><span> <label>Your Form Has been Submitted Successfully</label> You Are Redirecting on Payment Page.... </span></div></div>
                </span>
                <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
                <script>
                    var hash = '<?php echo $hash ?>';
                    function submitPayuForm() {
                        if(hash == '') {
                            return;
                        }
                        var payuForm = document.forms.payuForm;
                        payuForm.submit();
                    }
                    $(document).ready(function(){
                        setTimeout(function() {   //calls click event after a certain time
                            submitPayuForm();
                        }, 2000);
                    });
                </script>
                <div style="display:none;">
                    <form  action="<?php echo $action; ?>" method="post" name="payuForm">
                        <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
                        <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
                        <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
                        <input name="amount" value="<?php echo (empty($posted['amount'])) ? '' : $posted['amount'] ?>" />
                        <input name="firstname" id="firstname" value="<?php echo (empty($posted['firstname'])) ? '' : $posted['firstname']; ?>" />
                        <input name="email" id="email" value="<?php echo (empty($posted['email'])) ? '' : $posted['email']; ?>" />

                        <textarea name="productinfo"><?php echo (empty($posted['productinfo'])) ? '' : $posted['productinfo'] ?></textarea>
                        <input name="phone" value="<?php echo (empty($posted['phone'])) ? '' : $posted['phone']; ?>" />
                        <input name="surl" value="<?php echo (empty($posted['surl'])) ? '' : $posted['surl'] ?>" size="64" />
                        <input name="furl" value="<?php echo (empty($posted['furl'])) ? '' : $posted['furl'] ?>" size="64" />
                        <input name="furl" value="<?php echo (empty($posted['curl'])) ? '' : $posted['curl'] ?>" size="64" />
                        <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
                        <input name="udf1" value="<?php echo (empty($posted['udf1'])) ? '' : $posted['udf1']; ?>" />
                        <input name="lastname" id="lastname" value="<?php echo (empty($posted['lastname'])) ? '' : $posted['lastname']; ?>" />
                        <input name="address1" value="<?php echo (empty($posted['address1'])) ? '' : $posted['address1']; ?>" />
                        <input name="address2" value="<?php echo (empty($posted['address2'])) ? '' : $posted['address2']; ?>" />
                        <input name="city" value="<?php echo (empty($posted['city'])) ? '' : $posted['city']; ?>" />
                        <input name="state" value="<?php echo (empty($posted['state'])) ? '' : $posted['state']; ?>" />
                        <input name="country" value="<?php echo (empty($posted['country'])) ? '' : $posted['country']; ?>" />
                        <input name="zipcode" value="<?php echo (empty($posted['zipcode'])) ? '' : $posted['zipcode']; ?>" />
                        <input name="udf2" value="<?php echo (empty($posted['udf2'])) ? '' : $posted['udf2']; ?>" />
                        <input name="udf3" value="<?php echo (empty($posted['udf3'])) ? '' : $posted['udf3']; ?>" />
                        <input name="udf4" value="<?php echo (empty($posted['udf4'])) ? '' : $posted['udf4']; ?>" />
                        <input name="udf5" value="<?php echo (empty($posted['udf5'])) ? '' : $posted['udf5']; ?>" />
                        <input name="pg" value="<?php echo (empty($posted['pg'])) ? '' : $posted['pg']; ?>" />

                        <input type="submit" value="asd">
                    </form>
                </div>
            </div>
        </div>
        </div>
</section>
<style>
    .thank-msg {
        color: #2F9C34;
        background: #D8F4D2;
    }
    .login {
        color: #FF3030;
        background: #F6DBDF;
    }
    .login,.thank-msg {
        width: 95%;
        margin: 10px auto 0;
        text-align: center;
        padding: 10px;
        border: 1px solid;
        font-size: 22px;
        border-radius: 5px;
        text-transform: uppercase;
    }
    .thank-msg label {
        font-weight: 100;
    }
</style>

