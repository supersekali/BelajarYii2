<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%hasil_tes}}".
 *
 * @property int $id_hasil
 * @property int $id_tes
 * @property int $id_kuis
 * @property string $jawaban
 *
 * @property Tes $tes
 * @property Kuis $kuis
 */
class TblHasiltes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%hasil_tes}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tes', 'id_kuis', 'jawaban'], 'required'],
            [['id_tes', 'id_kuis'], 'integer'],
            [['jawaban'], 'string', 'max' => 1],
            [['id_tes'], 'exist', 'skipOnError' => true, 'targetClass' => Tes::className(), 'targetAttribute' => ['id_tes' => 'id_tes']],
            [['id_kuis'], 'exist', 'skipOnError' => true, 'targetClass' => TblKuis::className(), 'targetAttribute' => ['id_kuis' => 'id_kuis']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_hasil' => 'Id Hasil',
            'id_tes' => 'Id Tes',
            'id_kuis' => 'Id Kuis',
            'jawaban' => 'Jawaban',
        ];
    }

    /**
     * Gets query for [[Tes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTes()
    {
        return $this->hasOne(Tes::className(), ['id_tes' => 'id_tes']);
    }

    /**
     * Gets query for [[Kuis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKuis()
    {
        return $this->hasOne(TblKuis::className(), ['id_kuis' => 'id_kuis']);
    }
}
