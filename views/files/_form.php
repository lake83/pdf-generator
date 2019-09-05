<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Files */
/* @var $form yii\bootstrap\ActiveForm */

$form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?= $form->field($model, 'template_id')->dropDownList(\app\models\Templates::getAll(), ['class' => 'form-control', 'prompt' => '- выбрать -']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="box-footer">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>