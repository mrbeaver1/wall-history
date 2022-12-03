<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Post as PostModel;

/**
 * Post represents the model behind the search form of `common\models\Post`.
 */
class Post extends PostModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['author_name', 'text', 'author_ip'], 'safe'],
            [['created_at'], 'number'],
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
        $query = PostModel::find();

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
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'author_name', $this->author_name])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'author_ip', $this->author_ip]);

        return $dataProvider;
    }
}
