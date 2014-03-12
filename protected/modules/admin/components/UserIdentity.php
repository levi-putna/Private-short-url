<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {
    private $id;
    private $date_format;

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     *
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {
        $user = AdminAccounts::model()->findByAttributes(array('email' => $this->username));
        if (empty($user)) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else {
            if (!$user->authenticate($this->password)) {
                $this->errorCode = self::ERROR_PASSWORD_INVALID;
            } else {
                $this->id = $user->id;
                $this->setState('role', $user->role);

                $this->errorCode = self::ERROR_NONE;
                $user->updateLastLoginDate();

                $auth = Yii::app()->authManager;
                $role = Role::model()->findByPk($user->role_id);

                //assign role
                $this->setState('roles', $role->key);

            }
        }
        return !$this->errorCode;
    }

    public function getId() {
        return $this->id;
    }
}