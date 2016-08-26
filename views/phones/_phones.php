<?php

/* @var $this yii\web\View */
/* @var $portfolio \app\models\Portfolio */
/* @var $user \app\models\User */
?>

<div class="form-group">
    <label><?= Yii::t('app', 'LABEL_PHONES') ?></label>

    <table class="table table-bordered phones-table">
        <tbody>
            <?php foreach ($portfolio->phones as $phone): ?>
                <?= $this->render('_phone_line', [
                    'phone' => $phone
                ]) ?>
            <?php endforeach; ?>
        </tbody>
    </table>

    <button type="button"
            class="btn btn-success btn-add-phone"
            title="<?= Yii::t('app', 'LABEL_ADD_PHONE') ?>"
            data-toggle="modal"
            data-target="#phoneEditModalWindow"
            data-title="<?= Yii::t('app', 'TITLE_ADD_PHONE') ?>"
            data-id="<?= $portfolio->id ?>"
            data-user-id="<?= $user->id ?>"
            data-portfolio-id="<?= $portfolio->id ?>">
        <?= Yii::t('app', 'BUTTON_ADD_PHONE') ?>
    </button>
    <hr>
</div>

<!-- Phone Modal Window -->
<div class="modal fade" id="phoneEditModalWindow" tabindex="-1" role="dialog" aria-labelledby="phoneEditModalWindow">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="phoneEditModalLabel"></h4>
            </div>
            
            <div class="modal-body"></div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="phone_form"><?= Yii::t('app', 'BUTTON_SAVE') ?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= Yii::t('app', 'BUTTON_CANCEL') ?></button>
            </div>
        </div>
    </div>
</div>

<?php $this->registerJsFile('/js/phones.js', ['depends' => \yii\web\YiiAsset::className()]); ?>
