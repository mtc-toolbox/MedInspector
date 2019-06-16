<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "cities".
 *
 * @property int $id Идентификатор записи
 * @property string $name Наименование
 * @property int $region Регион
 *
 * @property Regions $region0
 * @property Polyclinics[] $polyclinics
 */
class Cities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cities';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['region'], 'required'],
            [['region'], 'default', 'value' => null],
            [['region'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['name'], 'unique'],
            [['region'], 'exist', 'skipOnError' => true, 'targetClass' => Regions::className(), 'targetAttribute' => ['region' => 'id']],
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
            'region' => Yii::t('app', 'Регион'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion0()
    {
        return $this->hasOne(Regions::className(), ['id' => 'region']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPolyclinics()
    {
        return $this->hasMany(Polyclinics::className(), ['city' => 'id']);
    }

    public static function getList($regionId, $needOnly = false)
    {
        $query = self::find()->orderBy('name');
        if ($regionId) {
            $query->andWhere(['region' => $regionId]);
        } else {
            if ($needOnly) {
                return [];
            }
        }
        $list = $query->all();

        $dataList = ArrayHelper::map($list, 'id', 'name');;

        return $dataList;
    }
}
