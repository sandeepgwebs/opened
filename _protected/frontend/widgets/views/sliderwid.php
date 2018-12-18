<?php   use yii\helpers\Url;   ?>
<ul class="bxslider">
    <?php foreach($slides as $slide ){
        if($slide->image_path=="")		continue;	?>
        <li><img src="<?= Yii::$app->params['baseurl']."/uploads/slides/main/".$slide->image_path ?>" alt="<?= $slide->alt_title ?>" title="<?= $slide->name ?>"/></li>
    <?php } ?>
</ul>