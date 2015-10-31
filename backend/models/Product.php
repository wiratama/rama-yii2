<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * This is the model class for table "product".
 *
 * @property integer $id_product
 * @property string $name
 * @property string $description
 * @property integer $price
 * @property string $image
 * @property integer $status
 *
 * @property MemberOrderProduct[] $memberOrderProducts
 */
class Product extends \yii\db\ActiveRecord
{
    public $file_image;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','image', 'status'], 'required'],
            [['description'], 'string'],
            [['price', 'status','point'], 'integer'],
            [['name','image'], 'string', 'max' => 255],
            // [['file_image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            // [['file_image'], 'image', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            ['file_image', 'file', 'extensions' => ['png', 'jpg', 'gif']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_product' => 'Id Product',
            'name' => 'Name',
            'description' => 'Description',
            'price' => 'Price',
            'point' => 'Point',
            'image' => 'Image Path',
            'file_image' => 'Image File',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemberOrderProducts()
    {
        return $this->hasMany(MemberOrderProduct::className(), ['id_product' => 'id_product']);
    }

    public function upload($full_image_directory,$image_name)
    {
        if ($this->validate()) {
            if (!is_dir($full_image_directory)) {
                if (!mkdir($full_image_directory, 0777, true)) {
                    $this->refresh();
                }
            }
            $this->file_image->saveAs($full_image_directory . $image_name . '.' . $this->file_image->extension);
            return true;
        } else {
            return false;
        }
    }
}
