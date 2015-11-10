<?php

namespace frontend\models;

use Yii;

class Category extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'category';
    }

    public function rules()
    {
        return [
            [['category'], 'required'],
            [['category'], 'string', 'max' => 255]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_category' => 'Id Category',
            'category' => 'Category',
        ];
    }

    public function getMembers()
    {
        return $this->hasMany(Member::className(), ['id_member_category' => 'id_category']);
    }
}
