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

                            Welcome to MINT STREET! You have just joined an esteemed group of investors who grow wealth by investing in the best Mutual Funds. <br /><br />

                            Your username is: <strong><?php echo $emailData['username'];?></strong>s <br />
                            Default password: <strong><?php echo $emailData['password'];?></strong> <br /><br />

                            You are a few steps away now to complete your one-time registration at MINT STREET and get access to the Best Mutual Funds. Please <a href="<?php echo base_url('account/login');?>" class="color-theme">click here</a> to go to the next step. <br /><br />

                            For help, please Call/WhatsApp us on +91 888 288 7100 or write to us at <a class="color-theme" href="mailto:ask@mintstreet.in">ask@mintstreet.in</a>. <br /><br /><br />
                            Note: We recommend that you change the password on first login. Please keep your password confidential at all times for security reasons.


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