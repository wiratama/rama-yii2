<?php

namespace frontend\models;

use Yii;
use kartik\password\StrengthValidator;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\base\Event;

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
class Member extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $password_repeat;
    public $reCaptcha;
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
            // [['id_member_category', 'city', 'country', 'status'], 'integer'],
            [['id_member_category', 'status'], 'integer'],
            [['name', 'phone', 'gender', 'dob', 'address', 'city', 'country', 'password', 'auth_key', 'email', 'created_at', 'updated_at'], 'required'],
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
            [['password'], StrengthValidator::className(), 'preset'=>'normal', 'userAttribute'=>'email'],
            ['status', 'default', 'value' => self::STATUS_PENDING],
            // ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_PENDING, self::STATUS_DELETED]],
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

    // newadded
    public static function findIdentity($id)
    {
        return static::findOne(['id_member' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
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
        if(isset($this->password)) { 
            $this->password=Yii::$app->security->generatePasswordHash($this->password);
        }
        return parent::beforeSave($insert);
    }
    // newadded
}
