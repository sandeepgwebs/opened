<?php
use frontend\widgets\HomeMenuMain;
use frontend\widgets\Search;
use frontend\widgets\CartProductCounter;
use frontend\widgets\WishlistProductCounter;
use yii\helpers\Url;
use yii\helpers\Html;
?>

 <header id="header" id="home">
	<div class="container-fluid">
		<div class="row align-items-center justify-content-between d-flex">
			<div class="col-sm-3">
				<div id="logo">
					<a href="#"><img src="<?=Yii::$app->view->theme->baseUrl;?>/img/ires.png" alt="" title="" /></a>
				</div>
			</div>
			<div class="col-sm-6">
			</div>
			<div class="col-sm-3">
			</div>
		</div>
		<nav id="nav-menu-container">
			<div class="row">
				<div class="col-sm-12">
					<?= HomeMenuMain::widget() ?>
				</div>
			</div>
		</nav><!-- #nav-menu-container -->
	</div>
 </header><!-- #header -->

