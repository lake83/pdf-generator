<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\User;

/**
 * UsersController implements the CRUD actions for Users model
 */
class UsersController extends AdminController
{
    public $modelClass = 'app\models\User';
    public $searchModelClass = 'app\models\UserSearch';
    
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