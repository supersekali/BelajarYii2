<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%rekomendasi}}".
 *
 * @property int $id_rekomendasi
 * @property int $id_user
 * @property int $id_buku
 * @property int $bobot
 *
 * @property TblUsers $user
 * @property TblBuku $buku
 */
class TblRekomendasi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%rekomendasi}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_buku', 'bobot'], 'required'],
            [['id_user', 'id_buku', 'bobot'], 'integer'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => TblUsers::className(), 'targetAttribute' => ['id_user' => 'id_user']],
            [['id_buku'], 'exist', 'skipOnError' => true, 'targetClass' => TblBuku::className(), 'targetAttribute' => ['id_buku' => 'id_buku']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_rekomendasi' => 'Id Rekomendasi',
            'id_user' => 'Id User',
            'id_buku' => 'Id TblBuku',
            'bobot' => 'Bobot',
        ];
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

    /**
     * Gets query for [[TblBuku]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBuku()
    {
        return $this->hasOne(TblBuku::className(), ['id_buku' => 'id_buku']);
    }
}
