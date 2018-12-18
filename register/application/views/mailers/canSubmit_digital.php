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

                            Thank you for submitting the documents on MINT STREET. As you had selected the Online Submission option, they will be submitted to generate a unique investor identity number (CAN) issued by the MF Utilities Pvt. Ltd., a Mutual Fund (MF) industry body.<br /><br />

                            We will reach out to you in case further documents / clarifications are required for completing the registration.<br /><br />


                            Major benefits of CAN: <br />
                            1) Single access to all your MF investments <br />
                            2) No need to fill up any more forms for future MF investments <br />
                            <br /><br />


                            Please note: As the registration gets processed, you shall receive emails from MINT STREET. During this period you may also receive update emails from MF Utilities Pvt. Ltd (mutual fund industry body), CVL KRA (KYC agency), from fund houses if you have existing MF investments and your bank. These emails are for your information and no additional action is needed from you.



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