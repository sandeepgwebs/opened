<?php
return [
    'name' => 'IRES 2017',
    //'language' => 'sr',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
	'bootstrap' => [
		'common\config\settings',
		'devicedetect',
    ],	
    'components' => [
        'assetManager' => [
            'bundles' => [
                // we will use bootstrap css from our theme
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [], // do not use yii default one
                ],
                // // use bootstrap js from CDN
                // 'yii\bootstrap\BootstrapPluginAsset' => [
                //     'sourcePath' => null,   // do not use file from our server
                //     'js' => [
                //         'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js']
                // ],
                // // use jquery from CDN
                // 'yii\web\JqueryAsset' => [
                //     'sourcePath' => null,   // do not use file from our server
                //     'js' => [
                //         'ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js',
                //     ]
                // ],
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
			'rules' => [
                'login/<service:google|facebook|etc>' => 'site/login',
            ],
        ],
        'session' => [
            'class' => 'yii\web\DbSession',
            'timeout' => 3600*4,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'eauth' => [
            'class' => 'nodge\eauth\EAuth',
            'popup' => true, // Use the popup window instead of redirecting.
            'cache' => false, // Cache component name or false to disable cache. Defaults to 'cache' on production environments.
            'cacheExpire' => 0, // Cache lifetime. Defaults to 0 - means unlimited.
            //'httpClient' => [
                // uncomment this to use streams in safe_mode
                //'useStreamsFallback' => true,
           // ],
            'services' => [ // You can change the providers and their classes.
               'google' => [
                    // register your app here: https://code.google.com/apis/console/
                    'class' => 'nodge\eauth\services\GoogleOAuth2Service',
                    'clientId' => '824053223114-bnfqpb6tedoidgql2v5a8eh3k4cm6kut.apps.googleusercontent.com',
                    'clientSecret' => 'ychMp44t0Qca2BsJURONYnhl',
                    'title' => 'Drish Shoes',
                ],
                'facebook' => [
                    // register your app here: https://developers.facebook.com/apps/
                    'class' => 'nodge\eauth\services\FacebookOAuth2Service',
                    'clientId' => '106275983158845', 
                    'clientSecret' => '1d5afca5d0f1ad3541c1dd67e7c151c9', 
                ],
                 'instagram' => [
                    // register your app here: https://instagram.com/developer/register/
                    'class' => 'nodge\eauth\services\InstagramOAuth2Service',
                    'clientId' => '6b4d622251a34d93bc86f5da941f0d32',
                    'clientSecret' => '6b4d622251a34d93bc86f5da941f0d32',
                ], 
            ],
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'logFile' => '@app/runtime/logs/eauth.log',
                    'categories' => ['nodge\eauth\*'],
                    'logVars' => [],
                ],
							 [
            'class' => 'yii\log\FileTarget',
            'levels' => ['info'],
            'categories' => ['import'],
            'logFile' => '@backend/runtime/logs/import/info.log',
            'maxFileSize' => 1024 * 2,
            'maxLogFiles' => 20,
			],
            ],

        ],		
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/translations',
                    'sourceLanguage' => 'en',
                ],
				'eauth' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@eauth/messages',
                ],
                'yii' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/translations',
                    'sourceLanguage' => 'en'
                ],
				
            ],
        ],
		'devicedetect' => [
			'class' => 'alexandernst\devicedetect\DeviceDetect'
		],
    ], // components
	'modules' => [
		'redactor' => [
            'class' => 'yii\redactor\RedactorModule',
            'uploadDir' => '@webroot/uploads/images',
            'uploadUrl' => '@web/uploads/images',
            'imageAllowExtensions'=>['jpg','png','gif']
        ],
		'treemanager' =>  [
			'class' => '\kartik\tree\Module',
			// other module settings, refer detailed documentation
		],
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
            // enter optional module parameters below - only if you need to
            // use your own export download action or custom translation
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ]
	],
    // set allias for our uploads folder so it can be shared by both frontend and backend applications
    // @appRoot alias is definded in common/config/bootstrap.php file
    'aliases' => [
        '@uploads' => '@appRoot/uploads'
    ],
];
