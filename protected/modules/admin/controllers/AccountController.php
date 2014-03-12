<?php

class AccountController extends Controller {

    public $icon = 'fa-rocket';
    public $title = "Admin Account";

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
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
            array(
                'allow', // allow all users to perform 'index' 'view' and 'profile' actions
                'actions' => array('index', 'create', 'profile', 'details'),
                'roles'   => array('systemadmin'),
            ),
            array(
                'allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('password', 'profile'),
                'users'   => array('@'),
            ),
            array(
                'deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     *
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view',
            array(
                 'model' => $this->loadModel($id),
            )
        );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new AdminAccounts('insert');
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['AdminAccounts'])) {
            $model->attributes = $_POST['AdminAccounts'];
            if ($model->save()) {
                $this->redirect('/users/index/?ping=' . $model->id);
            }
        }

        $this->render('create',
            array(
                 'model' => $model,
            )
        );
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id the ID of the model to be updated
     */
    public function actionDetails($id) {
        $model = $this->loadModel($id);

        $this->sub_title = "$model->given_name $model->family_name";

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Admin'])) {
            $model->setScenario('update');
            $model->attributes = $_POST['AdminAccounts'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', '<h4>Profile Updated</h4><p>Your profile has been updated. Note, if you cave changed your password, you will need to use this new password to log in next time.</p>');
            }
        }

        $this->render('details',
            array(
                 'model' => $model,
            )
        );
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     *
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {

        $this->sub_title = "";

        $model = new AdminAccounts('search');
        $model->unsetAttributes(); // clear any default values

        if (isset($_GET['AdminAccounts'])) {
            $model->attributes = $_GET['AdminAccounts'];
        }

        $this->render('index',
            array(
                 'model' => $model,
            )
        );
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     *
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = AdminAccounts::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     *
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionPassword() {
        $model = $this->loadModel(Yii::app()->user->id);

        if (isset($_POST['AdminAccounts'])) {
            $model->scenario   = 'update';
            $model->attributes = $_POST['AdminAccounts'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', '<h4>Password Updated</h4><p>Your password has been successfully updated, please use this new password next time you log in.</p>');
                Yii::app()->session->add('passwordChanged', true);
            }
        }

        $passwordChanged = false;

        if (Yii::app()->session->get('passwordChanged')) {
            $passwordChanged = true;
            unset(Yii::app()->session['passwordChanged']);
        }

        $this->render('password',
            array(
                 'model'           => $model,
                 'passwordChanged' => $passwordChanged
            )
        );
    }

    public function actionProfile() {
        $model = $this->loadModel(Yii::app()->user->id);

        if (isset($_POST['AdminAccounts'])) {
            $model->setScenario('update');
            $model->attributes = $_POST['AdminAccounts'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', '<h4>Profile Updated</h4><p>Your profile has been updated. Note, if you cave changed your password, you will need to use this new password to log in next time.</p>');
            }
        }

        $this->render('profile',
            array(
                 'model' => $model,
            )
        );
    }
}
