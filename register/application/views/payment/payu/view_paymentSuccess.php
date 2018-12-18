<!DOCTYPE html>
<head>
    <?php $this->load->view('common/view_include');?>
</head>

<body itemscope>
<div class="theme-layout">
    <?php $this->load->view('common/view_header');?>


    <section>
        <div class="block whitish">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="bold text-center"><?php echo $pageTitle;?></h3>

                        <div class="row text-center">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8">
                                <div class="widget-body">
                                    <table class="table table-striped">
                                        <tbody>
                                        <tr>
                                            <td>Status</td>
                                            <td><?php echo $response['status'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Date</td>
                                            <td><?php echo $response['TxnDate'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Order ID</td>
                                            <td><?php echo $response['AdditionalInfo1'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Amount</td>
                                            <td><?php echo $response['TxnAmount'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Transaction Reference No.</td>
                                            <td><?php echo $response['TxnReferenceNo'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Bank Reference No.</td>
                                            <td><?php echo $response['BankReferenceNo'];?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-sm-2"></div>
                        </div>


                        <p class="text-center">Redirecting to dashboard...</p>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php $this->load->view('common/view_footer');?>
</div>


<?php $this->load->view('common/view_common_js')?>

<script type="text/javascript">
    setTimeout(function(){
        window.location = '<?php echo $redirectURL;?>';
    }, 5000);
</script>
</body>
