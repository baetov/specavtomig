<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Role;

/**
 * RoleSearch represents the model behind the search form about `app\models\Role`.
 */
class RoleSearch extends Role
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id',  'order_create', 'order_update', 'order_delete', 'order_view', 'order_view_all', 'directory_access', 'user_create', 'user_update', 'user_delete', 'user_view', 'user_view_all', 'report_access'], 'integer'],
            [['name'], 'safe'],
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
        $query = Role::find();

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
       
            'order_create' => $this->order_create,
            'order_update' => $this->order_update,
            'order_delete' => $this->order_delete,
            'order_view' => $this->order_view,
            'order_view_all' => $this->order_view_all,
  
            'directory_access' => $this->directory_access,
            'user_create' => $this->user_create,
            'user_update' => $this->user_update,
            'user_delete' => $this->user_delete,
            'user_view' => $this->user_view,
            'user_view_all' => $this->user_view_all,
            
            'report_access' => $this->report_access,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
