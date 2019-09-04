<?php

namespace app\controllers;

/**
 * TemplatesFieldsController implements the CRUD actions for TemplatesFields model.
 */
class TemplatesFieldsController extends AdminController
{
    public $modelClass = 'app\models\TemplatesFields';
    public $searchModelClass = 'app\models\TemplatesFieldsSearch';
    
    public function actions()
    {
        $actions = parent::actions();
        $redirect = ['index', 'template_id' => \Yii::$app->request->get('template_id')];
        
        $actions['create']['redirect'] = $redirect;
        $actions['update']['redirect'] = $redirect;
        $actions['delete']['redirect'] = $redirect;
        
        return $actions;
    }
}