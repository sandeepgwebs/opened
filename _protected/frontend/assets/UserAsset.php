<?php
/**
 * -----------------------------------------------------------------------------
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 * -----------------------------------------------------------------------------
 */

namespace frontend\assets;

use yii\web\AssetBundle;
use Yii;

// set @themes alias so we do not have to update baseUrl every time we change themes
Yii::setAlias('@themes', Yii::$app->view->theme->baseUrl);

/**
 * -----------------------------------------------------------------------------
 * @author Qiang Xue <qiang.xue@gmail.com>
 *
 * @since 2.0
 * -----------------------------------------------------------------------------
 */
class UserAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@themes';

    public $css = [
        'css/linearicons.css',
        'css/font-awesome.min.css',
        'css/bootstrap.css',
        'css/sliderfilecss/jquery.bxslider.css',
        'css/sliderfilecss/animate.css',
        'css/magnific-popup.css',
        'css/nice-select.css',
        'css/animate.min.css',
        'css/owl.carousel.css',
        'css/main.css',
        //'css/agency.css',
    ];
    public $js = [
        //'js/vendor/jquery-2.2.4.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js',
        'js/vendor/bootstrap.min.js',
        'https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA',
        'js/superfish.min.js',
        'js/jquery.ajaxchimp.min.js',
        'js/jquery.magnific-popup.min.js',
        'js/owl.carousel.min.js',
        'js/main.js',
        'js/sliderfile/jquery.bxslider.min.js',
        'js/sliderfile/plugin.js',
        'js/sliderfile/custom.js',

    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}

