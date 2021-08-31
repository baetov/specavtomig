<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;
use yii\helpers\ArrayHelper;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'is_deletable'], 'integer'],
            [['login', 'name', 'password_hash', 'type', 'cities', 'role_id'], 'safe'],
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
        $query = User::find();

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

        $sort = $dataProvider->getSort();


        $query->andFilterWhere([
            'id' => $this->id,
            'is_deletable' => $this->is_deletable,
            'role_id' => $this->role_id,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'login', $this->login])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash]);

        $query->groupBy('user.id');

        $dataProvider->pagination->pageSize = 10;

        return $dataProvider;
    }
}
