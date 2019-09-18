<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TemplatesFields;

/**
 * TemplatesFieldsSearch represents the model behind the search form of `app\models\TemplatesFields`.
 */
class TemplatesFieldsSearch extends TemplatesFields
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'template_id'], 'integer'],
            [['name', 'symbol', 'start_value'], 'safe']
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
        $query = TemplatesFields::find()->where(['template_id' => $params['template_id']]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'template_id' => $this->template_id
        ]);
        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'symbol', $this->symbol])
            ->andFilterWhere(['like', 'start_value', $this->start_value]);

        return $dataProvider;
    }
}