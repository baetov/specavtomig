<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'app\bootstrap\AppBootstrap'],
    'defaultRoute' => 'bid',
    'name' => 'CRM',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'GhAcZ2j2hHCv9-XMRK1mi0wYRu29SWwu',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'rules' => [

            ],
        ],
  
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@app/views/yii2-app',
                    //'@vendor/teo_crm/yii2-comments/widgets/views' => '@app/views/comments',
                    '@vendor/rmrevin/yii2-comments/widgets/views' => '@app/views/comments',
                ],
            ],
        ],
        'formatter' => [
            'dateFormat' => 'dd.mm.yyyy',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => '₽',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
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
        'db' => require(__DIR__ . '/db.php'),
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ],
        'comments' => [
            // 'class' => 'teo_crm\yii\module\Comments\Module',
            // 'userIdentityClass' => 'app\models\User',
            // 'useRbac' => false,
            'class' => 'rmrevin\yii\module\Comments\Module',
            'userIdentityClass' => 'app\models\User',
            'useRbac' => false,
            'modelMap' => [
                'Comment' => \app\models\Comment::class,
            ],
        ],
        'api' => [
            'class' => 'app\modules\api\Api',
        ],
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'language' => 'ru-RU',
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    //$config['bootstrap'][] = 'debug';
    //$config['modules']['debug'] = [
    //    'class' => 'yii\debug\Module',
    //    // uncomment the following to add your IP if you are not connecting from localhost.
    //    'allowedIPs' => ['*'],
    //];

    //$config['bootstrap'][] = 'gii';
    //$config['modules']['gii'] = [
    //    'class' => 'yii\gii\Module',
    //    // uncomment the following to add your IP if you are not connecting from localhost.
    //    'generators' => [
    //        'crud' => [
    //             'class' => 'yii\gii\generators\crud\Generator',
    //            'templates' => ['My' => '@app/vendor/yiisoft/yii2-gii/generators/crud/admincolor']
    //        ]
    //    ],
    //   'allowedIPs' => ['*'],
    //];
}

return $config;
