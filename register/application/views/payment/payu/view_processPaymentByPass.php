<html>
<script type="text/javascript">
    function submitPayForm() {
        var payForm = document.forms.payForm;
        payForm.submit();
    }
</script>

<body onload="submitPayForm()">
<form action="<?php echo $payment['action']; ?>" method="post" name="payForm" style="display: none;">
    <input type="hidden" id="hidRequestId" name='hidRequestId' value="PGIME1000" />
    <input type="hidden" id="hidOperation" name='hidOperation' value="ME100" />

    <input type="hidden" name="msg" value="<?php echo $payment['data'];?>" />

    <input type="submit" value="Submit" />
</form>
</body>
</html>