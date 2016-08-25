<?php

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $link \app\models\Link */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="post-form">
    <?php $form = ActiveForm::begin(['id' => 'link_form']); ?>

    <?= $form->field($link, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($link, 'anchor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($link, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($link, 'description')->textarea(['rows' => 6]) ?>

    <?php ActiveForm::end(); ?>
</div>
