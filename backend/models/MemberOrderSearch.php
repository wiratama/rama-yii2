<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MemberOrder;

/**
 * MemberOrderSearch represents the model behind the search form about `backend\models\MemberOrder`.
 */
class MemberOrderSearch extends MemberOrder
{
    public $product;

    public function rules()
    {
        return [
            [['id_order'], 'integer'],
            [['coupon_code', 'created_at', 'updated_at','id_member','product'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = MemberOrder::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('idMember');
        $query->joinWith('orderProducts.idProduct');

        $query->andFilterWhere([
            'id_order' => $this->id_order,
            // 'id_member' => $this->id_member,
            // 'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'coupon_code', $this->coupon_code])
            ->andFilterWhere(['like', 'member.name', $this->id_member])
            ->andFilterWhere(['like', 'product.name', $this->product]);

        return $dataProvider;
    }
}
