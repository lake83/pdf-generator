<?php

namespace app\models;

use yii\helpers\Json;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "files".
 *
 * @property int $id
 * @property int $template_id
 * @property int $user_id
 * @property string $name
 * @property string $receiver_email
 * @property string $receiver_name
 * @property string $filds_value
 * @property int $created_at
 */
class Files extends \yii\db\ActiveRecord
{
    public $values = false;
    public $rows = [];
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'files';
    }
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp'  => [
                'class' => TimestampBehavior::className(),
                'updatedAtAttribute' => false
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['template_id', 'name'], 'required'],
            //['rows', 'required', 'on' => 'second'],
            [['template_id', 'user_id', 'created_at'], 'integer'],
            ['receiver_email', 'string', 'max' => 100],
            [['name', 'receiver_name'], 'string', 'max' => 255],
            [['filds_value', 'rows', 'values'], 'safe'],
            ['receiver_name', 'match', 'pattern' => '/^(([a-z\(\)\s]+)|([а-яё\(\)\s]+))$/isu'],
            ['receiver_email', 'email'],
            [['receiver_email', 'receiver_name'], 'required', 'when' => function($model) {
                    return $model->template->is_email;
                }, 'whenClient' => "function (attribute, value) {
                    return $('.receiver').is(':visible');
                }"
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'template_id' => 'Используемый шаблон',
            'user_id' => 'Исполнитель',
            'name' => 'Название компании',
            'receiver_email' => 'E-mail получателя',
            'receiver_name' => 'Имя получателя',
            'filds_value' => 'Значения',
            'rows' => 'Поле шаблона',
            'created_at' => 'Создано'
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if ($insert) {
            $this->user_id = \Yii::$app->user->id;
        }
        $this->filds_value = Json::encode($this->rows);
        
        return parent::beforeSave($insert);
    }
    
    /**
     * @inheritdoc
     */
    public function afterFind()
    {
        $this->filds_value = Json::decode($this->filds_value);
        
        parent::afterFind();
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTemplate()
    {
        return $this->hasOne(Templates::className(), ['id' => 'template_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilds()
    {
        return $this->hasMany(TemplatesFields::className(), ['template_id' => 'template_id']);
    }
}