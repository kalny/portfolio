<?php

namespace app\controllers;

use app\models\Link;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Html;

class LinksController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['modal-link-add', 'modal-link-edit', 'delete-link'],
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
                    'delete-link' => ['post'],
                ],
            ],
        ];
    }

    public function actionModalLinkEdit($itemId)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $link = Link::findOne($itemId);

        if ($link->load(\Yii::$app->request->post()) && $link->save()) {
            return [
                'result' => true, 
                'id' => $link->id,
                'url' => Html::a((!empty($link->anchor)) ? $link->anchor : $link->url, "//" . $link->url, ['title' => $link->title]),
                'description' => $link->description,
            ];
        }

        if (is_null($link)) {
            return NULL;
        }

        return [
            'body' => $this->renderPartial('_link_form', [
                'link' => $link,
            ])
        ];
    }

    public function actionModalLinkAdd($userId, $portfolioId)
    {

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $link = new Link();
        
        if ($link->load(\Yii::$app->request->post())) {
            $link->user_id = $userId;
            $link->portfolio_id = $portfolioId;
            if ($link->save()) {
                return [
                    'result' => true,
                    'item_line' => $this->renderPartial('_link_line', [
                        'link' => $link,
                    ])
                ];
            }
        }

        return [
            'body' => $this->renderPartial('_link_form', [
                'link' => $link,
            ])
        ];
    }

    public function actionDeleteLink()
    {
        $id = \Yii::$app->request->post('id');

        $link = Link::findOne($id);

        if (is_null($link)) {
            return false;
        }

        $user_id = \Yii::$app->user->identity->id;

        if ($link->user_id !== $user_id) {
            return false;
        }

        return $link->delete();
    }
}
