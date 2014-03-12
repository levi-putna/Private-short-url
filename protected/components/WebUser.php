<?php

/*
 * CWebUser represents the persistent state for a Web application user.
 *
 * CWebUser is used as an application component whose ID is 'user'. Therefore, at any place one can access the user
 * state via Yii::app()->user.CWebUser should be used together with an identity which implements the actual
 * authentication algorithm.
 */

// this file must be stored in:
// protected/components/WebUser.php

class WebUser extends CWebUser {

    /*
     * The id property is a unique identifier for a user that is persistent during the whole user session.
     */

    /*
     * A cache for the user model, the model is not populated during initialisation and only get populated after the
     * first get method is called.
     */
    private $model;

    public $identityCookie = array(
        'path' => '/',
        'domain' => '.flatbook.com',
    );

    public function init() {
        $conf                 = Yii::app()->session->cookieParams;
//        $this->identityCookie = array(
//            'path'   => $conf['path'],
//            'domain' => $conf['domain'],
//        );
        parent::init();
    }

    /**
     *
     */
    function getEmail() {
        $user = $this->loadUser(Yii::app()->user->id);

        if ($user) {
            return $user->email;
        } else {
            return null;
        }
    }

    function getOrganisation() {
        $user = $this->loadUser(Yii::app()->user->id);

        try {
            $organisation_user = OrganisationUser::model()->findByAttributes(array('user_id' => $user->id));
            return Organisation::model()->findByPk($organisation_user->organisation_id);
        } catch (Exception $e) {
            return null;
        }

    }

    function getOrganisationID() {
        $user = $this->loadUser(Yii::app()->user->id);

        try {
            $organisation_user = OrganisationUser::model()->findByAttributes(array('user_id' => $user->id));
            return $organisation_user->organisation_id;
        } catch (Exception $e) {
            return null;
        }
    }

    // This is a function that checks the field 'role'
    // in the User model to be equal to 1, that means it's admin
    // access it by Yii::app()->user->isAdmin()
    function isAdmin() {
        $user = $this->loadUser(Yii::app()->user->id);
        //return intval($user->role) == 1;
    }

    // Load user model.
    protected function loadUser($id = null) {
        if ($this->model === null) {
            if ($id !== null) {
                $this->model = User::model()->findByPk($id);
            }
        }
        return $this->model;
    }
}

?>