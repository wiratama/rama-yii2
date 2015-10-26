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
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            // newadded
            'identityCookie' => [
                'name' => '_frontendUser', // unique for frontend
            ]
            // newadded
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
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => true,
            'enableStrictParsing' => false, //‘enableStrictParsing’ => true, tells Yii2 to allow only the routes that are listed in the rules.
            'rules' => [
                '/' => 'site/index',
                'about' => 'site/about',
                'contact' => 'site/contact',
                'login' => 'site/login',
                'logout' => 'site/logout',
                'captcha' => 'site/captcha',
                // 'signup' => 'site/signup',
                'signup' => 'member/signup',
                'request-password-reset' => 'site/request-password-reset',
                'reset-password' => 'site/reset-password',
            ],
        ],
        'urlManagerBackend' => [
            'class' => 'yii\web\UrlManager',
            'baseUrl' => '/backend',
            'enablePrettyUrl' => true,
            'showScriptName' => true,
        ],
        // 'view' => [
        //     'theme' => [
        //         'basePath' => '@app/themes/basic',
        //         'baseUrl' => '@web/themes/basic',
        //         'pathMap' => [
        //             '@app/views' => '@app/themes/basic',
        //         ],
        //     ],
        // ],
        'session' => [
            'name' => 'PHPFRONTSESSID',
            'savePath' => sys_get_temp_dir(),
        ],
        'request' => [
            'cookieValidationKey' => 'B9X_NWVQI_kua9KG7R7Qa44XxGvmk-Ez',
            'csrfParam' => '_frontendCSRF',
        ],
        // newadded
    ],
    'params' => $params,
];
