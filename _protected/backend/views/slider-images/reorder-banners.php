<?php

use yii\helpers\Html;
use yii\widgets\ListView;

$this->registerJsFile('http://code.jquery.com/ui/1.11.4/jquery-ui.js',['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::$app->view->theme->baseUrl.'/js/custom_ui.js',['depends' => [\yii\web\JqueryAsset::className()]]);
$this->title = 'Drag & Drop to reorder Banners';
$this->params['breadcrumbs'][] = ['label' => 'Banners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banners-index">
    <div class="row">
        <div class="col-md-6 col-xs-12">            
            <div class="box">
				<div class="box-body">	
					<p>
						<?= Html::a('Back to Banners', ['viewslides','id'=>1], ['class' => 'btn btn-success']) ?>
						
					</p>
					<?php
						if($banners){
					?>
						<ul class="box-group" id="sortable4">
							<?php
							
								foreach($banners as $banner){
									?>
									<li id="<?= $banner->id ?>" style="margin-bottom:8px;list-style:none">
										
											<img src="<?=Yii::$app->params['baseurl'] . '/uploads/slides/thumbs/' . $banner->image_path ?>">
										
									</li>
									<?php
								}
					?>
						</ul>					
					<?php
						} else {
						?>
						<p style="margin-bottom:0px;">
							<span>No  Banners Found.</span>
							<?= Html::a('Click here to add Banners', ['create'], ['class' => '']) ?>
						</p>
					<?php
						}
					?>
				</div>
			</div>
		</div>
    </div>
</div>