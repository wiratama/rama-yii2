<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "member_category".
 *
 * @property integer $id_member_category
 * @property integer $id_category
 * @property integer $id_member
 *
 * @property Member $idMember
 * @property Category $idCategory
 */
class MemberCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'member_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_category', 'id_member'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_member_category' => 'Id Member Category',
            'id_category' => 'Category',
            'id_member' => 'Member',
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
    public function getIdCategory()
    {
        return $this->hasOne(Category::className(), ['id_category' => 'id_category']);
    }
}
