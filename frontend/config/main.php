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
			'showScriptName' => false,
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
		'view' => [
			'theme' => [
				'basePath' => '@app/themes/rama',
				'baseUrl' => '@web/themes/rama',
				'pathMap' => [
					'@app/views' => '@app/themes/rama',
				],
			],
		],
		'session' => [
			'name' => 'PHPFRONTSESSID',
			'savePath' => sys_get_temp_dir(),
		],
		'request' => [
			'cookieValidationKey' => 'B9X_NWVQI_kua9KG7R7Qa44XxGvmk-Ez',
			'csrfParam' => '_frontendCSRF',
		],
		'reCaptcha' => [
			'name' => 'reCaptcha',
			'class' => 'himiklab\yii2\recaptcha\ReCaptcha',
			'siteKey' => '6Ld-mg8TAAAAAJPK3iJl1LYo8-Z6l7WSo82cTQPU',
			'secret' => '6Ld-mg8TAAAAAAQaHcZh-UPIbyHrbSSljOACOSqN',
		],
		'assetManager' => [
			'class' => 'yii\web\AssetManager',
			'bundles' => [
				'yii\web\JqueryAsset' => [
					'js' => [
						'jquery.min.js'
					]
				],
				'yii\bootstrap\BootstrapAsset' => [
					'css' => [
						'css/bootstrap.min.css',
					]
				],
				'yii\bootstrap\BootstrapPluginAsset' => [
					'js' => [
						'js/bootstrap.min.js',
					]
				]
			],
		],
		// newadded
	],
	'params' => $params,
];
