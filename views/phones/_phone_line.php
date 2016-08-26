<?php

/* @var $this yii\web\View */
/* @var $phone \app\models\Phone */

?>

<tr id="phone_<?= $phone->id ?>">
    <td class="phone-number"><?= $phone->number ?></td>

    <td class="phone-note"><?= $phone->note ?></td>

    <td><div class="btn-group btn-group-sm" role="group">
            <button type="button"
                    class="btn btn-default btn-edit-phone"
                    title="<?= Yii::t('app', 'LABEL_EDIT') ?>"
                    data-toggle="modal"
                    data-target="#phoneEditModalWindow"
                    data-title="<?= Yii::t('app', 'TITLE_EDIT_PHONE') ?>"
                    data-id="<?= $phone->id ?>">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
            </button>
            <button type="button"
                    class="btn btn-default btn-delete-phone"
                    title="<?= Yii::t('app', 'LABEL_DELETE') ?>"
                    data-msg="<?= Yii::t('app', 'MESSAGE_ARE_YOU_SURE_DELETE') ?>"
                    data-id="<?= $phone->id ?>">
                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
            </button>
        </div></td>
</tr>
