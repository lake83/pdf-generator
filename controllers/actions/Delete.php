<?php 
namespace app\controllers\actions;

class Delete extends \yii\base\Action
{
    use ActionsTraite;
    
    public $model;
    public $redirect;
    public $success;
    
    public function run()
    {
        if ($this->findModel($this->model)->delete()) {
            if ($this->success) {
                \Yii::$app->session->setFlash('success', $this->success);
            }
            return $this->controller->redirect($this->redirect ? $this->redirect : ['index']);
        }
    }
}