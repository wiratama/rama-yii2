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
            [['start_date', 'end_date'], 'safe'],
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
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
        ];
    }

    public function getMemberOrderProducts()
    {
        return $this->hasMany(MemberOrderProduct::className(), ['id_product' => 'id_product']);
    }

    public function getProductCategories()
    {
        return $this->hasMany(ProductCategory::className(), ['id_product' => 'id_product']);
    }
}
