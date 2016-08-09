<?php
/* @var $this yii\web\View */
/* @var $portfolio \app\models\Portfolio */

$title = Yii::t('app', 'TITLE_ADD_PORTFOLIO');

$this->title = $title;
?>

<h1><?= $title ?></h1>

<div class="portfolio-add">
    <?= $this->render('_form', [
        'portfolio' => $portfolio,
    ]) ?>
</div>