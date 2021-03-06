<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel {
    public $username;
    public $password;
    public $rememberMe;

    private $identity;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            // username and password are required
            array('username, password', 'required'),
            // rememberMe needs to be a boolean
            array('rememberMe', 'boolean'),
            // password needs to be authenticated
            array('password', 'authenticate'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'username'   => 'Email',
            'rememberMe' => 'Remember me next time',
        );
    }

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute, $params) {

        if (!$this->hasErrors()) {
            $this->identity = new UserIdentity($this->username, $this->password);
            if (!$this->identity->authenticate()) {
                Yii::app()->user->setFlash('error', "<h4>Error Logging In</h4><p>The email address and password combination you provided do not match any of our records, please check your details and try again.</p>");
            }
        } else {
            Yii::app()->user->setFlash('error', "<h4>Error Logging In</h4><p>Check that you have entered a valid email address and password.</p>");
        }
    }

    /**
     * Logs in the user using the given username and password in the model.
     *
     * @return boolean whether login is successful
     */
    public function login() {
        if ($this->identity === null) {
            $this->identity = new UserIdentity($this->username, $this->password);
            $this->identity->authenticate();
        }
        if ($this->identity->errorCode === UserIdentity::ERROR_NONE) {
            $duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days
            Yii::app()->user->login($this->identity, $duration);
            return true;
        } else {
            return false;
        }
    }
}
