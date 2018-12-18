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

                            <p>
                                Product Transaction ID: <?php echo $emailData['transaction_id'];?><br />
                                CAN Number: <?php echo $emailData['can_number'];?><br />
                                Portfolio Name: <?php echo $emailData['product_name'];?><br />
                                Date of Investment: <?php echo $emailData['transaction_date'];?><br />
                                Investment Amount (Rs): <?php echo $emailData['investment_amount'];?>
                            </p>


                            <table width="50%" border="1" cellpadding="5" cellspacing="0" align="left" class="force-row">
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