<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '35vl5DwDi92M9JPWa03CId_dJh9eAx5L',
        ],
		
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
	$config['components']['assetManager']['forceCopy'] = true;
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii']=[
      'class' =>  'yii\gii\Module',
      'allowedIPs' => ['*'],
    ];
}

return $config;
