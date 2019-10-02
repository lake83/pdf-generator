<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\caching\TagDependency;
use yii\behaviors\TimestampBehavior;
use kartik\mpdf\Pdf;

/**
 * This is the model class for table "templates".
 *
 * @property int $id
 * @property string $name
 * @property string $content
 * @property string $css
 * @property int $format
 * @property string $orientation
 * @property integer $is_email
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
            [['name', 'content', 'format', 'orientation'], 'required'],
            ['content', 'string'],
            [['format', 'is_email', 'created_at', 'updated_at'], 'integer'],
            ['is_email', 'default', 'value' => 0],
            ['orientation', 'string', 'max' => 1],
            [['name', 'css'], 'string', 'max' => 255]
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
            'css' => 'Файл CSS',
            'format' => 'Формат',
            'orientation' => 'Ориентация',
            'is_email' => 'Отправка по E-mail',
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
    
    /**
     * Возвращает список форматов листа
     * 
     * @param integer $key ключ в массиве названий
     * @return mixed
     */
    public static function getFormats($key = null)
    {
        $array = [
            1 => Pdf::FORMAT_A4,
            2 => Pdf::FORMAT_A3,
            3 => Pdf::FORMAT_LETTER,
            4 => Pdf::FORMAT_LEGAL,
            5 => Pdf::FORMAT_FOLIO,
            6 => Pdf::FORMAT_LEDGER,
            7 => Pdf::FORMAT_TABLOID
        ];
        return is_null($key) ? $array : $array[$key];
    }
    
    /**
     * Возвращает список ориентаций листа
     * 
     * @param integer $key ключ в массиве названий
     * @return mixed
     */
    public static function getOrientations($key = null)
    {
        $array = [
            Pdf::ORIENT_PORTRAIT => 'PORTRAIT',
            Pdf::ORIENT_LANDSCAPE => 'LANDSCAPE'
        ];
        return is_null($key) ? $array : $array[$key];
    }
}