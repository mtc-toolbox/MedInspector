<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "polyclinics".
 *
 * @property int                    $id   Идентификатор записи
 * @property string                 $name Наименование
 * @property int                    $city Населённый пункт
 *
 * @property Clients[]              $clients
 * @property PolyclinicSpeciality[] $polyclinicSpecialities
 * @property Cities                 $city0
 * @property Regions                $region0
 * @property array                  $selectedPolyclinicSpecialities
 */
class Polyclinics extends \yii\db\ActiveRecord
{
    public $region = null;

    public $selectedPolyclinicSpecialities = [];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'polyclinics';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['city'], 'default', 'value' => null],
            [['city'], 'integer'],
            [['city'], 'required'],
            [['name'], 'string', 'max' => 64],
            [['name'], 'unique'],
            [['selectedPolyclinicSpecialities'], 'safe'],
            [['city'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['city' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'                             => Yii::t('app', 'Идентификатор записи'),
            'name'                           => Yii::t('app', 'Наименование'),
            'city'                           => Yii::t('app', 'Населённый пункт'),
            'region'                         => Yii::t('app', 'Регион'),
            'selectedPolyclinicSpecialities' => 'Специализации',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClients()
    {
        return $this->hasMany(Clients::className(), ['polyclinic' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPolyclinicSpecialities()
    {
        return $this->hasMany(PolyclinicSpeciality::className(), ['polyclinic' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity0()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city']);
    }

    /**
     * Заполнение региона по выбранному городу
     */
    public function selectRegion()
    {
        $city = $this->city0;
        if (isset($city)) {
            $this->region = $city->region;
        }
    }

    /**
     * @return Regions|null
     */
    public function getRegion0()
    {
        return Regions::findOne(['id' => $this->region]);
    }

    /**
     * @param bool $runValidation
     * @param null $attributeNames
     *
     * @return bool
     */
    public function save($runValidation = true, $attributeNames = null)
    {
        try {

            $transaction = static::getDb()->beginTransaction();

            if (!parent::save($runValidation, $attributeNames)) {
                $transaction->rollBack();

                return false;
            }

            $foundAbsent = $this->getPolyclinicSpecialities()->all();

            foreach ($foundAbsent as $item) {
                $item->delete();
            }

            foreach ($this->selectedPolyclinicSpecialities as $key) {
                $model = new PolyclinicSpeciality();

                $model->speciality = $key;
                $model->polyclinic = $this->id;

                if (!$model->save()) {
                    $transaction->rollBack();

                    return false;
                }
            }

            $transaction->commit();

        } catch (Exception $e) {
            throw $e;
        } catch (Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }

        return true;
    }

    /**
     *
     */
    public function loadSpecialities()
    {
        $this->selectedPolyclinicSpecialities = [];

        $list = $this->getPolyclinicSpecialities()->all();

        foreach ($list as $item) {

            $this->selectedPolyclinicSpecialities = $item->speciality;
        }
    }
}
