<?php
namespace frontend\models;

use Yii;
use yii\base\Model;

class ClaimPromo extends Model
{
    public $doc;
    public $id;
    public $comment;


    public function rules()
    {
        return [
            [['doc'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'doc' => 'Booking Date',
            'id' => 'Product',
            'comment' => 'Comment',
        ];
    }
}
