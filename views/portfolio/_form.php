<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $portfolio \app\models\Portfolio */
/* @var $user \app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(['id' => 'portfolio_form']); ?>

    <?= $form->field($portfolio, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($portfolio, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <label><?= Yii::t('app', 'LABEL_IMAGE') ?></label>
        <?php if ($portfolio->isNewRecord) : ?>
            <p><img class="img-responsive portfolio-avatar" src="/public/no-image.png" ></p>
        <?php else: ?>
            <p><img class="img-responsive portfolio-avatar" src="/public/<?= (!empty($portfolio->avatar)) ? $portfolio->avatar : 'no-image.png' ?>"></p>
        <?php endif; ?>
        <input type="hidden" name="avatarData" value="">
        <p><a data-toggle="modal" data-target="#changeAvatarModalWindow" data-id="<?= $portfolio->id ?>" href="#">
                <?= Yii::t('app', 'BUTTON_CHANGE') ?></a></p>
    </div>

    <?php ActiveForm::end(); ?>

    <?= $this->render('@app/views/links/_links', [
        'portfolio' => $portfolio,
        'user' => $user
    ]) ?>

    <?= $this->render('@app/views/emails/_emails', [
        'portfolio' => $portfolio,
        'user' => $user
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($portfolio->isNewRecord ? Yii::t('app', 'BUTTON_CREATE') : Yii::t('app', 'BUTTON_EDIT'),
            ['class' => $portfolio->isNewRecord ? 'btn btn-success btn-flat' : 'btn btn-primary btn-flat',
            'form' => 'portfolio_form']) ?>
    </div>

</div>

<!-- Change Avatar Modal Window -->
<div class="modal fade" id="changeAvatarModalWindow" tabindex="-1" role="dialog" aria-labelledby="changeAvatarModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="changeAvatarModalLabel"><?= Yii::t('app', 'TITLE_EDIT_PORTFOLIO_IMAGE') ?></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-6">
                        <img src="" alt="" class="img-responsive img-avatar">
                    </div>
                    <div class="col-xs-6">
                        <input type="file" id="avatar-change">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-save-avatar"><?= Yii::t('app', 'BUTTON_SAVE') ?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= Yii::t('app', 'BUTTON_CANCEL') ?></button>
            </div>
        </div>
    </div>
</div>

<?php $this->registerJsFile('/js/site.js', ['depends' => \yii\web\YiiAsset::className()]); ?>
<?php $this->registerJsFile('/js/common.js', ['depends' => \yii\web\YiiAsset::className()]); ?>
