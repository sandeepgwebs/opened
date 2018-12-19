<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use frontend\widgets\Alert;
use frontend\widgets\Contact;
use frontend\widgets\SliderWid;
use frontend\widgets\Exam;
use frontend\widgets\HomeMenuMain;
use frontend\widgets\Speaker;
use frontend\widgets\Showhome;
use frontend\widgets\Client;
use frontend\widgets\Gallerywid;

$meta_desc = Yii::$app->params['settings']['site_meta_description'];
$meta_title = Yii::$app->params['settings']['site_meta_title'];
$meta_keywords = Yii::$app->params['settings']['site_meta_keyword'];

$this->title = (isset($meta_title) && $meta_title != "") ? $meta_title : 'Scesm';

$this->registerMetaTag([
	'name' => 'description',
	'content' => $meta_desc,
]);

$this->registerMetaTag([
	'name' => 'keywords',
	'content' => $meta_keywords,
]);


?>

<header>
	<div class="intro-text">
		<div class="intro-heading"><?= Yii::$app->params['settings']['header_text'] ?></div>
		<div class="intro-lead-in"><?= Yii::$app->params['settings']['subheader_text'] ?></div>
		<a href="<?= Yii::$app->homeUrl?>registeration.html" class="page-scroll btn btn-xl">Registration</a>
		<a href="<?= Yii::$app->homeUrl?>paper-submission.html" class="page-scroll btn btn-xl">Paper Submission</a>
	</div>
	<div class="main-slider">
		<?= SliderWid::widget() ?>
	</div>
</header>

<!-- Services Section -->
<div class="marquee"></div>
<section id="" class="bg-conents">
	<div class="container custom-cont">
		<div class="row">
			<div class="col-lg-12">
				<div class="welcome-box">
					<h3><?= Yii::$app->params['settings']['welcome_title'] ?></h3>
					<p>
						<?= Yii::$app->params['settings']['welcome_text'] ?>
					</p>
					<!--a style="cursor: pointer;" class="view-more-text">Read More</a-->
				</div>
			</div>
		</div>
	</div>
</section>

<section id="portfolio" class="bg-light-gray">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h2 class="section-heading animateblock" data-animate-class="fadeInTop">Paper Submission & Important Dates</h2>
			</div>
		</div>
		<div class="row animateblock" data-animate-class="fadeInUp">
			<?= Exam::widget() ?>
		</div>
	</div>
</section>

<section class="spekers-area pb-100" id="speakers">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h2 class="section-heading animateblock" data-animate-class="fadeInTop">Conference theme</h2>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row no-padding">
			<div class="active-speaker-carusel col-lg-12 no-padding">
				<div class="single-speaker item">
					<div class="container">
						<div class="row align-items-center">
							<div class="col-sm-6 speaker-img no-padding">
								<p><?=$this->title?> is an international event that focuses on the state of the art technologies pertaining to Sustainable Computing Techniques in Engineering, Science and Management. The conference will be held in 2017 to make it an ideal platform for people to share views and experiences in Sustainable Computing Techniques in Engineering, Science and Management related areas.</p>
							</div>
							<div class="col-sm-6 speaker-img no-padding serv-inners">
								<img src="<?= Yii::$app->params['baseurl'] ?>/img/conf.jpg">
								<div class="my-overlay"></div>
								<h4 class="service-heading">Engineering</h4>
							</div>
						</div>
					</div>
				</div>
				<div class="single-speaker item">
					<div class="container">
						<div class="row align-items-center">
							<div class="col-sm-6 speaker-img no-padding serv-inners">
								<img src="<?= Yii::$app->params['baseurl'] ?>/img/11-1170x779.jpg">
								<div class="my-overlay"></div>
								<h4 class="service-heading">Science</h4>
							</div>
							<div class="col-sm-6 speaker-img no-padding serv-inners">
								<img src="<?= Yii::$app->params['baseurl'] ?>/img/25.jpg">
								<div class="my-overlay"></div>
								<h4 class="service-heading">Management</h4>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<aside class="clients">
	<div class="container-fluid">
		<div class="row">
			<?= Client::widget() ?>
		</div>
		<div class="row">
				<?= Gallerywid::widget(['show' => 4]) ?>
				<div class="col-lg-12 text-center">
                   <div class="welcome-box">
						<?= Html::a('View More', ['site/gallery'], ['class' => 'view-more', 'style' => 'cursor: pointer;']) ?>
				   </div>
                </div>
            </div>
	</div>
</aside>