<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Technic;

/**
 * TechnicSearch represents the model behind the search form about `app\models\Technic`.
 */
class TechnicSearch extends Technic
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type_id','reserved_by'], 'integer'],
            [['name', 'model', 'gos_num', 'characteristics', 'equipment','reserve'], 'safe'],
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
        $query = Technic::find();

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
            'type_id' => $this->type_id,
            'reserve' => $this->reserved,
            'reserved_by' => $this->reserved_by
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'gos_num', $this->gos_num])
            ->andFilterWhere(['like', 'characteristics', $this->characteristics])
            ->andFilterWhere(['like', 'equipment', $this->equipment]);

        return $dataProvider;
    }
}
