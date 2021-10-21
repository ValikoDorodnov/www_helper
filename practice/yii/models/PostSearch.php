<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Post;

class PostSearch extends Post
{
    public function rules(): array
    {
        return [
            [['id'], 'integer'],
            [['name', 'text'], 'safe'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = Post::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['ilike', 'name', $this->name])
            ->andFilterWhere(['ilike', 'text', $this->text]);

        return $dataProvider;
    }
}
