<?php

/* @var $this yii\web\View */
/* @var $model app\models\Files */

$this->title = 'Создание файла';

echo $this->render(!$model->values ? '_form' : '_values', ['model' => $model]) ?>