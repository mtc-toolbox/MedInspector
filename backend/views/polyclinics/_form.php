<?php

use common\models\Regions;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \kartik\widgets\DepDrop;
use kartik\widgets\Select2;
use common\models\Speciality;

/* @var $this yii\web\View */
/* @var $model common\models\Polyclinics */
/* @var $form yii\widgets\ActiveForm */

$model->selectRegion();

?>

<div class="polyclinics-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php

    $regionList = Regions::getList();

    if (!isset($regionList[$model->region])) {
        reset($regionList);
        $model->region = key($regionList);
    }

    echo $form->field($model, 'region')->dropDownList($regionList, ['id' => 'polyclinic-region-id']);


    echo $form->field($model, 'city')->widget(DepDrop::classname(), [
        'options'       => ['id' => 'city-id'],
        'data'          => \common\models\Cities::getList($model->region, true),
        'pluginOptions' => [
            'depends'     => ['polyclinic-region-id'],
            'placeholder' => 'Выбрать...',
            'url'         => Url::to(['cities/list']),
        ],
    ]);
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php
    $model->loadSpecialities();

    $items = Speciality::getList();


    echo $form->field($model, 'selectedPolyclinicSpecialities')->widget(Select2::classname(), [
        'data'          => $items,
        'options'       => ['placeholder' => 'Специалзации...', 'multiple' => true],
        'pluginOptions' => [
            'tags'               => true,
            'tokenSeparators'    => [','],
            'maximumInputLength' => 64,
        ],
    ]);

    ?>

</div>

<div class="form-group">
    <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>
