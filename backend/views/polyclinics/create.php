<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Polyclinics */

$this->title = Yii::t('app', 'Добавление');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Поликлиники'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="polyclinics-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
