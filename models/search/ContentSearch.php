<?php

namespace richweber\content\manager\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use richweber\content\manager\models\Content;

/**
 * ContentSearch represents the model behind the search form about `richweber\content\manager\models\Content`.
 */
class ContentSearch extends Content
{
    public $created_from;
    public $created_to;
    public $updated_from;
    public $updated_to;
    public $name;
    public $content;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['created_from', 'created_to', 'updated_from', 'updated_to'], 'date', 'format' => 'php:Y-m-d'],
            [['key', 'name', 'content'], 'safe'],
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
        $query = Content::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'status',
                'key',
                'created_at',
                'updated_at',
                'name' => [
                    'asc' => ['name' => SORT_ASC],
                    'desc' => ['name' => SORT_DESC],
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);

        $query
            ->andFilterWhere(['>=', 'created_at', $this->created_from ? strtotime($this->created_from . ' 00:00:00') : null])
            ->andFilterWhere(['<=', 'created_at', $this->created_to ? strtotime($this->created_to . ' 23:59:59') : null])
            ->andFilterWhere(['>=', 'updated_at', $this->updated_from ? strtotime($this->updated_from . ' 00:00:00') : null])
            ->andFilterWhere(['<=', 'updated_at', $this->updated_to ? strtotime($this->updated_to . ' 23:59:59') : null]);

        $query->andFilterWhere(['like', 'key', $this->key]);

        $query->joinWith(['translations' => function ($query) {
            if ($this->name) {
                $query->andWhere(['like', 'name', $this->name]);
            }
        }]);

        return $dataProvider;
    }
}
