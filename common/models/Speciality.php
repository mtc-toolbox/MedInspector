<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "speciality".
 *
 * @property int $id Идентификатор записи
 * @property string $name Наименование
 *
 * @property PolyclinicSpeciality[] $polyclinicSpecialities
 */
class Speciality extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'speciality';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 64],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Идентификатор записи'),
            'name' => Yii::t('app', 'Наименование'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPolyclinicSpecialities()
    {
        return $this->hasMany(PolyclinicSpeciality::className(), ['speciality' => 'id']);
    }

    public static function getList()
    {
        $query = self::find()->orderBy('name');

        $list = $query->all();

        $dataList = ArrayHelper::map($list, 'id', 'name');;

        return $dataList;
    }
}
