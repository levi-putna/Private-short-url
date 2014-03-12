<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Admin | <?= CHtml::encode($this->pageTitle); ?></title>

    <meta name="description" content="web based applications application"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

    <link rel="shortcut icon" href="/common/images/favicon.ico">

    <?php
    /*
     * Include all css and javascript files. Make sure to specify a cline strip position for all JavaScript files.
     * If possible load JavaScript files at the end of the document.
     */
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();

    //$cs->registerCssFile($baseUrl . '/accounts/css/pace.css', 'all');
    $cs->registerCssFile($baseUrl . '/components/bootstrap/dist/css/bootstrap.min.css', 'all');
    $cs->registerCssFile($baseUrl . '/components/font-awesome/css/font-awesome.min.css', 'all');
    $cs->registerCssFile($baseUrl . '/admin/css/animation.css', 'all');
    $cs->registerCssFile($baseUrl . '/components/select2/select2.css', 'all');
    $cs->registerCssFile($baseUrl . '/components/select2/select2-bootstrap.css', 'all');
    $cs->registerCssFile($baseUrl . '/components/morris.js/morris.css', 'all');
    $cs->registerCssFile($baseUrl . '/admin/css/main.css', 'all');

    //Library Dependencies

    $cs->registerScriptFile($baseUrl . '/components/bootstrap/dist/js/bootstrap.min.js', CClientScript::POS_END);
    $cs->registerScriptFile($baseUrl . '/components/StickyTableHeaders/js/jquery.stickytableheaders.min.js', CClientScript::POS_END);
    $cs->registerScriptFile($baseUrl . '/components/select2/select2.js', CClientScript::POS_END);

    $cs->registerScriptFile($baseUrl . '/components/jquery-autosize/jquery.autosize.min.js', CClientScript::POS_END);
    $cs->registerScriptFile($baseUrl . '/components/raphael/raphael.js', CClientScript::POS_END);
    $cs->registerScriptFile($baseUrl . '/components/morris.js/morris.min.js', CClientScript::POS_END);


    $cs->registerScriptFile($baseUrl . '/admin/js/admin.min.js', CClientScript::POS_END);


    ?>
</head>

<body class="page">


<img src="/admin/img/bg.jpg" class="background">

<div class="title">
     <h1> Short URL</h1>
</div>
<section class="container">

    <?= $content ?>
</section>
</body>
</html>