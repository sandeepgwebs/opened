<!DOCTYPE html>

<head>

    <script type="text/javascript">
        function submitPayForm() {
            var payForm = document.forms.payForm;
            payForm.submit();
        }
    </script>

</head>
<body onload="submitPayForm();">
<form action="<?php echo $payuData['action']; ?>" method="post" name="payForm" style="display: none;">
    <input type="hidden" name="key" value="<?php echo $payuData['key'];?>" />
    <input type="hidden" name="hash" value="<?php echo $payuData['hash']; ?>"/>
    <input type="hidden" name="txnid" value="<?php echo $payuData['txnid'] ?>" />

    <input type="hidden" name="amount" value="<?php echo $payuData['amount'];?>" />
    <input type="hidden" name="firstname" id="firstname" value="<?php echo $payuData['firstname'];?>" />
    <input type="hidden" name="lastname" id="lastname" value="<?php echo $payuData['lastname'];?>" />
    <input type="hidden" name="email" id="email" value="<?php echo $payuData['email'];?>" />
    <input type="hidden" name="phone" value="<?php echo $payuData['phone'];?>" />
    <input type="hidden" name="productinfo" value="<?php echo $payuData['productinfo'];?>" />

    <input type="hidden" name="surl" value="<?php echo $payuData['surl'];?>" size="64" />
    <input type="hidden" name="furl" value="<?php echo $payuData['furl'];?>" size="64" />

    <input type="hidden" name="service_provider" value="<?php echo $payuData['service_provider'];?>" size="64" />


    <!-- optional -->
    <input type="hidden" name="curl" value="" />
    <input type="hidden" name="address1" value="" />
    <input type="hidden" name="address2" value="" />
    <input type="hidden" name="city" value="" />
    <input type="hidden" name="state" value="" />
    <input type="hidden" name="country" value="" />
    <input type="hidden" name="zipcode" value="" />
    <input type="hidden" name="udf1" value="<?php echo $payuData['udf1'];?>" />
    <input type="hidden" name="udf2" value="<?php echo $payuData['udf2'];?>" />
    <input type="hidden" name="udf3" value="<?php echo $payuData['udf3'];?>" />
    <input type="hidden" name="udf4" value="<?php echo $payuData['udf4'];?>" />
    <input type="hidden" name="udf5" value="" />
    <input type="hidden" name="pg" value="" />

    <input type="submit" value="Submit" />
</form>
</body>
</html>