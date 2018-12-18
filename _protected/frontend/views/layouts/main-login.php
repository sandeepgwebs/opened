<?php

use frontend\assets\UserAsset;

use frontend\widgets\Alert;

use yii\helpers\Html;

use yii\bootstrap\Nav;

use yii\bootstrap\NavBar;

use yii\widgets\Breadcrumbs;

use frontend\widgets\Contact;



/* @var $this \yii\web\View */

/* @var $content string */



UserAsset::register($this);

?>

<?php $this->beginPage() ?>

<!DOCTYPE html>

<html lang="<?= Yii::$app->language ?>">

<head>

    <meta charset="<?= Yii::$app->charset ?>">
	<meta http-equiv="Cache-control" content="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="shortcut icon" href="<?= Yii::$app->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />

    <?= Html::csrfMetaTags() ?>

    <title><?= Html::encode($this->title) ?></title>

    <?php $this->head() ?>

	<?php if(Yii::$app->params['settings']['facebook_analatic'] != ""){ ?>

		<!-- Facebook Pixel Code -->

		<script>

		!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?

		n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;

		n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;

		t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,

		document,'script','https://connect.facebook.net/en_US/fbevents.js');



		fbq('init', '<?= Yii::$app->params['settings']['facebook_analatic'] ?>');

		fbq('track', "PageView");

		fbq('track', 'ViewContent');

		</script>

		<noscript><img height="1" width="1" style="display:none"

		src="https://www.facebook.com/tr?id=<?= Yii::$app->params['settings']['facebook_analatic'] ?>&ev=PageView&noscript=1"

		/></noscript>

		<!-- End Facebook Pixel Code -->

	<?php } ?>





</head>

<body id="page-top" class="index">

    <?php $this->beginBody() ?>
	<?= Yii::$app->params['settings']['google_analatic'] ?>

	<?= Yii::$app->params['settings']['google_adwords'] ?>

	<?= $this->render('header.php')?>

        <?= $content ?>

	<?= $this->render('footer.php')?>

	<div class="loader"></div>

    <?php $this->endBody() ?>

</body>

</html>

<?php $this->endPage() ?>

