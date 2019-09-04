<?php
/**
 * This is the template for generating a controller class file.
 */

use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\controller\Generator */

$class = StringHelper::basename($generator->controllerClass);
$model = ucfirst($generator->controllerID);

echo "<?php\n";
?>

namespace <?= isset($namespace) ? $namespace : $generator->getControllerNamespace() ?>;

/**
 * <?=$class?> implements the CRUD actions for <?=$model?> model.
 */
class <?=$class?> extends AdminController
{
    public $modelClass = 'app\models\<?=$model?>';
    public $searchModelClass = 'app\models\<?=$model?>Search';
}