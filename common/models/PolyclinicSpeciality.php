<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "polyclinic_speciality".
 *
 * @property int $id Идентификатор записи
 * @property int $polyclinic Поликлиника
 * @property int $speciality Специализация
 *
 * @property Doctors[] $doctors
 * @property Polyclinics $polyclinic0
 * @property Speciality $speciality0
 */
class PolyclinicSpeciality extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'polyclinic_speciality';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['polyclinic', 'speciality'], 'default', 'value' => null],
            [['polyclinic', 'speciality'], 'integer'],
            [['polyclinic'], 'exist', 'skipOnError' => true, 'targetClass' => Polyclinics::className(), 'targetAttribute' => ['polyclinic' => 'id']],
            [['speciality'], 'exist', 'skipOnError' => true, 'targetClass' => Speciality::className(), 'targetAttribute' => ['speciality' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Идентификатор записи'),
            'polyclinic' => Yii::t('app', 'Поликлиника'),
            'speciality' => Yii::t('app', 'Специализация'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoctors()
    {
        return $this->hasMany(Doctors::className(), ['polyclinics_speciality' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPolyclinic0()
    {
        return $this->hasOne(Polyclinics::className(), ['id' => 'polyclinic']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpeciality0()
    {
        return $this->hasOne(Speciality::className(), ['id' => 'speciality']);
    }
}
