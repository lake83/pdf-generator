<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SendFileForm */
/* @var $form yii\bootstrap\ActiveForm */

$this->title = 'Отправка письма';

$form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'email')->textInput() ?>
    
    <?= $form->field($model, 'manager')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'photo')->widget(\app\components\FilemanagerInput::className()) ?>

    <div class="box-footer">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>