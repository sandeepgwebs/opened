<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        // here you can set theme used for your frontend application 
        // - template comes with: 'default', 'slate', 'spacelab' and 'cerulean'
        'view' => [
            'theme' => [
                'pathMap' => ['@app/views' => '@webroot/themes/conffrence1/views'],
                'baseUrl' => '@web/themes/conffrence1',
            ],
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => array(
                '/' => 'site/index',
				'/account.html' => 'account/index',
				'/account/information.html' => 'account/information',
				'/account/shipping-address.html' => 'account/shipping-address',
				'/account/billing-address.html' => 'account/billing-address',
				'/account/orders.html' => 'account/orders',
				'/account/login' => '/site/login',
				'/account/chair-login.html' => '/site/chair-login',			
				'/testimonial.html' => '/site/testimonial',		
				'/tell-a-friend.html' => '/site/tell-a-friend',		
				'/contact-us.html' => '/site/contact',		
				'/downloads.html' => '/site/downloads',	
				'/special-session.html' => '/site/special-session',
				'/download-list.html' => '/site/download-list',	
				'/committees.html' => '/site/committees',	
				'/payment-success.html' => '/site/payment-success',	
				'/payment-cancel.html' => '/site/payment-cancel',	
				'/payment-failure.html' => '/site/payment-failure',	
				'/gallery.html' => '/site/gallery',	
				'/speakers.html' => '/site/speakers',	

                '/search'=>'/finder/product-search',
                
                '/<slug:.*?>.html'=>'/site/page',


            ),
        ],
        'user' => [
            'identityClass' => 'common\models\UserIdentity',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'session' => [
            'name' => 'PHPFRONTSESSID',
            'savePath' => __DIR__ . '/../tmp',
        ], 
    ],
    'params' => $params,
];
