<?php 
use yii\helpers\Url;
use yii\helpers\Html;
use frontend\widgets\WishlistProductCounter;
use frontend\widgets\CartProductCounter;
?>	
 <ul class="nav navbar-nav navbar-right">
	<li class="hidden">
		<a href="page-top"></a>
	</li>
	<li>
		<a href="<?= Yii::$app->homeUrl ?>" class="page-scroll">Home</a>
	</li>
	<?php
	foreach($menus as $menu) { 
		$homeurl =  Yii::$app->homeUrl;
		if($menu['link'] == "#contact" || (strpos($menu['link'], 'http:') !== false) || (strpos($menu['link'], 'https:') !== false) ){ 
			$homeurl = "";
		}
	?>
	<li>
		<?php
		if(strpos($menu['name'], 'SCESM 2016') !== false){
		?>
		<a href="<?= $homeurl ?><?= $menu['link'] ?>" <?php  if($menu['link'] == "#contact" ){ ?>  class="page-scroll" <?php } ?> target="_blank" class="btn-ext"><?= $menu['name'] ?></a>
		<?php
		}elseif(strpos($menu['name'], 'Goa') !== false ){
		?>
		<a href="<?= $homeurl ?><?= $menu['link'] ?>" <?php  if($menu['link'] == "#contact" ){ ?>  class="page-scroll" <?php } ?> target="_blank"><?= $menu['name'] ?></a>
		<?php
		} else {
		?>
		<a href="<?= $homeurl ?><?= $menu['link'] ?>" <?php  if($menu['link'] == "#contact" ){ ?>  class="page-scroll" <?php } ?> ><?= $menu['name'] ?></a>
	<?php
		}
	?>
	</li>
	<?php 
			
	}
	?>	
	 <li>

		 <?php

		 if(!Yii::$app->user->isGuest)
		 {
			if(Yii::$app->user->identity->usertype == 3){ 
			 ?>

			 <a href="<?= $homeurl ?>site/my-account" class="btn-ext">My Account</a>

			 <?php
			} else {
			 ?>

			 <a href="<?= $homeurl ?>site/account" class="btn-ext">My Account</a>

			 <?php
			}
		 }

		 ?>

	 </li>
</ul>