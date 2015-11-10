<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "member_order".
 *
 * @property integer $id_order
 * @property integer $id_member
 * @property string $coupon_code
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Member $idMember
 * @property MemberOrderProduct[] $memberOrderProducts
 */
class MemberOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'member_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_member'], 'integer'],
            [['created_at', 'updated_at','doc'], 'required'],
            [['created_at', 'updated_at','comment'], 'safe'],
            [['coupon_code'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_order' => 'Id Order',
            'id_member' => 'Member',
            'coupon_code' => 'Coupon Code',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'doc' => 'Date of claim',
            'comment' => 'Comment',
        ];
    }

    public function getIdMember()
    {
        return $this->hasOne(Member::className(), ['id_member' => 'id_member']);
    }

    public function getMemberOrderProducts()
    {
        return $this->hasMany(MemberOrderProduct::className(), ['id_order' => 'id_order']);
    }

    public function getOrderProducts()
    {
        return $this->hasOne(MemberOrderProduct::className(), ['id_order' => 'id_order']);
    }
}
