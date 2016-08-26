<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 26.08.16
 * Time: 12:01
 */

namespace app\controllers;


use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

abstract class ItemController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['modal-add', 'modal-edit', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionModalEdit($itemId)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $model = $this->findModel($itemId);

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            $results = [
                'result' => true,
                'id' => $model->id,
            ];
            return array_merge($results, $this->getResults($model));
        }

        if (is_null($model)) {
            return NULL;
        }

        return [
            'body' => $this->renderPartial($this->getFormViewName(), [
                $this->getItemName() => $model,
            ])
        ];
    }

    public function actionModalAdd($userId, $portfolioId)
    {

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $model = $this->createModel();

        if ($model->load(\Yii::$app->request->post())) {
            $model->user_id = $userId;
            $model->portfolio_id = $portfolioId;
            if ($model->save()) {
                return [
                    'result' => true,
                    'item_line' => $this->renderPartial($this->getLineViewName(), [
                        $this->getItemName() => $model,
                    ])
                ];
            }
        }

        return [
            'body' => $this->renderPartial($this->getFormViewName(), [
                $this->getItemName() => $model,
            ])
        ];
    }

    public function actionDelete()
    {
        $id = \Yii::$app->request->post('id');

        $model = $this->findModel($id);

        if (is_null($model)) {
            return false;
        }

        $user_id = \Yii::$app->user->identity->id;

        if ($model->user_id !== $user_id) {
            return false;
        }

        return $model->delete();
    }
    
    abstract protected function getResults($model);
    abstract protected function findModel($id);
    abstract protected function createModel();

    abstract protected function getFormViewName();
    abstract protected function getItemName();
    abstract protected function getLineViewName();
}