<?php

namespace app\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use kartik\mpdf\Pdf;

/**
 * FilesController implements the CRUD actions for Files model.
 */
class FilesController extends AdminController
{
    public $modelClass = 'app\models\Files';
    public $searchModelClass = 'app\models\FilesSearch';
    
    public function actions()
    {
        $actions = parent::actions();
        
        unset($actions['create'], $actions['update']);
        
        return $actions;
    }
    
    /**
     * Create file
     * 
     * @return string
     */
    public function actionCreate()
    {
        $model = new $this->modelClass;
        
        if ($model->load(Yii::$app->request->post())) {
            if ($model->values == false) {
                $model->scenario = 'second';
                $model->values = true;
                
                foreach ($model->filds as $field) {
                    $model->rows[$field->id] = $field->name . '(' . $field->symbol . ')';
                }
                return $this->render('create', ['model' => $model]);
            } else {
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Запись добавлена.');
                    return $this->redirect(['index']);
                }
            }
        }
        return $this->render('create', ['model' => $model]);
    }
    
    /**
     * Update file
     * 
     * @param int $id
     * @return string
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'second';
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Запись добавлена.');
            return $this->redirect(['index']);
        }
        foreach ($model->filds as $field) {
            $model->rows[$field->id] = $field->name . '(' . $field->symbol . ')';
        }
        return $this->render('update', ['model' => $model]);
    }
    
    /**
     * Print file
     * 
     * @param int $id
     * @return string
     */
    public function actionPrint($id)
    {
        $model = $this->findModel($id);
        $content = $model->template->content;
        
        foreach ($model->filds as $field) {
            $content = str_replace($field->symbol, $model->filds_value[$field->id], $content);
        }
        $pdf = new Pdf([
            //'mode' => Pdf::MODE_CORE,
            //'format' => Pdf::FORMAT_A4,
            //'orientation' => Pdf::ORIENT_PORTRAIT,
            //'destination' => Pdf::DEST_BROWSER,
            'content' => $content,
            //'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            //'cssInline' => '.kv-heading-1{font-size:18px}'
        ]);
        return $pdf->render();
    }
    
    /**
     * Find the model by the primary key
     * If model is not found, gives exception 404
     * 
     * @param int $id
     * @return app\models\Files
     * @throws NotFoundHttpException if the model is not found
     */
    protected function findModel($id)
    {
        if (!$model = $this->modelClass::findOne($id)) {
            throw new NotFoundHttpException('Страница не найдена.');
        }
        return $model;
    }
}