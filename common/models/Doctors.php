<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "doctors".
 *
 * @property int $id Идентификатор записи
 * @property int $polyclinics_speciality Специальность
 * @property string $fullname ФИО
 *
 * @property PolyclinicSpeciality $polyclinicsSpeciality
 */
class Doctors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'doctors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['polyclinics_speciality'], 'default', 'value' => null],
            [['polyclinics_speciality'], 'integer'],
            [['fullname'], 'string', 'max' => 128],
            [['polyclinics_speciality'], 'exist', 'skipOnError' => true, 'targetClass' => PolyclinicSpeciality::className(), 'targetAttribute' => ['polyclinics_speciality' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Идентификатор записи'),
            'polyclinics_speciality' => Yii::t('app', 'Специальность'),
            'fullname' => Yii::t('app', 'ФИО'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPolyclinicsSpeciality()
    {
        return $this->hasOne(PolyclinicSpeciality::className(), ['id' => 'polyclinics_speciality']);
    }
}
