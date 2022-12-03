<?php


$this->title = Yii::t('post', 'History');
?>
<div class="readme-index">

    <?php
    $parsedown = new \Parsedown();
    echo $parsedown->text($readme);
    ?>

</div>