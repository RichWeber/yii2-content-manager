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
    /**
     * @var string Name of the content block
     */
    public $name;

    /**
     * @var string Content
     */
    public $content;

    /**
     * @var string Date range
     */
    public $createdRange;

    /**
     * @var string Date range
     */
    public $updatedRange;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['key', 'name', 'content', 'createdRange', 'updatedRange'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
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

        $dataProvider = new ActiveDataProvider(['query' => $query]);

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
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);

        if ($this->createdRange) {
            $dateArray = explode('-', $this->createdRange);
            $dateFrom = trim($dateArray[0]);
            $dateTo = trim($dateArray[1]);

            $query
                ->andWhere('created_at <= :dateTo', [':dateTo' => $dateTo])
                ->andWhere('created_at >= :dateFrom', [':dateFrom' => $dateFrom]);
        } else {
            $query->andFilterWhere(['created_at' => $this->created_at]);
        }

        if ($this->updatedRange) {
            $dateArray = explode('-', $this->updatedRange);
            $dateFrom = trim($dateArray[0]);
            $dateTo = trim($dateArray[1]);

            $query
                ->andWhere('updated_at <= :dateTo', [':dateTo' => $dateTo])
                ->andWhere('updated_at >= :dateFrom', [':dateFrom' => $dateFrom]);
        } else {
            $query->andFilterWhere(['updated_at' => $this->updated_at]);
        }

        $query->andFilterWhere(['like', 'key', $this->key]);

        $query->joinWith(['translations' => function ($query) {
            if ($this->name) {
                $query->andWhere(['like', 'name', $this->name]);
            }

            if ($this->content) {
                $query->andWhere(['like', 'content', $this->content]);
            }
        }]);

        return $dataProvider;
    }
}
