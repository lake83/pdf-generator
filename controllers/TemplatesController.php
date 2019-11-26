<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\User;

/**
 * TemplatesController implements the CRUD actions for Templates model.
 */
class TemplatesController extends AdminController
{
    public $modelClass = 'app\models\Templates';
    public $searchModelClass = 'app\models\TemplatesSearch';
    
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'rules' => [
                [
                    'actions' => [$this->action->id],
                    'allow' => true,
                    'roles' => ['@'],
                    'matchCallback' => function() {
                        return Yii::$app->user->isAdmin;               
                    }
                ]
            ]
        ];
        return $behaviors;
    }
}