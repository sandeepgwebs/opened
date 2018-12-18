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

                            We acknowledge the receipt of your request for withdrawal from <?php echo $emailData['product_name'];?>. The same will be processed subject to terms and conditions of the respective schemes that are part of the portfolio.<br /><br />

                            Following are the details of the transaction:<br /><br />

                            Portfolio Name: <?php echo $emailData['product_name'];?> <br />

                            Date of initial Investment: <?php echo $emailData['transaction_date'];?> <br />

                            Initial amount Invested (Rs): <?php echo $emailData['investment_amount'];?> <br /> <br />

                            <table border="1" cellpadding="5">
                                <thead>
                                    <tr>
                                        <td>Fund Name</td>
                                        <td>Scheme</td>
                                        <td>Units</td>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php
                                    if($emailData['holdings']){
                                        foreach($emailData['holdings'] as $key_holding => $holding){
                                            echo "<tr><td>". $holding['mf_name'] ."</td><td>". $holding['scheme_name'] ."</td><td>". $holding['units']."</td></tr>";
                                        }
                                    }
                                ?>
                                </tbody>
                            </table> <br /> <br />

                            It may take 1-3 business days for the amount to be credited in your linked bank account, as per the policies of the respective Mutual Funds that were of your portfolio. In case of any queries or assistance please call us on +91 888 288 7100 or write to us at <a href="mailto:ask@mintstreet.in">ask@mintstreet.in</a>. <br /> <br />


                            Thanking you, and assuring you of our best services always. <br /> <br />

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