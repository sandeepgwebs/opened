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

                            <p><span><b>MFU Transaction Status:</b> <?php echo $emailData['mfu_status'];?></span></p>

                            <p><span><b>Error Message: </b> <?php echo $emailData['error_message'];?></span></p>

                            <p><span><b>Order Date: </b> <?php echo $emailData['order_date'];?></span></p>

                            <p><span><b>Last Modified Time: </b> <?php echo $emailData['last_modified'];?></span></p>

                            <p><span><b>Group Order No: </b> <?php echo $emailData['groupOrderNo']; ?></span></p>

                            <p><span><b>Scheme Detail Map : </b> <?php echo $emailData['schemeDetailMap'];?></span></p>

                            <p><span><b>Error Response : </b> <?php echo $emailData['errorResponse'];?></span></p>

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