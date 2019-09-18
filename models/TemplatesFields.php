<?php

namespace app\models;

/**
 * This is the model class for table "templates_fields".
 *
 * @property int $id
 * @property int $template_id
 * @property string $name
 * @property string $symbol
 * @property string $start_value
 *
 * @property Templates $template
 */
class TemplatesFields extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'templates_fields';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['template_id', 'name', 'symbol'], 'required'],
            ['template_id', 'integer'],
            [['name', 'symbol'], 'unique'],
            [['name', 'symbol', 'start_value'], 'string', 'max' => 255],
            [['template_id'], 'exist', 'skipOnError' => true, 'targetClass' => Templates::className(), 'targetAttribute' => ['template_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'template_id' => 'Шаблон',
            'name' => 'Название',
            'symbol' => 'Обозначение',
            'start_value' => 'Начальное значение'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTemplate()
    {
        return $this->hasOne(Templates::className(), ['id' => 'template_id']);
    }
}