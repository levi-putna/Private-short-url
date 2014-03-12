<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
    'basePath'   => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name'       => 'Console',

    // preloading 'log' component
    'preload'    => array('log'),

    'import'     => array(
        'application.models.*',
        'application.components.*',
        'application.helpers.*',
        'application.modules.admin.models.*',
    ),

    // application components
    'components' => array(
        'db'  => require(dirname(__FILE__) . '/db.php'),

        'log' => array(
            'class'  => 'CLogRouter',
            'routes' => array(
                array(
                    'class'  => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            ),
        ),
    ),
);