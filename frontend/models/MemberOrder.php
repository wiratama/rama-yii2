<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "member_order".
 *
 * @property integer $id_order
 * @property integer $id_member
 * @property integer $total
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
            [['id_member', 'total'], 'integer'],
            [['total', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_order' => 'Id Order',
            'id_member' => 'Id Member',
            'total' => 'Total',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMember()
    {
        return $this->hasOne(Member::className(), ['id_member' => 'id_member']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemberOrderProducts()
    {
        return $this->hasMany(MemberOrderProduct::className(), ['id_order' => 'id_order']);
    }
}
