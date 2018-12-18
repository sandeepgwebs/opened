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

                            The documents uploaded by you at MINT STREET have been successfully processed by MF Utilities Pvt. Ltd. Your unique investor number is as below:<br /><br />

                            <strong> CAN: <?php echo $emailData['can_number'];?> </strong> <br /> <br />

                            Major benefits of CAN: <br />
                            1) Single access to all your MF investments <br />
                            2) No need to fill up any more forms for future MF investments <br />
                            <br /><br />

                            <strong>Go ahead, explore “best performing” mutual funds and Invest-in-a-Click; only at MINT STREET.</strong> <br /><br />

                            <?php
                                if($emailData['products']){
                                    foreach($emailData['products'] as $key => $product){
                                        echo ($key + 1) . ') <a href="'. base_url('mutual-funds/'. $product['slug']) .'" class="color-theme"> Best '. $product['product_name'] .'</a>: ' . strip_tags($product['description']) . '<br />';
                                    }
                                }
                            ?>

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