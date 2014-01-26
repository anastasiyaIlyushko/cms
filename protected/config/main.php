<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

Yii::setPathOfAlias('bootstrap', dirname(__FILE__) . '/../extensions/bootstrap');
// получаем список директорий в protected/modules
$dirs = scandir(dirname(__FILE__) . '/../modules');

// строим массив
$modules = array();
foreach ($dirs as $name) {
    if ($name[0] != '.')
        $modules[$name] = array('class' => 'application.modules.' . $name . '.' . ucfirst($name) . 'Module');
}

// строка вида 'news|page|user|...|socials'
// пригодится для подстановки в регулярные выражения общих правил маршрутизации
define('MODULES_MATCHES', implode('|', array_keys($modules)));

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'theme' => 'bootstrap',
    'name' => 'My Web Application',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*'
    ),
    'behaviors'=> array(
        array(
            'class'=>'DModuleUrlRulesBehavior',
            'beforeCurrentModule'=>array(
                //'page',
               // 'sitemap',
               // 'user',
            ),
            'afterCurrentModule'=>array(
                'page',
            )
        )
    ),
    'modules' => array_replace($modules, array(
        // если какой-либо модуль нуждается в переопределении для этого проекта, то пропишите его здесь
        'gii' => array(
            'generatorPaths' => array(
                'bootstrap.gii',
            ),
            'class' => 'system.gii.GiiModule',
            'password' => '1',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
            )
    ),
    // application components
    'components' => array(
        'bootstrap' => array(
            'class' => 'bootstrap.components.Bootstrap',
        ),
        'user' => array(
// enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'urlSuffix' => '',
            'rules' => array(
                // небольшая защита от дублирования адресов
                '<module:' . MODULES_MATCHES . '>/default/index' => 'main/error/error404',
                '<module:' . MODULES_MATCHES . '>/default' => 'main/error/error404',
                // правила для экшенов админки    
                '/admin/<module:' . MODULES_MATCHES . '>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/backend/<controller>/<action>',
                '/admin/<module:' . MODULES_MATCHES . '>/<controller:\w+>' => '<module>/backend/<controller>/index',
                '/admin/<module:' . MODULES_MATCHES . '>/<controller:\w+>/<action:\w+>' => '<module>/backend/<controller>/<action>',
            ),
        ),
//        'urlManager' => array(
//            'urlFormat' => 'path',
//            'rules' => array(
//                '<controller:\w+>/<id:\d+>' => '<controller>/view',
//                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
//                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
//            ),
//        ),
        //'db' => array(
        //'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/testdrive.db',
        // ),
        // uncomment the following to use a MySQL database
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=siteNastya',
            'emulatePrepare' => true,
            'username' => 'siteNastya',
            'password' => 'siteNastya',
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
// use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
    ),
    // application-level parameters that can be accessed
// using Yii::app()->params['paramName']
    'params' => array(
// this is used in contact page
        'adminEmail' => 'webmaster@example.com',
    ),
);
