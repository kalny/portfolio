<?php

namespace app\controllers;

use app\models\Portfolio;
use app\models\Work;
use yii\web\NotFoundHttpException;
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
        $user_id = \Yii::$app->user->identity->id;

        $portfolios = Portfolio::findAll(['user_id' => $user_id]);

        return $this->render('index', [
            'portfolios' => $portfolios,
        ]);
    }

    public function actionView($id = NULL)
    {
        if ($id == NULL) {
            //temporarily
            $id = 32;
        }
        
        $portfolio = Portfolio::findOne($id);

        if (is_null($portfolio)) {
            throw new NotFoundHttpException(\Yii::t('app', 'MESSAGE_PORTFOLIO_NOT_FOUND'));
        }
        
        return $this->render('view', [
            'portfolio' => $portfolio,
        ]);
    }

    public function actionModalWorkView($workId)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $work = Work::findOne($workId);

        if (is_null($work)) {
            return NULL;
        }

        return [
            'title' => $work->title,
            'body' => $this->renderPartial('work', [
                'work' => $work,
            ])
        ];
    }

}
