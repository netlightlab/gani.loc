<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'language' => 'ru',
    'bootstrap' => ['log'],
    //'homeUrl' => '/',
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            /*'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'mail.eltourism.kz',
                'username' => 'noreply@eltourism.kz',
                'password' => 'Jm2w~7t8',
                'port' => '25',
            ]*/
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
		'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=mypr',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],

        /*'urlManager' => [
            'class' => 'yii\web\UrlManager',
            // Disable index.php
            'showScriptName' => false,
            // Disable r= routes
            'enablePrettyUrl' => true,
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ],*/
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
//            'suffix' => '/',
            'class' => 'frontend\widgets\MultiLang\Components\UrlManager',
            'languages' => ['ru', 'en', 'kz'],
            'enableDefaultLanguageUrlCode' => false,
            'rules' => [
                [
                    'class' => 'common\components\PageUrlRule',
                ],
                '/' => 'site/index',
//                '<action>'=>'site/<action>',
                'catalog' => 'catalog/index',
                'news' => 'news/index',
                'news/<id:[\w\d\-]+>' => 'news/view',
                '<id:[\w\d\-]+>' => 'site/page',
                'catalog/<id:[\w\-]+>' => 'catalog/view',
                'tours/<id:[\d\-]+>' => 'tours/view',
//                'cart' => 'cart/index'
            ],
        ],
        'assetManager' => [
            'basePath' => '@webroot/assets',
            'baseUrl' => '@web/assets'
        ],

        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    // каталог, где будут располагаться словари
                    'basePath' => '@common/messages',
                    // исходный язык, на котором изначально
                    // написаны фразы в приложении
                    'sourceLanguage' => 'ru',
                ],
            ],
        ],
    ],
    'params' => $params,
];
