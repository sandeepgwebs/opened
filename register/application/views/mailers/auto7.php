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

                            Thanks for filling up your details online at MINT STREET!<br /><br />

                            To complete one-time registration, please sign the attached Application Forms and send it to us (at address below) with the required supporting documents. <br /> <br />

                            Application Forms (to be signed at all places having MINT STREET Logo) <br />
                            1) New KYC form <br />
                            2) New CAN Allocation form <br />
                            3) Investment Services Agreement <br />
                            4) PayEezz Mandate
                            <br /><br />

                            Supporting documents checklist: <br />
                            1) PAN card (self attested photocopy) <br />
                            2) Passport size photograph (self attested) – to be pasted on the KYC form <br />
                            3) Address proof  (self attested photocopy) <br />
                            4) Cheque leaf (Cancelled) or Bank statement (self attested photocopy) - the cheque / bank statement must have your name and account number clearly printed. <br /> <br />


                            Courier above documents to: <br />
                            <strong>MINTSTREET.in, Innov8 - 69, Regal Building, Connaught Place, New Delhi, India. PIN - 110 001</strong>

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