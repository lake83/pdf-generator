<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ResetPasswordForm;
use app\models\RemindForm;
use yii\web\BadRequestHttpException;
use yii\base\InvalidParamException;
use app\components\SiteHelper;

class SiteController extends Controller
{
    public $layout = '@app/views/layouts/main-login';
    
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post']
                ]
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ]
        ];
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(SiteHelper::redirectByRole(Yii::$app->user->status));
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && ($status = $model->login())) {
            return $this->redirect(SiteHelper::redirectByRole($status));
        }
        $model->password = '';
        return $this->render('index', ['model' => $model]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
    /**
     * Password Recovery Request
     * 
     * @return string
     */
    public function actionRemind()
    {
        $model = new RemindForm;
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Инструкции отправлены на Ваш E-mail.');
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка при отправлении E-mail.');
            }
            return $this->redirect(['index']);
        }
        return $this->render('remind', ['model' => $model]);
    }
    
    /**
     * Change Password
     * 
     * @param string $token password change token
     * @return string
     * @throws BadRequestHttpException if failed
     */
    public function actionReset($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($model->load(Yii::$app->request->post()) && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Новый пароль сохранен.');

            return $this->redirect(['index']);
        }
        return $this->render('reset', ['model' => $model]);
    }
}