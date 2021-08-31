<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Scan;

/**
 * ScanSearch represents the model behind the search form about `app\models\Scan`.
 */
class ScanSearch extends Scan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'author_id', 'user_id'], 'integer'],
            [['name', 'loaded_at', 'link'], 'safe'],
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
        $query = Scan::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'loaded_at' => $this->loaded_at,
            'author_id' => $this->author_id,
            'user_id' => $this->user_id,

        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'link', $this->link]);

        return $dataProvider;
    }
}
