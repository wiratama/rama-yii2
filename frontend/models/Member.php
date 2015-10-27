<?php

namespace frontend\models;

use Yii;
use kartik\password\StrengthValidator;

/**
 * This is the model class for table "member".
 *
 * @property integer $id_member
 * @property integer $id_member_category
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
    public $reCaptcha;
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
            // [['id_member_category', 'city', 'country', 'status'], 'integer'],
            [['id_member_category', 'status'], 'integer'],
            [['name', 'phone', 'gender', 'dob', 'address', 'city', 'country', 'password', 'auth_key', 'email', 'status', 'created_at', 'updated_at'], 'required'],
            [['dob', 'created_at', 'updated_at'], 'safe'],
            [['address'], 'string'],
            [['name', 'password', 'password_reset_token'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 15],
            [['gender', 'email'], 'string', 'max' => 50],
            [['auth_key'], 'string', 'max' => 32],
            [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className(), 'secret' => '6Ld-mg8TAAAAAAQaHcZh-UPIbyHrbSSljOACOSqN'],
            [['email'],'unique'],
            // ['email', 'unique', 'targetClass' => '\common\models\Member', 'message' => 'This email address has already been taken.'],
            [['email'],'email'],
            ['password_repeat', 'required'],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match" ],
            [['password'], StrengthValidator::className(), 'preset'=>'normal', 'userAttribute'=>'username'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_member' => 'Id Member',
            'id_member_category' => 'Member type',
            'name' => 'Name',
            'phone' => 'Phone number',
            'gender' => 'Gender',
            'dob' => 'Date of birth',
            'address' => 'Address',
            'city' => 'City',
            'country' => 'Country',
            'password' => 'Password',
            'password_repeat' => 'Repeat password',
            'auth_key' => 'Auth Key',
            'email' => 'Email',
            'password_reset_token' => 'Password reset token',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMemberCategory()
    {
        return $this->hasOne(MemberCategory::className(), ['id_category' => 'id_member_category']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemberOrders()
    {
        return $this->hasMany(MemberOrder::className(), ['id_member' => 'id_member']);
    }
}
