<?php

namespace app\controllers;

use app\models\Link;
use app\models\Portfolio;
use app\models\Work;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionAdd()
    {
        $user_id = \Yii::$app->user->identity->id;
        $portfolio = new Portfolio();

        if ($portfolio->load(\Yii::$app->request->post())) {

            $portfolio->user_id = $user_id;

            $avatarData = \Yii::$app->request->post('avatarData');

            $this->saveAvatar($avatarData, $portfolio);
            
            if ($portfolio->save()) {
                return $this->redirect(['index']);
            }
            
        } else {
            return $this->render('add', [
                'portfolio' => $portfolio,
                'user' => \Yii::$app->user->identity,
            ]);
        }
    }

    public function actionEdit($id)
    {
        $portfolio = $this->findModel($id);

        if ($portfolio->load(\Yii::$app->request->post())) {

            $avatarData = \Yii::$app->request->post('avatarData');

            $this->saveAvatar($avatarData, $portfolio);

            if ($portfolio->save()) {
                return $this->redirect(['index']);
            }

        } else {
            return $this->render('edit', [
                'portfolio' => $portfolio,
                'user' => \Yii::$app->user->identity,
            ]);
        }
    }

    private function saveAvatar($avatarData, $portfolio)
    {
        if (!empty($avatarData)) {

            if (!empty($portfolio->avatar)) {
                $oldAvatarFile = \Yii::getAlias('@webroot') . '/public/' . $portfolio->avatar;
                if (file_exists($oldAvatarFile)) {
                    unlink($oldAvatarFile);
                }
            }

            list($type, $avatarData) = explode(';', $avatarData);
            list(, $avatarData)      = explode(',', $avatarData);
            list(, $ext)      = explode('/', $type);

            $avatarData = base64_decode($avatarData);
            $avatarName = time() . '.' . $ext;
            file_put_contents(\Yii::getAlias('@webroot') . '/public/' . $avatarName, $avatarData);

            $portfolio->avatar = $avatarName;
        }
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
        
        $portfolio = $this->findModel($id);
        
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

    public function actionModalLinkEdit($linkId)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $link = Link::findOne($linkId);

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
                    'link_line' => $this->renderPartial('_link_line', [
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

    public function actionDelete()
    {
        $id = \Yii::$app->request->post('id');

        $portfolio = Portfolio::findOne($id);

        if (is_null($portfolio)) {
            return false;
        }

        $user_id = \Yii::$app->user->identity->id;
        
        if ($portfolio->user_id !== $user_id) {
            return false;
        }
        
        return $portfolio->delete();
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

    protected function findModel($id)
    {
        if (($model = Portfolio::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGetAvatar($id)
    {
        $portfolio = Portfolio::findOne($id);

        if (is_null($portfolio)) {
            return false;
        }

        return $portfolio->avatar;
    }

}
