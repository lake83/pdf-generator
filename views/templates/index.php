<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\components\SiteHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TemplatesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Шаблоны';
?>

<p><?= Html::a('Создать шаблон', ['create'], ['class' => 'btn btn-success']) ?></p>

<?=  GridView::widget([
    'layout' => '{items}{pager}',
    'dataProvider' => $dataProvider,
    'pjax' => true,
    'export' => false,
    'filterModel' => $searchModel,
        'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

            'name',
            [
                'attribute' => 'format',
                'filter' => Html::activeDropDownList($searchModel, 'format', $searchModel->getFormats(), ['class' => 'form-control', 'prompt' => '- выбрать -']),
                'value' => function ($model, $index, $widget) {
                    return $model->getFormats($model->format);
                }
            ],
            [
                'attribute' => 'orientation',
                'filter' => Html::activeDropDownList($searchModel, 'orientation', $searchModel->getOrientations(), ['class' => 'form-control', 'prompt' => '- выбрать -']),
                'value' => function ($model, $index, $widget) {
                    return $model->getOrientations($model->orientation);
                }
            ],
            SiteHelper::created_at($searchModel),

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {fields} {delete}',
                'buttons' => [
                    'fields' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-list-alt"></span>', ['templates-fields/index', 'template_id' => $model->id], ['title' => 'Поля', 'data-pjax' => 0]);
                    }
                ],
                'options' => ['width' => '70px']
            ]
        ]
    ]);
?>