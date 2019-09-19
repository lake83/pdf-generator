<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Templates */
/* @var $form yii\bootstrap\ActiveForm */

$form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->widget(\app\components\RedactorTinymce::className()) ?>
    
    <div style="margin-bottom: 20px;" class="col-md-offset-3 col-md-9">Для вывода названия комерческого предложения используйте {{CP_title}}</div>
    
    <?= $form->field($model, 'css')->widget(\app\components\FilemanagerInput::className()) ?>
    
    <?= $form->field($model, 'format')->dropDownList($model->getFormats(), ['class' => 'form-control', 'prompt' => '- выбрать -']) ?>
    
    <?= $form->field($model, 'orientation')->dropDownList($model->getOrientations(), ['class' => 'form-control', 'prompt' => '- выбрать -']) ?>

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>