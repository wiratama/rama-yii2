<?php

namespace frontend\models;

use Yii;

class Product extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'product';
    }

    public function rules()
    {
        return [
            [['name', 'point', 'image', 'status'], 'required'],
            [['description'], 'string'],
            [['price', 'point', 'status'], 'integer'],
            [['name', 'image'], 'string', 'max' => 255]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_product' => 'Id Product',
            'name' => 'Name',
            'description' => 'Description',
            'price' => 'Price',
            'point' => 'Point',
            'image' => 'Image',
            'status' => 'Status',
        ];
    }

    public function getMemberOrderProducts()
    {
        return $this->hasMany(MemberOrderProduct::className(), ['id_product' => 'id_product']);
    }
}
