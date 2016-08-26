<?php

use app\widgets\ActionButtons;

/* @var $this yii\web\View */
/* @var $email \app\models\Email */

?>

<tr id="email_<?= $email->id ?>">
    <td class="email-url"><a href="mailto:<?= $email->email ?>">
            <?= $email->email ?></a></td>

    <td><?= ActionButtons::widget([
            'editClass' => 'btn-edit-email',
            'modalId' => '#emailEditModalWindow',
            'modalTitle' => Yii::t('app', 'TITLE_EDIT_EMAIL'),
            'itemId' => $email->id,
            'deleteClass' => 'btn-delete-email',
        ]) ?></td>
</tr>
