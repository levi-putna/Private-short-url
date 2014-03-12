<!DOCTYPE html>
<html lang="en" ng-app="Accounts">
<head>
    <meta charset="utf-8"/>
    <title>Admin | Login</title>

    <meta name="description" content="web based applications application"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

    <link rel="shortcut icon" href="/common/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/common/img/favicon.ico" type="image/x-icon">

    <?php
    /*
     * Include all css and javascript files. Make sure to specify a cline strip position for all JavaScript files.
     * If possible load JavaScript files at the end of the document.
     */
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile($baseUrl . '/components/bootstrap/dist/css/bootstrap.min.css', 'all');
    $cs->registerCssFile($baseUrl . '/components/font-awesome/css/font-awesome.min.css', 'all');
    $cs->registerCssFile($baseUrl . '/admin/css/animation.css', 'all');
    $cs->registerCssFile($baseUrl . '/admin/css/main.css', 'all');

    //Library Dependencies
    Yii::app()->clientScript->registerCoreScript('jquery');
    $cs->registerScriptFile($baseUrl . '/components/jquery/dist/jquery.min.js', CClientScript::POS_END);
    $cs->registerScriptFile($baseUrl . '/components/bootstrap/dist/js/bootstrap.min.js', CClientScript::POS_END);
    $cs->registerScriptFile($baseUrl . '/components/select2/select2.js', CClientScript::POS_END);
    $cs->registerScriptFile($baseUrl . '/admin/js/main.js', CClientScript::POS_END);

    ?>
</head>

<body class="single">
<img src="/admin/img/bg.jpg" class="background">
<div class="container">
    <?= $content ?>
</div>
</body>
</html>