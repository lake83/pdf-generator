<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $username string */
/* @var $email string */
/* @var $password string */

$loginLink = Yii::$app->urlManager->createAbsoluteUrl(['/site/index']);
?>

<table style="padding:0;background-color:#e5e5e5;width:100%;border-collapse:collapse;border-spacing:0;text-align:center;vertical-align:top; margin:30px auto;">
    <tbody>
        <tr style="padding:0;text-align:center;vertical-align:top;width:100%;" align="center">
            <td>                 
                <h1 style="padding:0 25px;color:#485671;font:400 24px Arial;margin:35px 0;">Здравствуйте <?= Html::encode($username) ?></h1>
                
                <div>
                    <span style="padding:0 25px;color:#4a5773;font:400 16px Arial;margin-bottom:30px">Вам создан аккаунт на сайте <?= Yii::$app->name ?></span>
                    <span style="color:#4a5773;font:400 16px Arial;display:block;margin-bottom: 30px;">Запомните Ваши данные для входа на сайт:</span>
                    <div style="margin-bottom:30px;">
                        <span style="color: #4a5773;font:700 16px Arial;">Email:</span>
                        <span style="color: #4a5773;font:700 16px Arial;text-decoration:underline;"><?= $email ?></span>
                    </div>
                    <div>
                        <span style="color: #4a5773;font:700 16px Arial;">Пароль:</span>
                        <span style="color: #4a5773;font:700 16px Arial;"><?= $password ?></span>
                    </div>
                    <a href="<?= $loginLink ?>" style="display:block;width:250px;height:40px;text-align:center;background-color:#1c69ff;color:#ffffff;font:400 16px Arial;text-transform:uppercase;text-decoration:none;line-height:40px;margin:30px auto;">Подтвердить</a>
                </div>
                
                <hr style="border:0;height:1px;background-color:#687aa1;margin:5px 0 35px 0;width:calc(100% - 50px);margin-left:25px;"/>
                
                <span style="padding:0 25px;color:#4a5773;font:400 16px Arial;margin-bottom:30px;">Если Вы не можете подтвердить запрос, пожалуйста, перейдите по ссылке или<br />вставьте ее в адресную строку браузера</span><br />
                <a href="<?= $loginLink ?>" style="color:#1c69ff;font:700 16px Arial;text-decoration:underline;padding:30px 0;display: block;"><?= $loginLink ?></a>
            </td>
        </tr>
    </tbody>            
</table>