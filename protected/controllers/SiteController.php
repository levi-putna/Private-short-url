<?php

class SiteController extends Controller {

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        $this->render('index');
    }

    public function actionRedirect($key) {
        $url = URL::model()->findByAttributes(array('key' => $key));

        if ($url == null) {
            $url = URL::model()->findByAttributes(array('alias' => $key));
            if ($url == null) {
                throw new CHttpException(404,'The URL you requested does not exist.');
            }
        }

        header('HTTP/1.1 301 Moved Permanently');
        header('Location: ' . $url->url);
        $url->hit();
        exit;
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            //if (Yii::app()->request->isAjaxRequest) {
            echo $error['message'];
            //} else {
            //    $this->render('error', $error);
            //}
        }
    }
}