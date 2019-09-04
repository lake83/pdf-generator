<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\modules\user\RemindForm */

$this->title = 'Восстановление доступа';

$fieldOptions = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];
?>
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b><?=Yii::$app->name?></b></a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg"><?=Html::encode($this->title)?></p>

        <?php $form = ActiveForm::begin(['id' => 'remind-form']); ?>

        <?= $form
            ->field($model, 'email', $fieldOptions)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>

        <div class="row">
            <div class="col-xs-6">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary btn-flat', 'name' => 'login-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
        
        <div class="text-center">
            <br />
            <?= Html::a('<i class="fa fa-sign-in"></i> ' . 'Авторизация', ['site/index'], ['class' => 'btn btn-block btn-social btn-facebook btn-flat']) ?>
        </div>

    </div>
</div>