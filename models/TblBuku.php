<?php

namespace app\models;


use Yii;

/**
 * This is the model class for table "buku".
 *
 * @property int $id_buku
 * @property string $cover
 * @property string $judul_buku
 * @property string $penulis
 * @property string $kategori
 * @property string $tahun_terbit
 * @property string $jenjang
 * @property string $deskripsi
 * @property int|null $id_user
 *
 * @property Bookmark[] $bookmarks
 * @property Users $user
 * @property TblChapter[] $chapters
 * @property Rekomendasi[] $rekomendasis
 * @property Tes[] $tes
 */
class TblBuku extends \yii\db\ActiveRecord
{
     public $oldcover;
     public $jumlahbuku;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'buku';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['judul_buku', 'penulis', 'kategori', 'tahun_terbit','kota_terbit','penerbit', 'jenjang', 'deskripsi'], 'required'],
            [['cover','tahun_terbit','jumlahbuku'], 'safe'],
            [['deskripsi'], 'string'],
            [['id_user'], 'integer'],
            [['cover', 'judul_buku', 'penulis', 'kategori'], 'string', 'max' => 64],
            [['jenjang'], 'string', 'max' => 128],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => TblUsers::className(), 'targetAttribute' => ['id_user' => 'id_user']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_buku' => 'Id Buku',
            'cover' => 'Cover',
            'judul_buku' => 'Judul Buku',
            'penulis' => 'Penulis',
            'kategori' => 'Kategori',
            'tahun_terbit' => 'Tahun Terbit',
            'kota_terbit' => 'Kota Terbit',
            'penerbit' => 'Penerbit',
            'jenjang' => 'Jenjang',
            'deskripsi' => 'Deskripsi',
            'id_user' => 'Id User',
        ];
    }

    /**
     * Gets query for [[Bookmarks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookmarks()
    {
        return $this->hasMany(Bookmark::className(), ['id_buku' => 'id_buku']);
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
     * Gets query for [[Chapters]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChapters()
    {
        return $this->hasMany(TblChapter::className(), ['id_buku' => 'id_buku']);
    }

    /**
     * Gets query for [[Rekomendasis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRekomendasis()
    {
        return $this->hasMany(Rekomendasi::className(), ['id_buku' => 'id_buku']);
    }

    /**
     * Gets query for [[Tes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTes()
    {
        return $this->hasMany(Tes::className(), ['id_buku' => 'id_buku']);
    }

    public function afterFind()
	{
		parent::afterFind();

		$this->oldcover = $this->cover;
		 
	}


    public function beforeSave($insert)
    {

        if (!parent::beforeSave($insert)) {
            return false;
        }
        $this->id_user=Yii::$app->user->identity->id_user;
        // ...custom code here...
        return true;
    }
}
