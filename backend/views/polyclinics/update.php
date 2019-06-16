<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Polyclinics */

$this->title = Yii::t('app', 'Изменение поликлиники: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Поликлиники'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Изменение');
?>
<div class="polyclinics-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
