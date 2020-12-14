<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%kuis}}".
 *
 * @property int $id_kuis
 * @property int $id_chapter
 * @property string $soal
 * @property string $pilihan_benar
 * @property string $pilihan_a
 * @property string $pilihan_b
 * @property string $pilihan_c
 * @property string $pilihan_d
 * @property string $pilihan_e
 *
 * @property HasilTes[] $hasilTes
 * @property TblChapter $chapter
 */
class TblKuis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%kuis}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_chapter', 'soal', 'pilihan_benar', 'pilihan_a', 'pilihan_b', 'pilihan_c', 'pilihan_d', 'pilihan_e'], 'required'],
            [['id_chapter'], 'integer'],
            [['soal', 'pilihan_a', 'pilihan_b', 'pilihan_c', 'pilihan_d', 'pilihan_e'], 'string', 'max' => 128],
            [['pilihan_benar'], 'string', 'max' => 1],
            [['id_chapter'], 'exist', 'skipOnError' => true, 'targetClass' => TblChapter::className(), 'targetAttribute' => ['id_chapter' => 'id_chapter']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_kuis' => 'Id Kuis',
            'id_chapter' => 'Id Chapter',
            'soal' => 'Soal',
            'pilihan_benar' => 'Pilihan Benar',
            'pilihan_a' => 'Pilihan A',
            'pilihan_b' => 'Pilihan B',
            'pilihan_c' => 'Pilihan C',
            'pilihan_d' => 'Pilihan D',
            'pilihan_e' => 'Pilihan E',
        ];
    }

    /**
     * Gets query for [[HasilTes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHasilTes()
    {
        return $this->hasMany(TblHasiltes::className(), ['id_kuis' => 'id_kuis']);
    }

    /**
     * Gets query for [[Chapter]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChapter()
    {
        return $this->hasOne(TblChapter::className(), ['id_chapter' => 'id_chapter']);
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }   
        return true;
    }
}
