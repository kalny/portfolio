<?php

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $email \app\models\Email */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="post-form">
    <?php $form = ActiveForm::begin(['id' => 'email_form']); ?>

    <?= $form->field($email, 'email')->textInput(['maxlength' => true]) ?>

    <?php ActiveForm::end(); ?>
</div>
