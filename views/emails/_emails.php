<?php

/* @var $this yii\web\View */
/* @var $portfolio \app\models\Portfolio */
/* @var $user \app\models\User */
?>

<div class="form-group">
    <label><?= Yii::t('app', 'LABEL_EMAILS') ?></label>

    <table class="table table-bordered emails-table">
        <tbody>
            <?php foreach ($portfolio->emails as $email): ?>
                <?= $this->render('_email_line', [
                    'email' => $email
                ]) ?>
            <?php endforeach; ?>
        </tbody>
    </table>

    <button type="button"
            class="btn btn-success btn-add-email"
            title="<?= Yii::t('app', 'LABEL_ADD_EMAIL') ?>"
            data-toggle="modal"
            data-target="#emailEditModalWindow"
            data-title="<?= Yii::t('app', 'TITLE_ADD_EMAIL') ?>"
            data-id="<?= $portfolio->id ?>"
            data-user-id="<?= $user->id ?>"
            data-portfolio-id="<?= $portfolio->id ?>">
        <?= Yii::t('app', 'BUTTON_ADD_EMAIL') ?>
    </button>
    <hr>
</div>

<!-- Work Modal Window -->
<div class="modal fade" id="emailEditModalWindow" tabindex="-1" role="dialog" aria-labelledby="emailEditModalWindow">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="emailEditModalLabel"></h4>
            </div>
            
            <div class="modal-body"></div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="email_form"><?= Yii::t('app', 'BUTTON_SAVE') ?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= Yii::t('app', 'BUTTON_CANCEL') ?></button>
            </div>
        </div>
    </div>
</div>

<?php $this->registerJsFile('/js/emails.js', ['depends' => \yii\web\YiiAsset::className()]); ?>
