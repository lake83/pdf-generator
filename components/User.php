<?php
namespace app\components;

use Yii;

/**
 * This allows us to do "Yii::$app->user->something" by adding getters
 * like "public function getSomething()"
 *
 * So we can use variables and functions directly in `Yii::$app->user`
 */
class User extends \yii\web\User
{
    /**
     * Статус пользователя
     */
    public function getStatus()
    {
        return Yii::$app->user->identity->status;
    }
    
    /**
     * E-mail пользователя
     */
    public function getEmail()
    {
        return Yii::$app->user->identity->email;
    }
    
    /**
     * Имя пользователя
     */
    public function getName()
    {
        return Yii::$app->user->identity->username;
    }
}
