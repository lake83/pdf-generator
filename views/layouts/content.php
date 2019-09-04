<?php
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;

Modal::begin([
    'header' => '<h2><span id="modalTitle"></span></h2>',
    'id' => 'modal'
]);

echo '<div id="modalContent"></div>';

Modal::end();
?>
<div class="content-wrapper"<?=Yii::$app->errorHandler->exception == null ? '' : ' style="margin-left:0"'?>>
    <section class="content-header">
        <?php if (isset($this->blocks['content-header'])) { ?>
            <h1><?= $this->blocks['content-header'] ?></h1>
        <?php } else { ?>
            <h1>
                <?php
                if ($this->title !== null) {
                    echo Html::encode($this->title);
                }?>
            </h1>
        <?php } ?>
    </section>

    <section class="content box box-success">
        <?= Alert::widget() ?>
        <?= $content ?>
    </section>
</div>

<?php if (Yii::$app->errorHandler->exception == null): ?>
<footer class="main-footer">
    &copy; <?= Yii::$app->name.'. '.date('Y') ?>
</footer>
<?php endif; ?>

<aside class="control-sidebar control-sidebar-dark">

    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-wrench"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-database"></i></a></li>
    </ul>
    
    <div class="tab-content">
        <div class="tab-pane active" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">
                Настройки
                <a class="btn btn-success pull-right" href="#" onclick="js:createSetting('Создать настройку', '<?=Url::to(['admin/create-setting'])?>');return false;">Создать</a>
            </h3>
            <ul class='control-sidebar-menu'>
                <?php 
                $db = Yii::$app->db;
                $settings = $db->cache(function ($db) {
                    return (new \yii\db\Query())->from('settings')->all();
                }, 0, new \yii\caching\TagDependency(['tags' => 'settings']));
                foreach($settings as $param): ?>
                <li>
                    <a href="#" onclick="js:settings('<?=$param['label']?>','<?=$param['name']?>', '<?=Url::to(['admin/settings'])?>');return false;">
                        <i class="menu-icon fa <?=$param['icon']?> bg-green"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading"><?=$param['label']?></h4>

                            <p id="<?=$param['name']?>"><?=$param['value']?></p>
                        </div>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        
        <div class="tab-pane" id="control-sidebar-settings-tab">
            <h3 class="control-sidebar-heading">Очистить кеш</h3>
            <a class="btn btn-danger" href="<?=Url::to(['admin/clear-cache'])?>" data-confirm="Вы уверены, что хотите удалить весь кеш?">Очистить</a>
        </div>
    </div>
</aside>
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class='control-sidebar-bg'></div>