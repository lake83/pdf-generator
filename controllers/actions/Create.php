<?php 
namespace app\controllers\actions;

class Create extends \yii\base\Action
{
    use ActionsTraite;
    
    public $model;
    public $scenario;
    public $redirect = ['index'];
    
    public function run()
    {
        $model = empty($this->scenario) ? new $this->model : new $this->model(['scenario' => $this->scenario]);
                
        return $this->actionBody($model, 'Запись добавлена.', 'create', $this->redirect);
    }
}