<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\modules\user\models\ResetForm */

$this->title = 'Смена пароля';

$fieldOptions = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b><?=Yii::$app->name?></b></a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg"><?=Html::encode($this->title)?></p>

        <?php $form = ActiveForm::begin(['id' => 'reset-form']); ?>

        <?= $form
            ->field($model, 'password', $fieldOptions)
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>
            
        <?= $form
            ->field($model, 'verify_password', $fieldOptions)
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('verify_password')]) ?>

        <div class="row">
            <div class="col-xs-6">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary btn-flat', 'name' => 'login-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
        
        <div class="text-center">
            <br />
            <?= Html::a('<i class="fa fa-sign-in"></i> ' . 'Авторизация', ['site/index'], ['class' => 'btn btn-block btn-social btn-facebook btn-flat']) ?>
        </div>

    </div>
</div>