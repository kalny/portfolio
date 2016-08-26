<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 26.08.16
 * Time: 12:57
 */

namespace app\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;


class ActionButtons extends Widget
{
    public $editClass = 'btn-edit-link';
    public $editTitle = 'edit';
    public $modalId = '#linkEditModalWindow';
    public $modalTitle = 'Edit item';
    public $itemId = 0;
    public $deleteClass = 'btn-delete-link';
    public $deleteTitle = 'delete';
    public $confirmMessage = 'Are you shure?';

    public function init()
    {
        $this->editTitle = Yii::t('app', 'LABEL_EDIT');
        $this->deleteTitle = Yii::t('app', 'LABEL_DELETE');
        $this->confirmMessage = Yii::t('app', 'MESSAGE_ARE_YOU_SURE_DELETE');
    }

    public function run()
    {
        $editIcon = Html::tag('span', '', ['class' => 'glyphicon glyphicon-pencil', 'aria-hidden' => 'true']);
        $deleteIcon = Html::tag('span', '', ['class' => 'glyphicon glyphicon-trash', 'aria-hidden' => 'true']);

        $editButton = Html::tag('button', $editIcon, [
            'type' => 'button',
            'class' => 'btn btn-default ' . $this->editClass,
            'title' => $this->editTitle,
            'data-toggle' => 'modal',
            'data-target' => $this->modalId,
            'data-title' => $this->modalTitle,
            'data-id' => $this->itemId,
        ]);

        $deleteButton = Html::tag('button', $deleteIcon, [
            'type' => 'button',
            'class' => 'btn btn-default ' . $this->deleteClass,
            'title' => $this->editTitle,
            'data-msg' => $this->confirmMessage,
            'data-id' => $this->itemId,
        ]);

        $group = Html::tag('div', $editButton . $deleteButton, [
            'class' => 'btn-group btn-group-sm',
            'role' => 'group'
        ]);

        echo $group;
    }
}