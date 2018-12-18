<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\widgets\Alert;
use frontend\widgets\Showhome;
use frontend\widgets\Download;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model common\models\Papers */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Papers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
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
		<h2 class="section-main-heading text-left">Session Chair Dashboard</h2>
                                
            <div class="col-md-3">
                <ul class="sidebar-nav">
                    <li class="le-heading">
                        Important Links
                    </li>
                    <li>
                        <?= Html::a('My Session Papers', ['/site/my-account'], ['class' => '']) ?>
                    </li>
                    <li>
                        <?php
                        if(!Yii::$app->user->isGuest){
                            ?>
                            <?= Html::a('Special Session', ['/site/special-session'], ['class' => '']) ?>
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
                        }
                        ?>
                    </li>
                </ul>
                <ul class="sidebar-nav">
                    <li class="le-heading">
                        Important Downloads
                    </li>
                    <?= Download::widget() ?>
                </ul>
            </div>
            <div class="col-md-9">
                <?= Alert::widget() ?>
                <section id="special_session">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-9">
                                <h3 style="margin:18px auto" class="section-heading text-left"><?= $this->title ?></h3>
                                <div class="row">
                                    <div class="col-lg-12">
				<?= DetailView::widget([
					'model' => $model,
					'attributes' => [
						
						'title',
						'abstract:ntext',
						'key_words:ntext',
						[
							'attribute' => 'pfile',
							'label' => 'Paper',
							'value' => '<a href="'.Yii::$app->params['baseurl'].'/uploads/papers/'.$model->pfile.'" target="_blank">Download Paper</a>',
							'contentOptions' => ['style' => 'width:200px;text-align:left;vertical-align: middle;'],
							'format' => 'raw',

						],
						'created_at:date',
						[ 
							'attribute'=>'status',
							'label'=>'Decision on paper',
							'value' => $model->paperDecision,
							'format' => 'raw',
						],
						//'updated_at:date',
					],
				]) ?>
				<h3 class="section-heading text-left" style="margin-bottom:20px">Authors</h3>
				<?= GridView::widget([
					'dataProvider' => $dataProvider,
					//'filterModel' => $searchModel,
					'summary' => false,
					'columns' => [ 
						['class' => 'yii\grid\SerialColumn'],

						//'paper_id',
						'fname',
						'lname',
						'email:email',
						[
						'attribute'=>'country_id',
						'label'=>'Country',
						'value'=>function($model){
							return $model->country->name;
						},
						],
						 'organization',
						 'webpage',
						
						// 'corresp',

						/* ['class' => 'yii\grid\ActionColumn','header'=>'Actions',
							'buttons' => [
							'update-author' =>function ($url, $model, $key) {
							$options = array_merge([
							'title' => Yii::t('yii', 'View Update'),
							'aria-label' => Yii::t('yii', 'Update'),
							'data-pjax' => '0',
							], []);
							return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update-author','paper_id'=>$model->paper_id,'id' => $model->id], $options);
							},
							],
							'template' => '{update-author}', 'contentOptions' => ['style' => 'width:160px;letter-spacing:10px;text-align:center'],
						], */
					],
				]); ?>
				<?php
					if($model->status == 0 || $model->status == 1){
				?>
				<p class="pulled-right">
					<?= Html::a('Accept Paper', ['accept-paper','paper_id' => $model->id], ['class' => 'btn btn-success']) ?>
					<?= Html::a('Reject Paper', ['reject-paper','paper_id' => $model->id], ['class' => 'btn btn-danger']) ?>
				</p>
				<?php
					}
				?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>