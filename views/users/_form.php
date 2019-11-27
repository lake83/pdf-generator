<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\bootstrap\ActiveForm */

$form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?= $form->field($model, 'image')->widget(\app\components\FilemanagerInput::className()) ?>
    
    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'fio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList($model->getStatus()) ?>
    
    <?= $form->field($model, 'new_password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_active')->checkbox() ?>

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>