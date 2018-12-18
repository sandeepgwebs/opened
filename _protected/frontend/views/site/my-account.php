<?php
$this->title = 'My Session Papers';
use frontend\widgets\Alert;
use yii\helpers\Html;
use frontend\widgets\Download;
use frontend\widgets\Showhome;
use frontend\widgets\Exam;
use frontend\widgets\Speaker;
use yii\grid\GridView;
$i=1;
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
									<?= GridView::widget([
											'dataProvider' => $dataProvider,
											//'filterModel' => $searchModel,
											'columns' => [
												['class' => 'yii\grid\SerialColumn'],

												'title',
												
												[
													'attribute' => 'session_id',
													'enableSorting' => true,
													'value' => function ($model) {
														return $model->session->name;
													},
													'contentOptions' => ['style' => 'width:200px;text-align:left;vertical-align: middle;'],
													'format' => 'raw',
												],
												'key_words:ntext',
												[
													'attribute' => 'pfile',
													'label'=>'Download',
													'enableSorting' => true,
													'value' => function ($model) {
														return '<a href="'.Yii::$app->params['baseurl'].'/uploads/papers/'.$model->pfile.'" target="_blank" ><span class="glyphicon glyphicon-download"></span></a>';
													},
													'contentOptions' => ['style' => 'width:50px;text-align:center;vertical-align: middle;'],
													'format' => 'raw',
												],
												[
													'attribute' => 'status',
													'value' => function ($model) {
														if ($model->status == 1) {
															return 'Active';
														} elseif($model->status==2) {
															return 'Accepted';
														} else {
															return 'Rejected';
														}
													},
													'contentOptions' => ['style' => 'width:160px;text-align:center'],
													'format' => 'raw',
													'filter'=>array("1"=>"Active","2"=>"Accepted","3"=>"Rejected"),
												],
												// 'pfile',
												// 'status',
												// 'created_at',
												//'updated_at:date',

												[
											'class' => 'yii\grid\ActionColumn','header'=>'Actions',						
											'template' => '{view}',  
											'contentOptions' => ['style' => 'width:60px;letter-spacing:10px;text-align:center'],
										],
											],
										]); ?>
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