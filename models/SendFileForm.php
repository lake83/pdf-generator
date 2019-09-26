<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\Inflector;

/**
 * Send file form
 */
class SendFileForm extends Model
{
    public $name;
    public $manager;
    public $photo;
    public $email;
    public $subject;
    public $file;
    public $file_title;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'manager', 'photo', 'email', 'subject', 'file_title'], 'required'],
            [['name', 'manager', 'photo', 'email', 'subject'], 'trim'],
            [['name', 'manager', 'photo', 'subject'], 'string', 'max' => 255],
            ['file_title', 'string', 'max' => 50],
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
            'manager' => 'Имя менеджера',
            'photo' => 'Фото менеджера',
            'email' => 'E-mail получателя',
            'subject' => 'Тема письма',
            'file_title' => 'Название файла'
        ];
    }

    /**
     * Sends an email with a file
     * 
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        return Yii::$app->mailer->compose(['html' => 'proposal-html'], [
                'name' => $this->name,
                'manager' => $this->manager,
                'photo' => $this->photo])
            ->setFrom([Yii::$app->params['adminEmail'] => 'Promovers.ru'])
            ->setTo($this->email)
            ->setSubject($this->subject)
            ->attachContent($this->file, ['fileName' => Inflector::slug($this->file_title) . '.pdf', 'contentType' => 'application/x-pdf'])
            ->send();
    }
}