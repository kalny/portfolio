<?php

namespace app\controllers;

use app\models\Email;
use yii\helpers\Html;

class EmailsController extends ItemController
{
    protected function getResults($model)
    {
        return [
            'email' => Html::a($model->email, "mailto:" . $model->email),
        ];
    }

    protected function findModel($id)
    {
        return Email::findOne($id);
    }

    protected function createModel()
    {
        return new Email();
    }

    protected function getFormViewName()
    {
        return '_email_form';
    }

    protected function getItemName()
    {
        return 'email';
    }

    protected function getLineViewName()
    {
        return '_email_line';
    }
}
