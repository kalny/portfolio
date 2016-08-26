<?php

use app\widgets\ActionButtons;

/* @var $this yii\web\View */
/* @var $phone \app\models\Phone */

?>

<tr id="phone_<?= $phone->id ?>">
    <td class="phone-number"><?= $phone->number ?></td>

    <td class="phone-note"><?= $phone->note ?></td>

    <td><?= ActionButtons::widget([
            'editClass' => 'btn-edit-phone',
            'modalId' => '#phoneEditModalWindow',
            'modalTitle' => Yii::t('app', 'TITLE_EDIT_PHONE'),
            'itemId' => $phone->id,
            'deleteClass' => 'btn-delete-phone',
        ]) ?></td>
</tr>
