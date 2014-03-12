<?php

/**
 * This is the model class for table "url_hit".
 *
 * The followings are the available columns in table 'url_hit':
 *
 * @property string $id
 * @property string $url_id
 * @property string $date
 * @property string $referral_url
 *
 * The followings are the available model relations:
 * @property Url    $url
 */
class UrlHit extends CActiveRecord {
    /**
     * Returns the static model of the specified AR class.
     *
     * @param string $className active record class name.
     *
     * @return UrlHit the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'url_hit';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('url_id, date, referral_url', 'required'),
            array('url_id', 'length', 'max' => 20),
            array('referral_url', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, url_id, date, referral_url', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'url' => array(self::BELONGS_TO, 'Url', 'url_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id'           => 'ID',
            'url_id'       => 'Url',
            'date'         => 'Date',
            'referral_url' => 'Referral Url',
        );
    }

    public function beforeValidate() {

        if ($this->isNewRecord) {
            $this->date = new CDbExpression('NOW()');
        }

        return parent::beforeValidate();
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
        $criteria->compare('url_id', $this->url_id, true);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('referral_url', $this->referral_url, true);

        return new CActiveDataProvider($this,
            array(
                 'criteria' => $criteria,
            )
        );
    }
}