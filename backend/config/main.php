<?php
use yii\web\Request;
$baseUrl = str_replace('/backend/web', '', (new Request)->getBaseUrl());

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'homeUrl' => $baseUrl.'/admin',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'baseUrl' => $baseUrl.'/admin',
            'csrfCookie' => [
                'httpOnly' => true,
                'secure' => true
            ]
        ],
        'user' => [
            'identityClass' => 'backend\models\Users',
            'enableAutoLogin' => false,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true, 'secure' => true],
            'loginUrl' => [ 'login/index' ],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
            'errorAction' => 'site/error',
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                ''                                                        => 'dashboard/index',
                // Default
                '<controller:[\w\-]+>'                                    => '<controller>/index',
                '<controller:[\w\-]+>/<id:\d+>'                           => '<controller>/view',
                '<controller:[\w\-]+>/<action:[\w\-]+>/<id>'              => '<controller>/<action>',
                '<controller:[\w\-]+>/<action:[\w\-]+>'                   => '<controller>/<action>',
            ],
        ],
        
    ],
    'params' => $params,
];
