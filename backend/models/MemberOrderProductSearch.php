<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MemberOrderProduct;

/**
 * MemberOrderProductSearch represents the model behind the search form about `backend\models\MemberOrderProduct`.
 */
class MemberOrderProductSearch extends MemberOrderProduct
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_order_product', 'id_order', 'id_product', 'quantity'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = MemberOrderProduct::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_order_product' => $this->id_order_product,
            'id_order' => $this->id_order,
            'id_product' => $this->id_product,
            'quantity' => $this->quantity,
        ]);

        return $dataProvider;
    }
}
