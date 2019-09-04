<?php

namespace app\controllers;

/**
 * TemplatesController implements the CRUD actions for Templates model.
 */
class TemplatesController extends AdminController
{
    public $modelClass = 'app\models\Templates';
    public $searchModelClass = 'app\models\TemplatesSearch';
}