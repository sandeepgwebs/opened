<?php
$this->title = 'Gallery';

use frontend\widgets\Gallerywid;
use frontend\widgets\Alert;
?>
 <header class="sub-page-head">
	<div class="container-fluid">
		<div class="intro-text">
			<h3><!--?= $model->name ?--></h3>
		</div>
	</div>
</header>
<!-- About Section -->
<section id="gallery">
	<div class="container">
	<div class="row">
		<div class="col-lg-12 text-center">
			<?= Alert::widget() ?>
			<?= Gallerywid::widget(['show'=>0]) ?> 
		</div>
	</div>
	</div>
</section>