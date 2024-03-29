<?php

namespace app\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use kartik\mpdf\Pdf;
use app\models\SendFileForm;

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
                //$model->scenario = 'second';
                $model->values = true;
                
                foreach ($model->filds as $field) {
                    $model->rows[$field->id] = ['label' => $field->name, 'value' => $field->start_value, 'is_image' => $field->is_image];
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
        //$model->scenario = 'second';
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Запись добавлена.');
            return $this->redirect(['index']);
        }
        foreach ($model->filds as $field) {
            $model->rows[$field->id] = ['label' => $field->name, 'value' => $field->start_value, 'is_image' => $field->is_image];
        }
        return $this->render('update', ['model' => $model]);
    }
    
    /**
     * Print file
     * 
     * @param int $id
     * @param string $destination
     * @return string
     */
    public function actionPrint($id, $destination = Pdf::DEST_BROWSER)
    {
        $model = $this->findModel($id);
        $template = $model->template;
        $content = $template->content;
        //$content = $this->renderPartial('_samplePdf');
        
        foreach ($model->filds as $field) {
            $content = str_replace($field->symbol, ($field->is_image ? '../images/uploads/source/' : '') . $model->filds_value[$field->id], $content);
            $content = str_replace('{{CP_title}}', $model->name, $content);
        }
        $pdf = new Pdf([
            'destination' => $destination,
            'format' => $template->getFormats($template->format),
            'orientation' => $template->orientation,
            'cssFile' => $template->css ? '@webroot/images/uploads/source/' . $template->css : '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'defaultFont' => 'dejavusans',
            'content' => $content,
            'marginLeft' => 0,
            'marginRight' => 0,
            'marginTop' => 0,
            'marginBottom' => 0
        ]);
        return $pdf->render();
    }
    
    /**
     * Send e-mail with file
     * 
     * @param int $id
     * @return string
     */
    public function actionSend($id)
    {
        $model = new SendFileForm;
        
        if ($model->load(Yii::$app->request->post())) {
            $model->file = $this->actionPrint($id, Pdf::DEST_STRING);
            
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Письмо отправлено.');
                return $this->redirect(['index']);
            }
        }
        return $this->render('send', ['model' => $model]);
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