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
        ['label' => 'Пользователи', 'url' => ['users/index'], 'icon' => 'users'],
        ['label' => 'Шаблоны', 'url' => ['templates/index'], 'icon' => 'list-alt'],
        ['label' => 'Файлы', 'url' => ['files/index'], 'icon' => 'file']
    ]
]);	
?>
    </section>
</aside>