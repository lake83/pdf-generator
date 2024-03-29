<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Files */
/* @var $form yii\bootstrap\ActiveForm */

$form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <div class="form-group">
        <div class="control-label col-sm-3" style="padding-top: 0;font-weight: bold;"><?= $model->getAttributeLabel('template_id') ?></div>
        <div class="col-sm-6"><?= $model->template->name ?></div>
    </div>
    
    <div class="form-group">
        <div class="control-label col-sm-3" style="padding-top: 0;font-weight: bold;"><?= $model->getAttributeLabel('name') ?></div>
        <div class="col-sm-6"><?= $model->name ?></div>
    </div>
    
    <?php 
    echo Html::activeHiddenInput($model, 'template_id');
    echo Html::activeHiddenInput($model, 'name');
    echo Html::activeHiddenInput($model, 'values');
            
    foreach ($model->rows as $field => $data) {
        $value = !$model->isNewRecord && array_key_exists($field, $model->filds_value) ? $model->filds_value[$field] : $data['value'];
        
        echo !$data['is_image'] ? $form->field($model, 'rows[' . $field . ']')->textInput(['value' => $value])->label($data['label']) :
            $form->field($model, 'rows[' . $field . ']')->widget(\app\components\FilemanagerInput::className(), ['data' => $value])->label($data['label']);
    } ?>

    <div class="box-footer">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>