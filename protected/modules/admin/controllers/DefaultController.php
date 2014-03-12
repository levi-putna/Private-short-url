<?php

class DefaultController extends Controller {
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     *
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            // allow all users to perform
            array(
                'allow',
                'users'   => array('*'),
                'actions' => array('login', 'logout', 'error')
            ),
            // allow authenticated user to perform
            array(
                'allow',
                'users'   => array('@'),
                'actions' => array('index')
            ),
            // deny all users
            array(
                'deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {

        $model = new URL('search');
        $model->unsetAttributes(); // clear any default values

        if (isset($_GET['URL'])) {
            $model->attributes = $_GET['URL'];
        }
        $this->render('index',
            array(
                 'model' => $model,
            )
        );
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $this->layout = '/layouts/login';

        $model = new LoginForm;

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];

            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }

        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest) {
                echo $error['message'];
            } else {
                Yii::app()->controller->renderPartial('error', array('error' => $error));
            }

        }

    }
}