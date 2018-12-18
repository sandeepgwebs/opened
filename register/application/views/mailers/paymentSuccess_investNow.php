<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<?php $this->load->view('mailers/common/view_include');?>

<body style="margin:0; padding:0;" bgcolor="#F0F0F0" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#F0F0F0">
    <tr>
        <td align="center" valign="top" bgcolor="#F0F0F0" style="background-color: #F0F0F0;">
            <table border="0" width="600" cellpadding="0" cellspacing="0" class="container" style="width:600px;max-width:600px; padding-left:24px;padding-right:24px;padding-top:12px;padding-bottom:12px;background-color:#ffffff; margin: 10px 0" >
                <?php $this->load->view('mailers/common/view_header');?>

                <tr>
                    <td class="container-padding content" align="left" style="">
                        <br>

                        <div class="body-text" style="font-family:Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;text-align:left;color:#333333">

                            Dear <?php echo $emailData['fullname'];?>, <br /><br />

                            We acknowledge the receipt of your request for investment in the Best Mutual Funds. Please complete your one-time registration formalities by <a href="<?php echo base_url('account/login');?>" class="color-theme">clicking on this link</a> and uploading your documents. <br /><br />

                            <!--[if mso]>
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr><td width="50%" valign="top"><![endif]-->

                            <table width="264" border="0" cellpadding="0" cellspacing="0" align="left" class="force-row">
                                <tr>
                                    <td class="col" valign="top" style="font-family:Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;text-align:left;color:#333333;width:100%">
                                        Following are the details of your transaction: <br /><br/>
                                        <strong>Portfolio</strong>: Best <?php echo $emailData['product_name'];?>  <br />
                                        <strong>Date of Investment</strong>: <?php echo $emailData['investment_date'];?>  <br />
                                        <strong>Total Investment Amount (Rs)</strong>: <?php echo $emailData['investment_amount'];?>  <br />
                                    </td>
                                </tr>
                            </table>

                            <!--[if mso]></td><td width="50%" valign="top"><![endif]-->

                            <table width="264" border="1" cellpadding="5" cellspacing="0" align="right" class="force-row">
                                <thead>
                                    <th>Fund Scheme</th>
                                    <th>Amount</th>
                                </thead>
                                <tbody>
                                <?php
                                    if($emailData['schemes']){
                                        foreach($emailData['schemes'] as $key => $scheme){
                                ?>
                                            <tr>
                                                <td class="col" valign="top" style="font-family:Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;text-align:left;color:#333333;width:100%"><?php echo $scheme['scheme_name'];?></td>
                                                <td class="col" valign="top" style="font-family:Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;text-align:left;color:#333333;width:100%"><?php echo $scheme['transaction_amount'];?></td>
                                            </tr>
                                <?php
                                        }
                                    }
                                ?>
                                </tbody>

                            </table>

                            <!--[if mso]></td></tr></table><![endif]-->

                            <div class="clear"></div>
                            <br />
                            An amount of Rs. <?php echo $emailData['investment_amount'];?> has been debited from your account towards your investment. The same shall be processed and units of MF schemes shall be allocated to you within 1-3 business days.<br /><br />

                            Please note: MINT STREET cannot be held responsible for errors or delays in processing your request due to errors in the documents/information provided by you.


                        </div>


                    </td>
                </tr>

                <?php $this->load->view('mailers/common/view_footer');?>

            </table>




        </td>
    </tr>
</table>
</body>

</html>