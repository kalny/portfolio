<?php

namespace app\controllers;

use app\models\Phone;
use yii\helpers\Html;

class PhonesController extends ItemController
{
    protected function getResults($model)
    {
        return [
            'number' => $model->number,
            'note' => $model->note,
        ];
    }

    protected function findModel($id)
    {
        return Phone::findOne($id);
    }

    protected function createModel()
    {
        return new Phone();
    }

    protected function getFormViewName()
    {
        return '_phone_form';
    }

    protected function getItemName()
    {
        return 'phone';
    }

    protected function getLineViewName()
    {
        return '_phone_line';
    }
}
