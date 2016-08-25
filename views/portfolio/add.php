<?php
/* @var $this yii\web\View */
/* @var $portfolio \app\models\Portfolio */
/* @var $user \app\models\User */

$title = Yii::t('app', 'TITLE_ADD_PORTFOLIO');

$this->title = $title;
?>

<h1><?= $title ?></h1>

<div class="portfolio-add">
    <?= $this->render('_form', [
        'portfolio' => $portfolio,
        'user' => $user,
    ]) ?>
</div>