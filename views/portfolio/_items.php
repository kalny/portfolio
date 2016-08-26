<?php

/* @var $this yii\web\View */
/* @var $portfolio \app\models\Portfolio */
/* @var $user \app\models\User */
?>

<div class="form-group">
    <label><?= Yii::t('app', $label) ?></label>

    <table class="table table-bordered <?= $tableClass ?>">
        <tbody>
        <?php foreach ($models as $model): ?>
            <?= $this->render($lineView, [
                $itemName => $model
            ]) ?>
        <?php endforeach; ?>
        </tbody>
    </table>

    <button type="button"
            class="btn btn-success <?= $addButtonClass ?>"
            title="<?= $addButtonTitle ?>"
            data-toggle="modal"
            data-target="#<?= $modalId ?>"
            data-title="<?= $modalTitle ?>"
            data-id="<?= $portfolioId ?>"
            data-user-id="<?= $userId ?>"
            data-portfolio-id="<?= $portfolioId ?>">
        <?= $addButtonLabel ?>
    </button>
    <hr>
</div>

<!-- Item Modal Window -->
<div class="modal fade" id="<?= $modalId ?>" tabindex="-1" role="dialog" aria-labelledby="<?= $modalId ?>">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>

            <div class="modal-body"></div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="<?= $formId ?>"><?= Yii::t('app', 'BUTTON_SAVE') ?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= Yii::t('app', 'BUTTON_CANCEL') ?></button>
            </div>
        </div>
    </div>
</div>

<?php $this->registerJsFile($scriptFile, ['depends' => \yii\web\YiiAsset::className()]); ?>
