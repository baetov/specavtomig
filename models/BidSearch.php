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
            [['id', 'client_id', 'technic_type_id', 'technic_type_subgroup_id', 'technic_id', 'work_kind_id', 'work_type_id', 'status', 'pay_status', 'price', 'hours', 'mkad', 'mkad_price', 'total', 'fuel', 'mileage'], 'integer'],
            [['date', 'route', 'pay_form', 'garage_out', 'garage_in', 'customer_in', 'customer_out'], 'safe'],
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
            'technic_type_id' => $this->technic_type_id,
            'technic_type_subgroup_id' => $this->technic_type_subgroup_id,
            'technic_id' => $this->technic_id,
            'work_kind_id' => $this->work_kind_id,
            'work_type_id' => $this->work_type_id,
            'status' => $this->status,
            'pay_status' => $this->pay_status,
            'price' => $this->price,
            'hours' => $this->hours,
            'mkad' => $this->mkad,
            'mkad_price' => $this->mkad_price,
            'total' => $this->total,
            'fuel' => $this->fuel,
            'mileage' => $this->mileage,
            'garage_out' => $this->garage_out,
            'garage_in' => $this->garage_in,
            'customer_in' => $this->customer_in,
            'customer_out' => $this->customer_out,
        ]);

        $query->andFilterWhere(['like', 'route', $this->route])
            ->andFilterWhere(['like', 'pay_form', $this->pay_form]);
        if($this->date != null){
            $dateStart = $this->date .' '. '00'. ':'.'00'.':'.'00';
            $dateEnd = $this->date .' '. '23'. ':'.'59'.':'.'59';
            
            $query->andFilterWhere(['between', 'date', $dateStart, $dateEnd]);
        }

        return $dataProvider;
    }
}
