<?php

namespace app\controllers;

use yii\filters\AccessControl;

class PortfolioController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['add', 'edit', 'index'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionAdd()
    {
        return $this->render('add');
    }

    public function actionEdit($id)
    {
        return $this->render('edit');
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView($id = NULL)
    {
        return $this->render('view');
    }

}
