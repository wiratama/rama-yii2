<?php

namespace backend\models;

use Yii;
use backend\models\Member;

/**
 * This is the model class for table "member_point".
 *
 * @property integer $id_member_point
 * @property integer $id_member
 * @property string $created_at
 * @property string $updated_at
 * @property integer $point
 * @property integer $status
 *
 * @property Member $idMember
 */
class MemberPoint extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'member_point';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_member', 'created_at', 'updated_at', 'point', 'status'], 'required'],
            [['id_member', 'point', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_member_point' => 'Id Member Point',
            'id_member' => 'Member',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'point' => 'Point',
            'status' => 'Status',
        ];
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMember()
    {
        return $this->hasOne(Member::className(), ['id_member' => 'id_member']);
    }
}
