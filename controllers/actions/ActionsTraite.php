<?php
namespace app\controllers\actions;

use Yii;
use yii\web\NotFoundHttpException;

trait ActionsTraite
{
    /**
     * Saving and outputting for the Create and Update actions
     * 
     * @param string $model data model
     * @param string $message save message
     * @param string $view presentation name
     * @param string $redirect forwarding address after saving the entry
     * @param string $scenario model scenario
     * @return mixed
     */
    protected function actionBody($model, $message, $view, $redirect, $scenario = null)
    {
        $model = is_object($model) ? $model : $this->findModel($model);
        $request = Yii::$app->request;
        
        if (!is_null($scenario)) {
            $model->scenario = $scenario;
        }
        if ($request->isAjax && $model->load($request->post())) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return \yii\widgets\ActiveForm::validate($model);
        } 
        if ($model->load($request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', $message);
            return $this->controller->redirect($redirect);
        } else {
            return $request->isAjax ? $this->controller->renderAjax($view, [
                'model' => $model
            ]) : $this->controller->render($view, [
                'model' => $model
            ]);
        }
    }
    
    /**
     * Find the model by the primary key
     * If model is not found, gives exception 404
     * 
     * @param object $model model instance
     * @return loaded model
     * @throws NotFoundHttpException if the model is not found
     */
    protected function findModel($model)
    {
        if (($model = $model::findOne(Yii::$app->request->getQueryParam('id'))) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Страница не найдена.');
        }
    }
}