<?php

/* @var $this yii\web\View */
/* @var $link \app\models\Link */

?>

<tr id="link_<?= $link->id ?>">
    <td class="link-url"><a href="//<?= $link->url ?>" title="<?= $link->title ?>">
            <?= (!empty($link->anchor)) ? $link->anchor : $link->url ?></a></td>

    <td class="link-description"><?= $link->description ?></td>

    <td><div class="btn-group btn-group-sm" role="group">
            <button type="button"
                    class="btn btn-default btn-edit-link"
                    title="<?= Yii::t('app', 'LABEL_EDIT') ?>"
                    data-toggle="modal"
                    data-target="#linkEditModalWindow"
                    data-title="<?= Yii::t('app', 'TITLE_EDIT_LINK') ?>"
                    data-id="<?= $link->id ?>">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
            </button>
            <button type="button"
                    class="btn btn-default btn-delete-link"
                    title="<?= Yii::t('app', 'LABEL_DELETE') ?>"
                    data-msg="<?= Yii::t('app', 'MESSAGE_ARE_YOU_SURE_DELETE') ?>"
                    data-id="<?= $link->id ?>">
                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
            </button>
        </div></td>
</tr>
