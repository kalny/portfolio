<?php

namespace app\controllers;

use app\models\Email;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Html;

class EmailsController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['modal-email-add', 'modal-email-edit', 'delete-email'],
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
                    'delete-email' => ['post'],
                ],
            ],
        ];
    }

    public function actionModalEmailEdit($itemId)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $email = Email::findOne($itemId);

        if ($email->load(\Yii::$app->request->post()) && $email->save()) {
            return [
                'result' => true, 
                'id' => $email->id,
                'email' => Html::a($email->email, "mailto:" . $email->email),
            ];
        }

        if (is_null($email)) {
            return NULL;
        }

        return [
            'body' => $this->renderPartial('_email_form', [
                'email' => $email,
            ])
        ];
    }

    public function actionModalEmailAdd($userId, $portfolioId)
    {

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $email = new Email();
        
        if ($email->load(\Yii::$app->request->post())) {
            $email->user_id = $userId;
            $email->portfolio_id = $portfolioId;
            if ($email->save()) {
                return [
                    'result' => true,
                    'item_line' => $this->renderPartial('_email_line', [
                        'email' => $email,
                    ])
                ];
            }
        }

        return [
            'body' => $this->renderPartial('_email_form', [
                'email' => $email,
            ])
        ];
    }

    public function actionDeleteEmail()
    {
        $id = \Yii::$app->request->post('id');

        $email = Email::findOne($id);

        if (is_null($email)) {
            return false;
        }

        $user_id = \Yii::$app->user->identity->id;

        if ($email->user_id !== $user_id) {
            return false;
        }

        return $email->delete();
    }
}
