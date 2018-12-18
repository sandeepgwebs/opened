<?php
$this->title = 'Speakers';
use frontend\widgets\Alert;
use frontend\widgets\Exam;
use frontend\widgets\Speaker;
$i=1;
?>
     <header class="sub-page-head">
        <div class="container-fluid">
            <div class="intro-text">
				<h3><!--?= $model->name ?--></h3>
            </div>
        </div>
    </header>
	<?= Alert::widget() ?>
<!-- About Section -->
<section id="committees">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <h2 class="section-heading text-left">Speakers</h2>
            <div class="speaker-section">
			<?php 
			foreach($model as $data){ ?>
				<div class="speaker-item">
                  <figure><img src="<?= Yii::$app->params['baseurl'] ?>/uploads/speakers/main/<?= $data->avatar ?>"/></figure>
                  <h2><?= $data->name ?></h2>
                  <span><?= $data->designation ?></span>							
                  <p><?= $data->descr ?> </p>
               </div>
			<?php } ?>
              
            </div>
         </div>
      </div>
   </div>
</section>