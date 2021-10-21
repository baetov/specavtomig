<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ReserveBid;

/**
 * ReserveBidSearch represents the model behind the search form about `app\models\ReserveBid`.
 */
class ReserveBidSearch extends ReserveBid
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'client_id', 'technic_type_id', 'technic_type_subgroup_id', 'technic_id', 'work_kind_id', 'driver_id'], 'integer'],
            [['date', 'time', 'route', 'pay_form', 'price', 'hours', 'mkad', 'mkad_price', 'total', 'comment'], 'safe'],
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
        $query = ReserveBid::find();

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
            'id' => $this->id,
            'client_id' => $this->client_id,
            'technic_type_id' => $this->technic_type_id,
            'technic_type_subgroup_id' => $this->technic_type_subgroup_id,
            'technic_id' => $this->technic_id,
            'work_kind_id' => $this->work_kind_id,
            'date' => $this->date,
            'driver_id' => $this->driver_id,
        ]);

        $query->andFilterWhere(['like', 'time', $this->time])
            ->andFilterWhere(['like', 'route', $this->route])
            ->andFilterWhere(['like', 'pay_form', $this->pay_form])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'hours', $this->hours])
            ->andFilterWhere(['like', 'mkad', $this->mkad])
            ->andFilterWhere(['like', 'mkad_price', $this->mkad_price])
            ->andFilterWhere(['like', 'total', $this->total])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
