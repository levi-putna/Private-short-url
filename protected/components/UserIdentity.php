<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {
    private $id;
    private $email;

    const ERROR_EMAIL_INVALID   = 3;
    const ERROR_STATUS_NOTACTIV = 4;

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

        $user = User::model()->findByAttributes(array('email' => $this->username));

        if ($user === null) {
            $this->errorCode = self::ERROR_EMAIL_INVALID;
        } else {

            if ($user->hashPassword($this->password) !== $user->password) {
                $this->errorCode = self::ERROR_PASSWORD_INVALID;
            } else {
                $this->id        = $user->id;
                $this->email     = $user->email;
                $this->errorCode = self::ERROR_NONE;
            }
        }
        return !$this->errorCode;
    }

    public function getUser() {
        return User::findByPk($this->id);
    }

    /**
     * @return string the email add3ress of the user record
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @return integer the ID of the user record
     */
    public function getId() {
        return $this->id;
    }

    public function errorMessage() {
        switch ($this->errorCode) {
            case UserIdentity::ERROR_PASSWORD_INVALID:
            case UserIdentity::ERROR_USERNAME_INVALID:
            case UserIdentity::ERROR_EMAIL_INVALID:
                return "Incorrect email or password ($this->errorCode)";
                break;
            case UserIdentity::ERROR_STATUS_NOTACTIV:
                return "This account is no longer active.";
                break;
        }

        return "Something went wrong ($this->errorCode)";

    }
}