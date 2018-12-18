<?php
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = "mail from IRES 2017";
/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>" />
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

</head>
<body style="padding: 0; margin: 0;" bgcolor="#eeeeee">
    <?php $this->beginBody() ?>
		<!-- / Full width container -->
		<table class="full-width-container" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" bgcolor="#eeeeee" style="width: 100%; height: 100%; padding:0;">
			<tr>
				<td align="center" valign="top">
					<table class="container header" border="0" cellpadding="0" cellspacing="0" style="width: 700px;border:1px solid #000">
						<tr style="background-color:#0088bf;">
							<td style="padding: 20px 0 20px 20px; border-bottom: solid 1px #eeeeee;width:50%" align="left">
								<img src="<?= Url::home(true) ?>/uploads/settings/main/<?= Yii::$app->params['settings']['logo'] ?>" style="height:50px">
							</td>
							<td style="padding: 20px 20px 20px 0; border-bottom: solid 1px #eeeeee;width:50%" align="right">
								<a href="#" style="font-size: 30px; text-decoration: none; color: #ffffff;"><?= Yii::$app->name; ?></a>
							</td>
						</tr>					
						<?= $content ?>					
						<tr style="background-color:#0088bf;">
							<td colspan="2" align="center">
								<table class="container" border="0" cellpadding="0" cellspacing="0"align="center">
									<tr>
										<td style="color: #d5d5d5; text-align: center; font-size: 15px; padding: 10px 0 10px 0; line-height: 22px;">Copyright &copy; 2017 <a href="http://scesm.org/" target="_blank" style="text-decoration: none; border-bottom: 1px solid #d5d5d5; color: #d5d5d5;"><?= Yii::$app->name; ?></a>. <br />All rights reserved.</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
