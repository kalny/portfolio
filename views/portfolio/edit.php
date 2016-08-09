<?php
/* @var $this yii\web\View */
/* @var $portfolio \app\models\Portfolio */

$title = Yii::t('app', 'TITLE_EDIT_PORTFOLIO');

$this->title = $title;
?>

<h1><?= Yii::t('app', 'TITLE_PORTFOLIO') ?>: <?= $portfolio->name ?></h1>

<div class="portfolio-edit">
    <?= $this->render('_form', [
        'portfolio' => $portfolio,
    ]) ?>
</div>