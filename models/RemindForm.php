<?php
namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Password reset request form
 */
class RemindForm extends Model
{
    public $email;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'required'],
            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'exist', 
                'targetClass' => User::className(),
                'filter' => ['is_active' => 1],
                'message' => 'Пользователь с таким E-mail не существует.'
            ]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => 'E-mail'
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     * 
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        if ($user = User::findOne(['is_active' => 1, 'email' => $this->email])) {
            if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
                $user->generatePasswordResetToken();
            }
            if ($user->save()) {
                return Yii::$app->mailer->compose(['html' => 'remindPass-html'], ['user' => $user])
                    ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->name])
                    ->setTo($this->email)
                    ->setSubject('Восстановление пароля на ' . Yii::$app->name)
                    ->send();
            }
        }
        return false;
    }
}