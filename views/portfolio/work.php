<?php
/* @var $work app\models\Work */
?>

<div class="row">
    <div class="col-sm-6">
        <img class="img-responsive" src="public/<?= (!empty($work->image)) ? $work->image : 'no-image.png' ?>">
    </div>
    <div class="col-sm-6">
        <?= $work->description ?>
    </div>
</div>

<?php if (!empty($work->link)): ?>
<?= Yii::t('app', 'LABEL_REFER_TO_WORK') ?>:
<a href="http://<?= $work->link ?>" target="_blank"><?= $work->link ?></a>
(<?= Yii::t('app', 'LABEL_LINK_WILL_OPEN_IN_A_NEW_WINDOW') ?>)
<?php endif; ?>
