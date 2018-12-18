<?php
$this->title = 'Committees';
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
<div class="comiteds">
	<section id="committees">
		<div class="container custom-con">
			<div class="row">
				<div class="col-lg-12">
					<h2 class="section-heading text-left">Committees</h2>
					<div aria-multiselectable="true" class="panel-group" id="accordion" role="tablist">
						<?php foreach($cats as $cat){ 
							?>
						<div class="panel panel-default committeesp">
							<div class="panel-heading" id="heading<?= $i ?>" role="tab">
								<h4 class="panel-title">
									<a aria-controls="collapse<?= $i ?>" aria-expanded="false" data-parent="#accordion" data-toggle="collapse" href="#collapse<?= $i ?>" role="button" class="collapsed"><?= $cat->name ?>: </a>
								</h4>
							</div>
							<div aria-labelledby="heading<?= $i ?>" class="panel-collapse collapse" id="collapse<?= $i ?>" role="tabpane<?= $i ?>">
								<div class="panel-body">
								<?php 
									$data = $members->findAll(['status'=>1,'cat_id' => $cat->id ]);
									if($data){
										foreach($data as $member){ 	?>
											
												
												<h4><?= $member->name ?>,</h4>

												<p><?= $member->from ?></p>
												
								<?php 
										}
									}else{ ?>										
										<h4>No Member Added.</h4>										
								<?php
									} ?>
								</div>
							</div>
						</div>
						<?php	$i++;
							} ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>