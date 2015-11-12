<?php

namespace backend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\base\Event;
use backend\models\Country;
use backend\models\City;
use kartik\password\StrengthValidator;

/**
 * This is the model class for table "member".
 *
 * @property integer $id_member
 * @property string $name
 * @property string $phone
 * @property string $gender
 * @property string $dob
 * @property string $address
 * @property integer $city
 * @property integer $country
 * @property string $password
 * @property string $auth_key
 * @property string $email
 * @property string $password_reset_token
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property MemberCategory $idMemberCategory
 * @property MemberOrder[] $memberOrders
 */
class Member extends \yii\db\ActiveRecord
{
    public $password_repeat;
    public $file_image;
    const STATUS_DELETED = 0;
    const STATUS_PENDING = 1;
    const STATUS_ACTIVE = 2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'member';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city', 'country', 'status','id_category'], 'integer'],
            [['name', 'phone', 'gender', 'dob', 'address', 'city', 'country', 'auth_key', 'email', 'status', 'created_at', 'updated_at','id_category'], 'required'],
            [['dob', 'created_at', 'updated_at'], 'safe'],
            [['address'], 'string'],
            [['name', 'password', 'password_reset_token','avatar'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 15],
            [['gender', 'email'], 'string', 'max' => 50],
            [['auth_key'], 'string', 'max' => 32],
            ['email', 'unique', 'targetClass' => '\frontend\models\Member', 'message' => 'This email address has already been taken.'],
            [['email'],'email'],
            [['password_repeat', 'password'], 'required', 'on' => 'register'],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match" ],
            [['password'], StrengthValidator::className(), 'preset'=>'normal', 'userAttribute'=>'email'],
            ['status', 'default', 'value' => self::STATUS_PENDING],
            ['file_image', 'file', 'extensions' => ['png', 'jpg', 'gif']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_member' => 'Id Member',
            'id_category' => 'Category',
            'name' => 'Name',
            'phone' => 'Phone',
            'gender' => 'Gender',
            'dob' => 'Date of birth',
            'address' => 'Address',
            'city' => 'City',
            'country' => 'Country',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
            'email' => 'Email',
            'password_reset_token' => 'Password Reset Token',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getIdMemberCategory()
    {
        return $this->hasMany(MemberCategory::className(), ['id_member' => 'id_member']);
    }

    public function getMemberCat()
    {
        return $this->hasOne(Category::className(), ['id_category' => 'id_category']);
    }

    public function getMemberOrders()
    {
        return $this->hasMany(MemberOrder::className(), ['id_member' => 'id_member']);
    }

    public function getCountries()
    {
        return $this->hasOne(Country::className(), ['country_id' => 'country']);
    }

    public function getCities()
    {
        return $this->hasOne(City::className(), ['zone_id' => 'city']);
    }

    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            if ($this->isNewRecord) {
                $this->created_at = date("Y-m-d");
                $this->updated_at = date("Y-m-d");
                $this->auth_key = Yii::$app->security->generateRandomString();
            } else {
                $this->updated_at = date("Y-m-d");
            }
            return true;
        }
        return false;
    }

    public function beforeSave($insert) {
        if(isset($this->password) and !empty($this->password_repeat)) {
            // $this->password=Yii::$app->security->generatePasswordHash($this->password);
            $this->setPassword($this->password);
        }
        return parent::beforeSave($insert);
    }

    public function upload($full_image_directory,$image_name)
    {
        if ($this->validate()) {
            if (!is_dir($full_image_directory)) {
                if (!mkdir($full_image_directory, 0777, true)) {
                    $this->refresh();
                }
            }
            $this->file_image->saveAs($full_image_directory . $image_name . '.' . $this->file_image->extension);
            return true;
        } else {
            return false;
        }
    }
}
