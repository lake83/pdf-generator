<?= $this->render('@app/components/gii/controller/controller.php', [
    'generator' => $generator,
    'namespace' => yii\helpers\StringHelper::dirname(ltrim($generator->controllerClass, '\\'))
]); ?>