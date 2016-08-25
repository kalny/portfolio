<?php
/* @var $this yii\web\View */
/* @var $portfolio \app\models\Portfolio */
/* @var $user \app\models\User */

$title = Yii::t('app', 'TITLE_EDIT_PORTFOLIO');

$this->title = $title;
?>

<h1><?= Yii::t('app', 'TITLE_PORTFOLIO') ?>: <?= $portfolio->name ?></h1>

<div class="portfolio-edit">
    <?= $this->render('_form', [
        'portfolio' => $portfolio,
        'user' => $user,
    ]) ?>
</div>