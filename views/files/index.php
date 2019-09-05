<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Templates;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FilesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Файлы';
?>

<p><?= Html::a('Создать файл', ['create'], ['class' => 'btn btn-success']) ?></p>

<?=  GridView::widget([
    'layout' => '{items}{pager}',
    'dataProvider' => $dataProvider,
    'pjax' => true,
    'export' => false,
    'filterModel' => $searchModel,
        'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'template_id',
                'filter' => Html::activeDropDownList($searchModel, 'template_id', Templates::getAll(), ['class' => 'form-control', 'prompt' => '- выбрать -']),
                'value' => function ($model, $index, $widget) {
                    return $model->template->name;
                }
            ],
            'name',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{print} {update} {delete}',
                'buttons' => [
                    'print' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-print"></span>', ['print', 'id' => $model->id], ['title' => 'Опубликовать', 'data-pjax' => 0]);
                    }
                ],
                'options' => ['width' => '70px']
            ]
        ]
    ]);
?>