<?php
use yii\helpers\Html;
use frontend\widgets\Alert;
/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = "404 Page";
$this->context->layout = 'simple';
?>
<header class="sub-page-head">
	<div class="container-fluid">
		<div class="intro-text">
			<h3><!--?= $model->name ?--></h3>
		</div>
	</div>
</header>
<?= Alert::widget() ?>
<section id="committees">
	<div class="container custom-col">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<h2 class="section-heading text-center"><?= Html::encode($this->title) ?></h2>
				<div class="col-lg-12 well bs-component text-center"> 
<img src="<?= Yii::$app->params['baseurl'] ?>/uploads/settings/main/404.png" style="width:250px;margin:40px auto;display:inline;" alt="error-img" title="error-img">
								
					<h4><span>Error 404</span> Whoops!</h4>
					<p>The page you need cannot be found</p>
					<p>Yoh have requested a page or file which does not exist.
					Try again with another url to view your page.</p>
				</div>
			</div>
		</div>
	</div>
</section>

