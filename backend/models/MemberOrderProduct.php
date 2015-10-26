<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "member_order_product".
 *
 * @property integer $id_order_product
 * @property integer $id_order
 * @property integer $id_product
 * @property integer $quantity
 * @property integer $price
 * @property integer $total
 *
 * @property Product $idProduct
 * @property MemberOrder $idOrder
 */
class MemberOrderProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'member_order_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_order', 'id_product', 'quantity', 'price', 'total'], 'integer'],
            [['quantity', 'price', 'total'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_order_product' => 'Id Order Product',
            'id_order' => 'Id Order',
            'id_product' => 'Id Product',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'total' => 'Total',
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
    public function getIdOrder()
    {
        return $this->hasOne(MemberOrder::className(), ['id_order' => 'id_order']);
    }
}
