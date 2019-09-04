<?php 
namespace app\controllers\actions;

class Update extends \yii\base\Action
{
    use ActionsTraite;
    
    public $model;
    public $scenario;
    public $redirect = ['index'];
    
    public function run()
    {
        return $this->actionBody($this->model, 'Изменения сохранены.', 'update', $this->redirect, $this->scenario);
    }
}