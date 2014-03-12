<?php

/**
 * This is the model class for table "admin".
 *
 * The followings are the available columns in table 'admin':
 *
 * @property string $id
 * @property string $given_name
 * @property string $family_name
 * @property string $email
 * @property string $password
 * @property string $role_id
 * @property string $date_created
 * @property string $last_login
 */
class AdminAccounts extends CActiveRecord {

    const ACTIVE   = 1;
    const INACTIVE = 0;
    // holds the password confirmation word
    public $repeat_password;
    public $new_password;

    private $salt = "wo9EFZ9RpmgfnMN";

    /**
     * Returns the static model of the specified AR class.
     *
     * @param string $className active record class name.
     *
     * @return AdminAccounts the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'admin';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('given_name, family_name, email', 'required'),
            array('given_name, family_name', 'length', 'max' => 45),
            array('email', 'length', 'max' => 80),
            array('email', 'unique'),
            array('password, repeat_password, new_password', 'length', 'min' => 6, 'max' => 32),
            array('role_id', 'length', 'max' => 20),

            array('last_login', 'safe'),

//            array('new_password', 'compareAttribute' => 'repeat_password', 'on' => 'change_password'),
//            array('new_password, repeat_password', 'required', 'on' => 'change_password'),

            array('id, given_name, family_name, email, role, date_created, last_login', 'safe', 'on' => 'search')
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'role' => array(self::BELONGS_TO, 'Role', 'role_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id'           => 'ID',
            'given_name'   => 'Given Name',
            'family_name'  => 'Family Name',
            'email'        => 'Email',
            'password'     => 'Password',
            'role_id'      => 'Role',
            'date_created' => 'Date Created',
            'last_login'   => 'Last Login',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('given_name', $this->given_name, true);
        $criteria->compare('family_name', $this->family_name, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('role_id', $this->role_id, true);
        $criteria->compare('date_created', $this->date_created, true);
        $criteria->compare('last_login', $this->last_login, true);

        return new CActiveDataProvider($this,
            array(
                 'criteria' => $criteria,
                 //'pagination'=>array('pageSize'=>100)
            )
        );
    }

    public function beforeValidate() {
        if ($this->isNewRecord) {
            $this->date_created = new CDbExpression('NOW()');
        }

        return parent::beforeValidate();
    }

    public function beforeSave() {
        // in this case, we will use the old hashed password.
        if ($this->isNewRecord && !empty($this->password)) {
            $this->password = md5($this->salt . $this->password);
        }

        //update password
        if (!empty($this->new_password) && !empty($this->repeat_password)) {
            $this->password = md5($this->salt . $this->new_password);
        }

        return parent::beforeSave();
    }

    public function getDateFormat() {
        return DateFormat::model()->findByPk($this->date_format_id)->format;
    }

    public function getAvatar() {
        return '/admin/img/avatar.png';
    }

    public function updateLastLoginDate() {
        $this->last_login = new CDbExpression('NOW()');
        $this->save();
    }

    /**
     * Check that the password provided patched the database record for this Account.
     *
     * @param $password the account password
     *
     * @return bool
     */
    public function authenticate($password) {

        if (md5($this->salt . $password) == $this->password) {
            return true;
        }

        return false;
    }
}