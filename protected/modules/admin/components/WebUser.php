<?php

class WebUser extends CWebUser {

    // Store model to not repeat query.
    private $model;

    /**
     * Overrides a Yii method that is used for roles in controllers (accessRules).
     *
     * @param string $operation Name of the operation required (here, a role).
     * @param mixed  $params    (opt) Parameters for this operation, usually the object to access.
     *
     * @return bool Permission granted?
     */
    public function checkAccess($operation, $params = array()) {
        if (empty($this->id)) {
            return false;
        }

        $role = $this->getState("roles");

        // allow access if the operation request is the current user's role
        return ($operation === $role);
    }

    /**
     * Gets the FullName of user
     *
     * @return string
     */
    public function getDateFormat() {
        $account = $this->loadUser(Yii::app()->user->id);

        $date_format = $account->getDateFormat();

        if ($date_format == null) {
            return "d/m/Y";
        }
        return $date_format;
    }

    public function getEmail() {
        $account = $this->loadUser(Yii::app()->user->id);

        return $account->email;
    }

    public function getDisplayName() {
        $account = $this->loadUser(Yii::app()->user->id);
        return $account->given_name . ' ' . $account->family_name;
    }

    public function getAvatar() {
        $account = $this->loadUser(Yii::app()->user->id);
        return $account->getAvatar();
    }

    // Load user model.
    protected function loadUser($id = null) {
        if ($this->model === null) {
            if ($id !== null) {
                $this->model = AdminAccounts::model()->findByPk($id);
            }
        }
        return $this->model;
    }
}