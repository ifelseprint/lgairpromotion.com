<?php
use yii\web\Request;
$baseUrl = str_replace('/frontend/web', '', (new Request)->getBaseUrl());

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'language' => 'th',
    'bootstrap' => ['log'],
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'frontend\controllers',
    'homeUrl'=> $baseUrl,
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => $baseUrl,
            'csrfCookie' => [
                'httpOnly' => true,
                'secure' => true
            ]
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true, 'secure' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
            'cookieParams' => [
                'httpOnly' => true,
                'secure' => true
            ]
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
            'errorAction' => 'error/404',
        ],
        'CoreFunctions' => [
            'class' => 'frontend\components\CoreFunctions'
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                ''                                           => 'home/index',
                'law'                                        => 'home/law',
                'privacy-policy'                             => 'home/privacy-policy',
                // Default
                '<controller:[\w\-]+>'                       => '<controller>/index',
                '<controller:[\w\-]+>/<id:\d+>'              => '<controller>/view',
                '<controller:[\w\-]+>/<action:[\w\-]+>/<id>' => '<controller>/<action>',
                '<controller:[\w\-]+>/<action:[\w\-]+>'      => '<controller>/<action>',
       
                // error
                // 'error/404' => 'error/404',
            ],
        ],
        
    ],
    'params' => $params,
];
