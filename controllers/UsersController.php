<?php

namespace app\controllers;

/**
 * UsersController implements the CRUD actions for Users model
 */
class UsersController extends AdminController
{
    public $modelClass = 'app\models\User';
    public $searchModelClass = 'app\models\UserSearch';
}