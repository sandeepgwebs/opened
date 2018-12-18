<?php
use frontend\assets\UserAsset;
use frontend\widgets\Alert;
use frontend\widgets\Showhome;
use frontend\widgets\Download;
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="<?= Yii::$app->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body id="page-top" class="index">
    <?php $this->beginBody() ?>
	<?= $this->render('header.php')?>
	  <header class="sub-page-head">
        <div class="container-fluid">
            <div class="intro-text">
				<h3><!--?= $model->name ?--></h3>
            </div>
        </div>
    </header>
	<?= Showhome::widget() ?>
	<section id="about">
		<div class="container custom-col">
			<div class="row">
			<div class="col-md-3">					
					<ul class="sidebar-nav">
						<li class="le-heading">
							Important Downloads
						</li>
						<?= Download::widget() ?>
					</ul>
					<ul class="sidebar-nav">
						<li class="le-heading">
							Important Links
						</li>
						<li>
						<?php 
							if(!Yii::$app->user->isGuest){
							?>
							<?= Html::a('Submit Papers', ['/papers/index'], ['class' => '']) ?>
							<?php	
							} else {
							?>
							<?= Html::a('Submit Papers', ['/papers/create'], ['class' => '']) ?>
							<?php
							}
							?>	
							
							
							
						</li>
						<li>
							<?php 
							if(!Yii::$app->user->isGuest){
							?>
							<?= Html::a('My Submissions', ['/papers/index'], ['class' => '']) ?>
							<?php	
							}
							?>	
						</li>
						<li>
							<?php 
							if(!Yii::$app->user->isGuest){
							?>
							<?= Html::a('Logout', ['/site/signout'], ['class' => '']) ?>
							<?php	
							} else {
							?>
							<?= Html::a('Author Login', ['/site/login'], ['class' => '']) ?>
							<?php	
							}
							?>	
						</li>
						<li>
							<?php 
							if(!(!Yii::$app->user->isGuest && Yii::$app->user->identity->usertype)){							
							?>
							<?= Html::a('Chair Login', ['/site/chair-login'], ['class' => '']) ?>
							<?php	
							}
							?>
						</li>
					</ul>	
			</div>
			<div class="col-md-9">
				<?= $content ?>
			</div>
			</div>
		</div>
	</section>

		<?= Contact::widget() ?> 	
		
	<?= $this->render('footer.php')?>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
