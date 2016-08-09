<?php

use yii\helpers\ArrayHelper;

$params = ArrayHelper::merge(
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

$db = ArrayHelper::merge(
    require(__DIR__ . '/db.php'),
    require(__DIR__ . '/db-local.php')
);

$eauth = ArrayHelper::merge(
    require(__DIR__ . '/eauth.php'),
    require(__DIR__ . '/eauth-local.php')
);

$config = [
    'id' => 'basic',
    'defaultRoute' => 'portfolio/view',
    'language'=>'ru-RU',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'eauth' => $eauth,
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'CbJ_cqJt8O3g0kit-tnczGHyVsghDxRV',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'trace'],
                    /*'logFile' => '@app/log.txt',*/
                ],
            ],
        ],
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'login' => 'site/login',
                'logout' => 'site/logout',
                'id<id:[-\d]+>' => 'portfolio/view',
                'my-portfolio' => 'portfolio/index',
                'add-portfolio' => 'portfolio/add',
                'edit-portfolio/id<id:[-\d]+>' => 'portfolio/edit',
            ],
        ],

        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'forceTranslation' => true,
                ],
                'eauth' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@eauth/messages',
                ],
            ],
        ],

    ],

    'modules' => [
        /* other modules */
        'markdown' => [
            'class' => 'kartik\markdown\Module',
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
