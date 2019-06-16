<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Speciality */

$this->title = Yii::t('app', 'Изменение специализации: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cпециализации'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Изменение');
?>
<div class="speciality-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
