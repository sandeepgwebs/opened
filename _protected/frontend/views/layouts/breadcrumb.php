<?php
use yii\widgets\Breadcrumbs;
?>
<div class="subpage-header">
    <div class="container">
        <h1><?= $this->title ?></h1>
        <?=
        Breadcrumbs::widget(
            [
                'homeLink' => [
                    'label' => 'Home',
                    'url' => ['/'],
                    'class' => 'external',
                ],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]
        ) ?>
    </div>
</div>