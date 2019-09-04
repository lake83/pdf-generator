<?php
use yii\bootstrap\ActiveForm;

$form = ActiveForm::begin(['id' => 'createSettingForm', 'layout' => 'horizontal']);

echo $form->field($model, 'label')->label('Название');

echo $form->field($model, 'value')->textArea()->label('Значение');

echo $form->field($model, 'name')->label('Алиас');

echo $form->field($model, 'rules')->label('Правило валидации');

echo $form->field($model, 'icon')->label('Пиктограма');

echo $form->field($model, 'hint')->textArea()->label('Примечание');

echo \yii\helpers\Html::submitButton('Сохранить', ['class' => 'btn btn-primary']);

ActiveForm::end(); ?>