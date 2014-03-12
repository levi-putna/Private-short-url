<?php

/**
 * This is the model class for table "url".
 *
 * The followings are the available columns in table 'url':
 *
 * @property string   $id
 * @property string   $url
 * @property string   $key
 * @property string   $alias
 * @property string   $admin_id
 * @property string   $description
 * @property string   $date_created
 * @property integer  $active
 *
 * The followings are the available model relations:
 * @property UrlHit[] $urlHits
 */
class URL extends CActiveRecord {
    /**
     * Returns the static model of the specified AR class.
     *
     * @param string $className active record class name.
     *
     * @return Url the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'url';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('url, admin_id, date_created', 'required'),
            array('active', 'numerical', 'integerOnly' => true),
            array('url', 'length', 'max' => 255),
            array('key, alias', 'length', 'max' => 45),
            array('admin_id', 'length', 'max' => 20),
            array('alias', 'unique', 'allowEmpty' => true, 'message' => 'This alias is already in use by another URL.'),
            array('alias', 'CRegularExpressionValidator', 'pattern' => '/^([a-z0-9]+-)*[a-z0-9]+$/i', 'message' => 'An alias can only contain alphanumeric characters and hyphens (where a hyphen is not repeated twice-in-a-row and does not begins/ends the string)'),

            array('key', 'unique'),
            array('url', 'activeUrl'),

            array('description', 'safe'),
            array('id, url, key, alias, admin_id, date_created, active', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'urlHits' => array(self::HAS_MANY, 'UrlHit', 'url_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id'           => 'ID',
            'url'          => 'Url',
            'key'          => 'Key',
            'alias'        => 'Alias',
            'admin_id'     => 'Admin',
            'description'  => 'Description',
            'date_created' => 'Date Created',
            'active'       => 'Active',
        );
    }

    public function checkURL() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == '404') {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('url', $this->url, true);
        $criteria->compare('key', $this->key, true);
        $criteria->compare('alias', $this->alias, true);
        $criteria->compare('date_created', $this->date_created, true);
        $criteria->compare('active', $this->active);

        $criteria->order = "id DESC";

        return new CActiveDataProvider($this,
            array(
                 'criteria' => $criteria,
            )
        );
    }

    public function beforeValidate() {

        //TODO check if the URL gets an error message Yii::app()->user->setFlash('error', 'This company can not be deleted because there are existing jobs.');

        if ($this->isNewRecord) {
            $this->date_created = new CDbExpression('NOW()');

            $next_id   = Yii::app()->db->createCommand("SELECT AUTO_INCREMENT FROM information_schema.tables WHERE table_name = '" . $this->tableName() . "' AND table_schema = DATABASE() ;")->queryScalar();
            $this->key = ObfuscationHelper::encode($next_id);
        }

        if($this->alias != null){
            $this->alias = strtolower($this->alias);
        }

        return parent::beforeValidate();
    }

    /**
     * Check to see if a real url
     *
     * @param $attribute
     * @param $params
     */
    public function activeUrl($attribute, $params) {

        //test the url format
        if (filter_var($this->$attribute, FILTER_VALIDATE_URL) === false) {
            $this->addError($this->$attribute, 'Not a valid URL. Please check the format');
            return false;
        }

        $handle = curl_init($this->$attribute);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

        /* Get the HTML or whatever is linked in $url. */
        $response = curl_exec($handle);

        /* Check for 404 (file not found). */
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        if ($httpCode != 200) {
            $this->addError($this->$attribute, 'The required URL is not responding.');
            return false;
        }

        curl_close($handle);
        return true;
    }

    //UTILITY FUNCTIONS

    /**
     * Return an array of hits per day. defaults to only show the last 30 days
     *
     * @param int $limit
     * @param int $offset
     *
     * @return array
     */
    public function getHitsPerDay($limit = 30, $offset = 0) {

        $query = Yii::app()->db->createCommand()
            ->select('count(id) AS the_count, date(date) AS the_date')
            ->group('YEAR(date(date)), MONTH(date(date)), DAY(date(date))')
            ->where('url_id = ' . $this->id)
            ->order('date desc')
            ->from('url_hit');

        if ($limit != null && $limit > 0) {
            $query->limit($limit, $offset);
        }

        $data = array();

        foreach ($query->queryAll() as $value) {
            $date = new DateTime($value['the_date']);

            $data[] = array(
                'label' => $date->format(Yii::app()->params->dateFormatSmall),
                'value' => $value['the_count']
            );
        }

        return $data;
    }

    public function getReferrer($limit = null, $offset = 0) {

        $query = Yii::app()->db->createCommand()
            ->select('count(id) AS value, referral_url AS label')
            ->group('referral_url')
            ->where('url_id = ' . $this->id)
            ->order('value ASC')
            ->from('url_hit');

        if ($limit != null && $limit > 0) {
            $query->limit($limit, $offset);
        }

        return $query->queryAll();
    }

    public function hit() {
        $hit         = new UrlHit();
        $hit->url_id = $this->id;

        if (isset($_SERVER['HTTP_REFERER'])) {
            $hit->referral_url = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
        } else {
            $hit->referral_url = 'No Referral';
        }

        return $hit->save();

    }

    // STATIC FUNCTIONS

    public static function getAllHitsPerDay($limit = 30, $offset = 0) {

        $query = Yii::app()->db->createCommand()
            ->select('count(id) AS the_count, date(date) AS the_date')
            ->group('YEAR(date(date)), MONTH(date(date)), DAY(date(date))')
            ->order('date desc')
            ->from('url_hit');

        if ($limit != null && $limit > 0) {
            $query->limit($limit, $offset);
        }

        $data = array();

        foreach ($query->queryAll() as $value) {
            $date = new DateTime($value['the_date']);

            $data[] = array(
                'label' => $date->format(Yii::app()->params->dateFormatSmall),
                'value' => $value['the_count']
            );
        }

        return $data;
    }

    static public function getAllReferrer($limit = null, $offset = 0) {

        $query = Yii::app()->db->createCommand()
            ->select('count(id) AS value, referral_url AS label')
            ->group('referral_url')
            ->order('value ASC')
            ->from('url_hit');

        if ($limit != null && $limit > 0) {
            $query->limit($limit, $offset);
        }

        return $query->queryAll();
    }
}