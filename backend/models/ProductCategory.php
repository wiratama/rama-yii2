<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product_category".
 *
 * @property integer $id_product_category
 * @property integer $id_product
 * @property integer $id_category
 *
 * @property Product $idProduct
 * @property Category $idCategory
 */
class ProductCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_product', 'id_category'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_product_category' => 'Id Product Category',
            'id_product' => 'Product',
            'id_category' => 'Category',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProduct()
    {
        return $this->hasOne(Product::className(), ['id_product' => 'id_product']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCategory()
    {
        return $this->hasOne(Category::className(), ['id_category' => 'id_category']);
    }
}
