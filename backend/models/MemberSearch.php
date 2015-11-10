<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Member;

/**
 * MemberSearch represents the model behind the search form about `backend\models\Member`.
 */
class MemberSearch extends Member
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_member', 'status'], 'integer'],
            [['name', 'phone', 'gender', 'dob', 'address', 'password', 'auth_key', 'email', 'password_reset_token', 'created_at', 'updated_at', 'city', 'country'], 'safe'],
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
        $query = Member::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('countries');
        $query->joinWith('cities');

        $query->andFilterWhere([
            'id_member' => $this->id_member,
            // 'dob' => $this->dob,
            // 'city' => $this->city,
            // 'country' => $this->country,
            'member.status' => $this->status,
            // 'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at,
        ]);

        // $query->andFilterWhere(['like', 'name', $this->name])
        $query->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'gender', $this->gender])
            // ->andFilterWhere(['like', 'address', $this->address])
            // ->andFilterWhere(['like', 'password', $this->password])
            // ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'email', $this->email])
            // ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'country.name', $this->country])
            ->andFilterWhere(['like', 'city.name', $this->city]);

        return $dataProvider;
    }
}
