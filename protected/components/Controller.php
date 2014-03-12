<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {
    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '/layout/default';

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    public function init() {
        if (!yii::app()->request->isAjaxRequest) {

            $baseUrl = Yii::app()->baseUrl;
            $cs      = Yii::app()->getClientScript();

            //if (YII_DEBUG)

            $cs->registerCssFile($baseUrl . '/common/css/bootstrap.css', 'all');
            $cs->registerCssFile($baseUrl . '/common/css/animate.css', 'all');
            $cs->registerCssFile($baseUrl . '/common/css/font.css', 'all');
            $cs->registerCssFile($baseUrl . '/common/css/fontello.css', 'all');
            $cs->registerCssFile($baseUrl . '/common/css/select2.css', 'all');
            $cs->registerCssFile($baseUrl . '/common/less/app.css', 'all');
            $cs->registerCssFile($baseUrl . '/site/css/landing.css', 'all');

            $cs->registerScriptFile($baseUrl . '/common/js/jquery.min.js', CClientScript::POS_END);
            $cs->registerScriptFile($baseUrl . '/common/js/bootstrap.js', CClientScript::POS_END);
            $cs->registerScriptFile($baseUrl . '/common/js/select2.min.js', CClientScript::POS_END);
            $cs->registerScriptFile($baseUrl . '/common/js/core.js', CClientScript::POS_END);
        }
    }
}