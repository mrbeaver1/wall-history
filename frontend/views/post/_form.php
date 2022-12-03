<?php

use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Post $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin([
            'action' => '/post/create',
    ]); ?>
    <div class="form-group">
        <?= $form->field($model, 'author_name')->label(Yii::t('post', 'Author name'), ['class' => 'mb-1'])->textInput(['maxlength' => true, 'class' => 'form-control mb-2', 'placeholder' => (Yii::t('post', 'Author name placeholder'))]) ?>
    </div>
    <div class="form-group">
        <?= $form->field($model, 'text')->label(Yii::t('post', 'Text'), ['class' => 'mb-1'])->textarea(['rows' => 6, 'class' => 'form-control mb-2', 'placeholder' => (Yii::t('post', 'Text placeholder'))]) ?>
    </div>
    <?= $form->field($model, 'verifyCode')->widget(Captcha::classname(), []) ?>

    <div class="form-group mt-2">
        <?= Html::submitButton(Yii::t('post', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
