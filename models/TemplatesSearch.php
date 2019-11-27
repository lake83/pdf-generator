<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Templates;

/**
 * TemplatesSearch represents the model behind the search form of `app\models\Templates`.
 */
class TemplatesSearch extends Templates
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'format', 'is_email', 'created_at', 'updated_at'], 'integer'],
            [['name', 'orientation', 'content', 'css'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Templates::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'format' => $this->format,
            'is_email' => $this->is_email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'css', $this->css])
            ->andFilterWhere(['like', 'orientation', $this->orientation]);

        return $dataProvider;
    }
}