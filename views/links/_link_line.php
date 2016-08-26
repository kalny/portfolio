<?php

use app\widgets\ActionButtons;

/* @var $this yii\web\View */
/* @var $link \app\models\Link */

?>

<tr id="link_<?= $link->id ?>">
    <td class="link-url"><a href="//<?= $link->url ?>" title="<?= $link->title ?>">
            <?= (!empty($link->anchor)) ? $link->anchor : $link->url ?></a></td>

    <td class="link-description"><?= $link->description ?></td>

    <td><?= ActionButtons::widget([
            'editClass' => 'btn-edit-link',
            'modalId' => '#linkEditModalWindow',
            'modalTitle' => Yii::t('app', 'TITLE_EDIT_LINK'),
            'itemId' => $link->id,
            'deleteClass' => 'btn-delete-link',
        ]) ?></td>
</tr>
