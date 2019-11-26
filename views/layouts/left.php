<?php
app\assets\AdminAsset::register($this);

/* @var $this \yii\web\View */
/* @var $content string */

?>
<aside class="main-sidebar">
    <section class="sidebar">
<?= dmstr\widgets\Menu::widget([
    'options' => ['class' => 'sidebar-menu', 'data-widget' => 'tree'],
    'encodeLabels' => false,
    'items' => [
        ['label' => 'Пользователи', 'url' => ['users/index'], 'icon' => 'users', 'visible' => Yii::$app->user->isAdmin],
        ['label' => 'Шаблоны', 'url' => ['templates/index'], 'icon' => 'list-alt', 'visible' => Yii::$app->user->isAdmin],
        ['label' => 'Документы', 'url' => ['files/index'], 'icon' => 'file']
    ]
]);	
?>
    </section>
</aside>