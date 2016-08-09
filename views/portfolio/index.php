<?php

use yii\helpers\Url;
use app\helpers\Translator;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $portfolio \app\models\Portfolio */

$title = Yii::t('app', 'TITLE_MY_PORTFOLIO');

$this->title = $title;

?>
<h1><?= $title ?></h1>

<?php foreach ($portfolios as $portfolio): ?>
<div class="portfolio-item">
    <div class="row">
        <div class="col-sm-3">
            <img class="img-responsive" src="/public/<?= (!empty($portfolio->avatar)) ? $portfolio->avatar : 'no-image.png' ?>">
        </div>
        <div class="col-sm-9">
            <div class="row">
                <div class="col-sm-10">
                    <h2><?= $portfolio->name ?></h2>
                </div>
                <div class="col-sm-2">
                    <div class="btn-group btn-group-sm" role="group">
                        <a href="<?= Url::to(['portfolio/view', 'id' => $portfolio->id]) ?>" type="button" class="btn btn-default" title="<?= Yii::t('app', 'LABEL_VIEW') ?>">
                            <span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
                        </a>
                        <a href="<?= Url::to(['portfolio/edit', 'id' => $portfolio->id]) ?>" type="button" class="btn btn-default" title="<?= Yii::t('app', 'LABEL_EDIT') ?>">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </a>
                        <button type="button"
                                class="btn btn-default btn-delete-portfolio"
                                title="<?= Yii::t('app', 'LABEL_DELETE') ?>"
                                data-msg="<?= Yii::t('app', 'MESSAGE_ARE_YOU_SURE_DELETE') ?>"
                                data-id="<?= $portfolio->id ?>">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
            </div>

            <p><?= Yii::t('app', 'LABEL_RATING') ?>: <?= $portfolio->rating ?> - <?= count($portfolio->users) ?> <?= Translator::getTranslate(count($portfolio->users))?></p>
            <p><?= $portfolio->description ?></p>
        </div>
    </div>
    <hr>
</div>

<?php endforeach; ?>

<?php $this->registerJsFile('/js/site.js', ['depends' => \yii\web\YiiAsset::className()]); ?>
