<?php

/* @var $this yii\web\View */
/* @var $email \app\models\Email */

?>

<tr id="email_<?= $email->id ?>">
    <td class="email-url"><a href="mailto:<?= $email->email ?>">
            <?= $email->email ?></a></td>

    <td><div class="btn-group btn-group-sm" role="group">
            <button type="button"
                    class="btn btn-default btn-edit-link"
                    title="<?= Yii::t('app', 'LABEL_EDIT') ?>"
                    data-toggle="modal"
                    data-target="#emailEditModalWindow"
                    data-title="<?= Yii::t('app', 'TITLE_EDIT_EMAIL') ?>"
                    data-id="<?= $email->id ?>">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
            </button>
            <button type="button"
                    class="btn btn-default btn-delete-email"
                    title="<?= Yii::t('app', 'LABEL_DELETE') ?>"
                    data-msg="<?= Yii::t('app', 'MESSAGE_ARE_YOU_SURE_DELETE') ?>"
                    data-id="<?= $email->id ?>">
                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
            </button>
        </div></td>
</tr>
