<?php

namespace app\controllers;

use app\models\Link;
use yii\helpers\Html;

class LinksController extends ItemController
{
    protected function getResults($model)
    {
        return [
            'url' => Html::a((!empty($model->anchor)) ? $model->anchor : $model->url, "//" . $model->url, ['title' => $model->title]),
            'description' => $model->description,
        ];
    }

    protected function findModel($id)
    {
        return Link::findOne($id);
    }

    protected function createModel()
    {
        return new Link();
    }

    protected function getFormViewName()
    {
        return '_link_form';
    }

    protected function getItemName()
    {
        return 'link';
    }

    protected function getLineViewName()
    {
        return '_link_line';
    }
}
