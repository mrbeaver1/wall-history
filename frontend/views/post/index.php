<?php

use common\models\Post;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier as HtmlPurifierAlias;

/** @var yii\web\View $this */
/** @var common\models\search\Post $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('post', 'Wall-history');
?>
<div class="container post-index">
    <div class="row">
        <div class="col-6">
            <div class="row">
                <?php
                foreach ($dataProvider->getModels() as $model) {
                    echo Html::beginTag('div', ['class' => 'col-12 border-1 border border-light']);
                    echo Html::tag('h3', HtmlPurifierAlias::process($model->author_name), ['class' => 'mb-3']);
                    echo Html::tag('p', HtmlPurifierAlias::process($model->text), ['class' => 'mb-3']);
                    echo Html::tag('p', $model->getRealTime() . ' | ' . $model->getMaskedIp(), ['class' => 'mt-3 mb-3 blockquote-footer']);
                    echo Html::endTag('div');
                }
                ?>
            </div>
        </div>
        <div class="col-6">
            <?= $this->render('_form', [
                'model' => new Post(),
            ]) ?>
        </div>
    </div>
</div>
