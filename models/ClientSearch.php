<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Client;

/**
 * ClientSearch represents the model behind the search form about `app\models\Client`.
 */
class ClientSearch extends Client
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type'], 'integer'],
            [['name', 'address', 'post_index', 'created_at', 'inn', 'ogrn', 'kpp', 'official_address', 'address_equals', 'director', 'email', 'phone', 'site', 'bank_bik', 'bank_name', 'bank_address', 'bank_correspondent_account', 'bank_register_number', 'bank_registration_date', 'bank_payment_account'], 'safe'],
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
        $query = Client::find();

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
            'type' => $this->type,
            'created_at' => $this->created_at,
            'bank_registration_date' => $this->bank_registration_date,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'post_index', $this->post_index])
            ->andFilterWhere(['like', 'inn', $this->inn])
            ->andFilterWhere(['like', 'ogrn', $this->ogrn])
            ->andFilterWhere(['like', 'kpp', $this->kpp])
            ->andFilterWhere(['like', 'official_address', $this->official_address])
            ->andFilterWhere(['like', 'address_equals', $this->address_equals])
            ->andFilterWhere(['like', 'director', $this->director])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'site', $this->site])
            ->andFilterWhere(['like', 'bank_bik', $this->bank_bik])
            ->andFilterWhere(['like', 'bank_name', $this->bank_name])
            ->andFilterWhere(['like', 'bank_address', $this->bank_address])
            ->andFilterWhere(['like', 'bank_correspondent_account', $this->bank_correspondent_account])
            ->andFilterWhere(['like', 'bank_register_number', $this->bank_register_number])
            ->andFilterWhere(['like', 'bank_payment_account', $this->bank_payment_account]);

        return $dataProvider;
    }
}
