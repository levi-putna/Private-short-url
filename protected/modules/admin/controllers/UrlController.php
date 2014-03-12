<?php

class UrlController extends Controller {

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
                'actions' => array('delete'),
                'roles'   => array('admin'),
            ),
            array(
                'allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('index', 'create', 'details'),
                'users'   => array('@'),
            ),
            array(
                'deny', // deny all users
                'users' => array('*'),
            ),
        );
    }


    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {


        $model = new URL('insert');

        if (isset($_POST['URL'])) {
            $url = URL::model()->findByAttributes(array('url' => $_POST['URL']['url']));

            if ($url != null) {
                $this->redirect('/url/details/' . $url->id);
                exit;
            }
            $model->url      = $_POST['URL']['url'];
            $model->admin_id = Yii::app()->user->getId();
            if ($model->save()) {
                $this->redirect('/url/details/' . $model->id);
            } else {
                $this->render('create',
                    array(
                         'model' => $model,
                    )
                );
            }
        } else {
            $this->redirect('/');
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id the ID of the model to be updated
     */
    public function actionDetails($id) {
        $model = $this->loadModel($id);

        if (isset($_POST['URL'])) {
            $model->attributes = $_POST['URL'];

            if ($model->save()) {
                Yii::app()->user->setFlash('success', "Your URL has been successfully updated. Any new clicks will use the new configuration.");
            } else {
                Yii::app()->user->setFlash('error', "Sorry, you have an error in your configeration configuration.");
            }
        }

        $this->render('details',
            array(
                 'model' => $model,
            )
        );
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $this->redirect('/');
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     *
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = URL::model()->findByPk($id);
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
}
