<?php

namespace app\modules\sPages\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\sPages\models\Article;

/**
 * ArticleSearch represents the model behind the search form of `app\modules\sPages\modules\adminPanel\models\Article`.
 */
class ArticleSearch extends Article
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'number_of_tags', 'rating'], 'integer'],
            [['title', 'slug', 'author', 'date_create', 'date_update', 'status', 'content', 'short_content'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Article::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'number_of_tags' => $this->number_of_tags,
            'date_create' => $this->date_create,
            'date_update' => $this->date_update,
            'rating' => $this->rating,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'short_content', $this->short_content]);

        return $dataProvider;
    }
}
