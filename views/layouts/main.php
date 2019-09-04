<?php
use yii\helpers\Html;
use kartik\alert\AlertBlock;
use kartik\dialog\Dialog;

/* @var $this \yii\web\View */
/* @var $content string */

app\assets\AdminAsset::register($this);
dmstr\web\AdminLteAsset::register($this);

echo Dialog::widget([
   'libName' => 'krajeeDialog',
   'options' => [
       'type' => Dialog::TYPE_DEFAULT,
       'title' => false,
       'btnOKClass' => 'btn-success'
   ]
]);
$this->beginPage() ?>

<!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="<?= \dmstr\helpers\AdminLteHelper::skinClass() ?>">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <?php 
        if (Yii::$app->errorHandler->exception == null) {
            echo $this->render('header.php');
            echo $this->render('left.php');
        } 
        echo AlertBlock::widget([
            'useSessionFlash' => true,
            'type' => AlertBlock::TYPE_GROWL
        ]);
        
        echo $this->render('content.php', ['content' => $content]);
        ?>
    </div>

    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>