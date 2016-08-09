<?php
/* @var $this yii\web\View */
/* @var $portfolio app\models\Portfolio */

$title = $portfolio->user->username . ' (' . $portfolio->name . ')';
$this->title = $title;

?>
<h1><?= $title ?></h1>

<p><?= Yii::t('app', 'TITLE_RATING') ?>: <?= $portfolio->rating ?></p>

<div class="row">
    <div class="col-sm-6">
        <img class="img-responsive" src="/public/<?= (!empty($portfolio->avatar)) ? $portfolio->avatar : 'no-image.png' ?>">
    </div>
    <div class="col-sm-6">
        <h3><?= Yii::t('app', 'TITLE_DESCRIPTION') ?>:</h3>
        <p><?= $portfolio->description ?></p>

        <?php if (count($portfolio->links) > 0) : ?>
        <h3><?= Yii::t('app', 'TITLE_LINKS') ?>:</h3>
        <?php foreach ($portfolio->links as $link): ?>
            <a href="<?= $link->url ?>" title="<?= $link->title ?>"><?= (!empty($link->anchor)) ? $link->anchor : $link->url ?></a>
            <?= $link->description ?><br>
        <?php endforeach; ?>
        <?php endif; ?>

        <?php if (count($portfolio->emails) > 0) : ?>
        <h3><?= Yii::t('app', 'TITLE_EMAILS') ?>:</h3>
        <?php foreach ($portfolio->emails as $email): ?>
            <a href="mailto:<?= $email->email ?>"><?= $email->email ?></a><br>
        <?php endforeach; ?>
        <?php endif; ?>

        <?php if (count($portfolio->phones) > 0) : ?>
        <h3><?= Yii::t('app', 'TITLE_PHONES') ?>:</h3>
        <?php foreach ($portfolio->phones as $phone): ?>
            <?= $phone->number ?><?= (!empty($phone->note)) ? ' - ' . $phone->note : NULL ?><br>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php if (count($portfolio->works) > 0) : ?>
<a id="works"></a>
<h3><?= Yii::t('app', 'TITLE_MY_WORKS') ?>:</h3>
<div class="row">
<?php foreach ($portfolio->works as $work): ?>
    <div class="col-sm-3">
        <p><img class="img-responsive" src="/public/<?= (!empty($work->image)) ? $work->image : 'no-image.png' ?>"></p>
        <p><?= $work->title ?></p>
        <p><a data-toggle="modal" data-target="#workModalWindow" data-id="<?= $work->id ?>" href="#"><?= Yii::t('app', 'LABEL_READ_MORE') ?></a></p>
    </div>
<?php endforeach; ?>
</div>
<div style="text-align: right"><?= Yii::t('app', 'LABEL_REFER_TO_WORKS') ?> <a href="#works">-#-</a></div>
<hr>
<?php endif; ?>

<?php foreach ($portfolio->paragraphs as $paragraph): ?>
    <a id="paragraph<?= $paragraph->id ?>"></a>
    <?= \kartik\markdown\Markdown::convert($paragraph->content); ?>
    <div style="text-align: right"><?= Yii::t('app', 'LABEL_REFER_TO_PARAGRAPH') ?> <a href="#paragraph<?= $paragraph->id ?>">-#-</a></div>
    <hr>
<?php endforeach; ?>

<!-- Work Modal Window -->
<div class="modal fade" id="workModalWindow" tabindex="-1" role="dialog" aria-labelledby="workModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="workModalLabel"></h4>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>

<?php $this->registerJsFile('/js/site.js', ['depends' => \yii\web\YiiAsset::className()]); ?>
