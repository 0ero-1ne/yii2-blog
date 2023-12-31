<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name'=>'Static pages',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        's-pages' => [
            'class' => 'app\modules\sPages\Module',
        ],
        'admin' => [
            'class' => 'app\modules\sPages\modules\admin\Module',
        ],
        'page' => [
            'class' => 'app\modules\sPages\modules\page\Module',
        ],
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Sng8EKZoK4eH3e_qvx_pgn--8y9TEGdR',
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
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'suffix' => '.html',
            'rules' => [
                [
                    'pattern' => 'tags',
                    'route' => 'admin/tag',
                    'suffix' => '.php',
                ],
                [
                    'pattern' => 'articles',
                    'route' => 'admin/article',
                    'suffix' => '.php',
                ],
                [
                    'pattern' => 'categories',
                    'route' => 'admin/category',
                    'suffix' => '.php',
                ],
                [
                    'pattern' => 'articles',
                    'route' => 'page/article',
                    'suffix' => '.php',
                ],
                [
                    'pattern' => 'categories',
                    'route' => 'page/category',
                    'suffix' => '.php',
                ],
                [
                    'pattern' => 'tags',
                    'route' => 'page/tag',
                    'suffix' => '.php',
                ],
                
                'list-of-articles' => '/page/article/index',
                'page/<slug:[\w\-_\d]+>' => '/page/article/post',
                'list-of-tags' => '/page/tag/index',
                'page/tag/<slug:[\w\-_\d]+>' => '/page/tag/post',
                'page/tag/<slug:[\w\-_\d]+>/<page:\d+>' => '/page/tag/post',
                'list-of-categories' => '/page/category/index',
                'page/category/<slug:[\w\-_\d]+>' => '/page/category/post',//categories
                'page/category/<slug:[\w\-_\d]+>/<page:\d+>' => '/page/category/post',
            ],
        ],
        
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
