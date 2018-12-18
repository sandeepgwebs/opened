    <td style="text-align:center; padding:5px;font-size:30px; vertical-align:top; margin:0; background:#F5F5F5;
        padding: 30px 0 20px;">
 
     <p style="margin:0; padding:0; margin-bottom:15px; font-weight: bold;"><?= $subject ?> </p>

        </td>
		<?php if($name !=""){ ?>
			<tr>
				<td style="text-align:left;padding: 20px 0px;font-size:15px; float:left;">
				 Dear <?= $name ?>,
				</td>
			</tr>
		<?php } ?>
    <tr>
      <td style="text-align:center; padding:5px;font-size:15px; vertical-align:top; margin:0; background:#F5F5F5;
        padding: 30px 0 20px;">
      <div style="padding:0; margin:0 auto;  width:auto; font-size:16px; color:#666;  text-align: center;  display: inline-block;">
      
     <p style="margin:0;  text-align:left; padding:0; margin-bottom:15px;"><?= $body ?><br>Warm Regards,<br/>Team Drish </p>


        </td>
    </tr>
