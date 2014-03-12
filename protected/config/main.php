<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath'   => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name'       => 'Lottery Results',
    'id'         => 'lr',

    // preloading 'log' component
    'preload'    => array('log'),

    // autoloading model and component classes
    'import'     => array(
        'application.models.*',
        'application.components.*',
        'application.helpers.*',
        'application.widgets.*',
    ),

    'modules'    => array(

        'admin',

        // uncomment the following to enable the Gii tool
        'gii' => array(
            'class'          => 'system.gii.GiiModule',
            'password'       => 'gii',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters'      => array('127.0.0.1', '::1'),

            'generatorPaths' => array(
                'bootstrap.gii'
            ),

        ),
    ),

    // application components
    'components' => array(
        'user'         => array(
            'class'          => 'WebUser',
            // enable cookie-based authentication
            'allowAutoLogin' => true,

        ),

        'clientScript' => array(
            'packages' => array(
                'jquery' => array(
                    'baseUrl' => '/components/jquery/',
                    'js'      => array('dist/jquery.min.js'),
                ),
            ),
        ),

        // session configuration

        // uncomment the following to enable URLs in path-format

        'urlManager'   => array(
            'urlFormat'      => 'path',
            'showScriptName' => false,
            'rules'          => array(
                /* gii for development, comment this in production */
                'gii'                                                                               => 'gii',
                'gii/<controller:\w+>'                                                              => 'gii/<controller>',
                'gii/<controller:\w+>/<action:\w+>'                                                 => 'gii/<controller>/<action>',

                /* Sub domain mapping used for admin */
                'http://<module:admin>.<hostname:[^\/]+>/'                                          => '<module>/default/index',
                'http://<module:admin>.<hostname:[^\/]+>/<action:(login|logout|about)>'             => '<module>/default/<action>',
                'http://<module:admin>.<hostname:[^\/]+>/<controller:\w+>'                          => '<module>/<controller>/index',
                'http://<module:admin>.<hostname:[^\/]+>/<controller:\w+>/<action:\w+>'             => '<module>/<controller>/<action>',
                'http://<module:admin>.<hostname:[^\/]+>/<controller:\w+>/<action:\w+>/<id:\d+>'    => '<module>/<controller>/<action>/id/<id>',
                'http://<module:admin>.<hostname:[^\/]+>/<controller:\w+>/<action:\w+>/id/<id:\d+>' => '<module>/<controller>/<action>/id/<id>',

                /* Website URL Mapping */
                '/'                                                                                 => 'site/',
                '/<key:\w+>'                                                                        => 'site/redirect/key/<key>',


                //'http://<module:admin>.<hostname:[^\/]+>/<submodule:\\w+>'                          => '<module>/<submodule>/default/index',
            ),
        ),

        'db'           => require(dirname(__FILE__) . '/db.php'),

        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),

        'log'          => array(
            'class'  => 'CLogRouter',
            'routes' => array(
                array(
                    'logFile' => 'error.log',
                    'class'   => 'CFileLogRoute',
                    'levels'  => 'error,info, warning',
                ),
                'email' => array(
                    'class'   => 'CEmailLogRoute',
                    'filter'  => array(
                        'class'            => 'AdvancedLogFilter',
                        'ignoreCategories' => array(
                            // Ignore 404s
                            'exception.CHttpException.404',
                        ),
                    ),
                    'levels'  => 'error',
                    'emails'  => 'error@site.com',
                    'subject' => 'Error Report',
                ),
            ),
        ),
    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params'     => array(
        // this is used in contact page
        'adminEmail'      => 'webmaster@example.com',
        'dateFormat'      => 'd/m/y',
        'dateFormatSmall' => 'j M',
    ),
);