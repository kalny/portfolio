<?php

/* @var $this yii\web\View */
/* @var $portfolio \app\models\Portfolio */
/* @var $user \app\models\User */
?>

<div class="form-group">
    <label><?= Yii::t('app', 'LABEL_LINKS') ?></label>

    <table class="table table-bordered links-table">
        <tbody>
            <?php foreach ($portfolio->links as $link): ?>
                <?= $this->render('_link_line', [
                    'link' => $link
                ]) ?>
            <?php endforeach; ?>
        </tbody>
    </table>

    <button type="button"
            class="btn btn-success btn-add-link"
            title="<?= Yii::t('app', 'LABEL_ADD_LINK') ?>"
            data-toggle="modal"
            data-target="#linkEditModalWindow"
            data-title="<?= Yii::t('app', 'TITLE_ADD_LINK') ?>"
            data-id="<?= $portfolio->id ?>"
            data-user-id="<?= $user->id ?>"
            data-portfolio-id="<?= $portfolio->id ?>">
        <?= Yii::t('app', 'BUTTON_ADD_LINK') ?>
    </button>
    <hr>
</div>

<!-- Link Modal Window -->
<div class="modal fade" id="linkEditModalWindow" tabindex="-1" role="dialog" aria-labelledby="linkEditModalWindow">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="linkEditModalLabel"></h4>
            </div>
            
            <div class="modal-body"></div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="link_form"><?= Yii::t('app', 'BUTTON_SAVE') ?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= Yii::t('app', 'BUTTON_CANCEL') ?></button>
            </div>
        </div>
    </div>
</div>

<?php $this->registerJsFile('/js/links.js', ['depends' => \yii\web\YiiAsset::className()]); ?>
