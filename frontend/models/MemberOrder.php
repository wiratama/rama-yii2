<?php

namespace frontend\models;

use Yii;

class MemberOrder extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'member_order';
    }

    public function rules()
    {
        return [
            [['id_member'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_order' => 'Id Order',
            'id_member' => 'Id Member',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            if ($this->isNewRecord) {
                $this->created_at = date("Y-m-d");
                $this->updated_at = date("Y-m-d");
            } else {
                $this->updated_at = date("Y-m-d");
            }
            return true;
        }
        return false;
    }
}
