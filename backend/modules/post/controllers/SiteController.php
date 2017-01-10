<?php

namespace app\modules\post\controllers;

use yii\web\Controller;

/**
 * Default controller for the `post` module
 */
class SiteController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
