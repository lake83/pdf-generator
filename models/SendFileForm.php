<?php
namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Send file form
 */
class SendFileForm extends Model
{
    public $name;
    public $email;
    public $file;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            [['name', 'email'], 'trim'],
            ['name', 'string', 'max' => 255],
            ['email', 'email'],
            ['file', 'safe']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Имя получателя',
            'email' => 'E-mail получателя'
        ];
    }

    /**
     * Sends an email with a file
     * 
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        return Yii::$app->mailer->compose(['html' => 'proposal-html'], ['name' => $this->name])
            ->setFrom(Yii::$app->params['adminEmail'])
            ->setTo($this->email)
            ->setSubject('Комерческое предложение')
            ->attachContent($this->file, ['fileName' => 'proposal.pdf', 'contentType' => 'text/plain'])
            ->send();
    }
}