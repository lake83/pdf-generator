<?php 
namespace app\controllers\actions;

class Index extends \yii\base\Action
{
    public $search;
    
    public function run()
    {
        $searchModel = new $this->search;
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->controller->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }
}