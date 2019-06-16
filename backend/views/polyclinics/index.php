<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\PolyclinicsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Поликлиники');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="polyclinics-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Добавить'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'region',
                'filter'    => \common\models\Regions::getList(),
                'value'     => function ($model) {
                    /* @var \common\models\Polyclinics $model */
                    $model->selectRegion();
                    $region = $model->region0;
                    if (isset($region)) {
                        return $region->name;
                    }

                    return '';
                },
            ],

            [
                'attribute' => 'city',
                'filter'    => \common\models\Cities::getList($searchModel->region),
                'value'     => function ($model) {
                    /* @var \common\models\Polyclinics $model */
                    $city = $model->city0;
                    if (isset($city)) {
                        return $city->name;
                    }

                    return '';
                },
            ],

            'name',
            [
                'class'    => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
