<?php

namespace app\models;

use DateInterval;
use DateTime;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Bid;

/**
 * BidSearch represents the model behind the search form about `app\models\Bid`.
 */
class BidSearch extends Bid
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','driver_id', 'client_id', 'author_id','technic_type_id', 'technic_type_subgroup_id', 'technic_id', 'work_kind_id', 'work_type_id', 'status', 'pay_status', 'price', 'mileage'], 'integer'],
            [['date', 'route', 'pay_form', 'garage_out', 'garage_in', 'customer_in', 'customer_out','hours', 'mkad', 'mkad_price', 'total', 'fuel'], 'safe'],
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
        $query = Bid::find();

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
            'driver_id' => $this->driver_id,
            'author_id' => $this->author_id,
            'technic_type_id' => $this->technic_type_id,
            'technic_type_subgroup_id' => $this->technic_type_subgroup_id,
            'technic_id' => $this->technic_id,
            'work_kind_id' => $this->work_kind_id,
            'work_type_id' => $this->work_type_id,
            'status' => $this->status,
            'pay_status' => $this->pay_status,
            'mileage' => $this->mileage,
            'garage_in' => $this->garage_in,
            'customer_in' => $this->customer_in,
            'customer_out' => $this->customer_out,
        ]);

        $query->andFilterWhere(['like', 'route', $this->route])
              ->andFilterWhere(['like', 'price', $this->price])
              ->andFilterWhere(['like', 'hours', $this->hours])
              ->andFilterWhere(['like', 'mkad', $this->mkad])
              ->andFilterWhere(['like', 'mkad_price', $this->mkad_price])
              ->andFilterWhere(['like', 'total', $this->total])
              ->andFilterWhere(['like', 'fuel', $this->fuel])
              ->andFilterWhere(['like', 'pay_form', $this->pay_form]);
        if($this->date != null){
            $dates = explode(' - ', $this->date);
            $dateStart = new DateTime($dates[0]);
            $dateEnd = new DateTime($dates[1]);
            $dateStart = date_format($dateStart,'Y-m-d');
            $dateEnd = date_format($dateEnd,'Y-m-d');
//            if ($dateStart == $dateEnd){
//                $query->andFilterWhere(['date' => $dateStart]);
//            }
            $query->andFilterWhere(['between', 'date', $dateStart, $dateEnd]);
        }

        return $dataProvider;
    }
}
