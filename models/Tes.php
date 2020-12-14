<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tes}}".
 *
 * @property int $id_tes
 * @property int $id_buku
 * @property int $id_user
 * @property int $nilai
 *
 * @property HasilTes[] $hasilTes
 * @property Buku $buku
 * @property Users $user
 */
class Tes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tes}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_buku', 'id_user'], 'required'],
            [['id_buku', 'id_user', 'nilai'], 'integer'],
            [['id_buku'], 'exist', 'skipOnError' => true, 'targetClass' => TblBuku::className(), 'targetAttribute' => ['id_buku' => 'id_buku']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => TblUsers::className(), 'targetAttribute' => ['id_user' => 'id_user']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tes' => 'Id Tes',
            'id_buku' => 'Id Buku',
            'id_user' => 'Id User',
            'nilai' => 'Nilai',
        ];
    }

    /**
     * Gets query for [[HasilTes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHasilTes()
    {
        return $this->hasMany(TblHasiltes::className(), ['id_tes' => 'id_tes']);
    }

    /**
     * Gets query for [[Buku]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBuku()
    {
        return $this->hasOne(TblBuku::className(), ['id_buku' => 'id_buku']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(TblUsers::className(), ['id_user' => 'id_user']);
    }
}
