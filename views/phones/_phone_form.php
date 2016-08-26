<?php

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $phone \app\models\Phone */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="post-form">
    <?php $form = ActiveForm::begin(['id' => 'phone_form']); ?>

    <?= $form->field($phone, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($phone, 'note')->textInput(['maxlength' => true]) ?>

    <?php ActiveForm::end(); ?>
</div>
