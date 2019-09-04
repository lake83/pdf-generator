<?php
use yii\bootstrap\ActiveForm;

$form = ActiveForm::begin(['id' => 'paramForm', 'layout' => 'horizontal']);

echo $form->field($model, $param['name'])->textArea(['value' => $param['value']])->label($param['label'].' / '.$param['name']);
?>
<span class="help-block col-sm-12"><?=$param['hint']?></span>
<?php
echo \yii\helpers\Html::submitButton('Сохранить', ['class' => 'btn btn-primary']);

ActiveForm::end(); ?>