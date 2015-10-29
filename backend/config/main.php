<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'name'=>'Your New Name!',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'user' => [
            // 'identityClass' => 'common\models\User',
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_backendIdentity',
                // 'path' => '/backend',
                // 'httpOnly' => true,
            ],
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
        
        // newadded
        'request' => [
            // 'csrfParam' => '_backendCSRF',
            // 'csrfCookie' => [
            //     'httpOnly' => true,
            //     'path' => '/backend',
            // ],
            'cookieValidationKey' => '8wowZJGOrDiidY9WlHUmqcAaOr7P_31s',
            'csrfParam' => '_backendCSRF',
        ],
        'session' => [
            'name' => 'BACKENDSESSID',
            'savePath' => sys_get_temp_dir(),
            // 'cookieParams' => [
            //     'path' => '/backend',
            // ],
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'baseUrl' => '/backend',
            'enablePrettyUrl' => true,
            'showScriptName' => true,
        ],
        'urlManagerFrontend' => [
            'class' => 'yii\web\UrlManager',
            'baseUrl' => '',
            'enablePrettyUrl' => true,
            'showScriptName' => true,
        ],
        // newadded
    ],
    'params' => $params,
];
