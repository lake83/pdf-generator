<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\caching\TagDependency;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "templates".
 *
 * @property int $id
 * @property string $name
 * @property string $content
 * @property int $created_at
 * @property int $updated_at
 */
class Templates extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'templates';
    }
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className()
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'content'], 'required'],
            ['content', 'string'],
            [['created_at', 'updated_at'], 'integer'],
            ['name', 'string', 'max' => 255]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'content' => 'Шаблон',
            'created_at' => 'Создано',
            'updated_at' => 'Изменено'
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        TagDependency::invalidate(Yii::$app->cache, 'templates');
        
        return parent::afterSave($insert, $changedAttributes);
    }
    
    /**
     * @inheritdoc
     */
    public function afterDelete()
    {
        TagDependency::invalidate(Yii::$app->cache, 'templates');
        
        parent::afterDelete();
    }
    
    /**
     * Возвращает список шаблонов
     * 
     * @return array
     */
    public static function getAll()
    {
        return Yii::$app->cache->getOrSet('templates', function () {
            return ArrayHelper::map(self::find()->select('id,name')->all(), 'id', 'name');
        }, 0, new TagDependency(['tags' => 'templates']));
    }
}