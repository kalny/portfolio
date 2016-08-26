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

    <?= $this->render('_items', [
        'label' => Yii::t('app', 'LABEL_LINKS'),
        'tableClass' => 'links-table',
        'models' => $portfolio->links,
        'lineView' => '@app/views/links/_link_line',
        'itemName' => 'link',
        'addButtonClass' => 'btn-add-link',
        'addButtonTitle' => Yii::t('app', 'LABEL_ADD_LINK'),
        'modalId' => 'linkEditModalWindow',
        'modalTitle' => Yii::t('app', 'TITLE_ADD_LINK'),
        'addButtonLabel' => Yii::t('app', 'BUTTON_ADD_LINK'),
        'formId' => 'link_form',
        'scriptFile' => '/js/links.js',
        'portfolioId' => $portfolio->id,
        'userId' => $user->id
    ]) ?>

    <?= $this->render('_items', [
        'label' => Yii::t('app', 'LABEL_EMAILS'),
        'tableClass' => 'emails-table',
        'models' => $portfolio->emails,
        'lineView' => '@app/views/emails/_email_line',
        'itemName' => 'email',
        'addButtonClass' => 'btn-add-email',
        'addButtonTitle' => Yii::t('app', 'LABEL_ADD_EMAIL'),
        'modalId' => 'emailEditModalWindow',
        'modalTitle' => Yii::t('app', 'TITLE_ADD_EMAIL'),
        'addButtonLabel' => Yii::t('app', 'BUTTON_ADD_EMAIL'),
        'formId' => 'email_form',
        'scriptFile' => '/js/emails.js',
        'portfolioId' => $portfolio->id,
        'userId' => $user->id
    ]) ?>

    <?= $this->render('_items', [
        'label' => Yii::t('app', 'LABEL_PHONES'),
        'tableClass' => 'phones-table',
        'models' => $portfolio->phones,
        'lineView' => '@app/views/phones/_phone_line',
        'itemName' => 'phone',
        'addButtonClass' => 'btn-add-phone',
        'addButtonTitle' => Yii::t('app', 'LABEL_ADD_PHONE'),
        'modalId' => 'phoneEditModalWindow',
        'modalTitle' => Yii::t('app', 'TITLE_ADD_PHONE'),
        'addButtonLabel' => Yii::t('app', 'BUTTON_ADD_PHONE'),
        'formId' => 'phone_form',
        'scriptFile' => '/js/phones.js',
        'portfolioId' => $portfolio->id,
        'userId' => $user->id
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
