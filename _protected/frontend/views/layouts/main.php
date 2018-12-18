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
	<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
	<?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body id="page-top" class="index">
	<?= Yii::$app->params['settings']['google_analatic'] ?>
	<?= Yii::$app->params['settings']['google_adwords'] ?>
    <?php $this->beginBody() ?>
		 <?= $this->render('header.php')?>

        <?= $content ?>
		<?= Contact::widget() ?>
		<section class="map">
			<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d9204.49113128022!2d100.61725464890912!3d14.076480572707395!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xf01923824353270!2sAsian+Institute+of+Technology!5e0!3m2!1sen!2sin!4v1487655805524" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
		</section>
	<?= $this->render('footer.php')?>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
