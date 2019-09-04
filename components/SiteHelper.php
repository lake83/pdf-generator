<?php
namespace app\components;

use Yii;
use yii\helpers\Html;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use app\models\User as modelUser;
use yii\web\NotFoundHttpException;

class SiteHelper
{
    /**
     * Вывод фильтра и значения в колонке "Активно" GridView
     * @param object $searchModel
     * @return array
     */
    public static function is_active($searchModel)
    {
        return [
            'class' => 'pheme\grid\ToggleColumn',
            'attribute' => 'is_active',
            'filter' => Html::activeDropDownList(
                $searchModel,
                'is_active',
                [0 => 'Не активно', 1 => 'Активно'],
                ['class' => 'form-control', 'prompt' => '- выбрать -']
            ),
            'onText' => 'Вкл',
            'offText' => 'Выкл'
        ];
    }
    
    /**
     * Вывод фильтра и значения в колонке "Создан" GridView
     * @param object $searchModel
     * @return array
     */
    public static function created_at($searchModel)
    {
        return [
            'attribute' => 'created_at',
            'format' => ['date', 'php:j M, G:i'],
            'filter' => \yii\jui\DatePicker::widget([
                'model'=>$searchModel,
                'options' => ['class' => 'form-control'],               
                'attribute'=>'created_at',
                'language' => 'ru',
                'dateFormat' => 'dd.MM.yyyy',
            ])
        ];
    }
    
    /**
     * Ресайз изображения
     * @param string $image изображение
     * @param int $width ширина
     * @param mixed $height высота  
     * @return string Url изображения
     */
    public static function resized_image($image = '', $width, $height = null)
    {
        $url = false;
        if (!empty($image)) {
            $image = explode('/', $image);
            $last = end(array_keys($image));
            $file = end($image);
            unset($image[$last]);
            $dir_path = !empty($image) ? '/' . implode('/', $image) : '';
            $dir = Yii::getAlias('@webroot/images/uploads/') . $width . 'x' . $height . $dir_path;
            $img = $dir . '/' . $file;
            
            if (file_exists($img)) {
                $url = true;
            } else {
                FileHelper::createDirectory($dir);
                $original = Yii::getAlias('@webroot/images/uploads/source') . $dir_path . '/' . $file;
                try {
                    if (file_exists($original) && filesize($original) < 10000000) {
                        Image::thumbnail($original, $width, $height)->save($img, ['quality' => 100]);
                    }
                    $url = true;
                } catch (ErrorException $e) {
                    $url = false;
                }
            }
        }
        return $url ? '/images/uploads/' . $width . 'x' . $height . $dir_path . '/' . $file : '/images/anonymous.png';
    }
    
    /**
     * Переадресация пользователя в зависимости от его статуса.
     * 
     * @param integer $status статус пользователя
     * @return array
     */
    public static function redirectByRole($status)
    {
        switch($status) {
            case modelUser::ROLE_ADMIN: $redirect = ['admin/user/index']; break;
            default: $redirect = ['site/index']; break;
        }
        return $redirect;
    }
}
?>