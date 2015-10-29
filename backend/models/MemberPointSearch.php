<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MemberPoint;

/**
 * MemberPointSearch represents the model behind the search form about `backend\models\MemberPoint`.
 */
class MemberPointSearch extends MemberPoint
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_member_point', 'point', 'status'], 'integer'],
            [['id_member', 'created_at', 'updated_at'], 'safe'],
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
        $query = MemberPoint::find();

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

        $query->andFilterWhere([
            'id_member_point' => $this->id_member_point,
            // 'id_member' => $this->id_member,
            // 'member_point.created_at' => $this->created_at,
            // 'member_point.updated_at' => $this->updated_at,
            'point' => $this->point,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'member.name', $this->id_member]);

        return $dataProvider;
    }
}
